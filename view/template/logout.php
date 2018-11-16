<?php
require __DIR__."/head.php";
require __DIR__."/../../controler/log.php";

$answer = logout();


require __DIR__."/menu.php";

echo $answer;

require __DIR__."/footer.php";
?>