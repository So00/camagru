<?php

    /**
     * Ajax request to delete the picture
     */
    
    session_start();
    
    require_once __DIR__."/../model/picture_function.php";
    require_once __DIR__."/common_function.php";

    if (!empty($_SESSION['login'])) {
        if (!empty($_POST['picture']) && get_picture_user_id(intval($_POST["picture"])) === get_id_user($_SESSION["login"])) {
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