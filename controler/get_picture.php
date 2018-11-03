<?php
    function get_all_picture($login)
    {
        require_once "../model/get_picture.php";
        $allPic = get_all_pic($login);
        return ($allPic);
    }
?>