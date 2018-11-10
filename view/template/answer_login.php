<?php
    require_once "head.php";
    require_once "../../controler/log.php";
    $answer = login();
    require_once "menu.php";
?>
    <br>
    <div class="answer"><?= $answer; ?></div>
<?php
    require_once "footer.php";
?>