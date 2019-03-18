<?php
try {
    $bdd = new PDO(
        'mysql:host=db;',
        'root',
        'test'
    );
} catch (Exception $e) {
    die("Erreur : " . $e->getMessage());
}
echo"Db Creation";
$bdd->exec("CREATE DATABASE IF NOT EXISTS `database` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `database`;
CREATE TABLE `message` (
  `ID` int(11) NOT NULL,
  `message` text NOT NULL,
  `user_id` int(11) NOT NULL,
  `picture_id` int(11) NOT NULL,
  `date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
CREATE TABLE `pictures` (
  `ID` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `img_path` varchar(255) NOT NULL,
  `filter` text NOT NULL,
  `posted` tinyint(4) DEFAULT NULL,
  `likes` text,
  `date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
CREATE TABLE `users` (
  `ID` int(6) UNSIGNED NOT NULL,
  `login` varchar(25) NOT NULL,
  `pwd` varchar(255) NOT NULL,
  `validation` varchar(41) NOT NULL,
  `valid` int(1) DEFAULT NULL,
  `mail` varchar(60) NOT NULL,
  `name` varchar(50) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `admin` int(11) DEFAULT NULL,
  `notif` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
ALTER TABLE `message`
  ADD PRIMARY KEY (`ID`);
ALTER TABLE `pictures`
  ADD PRIMARY KEY (`ID`);
ALTER TABLE `users`
  ADD PRIMARY KEY (`ID`);
ALTER TABLE `message`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;
ALTER TABLE `pictures`
  MODIFY `ID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;
ALTER TABLE `users`
  MODIFY `ID` int(6) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;
COMMIT;");
echo "<br>Database is created. Have fun :)";
?>