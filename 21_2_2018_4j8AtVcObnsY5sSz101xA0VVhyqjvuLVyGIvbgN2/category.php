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
    if($Card->pageContentSave($_POST)){
    	C::redirect(C::link('category.php', false, true));
    }	
}

if(isset($_GET['edit']) && trim($_GET['edit'])){
	$Base->query("DELETE FROM `tblContent` WHERE id = '" . $_GET['edit'] . "'");
}
$activeNavigation = "category";
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
						<div class="field-wrap form-group">
							<select name="categoryPage" id="ParentName">
								<option value="">-- Choose Page Name --</option>
								<option value="home">Home</option>
								<option value="sports">Sports</option>
								<option value="Online sport">Online sport</option>
								<option value="Newest sport">Newest sport</option>
								<option value="Verified sport">Verified sport</option>
								<option value="Bitcoin sport">Bitcoin sport</option>
								<option value="Mobile sport">Mobile sport</option>
								<option value="Sadari sport">Sadari sport</option>
								<option value="bonus">Bonus</option>
								<option value="Welcome Bonus">Welcome Bonus</option>
								<option value="First Deposite Bonus">First Deposite Bonus</option>
								<option value="Every Time Bonus">Every Time Bonus</option>
								<option value="Rolling Bonus">Rolling Bonus</option>
								<option value="Free Money">Free Money</option>
								<option value="Combo Bonus">Combo Bonus</option>
								<option value="Rebate Bonus">Rebate Bonus</option>
								<option value="Other Bonus">Other Bonus</option>
								<option value="news">News</option>
								<option value="N">NEWS</option>
								<option value="B">BLOG</option>
								<option value="complaint">Complaint</option>
								<option value="contact">Contact</option>
								<option value="privacy Policy">Privacy Policy</option>
								<option value="posting guidlince">posting guidlince</option>
								<option value="advertise">Advertise</option>
								<option value="sports policy">Sports Policy</option>
								<option value="certificate of trust">Certificate of Trust</option>
								<option value="terms and condition">Terms and Condition</option>
								<option value="Livebetting Sports">Livebetting Sports</option>
								<option value="notice">Notice</option>
							</select>
						</div>
						<div class="field-wrap form-group">
							<input type="text" name="categoryTitle" value="" placeholder="Content Title" />
						</div>
						<div class="field-wrap form-group">
							<input type="text" name="metaTitle" value="" placeholder="Meta Title" />
						</div>
						<div class="field-wrap form-group">
							<input type="text" name="metaKeyword" value="" placeholder="Meta Keyword" />
						</div>
						<div class="field-wrap form-group">
							<input type="text" name="metaDesc" value="" placeholder="Meta Description" />
						</div>
						<div class="field-wrap form-group">
							<textarea id="editor" name="categoryContent" rows="5"></textarea>
						</div><br />
						<button type="submit" class="btn btn-info">Post</button> <!-- <button type="submit" class="">Preview</button> -->
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
					<h5>list of bonus cards</h5>
					<h6>CMS content pages</h6>
				</hgroup>
			</div>
			<div class="panel-body">
				<div class="content">
					<table id="myTable" class="table table-striped table-responsive">
						<thead>
							<tr>
								<th>Page Name</th>
								<th>Page Title</th>
								<th>Author</th>
								<th>Action</th>
							</tr>
						</thead>
						<tbody>
							<?php 
							$result = $User->query("SELECT `id`, `categoryPage`, `categoryTitle`, `categoryContent` FROM `tblContent`");
							if(isset($result) && is_array($result) && count($result) > 0){
								foreach ($result as $key => $value) {
							?>
							<tr>
								<td><input type="checkbox" /> <?php echo $value['categoryPage'];?></td>
								<td><?php echo $value['categoryTitle'];?></td>
								<td>Admin</td>
								<td>
									<a href="<?php echo C::link('category-edit.php', array('edit' => $value['id']), true);?>" class="btn btn-success btn-xs text-white"><i class="fa fa-edit"></i></a>
									<a href="<?php echo C::link('category.php', array('delete' => $value['id']), true);?>" class="btn btn-danger btn-xs text-white"><i class="fa fa-trash"></i></a>
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