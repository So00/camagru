<?php

require_once __DIR__."/../model/user_function.php";
require_once __DIR__."/common_function.php";

/**
 * Valid each input
 */

function valid_post($act_case)
{
    if (!empty($_POST[$act_case]) && $_POST[$act_case] === htmlspecialchars($_POST[$act_case]))
        return (1);
    $_POST[$act_case] = htmlspecialchars($_POST[$act_case]);
    return (0);
}

/**
 * Answer to the form of account
 */

function form_answer()
{
    if (valid_post("currentPassword"))
    {
        $user = Select_user($_SESSION["login"]);
        $user = $user->fetch();
        $ret = array();
        if ($user["pwd"] === hash("whirlpool", $_POST["currentPassword"]))
        {
            if (valid_post("newMail") && Valid_mail($_POST["newMail"]))
            {
                $mail_exist = get_mail($_POST["newMail"]);
                if (!$mail_exist->fetch())
                {
                    update_field($_SESSION["ID"], "mail", $_POST["newMail"]);
                    $ret["mail"] = "Your mail was changed";
                }
                else
                {
                    $ret["mail"] = "The mail you choosed is already used";
                }
            }
            else if (!empty($_POST["newMail"]))
                $ret["mail"] = $_POST["newMail"]." is not a valid mail";
            if (valid_post("newLogin") && ctype_alnum($_POST["newLogin"]) && strlen($_POST["newLogin"]) > 3 && strlen($_POST["newLogin"]) < 30)
            {
                $login_exist = get_login($_POST["newLogin"]);
                if (!$login_exist->fetch())
                {
                    update_field($_SESSION["ID"], "login", $_POST["newLogin"]);
                    $ret["login"] = "Your login was changed";
                    $_SESSION["login"] = $_POST["newLogin"];
                }
                else
                {
                    $ret["login"] = "The login you choosed is already used";
                }
            }
            else if (!empty($_POST["newLogin"]))
            {
                $ret["login"] = $_POST["newLogin"]." is not a valid login";
            }
            if (valid_post("newPassword"))
            {
                if (validpass($_POST["newPassword"]) && $_POST["newPassword"] === $_POST["newPassword2"])
                {
                    update_field($_SESSION["ID"], "pwd", hash("whirlpool", $_POST["newPassword"]));
                    $ret["pwd"] = "Your password was changed";
                }
                else
                {
                    if ($_POST["newPassword"] !== $_POST["newPassword2"])
                        $ret["password"] = "You didn't type the same password";
                    else
                        $ret["password"] = "Your password is not valid. At lease one lowercase, one uppercase and a number";
                }
            }
            else if (!empty($_POST["newPassword"]))
            {
                $ret["password"] = $_POST["newPassword"]." is not a valid password";
            }
            if (!empty($_POST["notification"]) && $_POST["notification"] === "on")
            {
                update_field($_SESSION["ID"], "notif", 1);
                $ret["notif"] = "Notification are on";
            }
            else
            {
                update_field($_SESSION["ID"], "notif", 0);
                $ret["notif"] = "Notification are off";
            }
            return ($ret);
        }
        else
        {
            return (array("You type a wrong password"));
        }
    }
    if (empty($_POST["currentPassword"]))
        return (array("You have to fill your actual password"));
    return (array("You can't have specials chars in password"));
}
?>