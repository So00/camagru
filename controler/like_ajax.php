<?php
    session_start();
    require __DIR__."/../model/create_message.php";
    require __DIR__."/../model/update_like.php";
    require_once __DIR__."/get_picture.php";

    if (!empty($_SESSION["login"]))
    {
        if (!empty($_POST["img_id"]))
        {
            $img = get_picture($_POST["img_id"]);
            if ($img["likes"] === "0")
            {
                $actLike = array($_SESSION["ID"] => 1);
                update_like($_POST["img_id"], json_encode($actLike));
                echo json_encode(array("nb_like" => 1));
            }
            else
            {
                $actLike = json_decode($img["likes"], true);
                if (empty($actLike[$_SESSION["ID"]]) || $actLike[$_SESSION["ID"]] === 0)
                    $actLike[$_SESSION["ID"]] = 1;
                else
                    $actLike[$_SESSION["ID"]] = 0;
                update_like($_POST["img_id"], json_encode($actLike));
                $count = array_count_values($actLike);
                echo json_encode(array(
                    "nb_like" => ((empty($count[1])) ? 0 : $count[1]))
                );
            }
        }
        else
            echo "KO";
    }
    else
        echo "KO";
?>