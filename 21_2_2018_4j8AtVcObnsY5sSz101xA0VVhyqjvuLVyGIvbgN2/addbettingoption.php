<?php
require_once('../config.php');	

// Load Classes
C::loadClass('User');

if(isset($_POST) && count($_POST) > 0){
	$fieldArray = array(
            'name' => 'betting-option',
            'value' => trim($_POST['betting-option']),
            'display' => 'Y'
            );
	$User->query("INSERT INTO `tblFilter` SET " . $User->prepareFieldsForInsertOrUpdate($fieldArray));
	$res = $User->query("SELECT `value` FROM `tblFilter` WHERE `name`='betting-option'");

	if(is_array($res) && count($res) > 0){
		foreach ($res as $key => $value) {
			echo '<option value='.$value['value'].'>'.$value['value'].'</option>';
		}
	}
}

?>