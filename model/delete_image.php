<?php
    /**
     * Function made to delete a picture
     */

    function delete_picture($img_id)
    {
        include __DIR__."/connect.php";
        $request = $bdd->prepare("DELETE FROM `pictures` WHERE ID=:id");
        $request->bindValue("id", $img_id, PDO::PARAM_INT);
        $request->execute();
        $delete_img = $bdd->prepare("DELETE FROM `message` WHERE picture_id=:id");
        $delete_img->bindValue("id", $img_id, PDO::PARAM_INT);
        $delete->execute();
    }
?>