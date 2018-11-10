<?php
require "head.php";
require "menu.php";
require "../../controler/get_picture.php";
require "../element/show_picture.php";
require "../element/show_message.php";
require "../../controler/get_comment.php";

if (!empty($_SESSION["login"])) { ?>
<script type="text/javascript" src="../js/add_message.js"></script>
    <?php
}

if (!empty($_GET["img_id"]))
{
    $pic = get_picture($_GET["img_id"]);
    if (!$pic)
        echo "<p>No such image :/ sorry</p>";
    else
    {
        show_picture($pic, null);
        if (!empty($_SESSION["login"]))
        { ?>
            <div class="add_message">
                <textarea name="message" class="text_area" placeholder="You like it? Leave a message :)"></textarea><br>
                <button onclick="add_message();">Send</button>
        </div> <?php } ?>
            <div class="message_container">
        <?php
        $all_com = get_comment($_GET["img_id"]);
        show_all_message($all_com);
        echo "</div>";
    }
}
else if (!empty($_GET["login"]))
{
    $allPicture = get_all_picture($_GET["login"]);
    show_all_picture($allPicture, "gallery");
}
else
{
    /**
     * Basic work
     */
}

require_once "footer.php";
?>