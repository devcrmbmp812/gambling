<?php
require_once('config.php');	
// Load Classes
C::loadClass('User');
C::loadClass('Card');
C::loadClass('CMS');
//Init User class
$User = new User();
$Card = new Card();
$Common = new Common();

if(isset($_GET['edit']) && trim($_GET['edit'])){
 	$_SESSION['cId'] = $_GET['edit'];
}
if(isset($_POST) && is_array($_POST) && count($_POST) > 0){
	$uri=$_SERVER['REQUEST_URI'];
    if($Card->complaintResponse($_POST, $_FILES)){
    	C::redirect(C::link($uri, false, true));
    }	
}
?>
<?php require_once('includes/doc_head.php'); ?>
	<div class="ask-content" id="ask-content">
		<div class="row">
			<div class="col-lg-12 col-md-12">
				<!-- <div class="ask-page-content" style="overflow:hidden;"> -->
					<!-- <div class=""> -->
					 	<div class="text-white complain-form">
							<!-- <div class="ask-page-content"> -->
								<div class="ask-page-content-header">
									<h3 class="text-uppercase">분쟁해결 답장하기</h3>
								</div>
								<div class="ask-page-content">
									<?php
									//echo $_SESSION['cId'];
									$User->query("UPDATE `tblComplaints` SET `checkSiteAdmin` = 'Y' WHERE id = '" . $_SESSION['cId'] . "'");
									$User->query("UPDATE `tblComplaintsResponse` SET `checkSiteAdmin` = 'Y' WHERE `complaintId` = '" . $_SESSION['cId'] . "'");
										$result = $User->query("SELECT `id`, `userId`, `siteName`, `link`, `reason`, `complaintTitle`, `complaintText`, `complaintFiles`, `onSiteAccountName`, `onSiteEmail`, `isVerified`, `status` FROM `tblComplaints` WHERE `id` = '" . $_SESSION['cId'] . "'");
										if(is_array($result) && count($result) > 0){
											foreach ($result as $key => $value) {
									?>
									<div class="content">
										<div class="arrow-content">
											<?php
											$res = $User->query("SELECT `id`, `userId` FROM `tblUser` WHERE `id` = '" . $value['userId'] . "'");
											if(is_array($res) && count($res) > 0){
												foreach ($res as $index => $val) {
											?>
											<h5 class="page-header comment-preview-header margin-top-0"><span class="text-yellow"><?php echo $val['userId']; ?></span> 님께서 분쟁해결 신청을 하셨습니다. <a href="http://<?php echo $value['link']; ?>" target="_blank"><span class="text-success text-uppercase"> <?php echo $value['siteName']; ?></span></a></h5>
											<?php
												}
											}
											?>
											<div class="comment-show">
												<table class="ask-table">
													<tr>
														<td>신청이유 : <?php echo $value['reason']; ?></td>
													</tr>
													<tr>
														<td class="text-yellow"><?php echo $value['complaintTitle']; ?></td>
													</tr>
													<tr>
														<td><?php echo $value['complaintText']; ?></td>
													</tr>
													<tr>
														<td style="padding-top:20px;">
															<?php
															$loggedInId = ((int)User::loggedInUserId() > 0 ? User::loggedInUserId() : 0);
															$groupId = $User->query("SELECT `groupId` FROM `tblUser` WHERE `parentId` == '" . $loggedInId . "' LIMIT, 1");
														 if(isset($groupId[0]['groupId']) == 0){
															 if($value['isVerified'] == 'N'){?>
															 	<span style="color:#fff;background:#DA1E2A;padding:5px;">승인중</span>
															<?php }
															else{ ?>
																<span style="color:#fff;background:#DA1E2A;padding:5px;">승인완료</span>
															<?php } ?>
															<?php
															 if($value['status'] == 'P'){?>
															 	<span style="color:#fff;background:#5FB962;padding:5px;">해결중</span>
															<?php }
															else if ($value['status'] == 'U'){ ?>
																<span style="color:#fff;background:#5FB962;padding:5px;">미해결</span>
																<?php }
														 	else if ($value['status'] == 'S'){ ?>
																<span style="color:#fff;background:#5FB962;padding:5px;">해결완료</span>
																<?php 
																}
															} ?>
														</td>
													</tr>
												</table>
											</div>
										</div>

										
										<div class="ask-page-content-body-details responseMsg">
											<?php
											$sql = $User->query("SELECT `id`, `userId`, `siteName`, `responsText`, `responsFiles`, `isVerified` FROM `tblComplaintsResponse` WHERE `complaintId` = '" . $_SESSION['cId'] . "' ORDER BY `updatedOn`");
											if(is_array($sql) && count($sql) > 0){
												foreach ($sql as $idn => $response) {			
											?>
											<div class="content">
												<div class="arrow-content">
													<?php
													$res = $User->query("SELECT `id`, `groupId`, `siteName`, `userId` FROM `tblUser` WHERE `id` = '" . $response['userId'] . "'");
													if(is_array($res) && count($res) > 0){
														foreach ($res as $index => $val) {
															if($val['groupId'] == 0){
																$name = 'Admin';
															}else if($val['groupId'] == 2){
																$name = $val['siteName'];
															}else{
																$name = $val['userId'];
															}
													?>
													<h5 class="page-header comment-preview-header margin-top-0"><span class="text-yellow text-uppercase"><?php echo $name; ?></span> </h5>
													<?php
														}
													}
													?>
													<div class="comment-show">
														<table class="ask-table">
															<tr>
																<td><?php echo $response['responsText']; ?></td>
															</tr>
															<?php if($response['siteName'] != ''){?>
															<tr>
																<td class="text-yellow"><img src="<?php echo $response['complaintFiles']; ?>" alt="" /></td>
															</tr>
															<?php } ?>
															<tr>
																<td>
																	<?php if(isset($groupId[0]['groupId']) == 0){ if($response['isVerified'] == 'N'){?>
																	<span style="color:#fff;background:#5FB962;padding:5px;">승인중</span>
																<?php }
																else{ ?>
																	<span style="color:#fff;background:#5FB962;padding:5px;">승인완료</span>
																<?php
																	}
															 	} ?>
																</td>
															</tr>
														</table>
													</div>
												</div>
											</div>
										<?php
											}
										}
										?>		
										</div>
								 	</div>
								 	<hr>
									<?php
										}
									}
									?>
							 	</div>
							 	<div class="ask-page-content">
									<div class="">
										<div class="content">
										 	<form action="" method="POST" enctype="multipart/form-data">
										 		<div class="form-group arrow-content">
										 			<div id="toolbar" class="min-editor" style="display: none;">
												<a data-wysihtml5-command="bold" class="btn btn-xs text-white btn-tools" title="CTRL+B"><i class="fa fa-bold" aria-hidden="true"></i></a>
												<a data-wysihtml5-command="italic" class="btn btn-xs text-white btn-tools" title="CTRL+I"><i class="fa fa-italic" aria-hidden="true"></i></a>
												<a data-wysihtml5-command="createLink" class="btn text-white btn-xs btn-tools"><i class="fa fa-link" aria-hidden="true"></i></a>
												<a data-wysihtml5-command="insertImage" class="btn btn-xs text-white btn-tools"><i class="fa fa-picture-o" aria-hidden="true"></i></a>
												<!-- <a data-wysihtml5-command="formatBlock" data-wysihtml5-command-value="h1" class="btn btn-xs btn-tools">h1</a>
												<a data-wysihtml5-command="formatBlock" data-wysihtml5-command-value="h2" class="btn btn-xs btn-tools">h2</a> -->
												<a data-wysihtml5-command="insertUnorderedList" class="btn btn-xs text-white btn-tools"><i class="fa fa-list" aria-hidden="true"></i></a>
												<a data-wysihtml5-command="insertOrderedList" class="btn btn-xs text-white btn-tools"><i class="fa fa-list-ol" aria-hidden="true"></i></a>
												<!-- <a data-wysihtml5-command="foreColor" data-wysihtml5-command-value="red" class="btn btn-xs btn-tools">red</a>
												<a data-wysihtml5-command="foreColor" data-wysihtml5-command-value="green" class="btn btn-xs btn-tools">green</a>
												<a data-wysihtml5-command="foreColor" data-wysihtml5-command-value="blue" class="btn btn-xs btn-tools">blue</a> -->
												<a data-wysihtml5-command="insertSpeech" class="btn btn-xs text-white btn-tools">speech</a>
												<!-- <a data-wysihtml5-action="change_view" class="btn btn-danger btn-xs">switch to html view</a> -->


												<div data-wysihtml5-dialog="createLink" style="display: none;">
													<label>
													<span class="text-white">Link:</span>
													<input data-wysihtml5-dialog-field="href" value="http://" style="height:22px;">
													</label>
													<a data-wysihtml5-dialog-action="save" class="btn btn-danger btn-xs">OK</a>&nbsp;<a data-wysihtml5-dialog-action="cancel" class="btn btn-info btn-xs">CANCEL</a>
												</div>

												<div data-wysihtml5-dialog="insertImage" style="display: none;">
												  	<label>
												    	<span class="text-white">Image:</span>
												    	<input data-wysihtml5-dialog-field="src" class="" style="height:22px;" value="http://">
												  	</label>
												    <label>
												        <span class="text-white">Align:</span>
												        <select data-wysihtml5-dialog-field="className" class="" style="height:22px;">
												          <option value="">default</option>
												          <option value="wysiwyg-float-left">left</option>
												          <option value="wysiwyg-float-right">right</option>
												        </select>
												    </label>
												  	<a data-wysihtml5-dialog-action="save" class="btn btn-danger btn-xs">OK</a>&nbsp;<a data-wysihtml5-dialog-action="cancel" class="btn btn-info btn-xs">CANCEL</a>
											    </div>
											    
											</div>
										 			<textarea id="min-text" name="responsText" class="form-control" rows="5" style="width:100%;" required></textarea>
										 			<input type="hidden" name="complaintId" value="<?php echo $_SESSION['cId'] ;?>">
										 		</div>
										 		<div class="form-group addMoreContainer">
								 					<input type="file" name="complaintFiles[]" class="form-control complaintFiles" style="padding-top: 3px; padding-bottom: 38px;" />
								 					<button type="button" class="btn btn-ask-green" id="addMoreFile">파일 추가하기</button>
								 					<button type="button" class="btn btn-ask-red" id="removeFile">삭제하기</button>
								 				</div>
										 		<div>
										 			<button type="submit" class="btn btn-ask-red">작성하기</button>
										 		</div>

										 	</form>
									 	</div>
							 		</div>
								</div>
							<!-- </div> -->
						</div>
					<!-- </div> -->
				<!-- </div> -->
			</div><!-- col-lg-12 col-md-12 -->
			</div><!-- row -->
		</div><!-- ask-content -->
	</div><!-- parent-container -->
<?php require_once('includes/doc_footer.php'); ?>