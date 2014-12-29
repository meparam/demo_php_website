<?php
    function render_tree($tree) {
        /* render_tree creates HTML/CSS menu from the page tree
         * passed as an input parameter.
         */
        global $global_menu_item_values;

        for ($i = 0; $i < count($tree); $i++) {
            echo "<li id=\"li" . $tree[$i]["node"]["id"] . "\" class=\"";
            $directionClass = "";
            if (isset($tree[$i]["children"]))
                echo "has-sub";

            if ($tree[$i]["node"]["main_item_id"] == 0)
                echo " cat" . $tree[$i]["node"]["cat"];

            if ($tree[$i]["active"])
                echo " active";

            echo "\">\n";
            echo "<a href=\"index.php?pgid=" . $tree[$i]["node"]["id"] . "\">" . $global_menu_item_values[$tree[$i]["node"]["value_id"]]["title"] . "</a>\n";

            if (isset($tree[$i]["children"])) {
                echo "<ul";
                if ($tree[$i]["node"]["main_item_id"] == 0)
                    if ($i < 3)
                        echo " class=\"submenu-onRight\"";
                    else
                        echo " class=\"submenu-onLeft\"";
                echo ">\n";
                render_tree($tree[$i]["children"]);
                echo "</ul>\n";
            }

            if ($tree[$i]["node"]["main_item_id"] == 0) {
                echo "<div class=\"underline_block\">";
                if ($tree[$i]["active"])
                    echo "<div class=\"spacer\"></div>";
                echo "</div>";
            }
            echo "</li>\n";
        }
    }

    function render_menu() {
        global $page_tree;

        echo "<ul>\n";
        render_tree($page_tree);
        echo "</ul>\n";
    }
?>
<?php
    render_menu();
    //select_active_items();
?>
<script type="text/javascript">
    function initMenu() {
        if ("ontouchstart" in document.documentElement)
            $( "#cssmenu" ).addClass("touchscreen");
        else
            $( "#cssmenu" ).addClass("notouchscreen");
    }
</script>