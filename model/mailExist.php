<?php

require __DIR__."/all_model.php";

if (!empty($_GET['mail']) && htmlspecialchars($_GET['mail']) === $_GET['mail']) {
    $req = $bdd->prepare('SELECT * FROM users WHERE mail = :mail');
    $req->bindValue('mail', $_GET['mail'], PDO::PARAM_STR);
    $req->execute();
    if (!$req->fetch()) {
        echo "OK";
    } else {
        echo "KO";
    }
}
?>