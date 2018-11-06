<?php
function get_user_id($login, $bdd)
{
    $request = $bdd->prepare("SELECT ID FROM users WHERE login=:loged");
    $request->bindValue("loged", $login, PDO::PARAM_STR);
    $request->execute();
    $data = $request->fetch();
    if ($data != null)
        return ($data["ID"]);
    return (null);
}

function get_user_login($id, $bdd)
{
    $request = $bdd->prepare("SELECT login FROM users WHERE ID=:id");
    $request->bindValue("id", $id, PDO::PARAM_INT);
    $request->execute();
    $data = $request->fetch();
    if ($data != null)
        return ($data["login"]);
    return (null);
}
?>