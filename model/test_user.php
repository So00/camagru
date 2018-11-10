<?php

/*
 * Is user or mail in db
*/

function No_duplicate($user)
{
    include __DIR__."/connect.php";
    $error = null;
    $answer_mail = $bdd->prepare("SELECT * FROM users WHERE mail = :mail;");
    $answer_mail->bindValue('mail', $user['mail'], PDO::PARAM_STR);
    $answer_mail->execute();
    $answer_login = $bdd->prepare("SELECT * FROM users WHERE login = :login");
    $answer_login->bindValue('login', $user['login'], PDO::PARAM_STR);
    $answer_login->execute();
    if ($answer_login->fetch()) {
        $error = "login";
    } else if ($answer_mail->fetch()) {
        $error = "mail";
    }
    if (!$error) {
        return (1);
    }
    echo ("<p>".$user[$error]." exists. Please, change your $error<br>");
    return (0);
}

/**
 * Is the user in db
 */
function Select_user($user)
{
    include __DIR__."/connect.php";
    $data = $bdd->prepare("SELECT * FROM users WHERE login = :login;");
    $data->bindValue('login', $user, PDO::PARAM_STR);
    $data->execute();
    return ($data);
}

?>