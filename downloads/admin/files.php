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

if(isset($_POST) && is_array($_POST) && count($_POST) > 0){
    if($Card->insertSlider($_POST, $_FILES)){
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
		<header>
			<span class="icon">&#127748;</span>
			<hgroup>
				<h1>Media gallery</h1>
				<h2>All uploaded files</h2>
			</hgroup>
		</header>
		<div class="content">
			<form action="" method="post" enctype="multipart/form-data">
				<div class="field-wrap">
					<input type="text" name="sliderHeading" placeholder="Heading" required/>
				</div>
				<div class="field-wrap wysiwyg-wrap">
					<textarea class="post" name="sliderText" rows="5" required></textarea>
				</div>
				<div class="field-wrap">
					<input type="file" name="sliderImage" placeholder="Place your Image"  required />
					<input type="text" name="sliderImageName" placeholder="Image name"  required />
				</div>
				<div style="width:100%">
					<div class="field-wrap" style="width:48%;float:left;margin-right:20px;">
						<input type="text" name="buttonOneName" placeholder="Button name" />
						<input type="text" name="buttonOneLink" placeholder="Button Link" />
						<select name="buttonOneColor" id="buttonOneColor">
							<option>--CHOOSE BUTTON COLOR--</option>
							<option value="green">Green</option>
							<option value="red">Red</option>
						</select>
					</div>
					<div class="field-wrap" style="width:48%;float:left;">
						<input type="text" name="buttonTwoName" placeholder="Button Two name" />
						<input type="text" name="buttonTwoLink" placeholder="Button Two Link" />
						<select name="buttonTwoColor" id="buttonOneColor">
							<option>--CHOOSE BUTTON COLOR--</option>
							<option value="green">Green</option>
							<option value="red">Red</option>
						</select>
					</div>
				</div>
				<br>
				<button type="submit" class="green">Post</button>
			</form>
		</div>
	</section>
</section>
<section class="content">
	<section class="widget">
		<header>
			<span class="icon">&#128196;</span>
			<hgroup>
				<h1>Pages</h1>
				<h2>CMS content pages</h2>
			</hgroup>
		</header>
		<div class="content">
			<table id="myTable" border="0" width="100">
				<thead>
					<tr>
						<th>Heading</th>
						<th>Text</th>
						<th>Image</th>
						<th>Image Name</th>
						<th>Action</th>
					</tr>
				</thead>
					<tbody>
					<?php
						$result = $Base->query("SELECT `id`, `sliderImage`, `sliderImageName`, `sliderHeading`, `sliderText` FROM `tblSlider`");
						if(is_array($result) && count($result) > 0){
							foreach ($result as $key => $value) {
							$sliderText = substr($value['sliderText'], 0, 50);			
					?>
						<tr>
							<td><input type="checkbox" /> <?php echo $value['sliderHeading']; ?></td>
							<td><?php echo $sliderText; ?></td>
							<td><img src="<?php echo $value['sliderImage']; ?>" style="width:100px;height:50px;" alt="" /></td>
							<td><?php echo $value['sliderImageName']; ?></td>
							<td>
								<a href="<?php echo C::link('files-edit.php', array('edit' => $value['id']), true);?>" style="color:#fff;background:green;padding:5px;">EDIT</a>
								<a href="<?php echo C::link('files.php', array('delete' => $value['id']), true);?>" style="color:#fff;background:#ff0000;padding:5px;">DELETE</a>
							</td>
						</tr>
					<?php
						}
					}
					?>
					</tbody>
				</table>
		</div>
	</section>
</section>
<?php require_once('includes/doc_footer.php'); ?>