<link rel="stylesheet" type="text/css" href="css/catalogue.css">
<div id="title_block">
    <div id="title">
    <?php
        include "render_title.php";
    ?>
    </div>
</div>
<div id="content_block">
    <div id="text">
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Each catalogue can have its own description - a short introductory text
        describing the content. The blocks below represent subpages and have either solid color background or thumbnails.
    </div>
    <?php
        include "render_catalogue.php";
    ?>
</div>
