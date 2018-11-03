<?php

/**
 * Add the picture to the db
 */

function add_image($user_id, $img_path, $filters)
{
    include "connect.php";
    $request = $bdd->prepare("INSERT INTO `pictures` VALUES (NULL, :id, :img_path, :filters)");
    $request->bindValue('id', $user_id, PDO::PARAM_INT);
    $request->bindValue('img_path', $img_path, PDO::PARAM_STR);
    $request->bindValue('filters', $filters, PDO::PARAM_STR);
    $request->execute();
}

/**
 * Return the picture ID
 */

function get_img_id($img_path)
{
    include "connect.php";
    $request = $bdd->prepare("SELECT ID FROM `pictures` WHERE img_path=:path");
    $request->bindValue('path', $img_path, PDO::PARAM_STR);
    $request->execute();
    $data = $request->fetch();
    return ($data['ID']);
}