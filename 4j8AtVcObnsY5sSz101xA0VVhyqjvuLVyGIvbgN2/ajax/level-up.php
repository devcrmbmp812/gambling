<?php
require_once('../../config.php');	

// Load Classes
C::loadClass('User');
C::loadClass('Card');
//Init User class
$Base = new Base();
$User = new User();
$Card = new Card();
$Common = new Common();

if(!$User->checkLoginStatus()){
	$Common->redirect('index.php');
}

if(isset($_POST)){
	//echo 'test';
	if($_POST['sid'] == 'Y'){
		$updatelevelid = $User->query("UPDATE `tblLevelUp` SET `isVerified` = '". $_POST['sid'] ."', `checkAdmin` = 'Y', `checkUser` = 'N' WHERE `id` = '". $_POST['levelid'] ."'");
		$updateuserrole = $User->query("UPDATE `tblUser` SET `groupId` = '4' WHERE `id` = '". $_POST['user'] ."'");
		$updatecount = $User->query("SELECT COUNT(`id`) AS `CNT` FROM `tblLevelUp` WHERE `isVerified` = 'P'");
		echo 'You have successfully updated user level@@1@@'. $updatecount[0]['CNT'];
	}elseif ($_POST['sid'] == 'N') {
		$updatelevelid = $User->query("UPDATE `tblLevelUp` SET `isVerified` = '". $_POST['sid'] ."', `checkAdmin` = 'Y', `checkUser` = 'N' WHERE `id` = '". $_POST['levelid'] ."'");
		$updateuserrole = $User->query("UPDATE `tblUser` SET `groupId` = '3' WHERE `id` = '". $_POST['user'] ."'");
		$updatecount = $User->query("SELECT COUNT(`id`) AS `CNT` FROM `tblLevelUp` WHERE `isVerified` = 'P'");
		echo 'You have rejected user level up request@@0@@'. $updatecount[0]['CNT'];
	}elseif ($_POST['sid'] == 'P') {
		echo 'Nothing is changed.@@0';

	}
}
?>