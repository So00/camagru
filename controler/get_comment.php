<?php
require_once __DIR__."/../model/get_comment.php";
require_once __DIR__."/../model/user_function.php";

function get_comment($img_id)
{
    $all_comm = get_all_com($img_id);
    return ($all_comm);
}
?>