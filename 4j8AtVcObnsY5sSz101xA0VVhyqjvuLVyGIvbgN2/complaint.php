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

$date = date('Y-m-d H:i:s');

// Edit Complaint
if(isset($_GET['edit']) && trim($_GET['edit'])){
 	$reqID = explode("+", trim($_GET['edit']));
	if($reqID['1'] == 'verifyComplaint'){
		$Base->query("UPDATE `tblComplaints` SET `isVerified` = 'Y', `updatedOn`= '" . $date . "' WHERE id = '" . $reqID['0'] . "'");
		C::redirect(C::link('complaint.php', false, true));
	} else if($reqID['1'] == 'verifyRespons') {
		$Base->query("UPDATE `tblComplaintsResponse` SET `isVerified` = 'Y', `updatedOn`= '" . $date . "' WHERE id = '" . $reqID['0'] . "'");
		$Base->query("UPDATE `tblComplaints` SET `updatedOn`= '" . $date . "' WHERE id = '" . $reqID['2'] . "'");
		C::redirect(C::link('complaint.php', false, true));
	}
}
// Delete complaint
if(isset($_GET['delete']) && trim($_GET['delete'])){
 	$reqDelID = explode("+", trim($_GET['delete']));

 	//print_r($reqDelID);


	if($reqDelID['1'] == 'parentDel'){
		$Base->query("DELETE FROM `tblComplaints` WHERE `id` = '" . $reqDelID[0] . "'");
		C::redirect(C::link('complaint.php', false, true));
		//echo '<script>location.reload();</script>';
	} else if($reqDelID['1'] == 'childDel') {
		echo "DELETE FROM `tblComplaintsResponse` WHERE `id` = '" . $reqDelID[0] . "'";die();
		$Base->query("DELETE FROM `tblComplaintsResponse` WHERE `id` = '" . $reqDelID[0] . "'");
		C::redirect(C::link('complaint.php', false, true));
	}

	//parentDel/childDel
} 

$activeNavigation = "complaint";

?>

<?php require_once('includes/doc_head.php'); ?>
<style type="text/css">
	.conv-container{
		padding: 20px 10px !important;
	    border: 1px solid #ccc !important;
	}
	.conv-singel-parent{
		border: 1px solid #ccc !important;
		padding: 20px !important;
		margin-bottom:5px;
	}
	.conv-singel-child{
		padding: 20px !important;
		padding-left: 50px !important;
		margin-bottom:5px;
		border-bottom:1px solid #ccc;
	}
	.conv-singel-child-container .conv-singel-child:last-child{
		border-bottom:0px;
	}

