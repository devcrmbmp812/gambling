<?php

require_once('../config.php');	



// Load Classes

C::loadClass('User');



if(isset($_POST) && count($_POST) > 0 && isset($_POST['mini-game']) ){

	$fieldArray = array(

            'name' => 'mini-game',
            'value' => trim($_POST['mini-game']),
            'display' => 'Y'
            );

	$User->query("INSERT INTO `tblFilter` SET " . $User->prepareFieldsForInsertOrUpdate($fieldArray));

	$res = $User->query("SELECT `value` FROM `tblFilter` WHERE `name`='mini-game'");



	if(is_array($res) && count($res) > 0){
		foreach ($res as $key => $value) {
			echo '<option value='.trim($value['value']).'>'.trim($value['value']).'</option>';
		}
	}
}



// Delete mini-game

if(isset($_POST) && count($_POST) > 0 && isset($_POST['mini-game-delete']) ){

	//echo $_POST['mini-game-delete'];
	
	$User->query("DELETE FROM `tblFilter` WHERE `name`='mini-game' AND `value` = '" . $_POST['mini-game-delete'] . "'");

	$res = $User->query("SELECT `value` FROM `tblFilter` WHERE `name`='mini-game'");



	if(is_array($res) && count($res) > 0){
		foreach ($res as $key => $value) {
			echo '<option value='.trim($value['value']).'>'.trim($value['value']).'</option>';
		}
	}
}



if(isset($_POST) && count($_POST) > 0 && isset($_POST['bettingOptiondel-delete']) ){

	// $fieldArray = array(

 //            'name' => 'mini-game',
 //            'value' => trim($_POST['mini-game']),
 //            'display' => 'Y'
 //            );
	//echo "DELETE FROM `tblFilter` WHERE `name`='betting-option' AND `value` = '" . $_POST['bettingOptiondel-delete'] . "'";die();

	$User->query("DELETE FROM `tblFilter` WHERE `name`='betting-option' AND `value` = '" . $_POST['bettingOptiondel-delete'] . "'");

	$res = $User->query("SELECT `value` FROM `tblFilter` WHERE `name`='betting-option'");



	if(is_array($res) && count($res) > 0){
		foreach ($res as $key => $value) {
			echo '<option value='.trim($value['value']).'>'.trim($value['value']).'</option>';
		}
	}
}



?>