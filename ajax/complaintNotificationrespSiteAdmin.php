
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

$ids = array();
if(isset($_POST)){
$result = $User->query("SELECT `id`, `siteName`, `userId`, `updatedOn` FROM `tblComplaints` WHERE `siteName` = '" . $_POST['siteName'] . "'");
		if(is_array($result) && count($result) > 0){
		foreach ($result as $idx => $val) {
			$ids = $val['id'];
		}
	}
	if(isset($ids) && count($ids) > 0){
		$resl = $User->query("SELECT `id`, `complaintId`, `siteName`, `userId`, `updatedOn` FROM `tblComplaintsResponse` WHERE `checkSiteAdmin`='N' AND `complaintId` = '" . $ids . "'");

		if(is_array($resl) && count($resl) > 0){
			foreach ($resl as $key => $value) {
				$res = $User->query("SELECT `id`, `userId`, `siteName`, `groupId` FROM `tblUser` WHERE `id` = '" . $value['userId'] . "'");
					if(is_array($res) && count($res) > 0){
						foreach ($res as $index => $val) {
							if($val['id'] == '1'){
								$username = 'Admin';
							}else{
								$username = $val['userId'];
							}
						}
					}
				// $sports = $User->query("SELECT `id`, `sportsName` FROM `tblSadariCards` WHERE `id` = '" . $value['sportsId'] . "'");
				// 	if(is_array($sports) && count($sports) > 0){
				// 		foreach ($sports as $indexBonus => $valBonus) {
				// 			$sportsName = $valBonus['sportsName'];
				// 		}
				// 	}

echo 	'<a href="siteComplaintRespons.php?edit='.$value["complaintId"].'">
			<div class="row content">
				<p class="text-white">'.$username.'</p>
				<p class="text-yellow">Resonded against complaint</p>
			</div>
		</a>';

		}
	}
	}
		
}
?>