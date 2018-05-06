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

$ids = array();
if(isset($_POST)){
	$res = $User->query("SELECT `id` FROM `tblSadariCards` WHERE `siteName` = '" . $_POST['siteName'] . "'");

	if(is_array($res) && count($res) > 0){
		foreach ($res as $idx => $val) {
			$ids = $val['id'];
		}
	}

if(isset($ids) && count($ids) > 0){
	$result = $User->query("SELECT `id`, `sportsId`, `userId`, `updatedOn` FROM `tblSadariSportsComment` WHERE `checkSiteAdmin`='N' AND `isRecommanded`='Y' AND `sportsId`='" . $ids . "'");
		if(is_array($result) && count($result) > 0){
			foreach ($result as $key => $value) {
				$res = $User->query("SELECT `id`, `userId` FROM `tblUser` WHERE `id` = '" . $value['userId'] . "'");
					if(is_array($res) && count($res) > 0){
						foreach ($res as $index => $val) {
							$username = $val['userId'];
						}
					}
				$sports = $User->query("SELECT `id`, `sportsName` FROM `tblSadariCards` WHERE `id` = '" . $value['sportsId'] . "'");
					if(is_array($sports) && count($sports) > 0){
						foreach ($sports as $indexBonus => $valBonus) {
							$sportsName = $valBonus['sportsName'];
						}
					}
}

echo 	'<a href="comments-reply.php?cat=Sadari&id='.$value["id"].'">
			<div class="row content">
				<p class="text-white">'.$username.'</p>
				<p class="text-yellow">Category : Sadari</p>
				<p class="text-yellow">Comented on '.$sportsName.'</p>
			</div>
		</a>';

		}
	}
}
?>
