<?php
require_once "head.php";
require_once "../controler/do_logout.php";

$answer = logout();


require_once "menu.php";

echo $answer;

require_once "footer.php";
?>