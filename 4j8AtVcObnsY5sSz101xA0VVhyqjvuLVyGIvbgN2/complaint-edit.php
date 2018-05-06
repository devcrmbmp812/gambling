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
if(isset($_POST['status']) && isset($_POST['statusText']) && count($_POST['status']) && count($_POST['statusText']) > 0){
    $User->query("UPDATE `tblComplaints` SET `status` = '" . $_POST['status'] . "', `statusText` = '" . $_POST['statusText'] . "', `updatedOn`= '" . $date . "' WHERE `id` = '" . $_SESSION['statusID'] . "'");
    C::redirect(C::link('complaint.php', false, true));
} else if(isset($_POST) && is_array($_POST) && count($_POST) > 0){
	//print_r($_POST);
    	//print_r($_FILES);die();
    if($Card->complaintResponse($_POST, $_FILES)){
    	$Base->query("UPDATE `tblComplaints` SET `checkSiteAdmin`= 'N', `checkUser` = 'N' WHERE id = '" . $reqID['2'] . "'");
    	C::redirect(C::link('complaint.php', false, true));
    }
}

$uri = $_SERVER['HTTP_REFERER'];

if(isset($_GET['ed']) && trim($_GET['ed'])){
 	$reqID = explode("+", trim($_GET['ed']));
	if($reqID['1'] == 'verifyComplaint'){
		$Base->query("UPDATE `tblComplaints` SET `isVerified` = 'Y', `updatedOn`= '" . $date . "' WHERE id = '" . $reqID['0'] . "'");
		C::redirect(C::link('complaint.php', false, true));
	} else if($reqID['1'] == 'verifyRespons') {
		$Base->query("UPDATE `tblComplaintsResponse` SET `isVerified` = 'Y', `updatedOn`= '" . $date . "' WHERE id = '" . $reqID['0'] . "'");
		$Base->query("UPDATE `tblComplaints` SET `updatedOn`= '" . $date . "' WHERE id = '" . $reqID['2'] . "'");
		C::redirect(C::link($uri, false, true));
	}
} 

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
	<section class="widget" style="min-height:300px">
		<div class="panel panel-default bt-panel" style="box-shadow:none;">
			<div class="panel-heading">
				<span class="icon">&#128196;</span>
				<hgroup>
					<h5>Complaint Respons Page</h5>
					<h6>Add your text here</h6>
				</hgroup>
			</div>
			<div class="panel-body">
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
									<option value="배팅사이트의 답변을 기다리고 있습니다.">배팅사이트의 답변을 기다리고 있습니다.</option>
									<option value="배팅사이트의 답변이 달렸습니다.">배팅사이트의 답변이 달렸습니다.</option>
									<option value="배팅타임에서 조사중입니다.">배팅타임에서 조사중입니다.</option>
								</optgroup>
								<optgroup label="UnSolved">
									<option value="유저 분께서 만족할 만한 해결책을 찾지 못했습니다.">유저 분께서 만족할 만한 해결책을 찾지 못했습니다.</option>
									<option value="규정대로 처리됐으나 유저 분께서 납득하지 못하셨습니다.">규정대로 처리됐으나 유저 분께서 납득하지 못하셨습니다. </option>
									<option value="배팅사이트의 부재로 미해결 처리 됐습니다.">배팅사이트의 부재로 미해결 처리 됐습니다.</option>
									<option value="내용 및 증거가 불충분하여 미해결 처리 됐습니다.">내용 및 증거가 불충분하여 미해결 처리 됐습니다.</option>
								</optgroup>
								<optgroup label="Solved">
									<option value="해결이 완료되었습니다.">해결이 완료되었습니다.</option>
								</optgroup>
							</select>
						</div>
						<button type="submit" class="btn btn-info">Update</button>
						<?php
						}
						?>
						<?php
							if(isset($_GET['edit']) && trim($_GET['edit'])){
								$id = $_GET['edit'];
								$User->query("UPDATE `tblComplaints` SET `checkAdmin` = 'Y', `updatedOn`= '" . $date . "' WHERE id = '" . $id . "'");
								$User->query("UPDATE `tblComplaintsResponse` SET `checkAdmin` = 'Y' WHERE complaintId = '" . $id . "'");
								$res = $User->query("SELECT `id`, `complaintTitle`, `complaintText` FROM `tblComplaints` WHERE `id` = '" . $id . "'");
									if(is_array($res) && count($res) > 0){
										foreach ($res as $index => $val) {
									?>
						<div class="field-wrap">
							
							<div class="conv-singel-parent">
							<p><span style="color:#ccc;">Title  </span><span style="color:#f00;"><?php echo $val['complaintTitle']; ?></span></p>
							<p><span style="color:#ccc;">Complaint  </span><span style="color:#000;"><?php echo $val['complaintText']; ?></span></p>
								<input type="hidden" name="complaintId" value="<?php echo $val['id']; ?>" />
								<input type="hidden" name="userId" value="1" />
							</div>


								<div class="conv-singel-child-container">
							<?php
								$sql = $User->query("SELECT `id`, `userId`, `siteName`, `responsText`, `responsFiles`, `isVerified` FROM `tblComplaintsResponse` WHERE `complaintId` = '" . $val['id'] . "'");
								if(is_array($sql) && count($sql) > 0){
									foreach ($sql as $idn => $response) {			
								?>
							<div class="conv-singel-child">
							<p>
							 <span style="text-transform:uppercase;color:green;"><?php echo $response['siteName'] ;?></span><br><br>
							<span style="font-size:16px !important;"><?php echo $response['responsText']; ?></span> <br />
							<?php if($response['siteName'] != ''){?>
								<img src="<?php echo $response['responsFiles']; ?>" alt="" />
								<?php if($response['responsFiles'] != '[]'){
									$filesComplaint = json_decode($response['responsFiles']);
									foreach($filesComplaint as $img) {
									?>
									
									<a href="<?php echo $img; ?>" target="_blank"><img src="<?php echo $img; ?>" width="150px" height="90px"alt="" /></a>
									<?php
										}
									}
									?>
									<br>
							<?php } ?>
							<span class="reply">
								<?php if(isset($groupId[0]['groupId']) == 0){ if($response['isVerified'] == 'N'){?>
									<a href="<?php echo C::link('complaint-edit.php', array('ed' => $response['id'] . '+verifyRespons+' .$val['id'] ), true);?>" style="border:1px solid #ccc;padding:5px;color:#000;"><i class="fa fa-thumbs-o-down" aria-hidden="true"></i></a>
								<?php }
								else{ ?>
									<a href="javascript:void(0)" style="border:1px solid #ccc;padding:5px;color:#000;"><i class="fa fa-thumbs-o-up" aria-hidden="true"></i></a>
								<?php
									}
								} ?>
							</span>
						</p>
							</div>
							<?php
							}
						}
							?>
						</div>
						
						</div>
						
						<div class="field-wrap form-group">
							<textarea name="responsText" rows="10"></textarea>
						</div><br>
						<div class="field-wrap form-group">
							<input type="file" name="complaintFiles" placeholder=""/>
						</div>
						<!-- <div class="field-wrap">
							<select name="isVerified">
								<option>-- CHOOSE STATUS --</option>
								<option value="P">Pending</option>
								<option value="S">Solved</option>
								<option value="U">Unsolved</option>
							</select>
						</div> -->
						<button type="submit" class="btn btn-info">Update</button>
						<?php	
						}
							}
						}
							?>
					</form>
				</div>
			</div>
		</div>
	</section>
</section>
<?php require_once('includes/doc_footer.php'); ?>