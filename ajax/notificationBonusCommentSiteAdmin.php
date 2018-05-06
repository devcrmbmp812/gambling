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

if(isset($_POST)){
	$res = $User->query("SELECT `id`, `sportsName` FROM `tblWebCards` WHERE `siteName` = '" . $_POST['siteName'] . "'");

	if(is_array($res) && count($res) > 0){
		foreach ($res as $idx => $val) {
			$sportsName = $val['sportsName'];
		}
	}
	$resBon = $User->query("SELECT `id` FROM `tblBonusCards` WHERE `sportsName` = '" . $sportsName . "'");

	$ids = array();
	if(is_array($resBon) && count($resBon) > 0){
		foreach ($resBon as $idxx => $valxx) {
			$ids = $valxx['id'];
			$result = $User->query("SELECT `id`, `bonusId`, `userId`, `rating`, `isRecommanded`, `updatedOn` FROM `tblBonusComment` WHERE `checkSiteAdmin`='N' AND `isRecommanded`='Y' AND `bonusId`='" . $ids ."'");

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
					

echo 	'<a href="comment-reply.php?cat=bonus&id='.$value["id"].'">
			<div class="row content">
				<p class="text-white">'.$username.'</p>
				<p class="text-yellow">Category : Bonus</p>
				<p class="text-yellow">Comented on '.$BonusName.'</p>
			</div>
		</a>';

		} 
	}
}
		}
	}

	
}
?>
