<?php
require_once('../config.php');	

// Load Classes
C::loadClass('User');

if(isset($_POST['mini'])){
	$id =$_REQUEST['mini'];
	$User->query("DELETE FROM `tblFilter` WHERE `name`='mini-game' and `id`='".$id."'");
}
if(isset($_POST['betting'])){
	$id =$_REQUEST['betting'];
	$User->query("DELETE FROM `tblFilter` WHERE `name`='betting-option' and `id`='".$id."'");
}

?>