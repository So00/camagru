<?php
    session_start();
    require_once __DIR__."/../model/create_message.php";
    require_once __DIR__."/../model/picture_function.php";
    require_once __DIR__."/../model/user_function.php";

    if (!empty($_SESSION["login"]))
    {
        if (!empty($_POST["message"]))
        {
            $message = nl2br(htmlspecialchars($_POST["message"]));
            create_message($_SESSION["login"], $message, intval($_POST["img_id"]));
            $user_img_id = get_picture_user_id($_POST["img_id"]);
            $user = get_us_all($user_img_id);
            if (!empty($user["notif"]))
            {
                $headers = "From: \"Camagru\" <welcome@camagru.com>\r\n";
                mail(
                    $user['mail'], "You're getting famous !", "Hello ".$user['login']."<br><br>One of your picture has been commented\n
                <br>To see it, please click on <a style=\"text-decoration: none; color: red;\" href=\"http://{$_SERVER["HTTP_HOST"]}/view/template/gallery.php?img_id=".$_POST["img_id"]."\">this link</a>\nSee you soon :)",
                    $headers
                );
            }
            echo json_encode(array("message" => $message, "login" => $_SESSION["login"], "date" => date("Y-m-d H:i:s")));
        }
        else
            echo "KO";
    }
    else
        echo "KO";
?>