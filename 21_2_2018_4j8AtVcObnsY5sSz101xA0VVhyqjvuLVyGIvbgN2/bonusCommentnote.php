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

$result = $User->query("SELECT `id`, `bonusId`, `userId`, `rating`, `isRecommanded`, `updatedOn` FROM `tblBonusComment` WHERE `checkAdmin`='N'");
		if(is_array($result) && count($result) > 0){
			foreach ($result as $key => $value) {
				$res = $User->query("SELECT `id`, `userId` FROM `tblUser` WHERE `id` = '" . $value['userId'] . "'");
					if(is_array($res) && count($res) > 0){
						foreach ($res as $index => $val) {
							$username = $val['userId'];
						}
					}
				$bonus = $User->query("SELECT `id`, `bonusName` FROM `tblBonusCards` WHERE `id` = '" . $value['bonusId'] . "'");
					if(is_array($bonus) && count($bonus) > 0){
						foreach ($bonus as $indexBonus => $valBonus) {
							$BonusName = $valBonus['bonusName'];
						}
					}

echo 	'<li>
			<a href="comments-reply.php?cat=bonus&id='.$value["id"].'"><hgroup>
				<h1>'.$username.'</h1>
				<h2>Comented on '.$BonusName.'</h2>  
			</hgroup>
			</a>
		</li>';

		}
	}
?>