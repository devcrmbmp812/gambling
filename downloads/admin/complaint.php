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


 if(isset($_GET['edit']) && trim($_GET['edit'])){
 	$reqID = explode("+", trim($_GET['edit']));
	if($reqID['1'] == 'verifyComplaint'){
		$Base->query("UPDATE `tblComplaints` SET `isVerified` = 'Y' WHERE id = '" . $reqID['0'] . "'");
		C::redirect(C::link('complaint.php', false, true));
	} else if($reqID['1'] == 'verifyRespons') {
		$Base->query("UPDATE `tblComplaintsResponse` SET `isVerified` = 'Y' WHERE id = '" . $reqID['0'] . "'");
		C::redirect(C::link('complaint.php', false, true));
	}
} 

?>

<?php require_once('includes/doc_head.php'); ?>

<section class="content">
	<section class="widget">
		<header>
			<span class="icon">&#59168;</span>
			<hgroup>
				<h1>Comments</h1>
				<h2>What they're saying</h2>
			</hgroup>
		</header>
		<div class="content no-padding timeline">
		<?php
		$result = $User->query("SELECT `id`, `userId`, `siteName`, `link`, `reason`, `complaintTitle`, `complaintText`, `complaintFiles`, `onSiteAccountName`, `onSiteEmail`, `isVerified`, `updatedOn`, `status` FROM `tblComplaints` ORDER BY `updatedOn` DESC");
		if(is_array($result) && count($result) > 0){
			foreach ($result as $key => $value) {
			//$link = explode("/", trim($value['link']));				
		?>
			<div class="tl-post comments">
				<span class="icon">&#59168;</span>
				<p style="width:90%;">
					<?php
					$res = $User->query("SELECT `id`, `userId` FROM `tblUser` WHERE `id` = '" . $value['userId'] . "'");
					if(is_array($res) && count($res) > 0){
						foreach ($res as $index => $val) {
					?>
					<strong><?php echo $val['userId']; ?></strong><span> &nbsp;&nbsp;&nbsp;&nbsp;(Playing website Acoount Name - <span style="color:red;"><?php echo $value['onSiteAccountName']; ?></span>)<br />
					<?php
						}
					}
					?> has complaint against <a href="http://<?php echo $value['link']; ?>" style="text-transform:uppercase;color:green;"><?php echo $value['siteName']; ?></a><br />
					<a href="#">Reason:</a> <?php echo $value['reason']; ?><br /><br />
					<a href="#">Comment Time:</a> <?php echo $value['updatedOn']; ?><br /><br />
					<span style="font-size:16px !important;color:red;text-decoration:underline;"><?php echo $value['complaintTitle']; ?></span> <br /><br />
					<span style="font-size:16px !important;"><?php echo $value['complaintText']; ?></span> <br />
					<?php if($value['complaintFiles'] != ''){?>
						<a href="<?php echo $value['complaintFiles']; ?>" target="_blank"><img src="<?php echo $value['complaintFiles']; ?>" width="150px" height="90px"alt="" /></a>
					<?php } ?>
					<span class="reply">
						<?php
						$loggedInId = ((int)User::loggedInUserId() > 0 ? User::loggedInUserId() : 0);
						$groupId = $Base->query("SELECT `groupId` FROM `tblUser` WHERE `parentId` == '" . $loggedInId . "'");
					 if(isset($groupId[0]['groupId']) == 0){
						 if($value['isVerified'] == 'N'){?>
							<a href="<?php echo C::link('complaint.php', array('edit' => $value['id'] . '+verifyComplaint'), true);?>" style="color:#fff;background:green;padding:5px;">Verify</a>
						<?php }
						else{ ?>
							<a href="" style="color:#fff;background:green;padding:5px;">Verified</a>
						<?php } ?>
						<?php
						 if($value['status'] == 'P'){?>
							<a href="<?php echo C::link('complaint-edit.php', array('status' => $value['id']), true);?>"  style="color:#fff;background:#ff0000;padding:5px;">Pending</a>
						<?php }
						else if ($value['status'] == 'U'){ ?>
							<a href="<?php echo C::link('complaint-edit.php', array('status' => $value['id']), true);?>"  style="color:#fff;background:#ff0000;padding:5px;">Unsolved</a>
							<?php }
					 	else if ($value['status'] == 'S'){ ?>
							<a href="<?php echo C::link('complaint-edit.php', array('status' => $value['id']), true);?>"  style="color:#fff;background:#ff0000;padding:5px;">Solved</a>
							<?php 
							}
						} ?>
							<a href="<?php echo C::link('complaint-edit.php', array('edit' => $value['id']), true);?>"  style="color:#fff;background:cornflowerblue;padding:5px;">Reply</a>
							<span class="responseButton" style="color:#fff;background:orange;padding:5px;">Conversation</span>
						</span>
				</p>
				<div class="responseMsg">
					<?php
						$sql = $User->query("SELECT `id`, `userId`, `siteName`, `responsText`, `responsFiles`, `isVerified` FROM `tblComplaintsResponse` WHERE `complaintId` = '" . $value['id'] . "' ORDER BY `updatedOn`");
						if(is_array($sql) && count($sql) > 0){
							foreach ($sql as $idn => $response) {			
						?>
					<div>
					<p style="width:90%;">
					<?php
					$res = $User->query("SELECT `id`, `userId` FROM `tblUser` WHERE `id` = '" . $response['userId'] . "'");
					if(is_array($res) && count($res) > 0){
						foreach ($res as $index => $val) {
					?>
					<strong><?php echo $val['userId']; ?></strong><br />
					<?php
						}
					}
					?> <span style="text-transform:uppercase;color:green;"><?php echo $response['siteName'] ;?></span><br />
					<span style="font-size:16px !important;"><?php echo $response['responsText']; ?></span> <br />
					<?php if($response['siteName'] != ''){?>
						<img src="<?php echo $response['complaintFiles']; ?>" alt="" />
					<?php } ?>
					<span class="reply">
						<?php if(isset($groupId[0]['groupId']) == 0){ if($response['isVerified'] == 'N'){?>
							<a href="<?php echo C::link('complaint.php', array('edit' => $response['id'] . '+verifyRespons'), true);?>" style="color:#fff;background:green;padding:5px;">Verify</a>
						<?php }
						else{ ?>
							<a href="" style="color:#fff;background:green;padding:5px;">Verified</a>
						<?php
							}
					 	} ?>
							<a href="<?php echo C::link('complaint-edit.php', array('edit' => $value['id']), true);?>" class="replyButton">Reply</a>
						</span>
				</p>
					</div>
					<?php
					}
				}
					?>
				</div>
			</div>
		<?php
			}
		}
		?>

			<span class="show-more"><a	 href="#">More</a></span>
		</div>
		<!-- <div align="center">
			<ul class="pagination1">
			  	<li><a href="#">«</a></li>
			 	<li><a href="#">1</a></li>
				<li><a class="active" href="#">2</a></li>
				<li><a href="#">3</a></li>
				<li><a href="#">4</a></li>
				<li><a href="#">5</a></li>
				<li><a href="#">6</a></li>
				<li><a href="#">7</a></li>
				<li><a href="#">»</a></li>
			</ul>
		</div> -->
	</section>
</section>
<?php require_once('includes/doc_footer.php'); ?>