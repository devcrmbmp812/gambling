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
$Common = new Common();

if(!$User->checkLoginStatus()){
	$Common->redirect('index.php');
}

$result = $User->query("SELECT `id`, `siteName`, `userId`, `updatedOn` FROM `tblComplaints` WHERE `checkAdmin`='N'");
		if(is_array($result) && count($result) > 0){
			foreach ($result as $key => $value) {
				$res = $User->query("SELECT `id`, `userId` FROM `tblUser` WHERE `id` = '" . $value['userId'] . "'");
					if(is_array($res) && count($res) > 0){
						foreach ($res as $index => $val) {
							$username = $val['userId'];
						}
					}
				// $sports = $User->query("SELECT `id`, `sportsName` FROM `tblSadariCards` WHERE `id` = '" . $value['sportsId'] . "'");
				// 	if(is_array($sports) && count($sports) > 0){
				// 		foreach ($sports as $indexBonus => $valBonus) {
				// 			$sportsName = $valBonus['sportsName'];
				// 		}
				// 	}

echo 	'<li>
			<a href="complaint-edit.php?edit='.$value["id"].'"><hgroup>
				<h1>'.$username.'</h1>
				<h2>Submited complaint against '.$value["siteName"].'</h2>  
			</hgroup>
			</a>
		</li>';

		}
	}
?>