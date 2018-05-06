<?php
require_once('../config.php');	

// Load Classes
C::loadClass('User');

if(isset($_POST) && count($_POST) > 0){
	$res = $User->query("SELECT `sportsImage` FROM `tblWebCards` WHERE `siteName`= '". $_POST['siteName'] ."' LIMIT 0,1");
	
	echo $res[0]['sportsImage'];
}

?>