<?php

require_once __DIR__."/user_function.php";

/**
 * Get all picture
 */

function get_all_pic($login)
{
    include __DIR__."/connect.php";
    $id = get_user_id($login, $bdd);
    $request = $bdd->prepare("SELECT * FROM pictures ORDER BY date DESC");
    $request->bindValue("id", $id, PDO::PARAM_INT);
    $request->execute();
    while (($actData = $request->fetch()))
        $data[] = $actData;
    return ($data);
}

/**
 * Get all the picture from a user
 */

function get_all_login_pic($login)
{
    include __DIR__."/connect.php";
    $id = get_user_id($login, $bdd);
    $request = $bdd->prepare("SELECT * FROM pictures WHERE user_id=:id ORDER BY date DESC");
    $request->bindValue("id", $id, PDO::PARAM_INT);
    $request->execute();
    while (($actData = $request->fetch()))
        $data[] = $actData;
    return ($data);
}

/**
 * Get one picture
 */

function get_pic($id)
{
    include __DIR__."/connect.php";
    $request = $bdd->prepare("SELECT * FROM pictures WHERE ID=:id");
    $request->bindValue("id", $id, PDO::PARAM_INT);
    $request->execute();
    $img = $request->fetch();
    return ($img);
}
?>