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
	'isPopular' => '',
	'minDepositeAmpount' => '',
	'rollingCondition' => '',
	'bonusConUtilization' => '',
	'maxBonusAmount' => '',
	'maxCashout' => '',
	'bonusWithdrawlCondition' => ''
);

if(isset($_POST) && is_array($_POST) && count($_POST) > 0){
    if($Card->updateBonusCard($_POST, $_FILES)){
    	C::redirect(C::link('bonus-card.php', false, true));
    }	
}

$activeNavigation = "bonus";
?>
<?php require_once('includes/doc_head.php'); ?>
<section class="content">
	<section class="widget">
		<div class="panel panel-default bt-panel" style="box-shadow:none;">
			<div class="panel-heading">
				<span class="icon">&#128196;</span>
				<hgroup>
					<h5>Bonus Card</h5>
					<h6>All uploaded files</h6>
				</hgroup>
			</div>
			<div class="panel-body">
			<form action="" method="post" enctype="multipart/form-data" autocomplete="on">
			<?php
			if(isset($_GET['edit']) && trim($_GET['edit'])){
				$editID = $_GET['edit'];
				$result = $User->query("SELECT `id`, `joinCode`, `sportsName`, `bonusName`, `bonusCode`, `bonusOtherDetails`, `bonustype`, `bonusAmount`, `description`, `wageringRequirements`, `bonusImage`, `imageName`, `link`, `rating`, `isPopular`, `minDepositeAmpount`, `rollingCondition`, `bonusConUtilization`, `maxBonusAmount`, `maxCashout`, `bonusWithdrawlCondition` FROM `tblBonusCards` WHERE `id` = '" . $editID . "' LIMIT 0, 1");
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
					$editValue['minDepositeAmpount'] = $result[0]['minDepositeAmpount'];
					$editValue['rollingCondition'] = $result[0]['rollingCondition'];
					$editValue['bonusConUtilization'] = $result[0]['bonusConUtilization'];
					$editValue['maxBonusAmount'] = $result[0]['maxBonusAmount'];
					$editValue['maxCashout'] = $result[0]['maxCashout'];
					$editValue['bonusWithdrawlCondition'] = $result[0]['bonusWithdrawlCondition'];
				}
			?>
				<div class="content">
					<div class="field-wrap">
						<div class="field-wrap-half form-group">
							<input type="text" value="<?php echo $editValue['joinCode'];?>" name="joinCode" placeholder="Join Code" />
							<input type="hidden" value="<?php echo $editValue['id'];?>" name="id" placeholder="id" />
						</div>
						<div class="field-wrap-half form-group">
							<!-- <input type="text" value="<?php echo $editValue['sportsName'];?>" name="sportsName" placeholder="Sports Name" /> -->
							<select name="sportsName">
								<option>--Select sports name--</option>
								<?php
									$res = $User->query("SELECT DISTINCT `sportsName`, `link` FROM `tblWebCards` UNION SELECT DISTINCT `sportsName`, `link` FROM `tblSadariCards` GROUP BY `sportsName`");
										if(isset($res) && is_array($res) && count($res) > 0){
											foreach ($res as $id => $data) {
								?>
									<option <?php if($editValue['sportsName'] == $data['sportsName'] ){ echo 'selected'; }?> value="<?php echo $data['sportsName']; ?>"><?php echo $data['sportsName']; ?></option>
								<?php
									}
								}
								?>
							</select>
						</div>
					</div>
					<div class="field-wrap">
						<div class="field-wrap-half form-group">
							<input type="text" value="<?php echo $editValue['bonusName'];?>" name="bonusName" placeholder="Bonuse Name" />
						</div>
						<div class="field-wrap-half form-group">
							<input type="text" value="<?php echo $editValue['bonusCode'];?>" name="bonusCode" placeholder="Bonus Code" />
						</div>
					</div>
					<div class="field-wrap">
						<div class="field-wrap-half form-group">
							<select name="bonustype" id="bonustype">
								<option value="0">-- CHOOSE BONUS TYPE --</option>
								<option <?php if ($editValue['bonustype'] == 'Welcome Bonus' ) echo 'selected' ; ?> value="Welcome Bonus">Welcome Bonus</option>
								<option <?php if ($editValue['bonustype'] == 'First Deposite Bonus' ) echo 'selected' ; ?> value="First Deposite Bonus">First Deposite Bonus</option>
								<option <?php if ($editValue['bonustype'] == 'Every Time Bonus' ) echo 'selected' ; ?> value="Every Time Bonus">Every Time Bonus</option>
								<option <?php if ($editValue['bonustype'] == 'Rolling Bonus' ) echo 'selected' ; ?> value="Rolling Bonus">Rolling Bonus</option>
								<option <?php if ($editValue['bonustype'] == 'Free Money' ) echo 'selected' ; ?> value="Free Money">Free Money</option>
								<option <?php if ($editValue['bonustype'] == 'Combo Bonus' ) echo 'selected' ; ?> value="Combo Bonus">Combo Bonus</option>
								<option <?php if ($editValue['bonustype'] == 'Rebate Bonus' ) echo 'selected' ; ?> value="Rebate Bonus">Rebate Bonus</option>
								<option <?php if ($editValue['bonustype'] == 'Other Bonus' ) echo 'selected' ; ?> value="Other Bonus">Other Bonus</option>
							</select>
						</div>
						<div class="field-wrap-half form-group">
							<input type="text" value="<?php echo $editValue['bonusAmount'];?>" name="bonusAmount" placeholder="Bonus Amount" />
						</div>
					</div>
					<div class="field-wrap form-group">
						<textarea name="bonusDesc" id="" rows="4" placeholder="Bonus Description"><?php echo $editValue['bonusDesc'];?></textarea>
					</div>
					<div class="field-wrap">
						<div class="field-wrap-half form-group">
							<input type="text" value="<?php echo $editValue['wageringRequirements'];?>" name="wageringRequirements" placeholder="Wager" />
						</div>
						<div class="field-wrap-half form-group">
							<input type="text" value="<?php echo $editValue['link'];?>" name="link" placeholder="Site Link" />
						</div>
					</div>
					<div class="field-wrap form-group">
						<img src="<?php echo HOST . '/' .$editValue['bonusImage'];?>" alt="" style="width:100px;height:100px;" />
						<input type="file" name="bonusImageUpdate" />
					</div><br />
					<div class="field-wrap form-group">
						<input type="text" value="<?php echo $editValue['imageName'];?>" name="imageName" placeholder="Image Name" style="margin-bottom:2px;"/>
						
					</div>
					
					<h2 style="margin-top:10px;font-size:14px;font-weight:800;">Additional Bonus Details</h2>
					<div class="addBonusDetailsParent">
						<div class="field-wrap form-group" id="">
							<?php 
							$res = $editValue['bonusOtherDetails'];
							//echo $editValue['bonusOtherDetails'];
							if(isset($res) && $res != 'Array+Array'){
								$res = explode('+', $editValue['bonusOtherDetails']);
								$label = explode(',', $res['0']);
								$datas = explode(',',$res['1']);
								foreach ($label as $index => $val) {
							?>
							<div class="child-wrap form-group">
								<input type="text" value="<?php echo $val; ?>" name="addBonusDetailsLabel[]" class="addBonusDetailsLabel" placeholder="Label" style="margin-left: 0px;margin-bottom:10px;" />
								<input type="text" value="<?php echo $datas[$index]; ?>" name="addBonusDetailsValue[]" class="addBonusDetailsValue" placeholder="Value" style="margin-left: 0px;margin-bottom:10px;" />
							</div>
						<?php
								}
							}else{
						?>
							<div class="child-wrap form-group">
								<input type="text" value="" name="addBonusDetailsLabel[]" class="addBonusDetailsLabel" placeholder="Label" style="margin-left: 0px;margin-bottom:10px;" />
								<input type="text" value="" name="addBonusDetailsValue[]" class="addBonusDetailsValue" placeholder="Value" style="margin-left: 0px;margin-bottom:10px;" />
							</div>
						<?php		
							}
						?>
						</div>
					</div>
					<div class="field-wrap">
						<button type="button" class="btn btn-success" id="addDetails" style="margin-right:5px;">Add More</button><button type="button" class="btn btn-warning" id="deleteDetails">Delete Last</button>
					</div><br>
					<div style="clear:both;"></div>
					<div class="field-wrap">
						<div class="field-wrap-half form-group">
							<select name="categoryType" id="categoryType">
								<option value="0">-- CHOOSE BONUS SECTION --</option>
								<option <?php if ($editValue['isPopular'] == 'N' ) echo 'selected' ; ?> value="N">Normal</option>
								<option <?php if ($editValue['isPopular'] == 'Y' ) echo 'selected' ; ?> value="Y">Popular</option>
							</select>
							<!--<input type="hidden" name="categoryType" value="" placeholder="Category Type" />-->
						</div>
						<div class="field-wrap-half form-group">
							<select name="rate" id="rate">
								<option value="0">-- GIVE RATING --</option>
								<option <?php if ($editValue['rating'] == 1 ) echo 'selected' ; ?> value="1">&#9734;</option>
								<option <?php if ($editValue['rating'] == 2 ) echo 'selected' ; ?> value="2">&#9734;&#9734;</option>
								<option <?php if ($editValue['rating'] == 3 ) echo 'selected' ; ?> value="3">&#9734;&#9734;&#9734;</option>
								<option <?php if ($editValue['rating'] == 4 ) echo 'selected' ; ?> value="4">&#9734;&#9734;&#9734;&#9734;</option>
								<option <?php if ($editValue['rating'] == 5 ) echo 'selected' ; ?> value="5">&#9734;&#9734;&#9734;&#9734;&#9734;</option>
							</select>	
						</div>
					</div>
					<div class="field-wrap">
						<div class="field-wrap-half form-group">
							<input type="text" value="<?php echo $editValue['minDepositeAmpount'];?>" name="minDepositeAmpount" placeholder="Minimum Deposite Amount"/>
						</div>
						<div class="field-wrap-half form-group">
							<input type="text" value="<?php echo $editValue['rollingCondition'];?>" name="rollingCondition" placeholder="Rolling Condition"/>
						</div>
					</div>
					<div class="field-wrap">
						<div class="field-wrap-half form-group">
							<input type="text" value="<?php echo $editValue['bonusConUtilization'];?>" name="bonusConUtilization" placeholder="Bonus condition of utilization"/>
						</div>
						<div class="field-wrap-half form-group">
							<input type="text" value="<?php echo $editValue['maxBonusAmount'];?>" name="maxBonusAmount" placeholder="Max Bonus Amount"/>
						</div>
					</div>
					<div class="field-wrap">
						<div class="field-wrap-half form-group">
							<input type="text" value="<?php echo $editValue['maxCashout'];?>" name="maxCashout" placeholder="Max Cashout"/>
						</div>
						<div class="field-wrap-half form-group">
							<input type="text" value="<?php echo $editValue['bonusWithdrawlCondition'];?>" name="bonusWithdrawlCondition" placeholder="Bonus Withdrawl Condition"/>
						</div>
					</div>
					<?php
					}
					?>	
					<button type="submit" class="btn btn-info">Update Card</button> <!-- <button type="submit" class="">Preview</button> -->
				</div>
			</div>
		</form>
	</section>	
</section>
<?php require_once('includes/doc_footer.php'); ?>