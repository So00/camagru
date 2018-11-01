<?php

function add_image($user_id, $img_path)
{
    include "connect.php";
    $request = $bdd->prepare("INSERT INTO `pictures` VALUES (NULL, :id, :img_path)");
    $request->bindValue('id', $user_id, PDO::PARAM_INT);
    $request->bindValue('img_path', $img_path, PDO::PARAM_STR);
    $request->execute();
}

function get_img_id($img_path)
{
    include "connect.php";
    $request = $bdd->prepare("SELECT ID FROM `pictures` WHERE img_path=:path");
    $request->bindValue('path', $img_path, PDO::PARAM_STR);
    $request->execute();
    $data = $request->fetch();
    return ($data['ID']);
}

function add_filter($img_id, $filter)
{
    include "connect.php";
    $request = $bdd->prepare("INSERT INTO `filter` VALUES (:img_id, :filter_path, :width, :pos_top, :pos_left, :rotate)");
    $request->bindValue("img_id", $img_id, PDO::PARAM_INT);
    $request->bindValue("filter_path", $filter['img'], PDO::PARAM_STR);
    $request->bindValue("width", $filter['width'], PDO::PARAM_STR);
    $request->bindValue("pos_top", $filter['yPos'], PDO::PARAM_STR);
    $request->bindValue("pos_left", $filter['xPos'], PDO::PARAM_STR);
    $request->bindValue("rotate", "0", PDO::PARAM_STR);
    $request->execute();
}