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



$page = "N";



function error_found(){

   //C::redirect(C::link(HOST.'404.php', false, true));

}

set_error_handler('error_found');





$reqID = array();

if(isset($_GET['detail']) && trim($_GET['detail'])){

	// $reqID = $_GET['detail'];

	// $reqID = explode("+", trim($reqID));

	// $reqName = str_replace('-', ' ', $reqID['0']);

	$getID = explode(" ", trim($_GET['detail']));

	$getName = explode("=", trim($getID['0']));

	$reqID['1'] = $getID['0'];



	if(isset($reqID['1'])){

	$result = $User->query("SELECT `id`, `title`, `newsDesc`, `author`, `newsImage`, `createdOn`, `metaTitle`, `metaKeyword`, `metaDesc` FROM `tblNewsBlog` WHERE `id` = '" . $reqID[1] . "'");

		if(isset($result) && is_array($result) && count($result) > 0){

			$_SESSION['value'] = $result;

			$reqName = $_SESSION['value'][0]['title'];

		}

	}

}

$page = '';
$metaTitle = $_SESSION['value'][0]['metaTitle'];
$metaKeyword = $_SESSION['value'][0]['metaKeyword'];
$metaDesc = $_SESSION['value'][0]['metaDesc'];


if(isset($_POST) && is_array($_POST) && count($_POST) > 0){

	

	if(!$User->checkLoginStatus()){

		$Common->redirect('index.php');

	}else{



		if($Card->addNewsComments($_POST, $reqID['1'])){

    		//C::redirect(C::link('newsDetail.php', false, true));

			Message::addMessage("Your comment will be displayed after verify by admin.", SUCCS);

    	}

    	require_once('send-commentMail.php');

	}

}





?>

