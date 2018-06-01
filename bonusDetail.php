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



$page = 'bonus';



function error_found(){

   //C::redirect(C::link(HOST.'404.php', false, true));

}

set_error_handler('error_found');



$reqID = array();

if(isset($_GET['detail']) && trim($_GET['detail'])){

	//$reqID = $_GET['detail'];

	$getID = explode(" ", trim($_GET['detail']));

	$getName = explode("=", trim($getID['0']));

	//$reqName = str_replace('-', ' ', $reqID['0']);

	// print_r($_GET);

	// print_r($getID);

	// print_r($getName);

	$reqID['1'] = $getID['0'];

	$result = $User->query("SELECT * FROM `tblBonusCards` WHERE `id` = '" . $reqID[1] . "'");

	if(isset($result) && is_array($result) && count($result) > 0){

		$_SESSION['value'] = $result;

		$reqName = $_SESSION['value'][0]['bonusName'];

	}

}

$page = '';
$metaTitle = $_SESSION['value'][0]['metaTitle'];
$metaKeyword = $_SESSION['value'][0]['metaKeyword'];
$metaDesc = $_SESSION['value'][0]['metaDesc'];

if(isset($_POST) && is_array($_POST) && count($_POST) > 0 && isset($_POST['_COMMENT_CAT']) && $_POST['_COMMENT_CAT'] == 'BONUS_COMMENT' ){

	if(!$User->checkLoginStatus()){

		//$Common->redirect('index.php');

		Message::addMessage("You are not logged in. Please login here to post your comment", ERR);

	}else{

		if($Card->addBonusComments($_POST, $reqID['1'])){

			Message::addMessage("Your comment will be displayed after verify by admin.", SUCCS);

    	}

    	require_once('send-commentMail.php');

	}

}





?>

<?php require_once('includes/doc_head.php'); ?>

<style>
	#fixed-right{margin-top:5px;}
