<?php

require __DIR__ . "/../model/get_picture.php";

/**
 * Get all picture
 */
function get_all_picture()
{
    return (get_all_pic());
}


/**
 * Get all picture from a user
 */
function get_all_login_picture($login)
{
    return (get_all_login_pic($login));
}

/**
 * Get one picture
 */
function get_picture($id)
{
    return (get_pic($id));
}
?>