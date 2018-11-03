<?php
function get_all_pic($login)
{
    require_once "connect.php";
    require_once "user_function.php";
    $id = get_user_id($login, $bdd);
    $request = $bdd->prepare("SELECT * FROM pictures WHERE user_id=:id");
    $request->bindValue("id", $id, PDO::PARAM_INT);
    $request->execute();
    while (($actData = $request->fetch()))
        $data[] = $actData;
    return ($data);
}
?>