<?php

    /**
     * Ajax request to delete the picture
     */
    
    session_start();
    
    require __DIR__."/../model/delete_image.php";
    require __DIR__."/../model/create_image.php";
    require __DIR__."/common_function.php";

    if (!empty($_SESSION['login'])) {
        if (!empty($_POST['picture']) && get_picture_user_id(intval($_POST["picture"])) === get_id_user($_SESSION["login"], $bdd)) {
            /**
             * delete the picture from db
             */
            delete_picture(intval($_POST["picture"]));
            echo $_POST["picture"];
        } else {
            echo "Mistake were made. It's not your picture ".get_picture_user_id(intval($_POST["picture"]));
        }
    }
?>