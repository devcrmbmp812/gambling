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

// if(isset($_POST) && is_array($_POST) && count($_POST) > 0){
//     if($Card->addComplaint($_POST, $_FILES)){
//     	C::redirect(C::link('complaint.php', false, true));
//     }	
// }
/* if(isset($_GET['delete']) && trim($_GET['delete'])){
	if($Card->delwebCard($_GET['delete'])){
		C::redirect(C::link('web-card.php', false, true));
	}
} */

?>

<?php require_once('includes/doc_head.php'); ?>
<section class="alert">
	<div class="orange">	
		<p>Hi Lee, you have <a href="#">3 new pages</a> and <a href="#">16 comments</a> to approve, better get going!</p>
		<span class="close">&#10006;</span>
	</div>
</section>
<section class="content">
	<section class="widget">
		<header>
			<span class="icon">&#59168;</span>
			<hgroup>
				<h1>Comments</h1>
				<h2>What they're saying</h2>
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
		<div class="content no-padding timeline">
		<?php
		$result = $User->query("SELECT `id`, `userId`, `siteName`, `link`, `reason`, `complaintTitle`, `complaintText`, `complaintFiles`, `onSiteAccountName`, `onSiteEmail`, `isVerified`, `status` FROM `tblComplaints` ORDER BY `updatedOn` DESC");
		if(is_array($result) && count($result) > 0){
			foreach ($result as $key => $value) {
			$link = explode("/", trim($value['link']));				
		?>
			<div class="tl-post comments">
				<span class="icon">&#59168;</span>
				<p style="width:90%;">
					<?php
					$res = $User->query("SELECT `id`, `userId` FROM `tblUser` WHERE `id` = '" . $value['userId'] . "'");
					if(is_array($res) && count($res) > 0){
						foreach ($res as $index => $val) {
					?>
					<strong><?php echo $val['userId']; ?></strong><br />
					<?php
						}
					}
					?> has complaint against <a href="http://<?php echo $link['0'] ;?>" style="text-transform:uppercase;color:green;"><?php echo $link['1'] ;?></a><br />
					<a href="#">Reason:</a> <?php echo $value['reason']; ?><br /><br />
					<span style="font-size:16px !important;color:red;text-decoration:underline;"><?php echo $value['complaintTitle']; ?></span> <br /><br />
					<span style="font-size:16px !important;"><?php echo $value['complaintText']; ?></span> <br />
					<?php if($value['complaintFiles'] != ''){?>
						<img src="<?php echo $value['complaintFiles']; ?>" alt="" />
					<?php } ?>
					<span class="reply">
						<?php if($value['isVerified'] == 'N'){?>
							<a href="<?php echo C::link('complaint.php', array('edit' => $value['id'] . '+complaint'), true);?>" style="color:#fff;background:green;padding:5px;">Verify</a>
						<?php }
						else{ ?>
							<a href="" style="color:#fff;background:green;padding:5px;">Verified</a>
						<?php } ?>
						<?php if($value['status'] == 'P'){?>
							<a href="<?php echo C::link('complaint-edit.php', array('edit' => $value['id']), true);?>"  style="color:#fff;background:#ff0000;padding:5px;">Pending</a>
						<?php }
						else if ($value['status'] == 'U'){ ?>
							<a href="<?php echo C::link('complaint-edit.php', array('edit' => $value['id']), true);?>"  style="color:#fff;background:#ff0000;padding:5px;">Unsolved</a>
							<?php }
					 	else if ($value['status'] == 'S'){ ?>
							<a href="<?php echo C::link('complaint-edit.php', array('edit' => $value['id']), true);?>"  style="color:#fff;background:#ff0000;padding:5px;">Solved</a>
							<?php } ?>
							<a href="<?php echo C::link('complaint-edit.php', array('edit' => $value['id']), true);?>"  style="color:#fff;background:cornflowerblue;padding:5px;">Reply</a>
							<span class="responseButton" style="color:#fff;background:orange;padding:5px;">Conversation</span>
						</span>
				</p>
				<div class="responseMsg">
					<p style="width:90%;">
						<?php
						$res = $User->query("SELECT `id`, `userId` FROM `tblUser` WHERE `id` = '" . $value['userId'] . "'");
						if(is_array($res) && count($res) > 0){
							foreach ($res as $index => $val) {
						?>
						<strong><?php echo $val['userId']; ?></strong><br />
						<?php
							}
						}
						?> has complaint against <a href="<?php echo $value['link'] ;?>"><?php echo $value['siteName'] ;?></a><br />
						<a href="#">Reason:</a> <?php echo $value['reason']; ?><br /><br />
						<span style="font-size:16px !important;color:red;text-decoration:underline;"><?php echo $value['complaintTitle']; ?></span> <br /><br />
						<span style="font-size:16px !important;"><?php echo $value['complaintText']; ?></span> <br />
						<?php if($value['complaintFiles'] != ''){?>
							<img src="<?php echo $value['complaintFiles']; ?>" alt="" />
						<?php } ?>
						<span class="reply">
						<?php if($value['isVerified'] == 'N'){?>
							<a href="<?php echo C::link('complaint.php', array('edit' => $value['id'] . '+complaint'), true);?>" style="color:#fff;background:green;padding:5px;">Verify</a>
						<?php }
						else{ ?>
							<a href="" style="color:#fff;background:green;padding:5px;">Verified</a>
						<?php } ?>
						<?php if($value['status'] == 'P'){?>
							<a href="<?php echo C::link('complaint-edit.php', array('delete' => $value['id']), true);?>"  style="color:#fff;background:#ff0000;padding:5px;">Pending</a>
						<?php }
						else if ($value['status'] == 'U'){ ?>
							<a href="<?php echo C::link('complaint-edit.php', array('delete' => $value['id']), true);?>"  style="color:#fff;background:#ff0000;padding:5px;">Unsolved</a>
							<?php }
					 	else if ($value['status'] == 'S'){ ?>
							<a href="<?php echo C::link('complaint-edit.php', array('delete' => $value['id']), true);?>"  style="color:#fff;background:#ff0000;padding:5px;">Solved</a>
							<?php } ?>
						</span>
					</p>
				</div>
			</div>
		<?php
			}
		}
		?>

			<span class="show-more"><a	 href="#">More</a></span>
		</div>
	</section>
</section>
<?php require_once('includes/doc_footer.php'); ?>