<?php require_once('includes/doc_head.php'); ?>

			<!-- <div class="test">

				<div class="row content">

					<img src="images/unnamed.jpg" class="newsDetail-image" alt="">

				</div>

			</div> -->

			<div class="clearfix"></div>

			<div class="ask-content" id="ask-content">

				<div class="row">

					<div class="col-lg-9 col-md-9">

						<div class="ask-page-content">

							<div class="">

								<h3 class="heading text-white text-uppercase page-header text-yellow"><?php echo $_SESSION['value']['0']['title']; ?> </h3><!--  border-bottom-5 -->

								<p class="text-white"><em><?php echo $_SESSION['value']['0']['author']; ?></em> 작성한 날짜 

								<?php 

								$date = explode(' ', $_SESSION['value']['0']['createdOn']);

								$date = $date[0];

								$date = date_create($date);

								 $postDate = date_format($date, 'Y-m-d');

								  echo $postDate;?>

								</p>

								<img src="<?php echo $_SESSION['value']['0']['newsImage']; ?>" class="img-responsive w-100" />

							</div>

							<div class="ask-page-content-body-details" style="overflow:hidden; padding-right: 0px;">

								<div class="content newsDescSec">

									<?php echo $_SESSION['value']['0']['newsDesc']; ?>

								</div>

							</div>

						</div>

						<div class="ask-page-content ask-land-page-content">

							<div class="ask-page-content-header">

								<h3 class="text-uppercase">배팅사이트 소식</h3><!--  border-bottom-5 -->

								<p class="custom-p custom-text">새로운 이벤트, 새로운 기능, 새로운 컨텐츠.. 배팅타임에 등록된 배팅사이트들의 새로운 소식을 재빠르게 전달해드립니다.<br>이젠 배팅타임에서 모든 배팅사이트의 소식을 편하게 확인해보세요!</p>

							</div>

							<div class="ask-page-content-body ask-detail-page-card onDesktop"><!--  -->

							<?php

								$result = $User->query("SELECT `id`, `title`, `newsDesc`, `newsImage`, `createdOn` FROM `tblNewsBlog` WHERE `id` != '" . $_SESSION['value']['0']['id'] . "' AND `isNews` = 'B' ORDER BY `createdOn` desc LIMIT 3");

								if(is_array($result) && count($result) > 0){

									foreach ($result as $key => $value) {				

							?>

								<div class="col-md-3 col-sm-3 col-xs-3 padding0 ask-land-web-card">

									<div class="ask-cards">

										<div class="ask-item-news-card">

											<div class="front">

												<div class="news-logo">

													<a href="news-details/<?php echo $value['id']; ?>/<?php echo str_replace(' ', '-', $value['title']); ?>/">

														<img src="<?php echo $value['newsImage']; ?>" class="img-responsive" alt="" />

													</a>

													<span class="pull-right fa fa-info info"></span>

												</div>

												<div class="news-short-desc">

													<a href="news-details/<?php echo $value['id']; ?>/<?php echo str_replace(' ', '-', $value['title']); ?>/"><p class="text-black"><?php echo substr($value['title'], 0, 81); ?></p></a>

												</div>

												<div class="news-Date ssss">

													<?php 

													$date = explode(' ', $value['createdOn']);

													$date = $date[0];

													$date = date_create($date);

													 $postDate = date_format($date, 'Y-m-d')

													?>

													<p> <?php echo $postDate;?></p>

												</div>

											</div><!-- front -->

											<div class="back">

												<div class="news-short-desc">

													<a href="news-details/<?php echo $value['id']; ?>/<?php echo str_replace(' ', '-', $value['title']); ?>/"><p class="text-black"><b><?php echo substr($value['title'], 0, 62); ?></b></p></a>

													<span class="pull-right fa fa-close info"></span>

												</div>

												<div class="news-about">

													<p class="text-center" style="text-align: center;"><?php //echo C::contentMorewithoutlink($value['newsDesc'], 150); ?><?php echo substr($value['newsDesc'], 0, 201); 
													if(mb_strlen($value['newsDesc'], 'UTF-8') > 201){ 		
														echo '...';
													}
													?></p>

												</div>

												<div class="news-reamore">

													<div class="text-center">

														<a href="news-details/<?php echo $value['id'].'/'.str_replace(' ', '-', $value['title']).'/';?>" class="readMore">자세히 보기</a>

													</div>

												</div>

											</div><!-- back -->

										</div><!-- ask-item-news-card -->

									</div>

								</div><!-- col-md-3 -->

								<?php

								}

							}

							?>

							</div>

							

							<!-- mobile -->



							<div class="ask-page-content-body ask-home-card onMobile">

							<?php

								//$result = $User->query("SELECT `id`, `title`, `newsDesc`, `newsImage`, `updatedOn` FROM `tblNewsBlog` WHERE `isNews` = 'N' ORDER BY `updatedOn` desc LIMIT 4");

								if(is_array($result) && count($result) > 0){

									foreach ($result as $key => $value) {				

							?>

							<!-- mobile -->

								<div class="col-xs-12" id="formobile">

									<div class="clearfix"></div>

									<div class="media blog-media">

									  	<div class="media-left">

									  		<a href="news-details/<?php echo $value['id']; ?>/<?php echo str_replace(' ', '-', $value['title']); ?>/">

									    		<img src="<?php echo $value['newsImage']; ?>" class="media-object mobile-mdeia-object">

									    	</a>

									  	</div>

									  	<div class="media-body">

									    	<a class="media-left-link" href="news-details/<?php echo $value['id']; ?>/<?php echo str_replace(' ', '-', $value['title']); ?>/"><h5 class="media-heading"><?php echo $value['title']; ?></h5></a>

											

											<?php 

												$date = explode(' ', $value['createdOn']);

												$date = $date[0];

												$date = date_create($date);

											 	$postDate = date_format($date, 'm. d. Y')

											?>

											<p class="text-white"> <?php echo $postDate;?></p>

											<a href="news-details/<?php echo $value['id'].'/'.str_replace(' ', '-', $value['title']).'/';?>" class="btn btn-default blog-button"><span>자세히 보기</span></a>

									  	</div>

									</div>

								</div><!--col-xs-12-->

							<?php

								}

							}

							?>

							</div><!-- ask-page-content-body -->

						</div><!-- other news landing -->

						<div class="ask-page-content">

							<div class="ask-page-content-header">

								<h3 class="heading text-white text-uppercase">댓글 </h3><!--  border-bottom-5 -->

							</div>

							<div class="ask-page-content-body-details">

								<div class="col-lg-12 col-md-12 commentsContainer">

								<?php

								$result = $User->query("SELECT `TSC`.`id`, `TSC`.`gdComments`, `TSC`.`badComments`, `TSC`.`rating`, `TSC`.`updatedOn`, `TU`.`userId`,`TU`.`nickName` FROM `tblNewsComment` as `TSC`, `tblUser` as `TU`  WHERE `TSC`.`isRecommanded` = 'Y' AND `TSC`.`userId` = `TU`.`id` AND `TSC`.`newsId` = '" . $reqID[1] . "'");

								if(is_array($result) && count($result) > 0){

									$index = 0;

								?>

									<div class="margin-top-20 commentsFilterArea">

										<a href="" class="text-yellow m-r-10 commentsFilter" data-filter="ALL">전체보기</a>

										<a href="" class="text-yellow m-r-10 commentsFilter" data-filter="GOOD">평점 높은 댓글순</a>

										<a href="" class="text-yellow m-r-10 commentsFilter" data-filter="BAD">평점 낮은 댓글순</a>

									</div>

								<?php

									foreach ($result as $key => $value) {

										$request_id = $value['id'];

								?>

									<table class="ask-table commentFilterTbl" data-rate="<?php echo $value['rating'];?>" data-idx="<?php echo $index;?>">

										<tr>

											<td style="width:15%;" class="userIconsDisplay">

												<div class="content img-circle user-comment text-center">

													<?php $firstLt = $value['userId']; ?>

													<p class="text-uppercase" style="padding-top:10px;"><b><?php echo $firstLt[0];?></b></p>

												</div>

											</td>

											<td>

												<div class="content arrow-content">

													<h5 class="page-header comment-preview-header margin-top-0 onDesktop">

														<span class="text-yellow margin-right-5"><?php echo $value['userId']; ?></span>

														<?php $updateDate = explode(' ', $value['createdOn']);?>

														<span class="text-white">(Reviewed on <?php echo $updateDate[0]; ?>)</span>

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



											if($userid[0]['userId'] != $value['userId']){

												$User->query("UPDATE `tblCommentResponse` SET `checkUser` = 'Y' WHERE `responseId`='". $request_id ."' AND `categoryId` = '" . $reqID[1] . "' AND `isVerified`='Y' AND `category`='4'");

											}

										}

											$innrRes = $User->query("SELECT `id`, `userId`, `responseId`, `comment` FROM `tblCommentResponse` WHERE `categoryId` = '" . $reqID[1] . "' AND `responseId` = '" . $request_id . "' AND `isVerified`='Y' AND `category`='4' ORDER BY `createdOn`");

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

								<p class="text-yellow text-uppercase" style="padding-top:20px;">처음으로 댓글을 남겨보세요!</p>

								<?php

								}

								?>

									

								</div>

							</div>

						</div>

						<div class="ask-page-content">

							<div class="ask-page-content-header">

								<h3 class="heading text-white text-uppercase">댓글 등록</h3><!--  border-bottom-5 -->

							</div>

							

							<div class="ask-page-content-body-details">

								<?php 



								if((int)User::loggedInUserId() > 0)



								{



								?>

								<form action="" method="post" enctype="multipart/form-data">

									<div class="col-lg-12 col-md-12 postComment">

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

											<p class="text-white">해당 포스팅을 평가해주세요.</p>

											<div class="rating font13 text-white star-margin" style="margin-top:-7px;">

		                                        <div class="rateyo-readonly-widg" data-toggle="tooltip" title=""></div>

		                                        <div class="counter ratingCounter"></div>

		                                        <input type="hidden" name="commentRate" id="commentRate" value="" />

		                                        <input type="hidden" name="category" value="BLOG" />

		                                    </div>

		                                    <p class="text-white"><input type="checkbox" name="checkPost" required/><span style="margin-left:30px;">저의 후기는 본인 자신의 경험을 토대로 작성하였으며 진실된 의견임을 선언합니다. 저는 해당 사이트 직원이 아니며, 해당 리뷰로 인해 사이트로부터 인센티브 혹은 어떠한 보너스도 받지 않았습니다. 배팅타임에서는 거짓된 리뷰에 대해 엄격한 조치를 취할 것입니다. </span></p>

		                                    <div style="margin-top:20px;margin-bottom:10px;">

		                                    	<button type="submit" class="btn btn-ask-red" style="margin:0px 20px 0px 0px;">작성하기</button>

												<a href="" class="text-yellow">댓글 가이드라인 확인하기</a>

	                                    	</div>

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

					</div><!-- col-lg-9 col-md-9 -->

					<div class="col-lg-3 col-md-3" style="padding-left: 0px;">

						<?php require_once('includes/sportsRecommend.php'); ?>

					</div>

				</div><!-- row -->

			</div><!-- ask-content -->

		</div><!-- parent-container -->

<?php require_once('includes/doc_footer.php'); ?>