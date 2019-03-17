<?php
    session_start();
    require __DIR__."/../model/create_message.php";

    if (!empty($_SESSION["login"]))
    {
        if (!empty($_POST["message"]))
        {
            $message = nl2br(htmlspecialchars($_POST["message"]));
            create_message($_SESSION["login"], $message, intval($_POST["img_id"]));
            echo json_encode(array("message" => $message, "login" => $_SESSION["login"], "date" => date("Y-m-d H:i:s")));
        }
        else
            echo "KO";
    }
    else
        echo "KO";
?>