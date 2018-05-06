<?php
require_once('../config.php');	

// Load Classes
C::loadClass('User');
//Init User class
$User = new User();



$result = $User->query("SELECT `sportsImage`, `imageName`, `joinCode`, `link` FROM `tblWebCards` WHERE `sportsName` = '" . $_GET['sportsImage'] . "' LIMIT 0, 1");
//$_GET['sportsImage'];

echo $result[0]['sportsImage'].'*'.$result[0]['imageName'].'*'.$result[0]['joinCode'].'*'.$result[0]['link'];





?>