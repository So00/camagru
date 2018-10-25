<?php
/**
 * Choose menu logged or not
 */

if (!isset($_SESSION['login'])) {?>
    <a href="register.php"> <span class="fa fa-address-book-o" aria-hidden="true"></span><br>Register</a>
    <a href="try_login.php"> <span class="fa fa-sign-in" aria-hidden="true"></span><br>Login</a>
<?php } else {?>
    <a href="account.php"> <span class="fa fa-cog" aria-hidden="true"></span><br>Account</a>
    <a href="logout.php"> <span class="fa fa-sign-out" aria-hidden="true"></span><br>Logout</a>
    <a href="cheese.php"> <span class="fa fa-sign-in" aria-hidden="true"></span><br>Cheese</a>
    <a href="my_picture.php"> <span class="fa fa-sign-in" aria-hidden="true"></span><br>My picture</a>
<?php } ?>