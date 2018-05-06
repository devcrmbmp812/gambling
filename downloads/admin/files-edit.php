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
	'sliderImage' => '',
	'sliderImageName' => '',
	'sliderHeading' => '',
	'sliderText' => '',
	'buttonOne' => '',
	'buttonTwo' => ''
);
if(isset($_POST) && is_array($_POST) && count($_POST) > 0){
	//print_r($_FILES);die();
    if($Card->updateSlider($_POST, $_FILES)){
    	C::redirect(C::link('files.php', false, true));
    }	
}
if(isset($_GET['delete']) && trim($_GET['delete'])){
	if($Card->delSlider($_GET['delete'])){
		C::redirect(C::link('files.php', false, true));
	}
} 

?>
<?php require_once('includes/doc_head.php'); ?>

<section class="alert">
	<div class="green">	
		<p>Hi Lee, you have <a href="#">3 new pages</a> and <a href="#">16 comments</a> to approve, better get going!</p>
		<span class="close">&#10006;</span>
	</div>
</section>
<section class="content">
	<section class="widget">
		<header>
			<span class="icon">&#127748;</span>
			<hgroup>
				<h1>Media gallery</h1>
				<h2>All uploaded files</h2>
			</hgroup>
		</header>
		<?php
		if(isset($_GET['edit']) && trim($_GET['edit'])){
			$editID = $_GET['edit'];
			$result = $User->query("SELECT `id`, `sliderImage`, `sliderImageName`, `sliderHeading`, `sliderText`, `buttonOne`, `buttonTwo` FROM `tblSlider` WHERE `id` = '" . $editID . "' LIMIT 0, 1");
			if($result && is_array($result) && count($result) > 0){
				$editValue['id'] = $result[0]['id'];
				$editValue['sliderImage'] = $result[0]['sliderImage'];
				$editValue['sliderImageName'] = $result[0]['sliderImageName'];
				$editValue['sliderHeading'] = $result[0]['sliderHeading'];
				$editValue['sliderText'] = $result[0]['sliderText'];
				$editValue['buttonOne'] = $result[0]['buttonOne'];
				$editValue['buttonTwo'] = $result[0]['buttonTwo'];
			}
		?>
		<div class="content">
			<form action="" method="post" enctype="multipart/form-data">
				<div class="field-wrap">
					<input type="text" name="sliderHeading" value="<?php echo $editValue['sliderHeading']; ?>" placeholder="Heading" />
					<input type="hidden" name="id" value="<?php echo $editValue['id']; ?>" placeholder="id" />
				</div>
				<div class="field-wrap wysiwyg-wrap">
					<textarea id="editor" name="sliderText" rows="5"><?php echo $editValue['sliderText']; ?></textarea><br><br>
				</div>
				<div class="field-wrap">
					<img src="<?php echo $editValue['sliderImage'];  ?>" style="width:80%;margin:10px auto;" />
					<input type="file" name="sliderImage" placeholder="Place your Image" />
					<p style="margin-top: -14px; margin-bottom: 19px;color:red;"><small>Add image if you want to chnage</small></p>
					<input type="text" value="<?php echo $editValue['sliderImageName']; ?>" name="sliderImageName" placeholder="Image name" />
				</div>
				<div style="width:100%">
					<div class="field-wrap" style="width:48%;float:left;margin-right:20px;">
					<?php 
					$buttonOneName = explode('+', $editValue['buttonOne']);
					if(isset($buttonOneName)){
					?>
						<input type="text" value="<?php echo $buttonOneName['0']; ?>" name="buttonOneName" placeholder="Button name" />
						<input type="text" value="<?php echo $buttonOneName['1']; ?>" name="buttonOneLink" placeholder="Button Link" />
						<select name="buttonOneColor" id="buttonOneColor">
							<option>--CHOOSE BUTTON COLOR--</option>
							<option <?php if ($buttonOneName['2'] == 'green' ) echo 'selected' ; ?> value="green">Green</option>
							<option <?php if ($buttonOneName['2'] == 'red' ) echo 'selected' ; ?> value="red">Red</option>
						</select>
					</div>
					<?php } ?>
					<div class="field-wrap" style="width:48%;float:left;">
					<?php 
					$buttonTwoName = explode('+', $editValue['buttonTwo']);
					if(isset($buttonTwoName)){
					?>
						<input type="text" value="<?php echo $buttonTwoName['0']; ?>" name="buttonTwoName" placeholder="Button Two name" />
						<input type="text" value="<?php echo $buttonTwoName['1']; ?>" name="buttonTwoLink" placeholder="Button Two Link" />
						<select name="buttonTwoColor" id="buttonOneColor">
							<option>--CHOOSE BUTTON COLOR--</option>
							<option <?php if ($buttonTwoName['2'] == 'green' ) echo 'selected' ; ?> value="green">Green</option>
							<option <?php if ($buttonTwoName['2'] == 'red' ) echo 'selected' ; ?> value="red">Red</option>
						</select>
					</div>
					<?php } ?>
				</div>
				<br>
				<?php
				}
				?>
				<button type="submit" class="green">Update</button>
			</form>
		</div>
	</section>
</section>
<?php require_once('includes/doc_footer.php'); ?>