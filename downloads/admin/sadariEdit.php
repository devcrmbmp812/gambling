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
	'id' => ''
);

if(isset($_POST) && is_array($_POST) && count($_POST) > 0){
    if($Card->updateSadariCard($_POST)){
    	C::redirect(C::link('sadari.php', false, true));
    }	
}


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
				
				$result = $User->query("SELECT `sportsName`, `joinCode`, `siteName`, `sportsReview`, `description`, `sadariOdd`, `sportsImage`, `imageName`, `wager`, `maximumBetting`, `ruMatin`, `closingTime`, `link`, `id`, `rating`, `isRecommanded`, `isHot` FROM `tblSadariCards` WHERE `id` = '" . $editID . "' LIMIT 0, 1");
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
				<div class="field-wrap">
					<input type="text" value="<?php echo $editValue['siteName'];?>" name="siteName" placeholder="Website Name" />
				</div>
				<div class="field-wrap">
					<textarea name="sportsDesc" id="" rows="4" placeholder="Sports Description"><?php echo $editValue['sportsDesc'];?></textarea>
				</div>
				<div class="field-wrap">
					<input type="text" value="<?php echo $editValue['link'];?>" name="link" placeholder="Site Link" />
				</div>
				<div class="field-wrap">
					<input type="text" value="<?php echo $editValue['sadariOdd'];?>" name="sadariOdd" />
				</div>
				<div class="field-wrap">
					<input type="text" value="<?php echo $editValue['wager'];?>" name="wager" />
				</div>
				<div class="field-wrap">
					<input type="text" value="<?php echo $editValue['maximumBetting'];?>" name="maximumBetting" />
				</div>
				<div class="field-wrap">
					<input type="text" value="<?php echo $editValue['ruMatin'];?>" name="ruMatin" />
				</div>
				<div class="field-wrap">
					<input type="text" value="<?php echo $editValue['closingTime'];?>" name="closingTime" />
				</div>
				<div class="field-wrap">
					<img src="<?php echo $editValue['sportsImage'];?>" alt="" style="width:100px;height:100px;" />
				</div><br />
				<div class="field-wrap">
					<input type="text" value="<?php echo $editValue['imageName'];?>" name="imageName" placeholder="Image Name" />
					<span style="color:#ff0000;">** every image must have different name **</span>
				</div>
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