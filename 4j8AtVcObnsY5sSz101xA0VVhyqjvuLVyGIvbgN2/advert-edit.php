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
$logedInID = ((int)User::loggedInUserId() > 0 ? User::loggedInUserId() : 0);
$groupId = $Base->query("SELECT `groupId` FROM `tblUser` WHERE `id` = '" . $logedInID . "' LIMIT 1");
if ( $groupId[0]['groupId'] != 0) {
	$Common->redirect('complaint.php');
}

$editValue = array(
	'id' => '',
	'adsImage' => '',
	'imageName' => '',
	'adsLink' => '',
	'sequence' => ''
);

if(isset($_POST) && is_array($_POST) && count($_POST) > 0){
	//print_r($_FILES);die();
    if($Card->updateAds($_POST, $_FILES)){
    	C::redirect(C::link('addadvert.php', false, true));
    }	
}
if(isset($_GET['delete']) && trim($_GET['delete'])){
	if($Card->delSlider($_GET['delete'])){
		C::redirect(C::link('addadvert.php', false, true));
	}
} 

?>
<?php require_once('includes/doc_head.php'); ?>

<!-- <section class="alert">
	<div class="green">	
		<p>Hi Lee, you have <a href="#">3 new pages</a> and <a href="#">16 comments</a> to approve, better get going!</p>
		<span class="close">&#10006;</span>
	</div>
</section> -->
<section class="content">
	<section class="widget">
		<div class="panel panel-default bt-panel" style="box-shadow:none;">
			<div class="panel-heading">
				<span class="icon">&#128196;</span>
				<hgroup>
					<h5>Advertisment</h5>
					<h6>All uploaded files</h6>
				</hgroup>
			</div>
		<?php
		if(isset($_GET['edit']) && trim($_GET['edit'])){
			$editID = $_GET['edit'];
			$result = $User->query("SELECT `id`, `adsImage`, `imageName`, `sequence`, `adsLink` FROM `tblAds` WHERE `id` = '" . $editID . "' LIMIT 0, 1");
			if($result && is_array($result) && count($result) > 0){
				$editValue['id'] = $result[0]['id'];
				$editValue['sliderImage'] = $result[0]['adsImage'];
				$editValue['sliderImageName'] = $result[0]['imageName'];
				$editValue['adsLink'] = $result[0]['adsLink'];
				$editValue['sequence'] = $result[0]['sequence'];
			}
		}
		?>
			<div class="panel-body">
				<div class="content">
					<form action="" method="post" enctype="multipart/form-data">
						<div class="field-wrap form-group">
							<input type="text" name="adsLink" value="<?php echo $editValue['adsLink'] ;?>" placeholder="Link" required/>
							<input type="hidden" name="id" value="<?php echo $editValue['id'];?>"/>
						</div>
						<div class="field-wrap form-group">
							<input type="text" name="adsSequence" value="<?php echo $editValue['sequence'];?>" placeholder="Sequence" required/>
						</div>
						<div class="field-wrap form-group">
						<img src="<?php echo HOST.$editValue['sliderImage'];?>" alt="">
							<input type="file" name="sliderImage" value="" placeholder="Place your Image"  required />
							<p style="color:red;">Add image with same extension as previously added image (SIZE:300pxwidth, 250px height)</p>
							<input type="text" name="sliderImageName" value="<?php echo $editValue['sliderImageName'];?>" placeholder="Image name"  required />
						</div>
						<br>
						<button type="submit" class="btn btn-info">UPDATE ADVERTISMENT</button>
					</form>
				</div>
			</div>
		</div>
	</section>
</section>
<?php require_once('includes/doc_footer.php'); ?>