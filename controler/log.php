<?php

require __DIR__."/../model/user_function.php";

/**
 *  Logout or display error message 
*/

function logout() {
    if (isset($_SESSION['login'])) {
        unset($_SESSION);
        session_destroy();
        $message = "<br><span class=\"logout\">You're now logout</span>";
    } else {
        $message= "<br><span class=\"logout\">You have no active account</span>";
    }
    return ($message);
}

/**
 * Login function
 */

function login()
{
    if (!empty($_POST['login']) && !empty($_POST['pwd'])) {
        $login = htmlspecialchars($_POST['login']);
        $pwd = htmlspecialchars($_POST['pwd']);
        $data = Select_user($login);
        $data = $data->fetch();
        if ($data === false) {
            $message = "Your account does not exist";
        } else {
            if ($data['valid'] === "1") {
                if (hash("whirlpool", $pwd) === $data['pwd']) {
                    $_SESSION['login'] = $login;
                    $_SESSION['ID'] = $data['ID'];
                    $message = "You're now logged in";
                } else {
                    $message = "Your password was wrong";
                }
            } else {
                $message = "You need to validate your account first";
            }
        }
    } else if (!$_SESSION['login']) {
        $message = "You didn't full all the field";
    } else {
        $message = "You are already logged in";
    }
    return ($message);
}
?>