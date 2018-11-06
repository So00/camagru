<?php
require_once "head.php";
require_once "../controler/log.php";

$answer = logout();


require_once "menu.php";

echo $answer;

require_once "footer.php";
?>