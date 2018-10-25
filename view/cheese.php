<?php
require_once "head.php";
require_once "menu.php";

if ($_SESSION['login']) { ?>
    <div id="main">
        <div id="takePicMain">
            <div id="vidContainer">
                <video id="sourcevid" height='150' width='150' autoplay="true"></video>
            </div>
            <br><button onclick='clone()' style='height:50px;width:80px;margin:auto'>Picture</button>
            <form action="../controler/add_picture_ajax.php" method="post" id="upload_pic" enctype="multipart/form-data">
                <input type="file" name="upload_pic" id="picData"/>
                <button type="submit" value="send" id="send">
            </form>
        </div>
        <div id="filter">
            <div class="filter"><img src="../pictures/unicorn.png" width="50" height="70"></div>
        </div>
    </div>
<script type="text/javascript" src="./js/takingPic.js"></script>

<div id="picTaken"></div>
<?php } else { ?>
    <span class="answer">You need to be looged in to use this feature</span>
<?php }

require_once "footer.php";
?>