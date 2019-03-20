<?php
require_once __DIR__."/head.php";
require_once __DIR__."/menu.php";
require_once __DIR__."/../../model/connect.php";

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
            $try = $bdd->prepare("UPDATE users SET validation=NULL WHERE validation= :val");
            $request->bindValue("val", $val, PDO::PARAM_STR);
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
                        <input type=\"text\" name=\"pwd\">
                        <input type=\"submit\">
                    </form>";
            } else {
                echo "<p>Your validation link isn't valid</p>";
            }
        }
    }
} else {
    echo "<p>Your validation link isn't valid</p>";
}
require __DIR__."/footer.php";
?>