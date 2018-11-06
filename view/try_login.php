<?php
    require_once "head.php";
    require_once "menu.php";
if (!$_SESSION['login']) {
    ?>
        <form action="answer_login.php" method="post">
            <div><span>Your login : </span><input type="text" name="login"/></div>
            <div><span> password : </span><input type="password" name="pwd"/></div>
            <div><input type="submit" value="Send"></div>
        </form>
<?php } else { ?>
        <div class="answer">You're already logged</div>
<?php }
    require_once "footer.php";
?>