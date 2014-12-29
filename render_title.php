<link rel="stylesheet" type="text/css" href="css/title.css">
<?php
    /* This code renders title of the catalogue with links
     * to all its parent pages.
     */
    $tree_pointer = &$page_tree;
    for ($i = 0; $i < count($page_tree_indexes[$active_id])-1; $i++) {
        print "<h4 class=\"$cat pre-title\"><a href=\"index.php?pgid=" . $tree_pointer[$page_tree_indexes[$active_id][$i]]["node"]["id"] . "\" class=\"$cat\">";
        print $global_menu_item_values[$tree_pointer[$page_tree_indexes[$active_id][$i]]["node"]["value_id"]]["title"];
        print "</a></h4>";
        if ($i != count($page_tree_indexes[$active_id])-2)
            print "<span class=\"$cat arrow\">&#9654;</span>";
        $tree_pointer = &$page_tree[$page_tree_indexes[$active_id][$i]]["children"];
    }
    if (count($page_tree_indexes[$active_id])-1 > 0)
        print "<span class=\"$cat arrow last\">&#9660;</span>";
    print "<h1 class=\"actual_title\">" . $global_menu_item_values[$global_menu_items[$active_id]["value_id"]]["title"] . "</h1>\n";
?>