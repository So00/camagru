<?php

require "user_function.php";

/**
 * Get all the picture from a user
 */

function get_all_pic($login)
{
    include_once "connect.php";
    $id = get_user_id($login, $bdd);
    $request = $bdd->prepare("SELECT * FROM pictures WHERE user_id=:id");
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
    include_once "connect.php";
    $request = $bdd->prepare("SELECT * FROM pictures WHERE ID=:id");
    $request->bindValue("id", $id, PDO::PARAM_INT);
    $request->execute();
    $img = $request->fetch();
    return ($img);
}
?>