<?php

/**
 * The part where you take picture
 */

require "head.php";
require "menu.php";

if (!empty($_SESSION['login'])) { ?>
    <div id="main">
        <div id="takePicMain">
            <div id="vidContainer">
                <video id="sourcevid" height='150' width='150' autoplay="true"></video>
            </div>
            <br><button onclick='clone()' style='height:50px;width:80px;margin:auto'>Picture</button>
            <form action="../../controler/add_picture_ajax.php" method="post" id="upload_pic" enctype="multipart/form-data">
                <input type="file" name="upload_pic" id="picData"/>
                <button type="submit" value="send" id="send">
            </form>
        </div>
        <div id="filter">
            <?php $allFilter = scandir("../../filters");
            foreach ($allFilter as $actFilter) {
                if ($actFilter[0] != ".") {?>
                <div class="filter"><img src="../../filters/<?= $actFilter; ?>"></div>
            <?php }} ?>
        </div>
    </div>
<script type="text/javascript" src="../js/takingPic.js"></script>
<script type="text/javascript" src="../js/filter.js"></script>

<div id="picTaken"></div>
<?php } else { ?>
    <div class="answer">You need to be looged in to use this feature</div>
<?php }

require "footer.php";
?>