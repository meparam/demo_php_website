<?php
    function initMySQL() {
        // Create connection
        if (0)
            $con=mysqli_connect("localhost", "root", "alpine", "website_db");
        else 
            $con=mysqli_connect("db_ip", "db_user", "db_pass", "db_name");

        mysqli_set_charset($con, "utf8");

        // Check connection
        if (!$con)
            echo "Failed to connect to MySQL.";
        
        return $con;

    }

    function terminateMySQL($con) {
        mysqli_close($con);
    }

    function fetchMySQL($con) {
        // Fetch database with website structure
        global $global_menu_items;

        global $global_menu_item_values;

        // Website structure
        $q_menu_items = mysqli_query($con, "SELECT * FROM menu_items");
        // Pages info
        $q_menu_item_values = mysqli_query($con, "SELECT * FROM menu_item_values");

        $global_menu_items = array();

        // Recombine elements
        while ($menu_item = mysqli_fetch_array($q_menu_items))
            $global_menu_items[$menu_item["id"]] = $menu_item;

        $global_menu_item_values = array();

        // Recombine elements
        while ($menu_item_value = mysqli_fetch_array($q_menu_item_values))
            $global_menu_item_values[$menu_item_value["id"]] = $menu_item_value;

    }


    // Establish connection to MySQL db
    $con = initMySQL();
    // Get data
    fetchMySQL($con);

    $non_existent_id = false;

    // Determine which page to render
    if (array_key_exists("query", parse_url($_SERVER['REQUEST_URI']))) {
        // Get page id from HTTP request
        parse_str(parse_url($_SERVER['REQUEST_URI'])["query"], $url_vars);
        if (array_key_exists("pgid", $url_vars))
            if (array_key_exists($url_vars["pgid"], $global_menu_items))
                // Page id exists, so set active id
                $active_id = $url_vars["pgid"];
            else {
                // Page id invalid, set active id to main page id
                $non_existent_id = true;
                $active_id = "0";
            }

        else
            // Page id not transmitted, so set active id to main page id
            $active_id = "0";

    }

    else
        // No query made, set active id to main page id
        $active_id = "0";



    if ($active_id != "0")

        $window_title = "Website: " . $global_menu_item_values[$global_menu_items[$active_id]["value_id"]]["title"];

    else

        $window_title = "Website: Main page";


    // Build a page tree out of the linked list
    include "create_page_tree.php";

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"

        "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="ru" lang="ru">



<head>

<?php

    print "<title>" . $window_title . "</title>\n";

?>

    


    <meta http-equiv="content-type" content="text/html; charset=utf-8" />

    <meta name="description"

        content="Website description">

    <meta name="keywords" content="keywords"> 



    <link rel="stylesheet" type="text/css" href="css/style.css">

    <link rel="stylesheet" type="text/css" href="css/link-colors.css">

    <link rel="stylesheet" type="text/css" href="css/menu.css">

    <link rel="stylesheet" type="text/css" href="css/sidebar.css">

    <link rel="stylesheet" type="text/css" href="css/linkblock.css">

    <link rel="stylesheet" type="text/css" href="css/linkblock-colors.css">

    <!-- Favicon

    <link rel="icon" href="/favicon.ico" type="image/x-icon"> -->



    <script type="text/javascript" src="http://code.jquery.com/jquery-latest.min.js"></script>

    <script type="text/javascript" src="js/menu_jquery.js"></script>

    <script type="text/javascript" src="js/scripts.js"></script>

</head>

<body onload="onLoadCodePageSpecific();initMenu();initLinkBlocks()">

    <div id="header_block">

        <div id="logo_block">

            <a href="index.php?pgid=0">
                <img id="logo-img" src="img/logo.jpg" width="348" height="77" alt="Website Logo"
            ></a>
                <div id="logo_text_block">
                    <a href="tel:+11 23 456 68 34" style="text-decoration: none">+11 23 456 68 34</a><br>
                    <a href="mailto:website@owner.com" style="text-decoration: none">website@owner.com</a>
                </div>
        </div>

        <div id="cssmenu">

            <?php include 'menu.php'; ?>

        </div>

    </div>



    <div id="body_block">

        <div id="main_column">

            <div id="main_column_row1">

                <div id="main_block">

                    <?php

                        if (!$non_existent_id) {

                            $short_path = $global_menu_item_values[$global_menu_items[$active_id]["value_id"]]["path"];

                            $catN = $global_menu_items[$active_id]["cat"];

                            $full_path = "pages" . DIRECTORY_SEPARATOR . $short_path . ".php";

                            if ($catN == "") 

                                $catN = "1";

                            $cat = "cat" . $catN;

                            print <<<HERE

                    <div id="main_block_side_bar" class="$cat"></div>

HERE;

                        }                        

                    ?>

                    <div id="main_block_main_bar">

                        <?php

                            if ($non_existent_id)

                                include "pages/404.php";

                            else

                                if ($short_path != "" && file_exists($full_path))

                                    include $full_path; 

                                else if ($short_path == "")

                                    include "pages/under_construction.php"; 

                                else

                                    include "pages/404.php"; 

                        ?>

                    </div>

                </div>

            </div>

            <div id="main_column_row2">

                <div id="footer_block">

                    <div id="footer_block_left_block">

                        <div id="left_container">

                            <div id="left_subblock">

                                <a href="tel:+11 23 456 68 34">+11 23 456 68 34</a><br>

                                <a href="mailto:website@owner.com">website@owner.com</a>

                            </div>

                            <div id="right_subblock">

                                City Street 21<br>

                                Postcode City, Country

                            </div>

                        </div>

                    </div>

                    <div id="footer_block_right_block">

                        © 2014 <a href="mailto:naums.mogers@gmail.com"

                        >Naums Mogers</a><br>

                        <span id="additional_copyrights_opener" onclick="showAdditionalCopyrights()">Additional copyrights</span>

                        <div id="additional_copyrights">

                            Background image based on a work by <a href="http://www.monkeyinfez.net/" 

                            target="blank">Paul Hockett</a>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>



</body>

</html>

<?php

    terminateMySQL($con);

?>