<?php
    function find_item($id, $main_item_id, $previous_item_id, $value_id) {
        /* Find_item finds first element of $remaining_menu_items, which
         * corresponds to the search query. Search query is defined by
         * function parameters, which should be string of the 
         * format <logical_operator><value>
         */
        global $remaining_menu_items;

        if (isset($id)) {
            $id_sign = $id{0};
            $id_value = intval(substr($id, 1));
        }
        if (isset($main_item_id)) {
            $main_item_id_sign = $main_item_id{0};
            $main_item_id_value = intval(substr($main_item_id, 1));
        }
        if (isset($previous_item_id)) {
            $previous_item_id_sign = $previous_item_id{0};
            $previous_item_id_value = intval(substr($previous_item_id, 1));
        }
        if (isset($value_id)) {
            $value_id_sign = $value_id{0};
            $value_id_value = intval(substr($value_id, 1));
        }
        for ($i = 0; $i <= max(array_keys($remaining_menu_items)); $i++) {
            // Check for deleted item
            if (!isset($remaining_menu_items[$i]))
                continue;

            if (isset($id) && (($id_sign == '>' && $remaining_menu_items[$i]["id"] <= $id_value) ||
                               ($id_sign == '<' && $remaining_menu_items[$i]["id"] >= $id_value) ||
                               ($id_sign == '=' && $remaining_menu_items[$i]["id"] != $id_value)))
                continue;  //Not a match - skip item
            if (isset($main_item_id) && (($main_item_id_sign == '>' && $remaining_menu_items[$i]["main_item_id"] <= $main_item_id_value) ||
                                         ($main_item_id_sign == '<' && $remaining_menu_items[$i]["main_item_id"] >= $main_item_id_value) ||
                                         ($main_item_id_sign == '=' && $remaining_menu_items[$i]["main_item_id"] != $main_item_id_value)))
                continue;  //Not a match - skip item
            if (isset($previous_item_id) && (($previous_item_id_sign == '>' && $remaining_menu_items[$i]["previous_item_id"] <= $previous_item_id_value) ||
                                             ($previous_item_id_sign == '<' && $remaining_menu_items[$i]["previous_item_id"] >= $previous_item_id_value) ||
                                             ($previous_item_id_sign == '=' && $remaining_menu_items[$i]["previous_item_id"] != $previous_item_id_value)))
                continue;  //Not a match - skip item
            if (isset($value_id) && (($value_id_sign == '>' && $remaining_menu_items[$i]["value_id"] <= $value_id_value) ||
                                     ($value_id_sign == '<' && $remaining_menu_items[$i]["value_id"] >= $value_id_value) ||
                                     ($value_id_sign == '=' && $remaining_menu_items[$i]["value_id"] != $value_id_value)))
                continue;  //Not match - skip item
            //Match - delete element and exit loop
            $item = $remaining_menu_items[$i];
            unset($remaining_menu_items[$i]);
            return $item;
        }
        return NULL;
    }

    function traverse_tree($item, $current_indexes) {
        /* Traverse_tree creates website structure tree 
         * out of the linked list that is fetched from the MySQL db.
         * The tree can be built from any root, which is
         * set via $item parameter.
         */
        global $active_ids;
        global $page_tree_indexes;
        if (!isset($item)) 
            return NULL;

        $tree_left = array();
        $tree_left[0]["node"] = $item;
        $page_tree_indexes[$item["id"]] = $current_indexes;
        if (in_array($item["id"], $active_ids))
            $tree_left[0]["active"] = true;
        else
            $tree_left[0]["active"] = false;
        // Find first child
        $first_child = find_item(NULL, "=".$item["id"], "=0", NULL);
        if (isset($first_child)) {
            // Find all children
            $tree_left[0]["children"] = traverse_tree($first_child, array_merge($current_indexes, [0]));
        }
        // Find first sibling
        $first_sibling = find_item(NULL, "=".$item["main_item_id"], "=".$item["id"], NULL);
        if (isset($first_sibling)) {
            $current_indexes[count($current_indexes)-1] = $current_indexes[count($current_indexes)-1] + 1;
            // Find all siblings
            $tree = array_merge($tree_left, traverse_tree($first_sibling, $current_indexes));
        }
        else
            $tree = $tree_left;
        return $tree;
    }

    function set_active_ids() {
        /* set_active_ids() takes the active page element and
         * makes all of its parents 'active'. This is to highlight
         * all supercategories of the current page.
         */
        global $page_tree;
        global $active_id;
        global $active_ids;
        global $global_menu_items;
        
        $active_ids = array();
        $active_ids[0] = $active_id;
        if (isset($active_id)) {
            while ($global_menu_items[$active_ids[count($active_ids)-1]]["main_item_id"] != 0)
                $active_ids[] = $global_menu_items[end($active_ids)]["main_item_id"];
            
        }
    }

    function get_tree($id) {
        /* get_tree returns a subtree of the descendants
         * of the node represented by the parameter $id.
         */
        global $page_tree;
        global $page_tree_indexes;
        if (isset($page_tree_indexes[$id][2]))
            return $page_tree[$page_tree_indexes[$id][0]]["children"][$page_tree_indexes[$id][1]]["children"][$page_tree_indexes[$id][2]];
        if (isset($page_tree_indexes[$id][1]))
            return $page_tree[$page_tree_indexes[$id][0]]["children"][$page_tree_indexes[$id][1]];
        if (isset($page_tree_indexes[$id][0]))
            return $page_tree[$page_tree_indexes[$id][0]];
        return [];
    }

    $remaining_menu_items = $global_menu_items;
    
    set_active_ids();

    $root = find_item(">0", "=0", "=0", NULL);
    if (isset($root)) {
        $page_tree = traverse_tree($root, [0]);
    }
?>