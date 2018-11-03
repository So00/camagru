<?php
    function get_user_id($login, $bdd)
    {
        require_once "connect.php";
        $request = $bdd->prepare("SELECT ID FROM users WHERE login=:loged");
        $request->bindValue("loged", $login, PDO::PARAM_STR);
        $request->execute();
        $data = $request->fetch();
        if ($data != null)
            return ($data["ID"]);
        return (null);
    }
?>