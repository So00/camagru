<?php

require __DIR__."/connect.php";

if (!empty($_GET['user']) && htmlspecialchars($_GET['user']) === $_GET['user']) {
    $req = $bdd->prepare('SELECT * FROM users WHERE login = :login');
    $req->bindValue('login', $_GET['user'], PDO::PARAM_STR);
    $req->execute();
    if (!$req->fetch()) {
        echo "OK";
    } else {
        echo "KO";
    }
} else {
    echo "KO";
}
?>