<?php

require_once __DIR__."/connect.php";

/**
 * Search if the id already like it and update
 */

    function update_like($img_id, $likes)
    {
        $bdd = data();
        $req = $bdd->prepare("UPDATE `pictures` SET likes=:likes WHERE ID=:id");
        $req->bindValue("id", $img_id, PDO::PARAM_INT);
        $req->bindValue("likes", $likes, PDO::PARAM_STR);
        $req->execute();
    }
?>