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
				<div class="field-wrap">
					<select name="categoryPage" id="ParentName">
						<option value="">-- Choose Page Name --</option>
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
					</select>
				</div>
				<div class="field-wrap">
					<input type="text" name="categoryTitle" value="" placeholder="Content Title" />
				</div>
				<div class="field-wrap">
					<textarea id="editor" name="categoryContent" rows="5"></textarea>
				</div><br />
				<button type="submit" class="green">Post</button> <!-- <button type="submit" class="">Preview</button> -->
			</form>
		</div>
	</section>
</section>
<section class="content">
	<section class="widget">
		<header>
			<span class="icon">&#128196;</span>
			<hgroup>
				<h1>Category</h1>
				<h2>CMS content pages</h2>
			</hgroup>
		</header>
		<div class="content">
			<table id="myTable" border="0" width="100">
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
								<a href="<?php echo C::link('category-edit.php', array('edit' => $value['id']), true);?>" style="color:#fff;background:green;padding:5px;">EDIT</a>
								<a href="<?php echo C::link('category.php', array('delete' => $value['id']), true);?>" style="color:#fff;background:#ff0000;padding:5px;">DELETE</a>
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