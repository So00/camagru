<?php
require __DIR__."/head.php";
require __DIR__."/menu.php";
require __DIR__."/../../controler/get_picture.php";
require __DIR__."/../element/show_picture.php";
require __DIR__."/../element/show_message.php";
require __DIR__."/../../controler/get_comment.php";

if (!empty($_SESSION["login"])) { ?>
<script type="text/javascript" src="../js/add_message.js"></script>
    <?php

}

if (!empty($_GET["img_id"])) {
    /**
     * Get one picture
     */
    $pic = get_picture($_GET["img_id"]);
    if (!$pic)
        echo "<p>No such image :/ sorry</p>";
    else {
        if ($pic["posted"] === null)
            echo "<p>This picture is not visible for now</p>";
        else {
            show_picture($pic, null, 0);
            if (!empty($_SESSION["login"])) { ?>
            <div class="add_message">
                <textarea name="message" class="text_area" placeholder="You like it? Leave a message :)"></textarea><br>
                <button onclick="add_message();">Send</button>
            </div> <?php 
                } ?>
                <div class="message_container">
            <?php
            $all_com = get_comment($_GET["img_id"]);
            show_all_message($all_com);
            echo "</div>";
        }
}
} else if (!empty($_GET["login"])) {
    /**
     * Get all picture from a login
     */
    $allPicture = get_all_login_picture($_GET["login"]);
    show_all_picture($allPicture, "gallery", 0);
} else {
    /**
     * Get all picture
     */
    $all_picture = get_all_pic();
    show_all_picture($all_picture, "gallery", 0);
}
?>
<script type="text/javascript" src="../js/like.js"></script>
<?php
require "footer.php";
?>