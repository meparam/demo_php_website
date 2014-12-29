<?php
    function render_block($id, $block_name, $block_position, $block_rowclass, $col_class) {
        /* render_block creates a square block formatted according
         * to the information fetched from MySQL db.
         * $id of the current element is used to obtain block label,
         * thumbnail and page URL.
         */
        global $global_menu_items;
        global $global_menu_item_values;
        global $cat;
        $value_id = $global_menu_items[$id]["value_id"];
        $class_name = $block_position . "linkblock";
        $title = $global_menu_item_values[$value_id]["title"];
        $thumb = $global_menu_item_values[$value_id]["thumb"];
        if ($thumb == "")
            $nothumbclass = "nothumb";
        else
            $nothumbclass = "";
        print <<<HERE
    <div class="linkblock $cat $block_name $class_name $block_rowclass $col_class $nothumbclass">
        <a href="index.php?pgid=$id">
            <div class="linkblock-img-block">
HERE;
        if ($thumb != "")
            print <<<HERE
                <img class="linkblock-img" src="img/$thumb" width="320" height="208">
HERE;
        print <<<HERE
            </div>
            <div class="linkblock-title">
                <div class="linkblock-title-text">
                    $title
                </div>
            </div>
            <div class="hover-layer"></div>
        </a>
    </div>

HERE;
    }
?>
<script type="text/javascript">
    function initLinkBlocks() {
        if (!("ontouchstart" in document.documentElement))
            $( ".linkblock" ).addClass("noTouch");
    }
</script>