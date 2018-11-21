<?php
    session_start();
    require __DIR__."/../model/change_post.php";
    require_once __DIR__."/../model/get_picture.php";

    if (!empty($_POST["img_id"]) && htmlspecialchars($_POST["img_id"]) === $_POST["img_id"])
    {
        $pic = get_pic($_POST["img_id"]);
        if ($_SESSION["ID"] === $pic["user_id"])
        {
            change_post($pic);
            echo "OK";
        }
        else
            echo "KO";
    }
    else
        echo "KO";
?>