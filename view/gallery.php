<?php
require_once "head.php";
require_once "menu.php";
require_once "../controler/get_picture.php";
require_once "show_picture.php";
require_once "../controler/get_comment.php";

if (!empty($_SESSION["login"])) { ?>
<script type="text/javascript" src="./js/add_message.js"></script>
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
        $com = get_comment($_GET["img_id"]);
        foreach ($com as $actCom)
        {
            echo "<div class=\"message\"><h2 class=\"user_id\">".$actCom["login"]."</h2><p class=\"post_hour\">".$actCom["date"]."</p><p>".$actCom["message"]."</p></div>";
        }
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