<?php
    include "linkblock.php";

    function render_category($tree_to_render) {
        /* render_category renders a catalogue out
         * of the page tree passed as the input
         * parameter $tree_to_render.
         */
        global $global_menu_item_values;
        if (isset($tree_to_render["children"])) {
            $block_classes = ["block1", "block2", "block3", "block4"];
            $block_class_no = 0;
            if (count($tree_to_render["children"]) > 2)
                $col_class = "threecol";
            else {
                $col_class = "twocol";
                $horizontal_class = "center";
            }
            for ($i = 0; $i < count($tree_to_render["children"]); $i++) {
                if ($col_class == "threecol")
                    if ($i % 3 == 0)
                        $horizontal_class = "left";
                    elseif ($i % 3 == 1)
                        $horizontal_class = "center";
                    else
                        $horizontal_class = "right";
                if (($i == 0) || ($i == 1) || (($i == 2) && (count($tree_to_render["children"]) >= 3)))
                    $vertical_class = "firstrow";
                else
                    $vertical_class = "";
                if ($i % 4 == 0)
                    $block_class_no = 0;
                render_block($tree_to_render["children"][$i]["node"]["id"], $block_classes[$block_class_no], $horizontal_class, $vertical_class, $col_class);
                $block_class_no += 1;
            }
        }
    }

    $tree_to_catalogue = get_tree($active_id);
    if (!isset($active_id)) {
        // Wrong address, no $active_id set.
        print <<<HERE
<script type="text/javascript">
    //window.location.href = "index.php";
</script>
        <h3>Неверный адрес!<br>
        Нажмите <a href="index.php">сюда</a>, если автоматическая переадресация не сработала.</h3>
HERE;
    }
    else if (!isset($tree_to_catalogue["children"])) {
        // Page has no children.
        print <<<HERE
<script type="text/javascript">
    //window.location.href = "index.php";
</script>
        <h3>Невозможно открыть каталог!<br>
        Нажмите <a href="index.php">сюда</a>, если автоматическая переадресация не сработала.</h3>
HERE;
    }
    else {
        render_category($tree_to_catalogue);
    }
?>