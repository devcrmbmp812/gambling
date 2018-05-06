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


if(isset($_POST['status']) && isset($_POST['statusText']) && count($_POST['status']) && count($_POST['statusText']) > 0){
    $User->query("UPDATE `tblComplaints` SET `status` = '" . $_POST['status'] . "', `statusText` = '" . $_POST['statusText'] . "' WHERE `id` = '" . $_SESSION['statusID'] . "'");
    C::redirect(C::link('complaint.php', false, true));
} else if(isset($_POST) && is_array($_POST) && count($_POST) > 0){
    if($Card->complaintResponse($_POST, $_FILES)){
    	C::redirect(C::link('complaint.php', false, true));
    }
}

?>
<?php require_once('includes/doc_head.php'); ?>
<section class="content">
	<section class="widget" style="min-height:300px">
		<header>
			<span class="icon">&#59160;</span>
			<hgroup>
				<h1>Complaint Respons Page</h1>
				<h2>Add your text here</h2>
			</hgroup>
			<aside>
				<span>
					<a href="#">&#9881;</a>
					<ul class="settings-dd">
						<li><label>Option a</label><input type="checkbox" /></li>
						<li><label>Option b</label><input type="checkbox" checked="checked" /></li>
						<li><label>Option c</label><input type="checkbox" /></li>
					</ul>
				</span>
			</aside>
		</header>
		<div class="content">
			<form action="" method="post" enctype="multipart/form-data">
				<?php
				if(isset($_GET['status']) && trim($_GET['status'])){
					$_SESSION['statusID'] = $_GET['status'];
				?>
				<div class="field-wrap">
					<select name="status" id="">
						<option value="">-- CHOOSE STATUS -- </option>
						<option value="P">Pending</option>
						<option value="S">Solved</option>
						<option value="U">Unsolved</option>
					</select>
				</div>
				<div class="field-wrap">
					<select name="statusText" id="">
						<optgroup label="Pending">
					    	<option value="Due to inactive sports">Due to inactive sports</option>
					    	<option value="Waiting for response">Waiting for response</option>
						</optgroup>
						<optgroup label="UnSolved">
					    	<option value="Due to inactive sports">Due to inactive sports</option>
					    	<option value="Waiting for response">Waiting for response</option>
					    	<option value="Need more time">Need more time</option>
					    	<option value="Need proves">Need proves</option>
					    	<option value="Need to investigate more">Need to investigate more</option>
						</optgroup>
						<optgroup label="Solved">
					    	<option value="Congratulation!!!!">Congratulation!!!!</option>
						</optgroup>
					</select>
				</div>
				<button type="submit" class="green">Update</button>
				<?php
				}
				?>
				<?php
					if(isset($_GET['edit']) && trim($_GET['edit'])){
						$id = $_GET['edit'];
						$res = $User->query("SELECT `id`, `complaintTitle`, `complaintText` FROM `tblComplaints` WHERE `id` = '" . $id . "'");
							if(is_array($res) && count($res) > 0){
								foreach ($res as $index => $val) {
							?>
				<div class="field-wrap">
					
					
					<p><span style="color:red;">Title  </span><?php echo $val['complaintTitle']; ?></p><br />
					<p><span style="color:red;">Complaint  </span><?php echo $val['complaintText']; ?></p>
						<input type="hidden" name="complaintId" value="<?php echo $val['id']; ?>" />
						<input type="hidden" name="userId" value="1" />
				
				</div>
				
				<div class="field-wrap">
					<textarea name="responsText" rows="10"></textarea>
				</div><br>
				<div class="field-wrap">
					<input type="file" name="newsImage" placeholder=""/>
				</div>
				<!-- <div class="field-wrap">
					<select name="isVerified">
						<option>-- CHOOSE STATUS --</option>
						<option value="P">Pending</option>
						<option value="S">Solved</option>
						<option value="U">Unsolved</option>
					</select>
				</div> -->
				<button type="submit" class="green">Update</button>
				<?php	
				}
					}
				}
					?>
			</form>
		</div>
	</section>
</section>
<?php require_once('includes/doc_footer.php'); ?>