<?php
session_start();

exec("ls ../pictures/".$_SESSION['login']." | cut -d . -f 1 | sort -n | tail -n 1", $ret);
$imgPath = "../pictures/".$_SESSION['login']."/".($ret[0] ? $ret[0] + 1 : 1);

if (!empty($_SESSION['login'])) {
    if (!empty($_POST['picture'])) {
        $imgPath .= ".png";
        $img = $_POST['picture'];
        $img = str_replace('data:image/png;base64,', '', $img);
        $img = str_replace(' ', '+', $img);
        $file = base64_decode($img);
        file_put_contents($imgPath, $file);
        if (exif_imagetype($imgPath)) {
            echo $imgPath;
        } else {
            exec("rm -rf $imgPath");
            echo "$imgPath";
        }
    } else if (!empty($_FILES['picture']) && strstr($_FILES['picture']['type'], 'image')) {
        $file = $_FILES['picture'];
        $type = substr($file['type'], strrpos($file['type'], "/") + 1);
        copy($_FILES['picture']['tmp_name'], $imgPath.".".$type);
        echo $imgPath.".".$type;
    } else {
        echo "KO";
    }
} else {
    echo "KO";
}
?>