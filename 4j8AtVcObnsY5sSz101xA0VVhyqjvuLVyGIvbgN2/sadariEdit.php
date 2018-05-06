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

$editValue = array(
	'sportsName' => '',
	'joinCode' => '',
	'sportsDesc' => '',
	'sportsDesc' => '',
	'link' => '',
	'siteName' => '',
	'sadariOdd' => '',
	'wager' => '',
	'maximumBetting' => '',
	'ruMatin' => '',
	'closingTime' => '',
	'sportsImage' => '',
	'imageName' => '',
	'sportsRevw' => '',
	'rating' => '',
	'isRecommanded' => '',
	'isHot' => '',
	'id' => '',
	'sportsOtherDetails' => '',
	'minBettingAmount' => '',
	'bettingOption' => '',
	'rollingCondition' => '',
	'maxAwardAmount' => ''
);

if(isset($_POST) && is_array($_POST) && count($_POST) > 0){
    if($Card->updateSadariCard($_POST, $_FILES)){
    	C::redirect(C::link('sadari.php', false, true));
    }	
}

$activeNavigation = "sadari";
?>
<?php require_once('includes/doc_head.php'); ?>
<section class="content">
	<section class="widget">
		<form action="" method="post" enctype="multipart/form-data">
			<header>
				<span class="icon">&#128196;</span>
				<hgroup>
					<h1>Sadari Edit</h1>
					<h2>All uploaded files</h2>
				</hgroup>
			</header>
			<?php
			if(isset($_GET['edit']) && trim($_GET['edit'])){
				$editID = $_GET['edit'];
				
				$result = $User->query("SELECT `sportsName`, `joinCode`, `siteName`, `sportsReview`, `sportsOtherDetails`, `description`, `sadariOdd`, `sportsImage`, `imageName`, `wager`, `maximumBetting`, `ruMatin`, `closingTime`, `link`, `id`, `rating`, `isRecommanded`, `isHot`, `minBettingAmount`, `bettingOption`, `rollingCondition`, `maxAwardAmount` FROM `tblSadariCards` WHERE `id` = '" . $editID . "' LIMIT 0, 1");
				if($result && is_array($result) && count($result) > 0){
					$editValue['sportsName'] = $result[0]['sportsName'];
					$editValue['joinCode'] = $result[0]['joinCode'];
					$editValue['siteName'] = $result[0]['siteName'];
					$editValue['sportsDesc'] = $result[0]['description'];
					$editValue['sadariOdd'] = $result[0]['sadariOdd'];
					$editValue['sportsImage'] = $result[0]['sportsImage'];
					$editValue['imageName'] = $result[0]['imageName'];
					$editValue['wager'] = $result[0]['wager'];
					$editValue['maximumBetting'] = $result[0]['maximumBetting'];
					$editValue['ruMatin'] = $result[0]['ruMatin'];
					$editValue['closingTime'] = $result[0]['closingTime'];
					$editValue['link'] = $result[0]['link'];
					$editValue['sportsRevw'] = $result[0]['sportsReview'];
					$editValue['rating'] = $result[0]['rating'];
					$editValue['isRecommanded'] = $result[0]['isRecommanded'];
					$editValue['isHot'] = $result[0]['isHot'];
					$editValue['id'] = $result[0]['id'];
					$editValue['sportsOtherDetails'] = $result[0]['sportsOtherDetails'];
					$editValue['minBettingAmount'] = $result[0]['minBettingAmount'];
					$editValue['bettingOption'] = $result[0]['bettingOption'];
					$editValue['rollingCondition'] = $result[0]['rollingCondition'];
					$editValue['maxAwardAmount'] = $result[0]['maxAwardAmount'];
				}
			?>
			<div class="content">
				<div class="field-wrap">
					<div class="field-wrap-half">
						<input type="text" value="<?php echo $editValue['sportsName'];?>" name="sportsName" placeholder="Sports Name" />
						<input type="hidden" value="<?php echo $editValue['id'];?>" name="id" />
					</div>
					<div class="field-wrap-half">
						<input type="text" value="<?php echo $editValue['joinCode'];?>" name="joinCode" placeholder="Join Code" />
					</div>
				</div>
				<div class="field-wrap">
					<div class="field-wrap-half">
						<input type="text" value="<?php echo $editValue['siteName'];?>" name="siteName" placeholder="Website Name" />
					</div>
					<div class="field-wrap-half">
						<input type="text" value="<?php echo $editValue['link'];?>" name="link" placeholder="Site Link" />
					</div>
				</div>
				<div class="field-wrap">
					<textarea name="sportsDesc" id="" rows="4" placeholder="Sports Description"><?php echo $editValue['sportsDesc'];?></textarea>
				</div>
				<div class="field-wrap">
					<div class="field-wrap-half">
						<input type="text" value="<?php echo $editValue['sadariOdd'];?>" name="sadariOdd" placeholder="Sadari Odd" />
					</div>
					<div class="field-wrap-half">
						<input type="text" value="<?php echo $editValue['wager'];?>" name="wager" placeholder="Wager" />	
					</div>
				</div>
				<div class="field-wrap">
					<div class="field-wrap-half">
						<input type="text" value="<?php echo $editValue['ruMatin'];?>" name="ruMatin" placeholder="Rutin/Matin" />
					</div>
					<div class="field-wrap-half">
						<input type="text" value="<?php echo $editValue['closingTime'];?>" name="closingTime" placeholder="Closing Time" />
					</div>
				</div>
				<div class="field-wrap">
					<div class="field-wrap-half">
						<input type="text" value="<?php echo $editValue['maximumBetting'];?>" name="maximumBetting" placeholder="Maximum Betting Amount" />
					</div>
					<div class="field-wrap-half">
						<input type="text" value="<?php echo $editValue['minBettingAmount'];?>" name="minBettingAmount" placeholder="Minimum Betting Amount" />
					</div>
				</div>
				<div class="field-wrap">
					<img src="<?php echo HOST . '/' .$editValue['sportsImage'];?>" alt="" style="width:100px;height:100px;" />
					<input type="file" name="sportsImageUpdate" />
				</div><br />
				<div class="field-wrap">
					<input type="text" value="<?php echo $editValue['imageName'];?>" name="imageName" placeholder="Image Name" disabled/>
				</div>

				<h2 style="margin-top:10px;font-size:14px;font-weight:800;">Additional Sports Details</h2>
				<div class="addBonusDetailsParent">
					<div class="field-wrap" id="">
						<?php 
						$res = $editValue['sportsOtherDetails'];
						if(isset($res)){
							$res = explode('+', $editValue['sportsOtherDetails']);
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
					<div class="field-wrap-half">
						<select name="categoryType" id="categoryType">
							<option value="0">-- CHOOSE RECOMMANDATION --</option>
							<option <?php if ($editValue['isRecommanded'] == 'N' ) echo 'selected' ; ?> value="N">Normal</option>
							<option <?php if ($editValue['isRecommanded'] == 'Y' ) echo 'selected' ; ?> value="Y">Recommanded</option>
						</select>
					</div>
					<div class="field-wrap-half">
						<select name="hotNew" id="hotNew">
							<option value="0">-- CHOOSE HOT OR NEW --</option>
							<option <?php if ($editValue['isHot'] == 'H' ) echo 'selected' ; ?> value="H">HOT</option>
							<option <?php if ($editValue['isHot'] == 'N' ) echo 'selected' ; ?> value="N">NEW</option>
						</select>
					</div>	
				</div>
				<h2 style="margin-top:10px;font-size:14px;font-weight:800;">Filter Option</h2>
				<div class="field-wrap">
					<div class="field-wrap-half">
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
					$str2 = $editValue['bettingOption'];
				 	$bettingOption = explode(",",$str2);
					?>
					<div class="field-wrap-half">

						<table width="100%" class="add-new" data-appnd=".mingm" data-type="betting-option">
							<tr>
								<td>
									<select name="bettingOption[]" class="chosen-select" multiple  tabindex="4" >
										<?php 
										$res = $Base->query("SELECT `id`, `value` FROM `tblFilter` WHERE `name` = 'betting-option'");
											if(is_array($res) && count($res) > 0){
												foreach ($res as $key => $value) {
													$v = $value['value'];
										?>
										<option <?php if(in_array("$v", $bettingOption)){ echo "selected";}?> value="<?php echo $v;?>"><?php echo $v;?></option>
										<?php 
											}
										}
										?>
									</select>
								</td>
							</tr>
						</table>
					</div>
				</div>
				<div style="clear:both;"></div>
				<div class="field-wrap">
					<div class="field-wrap-half">
						<input type="text" value="<?php echo $editValue['rollingCondition'];?>" name="rollingCondition" placeholder="Rolling Condition" />
					</div>
					<div class="field-wrap-half">
						<input type="text" value="<?php echo $editValue['maxAwardAmount'];?>" name="maxAwardAmount" placeholder="Max Award Amount" />
					</div>
				</div>
				<div style="clear:both;"></div>
				<div class="field-wrap">
					<textarea name="sportsRevw" id="editor" rows="20"><?php echo $editValue['sportsRevw'];?></textarea>
				</div>
				<br />
				<?php
				}
				?>
				<button type="submit" class="green">Update Card</button> <!-- <button type="submit" class="">Preview</button> -->
			</div>
		</form>
	</section>
</section>

<?php require_once('includes/doc_footer.php'); ?>