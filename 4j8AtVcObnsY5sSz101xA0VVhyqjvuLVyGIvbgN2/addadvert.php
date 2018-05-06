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
		<div class="panel panel-default bt-panel" style="box-shadow:none;">
			<div class="panel-heading">
				<span class="icon">&#128196;</span>
				<hgroup>
					<h5>Advertisment</h5>
					<h6>All uploaded files</h6>
				</hgroup>
			</div>
			<div class="panel-body">
				<div class="content">
					<form action="" method="POST" enctype="multipart/form-data">
						<div class="field-wrap form-group">
							<input type="text" name="adsLink" placeholder="Link" required/>
						</div>
						<div class="field-wrap form-group">
							<input type="text" name="adsSequence" placeholder="Sequence" required/>
						</div>
						<div class="field-wrap">
							<div class="field-wrap-half form-group">
								<input type="file" name="sliderImage" placeholder="Place your Image"  required />
								<p style="color:red;">SIZE:300px width, 250px height</p>
							</div>
							<div class="field-wrap-half form-group">
								<input type="text" name="sliderImageName" placeholder="Image name"  required />
							</div>
						</div>
						<div style="clear:both;"></div>
						<button type="submit" class="btn btn-info">CREATE ADDVERTISMENT</button>
					</form>
				</div>
			</div>
		</div>
	</section>
</section>
<section class="content">
	<section class="widget">
		<div class="panel panel-default bt-panel" style="box-shadow:none;">
			<div class="panel-heading">
				<span class="icon">&#128196;</span>
				<hgroup>
					<h5>ADVERTISEMENTS</h5>
					<h6>CMS content pages</h6>
				</hgroup>
			</div>
			<div class="panel-body">
				<div class="content">
					<table id="myTable" class="table table-striped table-responsive" width="100%">
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
									<a href="<?php echo C::link('advert-edit.php', array('edit' => $value['id']), true);?>" class="btn btn-success btn-xs text-white"><i class="fa fa-edit"></i></a>
									<a href="<?php echo C::link('addadvert.php', array('delete' => $value['id']), true);?>" class="btn btn-danger btn-xs text-white" onclick="return confirm('Are you sure?');"><i class="fa fa-trash"></i></a>
								</td>
							</tr>
						<?php
							}
						}
						?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</section>
</section>
<?php require_once('includes/doc_footer.php'); ?>