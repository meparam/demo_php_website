<script type="text/javascript">
    var singleOpacityInterval;
    var slideshowInterval;
    var pics = ["slideshow_pic1", "slideshow_pic2", "slideshow_pic3"];
    var new_pic = 0;
    var previous_pic = 0;
    var current_opacity;

    function change_opacity(direction) {
        // This function is called on a schedule.
        window.current_opacity = window.current_opacity + 0.003*direction;
        document.getElementById(window.pics[window.previous_pic]).style.opacity = window.current_opacity;
        if (window.current_opacity <= 0) {
            clearInterval(window.singleOpacityInterval);
            document.getElementById(window.pics[window.previous_pic]).style.visibility = "hidden";
            document.getElementById(window.pics[window.previous_pic]).style.opacity = "1";
            document.getElementById(window.pics[window.previous_pic]).style.zIndex = "0";
            document.getElementById(window.pics[window.new_pic]).style.zIndex = "1";
        }
    }

    function slideshowProgress() {
        // Fade in the new picture.
        window.previous_pic = window.new_pic;
        if (window.new_pic == window.pics.length - 1)
            window.new_pic = 0;
        else
            window.new_pic += 1;
        document.getElementById(window.pics[window.previous_pic]).style.opacity = "1";
        document.getElementById(window.pics[window.new_pic]).style.opacity = "1";
        document.getElementById(window.pics[window.new_pic]).style.visibility = "visible";
        window.current_opacity = parseInt(window.getComputedStyle(document.getElementById(pics[new_pic]), null).getPropertyValue("opacity"));
        window.singleOpacityInterval = setInterval(function(){change_opacity(-1);}, 5);
    }
    function onLoadCodePageSpecific() {
        // Schedule slideshowProgress() to be run each 10 seconds
        window.slideshowInterval = setInterval(function(){slideshowProgress();}, 10000);
    }
</script>
<link rel="stylesheet" type="text/css" href="css/main.css">
<div id="main_background">
    <img id="slideshow_pic1" src="img/main_slideshow1.jpg" width="1280" height="544" style="visibility: visible; z-index: 1">
    <img id="slideshow_pic2" src="img/main_slideshow2.jpg" width="1280" height="544" style="visibility: hidden;  z-index: 0">
    <img id="slideshow_pic3" src="img/main_slideshow3.jpg" width="1280" height="544" style="visibility: hidden;  z-index: 0">
</div>
<div id="title_block">
    <div id="title">Welcome to this demo</div
