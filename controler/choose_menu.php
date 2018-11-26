<?php
/**
 * Choose menu logged or not
 */

if (!isset($_SESSION['login'])) {?>
    <a <?= active_link("register.php"); ?>> <span class="fa fa-address-book-o" aria-hidden="true"></span><br>Register</a>
    <a <?= active_link("try_login.php"); ?>> <span class="fa fa-sign-in" aria-hidden="true"></span><br>Login</a>
<?php } else {?>
    <a <?= active_link("account.php"); ?>> <span class="fa fa-cog" aria-hidden="true"></span><br>Account</a>
    <a <?= active_link("logout.php"); ?>> <span class="fa fa-sign-out" aria-hidden="true"></span><br>Logout</a>
    <a <?= active_link("cheese.php"); ?>> <span class="fa fa-sign-in" aria-hidden="true"></span><br>Cheese</a>
    <a <?= active_link("my_picture.php"); ?>> <span class="fa fa-sign-in" aria-hidden="true"></span><br>My picture</a>
<?php } ?>