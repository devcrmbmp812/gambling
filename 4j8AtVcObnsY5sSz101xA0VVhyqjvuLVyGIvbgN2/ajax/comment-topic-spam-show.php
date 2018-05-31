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
		$updateuserrole = $User->query("UPDATE `tblForumTopicsResponse` SET `isDispaly` = '". $_POST['sid'] ."' WHERE `id` = '". $_POST['topic'] ."'");
		echo 'You have successfully hided the topic from forum@@1';
	}elseif ($_POST['sid'] == 'N') {
		$updateuserrole = $User->query("UPDATE `tblForumTopicsResponse` SET `isDispaly` = '". $_POST['sid'] ."' WHERE `id` = '". $_POST['topic'] ."'");
		echo 'You have successfully showed the topic on forum@@0';

	}
}
?>