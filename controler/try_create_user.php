<?php

require_once __DIR__."/../model/user_function.php";
require_once __DIR__."/common_function.php";

/**
 * Check password strengh and length
 */
function Valid_pass($pwd)
{
    $min = $maj = $numb = 0;
    $len = strlen($pwd);
    for ($i = 0; $i < $len; $i++) {
        if ($pwd[$i] >= 'a' && $pwd[$i] <= 'z') {
            $min = 1;
        } else if ($pwd[$i] >= 'A' && $pwd[$i] <= 'Z') {
            $maj = 1;
        } else if ($pwd[$i] >= '0' && $pwd[$i] <= '9') {
            $numb = 1;
        }
    }
    if ($min && $maj && $numb && $len >= 8 && $len <= 254) {
        return (1);
    }
    if (!$min || !$maj || !$numb) {
        echo "<div class=\"error\">The password is not strong enough.<br>It needs at least a lower caracter, a upper caracter and a number</div>";
    } else {
        echo "<div class=\"error\">The password length must be at least 8 and at more 254 characters</div>";
    }
    return (0);
}

/**
 * Try the POST send and check if all is valid
 */
function Try_post()
{
    if (isset($_POST['login'], $_POST['pwd'], $_POST['mail'], $_POST['name'], $_POST['fname'])) {
        $login = htmlspecialchars($_POST['login']);
        $pwd = hash("whirlpool", $_POST['pwd']);
        $pwd2 = hash("whirlpool", $_POST['pwd2']);
        $mail = htmlspecialchars($_POST['mail']);
        $name = htmlspecialchars($_POST['name']);
        $fname = htmlspecialchars($_POST['fname']);
        if ($login != $_POST['login'] || !ctype_alnum($login) || strlen($login) < 3 || strlen($login) > 30) {
            $error = "login";
        } else if ($mail != $_POST['mail'] || !Valid_mail($mail)) {
            $error = "mail";
        } else if ($name != $_POST['name'] || !ctype_alpha($name)) {
            $error = "name";
        } else if ($fname != $_POST['fname'] || !ctype_alpha($fname)) {
            $error = "first name";
        } else if ($pwd != $pwd2) {
            echo "<div class=\"error\">You didn't type the same password</div>";
            return (null);
        } else if (!Valid_pass($_POST['pwd'])) {
            return (null);
        } else {
            return (array('login' => $login, 'pwd' => $pwd, 'mail' => $mail, 'name' => $name, 'fname' => $fname));
        } ?>
        <div class="error">Error in the field <?= $error ?></div>
    <?php } else { ?>
        <div class="error">You need to full all the fields</div>
    <?php }
    return (null);
}

$user = Try_post();

if ($user && No_duplicate($user)) {
    Create_user($user);
    ?>
    <div class="answer">Congratulation <?php echo $user['login']; ?> Your account has been created. Check your mail for the validation<br></div>
<?php } ?>