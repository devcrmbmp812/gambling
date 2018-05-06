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
	$Common->redirect('index.php');
}

$editValue = array(
	'sportsName' => '',
	'joinCode' => '',
	'siteName' => '',
	'maxPrizeMoney' => '',
	'singleBet' => '',
	'crossBetting' => '',
	'sportsDesc' => '',
	'welcomeBonus' => '',
	'miniGame' => '',
	'sportsImage' => '',
	'imageName' => '',
	'id' => '',
	'link' => '',
	'rating' => '',
	'isRecommanded' => '',
	'sportsOtherDetails' => '',
	'isHot' => '',
	'sportsType' => '',
	'sportsRevw' => ''
);

if(isset($_POST) && is_array($_POST) && count($_POST) > 0){
    if($Card->updateWebCard($_POST)){
    	C::redirect(C::link('web-card.php', false, true));
    }	
}
?>
<?php require_once('includes/doc_head.php'); ?>
<section class="alert">
	<div class="green">	
		<!-- <p style="text-transform:uppercase;"><?php echo $the_message; ?></p> -->
		<!-- <span class="close">&#10006;</span> -->
		<?php
		if(isset($fieldArray)){
		?>
		<p style="text-transform:uppercase;"><?php echo $the_message; ?></p>
		<span class="close">&#10006;</span>
		<?php
		}
		?>
	</div>
</section>
<section class="content">
	<section class="widget">
		<form action="" method="post" enctype="multipart/form-data">
			<header>
				<span class="icon">&#128196;</span>
				<hgroup>
					<h1>Web Card</h1>
					<h2>All uploaded files</h2>
				</hgroup>
			</header>
			<?php
			if(isset($_GET['edit']) && trim($_GET['edit'])){
				$editID = $_GET['edit'];
				$result = $User->query("SELECT `sportsName`, `joinCode`, `siteName`, `sportsReview`, `description`, `maxPrizeMoney`, `singleBet`, `crossBetting`, `welcomeBonus`, `miniGame`, `sportsImage`, `imageName`, `link`, `id`, `rating`, `isRecommanded`, `isHot`, `sportsType`, `sportsOtherDetails` FROM `tblWebCards` WHERE `id` = '" . $editID . "' LIMIT 0, 1");
				if($result && is_array($result) && count($result) > 0){
					$editValue['sportsName'] = $result[0]['sportsName'];
					$editValue['joinCode'] = $result[0]['joinCode'];
					$editValue['siteName'] = $result[0]['siteName'];
					$editValue['sportsDesc'] = $result[0]['description'];
					$editValue['maxPrizeMoney'] = $result[0]['maxPrizeMoney'];
					$editValue['singleBet'] = $result[0]['singleBet'];
					$editValue['crossBetting'] = $result[0]['crossBetting'];
					$editValue['welcomeBonus'] = $result[0]['welcomeBonus'];
					$editValue['miniGame'] = $result[0]['miniGame'];
					$editValue['sportsImage'] = $result[0]['sportsImage'];
					$editValue['imageName'] = $result[0]['imageName'];
					$editValue['link'] = $result[0]['link'];
					$editValue['sportsRevw'] = $result[0]['sportsReview'];
					$editValue['id'] = $result[0]['id'];
					$editValue['rating'] = $result[0]['rating'];
					$editValue['isRecommanded'] = $result[0]['isRecommanded'];
					$editValue['isHot'] = $result[0]['isHot'];
					$editValue['sportsType'] = $result[0]['sportsType'];
					$editValue['sportsOtherDetails'] = $result[0]['sportsOtherDetails'];
				}
			?>
			<div class="content">
				<div class="field-wrap">
					<input type="text" value="<?php echo $editValue['sportsName'];?>" name="sportsName" placeholder="Sports Name" />
					<input type="hidden" value="<?php echo $editValue['id'];?>" name="id" />
				</div>
				<div class="field-wrap">
					<input type="text" value="<?php echo $editValue['joinCode'];?>" name="joinCode" placeholder="Join Code" />
				</div>
				<!-- <div class="field-wrap">
					<input type="text" value="<?php echo $editValue['siteName'];?>" name="siteName" placeholder="Website Name" />
				</div> -->
				<!--<div class="field-wrap">
					<input type="text" value="" name="bonusCode" placeholder="Bonus Code" />
				</div>-->
				<div class="field-wrap">
					<textarea name="sportsDesc" id="" rows="4" placeholder="Sports Description"><?php echo $editValue['sportsDesc'];?></textarea>
				</div>
				<!--<div class="field-wrap">
					<input type="text" value="" name="wageringRequirements" placeholder="Wager" />
				</div>-->
				<div class="field-wrap">
					<input type="text" value="<?php echo $editValue['link'];?>" name="link" placeholder="Site Link" />
				</div>
				<div class="field-wrap">
					<input type="text" value="<?php echo $editValue['maxPrizeMoney'];?>" name="maxPrizeMoney" placeholder="Max Prize Money" />
				</div>
				<div class="field-wrap">
					<input type="text" value="<?php echo $editValue['singleBet'];?>" name="singleBet" placeholder="Single Bet" />
				</div>
				<div class="field-wrap">
					<input type="text" value="<?php echo $editValue['crossBetting'];?>" name="crossBetting" placeholder="Cross Betting" />
				</div>
				<div class="field-wrap">
					<input type="text" value="<?php echo $editValue['welcomeBonus'];?>" name="welcomeBonus" placeholder="Welcome Bonus" />
				</div>
				<div class="field-wrap">
					<input type="text" value="<?php echo $editValue['miniGame'];?>" name="miniGame" placeholder="Mini Game" />
				</div>
				<div class="field-wrap">
					<img src="<?php echo $editValue['sportsImage'];?>" alt="" style="width:100px;height:100px;" />
				</div><br />
				<div class="field-wrap">
					<input type="text" value="<?php echo $editValue['imageName'];?>" name="imageName" placeholder="Image Name" />
					<span style="color:#ff0000;">** every image must have different name **</span>
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
					<button type="button" class="red" id="addDetails">Add More</button><button type="button" class="blue" id="deleteDetails">Delete Last</button>
				</div><br>
				<div class="field-wrap">
					<select name="categoryType" id="categoryType">
						<option value="0">-- CHOOSE RECOMMANDATION --</option>
						<option <?php if ($editValue['isRecommanded'] == 'N' ) echo 'selected' ; ?> value="N">Normal</option>
						<option <?php if ($editValue['isRecommanded'] == 'Y' ) echo 'selected' ; ?> value="Y">Recommanded</option>
					</select>
					
				</div>
				<div class="field-wrap">
					<select name="hotNew" id="hotNew">
						<option value="0">-- CHOOSE HOT OR NEW --</option>
						<option <?php if ($editValue['isHot'] == 'H' ) echo 'selected' ; ?> value="H">HOT</option>
						<option <?php if ($editValue['isHot'] == 'N' ) echo 'selected' ; ?> value="N">NEW</option>
					</select>
					
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