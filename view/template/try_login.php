<?php
    require __DIR__."/head.php";
    require __DIR__."/menu.php";
if (empty($_SESSION['login'])) {
    ?>
        <form action="answer_login.php" method="post">
            <div><span>Your login : </span><input type="text" name="login"/></div>
            <div><span> password : </span><input type="password" name="pwd"/></div>
            <div><input type="submit" value="Send"></div>
            <a href="/view/template/reset_pwd.php">Reset your password</a>
        </form>
<?php } else { ?>
        <div class="answer">You're already logged</div>
<?php }
    require "footer.php";
?>