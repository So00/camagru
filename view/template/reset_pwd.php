<?php
require_once __DIR__."/head.php";
require_once __DIR__."/menu.php";
require_once __DIR__."/../../model/connect.php";

function Assign_Rand_value($num) {

    switch($num) {
        case "1"  : $rand_value = "a"; break;
        case "2"  : $rand_value = "b"; break;
        case "3"  : $rand_value = "c"; break;
        case "4"  : $rand_value = "d"; break;
        case "5"  : $rand_value = "e"; break;
        case "6"  : $rand_value = "f"; break;
        case "7"  : $rand_value = "g"; break;
        case "8"  : $rand_value = "h"; break;
        case "9"  : $rand_value = "i"; break;
        case "10" : $rand_value = "j"; break;
        case "11" : $rand_value = "k"; break;
        case "12" : $rand_value = "l"; break;
        case "13" : $rand_value = "m"; break;
        case "14" : $rand_value = "n"; break;
        case "15" : $rand_value = "o"; break;
        case "16" : $rand_value = "p"; break;
        case "17" : $rand_value = "q"; break;
        case "18" : $rand_value = "r"; break;
        case "19" : $rand_value = "s"; break;
        case "20" : $rand_value = "t"; break;
        case "21" : $rand_value = "u"; break;
        case "22" : $rand_value = "v"; break;
        case "23" : $rand_value = "w"; break;
        case "24" : $rand_value = "x"; break;
        case "25" : $rand_value = "y"; break;
        case "26" : $rand_value = "z"; break;
        case "27" : $rand_value = "0"; break;
        case "28" : $rand_value = "1"; break;
        case "29" : $rand_value = "2"; break;
        case "30" : $rand_value = "3"; break;
        case "31" : $rand_value = "4"; break;
        case "32" : $rand_value = "5"; break;
        case "33" : $rand_value = "6"; break;
        case "34" : $rand_value = "7"; break;
        case "35" : $rand_value = "8"; break;
        case "36" : $rand_value = "9"; break;
    }
    return ($rand_value);
}

function Valid_mail($mail)
{
    if (!filter_var($mail, FILTER_VALIDATE_EMAIL)) {
        return (0);
    }
    return (1);
}

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

$bdd = data();

if (isset($_GET['val'])) {
    if (isset($_POST["pwd"]))
    {
        $val = htmlspecialchars($_GET['val']);
        $answer = $bdd->prepare("SELECT * FROM users WHERE validation= :val");
        $answer->bindValue("val", $val, PDO::PARAM_STR);
        $answer->execute();
        $data = $answer->fetch();
        if ($data && !empty($data["valid"]) && Valid_pass($_POST["pwd"]))
        {
            $request = $bdd->prepare("UPDATE users SET pwd= :pwd WHERE validation= :val");
            $request->bindValue("val", $val, PDO::PARAM_STR);
            $request->bindValue("pwd", hash("whirlpool", $_POST['pwd']), PDO::PARAM_STR);
            $request->execute();
            $try = $bdd->prepare("UPDATE users SET validation=NULL WHERE ID= :val");
            $try->bindValue("val", $data["ID"]);
            $try->execute();
            echo "<div>Your password has been changed</div>";
        }
    }
    else{
        $val = htmlspecialchars($_GET['val']);
        $answer = $bdd->prepare("SELECT * FROM users WHERE validation= :val");
        $answer->bindValue("val", $val, PDO::PARAM_STR);
        $answer->execute();
        if (($data = $answer->fetch())) {
            if ($data['valid']) {
                echo "<form action=\"/view/template/reset_pwd.php?val=$val\" method=\"POST\">
                        <label for=\"password\">Enter your new password</label>
                        <input type=\"password\" name=\"pwd\" id=\"password\">
                        <input type=\"submit\">
                    </form>";
            } else {
                echo "<p>Your validation link isn't valid</p>";
            }
        }
    }
} else if (empty($_GET["mail"])) {
    ?>
    <form action="/view/template/reset_pwd.php" method="GET">
        <label for="mail">Enter your mail adress : </label>
        <input type="text" name="mail" id="mail">
        <input type="submit">
    </form>
    <?php
} else {
    if (Valid_mail($_GET["mail"]))
    {
        $answer = $bdd->prepare("SELECT * FROM users WHERE mail= :mail");
        $answer->bindValue("mail", $_GET["mail"], PDO::PARAM_STR);
        $answer->execute();
        if (($data = $answer->fetch()) && $data["valid"])
        {
            do {
                $validation = "";
                for ($i = 0; $i < 40; $i++) {
                    $validation .= Assign_Rand_value(mt_rand(1, 36));
                }
                $request = $bdd->prepare("SELECT * FROM users WHERE validation=:val");
                $request->bindValue('val', $validation, PDO::PARAM_STR);
                $request->execute();
            } while ($request->fetch() !== false);
            $request = $bdd->prepare("UPDATE users SET validation= :val WHERE id= {$data["ID"]}");
            $request->bindValue("val", $validation);
            $request->execute();
            $headers = "From: \"Camagru\" <welcome@camagru.com>\r\n";
                mail(
                    $data['mail'], "Your password reset", "Hello ".$data['login']."<br><br>You want to reset your password.<br>Click 
                    <a style=\"text-decoration: none; color: red;\" href=\"http://{$_SERVER["HTTP_HOST"]}/view/template/reset_pwd.php?val={$validation}\">this link</a>\nSee you soon :)",
                    $headers
                );
        ?>
        <p>A mail has been sent to your mail <?= $_GET["mail"]; ?></p>
        <?php
        }
        else
        {
            echo "<p>Your mail does not exist.</p>";
        }
    }
    else
    {
        echo "<p>Your mail is not valid</p>";
    }
}
require __DIR__."/footer.php";
?>