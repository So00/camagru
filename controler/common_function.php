<?php

require_once __DIR__ . "/../model/user_function.php";

/**
 * Get the id from a user login
 */

function get_id_user($login)
{
    return (get_user_id($login));
}

/**
 * Check if the mail is valid
 */

function Valid_mail($mail)
{
    if (!filter_var($mail, FILTER_VALIDATE_EMAIL)) {
        return (0);
    }
    return (1);
}

/**
 * Check password strengh and length
 */
function validpass($pwd)
{
    $min = $maj = $numb = 0;
    $len = strlen($pwd);
    for ($i = 0; $i < $len; $i++) {
        if ($pwd[$i] >= 'a' && $pwd[$i] <= 'z') {
            $min = 1;
        } else if ($pwd[$i] >= 'A' && $pwd[$i] <= 'Z') {
            $maj = 1;
        } else if ($pwd[$i] >= '0' && $pwd[$i] <= '9') {
            $numb = 1;
        }
    }
    if ($min && $maj && $numb && $len >= 8 && $len <= 254) {
        return (1);
    }
    return (0);
}
?>