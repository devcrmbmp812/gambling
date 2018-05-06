<?php
require_once('config.php');	

// Load Classes
C::loadClass('User');
C::loadClass('Card');
C::loadClass('CMS');
//Init User class
$User = new User();

if(isset($_POST['issue']) && count($_POST['issue']) > 0){
	$result = $User->query("SELECT `categoryComplaintContent` FROM `tblComplaintContent` WHERE `categoryComplaint`='". $_POST['issue'] ."'");
	if(isset($result) && is_array($result) && count($result) > 0){
		foreach ($result as $key => $value) {
			echo $value['categoryComplaintContent'];
		}
	}
}

?>