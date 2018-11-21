<?php
    
require_once __DIR__."/get_picture.php";


function change_post($pic)
{
    include __DIR__."/connect.php";
    $change_post = $bdd->prepare("UPDATE `pictures` SET posted=:valu WHERE ID=:id");
    $change_post->bindValue("id", $pic["ID"], PDO::PARAM_INT);
    $change_post->bindValue("valu", ($pic["posted"] === null ? 1 : null), PDO::PARAM_INT);
    $change_post->execute();
}

?>