></div
><div id="content_block">
    <div id="text">
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Photos do not belong to this website owner and are used only for testing purposes.
        <br>
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed euismod, augue id ultricies eleifend, libero lectus mattis est, eu suscipit nisi mi eleifend nibh. Fusce arcu leo, placerat sed luctus mattis, viverra in dui. Morbi velit risus, aliquam aliquam interdum venenatis, imperdiet ac sem. Suspendisse elementum pellentesque odio ac scelerisque. Morbi semper feugiat purus vel condimentum. Etiam dictum dictum viverra. Proin nec finibus neque.
        <br>
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Sed facilisis magna a laoreet dignissim. Nam a egestas turpis. In fringilla magna sit amet luctus lobortis. Vestibulum bibendum, magna ut finibus maximus, ipsum nulla feugiat arcu, et condimentum urna lorem sed lectus. Sed ornare sed mauris sed aliquam. Nullam mattis condimentum elit non vestibulum. Sed vel molestie arcu. Fusce enim sem, vulputate ac porttitor quis, volutpat et dolor.
    </div>
    <?php
        /*include "linkblock.php";
        render_block("3", "block1", "left", "firstrow", "threecol");
        render_block("4", "block2", "center", "firstrow", "threecol");
        render_block("5", "block3", "right", "firstrow", "threecol");
        render_block("6", "block4", "left", "", "threecol");
        render_block("7", "block1", "center", "", "threecol");*/
    ?>
    <div id="brief_blocks">
        <div class="brief left" id="brief1">
            <div class="title">
                <div class="text">
                    News
                </div>
            </div>
            <div class="text">
                <div class="date">01.01.2014</div>: Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                <br>
                <div class="date">20.02.2013</div>: Sed facilisis magna a laoreet dignissim. Nam a egestas turpis. In fringilla magna sit amet luctus lobortis.
                <br>
                <div class="date">07.01.2013</div>: Sed eget nunc id sem placerat molestie. Proin iaculis felis non odio scelerisque, et fringilla nunc blandit. Morbi lacinia efficitur quam. Pellentesque vel dictum lorem, ut ornare elit.
            </div>
        </div>
        <div class="brief right" id="brief2">
            <div class="title">
                <div class="text">
                    Praesent quis mauris
                </div>
            </div>
            <div class="text">
                Praesent quis mauris et est varius dapibus sit amet sit amet felis. Ut tincidunt in sapien quis rhoncus. In non felis metus. Nulla leo erat, luctus vel feugiat eget, convallis vitae ligula. In ultricies sollicitudin hendrerit. Aenean tempus bibendum lacus vitae condimentum. Maecenas ut tortor a erat dignissim laoreet quis vitae orci. Nam nec nibh eget odio bibendum tristique nec et nunc.
            </div>
            <div class="readmore">
                <a href="index.php?pgid=23">Read more about praesent quis mauris</a>
                <span class="arrow">&#9654;</span><br>
                <a href="index.php?pgid=21">Read more about varius dapibus</a>
                <span class="arrow">&#9654;</span>
            </div>
        </div>
        <div class="brief left" id="brief3">
            <div class="title">
                <div class="text">
                    Vivamus pulvinar lectus
                </div>
            </div>
            <div class="text">
                Vivamus pulvinar lectus a gravida ornare. Ut quis tellus ipsum. In in nisl porta, commodo ex sollicitudin, tempor libero. Vivamus luctus purus et dolor lacinia, non tristique dui sagittis. Vivamus quis posuere ipsum, ac ullamcorper ante. Nulla sed molestie sapien, ut fringilla elit. Nunc bibendum ex ipsum.
            </div>
            <div class="readmore">
                <a href="index.php?pgid=22">Read more about vivamus pulvinar lectus</a>
                <span class="arrow">&#9654;</span>
            </div>
        </div>
        <div class="brief right" id="brief4">
            <div class="title">
                <div class="text">
                    Mauris ac ante id
                </div>
            </div>
            <div class="text">
                Mauris ac ante id justo fringilla lacinia. Vestibulum maximus egestas congue. In sodales risus quis neque cursus laoreet. Vestibulum ornare interdum sem sed sagittis. In euismod, velit vitae aliquet aliquet, lectus velit hendrerit ligula, eget bibendum eros sapien vitae erat.
            </div>
            <div class="readmore">
                <a href="index.php?pgid=5">Read more about mauris ac ante id</a>
                <span class="arrow">&#9654;</span><br>
                <a href="index.php?pgid=4">Read more about Vestibulum maximus</a>
                <span class="arrow">&#9654;</span>
            </div>
        </div>
        <div class="brief left" id="brief5">
            <div class="title">
                <div class="text">
                    Vestibulum aliquam
                </div>
            </div>
            <div class="text">
                Vestibulum aliquam, lectus placerat maximus feugiat, dui risus posuere nibh, quis viverra arcu est vel lectus. Vivamus consequat laoreet nibh, nec sagittis dui finibus sed. Aliquam erat volutpat. Nullam bibendum cursus orci posuere sodales. Mauris vitae urna in orci scelerisque vulputate id non enim. 
            </div>
            <div class="readmore">
                <a href="index.php?pgid=3">Read more about vestibulum aliquam</a>
                <span class="arrow">&#9654;</span>
            </div>
        </div>
        <div class="brief right" id="brief6">
            <div class="title">
                <div class="text">
                    Sed eget nunc id
                </div>
            </div>
            <div class="text">
                Sed eget nunc id sem placerat molestie. Proin iaculis felis non odio scelerisque, et fringilla nunc blandit. Morbi lacinia efficitur quam. Pellentesque vel dictum lorem, ut ornare elit. Nunc in odio a eros hendrerit pulvinar. Integer vehicula nisi at urna vestibulum, eget ultrices eros hendrerit. Nam feugiat sagittis eros, nec efficitur risus commodo lobortis. Maecenas non libero justo.
            </div>
        </div>
    </div>

    <div id="contact_button_block">
        <a href="mailto:website@owner.com?subject=Contact form&body=Name: %0D%0A%0D%0ASurname: %0D%0A%0D%0AAddress: %0D%0A%0D%0AMessage:%0D%0A">
            <div id="contact_button">
                Contact us
            </div>
            <div class="hover-layer"></div>
        </a>
    </div>

    <div id="partners" class="info_block">
        <h2>Our partners</h2>
        <table id="twocol-table">
            <tr>
                <td width="20%"><li>Proin iaculis</li></td>
                <td>Sed eget nunc id sem placerat molestie</td>
            </tr>
            <tr>
                <td><li>Pellentesque</li></td>
                <td>Pellentesque vel dictum lorem, ut ornare elit</td>
            </tr>
            <tr>
                <td><li>Praesent</li></td>
                <td>Praesent quis mauris et est varius dapibus sit amet sit amet felis</td>
            </tr>
            <tr>
                <td><li>Vivamus</li></td>
                <td>Vivamus pulvinar lectus a gravida ornare</td>
            </tr>
            <tr>
                <td><li>Pellentesque</li></td>
                <td>Pellentesque vel dictum lorem, ut ornare elit</td>
            </tr>
            <tr>
                <td><li>Praesent</li></td>
                <td>Praesent quis mauris et est varius dapibus sit amet sit amet felis</td>
            </tr>
            <tr>
                <td><li>Vivamus</li></td>
                <td>Vivamus pulvinar lectus a gravida ornare</td>
            </tr>
        </table>
    </div>

    <div id="our_location" class="info_block">
        <h2>Company address</h2>
        <table id="twocol-table">
            <tr>
                <td width="400">
                    <iframe width="600" height="450" frameborder="0" style="border:0"
                    src="https://www.google.com/maps/embed/v1/place?q=London&key=<api_key>"></iframe>
                </td>
                <td style="padding-left: 24px; padding-top: 16px">
                    City Street 21
                    <br>London
                    <br>United Kingdom
                    <br><br><a href="tel:+12 34 567 89 01">+12 34 567 89 01</a><br>
                    <a href="mailto:website@owner.com">website@owner.com</a>
                </td>
            </tr>
        </table>
    </div>
</div>