</style>

			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" id="image-bg">

				<div class="details-page">

					<div class="image-label">

						<p class="custom-text-rotate">

							<span style="font-size:12px;">가입코드</span><br>

							<span style="font-size:20px;"><?php echo $_SESSION['value']['0']['joinCode']; ?></span>

						</p>

					</div>

					<div class="ask-desktop-table">

						<table class="ask-top-table">

							<tr>

								<td>

									<div class="details-page-name">

										<span class="text-capitalize"><?php echo $_SESSION['value']['0']['bonusName']; ?>&nbsp-&nbsp<?php echo $_SESSION['value']['0']['sportsName']; ?></span><br/>
										<!-- <span class="text-capitalize"><?php echo $_SESSION['value']['0']['sportsName']; ?></span><br> -->

										<span><?php echo nl2br($_SESSION['value']['0']['description']); ?></span><br>

										<!-- <span><?php echo $_SESSION['value']['0']['bonusAmount']; ?></span> -->

									</div>

								</td>

								<td>

									<div class="details-page-joinCode">

										<span>가입코드</span><br>

										<span><?php echo $_SESSION['value']['0']['joinCode']; ?></span>

									</div>

									<div class="details-page-logo">

										<img src="<?php echo $_SESSION['value']['0']['bonusImage']; ?>" alt=""  style="border:4px solid #ccc;" />

									</div>

								</td>

							</tr>

						</table>

						<table class="ask-table">

							<h5 class="text-white margin-top-20">보너스 정보</h5>

							<tr>

								<!-- <th class="text-yellow font18"><?php echo $_SESSION['value']['0']['sportsName']; ?></th> -->

								<th class="text-yellow font18"><?php echo $_SESSION['value']['0']['bonusAmount']; ?></th>

								<th class="text-yellow font18"><?php echo $_SESSION['value']['0']['wageringRequirements']; ?></th>
								<th class="text-yellow font18"><?php echo $_SESSION['value']['0']['wageringRequirementsMinigame']; ?></th>

								<!-- <th class="text-yellow font18"><?php echo $_SESSION['value']['0']['bonusCode']; ?></th> -->

								<th class="text-yellow font18"><?php echo $_SESSION['value']['0']['bonustype']; ?></th>

							</tr>

							<tr>

								<!-- <td class="padding-top-0">사이트명</td> -->

								<td class="padding-top-0">보너스 금액</td>

								<td class="padding-top-0">이용 조건 (스포츠)</td>
								<td class="padding-top-0">이용 조건 (미니게임)</td>

								<!-- <td class="padding-top-0">보너스 코드</td> -->

								<td class="padding-top-0">보너스 타입</td>

							</tr>

						</table>

					</div>

					

					<!-- info for mobile and tablet -->

					<div class="ask-mobile-table">

						<table class="ask-table text-center">

							<tr>

								<td colspan="2">

									<div class="details-page-logo-mobile" align="center">

										<img src="<?php echo $_SESSION['value']['0']['bonusImage']; ?>" alt=""  style="border:4px solid #ccc;" />

									</div>

								</td>

							</tr>

							<tr>

								<td colspan="2" align="center">

									<div class="details-page-name text-wrap">

										<span class="text-capitalize"><?php echo $_SESSION['value']['0']['bonusAmount']; ?> <?php echo $_SESSION['value']['0']['bonustype']; ?></span><br>

										<span><?php echo $_SESSION['value']['0']['description']; ?></span><br>

									</div>

								</td>

							</tr>

							<tr>

								<td colspan="2">

									<div class="details-page-joinCode-mobile">

										<span>가입코드&nbsp :&nbsp </span>

										<span><?php echo $_SESSION['value']['0']['joinCode']; ?></span>

									</div>

								</td>

							</tr>

						</table>

						<table class="ask-table respo-table">

							<tr>

								<td>사이트명</td>

								<td class="text-yellow"><b><?php echo $_SESSION['value']['0']['sportsName']; ?></b></td>

							</tr>

							<tr>

								<td>보너스 금액</td>

								<td class="text-yellow"><b><?php echo $_SESSION['value']['0']['bonusAmount']; ?></b></td>

							</tr>

							<tr>

								<td>이용 조건</td>

								<td class="text-yellow"><b><?php echo $_SESSION['value']['0']['wageringRequirements']; ?></b></td>

							</tr>

							<!-- <tr>

								<td>보너스 코드</td>

								<td class="text-yellow"><b><?php echo $_SESSION['value']['0']['bonusCode']; ?></b></td>

							</tr> -->

							<tr>

								<td>보너스 타입</td>

								<td class="text-yellow"><b><?php echo $_SESSION['value']['0']['bonustype']; ?></b></td>

							</tr>

						</table>

					</div>

					<!-- info for mobile and tablet end -->

					

				</div>

				<div class="col-sm-12 content-button">

					<div class="col-sm-4 playNow">

						<a href="#" class="btn btn-ask-red btn-w100 text-capitalize padding10 font15" data-toggle = "modal" data-target="#exampleModal" id = "modalShow"><b><i class="fa fa-reply-all margin-right-5" aria-hidden="true"></i> 사이트 바로가기</b></a>

						<input type="hidden" class="hiddenpopup" name="popupjoincode" value="<?php echo $_SESSION['value']['0']['joinCode']; ?>">
						<input type="hidden" class="hiddenpopupweblink" name="popupweblink" value="<?php if(strpos($_SESSION['value']['0']['link'], 'http') !== false ) {echo $_SESSION['value']['0']['link'];} else {echo 'http://'.$_SESSION['value']['0']['link'];}?>">

					</div>

					<div class="col-sm-4">

						<a href="<?php echo $_SERVER['REQUEST_URI'];?>/#addReview" class="btn btn-ask-green btn-w100 text-capitalize padding10 font15"><b><i class="fa fa-pencil margin-right-5" aria-hidden="true"></i> 후기 등록하기</b></a>

					</div>

					<div class="col-sm-4">

						<a href="submitComplaint.php" class="btn btn-ask-grd-blue btn-w100 text-capitalize padding10 font15"><b><i class="fa fa-gavel margin-right-5" aria-hidden="true"></i> 분쟁 해결 신청하기</b></a>

					</div>

				</div>

				<div class="content row fixed-top">

					<div class="col-sm-8 margin-top-10 mobile-hide-letter">

						<span class="font15 respo-font text-white text-uppercase"><b><?php echo $_SESSION['value']['0']['sportsName']; ?></b></span>

						<span class="font15 respo-font text-white text-uppercase"><b> &nbsp;&nbsp;/&nbsp;&nbsp; 가입코드 : <?php echo $_SESSION['value']['0']['joinCode']; ?></b></span>

					</div>
					
					<div class="col-sm-4 playNow">

						<a href="#" class="btn btn-ask-red btn-w100 text-capitalize padding10 font15" data-toggle = "modal" data-target="#exampleModal" id = "modalShow"><b><i class="fa fa-reply-all margin-right-5" aria-hidden="true"></i> 사이트 바로가기</b></a>

						<input type="hidden" class="hiddenpopup" name="popupjoincode" value="<?php echo $_SESSION['value']['0']['joinCode']; ?>">
						<input type="hidden" class="hiddenpopupweblink" name="popupweblink" value="<?php if(strpos($_SESSION['value']['0']['link'], 'http') !== false ) {echo $_SESSION['value']['0']['link'];} else {echo 'http://'.$_SESSION['value']['0']['link'];}?>">

					</div>

				</div>

			</div> 

			<div class="clearfix"></div>

			<div class="ask-content" id="ask-content">

				<div class="row">

					<div class="col-lg-9 col-md-9" id="show-pop-up">

						<div class="ask-page-content">

							<div class="ask-page-content-header">
								<h3 class="heading text-white text-uppercase">보너스 세부정보 </h3>
							</div>
							<div class="ask-page-content-body-details" style="padding-right: 0px;"> 

								<div class="row content">

									<table class="ask-table text-bold custom-table-padding formobileTable">

										<?php

										$result = $User->query("SELECT * FROM `tblBonusCards` WHERE `id` = '" . $reqID[1] . "'");

										if(isset($result) && is_array($result) && count($result) > 0){

											$value = $result;

										?>

										<tr>

											<td style="width:30%"> 가입코드 :</td>

											<td><a href="javascript:void(0)" class="btn btn-ask-white" style="margin-left: 0px;"><?php echo $value['0']['joinCode']; ?></a></td>

										</tr>

										<tr>

											<td> 이용 조건 :</td>

											<td><a href="bonus/?wageringRequirements[]=<?php echo $value['0']['wageringRequirements']; ?>"><?php echo $value['0']['wageringRequirements']; ?></a></td>

										</tr>

										<tr>

											<td>보너스 타입 :</td>

											<td><a href="bonus/?bonustype[]=<?php echo $value['0']['bonustype']; ?>"><?php echo $value['0']['bonustype']; ?></a></td>

										</tr>

										<tr>

											<td>보너스 금액 :</td>

											<td><a href="bonus/?bonusAmount[]=<?php echo $value['0']['bonusAmount']; ?>"><?php echo $value['0']['bonusAmount']; ?></a></td>

										</tr>

										<!-- <tr>

											<td>보너스 코드 :</td>

											<td><a href="javascript:void(0)"><?php echo $value['0']['bonusCode']; ?></a></td>

										</tr> -->

										<?php if($value['0']['minDepositeAmpount'] !=''){?>

										<tr>

											<td>최소 입금금액 :</td>

											<td><a href="bonus/?minDepositeAmpount[]=<?php echo $value['0']['minDepositeAmpount']; ?>"><?php echo $value['0']['minDepositeAmpount']; ?></a></td>

										</tr>

										
										<?php }
										?>

										<?php if($value['0']['maxBonusAmount'] !='' && $value['0']['maxBonusAmount'] != 0){?>

										<tr>

											<td>최대 보너스 금액 :</td>

											<td><a href="bonus/?maxBonusAmount=<?php echo $value['0']['maxBonusAmount']; ?>"> <?php echo $value['0']['maxBonusAmount']; ?></a></td>

										</tr>

										<?php }?>

										<?php if($value['0']['maxCashout'] !=''){?>

										<tr>

											<td>최대 출금가능 금액 :</td>

											<td><a href="bonus/?maxCashout=<?php echo $value['0']['maxCashout']; ?>"><?php echo $value['0']['maxCashout']; ?></a></td>

										</tr>

										<?php }?>

										<?php if($value['0']['bonusWithdrawlCondition'] !=''){?>

										<tr>

											<td>보너스 출금 조건 :</td>

											<td><a href="bonus/?bonusWithdrawlCondition[]=<?php echo $value['0']['bonusWithdrawlCondition']; ?>"><?php echo $value['0']['bonusWithdrawlCondition']; ?></a></td>

										</tr>

										<?php }?>

										<?php

										}

										?>

										<?php

											$res = $value[0]['bonusOtherDetails'];

											if(isset($res) && $res != 'Array+Array'){

											$res = explode('+', $value[0]['bonusOtherDetails']);

											$label = explode(',', $res['0']);

											$datas = explode(',', $res['1']);



											

											foreach ($label as $index => $val) {

										?>

										<tr>

											<td> <?php echo $val; ?> :</td>

											<td><a href="javascript:void(0)"> <?php echo $datas[$index]; ?> </a></td>

										</tr>

										<?php

												}

											}

										?>

									</table>

								</div>

							</div>

						</div>

						<div class="ask-page-content">

							<div class="ask-page-content-header">

								<h3 class="heading text-white text-uppercase">보너스 후기 </h3><!--  border-bottom-5 -->

							</div>

							<div class="ask-page-content-body-details">

								<div class="col-lg-12 col-md-12 commentsContainer">

								<?php

								$result = $User->query("SELECT `TBC`.`id`, `TBC`.`gdComments`, `TBC`.`badComments`, `TBC`.`rating`, `TBC`.`updatedOn`, `TU`.`userId`, `TU`.`nickName` FROM `tblBonusComment` as `TBC`, `tblUser` as `TU`  WHERE `TBC`.`isRecommanded` = 'Y' AND `TBC`.`userId` = `TU`.`id` AND `TBC`.`bonusId` = '" . $reqID[1] . "'");

								if(is_array($result) && count($result) > 0){

									$index = 0;

								?>

									<div class="margin-top-20 commentsFilterArea">

										<a href="" class="text-yellow m-r-10 commentsFilter" data-filter="ALL">전체보기</a>

										<a href="" class="text-yellow m-r-10 commentsFilter" data-filter="GOOD">평점 높은 후기순</a>

										<a href="" class="text-yellow m-r-10 commentsFilter" data-filter="BAD">평점 낮은 후기순</a>

									</div>

								<?php

									foreach ($result as $key => $value) {

										$response_id = $value['id'];

								?>

									<table class="ask-table commentFilterTbl" data-rate="<?php echo $value['rating'];?>" data-idx="<?php echo $index;?>">

										<tr>

											<td style="width:15%;" class="userIconsDisplay">

												<div class="content img-circle user-comment text-center">

													<?php $firstLt = $value['nickName']; ?>

													<p class="text-uppercase" style="padding-top:10px;"><b><?php echo $firstLt[0];?></b></p>

												</div>

											</td>

											<td>

												<div class="content arrow-content">

													<h5 class="page-header comment-preview-header margin-top-0 onDesktop">

														<span class="text-yellow margin-right-5"><?php echo $value['nickName']; ?></span>

														<?php $updateDate = explode(' ', $value['updatedOn']);?>

														<span class="text-white">(작성한 날짜 <?php echo $updateDate[0]; ?>)</span>

														<span class="rating padding3 font13 pull-right cmntRate">

					                                        <?php 

				                                    		if ($value['rating'] == 1) {

			                                    			?>

			                                    			<i class="fa fa-star text-white" aria-hidden="true"></i><i class="fa fa-star-o" aria-hidden="true"></i></i><i class="fa fa-star-o" aria-hidden="true"></i></i><i class="fa fa-star-o" aria-hidden="true"></i></i><i class="fa fa-star-o" aria-hidden="true"></i></i>

			                                    			<?php

					                                    		} else if($value['rating'] == 2){

			                                    			?>

			                                    			<i class="fa fa-star text-white" aria-hidden="true"></i><i class="fa fa-star text-white" aria-hidden="true"></i><i class="fa fa-star-o" aria-hidden="true"></i></i><i class="fa fa-star-o" aria-hidden="true"></i></i><i class="fa fa-star-o" aria-hidden="true"></i></i>

			                                    			<?php

					                                    		} else if($value['rating'] == 3){

			                                    			?>

			                                    			<i class="fa fa-star text-white" aria-hidden="true"></i><i class="fa fa-star text-white" aria-hidden="true"></i><i class="fa fa-star text-white" aria-hidden="true"></i><i class="fa fa-star-o" aria-hidden="true"></i></i><i class="fa fa-star-o" aria-hidden="true"></i></i>

			                                    			<?php

					                                    		} else if($value['rating'] == 4){

			                                    			?>

			                                    			<i class="fa fa-star text-white" aria-hidden="true"></i><i class="fa fa-star text-white" aria-hidden="true"></i><i class="fa fa-star text-white" aria-hidden="true"></i><i class="fa fa-star text-white" aria-hidden="true"></i><i class="fa fa-star-o" aria-hidden="true"></i></i>

			                                    			<?php

					                                    		} else if($value['rating'] == 5){

			                                    			?>

															<i class="fa fa-star text-white" aria-hidden="true"></i><i class="fa fa-star text-white" aria-hidden="true"></i><i class="fa fa-star text-white" aria-hidden="true"></i><i class="fa fa-star text-white" aria-hidden="true"></i><i class="fa fa-star text-white" aria-hidden="true"></i>

			                                    			<?php

					                                    		}

					                                    	?>

					                                    </span>

													</h5>

													<div class="onMobile" style="border-bottom:1px solid #fff;overflow:hidden;">

														<h5 style="margin-top: 0px;">

															<span class="text-yellow"><b><?php echo $value['nickName']; ?></b></span>

														</h5>

														<p style="margin-top: -15px;"><span class="rating padding3 font13 cmntRate">

					                                        <?php 

				                                    		if ($value['rating'] == 1) {

			                                    			?>

			                                    			<i class="fa fa-star text-white" aria-hidden="true"></i><i class="fa fa-star-o" aria-hidden="true"></i></i><i class="fa fa-star-o" aria-hidden="true"></i></i><i class="fa fa-star-o" aria-hidden="true"></i></i><i class="fa fa-star-o" aria-hidden="true"></i></i>

			                                    			<?php

					                                    		} else if($value['rating'] == 2){

			                                    			?>

			                                    			<i class="fa fa-star text-white" aria-hidden="true"></i><i class="fa fa-star text-white" aria-hidden="true"></i><i class="fa fa-star-o" aria-hidden="true"></i></i><i class="fa fa-star-o" aria-hidden="true"></i></i><i class="fa fa-star-o" aria-hidden="true"></i></i>

			                                    			<?php

					                                    		} else if($value['rating'] == 3){

			                                    			?>

			                                    			<i class="fa fa-star text-white" aria-hidden="true"></i><i class="fa fa-star text-white" aria-hidden="true"></i><i class="fa fa-star text-white" aria-hidden="true"></i><i class="fa fa-star-o" aria-hidden="true"></i></i><i class="fa fa-star-o" aria-hidden="true"></i></i>

			                                    			<?php

					                                    		} else if($value['rating'] == 4){

			                                    			?>

			                                    			<i class="fa fa-star text-white" aria-hidden="true"></i><i class="fa fa-star text-white" aria-hidden="true"></i><i class="fa fa-star text-white" aria-hidden="true"></i><i class="fa fa-star text-white" aria-hidden="true"></i><i class="fa fa-star-o" aria-hidden="true"></i></i>

			                                    			<?php

					                                    		} else if($value['rating'] == 5){

			                                    			?>

															<i class="fa fa-star text-white" aria-hidden="true"></i><i class="fa fa-star text-white" aria-hidden="true"></i><i class="fa fa-star text-white" aria-hidden="true"></i><i class="fa fa-star text-white" aria-hidden="true"></i><i class="fa fa-star text-white" aria-hidden="true"></i>

			                                    			<?php

					                                    		}

					                                    	?>
					                                    	<?php echo explode(' ', $value['updatedOn'])[0];?>
					                                    </span></p>

													</div>

													<div class="comment-show">

														<table class="ask-table">

															<tr>

																<td style="">

																	<i class="fa fa-thumbs-up text-green" aria-hidden="true"></i>

																</td>

																<td style="padding-bottom:10px;">

																	<span><?php echo $value['gdComments']; ?></span>

																</td>

															</tr>

															<tr>

																<td style="">

																	<i class="fa fa-thumbs-down text-red" aria-hidden="true"></i>

																</td>

																<td style="padding-bottom:10px;">

																	<span><?php echo $value['badComments']; ?></span>

																</td>

															</tr>

														</table>

													</div>

												</div>			

											</td>

										</tr>



										<?php

										$logedInID = (int)User::loggedInUserId() > 0 ? User::loggedInUserId() : 0;

										if($User->checkLoginStatus()){

											$userid = $User->query("SELECT `userId`, `groupId`, `siteName` FROM `tblUser` WHERE `id` = '" . $logedInID . "' LIMIT 0,1");



											if($userid[0]['userId'] == $value['userId']){

											

												$User->query("UPDATE `tblCommentResponse` SET `checkUser` = 'Y' WHERE `responseId`='". $response_id ."' AND `categoryId` = '" . $reqID[1] . "' AND `isVerified`='Y' AND `category`='2'");

											}

										}



											$innrRes = $User->query("SELECT `id`, `userId`, `responseId`, `comment` FROM `tblCommentResponse` WHERE `responseId`='". $response_id ."' AND `categoryId` = '" . $reqID[1] . "' AND `isVerified`='Y' AND `category`='2' ORDER BY `createdOn`");

													if(is_array($innrRes) && count($innrRes) > 0){

														foreach ($innrRes as $key1 => $value1) {

										?>

										<tr>

						                    <td style="width:15%;" class="userIconsDisplay">&nbsp;</td>

						                    <td>

						                        <div class="content" style="margin-top: -22px;">

													<?php

													$res1 = $User->query("SELECT `id`, `userId`, `groupId`, `siteName` FROM `tblUser` WHERE `id` = '" . $value1['userId'] . "'");

													if(is_array($res1) && count($res1) > 0){

														foreach ($res1 as $index1 => $val1) {

															$gID = $val1['groupId'];

															$admin = 'Admin';

													?>

						                            <h5 class="page-header comment-preview-header margin-top-0">

						                                <span class="text-yellow margin-right-5"><?php echo ($gID == 0 ? $admin : $val1['siteName']); ?></span>

						                            </h5>

						                            <?php

																}

															}

													?>

						                            <div class="comment-show">

						                                <table class="ask-table">

						                                    <tr>

						                                        <td style="padding-bottom:10px;">

						                                            <span><?php echo $value1['comment']; ?></span>

						                                        </td>

						                                    </tr>

						                                </table>

						                            </div>

						                        </div>      

						                  </td>

						                </tr>

						                <?php

													}

												}

										?>

									</table>

								<?php

										$index++;

									}

								}else{

								?>

								<p class="text-yellow text-uppercase" style="padding-top:10px;">처음으로 해당 보너스의 후기를 남겨보세요! </p>

								<?php

								}

								?>

								</div>

							</div>

						</div>

						<div class="ask-page-content" id="addReview">

							<div class="ask-page-content-header">

								<h3 class="heading text-white text-uppercase">후기 등록 </h3><!--  border-bottom-5 -->

							</div>

							

							<div class="ask-page-content-body-details">
								<?php 

								if((int)User::loggedInUserId() > 0)

								{

								?>
								<div class="col-lg-12 col-md-12 postComment">

									<form action="" method="post" enctype="multipart/form-data">

										<table class="ask-table" style="margin-bottom:-35px;">

											<tr>

												<td style="width:15%;">

													<div class="content img-circle user-comment text-center">

														<i class="fa fa-thumbs-up margin-top-15 text-green" aria-hidden="true"></i>

													</div>

												</td>

												<td>

													<div class="content arrow-content gdCommentstextarea">

														<textarea name="likeComment" id="" cols="" rows="3" placeholder="어떠한 점이 좋으셨나요?"></textarea>

														<input type="hidden" name="_COMMENT_CAT" value="BONUS_COMMENT" />

													</div>			

												</td>

											</tr>

										</table>

										<table class="ask-table">

											<tr>

												<td style="width:15%;">

													<div class="content img-circle user-comment text-center">

														<i class="fa fa-thumbs-down margin-top-15 text-red" aria-hidden="true"></i>

													</div>

												</td>

												<td>

													<div class="content arrow-content badCommentstextarea">

														<textarea name="dislikeComment" id="" cols="" rows="3" placeholder="어떠한 점이 불편하셨나요?"></textarea>

													</div>			

												</td>

											</tr>

										</table>

										<div class="col-md-10 col-md-offset-2">

											<p class="text-white">해당 사이트를 평가해주세요.</p>

											<div class="rating font13 text-white star-margin" style="margin-top:-7px;">

		                                        <div class="rateyo-readonly-widg" data-toggle="tooltip" title=""></div>

		                                        <div class="counter ratingCounter"></div>

		                                        <input type="hidden" id="commentRate" name="commentRate" value="5" />

		                                        <input type="hidden" name="category" value="BONUS" />

		                                    </div>

		                                    <p class="text-white"><input type="checkbox" name="checkPost" required /><span style="margin-left:15px;">저의 후기는 본인 자신의 경험을 토대로 작성하였으며 진실된 의견임을 선언합니다. 저는 해당 사이트 직원이 아니며, 해당 리뷰로 인해 사이트로부터 인센티브 혹은 어떠한 보너스도 받지 않았습니다. 배팅타임에서는 거짓된 리뷰에 대해 엄격한 조치를 취할 것입니다. </span></p>

		                                    <div style="margin-top:20px;margin-bottom:10px;">

		                                    	<button type="submit" class="btn btn-ask-red" style="margin:0px 20px 0px 0px;">작성하기</button><a href="posting-guidlines.php" class="text-yellow">댓글 가이드라인 확인하기</a>

	                                    	</div>

										</div>

									</form>

									<?php

							}else{

								?>
								<!--<h5 class="heading text-white text-uppercase">로그인 후 작성이 가능합니다.</h5>-->
								<p class="text-yellow text-uppercase" style="padding-top:20px;padding-left:20px;">로그인 후 작성이 가능합니다.</p>
								<?php
								}
								?>

								

							</div>
						</div>

						<div class="ask-page-content ask-land-page-content">

							<div class="ask-page-content-header">

								<h3 class="text-uppercase">다른 사이트 보너스 <span class="pull-right" style="font-size:12px;line-height:30px;"><a href="bonus/" class="text-white">전체보기</a></span></h3><!--  border-bottom-5 -->

								<p class="custom-text custom-p">신규가입 보너스, 낙첨금 보너스, 매일 첫충 보너스 등 다양한 보너스를 함께 누려보세요!<br>자신이 찾고 있는 보너스가 있다면 쉽게 찾아 볼 수 있으며 배팅의 재미를 배로 느껴보실 수 있습니다. </p>

							</div>

							<div class="ask-page-content-body ask-detail-page-card onDesktop">

								<?php

								

								$result = $User->query("SELECT `id`, `bonusName`, `joinCode`, `bonusAmount`, `link`, `bonusCode`, `bonustype`, `wageringRequirements`, `sportsName`, `rating`, `bonusImage`, `imageName`, `description` FROM `tblBonusCards` WHERE `sportsName` = '" . $_SESSION['value']['0']['sportsName'] . "' ORDER BY `updatedOn` desc LIMIT 3");

								if(is_array($result) && count($result) > 0){

									foreach ($result as $key => $data) {				

								?>

								<div class="col-md-3 col-sm-3 col-xs-3 padding0 ask-land-web-card">

									<div class="ask-cards">

										<div class="ask-item-web-card" style="height: 292px;">

											<div class="front">

										        <div class="cardHeader">
										            <a href="bonus-details/<?php echo $data['id']?>/<?php echo $data['bonusName'];?>"><h5><?php echo $data['bonusName']; ?></h5></a>
										            <span class="fa fa-info info" style="font-size:14px;"></span>
										        </div>
										        <div class="cardLogo" style="overflow:hidden;">

										            <a href="bonus-details/<?php echo $data['id']?>/<?php echo $data['bonusName'];?>"><img src="<?php echo $data['bonusImage'];?>" class="img-responsive" style="height:149px;" alt=""></a>

										        </div>

										        <div class="cardReview text-center text-black" style="overflow:hidden;">

										            <div class="rating padding-5 font16">
										            	<strong><?php echo $data['sportsName']; ?></strong>
										            </div>

										            <div class="code padding-5">



														<p class="text-center text-black"><span style="font-size:13px;">가입코드</span><b> : <?php echo $data['joinCode']; ?></b></p>



													</div>


										        </div>

										        <!-- <div class="bonusCode text-center">

										            <span style="font-size:12px">보너스 코드</span>
										            <br>

										            <span><b>필요없음</b></span>

										        </div> -->

										        <div class="playNow" style="margin-top: -1px;">

										            
										            <a href="#" class="btn btn-ask btn-w100" data-toggle = "modal" data-target="#exampleModal" id = "modalShow"><b>사이트 바로가기</b></a>

													<input type="hidden" class="hiddenpopup" name="popupjoincode" value="<?php echo $data['joinCode']; ?>">
													<input type="hidden" class="hiddenpopupweblink" name="popupweblink" value="<?php if(strpos($data['link'], 'http') !== false ) {echo $data['link'];} else {echo 'http://'.$data['link'];}?>">

										        </div>

										    </div><!-- front -->

											<div class="back">

												<div class="cardHeader">

				                                    <a href="bonus-details/<?php echo $data['id']?>/<?php echo $data['bonusName']?>"><h5 class="text-uppercase"><?php echo $data['bonustype']; ?></h5></a>

				                                    <span class="pull-right fa fa-close info"></span>

				                                </div>

				                                <div class="bonus-desc">

				                                	<ul class="information-list">

														<li>

															<div class="list-left">보너스 금액</div>

															<div class="list-right"><?php echo $data['bonusAmount']; ?></div>

														</li>

														<li>

															<div class="list-left">사이트</div>

															<div class="list-right"><?php echo $data['sportsName']; ?></div>

														</li>

														<li>

															<div class="list-left">롤링 조건</div>

															<div class="list-right"><?php echo $data['wageringRequirements']; ?></div>

														</li>

														<li>

															<div class="list-left">보너스 타입</div>

															<div class="list-right"><?php echo $data['bonustype']; ?></div>

														</li>

													</ul>

				                                </div>

				                                

				                                <div class="getNow">

				                                	<div class="text-center" style="position:relative;bottom:10px;">

														<a href="bonus-details/<?php echo $data['id']?>/<?php echo $data['bonusName']?>" class="readMore">자세히 보기</a>

													</div>

				                                    <a href="<?php echo $data['link']; ?>" target="_blank" class="btn btn-ask btn-w100"><b>사이트 바로가기</b></a>

				                                </div>

											</div><!-- back -->

									    </div><!-- ask-item-bonus-card -->

									</div>

								</div><!-- col-md-3 -->

								<?php

									}

								}

								?>

							</div>



							<!-- on Mobile -->

							<div class="ask-page-content-body ask-home-card onMobile">

								<?php

								//$result = $User->query("SELECT `id`, `bonusName`, `joinCode`, `bonusAmount`, `link`, `bonusCode`, `bonustype`, `wageringRequirements`, `sportsName`, `rating`, `bonusImage`, `imageName` FROM `tblBonusCards` ORDER BY `updatedOn` desc LIMIT 4");

								if(is_array($result) && count($result) > 0){

									foreach ($result as $key => $value) {				

								?>

								<div class="col-xs-12" id="formobile">

										<div class="media">

										  	<div class="media-left">
										  		<a href="bonus-details/<?php echo $value['id']?>/<?php echo $value['bonusName'];?>">
										    		<img src="<?php echo $value['bonusImage'];?>" class="media-object mobile-mdeia-object">
										    	</a>
										  	</div>

										  	<div class="media-body">

										    	<!-- <h4 class="media-heading">John Doe</h4> -->

										    	<a class="media-left-link" href="bonus-details/<?php echo $value['id']?>/<?php echo $value['bonusName']?>"><h5 class="media-heading"><?php echo $value['bonusName']?></h5></a>

												<p class="text-white" style="margin-bottom: 5px;"><b><?php echo $value['bonusAmount']; ?></b></p>

												<p class="text-green" style="margin-bottom: 5px;"><b><?php echo $value['sportsName']; ?></b></p>

												<div class="playNow">
												 	<a href="#" class="btn btn-default mobile-button" data-toggle = "modal" data-target="#exampleModal" id = "modalShow"><b>사이트 바로가기</b></a>

													<input type="hidden" class="hiddenpopup" name="popupjoincode" value="<?php echo $value['joinCode']; ?>">
													<input type="hidden" class="hiddenpopupweblink" name="popupweblink" value="<?php if(strpos($value['link'], 'http') !== false ) {echo $value['link'];} else {echo 'http://'.$value['link'];}?>">
												</div>
										  	</div>

										</div>

									</div><!--col-xs-12-->

								<?php

									}

								}

								?>	

							</div>

						</div><!-- bonus code landing-->

						<div class="ask-page-content ask-land-page-content">

							<div class="ask-page-content-header">

								<h3 class="text-uppercase">최고의 보너스 <span class="pull-right" style="font-size:12px;line-height:30px;"><a href="bonus/" class="text-white">전체보기</a></span></h3><!--  border-bottom-5 -->

								<p class="custom-text custom-p">유저 분들로부터 인기있는 최고의 보너스만을 소개합니다. </p>

							</div>

							<div class="ask-page-content-body ask-detail-page-card onDesktop">

								<?php

								$result = $User->query("SELECT `id`, `bonusName`, `joinCode`, `bonusAmount`, `link`, `bonusCode`, `bonustype`, `wageringRequirements`, `sportsName`, `rating`, `bonusImage`, `imageName`, `description` FROM `tblBonusCards` WHERE `rating` >= '3' ORDER BY `rating` desc LIMIT 3");

								if(is_array($result) && count($result) > 0){

									foreach ($result as $key => $data) {				

								?>

								<div class="col-md-3 col-sm-3 col-xs-3 padding0 ask-land-web-card">

									<div class="ask-cards">

										<div class="ask-item-web-card" style="height: 292px;">

											<div class="front">

										        <div class="cardHeader">
										            <a href="bonus-details/<?php echo $data['id']?>/<?php echo $data['bonusName'];?>"><h5><?php echo $data['bonusName']; ?></h5></a>
										            <span class="fa fa-info info" style="font-size:14px;"></span>
										        </div>
										        <div class="cardLogo" style="overflow:hidden;">

										            <a href="bonus-details/<?php echo $data['id']?>/<?php echo $data['bonusName'];?>"><img src="<?php echo $data['bonusImage'];?>" class="img-responsive" style="height:149px;" alt=""></a>

										        </div>

										        <div class="cardReview text-center text-black" style="overflow:hidden;">

										            <div class="rating padding-5 font16">
										            	<strong><?php echo $data['sportsName']; ?></strong>
										            </div>

										            <div class="code padding-5">



														<p class="text-center text-black"><span style="font-size:13px;">가입코드</span><b> : <?php echo $data['joinCode']; ?></b></p>



													</div>

										        </div>

										        <!-- <div class="bonusCode text-center">

										            <span style="font-size:12px">보너스 코드</span>
										            <br>

										            <span><b>필요없음</b></span>

										        </div> -->

										        <div class="playNow" style="margin-top: -1px;">

												 	<a href="#" class="btn btn-ask btn-w100" data-toggle = "modal" data-target="#exampleModal" id = "modalShow"><b>사이트 바로가기</b></a>

													<input type="hidden" class="hiddenpopup" name="popupjoincode" value="<?php echo $data['joinCode']; ?>">
													<input type="hidden" class="hiddenpopupweblink" name="popupweblink" value="<?php if(strpos($data['link'], 'http') !== false ) {echo $data['link'];} else {echo 'http://'.$data['link'];}?>">
												

										        </div>

										    </div><!-- front -->

											<div class="back">

												<div class="cardHeader">

				                                    <a href="bonus-details/<?php echo $data['id']?>/<?php echo $data['bonusName']?>"><h5 class="text-uppercase"><?php echo $data['bonustype']; ?></h5></a>

				                                    <span class="pull-right fa fa-close info"></span>

				                                </div>

				                                <div class="bonus-desc">

				                                	<ul class="information-list">

														<li>

															<div class="list-left">보너스 금액</div>

															<div class="list-right"><?php echo $data['bonusAmount']; ?></div>

														</li>

														<li>

															<div class="list-left">사이트</div>

															<div class="list-right"><?php echo $data['sportsName']; ?></div>

														</li>

														<li>

															<div class="list-left">롤링 조건</div>

															<div class="list-right"><?php echo $data['wageringRequirements']; ?></div>

														</li>

														<li>

															<div class="list-left">보너스 타입</div>

															<div class="list-right"><?php echo $data['bonustype']; ?></div>

														</li>

													</ul>

				                                </div>

				                                <div class="getNow">

				                                <div class="text-center" style="position:relative;bottom:10px;">

													<a href="bonus-details/<?php echo $data['id']?>/<?php echo $data['bonusName']?>" class="readMore">자세히 보기</a>

												</div>

				                                    <a href="<?php echo $data['link']; ?>" target="_blank" class="btn btn-ask btn-w100"><b>사이트 바로가기</b></a>

				                                </div>

											</div><!-- back -->

									    </div><!-- ask-item-bonus-card -->

									</div>

								</div><!-- col-md-3 -->

								<?php

									}

								}

								?>

							</div>



							<!-- on Mobile -->

							<div class="ask-page-content-body ask-home-card onMobile">

								<?php

								//$result = $User->query("SELECT `id`, `bonusName`, `joinCode`, `bonusAmount`, `link`, `bonusCode`, `bonustype`, `wageringRequirements`, `sportsName`, `rating`, `bonusImage`, `imageName` FROM `tblBonusCards` ORDER BY `updatedOn` desc LIMIT 4");

								if(is_array($result) && count($result) > 0){

									foreach ($result as $key => $value) {				

								?>

								<div class="col-xs-12" id="formobile">

										<div class="media">

										  	<div class="media-left">

										  		<a href="bonus-details/<?php echo $value['id']?>/<?php echo $value['bonusName'];?>">
										    		<img src="<?php echo $value['bonusImage'];?>" class="media-object mobile-mdeia-object">
										    	</a>

										  	</div>

										  	<div class="media-body">

										    	<!-- <h4 class="media-heading">John Doe</h4> -->

										    	<a class="media-left-link" href="bonus-details/<?php echo $value['id']?>/<?php echo $value['bonusName']?>"><h5 class="media-heading"><?php echo $value['bonusName']?></h5></a>

												<p class="text-white" style="margin-bottom: 5px;"><b><?php echo $value['bonusAmount']; ?></b></p>

												<p class="text-green" style="margin-bottom: 5px;"><b><?php echo $value['sportsName']; ?></b></p>
												<div class="playNow">
													<a href="#" class="btn btn-default mobile-button" data-toggle = "modal" data-target="#exampleModal" id = "modalShow"><b>사이트 바로가기</b></a>

													<input type="hidden" class="hiddenpopup" name="popupjoincode" value="<?php echo $value['joinCode']; ?>">
													<input type="hidden" class="hiddenpopupweblink" name="popupweblink" value="<?php if(strpos($value['link'], 'http') !== false ) {echo $value['link'];} else {echo 'http://'.$value['link'];}?>">
												</div>

										  	</div>

										</div>

									</div><!--col-xs-12-->

								<?php

									}

								}

								?>	

							</div>

						</div><!-- bonus code landing-->

					</div><!-- col-lg-9 col-md-9 -->
					<div class="col-lg-3 col-md-3 sticky_column" style="padding-left: 0px;">

						<?php require_once('includes/sportsRecommend.php'); ?>

					</div><!-- row -->

				</div>
				

			</div><!-- ask-content -->

		</div><!-- parent-container -->

<?php require_once('includes/doc_footer.php'); ?>