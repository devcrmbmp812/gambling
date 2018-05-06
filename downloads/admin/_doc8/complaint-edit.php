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

if(isset($_POST) && is_array($_POST) && count($_POST) > 0){
	//print_r($_POST);
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
				<div class="field-wrap">
					<?php
					if(isset($_GET['edit']) && trim($_GET['edit'])){
						$id = $_GET['edit'];
						$res = $User->query("SELECT `id`, `complaintTitle`, `complaintText` FROM `tblComplaints` WHERE `id` = '" . $id . "'");
							if(is_array($res) && count($res) > 0){
								foreach ($res as $index => $val) {
							?>
					
					<p><span style="color:red;">Title  </span><?php echo $val['complaintTitle']; ?></p><br />
					<p><span style="color:red;">Complaint  </span><?php echo $val['complaintText']; ?></p>
						<input type="hidden" name="complaintId" value="<?php echo $val['id']; ?>" />
				<?php	
				}
					}
				}
					?>
				</div>
				<div class="field-wrap">
					<textarea name="responsText" id="editor" rows="10"></textarea>
				</div>
				<div class="field-wrap">
					<input type="file" name="newsImage" placeholder=""/>
				</div>
				<button type="submit" class="green">Update</button>
			</form>
		</div>
	</section>
</section>
<?php require_once('includes/doc_footer.php'); ?>