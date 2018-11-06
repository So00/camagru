<?php
require_once "head.php";
require_once "menu.php";
require_once "../controler/get_picture.php";
require_once "show_picture.php";
require_once "../controler/get_comment.php";

if (!empty($_SESSION['login']))
{
    if (empty($_GET["img_id"]))
    {
        $allPicture = get_all_picture($_SESSION['login']);
        if ($allPicture)
            show_all_picture($allPicture, "my_picture");
        else
            echo "<p>It looks like you have no picture</p>";
    }
    else
    {
        $pic = get_picture($_GET["img_id"]);
        if ($pic)
        {
            show_picture($pic, null);
            ?>
                <div class="add_message">
                    <textarea name="message" class="text_area" placeholder="You like it? Leave a message :)"></textarea><br>
                    <button onclick="add_message();">Send</button>
            </div>
                <div class="message_container">
            <?php
            $com = get_comment($_GET["img_id"]);
            foreach ($com as $actCom)
            {
                echo "<div class=\"message\"><h2 class=\"user_id\">".$actCom["login"]."</h2><p class=\"post_hour\">".$actCom["date"]."</p><p>".$actCom["message"]."</p></div>";
            }
            echo "</div>";
        }
        else
            echo "<p>It looks like the id is not valid</p>";
    }
} else {
        echo"<p> You need to be logged in to access this page</p>";
}
require_once "footer.php";
?>