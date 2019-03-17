<?php

    require_once __DIR__."/user_function.php";
    require_once __DIR__."/connect.php";

    function create_message($login, $message, $img_id)
    {
        $bdd = data();
        $id = get_user_id($login, $bdd);
        $request = $bdd->prepare("INSERT INTO `message` VALUES (NULL, :message, :id, :imgId, NOW())");
        $request->bindValue("message", $message, PDO::PARAM_STR);
        $request->bindValue("id", $id, PDO::PARAM_INT);
        $request->bindValue("imgId", $img_id, PDO::PARAM_INT);
        $request->execute();
    }
?>