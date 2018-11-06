<?php
    function create_message($login, $message, $img_id)
    {
        include "connect.php";
        include "user_function.php";
        $id = get_user_id($login, $bdd);
        $request = $bdd->prepare("INSERT INTO `message` VALUES (NULL, :message, :id, :imgId, NOW())");
        $request->bindValue("message", $message, PDO::PARAM_STR);
        $request->bindValue("id", $id, PDO::PARAM_INT);
        $request->bindValue("imgId", $img_id, PDO::PARAM_INT);
        $request->execute();
    }
?>