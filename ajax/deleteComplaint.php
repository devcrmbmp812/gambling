<?php
require_once('../config.php');

// Load Classes
C::loadClass('User');

$User = new User();



if(isset($_POST)){
	$user_check = $User->query("DELETE FROM `" . $_POST['tabelName'] . "` WHERE `id`=" . $_POST['row'] . "");
	// if(isset($user_check[0]) > 0){
	// 	echo '1';
	// }else{
	// 	echo '0';
	// }
	return true;
}

?>