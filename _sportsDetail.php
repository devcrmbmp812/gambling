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


if(isset($_GET['detail']) && trim($_GET['detail'])){
	$reqID = base64_decode($_GET['detail']);
	$reqID = explode("+", trim($reqID));
	$reqName = str_replace('-', ' ', $reqID['0']);
	$result = $User->query("SELECT * FROM `tblWebCards` WHERE `id` = '" . $reqID[1] . "'");
	if(isset($result) && is_array($result) && count($result) > 0){
		$_SESSION['value'] = $result;
	}
}

if(isset($_POST) && is_array($_POST) && count($_POST) > 0){
	if(!$User->checkLoginStatus()){
		$Common->redirect('index.php');
	}else{
		if($Card->addSportsComments($_POST, $reqID['1'])){
    		C::redirect(C::link('sportsDetail.php', false, true));
    	}
	}
}
?>
<?php require_once('includes/doc_head.php'); ?>
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" id="image-bg">
				<div class="details-page">
					<div class="image-label">
						<p class="custom-text-rotate">
							<span style="font-size:12px;">Join Code</span>
							<span style="font-size:20px;"><?php echo $_SESSION['value'][0]['joinCode']; ?></span>
						</p>
					</div>
					<table class="ask-top-table">
						<tr>
							<td>
								<div class="details-page-name-sports">
									<span class="font30"><?php echo $_SESSION['value']['0']['sportsName']; ?></span><br>
									<div class="rating padding3 font15 star-margin" style="margin-bottom:-25px;">
										<div class="rateyo-readonly" data-toggle="tooltip" style="margin-left:25px;"></div>
										<div class="counter-top">4</div>
									</div>
									<div class="font15" style="margin:3px 0px -25px 160px;">2 player reviews</div><br>
									<span class="font15"><?php echo $_SESSION['value']['0']['description']; ?></span>
								</div>
							</td>
							<td>
								<div class="details-page-joinCode">
									<span>Join Code</span><br>
									<span><?php echo $_SESSION['value']['0']['joinCode']; ?></span>
								</div>
								<div class="details-page-logo">
									<img src="<?php echo $_SESSION['value']['0']['sportsImage']; ?>" alt="Sports Logo"  style="border:4px solid #ccc;" />
								</div>
							</td>
						</tr>
					</table>
					<table class="ask-table">
						<h5 class="text-white margin-top-20">Sports Info</h5>
						<tr>
							<th class="text-yellow font18"><?php echo $_SESSION['value']['0']['welcomeBonus']; ?></th>
							<th class="text-yellow font18"><?php echo $_SESSION['value']['0']['maxPrizeMoney']; ?></th>
							<th class="text-yellow font18"><?php echo $_SESSION['value']['0']['singleBet']; ?></th>
							<th class="text-yellow font18"><?php echo $_SESSION['value']['0']['crossBetting']; ?></th>
							<th class="text-yellow font18"><?php echo $_SESSION['value']['0']['miniGame']; ?></th>
						</tr>
						<tr>
							<td class="padding-top-0">Welcome Bonus</td>
							<td class="padding-top-0">Max Prize Money</td>
							<td class="padding-top-0">Single Bet</td>
							<td class="padding-top-0">Cross Betting</td>
							<td class="padding-top-0">Mini Game</td>
						</tr>
					</table>
					<!-- <div class="row margin-top-30"></div> -->
				</div>
				<div class="col-sm-12 content-button">
					<div class="col-sm-4">
						<a href="http://<?php echo $_SESSION['value']['0']['link']; ?>" class="btn btn-ask-red btn-w100 text-capitalize padding10 font15"><b><i class="fa fa-reply-all margin-right-5" aria-hidden="true"></i> Play Now</b></a>
					</div>
					<div class="col-sm-4">
						<a href="#writeReview" class="btn btn-ask-green btn-w100 text-capitalize padding10 font15"><b><i class="fa fa-pencil margin-right-5" aria-hidden="true"></i> write review</b></a>
					</div>
					<div class="col-sm-4">
						<a href="submitComplaint.php" class="btn btn-ask-grd-blue btn-w100 text-capitalize padding10 font15"><b><i class="fa fa-gavel margin-right-5" aria-hidden="true"></i> file complain</b></a>
					</div>
				</div>
				<div class="content row fixed-top">
					<div class="col-sm-8 margin-top-10">
						<span class="font15 text-white text-uppercase"><b><?php echo $_SESSION['value']['0']['sportsName']; ?></b></span>
					</div>
					<div class="col-sm-4">
						<a href="http://<?php echo $value['0']['link']; ?>" class="btn btn-ask-red btn-w100 text-capitalize padding10 font15"><b><i class="fa fa-reply-all margin-right-5" aria-hidden="true"></i> Play Now</b></a>
					</div>
				</div>
			</div>
			<div class="clearfix"></div>
			<div class="ask-content" id="ask-content">
				<div class="row">
					<div class="col-lg-9 col-md-9" id="show-pop-up">
						<div class="ask-page-content">
							<div class="ask-page-content-header">
								<h3 class="heading text-white text-uppercase">Sports Review </h3><!--  border-bottom-5 -->
							</div>
							<div class="ask-page-content-body-details">
								<div class="content" id="content-read-more">
									<p class="text-white">Get Lucky Casino is an instant-play online casino featuring top slot games and casino specialties for players around the world. The site offers a wide range of NetEnt, Microgaming, Playtech, Play’n GO, and Betsoft slots and casino games, along with a live casino powered by the Evolution Gaming studios. Many of these games are accessible on both desktop and mobile devices. Get Lucky Casino is governed under the laws of Malta and Curacao.</p>
									<div style="width:300px;height:200px;overflow:hidden;">
										<!-- <img src="images/bonus2.jpg" class="example-image-link" alt=""> -->
										<a class="example-image-link" href="images/site.png" data-lightbox="example-1"><img class="example-image img-responsive" src="images/site.png" alt="image name" /></a>
									</div>
									<h5 class="text-yellow">Pros</h5>
									<ol class="text-white">
										<li></li>
										<li></li>
										<li></li>
										<li></li>
									</ol>
									<h5 class="text-yellow">Cons</h5>
									<ol class="text-white">
										<li></li>
										<li></li>
										<li></li>
										<li></li>
									</ol>
								</div>
							</div>
						</div>
						<div class="ask-page-content ask-land-page-content">
							<div class="ask-page-content-header">
								<h3 class="text-uppercase">Bonus Codes </h3><!--  border-bottom-5 -->
								<p class="custom-text">Here's a list of bonus codes related to this sports </p>
							</div>
							<div class="ask-page-content-body">
							<?php
								$res = $User->query("SELECT * FROM `tblBonusCards` WHERE `sportsName` = '$reqName' LIMIT 3");
									if(isset($res) && is_array($res) && count($res) > 0){
										foreach ($res as $id => $data) {
							?>
								<div class="col-md-3 col-sm-3 col-xs-3 padding0 ask-land-web-card">
									<div class="ask-cards">
										<div class="ask-item-bonus-card">
											<div class="front">
												<div class="cardHeader">
				                                    <a href="<?php echo C::link('bonusDetail.php', array('name' => str_replace(' ', '-', $data['bonusName']),'id' =>$data['id'] ), true);?>"><h5><?php echo $data['bonustype']; ?></h5></a>
													<span class="fa fa-info info" style="font-size:10px;"></span>
				                                </div>
				                                <div class="cardLogo" style="overflow:hidden;">
				                                    <a href="<?php echo C::link('bonusDetail.php', array('name' => str_replace(' ', '-', $data['bonusName']),'id' =>$data['id'] ), true);?>"><img src="<?php echo $data['bonusImage'];?>" class="img-responsive" style="height:87px;"  alt=""></a>
				                                    <div class="cardReview text-center text-black">
				                                    	<span class="bonus-name text-center text-uppercase <?php if(strlen($data['bonusName']) > 9){ echo "font12";}?>"><?php echo $data['bonusName'];?></span>
					                                    <div class="rating padding3 font13 color" style="margin-top: 0px; margin-left: 2px;">
					                                        <?php 
				                                    		if ($data['rating'] == 1) {
			                                    			?>
			                                    			<i class="fa fa-star first" aria-hidden="true"></i><i class="fa fa-star-o" aria-hidden="true"></i></i><i class="fa fa-star-o" aria-hidden="true"></i></i><i class="fa fa-star-o" aria-hidden="true"></i></i><i class="fa fa-star-o" aria-hidden="true"></i></i>
			                                    			<?php
					                                    		} else if($data['rating'] == 2){
			                                    			?>
			                                    			<i class="fa fa-star second" aria-hidden="true"></i><i class="fa fa-star second" aria-hidden="true"></i><i class="fa fa-star-o" aria-hidden="true"></i></i><i class="fa fa-star-o" aria-hidden="true"></i></i><i class="fa fa-star-o" aria-hidden="true"></i></i>
			                                    			<?php
					                                    		} else if($data['rating'] == 3){
			                                    			?>
			                                    			<i class="fa fa-star third" aria-hidden="true"></i><i class="fa fa-star third" aria-hidden="true"></i><i class="fa fa-star third" aria-hidden="true"></i><i class="fa fa-star-o" aria-hidden="true"></i></i><i class="fa fa-star-o" aria-hidden="true"></i></i>
			                                    			<?php
					                                    		} else if($data['rating'] == 4){
			                                    			?>
			                                    			<i class="fa fa-star four" aria-hidden="true"></i><i class="fa fa-star four" aria-hidden="true"></i><i class="fa fa-star four" aria-hidden="true"></i><i class="fa fa-star four" aria-hidden="true"></i><i class="fa fa-star-o" aria-hidden="true"></i></i>
			                                    			<?php
					                                    		} else if($data['rating'] == 5){
			                                    			?>
															<i class="fa fa-star five" aria-hidden="true"></i><i class="fa fa-star five" aria-hidden="true"></i><i class="fa fa-star five" aria-hidden="true"></i><i class="fa fa-star five" aria-hidden="true"></i><i class="fa fa-star five" aria-hidden="true"></i>
			                                    			<?php
					                                    		}
					                                    	?>
					                                    </div>
					                                    <div class="ask-code">
				                                        	<p class="custom-border1">JOIN CODE</p> <br>
				                                        	<span class="custom-border"><?php echo $data['joinCode']; ?></span>
					                                    </div>
					                                </div>
				                                </div>
				                                <div class="mainView" style="overflow:hidden;">
			                                        <div class="bonus">
			                                            <div class="bonusAmount">
			                                                <span class="text-center"><?php echo $data['bonusAmount']; ?></span>
			                                            </div>
			                                            <div class="bonusType">
			                                                <span class="text-center"><?php echo $data['bonusName'];?></span>
			                                            </div>
			                                        </div>
			                                    </div>
			                                    <div class="bonusCode text-center">
			                                        <span style="font-size:12px">BONUS CODE</span><br>
			                                        <span><b><?php echo $data['bonusCode']; ?></b></span>
			                                    </div>
				                                <div class="playNow custom-play-now">
													<a href="<?php echo $data['link'];?>" class="btn btn-ask btn-w100"><b>GET NOW</b></a>
												</div>
											</div><!-- front -->
											<div class="back">
												<div class="cardHeader">
				                                    <a href="<?php echo C::link('bonusDetail.php', array('name' => str_replace(' ', '-', $data['bonusName']),'id' =>$data['id'] ), true);?>"><h5 class="text-uppercase"><?php echo $data['bonustype']; ?></h5></a>
				                                    <span class="pull-right fa fa-close info"></span>
				                                </div>
				                                <div class="bonus-desc">
				                                	<ul class="information-list">
														<li>
															<div class="list-left">Bonus</div>
															<div class="list-right"><?php echo $data['bonusAmount']; ?></div>
														</li>
														<li>
															<div class="list-left">Sports</div>
															<div class="list-right"><?php echo $data['sportsName']; ?></div>
														</li>
														<li>
															<div class="list-left">W.R</div>
															<div class="list-right"><?php echo $data['wageringRequirements']; ?></div>
														</li>
														<li>
															<div class="list-left">Type</div>
															<div class="list-right"><?php echo $data['bonustype']; ?></div>
														</li>
													</ul>
				                                </div>
				                                <div class="text-center">
													<a href="<?php echo C::link('bonusDetail.php', array('name' => str_replace(' ', '-', $data['bonusName']),'id' =>$data['id'] ), true);?>" class="readMore">Read More</a>
												</div>
				                                <div class="getNow">
				                                    <a href="<?php echo $data['link'];?>" class="btn btn-ask btn-w100">GET NOW</a>
				                                </div>
											</div><!-- back -->
									    </div><!-- ask-item-bonus-card -->
									</div>
								</div><!-- col-md-3 -->
								<?php
									}
								} else {
								?>
								<p class="text-yellow">THIS SPORTS HAVE ONLY ONE BONUS AVAILABLE</p>
								<?php
									}
								?>
							</div>
						</div><!-- bonus code landing-->
						<div class="ask-page-content ask-land-page-content">
							<div class="ask-page-content-header">
								<h3 class="text-uppercase">Sport Complaints <span class="pull-right" style="font-size:12px;line-height:30px;"><a href="complaint.php" class="text-white">View more</a></span></h3><!--  border-bottom-5 -->
								<p class="custom-text">Have troubles with Sports? <a href="submitComplaint.php">Submit a complaint</a> or <a href="">Learn more</a> .  </p>
							</div>
							<div class="ask-page-content-body">
							<?php
								$siteName = $_SESSION['value']['0']['link'] .'/'. $_SESSION['value']['0']['siteName'];
								$result = $User->query("SELECT `id`, `reason`, `complaintTitle`, `complaintText`, `amount`, `isVerified`, `status` FROM `tblComplaints` WHERE `isVerified` = 'Y' AND `siteName` = '" . $siteName . "'  ORDER BY `updatedOn` desc LIMIT 3");
								if(is_array($result) && count($result) > 0){
									foreach ($result as $key => $value) {				
								?>
								<div class="col-md-3 col-sm-3 col-xs-3 padding0  ask-land-web-card">
									<div class="ask-cards">
										<div class="ask-item-complain-card">
											<div class="front">
												<a href="<?php echo C::link('complaintsDetail.php', array('detail' => $value['id']), true);?>">
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
														<p class="text-center text-capitalize text-pending pt5"><b>Pending</b></p>
													<?php
														}else if($value['status'] == 'S'){
													?>
														<p class="text-center text-capitalize text-sucess pt5"><b>solved</b></p>
													<?php
														}else if($value['status'] == 'U'){
													?>
														<p class="text-center text-capitalize text-reject pt5"><b>unsolved</b></p>
													<?php } ?>
												<div class="complain-short-desc" style="padding-top: 0px;">
													<p><?php echo $value['complaintTitle']; ?></p>
												</div>
												<div class="complain-Date" style="padding-top: 2px;">
													<p> <span style="font-size:24px;font-weight:900;">&pound; <?php echo $value['amount']; ?></span><br>
														<?php echo $value['reason']; ?> </p>
												</div>
											</div><!-- front -->
											<div class="back">
												<div class="complain-short-desc">
													<p><?php echo $value['complaintTitle']; ?></p>
													<span class="pull-right fa fa-close info"></span>
												</div>
												<div class="complain-about">
													<p><?php echo $value['complaintText']; ?></p>
													<div class="text-center">
														<a href="<?php echo C::link('complaintsDetail.php', array('detail' => $value['id']), true);?>" class="readMore">Read More</a>
													</div>
												</div>
											</div><!-- back -->
										</div><!-- ask-item-complain-card -->
									</div>
								</div><!-- col-md-3 -->
								<?php
								 }
							}
							?>
							</div>
						</div><!-- bonus code landing-->
						<div class="ask-page-content">
							<div class="ask-page-content-header">
								<h3 class="heading text-white text-uppercase">Sports Details </h3><!--  border-bottom-5 -->
							</div>
							<div class="ask-page-content-body-details"> 
								<div class="row content">
									<table class="ask-table text-bold custom-table-padding">
									<?php
									$result = $User->query("SELECT * FROM `tblWebCards` WHERE `id` = $reqID[1]");
										if(isset($result) && is_array($result) && count($result) > 0){
											$value = $result;
									?>
										<tr>
											<td style="width:30%;"> Sports Name :</td>
											<td><a href=""><?php echo $value['0']['sportsName']; ?></a></td>
										</tr>
										<tr>
											<td> Join Code :</td>
											<td><a href=""><?php echo $value['0']['joinCode']; ?></a></td>
										</tr>
										<tr>
											<td> Official Website :</td>
											<td><a href=""><?php echo $value['0']['link']; ?></a></td>
										</tr>
										<tr>
											<td>Welcome Bonus :</td>
											<td><a href=""><?php echo $value['0']['welcomeBonus']; ?></a></td>
										</tr>
										<tr>
											<td>Cross Betting :</td>
											<td><a href=""><?php echo $value['0']['crossBetting']; ?></a></td>
										</tr>
										<?php
											$res = $value[0]['sportsOtherDetails'];
											$res = explode('+', $value[0]['sportsOtherDetails']);
											$label = json_decode($res['0']);
											$datas = json_decode($res['1']);
											foreach ($label as $index => $val) {
										?>
										<tr>
											<td> <?php echo $val; ?> :</td>
											<td><a href=""> <?php echo $datas[$index]; ?> </a></td>
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
								<h3 class="heading text-white text-uppercase">Players Comments </h3><!--  border-bottom-5 -->
							</div>
							<div class="ask-page-content-body-details">
								<div class="col-lg-12 col-md-12">
								<?php
								$result = $User->query("SELECT `TSC`.`gdComments`, `TSC`.`badComments`, `TSC`.`rating`, `TSC`.`updatedOn`, `TU`.`userId` FROM `tblSportsComment` as `TSC`, `tblUser` as `TU`  WHERE `TSC`.`isRecommanded` = 'Y' AND `TSC`.`userId` = `TU`.`id` AND `TSC`.`sportsId` = '" . $reqID[1] . "'");
								if(is_array($result) && count($result) > 0){
									foreach ($result as $key => $value) {				
								?>
									<table class="ask-table">
										<tr>
											<td style="width:15%;">
												<div class="content img-circle user-comment text-center">
													<?php $firstLt = $value['userId']; ?>
													<p class="text-uppercase" style="padding-top:10px;"><b><?php echo $firstLt[0];?></b></p>
												</div>
											</td>
											<td>
												<div class="content arrow-content">
													<h5 class="page-header comment-preview-header margin-top-0">
														<span class="text-yellow margin-right-5"><?php echo $value['userId']; ?></span>
														<span class="text-white">(Reviewed on <?php echo $value['updatedOn']; ?>)</span>
														<span class="rating padding3 font13 pull-right cmntRate">
					                                        <?php 
				                                    		if ($value['rating'] == 1) {
			                                    			?>
			                                    			<i class="fa fa-star first" aria-hidden="true"></i><i class="fa fa-star-o" aria-hidden="true"></i></i><i class="fa fa-star-o" aria-hidden="true"></i></i><i class="fa fa-star-o" aria-hidden="true"></i></i><i class="fa fa-star-o" aria-hidden="true"></i></i>
			                                    			<?php
					                                    		} else if($value['rating'] == 2){
			                                    			?>
			                                    			<i class="fa fa-star second" aria-hidden="true"></i><i class="fa fa-star second" aria-hidden="true"></i><i class="fa fa-star-o" aria-hidden="true"></i></i><i class="fa fa-star-o" aria-hidden="true"></i></i><i class="fa fa-star-o" aria-hidden="true"></i></i>
			                                    			<?php
					                                    		} else if($value['rating'] == 3){
			                                    			?>
			                                    			<i class="fa fa-star text-white" aria-hidden="true"></i><i class="fa fa-star text-white" aria-hidden="true"></i><i class="fa fa-star text-white" aria-hidden="true"></i><i class="fa fa-star-o" aria-hidden="true"></i></i><i class="fa fa-star-o" aria-hidden="true"></i></i>
			                                    			<?php
					                                    		} else if($value['rating'] == 4){
			                                    			?>
			                                    			<i class="fa fa-star four" aria-hidden="true"></i><i class="fa fa-star four" aria-hidden="true"></i><i class="fa fa-star four" aria-hidden="true"></i><i class="fa fa-star four" aria-hidden="true"></i><i class="fa fa-star-o" aria-hidden="true"></i></i>
			                                    			<?php
					                                    		} else if($value['rating'] == 5){
			                                    			?>
															<i class="fa fa-star five" aria-hidden="true"></i><i class="fa fa-star five" aria-hidden="true"></i><i class="fa fa-star five" aria-hidden="true"></i><i class="fa fa-star five" aria-hidden="true"></i><i class="fa fa-star five" aria-hidden="true"></i>
			                                    			<?php
					                                    		}
					                                    	?>
					                                    </span>
													</h5>
													<div class="comment-show">
														<table class="ask-table">
															<tr>
																<td style="width:10%;padding-left:20px;padding-bottom:10px;">
																	<i class="fa fa-thumbs-up text-green" aria-hidden="true"></i>
																</td>
																<td style="padding-bottom:10px;">
																	<span><?php echo $value['gdComments']; ?></span>
																</td>
															</tr>
															<tr>
																<td style="width:10%;padding-left:20px;padding-bottom:10px;">
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
									</table>
								<?php
									}
								}else{
								?>
								<p class="text-yellow text-uppercase" style="padding-top:20px;">BE the first one to comment here....</p>
								<?php
								}
								?>
									
								</div>
							</div>
						</div>
						<div class="ask-page-content" id="writeReview">
							<div class="ask-page-content-header">
								<h3 class="heading text-white text-uppercase">Add Comments </h3><!--  border-bottom-5 -->
							</div>
							<div class="ask-page-content-body-details">
								<form action="" method="post" enctype="multipart/form-data">
									<div class="col-lg-12 col-md-12">
										<table class="ask-table" style="margin-bottom:-35px;">
											<tr>
												<td style="width:15%;">
													<div class="content img-circle user-comment text-center">
														<i class="fa fa-thumbs-up margin-top-15 text-green" aria-hidden="true"></i>
													</div>
												</td>
												<td>
													<div class="content arrow-content">
														<textarea name="likeComment" id="" cols="" rows="3" placeholder="what do you like"></textarea>
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
													<div class="content arrow-content">
														<textarea name="dislikeComment" id="" cols="" rows="3" placeholder="what do you dislike"></textarea>
													</div>			
												</td>
											</tr>
										</table>
										<div class="col-md-10 col-md-offset-2">
											<p class="text-white">Rate this Sport: 150% up to £/€ 200</p>
											<div class="rating font13 text-white star-margin" style="margin-top:-7px;">
		                                        <div class="rateyo-readonly-widg" data-toggle="tooltip" title=""></div>
		                                        <div class="counter"></div>
		                                        <input type="hidden" name="commentRate" value="" />
		                                    </div>
		                                    <p class="text-white"><input type="checkbox" name="checkPost" /><span style="margin-left:30px;">I declare that my review is based on my own experience and represents my genuine opinion of this casino. I'm not a casino employee and have not been offered any incentive or payment by the casino to write this review. I understand that AskGamblers has zero-tolerance policy on fake reviews. </span></p>
		                                    <div style="margin-top:20px;margin-bottom:10px;">
		                                    	<button type="submit" class="btn btn-ask-red" style="margin-left:0px;margin-top:0px;">Post Comment</button><a href="" class="text-yellow">View Posting Guidelines</a>
	                                    	</div>
										</div>
									</div>
								</form>
							</div>
						</div>
						<div class="ask-page-content ask-land-page-content">
							<div class="ask-page-content-header">
								<h3 class="text-uppercase">News</h3><!--  border-bottom-5 -->
								<p class="custom-text">Here's a list of casino bonuses and promotions that is updated daily with the latest coupon code,no deposite bonuses, free spin, cash back welcome offers, match deposite bonuses, high roller bonuses and many more.. </p>
							</div>
							<div class="ask-page-content-body"><!--  -->
								<?php
								$result = $User->query("SELECT `id`, `title`, `newsDesc`, `newsImage`, `updatedOn` FROM `tblNewsBlog` WHERE `isNews` = 'N' LIMIT 3");
								if(is_array($result) && count($result) > 0){
									foreach ($result as $key => $value) {				
							?>
								<div class="col-md-3 col-sm-3 col-xs-3 padding0 ask-land-web-card">
									<div class="ask-cards">
										<div class="ask-item-news-card">
											<div class="front">
												<div class="news-logo">
													<a href="<?php echo C::link('newsDetail.php', array('detail' => base64_encode(str_replace(' ', '-', $value['title']) . '+' . $value['id'] )), true);?>">
														<img src="<?php echo $value['newsImage']; ?>" class="img-responsive" alt="" />
													</a>
													<span class="pull-right fa fa-info info"></span>
												</div>
												<div class="news-short-desc">
													<a href="<?php echo C::link('newsDetail.php', array('detail' => base64_encode(str_replace(' ', '-', $value['title']) . '+' . $value['id'] )), true);?>"><p class="text-black"><?php echo $value['title']; ?></p></a>
												</div>
												<div class="news-Date">
													<p> April 12, 2016</p>
												</div>
											</div><!-- front -->
											<div class="back">
												<div class="news-short-desc">
													<a href="<?php echo C::link('newsDetail.php', array('detail' => base64_encode(str_replace(' ', '-', $value['title']) . '+' . $value['id'] )), true);?>"><p class="text-black"><b><?php echo $value['title']; ?></b></p></a>
													<span class="pull-right fa fa-close info"></span>
												</div>
												<div class="news-about">
													<p><?php echo $value['newsDesc']; ?></p>
													<div class="text-center">
														<a href="<?php echo C::link('newsDetail.php', array('detail' => base64_encode(str_replace(' ', '-', $value['title']) . '+' . $value['id'] )), true);?>" class="readMore">Read More</a>
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
						</div><!-- verified sports landing -->
					</div><!-- col-lg-9 col-md-9 -->
					<div class="col-lg-3 col-md-3" style="padding-left: 0px;">
						<?php require_once('includes/sportsRecommend.php'); ?>
					</div>
				</div><!-- row -->
			</div><!-- ask-content -->
		</div><!-- parent-container -->
<?php require_once('includes/doc_footer.php'); ?>