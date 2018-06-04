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



 $page = 'complaint';



if(isset($_GET['detail']) && trim($_GET['detail'])){

	$reqID = $_GET['detail'];

	$result = $User->query("SELECT `id`, `userId`, `siteName`, `link`, `reason`, `statusText`, `complaintTitle`, `complaintText`, `complaintFiles`, `amount`, `isVerified`, `status`, `updatedOn`, `createdOn` FROM `tblComplaints` WHERE `id` = '" . $reqID . "'");

	if(isset($result) && is_array($result) && count($result) > 0){

		$_SESSION['value'] = $result;

	}

}



if(isset($_POST) && is_array($_POST) && count($_POST) > 0 && isset($_POST['identity']) && $_POST['identity']=='_COMPLAINT_RESPONSE_'){



    if($Card->complaintResponse($_POST, $_FILES)){
    	C::redirect(C::link('complaint.php', false, true));

    }	

}

?>

<?php require_once('includes/doc_head.php'); ?>

			<div class="test">

				<div class="row content">

						<div class="image-complain"></div>

					<div class="details-page">

						<div class="ask-desktop-table">

							<table class="ask-top-table">

								<tr>

									<td>

										<div class="details-page-name">

											<span><span class="text-capitalize"><?php echo $_SESSION['value'][0]['siteName']; ?></span> - <?php echo $_SESSION['value'][0]['complaintTitle']; ?></span>

										</div>

									</td>

									<td>

										<div class="details-page-joinCode">

											<!-- <span>Join Code</span><br>

											<span>6969</span> -->

										</div>

										<div class="details-page-logo">

											<div class="complain-logo">

												<?php

													if($_SESSION['value'][0]['status'] == 'P'){

												?>

													<div class="ask-ripple ask-ripple-pending">

														<span class="glyphicon glyphicon-hourglass ask-complai-logo complai-pending"></span>

														<span class="ripple-pending" style="z-index:-1;"></span>

													</div>

												<?php

													}else if($_SESSION['value'][0]['status'] == 'S'){

												?>

													<div class="ask-ripple ask-ripple-success">

														<span class="glyphicon glyphicon-hourglass ask-complai-logo complai-success"></span>

														<span class="ripple-success" style="z-index:-1;"></span>

													</div>

												<?php

													}else if($_SESSION['value'][0]['status'] == 'U'){

												?>

													<div class="ask-ripple ask-ripple-reject">

														<span class="glyphicon glyphicon-hourglass ask-complai-logo complai-reject"></span>

														<span class="ripple-reject" style="z-index:-1;"></span>

													</div>

												<?php } ?>

											</div>

										</div>

									</td>

								</tr>

							</table>

							<h5 class="text-white">분쟁 정보</h5>

							<table class="ask-table">

								<tr>

									<th class="text-yellow text-capitalize"><?php echo $_SESSION['value'][0]['siteName']; ?></th>

									<th class="text-yellow"><?php echo $_SESSION['value'][0]['reason']; ?></th>

									<th class="text-yellow">

									<?php

										if($_SESSION['value'][0]['status'] == 'P'){

											echo "진행중";

										} else if($_SESSION['value'][0]['status'] == 'S'){

											echo "해결완료";

										} else if($_SESSION['value'][0]['status'] == 'U'){

											echo "미해결";

										}

									?>

									</th>

								</tr>

								<tr>

									<td>사이트명</td>

									<td>신청 이유</td>

									<td><?php echo $_SESSION['value'][0]['statusText'] ;?></td>

								</tr>

							</table>

						</div>

						<!-- info for mobile and tablet -->

					<div class="ask-mobile-table">

						<table class="ask-table">

							<tr>

								<td colspan="2">

									<div class="details-page-name">

										<span><span class="text-capitalize"><?php echo $_SESSION['value'][0]['siteName']; ?></span> - <?php echo $_SESSION['value'][0]['complaintTitle']; ?></span>

									</div>

								</td>

							</tr>

						</table>

						<h5 class="text-white">분쟁 정보</h5>

						<table class="ask-table">

							<tr>

								<td class="text-yellow">사이트명</td>

								<td><?php echo $_SESSION['value'][0]['siteName']; ?></td>

							</tr>

							<tr>

								<td class="text-yellow">신청 이유</td>

								<td><?php echo $_SESSION['value'][0]['reason']; ?></td>

							</tr>

							<tr>

								<td class="text-yellow"><?php echo $_SESSION['value'][0]['statusText'] ;?></td>

								<td>

									<?php

										if($_SESSION['value'][0]['status'] == 'P'){

											echo "진행중";

										} else if($_SESSION['value'][0]['status'] == 'S'){

											echo "해결완료";

										} else if($_SESSION['value'][0]['status'] == 'U'){

											echo "미해결";

										}

									?>

								</td>

							</tr>

						</table>

					</div>

					<!-- info for mobile and tablet end -->

						<div class="margin-top-20">

							<p class="text-white">

								<?php

								if($_SESSION['value'][0]['status'] != 'S'){

								?>

								<i class="fa fa-cog margin-right-5 font15" aria-hidden="true"></i>

								<span class="font15"><a href="http://<?php echo $_SESSION['value'][0]['link']; ?>" class="text-capitalize text-yellow"><?php echo $_SESSION['value'][0]['siteName']; ?></a> : <?php echo $_SESSION['value'][0]['statusText'] ;?></span>

								<?php } ?>

							</p>

						</div>

					</div>

				</div>

			</div>

			<div class="clearfix"></div>

			<div class="ask-content" id="ask-content">

				<div class="row">

					<div class="col-lg-9 col-md-9">

						<div class="ask-page-content">

							<div class="ask-page-content-header">

								<h3 class="heading text-white text-uppercase">분쟁 대화내용 </h3><!--  border-bottom-5 -->

							</div>

							<div class="ask-page-content-body-details" style="overflow:hidden;">

								<div class="row">

									<?php

										$complaintUserId = $User->query("SELECT `id`, `userId`, `nickName` FROM `tblUser` WHERE `id` = '" . $_SESSION['value'][0]['userId'] . "'");



									?>

									<div class="col-lg-2 col-md-2 col-sm-2 hide-user-icon">
										<img src="images/user/default_user.png" class="user-complaint img-circle" alt="" title="<?php echo $complaintUserId[0]['nickName'][0];?>" />

									</div>

									<div class="col-lg-10 col-md-10 col-sm-10">

										<table class="ask-table table-comments-show">

											<tr>

												<td>

													<div class="content arrow-content">

														<h5 class="page-header comment-preview-header margin-top-0">

															<span class="text-yellow margin-right-5"><?php echo $complaintUserId[0]['nickName'];?></span>

															<span class="text-white hide-user-icon">(작성한 날짜 <?php echo $_SESSION['value'][0]['createdOn']; ?>)</span>

															<?php

															$delOpt = ((int)User::loggedInUserId() > 0 ? User::loggedInUserId() : 0);

															if($delOpt == 1){

															?>

															<span class="pull-right" style="margin-top:-3px;color:#000;"><button type="button" class="btn btn-xs" id="deleteComplain" data-tabelname="tblComplaints" data-attrid="<?php echo $_SESSION['value'][0]['id'];?>">삭제하기</button></span>

															<?php } ?>

														</h5>

														<div class="comment-show">

															<table class="ask-table">

																<tr>

																	<td style="padding-bottom:10px;">

																		<?php echo $_SESSION['value'][0]['complaintText'] ;?>

																		<hr>

																		<ul class="compliant-img">

																		<?php
																		if($_SESSION['value'][0]['complaintFiles'] != ''){

																			$filesComplaint = json_decode($_SESSION['value'][0]['complaintFiles']);

																			foreach ($filesComplaint as $img) {?>

																			<li>

																				<a class="fancybox" href="<?php echo $img ;?>" target="_blank"><img src="<?php echo $img;?>" class="img-responsive" width="135px" height="90px" alt=""></a>

																			</li>

																		<?php

																			}

																		?>

																			

																		<?php } ?>

																		</ul>

																	</td>

																</tr>

															</table>

														</div>

													</div>			

												</td>

											</tr>

										</table>

									</div>

								</div>

								<div class="row">

								<?php

									$res = $User->query("SELECT `id`, `siteName`, `userId`, `siteName`, `responsText`, `responsFiles`, `updatedOn`, `createdOn` FROM `tblComplaintsResponse` WHERE `isVerified` = 'Y' AND `complaintId` = '" . $_SESSION['value'][0]['id'] . "'");

									if(isset($res) && is_array($res) && count($res) > 0){

										foreach ($res as $key => $val) {

								?>

									<div class="col-lg-2 col-md-2 col-sm-2 hide-user-icon">

										

											<?php

												$icon = $User->query("SELECT `groupId`, `nickName`, `siteName`, `profile_img` FROM `tblUser` WHERE `id` = '" . $val['userId'] . "'");

												if($icon[0]['groupId'] == 3){

													$n = $icon[0]['nickName'];
													$UsrEditPost = true;
													echo '<img src="images/user/default_user.png" class="user-complaint img-circle" alt="" title="'.$complaintUserId[0]["nickName"].'" />';

												} else if($icon[0]['groupId'] == 2){ 

													$n = $icon[0]['siteName'];
													$siteadminEditPost = true;
													echo '<img src="'. $icon[0]['profile_img'] .'" class="user-complaint img-circle" alt="" title="'. $icon[0]['siteName'] .'" />';
												?>

											<!-- <p class="text-uppercase" style="padding-top:10px;" title="<?php echo $icon[0]['siteName'];?>"><b><?php echo $icon[0]['siteName'][0];?></b></p> -->

											<?php } else { 

													$n = '배팅타임 운영자';
													$AdminPostEdit = true;
													echo '<img src="images/user/admin.png" class="user-complaint img-circle" alt="" title="배팅타임 운영자" />';
												?>

											<?php } ?>

										

									</div>

									<div class="col-lg-10 col-md-10 col-sm-10">

										<table class="ask-table table-comments-show">

											<tr>

												<td>

													<div class="content arrow-content">

														<h5 class="page-header comment-preview-header margin-top-0">

															<span class="text-yellow margin-right-5"><?php echo $n; ?></span>

															<span class="text-white hide-user-icon">(작성한 날짜 <?php echo $val['createdOn']; ?>)</span>

															<?php

															$delOpt = ((int)User::loggedInUserId() > 0 ? User::loggedInUserId() : 0);

															if($delOpt == 1){

															?>

															<span class="pull-right" style="margin-top:-3px;color:#000;"><button type="button" class="btn btn-xs" id="deleteComplain" data-tabelName="tblComplaintsResponse" data-attrId="<?php echo $val['id'];?>">삭제하기</button></span>

															<?php } ?>

														</h5>

														<div class="comment-show">

															<table class="ask-table">

																<tr>

																	<td style="padding-bottom:10px;" class="text-reponse-wihimg">

																		<?php echo $val['responsText']; ?>

																		<?php

																		if($val['responsFiles'] != ''){

																		?>

																		<hr>
																		<ul class="compliant-img">

																			<?php

																			if($val['responsFiles'] != ''){

																				$filesComplaint = json_decode($val['responsFiles']);

																				foreach ($filesComplaint as $img) {?>

																				<li>

																					<a class="fancybox" href="<?php echo $img ;?>"><img src="<?php echo $img;?>" class="img-responsive" width="130px" height="90px" alt=""></a>

																				</li>

																			<?php

																				}

																			?>

																			

																		<?php } ?>

																		</ul>

																		<?php } ?>

																	</td>

																</tr>

															</table>

														</div>

													</div>			

												</td>

											</tr>

										</table>

									</div>

									<?php

										}

									}

									?>

								</div>

								

							</div>

						</div>

						<?php

						$logedInID = (int)User::loggedInUserId() > 0 ? User::loggedInUserId() : 0;

						 if($logedInID == $_SESSION['value'][0]['userId']){

						 	$User->query("UPDATE `tblComplaintsResponse` SET `checkUser` = 'Y' WHERE `complaintId` = '" . $_SESSION['value'][0]['id'] . "'");

						?>

						<div class="ask-page-content">

							<div class="">

								<div class="content">

									<form action="" method="POST" enctype="multipart/form-data">

										<div class="form-group arrow-content">

											<input type="hidden" name="identity" value="_COMPLAINT_RESPONSE_" />

											<input type="hidden" name="complaintId" value="<?php echo $_SESSION['value'][0]['id']; ?>" />

											<input type="hidden" name="id" value="<?php echo $complaintUserId[0]['id']; ?>" />
											
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
											<textarea name="responsText" id="min-text" class="text-white" width="100%" rows="5" required></textarea>

										</div>

										<div class="form-group addMoreContainer">

						 					<input type="file" name="complaintFiles[]" class="form-control complaintFiles" style="padding-top: 3px; padding-bottom: 38px;" />

						 					<button type="button" class="btn btn-ask-green" id="addMoreFile">Add More Files</button>

						 					<button type="button" class="btn btn-ask-red" id="removeFile">Remove</button>

						 				</div>

										<div>

											<button type="submit" class="btn btn-ask-red"> 작성하기</button>

										</div>

									</form>

								</div>

							</div>

						</div>

						<?

						}

						?>

						<div class="ask-page-content ask-land-page-content">

							<div class="ask-page-content-header">

								<h3 class="text-uppercase">사이트 분쟁해결 <span class="pull-right" style="font-size:12px;line-height:30px;"><a href="complaints/" class="text-white">자세히 보기</a></span></h3><!--  border-bottom-5 -->

								<p class="custom-p custom-text">이용하시는 사이트와 문제가 있으신가요? <a href="submit-complaint/">분쟁해결 신청하기</a> </p>

							</div>

							<div class="ask-page-content-body ask-detail-page-card onDesktop">

							<?php

								$result = $User->query("SELECT `id`, `reason`, `complaintTitle`, `complaintText`, `amount`, `isVerified`, `status` FROM `tblComplaints` WHERE `isVerified` = 'Y' AND `id`!='". $_SESSION['value'][0]['id'] ."'  ORDER BY `updatedOn` desc LIMIT 3");

								if(is_array($result) && count($result) > 0){

									foreach ($result as $key => $value) {				

								?>

								<div class="col-md-3 col-sm-3 col-xs-3 padding0  ask-land-web-card">

									<div class="ask-cards">

										<div class="ask-item-complain-card">

											<div class="front">

												<a href="complaint-details/<?php echo $value['id'];?>/">

													<div class="complain-logo">

														<?php

														if($value['status'] == 'P'){

													?>

														<div class="ask-ripple ask-ripple-pending">

															<span class="glyphicon glyphicon-hourglass ask-complai-logo complai-pending"></span>

															<span class="ripple-pending"></span>

														</div>

													<?php

														}else if($value['status'] == 'S'){

													?>

														<div class="ask-ripple ask-ripple-success">

															<span class="glyphicon glyphicon-ok-sign ask-complai-logo complai-success"></span>

															<span class="ripple-success"></span>

														</div>

													<?php

														}else if($value['status'] == 'U'){

													?>

														<div class="ask-ripple ask-ripple-reject">

															<span class="glyphicon glyphicon-remove-circle ask-complai-logo complai-reject"></span>

															<span class="ripple-reject"></span>

														</div>

													<?php } ?>

													</div>

												</a>

														<span class="pull-right fa fa-info info"></span>

												<?php

														if($value['status'] == 'P'){

													?>

														<p class="text-center text-capitalize text-pending pt5"><b>해결중</b></p>

													<?php

														}else if($value['status'] == 'S'){

													?>

														<p class="text-center text-capitalize text-sucess pt5"><b>해결완료</b></p>

													<?php

														}else if($value['status'] == 'U'){

													?>

														<p class="text-center text-capitalize text-reject pt5"><b>미해결</b></p>

													<?php } ?>

												<a href="complaint-details/<?php echo $value['id'];?>/">

													<div class="complain-short-desc" style="padding-top: 0px;">

														<p><?php echo $value['complaintTitle']; ?></p>

													</div>

													<div class="complain-Date" style="padding-top: 2px;">

														<p> <span style="font-size:24px;font-weight:900;"><?php echo $value['amount']; ?>만원</span><br>

															<?php echo $value['reason']; ?> </p>

													</div>

												</a>

											</div><!-- front -->

											<div class="back">

												<div class="complain-short-desc">

													<p><?php echo $value['complaintTitle']; ?></p>

													<!-- <span class="pull-right fa fa-close info"></span> -->

												</div>

												<div class="complain-about">

													<p class="text-justify"><?php echo C::contentMorewithoutlink($value['complaintText'], 200); ?></p>

												</div>

												<div class="complaint-readmore">

													<div class="text-center">

														<a href="complaint-details/<?php echo $value['id'];?>/" class="readMore">자세히 보기</a>

													</div>

													<span class="pull-right fa fa-close info"></span>

												</div>

											</div><!-- back -->

										</div><!-- ask-item-complain-card -->

									</div>

								</div><!-- col-md-3 -->

								<?php

								 }

							}

						//}

							?>

							</div>

							<div class="ask-page-content-body onMobile">

							<?php

								//$result = $User->query("SELECT `id`, `reason`, `siteName`, `complaintTitle`, `complaintText`, `amount`, `isVerified`, `status` FROM `tblComplaints` WHERE `isVerified` = 'Y'  ORDER BY `updatedOn` ASC LIMIT 4");

								if(is_array($result) && count($result) > 0){

									foreach ($result as $key => $value) {				

								?>

								<div class="col-xs-12 complaint-onmobile padding0">

									<div class="complaint-stat">

										<a href="complaint-details/<?php echo $value['id'];?>/">

													<div class="complain-logo">

													<?php

														if($value['status'] == 'P'){

													?>

														<div class="ask-ripple">

															<span class="glyphicon glyphicon-hourglass ask-complai-logo complai-pending-mobile"></span>

														</div>

													<?php

														}else if($value['status'] == 'S'){

													?>

														<div class="ask-ripple">

															<span class="glyphicon glyphicon glyphicon-ok-sign ask-complai-logo complai-success-mobile"></span>

														</div>

													<?php

														}else if($value['status'] == 'U'){

													?>

														<div class="ask-ripple">

															<span class="glyphicon glyphicon-remove-circle ask-complai-logo complai-reject-mobile"></span>

														</div>

													<?php } ?>

													</div>

												</a>

									</div>

									<div class="complaint-stat-desc">

										<a  class="text-white" href="complaint-details/<?php echo $value['id'];?>/"><h4><?php echo substr($value['complaintTitle'], 0, 60); ?><?php if (strlen($value['complaintTitle']) > 60) {

																echo '...';

															}?></h4></a>

										<a href="complaint-details/<?php echo $value['id'];?>/">

										<?php

												if($value['status'] == 'P'){

											?>

												<p class="text-capitalize text-pending"><b>해결중</b></p>

											<?php

												}else if($value['status'] == 'S'){

											?>

												<p class="text-capitalize text-sucess"><b>해결완료</b></p>

											<?php

												}else if($value['status'] == 'U'){

											?>

												<p class="text-capitalize text-reject"><b>미해결</b></p>

											<?php } ?>

										</a>

									</div>

								</div><!-- col-md-3 -->

							<?php

								 }

							}
						//}
							?>

							</div><!-- ask-page-content-body -->

						</div><!-- bonus code landing-->

					</div><!-- col-lg-9 col-md-9 -->
					<div class="col-lg-3 col-md-3" style="padding-left: 0px;">

						<?php require_once('includes/sportsRecommend.php'); ?>

					</div>

				</div><!-- row -->
			</div><!-- ask-content -->

		</div><!-- parent-container -->

<?php require_once('includes/doc_footer.php'); ?>