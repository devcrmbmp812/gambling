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
		$updateuserrole = $User->query("UPDATE `tblUser` SET `emailValid` = '". $_POST['sid'] ."' WHERE `id` = '". $_POST['user'] ."'");
		echo 'You have successfully verefied user email id@@1';
	}elseif ($_POST['sid'] == 'N') {
		$updateuserrole = $User->query("UPDATE `tblUser` SET `emailValid` = '". $_POST['sid'] ."' WHERE `id` = '". $_POST['user'] ."'");
		echo 'You maked it pending email verification@@0';

	}
}
?>