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
	'categoryContent' => ''
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
		<header>
			<span class="icon">&#128196;</span>
			<hgroup>
				<h1>Data</h1>
				<h2>Put your data here</h2>
			</hgroup>
		</header>
		<div class="content">
			<form action="" method="post" enctype="multipart/form-data">
			<?php
			if(isset($_GET['edit']) && trim($_GET['edit'])){
				$editID = $_GET['edit'];
				$result = $User->query("SELECT `id`, `categoryPage`, `categoryTitle`, `categoryContent` FROM `tblContent` WHERE `id` = '" . $editID . "' LIMIT 0, 1");
				if($result && is_array($result) && count($result) > 0){
					$editValue['id'] = $result[0]['id'];
					$editValue['categoryPage'] = $result[0]['categoryPage'];
					$editValue['categoryTitle'] = $result[0]['categoryTitle'];
					$editValue['categoryContent'] = $result[0]['categoryContent'];
				}
			?>
				<div class="field-wrap">
					<select name="categoryPage" id="ParentName">
						<option value="">-- Choose Page Name --</option>
						<option <?php if ($editValue['categoryPage'] == 'sports' ) echo 'selected' ; ?> value="sports">Sports</option>
						<option <?php if ($editValue['categoryPage'] == 'Online sport' ) echo 'selected' ; ?> value="Online sport">Online sport</option>
						<option <?php if ($editValue['categoryPage'] == 'Newest sport' ) echo 'selected' ; ?> value="Newest sport">Newest sport</option>
						<option <?php if ($editValue['categoryPage'] == 'Verified sport' ) echo 'selected' ; ?> value="Verified sport">Verified sport</option>
						<option <?php if ($editValue['categoryPage'] == 'Bitcoin sport' ) echo 'selected' ; ?> value="Bitcoin sport">Bitcoin sport</option>
						<option <?php if ($editValue['categoryPage'] == 'Mobile sport' ) echo 'selected' ; ?> value="Mobile sport">Mobile sport</option>
						<option <?php if ($editValue['categoryPage'] == 'Sadari sport' ) echo 'selected' ; ?> value="Sadari sport">Sadari sport</option>
						<option <?php if ($editValue['categoryPage'] == 'bonus' ) echo 'selected' ; ?> value="bonus">Bonus</option>
						<option <?php if ($editValue['categoryPage'] == 'Welcome Bonus' ) echo 'selected' ; ?> value="Welcome Bonus">Welcome Bonus</option>
						<option <?php if ($editValue['categoryPage'] == 'First Deposite Bonus' ) echo 'selected' ; ?> value="First Deposite Bonus">First Deposite Bonus</option>
						<option <?php if ($editValue['categoryPage'] == 'Every Time Bonus' ) echo 'selected' ; ?> value="Every Time Bonus">Every Time Bonus</option>
						<option <?php if ($editValue['categoryPage'] == 'Rolling Bonus' ) echo 'selected' ; ?> value="Rolling Bonus">Rolling Bonus</option>
						<option <?php if ($editValue['categoryPage'] == 'Free Money' ) echo 'selected' ; ?> value="Free Money">Free Money</option>
						<option <?php if ($editValue['categoryPage'] == 'Combo Bonus' ) echo 'selected' ; ?> value="Combo Bonus">Combo Bonus</option>
						<option <?php if ($editValue['categoryPage'] == 'Rebate Bonus' ) echo 'selected' ; ?> value="Rebate Bonus">Rebate Bonus</option>
						<option <?php if ($editValue['categoryPage'] == 'Other Bonus' ) echo 'selected' ; ?> value="Other Bonus">Other Bonus</option>
						<option <?php if ($editValue['categoryPage'] == 'news' ) echo 'selected' ; ?> value="news">News</option>
						<option <?php if ($editValue['categoryPage'] == 'N' ) echo 'selected' ; ?> value="N">NEWS</option>
						<option <?php if ($editValue['categoryPage'] == 'B' ) echo 'selected' ; ?> value="B">BLOG</option>
						<option <?php if ($editValue['categoryPage'] == 'complaint' ) echo 'selected' ; ?> value="complaint">Complaint</option>
						<option <?php if ($editValue['categoryPage'] == 'contact' ) echo 'selected' ; ?> value="contact">Contact</option>
						<option <?php if ($editValue['categoryPage'] == 'privacy Policy' ) echo 'selected' ; ?> value="privacy Policy">Privacy Policy</option>
						<option <?php if ($editValue['categoryPage'] == 'posting guidlince' ) echo 'selected' ; ?> value="posting guidlince">posting guidlince</option>
					</select>
				</div>
				<div class="field-wrap">
					<input type="text" name="categoryTitle" value="<?php echo $editValue['categoryTitle'] ; ?>" placeholder="Content Title" />
				</div>
				<div class="field-wrap">
					<textarea id="editor" name="categoryContent" rows="20"><?php echo $editValue['categoryContent'] ; ?></textarea>
				</div><br />
				<?php
				}
				?>
				<button type="submit" class="green">Update</button> <!-- <button type="submit" class="">Preview</button> -->
			</form>
		</div>
	</section>
</section>
<?php require_once('includes/doc_footer.php'); ?>