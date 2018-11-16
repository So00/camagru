<?php


/**
 * Add the picture to the db
 */

function add_image($user_id, $img_path, $filters)
{
    require_once __DIR__."/connect.php";
    $request = $bdd->prepare("INSERT INTO `pictures` VALUES (NULL, :id, :img_path, :filters, NOW())");
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
    require_once __DIR__."/connect.php";
    $request = $bdd->prepare("SELECT ID FROM `pictures` WHERE img_path=:path");
    $request->bindValue('path', $img_path, PDO::PARAM_STR);
    $request->execute();
    $data = $request->fetch();
    return ($data['ID']);
}

/**
 * Return the path of an image
 */

function get_img_path($id)
{
    require_once __DIR__."/connect.php";
    $request = $bdd->prepare("SELECT * FROM `pictures` WHERE ID=:id");
    $request->bindValue('id', $id, PDO::PARAM_INT);
    $request->execute();
    $data = $request->fetch();
    return ($data['img_path']);
}

/**
 * Return the user id of a picture
 */

function get_picture_user_id($id)
{
    include __DIR__."/connect.php";
    $request = $bdd->prepare("SELECT * FROM `pictures` WHERE ID=:id");
    $request->bindValue('id', $id, PDO::PARAM_INT);
    $request->execute();
    $data = $request->fetch();
    return ($data["user_id"]);
}