<?php
require __DIR__."/head.php";
require __DIR__."/menu.php";
require __DIR__."/../../controler/get_picture.php";
require __DIR__."/../element/show_picture.php";
require __DIR__."/../element/show_message.php";
require __DIR__."/../../controler/get_comment.php";

if (!empty($_SESSION['login']))
{ ?>
<?php
    if (empty($_GET["img_id"]))
    {
        $allPicture = get_all_login_picture($_SESSION['login']);
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
            $all_com = get_comment($_GET["img_id"]);
            show_all_message($all_com);
            echo "</div>";
        }
        else
            echo "<p>It looks like the id is not valid</p>";
    }
    ?>
    <script type="text/javascript" src="../js/delete_picture.js"></script>
    <script type="text/javascript" src="../js/add_message.js"></script>
    <?php
} else {
        echo"<p> You need to be logged in to access this page</p>";
}
require __DIR__."/footer.php";
?>