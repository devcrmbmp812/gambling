

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
$username = 'Admin';
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
			$result = $User->query("SELECT `id`, `bonusId`, `userId`, `rating`, `isRecommanded`, `updatedOn` FROM `tblBonusComment` WHERE `isRecommanded`='Y' AND `bonusId`='" . $ids ."'");//`checkSiteAdmin`='N' AND 

				if(is_array($result) && count($result) > 0){
					foreach ($result as $key => $value) {
						$result12 = $User->query("SELECT `id`, `userId` FROM `tblCommentResponse` WHERE `checkSiteAdmin`='N' AND `isVerified`='Y' AND `category`='2' AND `responseId`='" . $value['id'] . "' AND `categoryId`='" . $value['bonusId'] . "'");
							if(is_array($result12) && count($result12) > 0){
								foreach ($result12 as $index12 => $val12) {
									// $userid = $val12['userId'];
									// $res34 = $User->query("SELECT `id`, `userId` FROM `tblUser` WHERE `id` = '" . $userid . "'");
									// 	if(is_array($res34) && count($res34) > 0){
									// 		foreach ($res34 as $index34 => $val34) {
									// 			$username = $val34['userId'];
									// 		}
									// 	}
									$sports = $User->query("SELECT `id`, `bonusName` FROM `tblBonusCards` WHERE `id` = '" . $value['bonusId'] . "'");
										if(is_array($sports) && count($sports) > 0){
											foreach ($sports as $indexBonus => $valBonus) {
												$sportsName = $valBonus['bonusName'];
											}
										}
										echo 	'<a href="comment-reply.php?cat=bonus&id='.$value["id"].'">
											<div class="row content">
												<p class="text-white">'.$username.'</p>
												<p class="text-yellow">Category : Bonus</p>
												<p class="text-yellow">Comented on '.$sportsName.'</p>
											</div>
										</a>';
								}
							}
					} 
				}
			}
		}
	}
?>
