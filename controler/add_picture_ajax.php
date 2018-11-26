<?php

/**
 * Ajax request to add the picture
 */

session_start();

require_once __DIR__."/../model/picture_function.php";
require_once __DIR__."/../model/user_function.php";

exec("ls ../pictures/".$_SESSION['login']." | cut -d . -f 1 | sort -n | tail -n 1", $ret);
$imgPath = "../pictures/".$_SESSION['login']."/".($ret[0] ? $ret[0] + 1 : 1);

if (!empty($_SESSION['login']) && !empty($_POST["filters"])) {
    if (!empty($_POST['picture'])) {
        /**
         * add the picture to db
         */
        $imgPath .= ".png";
        $img = $_POST['picture'];
        $img = str_replace('data:image/png;base64,', '', $img);
        $img = str_replace(' ', '+', $img);
        $file = base64_decode($img);
        file_put_contents($imgPath, $file);
        /* need to add filter */
        $filters = $_POST["filters"];
        if (exif_imagetype($imgPath)) {
            $dataUser = Select_user($_SESSION['login']);
            $user = $dataUser->fetch();
            add_image($user['ID'], $imgPath, $filters);
            $img_id = get_img_id($imgPath);
            echo $imgPath."&".$img_id."&".$filters;
        } else {
            exec("rm -rf $imgPath");
            echo "KO";
        }
    } else if (!empty($_FILES['picture']) && strstr($_FILES['picture']['type'], 'image')) {
        /**
         * Add the file to the db
         */
        $file = $_FILES['picture'];
        $type = substr($file['type'], strrpos($file['type'], "/") + 1);
        $imgPath .= ".".$type;
        $dataUser = Select_user($_SESSION['login']);
        $user = $dataUser->fetch();
        copy($_FILES['picture']['tmp_name'], $imgPath);
        add_image($user['ID'], $imgPath, $_POST["filters"]);
        $img_id = get_img_id($imgPath);
        echo $imgPath."&".$img_id."&".$_POST["filters"];
    } else {
        echo "KO";
    }
} else {
    echo "KO";
}
?>