<?php

require_once __DIR__."/connect.php";


function get_all_com($img_id)
{
    $bdd = data();
    $request = $bdd->prepare("SELECT * FROM `message` WHERE picture_id=:img_id ORDER BY date DESC");
    $request->bindValue("img_id", $img_id, PDO::PARAM_INT);
    $request->execute();
    while (($act_com = $request->fetch()))
    {
        $act_com["login"] = get_user_login($act_com["user_id"], $bdd);
        $all_com[] = $act_com;
    }
    return (empty($all_com) ? null : $all_com);
}
?>