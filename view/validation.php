<?php
require_once "head.php";
require_once "menu.php";
require "connect.php";

if (isset($_GET['val'])) {
    $val = htmlspecialchars($_GET['val']);
    $answer = $bdd->prepare("SELECT * FROM users WHERE validation= :val");
    $answer->bindValue("val", $val, PDO::PARAM_STR);
    $answer->execute();
    if (($data = $answer->fetch())) {
        if (!$data['valid']) {
            $bdd->prepare("UPDATE users SET valid=\"1\" WHERE id=:id")->execute(array('id' => $data['ID']));
            echo "<p>Your account is validated. You can now login</p>";
            system("mkdir ./pictures/".$data['login']);
        } else {
            echo "<p>Your account is already validated</p>";
        }
    } else {
        echo "<p>Your validation link isn't valid</p>";
    }
} else {
    echo "<p>Your validation link isn't valid</p>";
}
require_once "footer.php";
?>