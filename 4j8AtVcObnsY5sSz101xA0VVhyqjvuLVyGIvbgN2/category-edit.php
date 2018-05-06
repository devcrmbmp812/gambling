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
	'categoryPage' => '',
	'categoryTitle' => '',
	'categoryContent' => '',
	'metaTitle' => '',
	'metaKeyword' => '',
	'metaDesc' => ''
);

if(isset($_POST) && is_array($_POST) && count($_POST) > 0){
    if($Card->pageContentUpdate($_POST)){
    	C::redirect(C::link('category.php', false, true));
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
					<h5>Data</h5>
					<h6>Put your data here</h6>
				</hgroup>
			</div>
			<div class="panel-body">
				<div class="content">
					<form action="" method="post" enctype="multipart/form-data">
					<?php
					if(isset($_GET['edit']) && trim($_GET['edit'])){
						$editID = $_GET['edit'];
						$result = $User->query("SELECT `id`, `categoryPage`, `categoryTitle`, `categoryContent`, `metaTitle`, `metaKeyword`, `metaDesc` FROM `tblContent` WHERE `id` = '" . $editID . "' LIMIT 0, 1");
						if($result && is_array($result) && count($result) > 0){
							$editValue['id'] = $result[0]['id'];
							$editValue['categoryPage'] = $result[0]['categoryPage'];
							$editValue['categoryTitle'] = $result[0]['categoryTitle'];
							$editValue['categoryContent'] = $result[0]['categoryContent'];
							$editValue['metaTitle'] = $result[0]['metaTitle'];
							$editValue['metaKeyword'] = $result[0]['metaKeyword'];
							$editValue['metaDesc'] = $result[0]['metaDesc'];
						}
					?>
						<div class="field-wrap form-group">
							<select name="categoryPage" id="ParentName">
								<option value="">-- Choose Page Name --</option>
								<option <?php if ($editValue['categoryPage'] == 'home' ) echo 'selected' ; ?> value="home">Home</option>
								<option <?php if ($editValue['categoryPage'] == 'sports' ) echo 'selected' ; ?> value="sports">Sports</option>
								<option <?php if ($editValue['categoryPage'] == 'Online sport' ) echo 'selected' ; ?> value="Online sport">Online sport</option>
								<option <?php if ($editValue['categoryPage'] == 'Newest sport' ) echo 'selected' ; ?> value="Newest sport">Newest sport</option>
								<option <?php if ($editValue['categoryPage'] == 'Verified sport' ) echo 'selected' ; ?> value="Verified sport">Verified sport</option>
								<option <?php if ($editValue['categoryPage'] == 'Bitcoin sport' ) echo 'selected' ; ?> value="Bitcoin sport">Bitcoin sport</option>
								<option <?php if ($editValue['categoryPage'] == 'Livebetting sport' ) echo 'selected' ; ?> value="Livebetting sport">Livebetting sport</option>
								<option <?php if ($editValue['categoryPage'] == 'Sadari sport' ) echo 'selected' ; ?> value="Sadari sport">Sadari sport</option>
								<option <?php if ($editValue['categoryPage'] == 'bonus' ) echo 'selected' ; ?> value="bonus">Bonus</option>
								<option <?php if ($editValue['categoryPage'] == '신규 첫충 보너스' ) echo 'selected' ; ?> value="신규 첫충 보너스">신규 첫충 보너스</option>
								<option <?php if ($editValue['categoryPage'] == '첫충전 보너스' ) echo 'selected' ; ?> value="첫충전 보너스">첫충전 보너스</option>
								<option <?php if ($editValue['categoryPage'] == '매번 충전 보너스' ) echo 'selected' ; ?> value="매번 충전 보너스">매번 충전 보너스</option>
								<option <?php if ($editValue['categoryPage'] == '롤링 보너스' ) echo 'selected' ; ?> value="롤링 보너스">롤링 보너스</option>
								<option <?php if ($editValue['categoryPage'] == '꽁머니 보너스' ) echo 'selected' ; ?> value="꽁머니 보너스">꽁머니 보너스</option>
								<option <?php if ($editValue['categoryPage'] == '다폴더 보너스' ) echo 'selected' ; ?> value="다폴더 보너스">다폴더 보너스</option>
								<option <?php if ($editValue['categoryPage'] == '낙첨금 보너스' ) echo 'selected' ; ?> value="낙첨금 보너스">낙첨금 보너스</option>
								<option <?php if ($editValue['categoryPage'] == '기타 보너스' ) echo 'selected' ; ?> value="기타 보너스">기타 보너스</option>
								<option <?php if ($editValue['categoryPage'] == 'news' ) echo 'selected' ; ?> value="news">News</option>
								<option <?php if ($editValue['categoryPage'] == 'N' ) echo 'selected' ; ?> value="N">NEWS</option>
								<option <?php if ($editValue['categoryPage'] == 'B' ) echo 'selected' ; ?> value="B">BLOG</option>
								<option <?php if ($editValue['categoryPage'] == 'complaint' ) echo 'selected' ; ?> value="complaint">Complaint</option>
								<option <?php if ($editValue['categoryPage'] == 'contact' ) echo 'selected' ; ?> value="contact">Contact</option>
								<option <?php if ($editValue['categoryPage'] == 'privacy Policy' ) echo 'selected' ; ?> value="privacy Policy">Privacy Policy</option>
								<option <?php if ($editValue['categoryPage'] == 'sports policy' ) echo 'selected' ; ?> value="sports policy">Sports Policy</option>
								<option <?php if ($editValue['categoryPage'] == 'posting guidlince' ) echo 'selected' ; ?> value="posting guidlince">posting guidlince</option>
								<option <?php if ($editValue['categoryPage'] == 'terms and condition' ) echo 'selected' ; ?> value="terms and condition">Terms and Condition</option>
								<option <?php if ($editValue['categoryPage'] == 'certificate of trust' ) echo 'selected' ; ?> value="certificate of trust">Certificate of trust</option>
								<option <?php if ($editValue['categoryPage'] == 'notice' ) echo 'selected' ; ?> value="notice">Notice</option>
							</select>
						</div>
						<div class="field-wrap form-group">
							<input type="text" name="categoryTitle" value="<?php echo $editValue['categoryTitle'] ; ?>" placeholder="Content Title" />
						</div>

						<div class="field-wrap form-group">
							<input type="text" name="metaTitle" value="<?php echo $editValue['metaTitle'] ; ?>" placeholder="Meta Title" />
						</div>
						<div class="field-wrap form-group">
							<input type="text" name="metaKeyword" value="<?php echo $editValue['metaKeyword'] ; ?>" placeholder="Meta Keyword" />
						</div>
						<div class="field-wrap form-group">
							<input type="text" name="metaDesc" value="<?php echo $editValue['metaDesc'] ; ?>" placeholder="Meta Description" />
						</div>

						<div class="field-wrap form-group">
							<textarea id="editor" name="categoryContent" rows="20"><?php echo $editValue['categoryContent'] ; ?></textarea>
						</div><br />
						<?php
						}
						?>
						<button type="submit" class="btn btn-warning">Update</button> <!-- <button type="submit" class="">Preview</button> -->
					</form>
				</div>
		</div>
	</section>
</section>
<?php require_once('includes/doc_footer.php'); ?>