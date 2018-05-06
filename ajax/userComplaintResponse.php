

<?php

//require_once('../config.php');	



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

$res = $User->query("SELECT `id` FROM `tblComplaints` WHERE `userId` = '" . $_POST['id'] . "'");

		if(is_array($res) && count($res) > 0){

			foreach ($res as $idx => $val) {

				$ids = $val['id'];

		$result = $User->query("SELECT `id`, `complaintId`, `siteName` FROM `tblComplaintsResponse` WHERE `checkUser`='N' AND `isVerified`='Y' AND `complaintId` = '" . $ids . "'");

		

		if(is_array($result) && count($result) > 0){

			foreach ($result as $key => $value) {

echo 	'<a href="complaintsDetail.php?detail='.$value["complaintId"].'">

			<div class="row content">

				<p class="text-white">'.$value["siteName"].'</p>

				<p class="text-yellow">Replied to your complaint </p>

			</div>

		</a>';



		}

	}

			}

		}

}

?>