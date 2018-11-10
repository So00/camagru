<?php

require __DIR__."/../model/test_user.php";
require __DIR__."/../model/create_user.php";

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
        echo "<p>The password is not strong enough.<br>It needs at least a lower caracter, a upper caracter and a number</p>";
    } else {
        echo "<p>The password length must be at least 8 and at more 254 characters</p>";
    }
    return (0);
}

/**
 * Check if the mail is valid
 */
function Valid_mail($mail)
{
    if (!filter_var($mail, FILTER_VALIDATE_EMAIL)) {
        return (0);
    }
    return (1);
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
            echo "<p>You didn't type the same password</p>";
            return (null);
        } else if (!Valid_pass($_POST['pwd'])) {
            return (null);
        } else {
            return (array('login' => $login, 'pwd' => $pwd, 'mail' => $mail, 'name' => $name, 'fname' => $fname));
        } ?>
        <span class="answer">Error in the field <?= $error ?></span>
    <?php } else { ?>
        <span class="answer">You need to full all the fields</span>
    <?php }
    return (null);
}

$user = Try_post();

if ($user && No_duplicate($user)) {
    Create_user($user);
    ?>
    <span class="answer">Congratulation <?php echo $user['login']; ?> Your account has been created. Check your mail for the validation<br></span>
<?php } ?>