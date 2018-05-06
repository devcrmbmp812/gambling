<?php
require_once('../config.php');	

// Load Classes
C::loadClass('User');
C::loadClass('Card');
C::loadClass('CMS');
//Init User class
$Base = new Base();
$User = new User();
$Card = new Card();

$editValue = false;


if(isset($_POST) && is_array($_POST) && count($_POST) > 0){
	//print_r($_POST);
	if($User->updateGroupId($_POST['id'], $_POST['groupID'])){
		C::redirect(C::link('users.php', false, true));
	}
}

?>