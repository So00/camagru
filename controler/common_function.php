<?php
function get_id_user($login)
{
    include __DIR__ . "/../model/user_function.php";
    return (get_user_id($login, $bdd));
}
?>