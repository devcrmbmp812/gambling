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
	'sliderRespImage' => '',
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


<section class="content">
	<section class="widget">
		<div class="panel panel-default bt-panel" style="box-shadow:none;">
			<div class="panel-heading">
				<span class="icon">&#128196;</span>
				<hgroup>
					<h5>Media gallery</h5>
					<h6>All uploaded files</h6>
				</hgroup>
			</div>
			<div class="panel-body">
		<?php
		if(isset($_GET['edit']) && trim($_GET['edit'])){
			$editID = $_GET['edit'];
			$result = $User->query("SELECT `id`, `sliderImage`, `sliderRespImage`, `sliderImageName`, `sliderHeading`, `sliderText`, `buttonOne`, `buttonTwo` FROM `tblSlider` WHERE `id` = '" . $editID . "' LIMIT 0, 1");
			if($result && is_array($result) && count($result) > 0){
				$editValue['id'] = $result[0]['id'];
				$editValue['sliderImage'] = $result[0]['sliderImage'];
				$editValue['sliderRespImage'] = $result[0]['sliderRespImage'];
				$editValue['sliderImageName'] = $result[0]['sliderImageName'];
				$editValue['sliderHeading'] = $result[0]['sliderHeading'];
				$editValue['sliderText'] = $result[0]['sliderText'];
				$editValue['buttonOne'] = $result[0]['buttonOne'];
				$editValue['buttonTwo'] = $result[0]['buttonTwo'];
			}
		?>
				<div class="content">
					<form action="" method="post" enctype="multipart/form-data">
						<div class="field-wrap form-group">
							<input type="text" name="sliderHeading" value="<?php echo $editValue['sliderHeading']; ?>" placeholder="Heading" />
							<input type="hidden" name="id" value="<?php echo $editValue['id']; ?>" placeholder="id" />
						</div>
						<div class="field-wrap wysiwyg-wrap form-group">
							<textarea name="sliderText" rows="5"><?php echo $editValue['sliderText']; ?></textarea><br><br>
						</div>
						<div class="field-wrap form-group">
							<p><strong>Image for Desktop</strong></p>
							<img src="<?php echo HOST. $editValue['sliderImage'];  ?>" style="width:80%;margin:10px auto;" />
							<input type="file" name="sliderImage" placeholder="Place your Image" />
						</div>
						<div class="field-wrap form-group">
							<p style="margin-top: -14px; margin-bottom: 19px;color:red;"><small>Add image if you want to chnage</small></p>
							<input type="text" value="<?php echo $editValue['sliderImageName']; ?>" name="sliderImageName" placeholder="Image name" />
						</div>
						<div class="field-wrap form-group">
							<p><strong>Image for Mobile</strong></p>
							<img src="<?php echo HOST. $editValue['sliderRespImage'];  ?>" style="margin:10px auto;" />
							<input type="file" name="sliderRespImage" placeholder="Place your Image" /><br>
							<p style="margin-top: -14px; margin-bottom: 19px;color:red;"><small>Add image if you want to chnage</small></p>
							<!-- <input type="text" value="<?php echo $editValue['sliderRespImage']; ?>" name="sliderRespImage" placeholder="Image name" /> -->
						</div>
						<div class="row">
							<div class="field-wrap form-group col-md-6">
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
							<div class="field-wrap form-group col-md-6">
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
						<button type="submit" class="btn btn-info">Update</button>
					</form>
				</div>
			</div>
		</div>
	</section>
</section>
<?php require_once('includes/doc_footer.php'); ?>