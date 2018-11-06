<?php
require_once "../model/get_comment.php";
require_once "../model/user_function.php";

function get_comment($img_id)
{
    include "../model/connect.php";
    $all_comm = get_all_com($img_id);
    return ($all_comm);
}
?>