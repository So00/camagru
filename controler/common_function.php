<?php
function get_id_user($login)
{
    include_once __DIR__ . "/../model/user_function.php";
    include __DIR__."/../model/connect.php";
    return (get_user_id($login, $bdd));
}
?>