<?php

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
?>