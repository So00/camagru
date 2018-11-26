<?php

require_once __DIR__ . "/connect.php";
require_once __DIR__."/user_function.php";

/**
 * Add the picture to the db
 */

function add_image($user_id, $img_path, $filters)
{
    $bdd = data();
    $request = $bdd->prepare("INSERT INTO `pictures` VALUES (NULL, :id, :img_path, :filters, NULL, 0, NOW())");
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
    $bdd = data();
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
    $bdd = data();
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
    $bdd = data();
    $request = $bdd->prepare("SELECT * FROM `pictures` WHERE ID=:id");
    $request->bindValue('id', $id, PDO::PARAM_INT);
    $request->execute();
    $data = $request->fetch();
    return (empty($data["user_id"]) ? null : $data["user_id"]);
}

/**
 * Function made to delete a picture
 */

function delete_picture($img_id)
{
    $bdd = data();
    $request = $bdd->prepare("DELETE FROM `pictures` WHERE ID=:id");
    $request->bindValue("id", $img_id, PDO::PARAM_INT);
    $request->execute();
    $delete_img = $bdd->prepare("DELETE FROM `message` WHERE picture_id=:id");
    $delete_img->bindValue("id", $img_id, PDO::PARAM_INT);
    $delete_img->execute();
}

/**
 * Get all picture
 */

function get_all_pic()
{
    $bdd = data();
    $request = $bdd->prepare("SELECT * FROM pictures ORDER BY date DESC");
    $request->execute();
    while (($actData = $request->fetch()))
        $data[] = $actData;
    return (empty($data) ? null : $data);
}

/**
 * Get all the picture from a user
 */

function get_all_login_pic($login)
{
    $bdd = data();
    $id = get_user_id($login, $bdd);
    $request = $bdd->prepare("SELECT * FROM pictures WHERE user_id=:id ORDER BY date DESC");
    $request->bindValue("id", $id, PDO::PARAM_INT);
    $request->execute();
    while (($actData = $request->fetch()))
        $data[] = $actData;
    return (empty($data) ? null : $data);
}

/**
 * Get one picture
 */

function get_pic($id)
{
    $bdd = data();
    $request = $bdd->prepare("SELECT * FROM pictures WHERE ID=:id");
    $request->bindValue("id", $id, PDO::PARAM_INT);
    $request->execute();
    $img = $request->fetch();
    return ($img);
}

?>