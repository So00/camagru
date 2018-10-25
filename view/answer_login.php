<?php
    require_once "head.php";
    require_once "../controler/login.php";
    $answer = login();
    require_once "menu.php";
?>
    <br>
    <span class="answer"><?php echo $answer;?></span>
<?php
    require_once "footer.php";
?>