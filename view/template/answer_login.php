<?php
    require __DIR__."/head.php";
    require __DIR__."/../../controler/log.php";
    $answer = login();
    require __DIR__."/menu.php";
?>
    <br>
    <div class="answer"><?= $answer; ?></div>
<?php
    require "footer.php";
?>