<?php
require_once __DIR__."/head.php";
require_once __DIR__."/menu.php";
require_once __DIR__."/../../model/connect.php";

$bdd = data();

if (isset($_GET['val'])) {
    $val = htmlspecialchars($_GET['val']);
    $answer = $bdd->prepare("SELECT * FROM users WHERE validation= :val");
    $answer->bindValue("val", $val, PDO::PARAM_STR);
    $answer->execute();
    if (($data = $answer->fetch())) {
        if (!$data['valid']) {
            $bdd->prepare("UPDATE users SET valid=\"1\", validation=null WHERE id=:id")->execute(array('id' => $data['ID']));
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
require __DIR__."/footer.php";
?>