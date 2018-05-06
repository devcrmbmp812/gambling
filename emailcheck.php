<?php
require_once('config.php');

// Load Classes
C::loadClass('User');

$User = new User();

if(isset($_POST)){
	$user_check = $User->query("SELECT `id` FROM `tblUser` WHERE `email`='".$_POST['data']."'");
	if(isset($user_check[0]) > 0){
		echo '1';
	}else{
		echo '0';
	}
}

?>