</style>
<section class="content">
	<section class="widget">
		<div class="panel panel-default bt-panel" style="box-shadow:none;">
			<div class="panel-heading">
				<span class="icon">&#128196;</span>
				<hgroup>
					<h5>Complaints</h5>
					<h6>What they're saying</h6>
				</hgroup>
			</div>
			<div class="panel-body">
				<div class="content no-padding timeline">
				
					<div class="tl-post">
						
						<div class="w3-bar w3-black">
							<a href="javascript:(0);" class="w3-bar-item w3-button" onclick="openCity('Resolved')">Resolved</a>
							<a href="javascript:(0);" class="w3-bar-item w3-button" onclick="openCity('Solved')">Solved</a>
							<a href="javascript:(0);" class="w3-bar-item w3-button" onclick="openCity('Pending')">Pending</a>
						</div>

						<div id="Resolved" class="city">
							<div class="conv-container">
								<?php
								$result = $User->query("SELECT `id`, `userId`, `siteName`, `link`, `reason`, `complaintTitle`, `complaintText`, `complaintFiles`, `onSiteAccountName`, `onSiteEmail`, `isVerified`, `updatedOn` FROM `tblComplaints` WHERE `status` = 'U' ORDER BY `updatedOn` DESC");
								if(is_array($result) && count($result) > 0){
									foreach ($result as $key => $value) {
									//$link = explode("/", trim($value['link']));				
								?>
								<div class="conv-singel-parent">
									<p>
										<?php
										$res = $User->query("SELECT `id`, `userId` FROM `tblUser` WHERE `id` = '" . $value['userId'] . "'");
										if(is_array($res) && count($res) > 0){
											foreach ($res as $index => $val) {
										?>
										<span style="color:#000;"><strong><?php echo $val['userId']; ?>&nbsp;</strong></span>
										<span style="color:#ccc;">Playing website Account Name - </span><span><?php echo $value['onSiteAccountName']; ?></span>,
										<span style="color:#ccc;">Email ID - </span><span><?php echo $value['onSiteEmail']; ?></span>
										<span style="color:#ccc;">&nbsp;&nbsp;&nbsp;<?php echo $value['updatedOn']; ?></span>
										<?php
											}
										}
										?>
									</p>
									<p style="color:#ccc;">- Has complaint against <strong><a href="http://<?php echo $value['link']; ?>" style="text-transform:uppercase;"><?php echo $value['siteName']; ?></a></strong></p>
									<p><span style="color:#ccc;">Reason :</span> <span style="color:#000;"><?php echo $value['reason']; ?></span></p>
									<p style="font-size:15px;color:#ff0000;"><?php echo $value['complaintTitle']; ?></p>
									<div>
										<?php echo $value['complaintText']; ?>
									</div>
									<br>
									<div>
										<?php if($value['complaintFiles'] != '[]'){
										$filesComplaint = json_decode($value['complaintFiles']);
											foreach ($filesComplaint as $imageKey => $imageValue) {
										?>
												<a href="<?php echo HOST.$imageValue; ?>" target="_blank"><img src="<?php echo HOST.$imageValue; ?>" width="150px" height="90px" alt="" /></a>
										<?php
											}
										?>
										
										<?php } ?>
									</div>
									<br>
									<p>
										<?php
										$loggedInId = ((int)User::loggedInUserId() > 0 ? User::loggedInUserId() : 0);
										$groupId = $Base->query("SELECT `groupId` FROM `tblUser` WHERE `parentId` == '" . $loggedInId . "'");
										if(isset($groupId[0]['groupId']) == 0){
											if($value['isVerified'] == 'N'){?>
										<a href="<?php echo C::link('complaint.php', array('edit' => $value['id'] . '+verifyComplaint'), true);?>" title="verify" style="border:1px solid #ccc;padding:5px;color:#000;"><i class="fa fa-thumbs-o-down" aria-hidden="true"></i></a>
											<?php }
											else{ ?>
										<a href="javasctript:void(0);" style="border:1px solid #ccc;padding:5px;color:#000;"><i class="fa fa-thumbs-o-up" title="verified" aria-hidden="true"></i></a>
											<?php } 
										} 
										?>
										<a href="<?php echo C::link('complaint-edit.php', array('edit' => $value['id']), true);?>"  title="Reply" style="border:1px solid #ccc;padding:5px;color:#000;"><i class="fa fa-reply" aria-hidden="true"></i></a>
										<a href="<?php echo C::link('complaint-edit.php', array('status' => $value['id']), true);?>"  title="Status" style="border:1px solid #ccc;padding:5px;color:#000;"><i class="fa fa-cogs" aria-hidden="true"></i></a>
										<a href="<?php echo C::link('complaint.php', array('delete' => $value['id'] . '+parentDel'), true);?>" style="border:1px solid #ccc;color:#000;padding:5px;" title="Delete"><i class="fa fa-trash-o" onclick="return confirm('Are you sure?');" aria-hidden="true"></i></a>
										<a href="javascript:void(0)" title="Conversation" class="responseButton" style="color:#000;padding:5px;">Conversation <i class="fa fa-chevron-down" aria-hidden="true"></i></a>
									</p>


									<div class="conv-singel-child-container responseMsg">
										<?php
											$sql = $User->query("SELECT `id`, `userId`, `siteName`, `responsText`, `responsFiles`, `isVerified`, `updatedOn` FROM `tblComplaintsResponse` WHERE `complaintId` = '" . $value['id'] . "' ORDER BY `updatedOn`");
											if(is_array($sql) && count($sql) > 0){
												foreach ($sql as $idn => $response) {			
										?>
										<div class="conv-singel-child">
											<p>
												<?php
												$res = $User->query("SELECT `id`, `userId` FROM `tblUser` WHERE `id` = '" . $response['userId'] . "'");
												if(is_array($res) && count($res) > 0){
													foreach ($res as $index => $val) {
												?>
												<span style="color:#000;"><strong><?php echo $val['userId']; ?>&nbsp;</strong></span>
												<?php
													}
												}
												?>
												<span style="color:#ccc;">&nbsp;&nbsp;&nbsp;<?php echo $response['updatedOn']; ?></span>
											</p>
											<div>
												<p><?php echo $response['siteName'] ;?></p>
												<?php echo $response['responsText']; ?><br>
												<?php if($response['siteName'] != ''){?>
													<img src="<?php echo $response['complaintFiles']; ?>" alt="" />
												<?php } ?>
											</div><br>
											<p>
											<?php if(isset($groupId[0]['groupId']) == 0){ if($response['isVerified'] == 'N'){?>
												<a href="<?php echo C::link('complaint.php', array('edit' => $response['id'] . '+verifyRespons+' . $value['id']), true);?>" style="border:1px solid #ccc;padding:5px;color:#000;"><i class="fa fa-thumbs-o-down" aria-hidden="true"></i></a>
											<?php }
											else{ ?>
												<a href="javascript:(0);" style="border:1px solid #ccc;padding:5px;color:#000;"><i class="fa fa-thumbs-o-up" aria-hidden="true"></i></a>
											<?php
												}
											} ?>
												<a href="<?php echo C::link('complaint.php', array('delete' => $response['id'] . '+childDel'), true);?>" style="border:1px solid #ccc;color:#000;padding:5px;" title="Delete" onclick="return confirm('Are you sure?');"><i class="fa fa-trash-o" aria-hidden="true"></i></a>
											</p>
										</div><!-- .conv-singel-child -->
										<?php
											}
										}
										?>
									</div><!-- .conv-singel-child-container -->
								</div><!-- .conv-singel-parent -->
								<?php
									}
								}
								?>
							</div><!--.conv-container-->
						</div>

						<div id="Solved" class="city" style="display:none">
							<div class="conv-container">
								<?php
								$result = $User->query("SELECT `id`, `userId`, `siteName`, `link`, `reason`, `complaintTitle`, `complaintText`, `complaintFiles`, `onSiteAccountName`, `onSiteEmail`, `isVerified`, `updatedOn` FROM `tblComplaints` WHERE `status` = 'S' ORDER BY `updatedOn` DESC");
								if(is_array($result) && count($result) > 0){
									foreach ($result as $key => $value) {
									//$link = explode("/", trim($value['link']));				
								?>
								<div class="conv-singel-parent">
									<p>
										<?php
										$res = $User->query("SELECT `id`, `userId` FROM `tblUser` WHERE `id` = '" . $value['userId'] . "'");
										if(is_array($res) && count($res) > 0){
											foreach ($res as $index => $val) {
										?>
										<span style="color:#000;"><strong><?php echo $val['userId']; ?>&nbsp;</strong></span>
										<span style="color:#ccc;">Playing website Account Name - </span><span><?php echo $value['onSiteAccountName']; ?></span>,
										<span style="color:#ccc;">Email ID - </span><span><?php echo $value['onSiteEmail']; ?></span>
										<span style="color:#ccc;">&nbsp;&nbsp;&nbsp;<?php echo $value['updatedOn']; ?></span>
										<?php
											}
										}
										?>
									</p>
									<p style="color:#ccc;">- Has complaint against <strong><a href="http://<?php echo $value['link']; ?>" style="text-transform:uppercase;"><?php echo $value['siteName']; ?></a></strong></p>
									<p><span style="color:#ccc;">Reason :</span> <span style="color:#000;"><?php echo $value['reason']; ?></span></p>
									<p style="font-size:15px;color:#ff0000;"><?php echo $value['complaintTitle']; ?></p>
									<div>
										<?php echo $value['complaintText']; ?>
									</div>
									<br>
									<div>
										<?php if($value['complaintFiles'] != '[]'){
										$filesComplaint = json_decode($value['complaintFiles']);
											foreach ($filesComplaint as $imageKey => $imageValue) {
										?>
												<a href="<?php echo HOST.$imageValue; ?>" target="_blank"><img src="<?php echo HOST.$imageValue; ?>" width="150px" height="90px" alt="" /></a>
										<?php
											}
										?>
										
										<?php } ?>
									</div>
									<br>
									<p>
										<?php
										$loggedInId = ((int)User::loggedInUserId() > 0 ? User::loggedInUserId() : 0);
										$groupId = $Base->query("SELECT `groupId` FROM `tblUser` WHERE `parentId` == '" . $loggedInId . "'");
										if(isset($groupId[0]['groupId']) == 0){
											if($value['isVerified'] == 'N'){?>
										<a href="<?php echo C::link('complaint.php', array('edit' => $value['id'] . '+verifyComplaint'), true);?>" title="verify" style="border:1px solid #ccc;padding:5px;color:#000;"><i class="fa fa-thumbs-o-down" aria-hidden="true"></i></a>
											<?php }
											else{ ?>
										<a href="javasctript:void(0);" style="border:1px solid #ccc;padding:5px;color:#000;"><i class="fa fa-thumbs-o-up" title="verified" aria-hidden="true"></i></a>
											<?php } 
										} 
										?>
										<a href="<?php echo C::link('complaint-edit.php', array('edit' => $value['id']), true);?>"  title="Reply" style="border:1px solid #ccc;padding:5px;color:#000;"><i class="fa fa-reply" aria-hidden="true"></i></a>
										<a href="<?php echo C::link('complaint-edit.php', array('status' => $value['id']), true);?>"  title="Status" style="border:1px solid #ccc;padding:5px;color:#000;"><i class="fa fa-cogs" aria-hidden="true"></i></a>
										<a href="<?php echo C::link('complaint.php', array('delete' => $value['id'] . '+parentDel'), true);?>" style="border:1px solid #ccc;color:#000;padding:5px;" title="Delete"><i class="fa fa-trash-o" onclick="return confirm('Are you sure?');" aria-hidden="true"></i></a>
										<a href="javascript:void(0)" title="Conversation" class="responseButton" style="color:#000;padding:5px;">Conversation <i class="fa fa-chevron-down" aria-hidden="true"></i></a>
									</p>


									<div class="conv-singel-child-container responseMsg">
										<?php
											$sql = $User->query("SELECT `id`, `userId`, `siteName`, `responsText`, `responsFiles`, `isVerified`, `updatedOn` FROM `tblComplaintsResponse` WHERE `complaintId` = '" . $value['id'] . "' ORDER BY `updatedOn`");
											if(is_array($sql) && count($sql) > 0){
												foreach ($sql as $idn => $response) {			
										?>
										<div class="conv-singel-child">
											<p>
												<?php
												$res = $User->query("SELECT `id`, `userId` FROM `tblUser` WHERE `id` = '" . $response['userId'] . "'");
												if(is_array($res) && count($res) > 0){
													foreach ($res as $index => $val) {
												?>
												<span style="color:#000;"><strong><?php echo $val['userId']; ?>&nbsp;</strong></span>
												<?php
													}
												}
												?>
												<span style="color:#ccc;">&nbsp;&nbsp;&nbsp;<?php echo $response['updatedOn']; ?></span>
											</p>
											<div>
												<p><?php echo $response['siteName'] ;?></p>
												<?php echo $response['responsText']; ?><br>
												<?php if($response['siteName'] != ''){?>
													<img src="<?php echo $response['complaintFiles']; ?>" alt="" />
												<?php } ?>
											</div><br>
											<p>
											<?php if(isset($groupId[0]['groupId']) == 0){ if($response['isVerified'] == 'N'){?>
												<a href="<?php echo C::link('complaint.php', array('edit' => $response['id'] . '+verifyRespons+' . $value['id']), true);?>" style="border:1px solid #ccc;padding:5px;color:#000;"><i class="fa fa-thumbs-o-down" aria-hidden="true"></i></a>
											<?php }
											else{ ?>
												<a href="javascript:(0);" style="border:1px solid #ccc;padding:5px;color:#000;"><i class="fa fa-thumbs-o-up" aria-hidden="true"></i></a>
											<?php
												}
											} ?>
												<a href="<?php echo C::link('complaint.php', array('delete' => $response['id'] . '+childDel'), true);?>" style="border:1px solid #ccc;color:#000;padding:5px;" title="Delete" onclick="return confirm('Are you sure?');"><i class="fa fa-trash-o" aria-hidden="true"></i></a>
											</p>
										</div><!-- .conv-singel-child -->
										<?php
											}
										}
										?>
									</div><!-- .conv-singel-child-container -->
								</div><!-- .conv-singel-parent -->
								<?php
									}
								}
								?>
							</div><!--.conv-container-->
						</div>

						<div id="Pending" class="city" style="display:none">
							<div class="conv-container">
								<?php
								$result = $User->query("SELECT `id`, `userId`, `siteName`, `link`, `reason`, `complaintTitle`, `complaintText`, `complaintFiles`, `onSiteAccountName`, `onSiteEmail`, `isVerified`, `updatedOn` FROM `tblComplaints` WHERE `status` = 'P' ORDER BY `updatedOn` DESC");
								if(is_array($result) && count($result) > 0){
									foreach ($result as $key => $value) {
									//$link = explode("/", trim($value['link']));				
								?>
								<div class="conv-singel-parent">
									<p>
										<?php
										$res = $User->query("SELECT `id`, `userId` FROM `tblUser` WHERE `id` = '" . $value['userId'] . "'");
										if(is_array($res) && count($res) > 0){
											foreach ($res as $index => $val) {
										?>
										<span style="color:#000;"><strong><?php echo $val['userId']; ?>&nbsp;</strong></span>
										<span style="color:#ccc;">Playing website Account Name - </span><span><?php echo $value['onSiteAccountName']; ?></span>,
										<span style="color:#ccc;">Email ID - </span><span><?php echo $value['onSiteEmail']; ?></span>
										<span style="color:#ccc;">&nbsp;&nbsp;&nbsp;<?php echo $value['updatedOn']; ?></span>
										<?php
											}
										}
										?>
									</p>
									<p style="color:#ccc;">- Has complaint against <strong><a href="http://<?php echo $value['link']; ?>" style="text-transform:uppercase;"><?php echo $value['siteName']; ?></a></strong></p>
									<p><span style="color:#ccc;">Reason :</span> <span style="color:#000;"><?php echo $value['reason']; ?></span></p>
									<p style="font-size:15px;color:#ff0000;"><?php echo $value['complaintTitle']; ?></p>
									<div>
										<?php echo $value['complaintText']; ?>
									</div>
									<br>
									<div>
										<?php if($value['complaintFiles'] != '[]'){
										$filesComplaint = json_decode($value['complaintFiles']);
											foreach ($filesComplaint as $imageKey => $imageValue) {
										?>
												<a href="<?php echo HOST.$imageValue; ?>" target="_blank"><img src="<?php echo HOST.$imageValue; ?>" width="150px" height="90px" alt="" /></a>
										<?php
											}
										?>
										
										<?php } ?>
									</div>
									<br>
									<p>
										<?php
										$loggedInId = ((int)User::loggedInUserId() > 0 ? User::loggedInUserId() : 0);
										$groupId = $Base->query("SELECT `groupId` FROM `tblUser` WHERE `parentId` == '" . $loggedInId . "'");
										if(isset($groupId[0]['groupId']) == 0){
											if($value['isVerified'] == 'N'){?>
										<a href="<?php echo C::link('complaint.php', array('edit' => $value['id'] . '+verifyComplaint'), true);?>" title="verify" style="border:1px solid #ccc;padding:5px;color:#000;"><i class="fa fa-thumbs-o-down" aria-hidden="true"></i></a>
											<?php }
											else{ ?>
										<a href="javasctript:void(0);" style="border:1px solid #ccc;padding:5px;color:#000;"><i class="fa fa-thumbs-o-up" title="verified" aria-hidden="true"></i></a>
											<?php } 
										} 
										?>
										<a href="<?php echo C::link('complaint-edit.php', array('edit' => $value['id']), true);?>"  title="Reply" style="border:1px solid #ccc;padding:5px;color:#000;"><i class="fa fa-reply" aria-hidden="true"></i></a>
										<a href="<?php echo C::link('complaint-edit.php', array('status' => $value['id']), true);?>"  title="Status" style="border:1px solid #ccc;padding:5px;color:#000;"><i class="fa fa-cogs" aria-hidden="true"></i></a>
										<a href="<?php echo C::link('complaint.php', array('delete' => $value['id'] . '+parentDel'), true);?>" style="border:1px solid #ccc;color:#000;padding:5px;" title="Delete"><i class="fa fa-trash-o" onclick="return confirm('Are you sure?');" aria-hidden="true"></i></a>
										<a href="javascript:void(0)" title="Conversation" class="responseButton" style="color:#000;padding:5px;">Conversation <i class="fa fa-chevron-down" aria-hidden="true"></i></a>
									</p>


									<div class="conv-singel-child-container responseMsg">
										<?php
											$sql = $User->query("SELECT `id`, `userId`, `siteName`, `responsText`, `responsFiles`, `isVerified`, `updatedOn` FROM `tblComplaintsResponse` WHERE `complaintId` = '" . $value['id'] . "' ORDER BY `updatedOn`");
											if(is_array($sql) && count($sql) > 0){
												foreach ($sql as $idn => $response) {			
										?>
										<div class="conv-singel-child">
											<p>
												<?php
												$res = $User->query("SELECT `id`, `userId` FROM `tblUser` WHERE `id` = '" . $response['userId'] . "'");
												if(is_array($res) && count($res) > 0){
													foreach ($res as $index => $val) {
												?>
												<span style="color:#000;"><strong><?php echo $val['userId']; ?>&nbsp;</strong></span>
												<?php
													}
												}
												?>
												<span style="color:#ccc;">&nbsp;&nbsp;&nbsp;<?php echo $response['updatedOn']; ?></span>
											</p>
											<div>
												<p><?php echo $response['siteName'] ;?></p>
												<?php echo $response['responsText']; ?><br>
												<?php if($response['siteName'] != ''){?>
													<img src="<?php echo $response['complaintFiles']; ?>" alt="" />
												<?php } ?>
											</div><br>
											<p>
											<?php if(isset($groupId[0]['groupId']) == 0){ if($response['isVerified'] == 'N'){?>
												<a href="<?php echo C::link('complaint.php', array('edit' => $response['id'] . '+verifyRespons+' . $value['id']), true);?>" style="border:1px solid #ccc;padding:5px;color:#000;"><i class="fa fa-thumbs-o-down" aria-hidden="true"></i></a>
											<?php }
											else{ ?>
												<a href="javascript:(0);" style="border:1px solid #ccc;padding:5px;color:#000;"><i class="fa fa-thumbs-o-up" aria-hidden="true"></i></a>
											<?php
												}
											} ?>
												<a href="<?php echo C::link('complaint.php', array('delete' => $response['id'] . '+childDel'), true);?>" style="border:1px solid #ccc;color:#000;padding:5px;" title="Delete" onclick="return confirm('Are you sure?');"><i class="fa fa-trash-o" aria-hidden="true"></i></a>
											</p>
										</div><!-- .conv-singel-child -->
										<?php
											}
										}
										?>
									</div><!-- .conv-singel-child-container -->
								</div><!-- .conv-singel-parent -->
								<?php
									}
								}
								?>
							</div><!--.conv-container-->
						</div>
					</div>
					<!-- <span class="show-more"><a	 href="#">More</a></span> -->
				</div>
			</div>
		</div>
	</section>
</section>
<?php require_once('includes/doc_footer.php'); ?>