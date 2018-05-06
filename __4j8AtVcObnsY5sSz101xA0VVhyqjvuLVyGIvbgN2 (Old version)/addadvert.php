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
    if($Card->insertAds($_POST, $_FILES)){
    	C::redirect(C::link('addadvert.php', false, true));
    }	
}
if(isset($_GET['delete']) && trim($_GET['delete'])){
	if($Card->deladds($_GET['delete'])){
		C::redirect(C::link('addadvert.php', false, true));
	}
} 

$activeNavigation = "ads";

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
			<form action="" method="POST" enctype="multipart/form-data">
				<div class="field-wrap">
					<input type="text" name="adsLink" placeholder="Link" required/>
				</div>
				<div class="field-wrap">
					<input type="text" name="adsSequence" placeholder="Sequence" required/>
				</div>
				<div class="field-wrap">
					<input type="file" name="sliderImage" placeholder="Place your Image"  required />
					<p style="color:red;">SIZE:300px width, 250px height</p>
					<input type="text" name="sliderImageName" placeholder="Image name"  required />
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
				<h1>ADVERTISEMENTS</h1>
				<h2>CMS content pages</h2>
			</hgroup>
		</header>
		<div class="content">
			<table id="myTable" border="0" width="100">
				<thead>
					<tr>
						<th>Image</th>
						<th>Image Name</th>
						<th>Link</th>
						<th>Sequence</th>
						<th>Action</th>
					</tr>
				</thead>
					<tbody>
					<?php
						$result = $Base->query("SELECT `id`, `adsImage`, `imageName`, `sequence`, `adsLink` FROM `tblAds`");
						if(is_array($result) && count($result) > 0){
							foreach ($result as $key => $value) {
										
					?>
						<tr>
							<td><input type="checkbox" /> <img src="<?php echo HOST .$value['adsImage']; ?>" style="width:100px;height:50px;" alt="" /></td>
							<td><?php echo $value['imageName']; ?></td>
							<td><?php echo $value['adsLink']; ?></td>
							<td><?php echo $value['sequence']; ?></td>
							<td>
								<a href="<?php echo C::link('advert-edit.php', array('edit' => $value['id']), true);?>" style="color:#fff;background:green;padding:5px;">EDIT</a>
								<a href="<?php echo C::link('addadvert.php', array('delete' => $value['id']), true);?>" style="color:#fff;background:#ff0000;padding:5px;">DELETE</a>
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