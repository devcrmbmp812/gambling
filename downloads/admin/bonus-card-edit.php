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
	'sportsName' => '',
	'joinCode' => '',
	'bonusName' => '',
	'bonusCode' => '',
	'bonustype' => '',
	'bonusAmount' => '',
	'description' => '',
	'wageringRequirements' => '',
	'link' => '',
	'imageName' => '',
	'bonusImage' => '',
	'rating' => '',
	'bonusOtherDetails' => '',
	'isPopular' => ''
);

if(isset($_POST) && is_array($_POST) && count($_POST) > 0){
    if($Card->updateBonusCard($_POST)){
    	C::redirect(C::link('bonus-card.php', false, true));
    }	
}


?>
<?php require_once('includes/doc_head.php'); ?>
<section class="content">
	<section class="widget">
		<form action="" method="post" enctype="multipart/form-data" autocomplete="on">
			<header>
				<span class="icon">&#128196;</span>
				<hgroup>
					<h1>Bonus Card</h1>
					<h2>All uploaded files</h2>
				</hgroup>
			</header>
			<?php
			if(isset($_GET['edit']) && trim($_GET['edit'])){
				$editID = $_GET['edit'];
				$result = $User->query("SELECT `id`, `joinCode`, `sportsName`, `bonusName`, `bonusCode`, `bonusOtherDetails`, `bonustype`, `bonusAmount`, `description`, `wageringRequirements`, `bonusImage`, `imageName`, `link`, `rating`, `isPopular` FROM `tblBonusCards` WHERE `id` = '" . $editID . "' LIMIT 0, 1");
				if($result && is_array($result) && count($result) > 0){
					$editValue['sportsName'] = $result[0]['sportsName'];
					$editValue['joinCode'] = $result[0]['joinCode'];
					$editValue['bonusName'] = $result[0]['bonusName'];
					$editValue['bonusCode'] = $result[0]['bonusCode'];
					$editValue['bonustype'] = $result[0]['bonustype'];
					$editValue['bonusAmount'] = $result[0]['bonusAmount'];
					$editValue['bonusDesc'] = $result[0]['description'];//
					$editValue['wageringRequirements'] = $result[0]['wageringRequirements'];
					$editValue['bonusImage'] = $result[0]['bonusImage'];
					$editValue['imageName'] = $result[0]['imageName'];
					$editValue['link'] = $result[0]['link'];
					$editValue['rating'] = $result[0]['rating'];
					$editValue['id'] = $result[0]['id'];
					$editValue['isPopular'] = $result[0]['isPopular'];
					$editValue['bonusOtherDetails'] = $result[0]['bonusOtherDetails'];
				}
			?>
			<div class="content">
				<div class="field-wrap">
					<input type="text" value="<?php echo $editValue['joinCode'];?>" name="joinCode" placeholder="Join Code" />
					<input type="hidden" value="<?php echo $editValue['id'];?>" name="id" placeholder="id" />
				</div>
				<div class="field-wrap">
					<input type="text" value="<?php echo $editValue['sportsName'];?>" name="sportsName" placeholder="Sports Name" />
				</div>
				<div class="field-wrap">
					<input type="text" value="<?php echo $editValue['bonusName'];?>" name="bonusName" placeholder="Bonuse Name" />
				</div>
				<div class="field-wrap">
					<input type="text" value="<?php echo $editValue['bonusCode'];?>" name="bonusCode" placeholder="Bonus Code" />
				</div>
				<div class="field-wrap">
					<select name="bonustype" id="bonustype">
						<option value="0">-- CHOOSE BONUS TYPE --</option>
						<option <?php if ($editValue['bonustype'] == 'Welcome Bonus' ) echo 'selected' ; ?> value="Welcome Bonus">신규 첫충 보너스</option>
						<option <?php if ($editValue['bonustype'] == 'First Deposite Bonus' ) echo 'selected' ; ?> value="First Deposite Bonus">첫충전 보너스</option>
						<option <?php if ($editValue['bonustype'] == 'Every Time Bonus' ) echo 'selected' ; ?> value="Every Time Bonus">매번 충전 보너스</option>
						<option <?php if ($editValue['bonustype'] == 'Rolling Bonus' ) echo 'selected' ; ?> value="Rolling Bonus">롤링 보너스</option>
						<option <?php if ($editValue['bonustype'] == 'Free Money' ) echo 'selected' ; ?> value="Free Money">꽁머니 보너스</option>
						<option <?php if ($editValue['bonustype'] == 'Combo Bonus' ) echo 'selected' ; ?> value="Combo Bonus">다폴더 보너스</option>
						<option <?php if ($editValue['bonustype'] == 'Rebate Bonus' ) echo 'selected' ; ?> value="Rebate Bonus">낙첨금 보너스</option>
						<option <?php if ($editValue['bonustype'] == 'Other Bonus' ) echo 'selected' ; ?> value="Other Bonus">기타 보너스</option>
					</select>
				</div>
				<div class="field-wrap">
					<input type="text" value="<?php echo $editValue['bonusAmount'];?>" name="bonusAmount" placeholder="Bonus Amount" />
				</div>
				<div class="field-wrap">
					<textarea name="bonusDesc" id="" rows="4" placeholder="Bonus Description"><?php echo $editValue['bonusDesc'];?></textarea>
				</div>
				<div class="field-wrap">
					<input type="text" value="<?php echo $editValue['wageringRequirements'];?>" name="wageringRequirements" placeholder="Wager" />
				</div>
				<div class="field-wrap">
					<input type="text" value="<?php echo $editValue['link'];?>" name="link" placeholder="Site Link" />
				</div>
				<div class="field-wrap">
					<img src="<?php echo $editValue['bonusImage'];?>" alt="" style="width:100px;height:100px;" />
				</div><br />
				<div class="field-wrap">
					<input type="text" value="<?php echo $editValue['imageName'];?>" name="imageName" placeholder="Image Name" style="margin-bottom:2px;"/>
					<span style="color:#ff0000;">** every image must have different name **</span>
				</div>
				
				<h2 style="margin-top:10px;font-size:14px;font-weight:800;">Additional Bonus Details</h2>
				<div class="addBonusDetailsParent">
					<div class="field-wrap" id="">
						<?php 
						$res = $editValue['bonusOtherDetails'];
						if(isset($res)){
							$res = explode('+', $editValue['bonusOtherDetails']);
							$label = json_decode($res['0']);
							$datas = json_decode($res['1']);
							foreach ($label as $index => $val) {
						?>
						<div class="child-wrap">
							<input type="text" value="<?php echo $val; ?>" name="addBonusDetailsLabel[]" class="addBonusDetailsLabel" placeholder="Label" />
							<input type="text" value="<?php echo $datas[$index]; ?>" name="addBonusDetailsValue[]" class="addBonusDetailsValue" placeholder="Value" />
						</div>
					<?php
							}
						}
					?>
					</div>
				</div>
				<div class="field-wrap">
					<button type="button" class="red" id="addDetails">Add More</button><button type="button" class="blue" id="deleteDetails">Delete Last</button>
				</div><br>
				<div class="field-wrap">
					<select name="categoryType" id="categoryType">
						<option value="0">-- CHOOSE BONUS SECTION --</option>
						<option <?php if ($editValue['isPopular'] == 'N' ) echo 'selected' ; ?> value="N">Normal</option>
						<option <?php if ($editValue['isPopular'] == 'Y' ) echo 'selected' ; ?> value="Y">Popular</option>
					</select>
					<input type="hidden" name="categoryType" value="" placeholder="Category Type" />
				</div>
				<div class="field-wrap">
					<select name="rate" id="rate">
						<option value="0">-- GIVE RATING --</option>
						<option <?php if ($editValue['rating'] == 1 ) echo 'selected' ; ?> value="1">&#9734;</option>
						<option <?php if ($editValue['rating'] == 2 ) echo 'selected' ; ?> value="2">&#9734;&#9734;</option>
						<option <?php if ($editValue['rating'] == 3 ) echo 'selected' ; ?> value="3">&#9734;&#9734;&#9734;</option>
						<option <?php if ($editValue['rating'] == 4 ) echo 'selected' ; ?> value="4">&#9734;&#9734;&#9734;&#9734;</option>
						<option <?php if ($editValue['rating'] == 5 ) echo 'selected' ; ?> value="5">&#9734;&#9734;&#9734;&#9734;&#9734;</option>
					</select>
				</div>
				<?php
				}
				?>
				
				<button type="submit" class="green">Update Card</button> <!-- <button type="submit" class="">Preview</button> -->
			</div>
		</form>
	</section>
</section>
<?php require_once('includes/doc_footer.php'); ?>