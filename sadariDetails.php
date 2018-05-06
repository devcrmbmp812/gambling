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


function error_found(){
   C::redirect(C::link(HOST.'404.php', false, true));
}
set_error_handler('error_found');

$reqID = array();
if(isset($_GET['detail']) && trim($_GET['detail'])){
	$getID = explode(" ", trim($_GET['detail']));
	$getName = explode("=", trim($getID['1']));
	$reqID['1'] = $getID['0'];
	$result = $User->query("SELECT * FROM `tblSadariCards` WHERE `id` = '" . $reqID[1] . "'");
	if(isset($result) && is_array($result) && count($result) > 0){
		$_SESSION['value'] = $result;
		$reqName = $_SESSION['value'][0]['sportsName'];
	}
}

if(isset($_POST) && is_array($_POST) && count($_POST) > 0 && isset($_POST['_COMMENT_CAT']) && $_POST['_COMMENT_CAT'] == 'SADARI_COMMENT' ){
	if(!$User->checkLoginStatus()){
		Message::addMessage("You are not logged in. Please login here to post your comment", ERR);
	}else{
		if($Card->addSadariSportsComments($_POST, $reqID['1'])){
			Message::addMessage("Your comment will be displayed after verify by admin.", SUCCS);
    	}
		require_once('send-commentMail.php');
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
											<!-- <div class="rateyo-readonly" data-toggle="tooltip" style="margin-left:25px;"></div> -->
											<div class="rating padding3 font15 color" style="margin-top: 0px; margin-left: 25px;margin-top:-5px;">
		                                        <?php 
	                                    		if ($_SESSION['value']['0']['rating'] == 1) {
                                    			?>
                                    			<i class="fa fa-star text-rate" aria-hidden="true"></i><i class="fa fa-star-o" aria-hidden="true"></i></i><i class="fa fa-star-o" aria-hidden="true"></i></i><i class="fa fa-star-o" aria-hidden="true"></i></i><i class="fa fa-star-o" aria-hidden="true"></i></i>
                                    			<?php
		                                    		} else if($_SESSION['value']['0']['rating'] == 2){
                                    			?>
                                    			<i class="fa fa-star text-rate" aria-hidden="true"></i><i class="fa fa-star text-rate" aria-hidden="true"></i><i class="fa fa-star-o" aria-hidden="true"></i></i><i class="fa fa-star-o" aria-hidden="true"></i></i><i class="fa fa-star-o" aria-hidden="true"></i></i>
                                    			<?php
		                                    		} else if($_SESSION['value']['0']['rating'] == 3){
                                    			?>
                                    			<i class="fa fa-star text-rate" aria-hidden="true"></i><i class="fa fa-star text-rate" aria-hidden="true"></i><i class="fa fa-star text-rate" aria-hidden="true"></i><i class="fa fa-star-o" aria-hidden="true"></i></i><i class="fa fa-star-o" aria-hidden="true"></i></i>
                                    			<?php
		                                    		} else if($_SESSION['value']['0']['rating'] == 4){
                                    			?>
                                    			<i class="fa fa-star text-rate" aria-hidden="true"></i><i class="fa fa-star text-rate" aria-hidden="true"></i><i class="fa fa-star text-rate" aria-hidden="true"></i><i class="fa fa-star text-rate" aria-hidden="true"></i><i class="fa fa-star-o" aria-hidden="true"></i></i>
                                    			<?php
		                                    		} else if($_SESSION['value']['0']['rating'] == 5){
                                    			?>
												<i class="fa fa-star text-rate" aria-hidden="true"></i><i class="fa fa-star text-rate" aria-hidden="true"></i><i class="fa fa-star text-rate" aria-hidden="true"></i><i class="fa fa-star text-rate" aria-hidden="true"></i><i class="fa fa-star text-rate" aria-hidden="true"></i>
                                    			<?php
		                                    		}
		                                    	?>
		                                    </div>
											<div class="counter-top"><?php echo $_SESSION['value']['0']['rating']; ?></div>
										</div>
										<?php $reviewCount = $User->query("SELECT COUNT(`id`) AS countReview FROM `tblSadariSportsComment` WHERE `sportsId`='".$_SESSION['value'][0]['id']."' AND `isRecommanded`='Y'");?>
									<div class="font15" style="margin:3px 0px -25px 160px;"><?php echo $reviewCount[0]['countReview'];?> player reviews</div><br>
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
							<th class="text-yellow font18"><?php echo $_SESSION['value']['0']['sadariOdd']; ?></th>
							<th class="text-yellow font18 text-center"><?php echo $_SESSION['value']['0']['wager']; ?></th>
							<th class="text-yellow font18 text-center"><?php echo $_SESSION['value']['0']['maximumBetting']; ?>원</th>
							<th class="text-yellow font18 text-center"><?php echo $_SESSION['value']['0']['ruMatin']; ?></th>
							<th class="text-yellow font18 text-center"><?php echo $_SESSION['value']['0']['closingTime']; ?> sec</th>
						</tr>
						<tr>
							<td class="padding-top-0">Sadari Odd</td>
							<td class="padding-top-0 text-center">Wager</td>
							<td class="padding-top-0 text-center">Maximum Betting</td>
							<td class="padding-top-0 text-center">Rutin/Matin</td>
							<td class="padding-top-0 text-center">Closing time</td>
						</tr>
					</table>
					<!-- <div class="row margin-top-30"></div> -->
				</div>
				<div class="col-sm-12 content-button">
					<div class="col-sm-4">
						<a href="http://<?php echo $_SESSION['value']['0']['link']; ?>" class="btn btn-ask-red btn-w100 text-capitalize padding10 font15"><b><i class="fa fa-reply-all margin-right-5" aria-hidden="true"></i> Play Now</b></a>
					</div>
					<div class="col-sm-4">
						<a href="<?php echo $_SERVER['REQUEST_URI'];?>#writeReview" class="btn btn-ask-green btn-w100 text-capitalize padding10 font15"><b><i class="fa fa-pencil margin-right-5" aria-hidden="true"></i> write review</b></a>
					</div>
					<div class="col-sm-4">
						<a href="submitComplaint.php" class="btn btn-ask-grd-blue btn-w100 text-capitalize padding10 font15"><b><i class="fa fa-gavel margin-right-5" aria-hidden="true"></i> file complain</b></a>
					</div>
				</div>
				<div class="content row fixed-top">
					<div class="col-sm-8 margin-top-10">
						<span class="font15 text-white text-uppercase"><b><?php echo $_SESSION['value']['0']['sportsName']; ?></b></span>
						<span class="font15 text-white text-uppercase"><b> &nbsp;&nbsp;/&nbsp;&nbsp; 가입코드 : <?php echo $_SESSION['value']['0']['joinCode']; ?></b></span>
					</div>
					<div class="col-sm-4">
						<a href="http://<?php echo $_SESSION['value']['0']['link']; ?>" class="btn btn-ask-red btn-w100 text-capitalize padding10 font15"><b><i class="fa fa-reply-all margin-right-5" aria-hidden="true"></i> Play Now</b></a>
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
								<div class="content text-white" id="content-read-more">
									<?php echo $_SESSION['value']['0']['sportsReview']; ?>
								</div>
							</div>
						</div>
						<div class="ask-page-content ask-land-page-content">
							<div class="ask-page-content-header">
								<h3 class="text-uppercase">Bonus Codes </h3><!--  border-bottom-5 -->
								<p class="custom-text custom-p">Here's a list of bonus codes related to this sports </p>
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
				                                    <a href="bonus-details/<?php echo $data['id']?>/<?php echo $data['bonusName']?>"><h5><?php echo $data['bonustype']; ?></h5></a>
													<span class="fa fa-info info" style="font-size:10px;"></span>
				                                </div>
				                                <div class="cardLogo" style="overflow:hidden;">
				                                    <a href="bonus-details/<?php echo $data['id']?>/<?php echo $data['bonusName']?>"><img src="<?php echo $data['bonusImage'];?>" class="img-responsive" style="height:87px;"  alt=""></a>
				                                    <div class="cardReview text-center text-black">
				                                    	<span class="bonus-name text-center text-uppercase <?php if(strlen($data['sportsName']) > 9){ echo "font12";}?>"><?php echo $data['sportsName'];?></span>
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
				                                    <a href="bonus-details/<?php echo $data['id']?>/<?php echo $data['bonusName']?>"><h5 class="text-uppercase"><?php echo $data['bonustype']; ?></h5></a>
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
													<a href="bonus-details/<?php echo $data['id']?>/<?php echo $data['bonusName']?>" class="readMore">Read More</a>
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
								<p class="custom-text custom-p">Have troubles with Sports? <a href="submit-complaint/">Submit a complaint</a> or <a href="">Learn more</a> .  </p>
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
													<p> <span style="font-size:24px;font-weight:900;"><?php echo $value['amount']; ?> 만원</span><br>
														<?php echo $value['reason']; ?> </p>
												</div>
											</div><!-- front -->
											<div class="back">
												<div class="complain-short-desc">
													<p><?php echo $value['complaintTitle']; ?></p>
													<span class="pull-right fa fa-close info"></span>
												</div>
												<div class="complain-about">
													<p class="text-justify"><?php echo C::contentMorewithoutlink($value['complaintText'], 200); ?></p>
													<div class="text-center">
														<a href="complaint-details/<?php echo $value['id'];?>/" class="readMore">Read More</a>
													</div>
												</div>
											</div><!-- back -->
										</div><!-- ask-item-complain-card -->
									</div>
								</div><!-- col-md-3 -->
								<?php
								 }
							} else {
								?>
								<p class="text-yellow">THIS SPORTS HAS NO COMPLAINTS</p>
								<?php
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
										<tr>
											<td> Join Code :</td>
											<td><a href="javascript:void(0)" class="btn btn-ask-white"><?php echo $_SESSION['value'][0]['joinCode']; ?></a></td>
										</tr>
										<tr>
											<td style="width:30%;"> Sports Name :</td>
											<td><a href="<?php echo $_SERVER['REQUEST_URI'];?>"><?php echo $_SESSION['value'][0]['sportsName']; ?></a></td>
										</tr>
										<tr>
											<td> Official Website :</td>
											<td><a href="sadari/?link[]=<?php echo $_SESSION['value'][0]['link']; ?>"><?php echo $_SESSION['value'][0]['link']; ?></a></td>
										</tr>
										<tr>
											<td>Wager :</td>
											<td><a href="sadari/?wager[]=<?php echo $_SESSION['value'][0]['wager']; ?>"><?php echo $_SESSION['value'][0]['wager']; ?></a></td>
										</tr>
										<tr>
											<td>Maximum Betting :</td>
											<td><a href="sadari/?maximumBetting=<?php echo $_SESSION['value'][0]['maximumBetting']; ?>">원<?php echo $_SESSION['value'][0]['maximumBetting']; ?></a></td>
										</tr>
										<tr>
											<td>Sadari Odd :</td>
											<td><a href="sadari/?sadariOdd[]=<?php echo $_SESSION['value'][0]['sadariOdd']; ?>"><?php echo $_SESSION['value'][0]['sadariOdd']; ?></a></td>
										</tr>
										<tr>
											<td>Closing Time :</td>
											<td><a href="sadari/?closingTime[]=<?php echo $_SESSION['value'][0]['closingTime']; ?>"><?php echo $_SESSION['value'][0]['closingTime']; ?> sec</a></td>
										</tr>
										<?php if($_SESSION['value'][0]['bettingOption'] !=''){?>
										<tr>
											<td>Betting Option :</td>
											<td><a href="sadari/?bettingOption[]=<?php echo $_SESSION['value'][0]['bettingOption']; ?>"><?php echo $_SESSION['value'][0]['bettingOption']; ?></a></td>
										</tr>
										<?php }?>
										<?php if($_SESSION['value'][0]['rollingCondition'] !=''){?>
										<tr>
											<td>Rolling Condition :</td>
											<td><a href="sadari/?rollingCondition[]=<?php echo $_SESSION['value'][0]['rollingCondition']; ?>"><?php echo $_SESSION['value'][0]['rollingCondition']; ?></a></td>
										</tr>
										<?php }?>
										<!-- <?php if($_SESSION['value'][0]['maximumBetting'] !='' && $_SESSION['value'][0]['maximumBetting'] > 0){?>
										<tr>
											<td>Maximum Betting Amount :</td>
											<td><a href=""><?php echo $_SESSION['value'][0]['maximumBetting']; ?></a></td>
										</tr>
										<?php }?> -->
										<?php if($_SESSION['value'][0]['minBettingAmount'] !='' && $_SESSION['value'][0]['minBettingAmount'] > 0){?>
										<tr>
											<td>Minimum Betting Amount :</td>
											<td><a href="sadari/?minBettingAmount=<?php echo $_SESSION['value'][0]['minBettingAmount']; ?>">원<?php echo $_SESSION['value'][0]['minBettingAmount']; ?></a></td>
										</tr>
										<?php }?>
										<?php if($_SESSION['value'][0]['maxAwardAmount'] !='' && $_SESSION['value'][0]['maxAwardAmount'] > 0){?>
										<tr>
											<td>Max Award Amount :</td>
											<td><a href="sadari/?maxAwardAmount=<?php echo $_SESSION['value'][0]['maxAwardAmount']; ?>">원<?php echo $_SESSION['value'][0]['maxAwardAmount']; ?></a></td>
										</tr>
										<?php }?>
										<?php
											$res = $_SESSION['value'][0]['sportsOtherDetails'];
											if(isset($res)){
												$res = explode('+', $res);
												$label = json_decode($res['0']);
												$datas = json_decode($res['1']);

												if(isset($label) != ''){
												foreach ($label as $index => $val) {
										?>
										<tr>
											<td> <?php echo $val; ?> :</td>
											<td><a href="javascript:void:(0)"> <?php echo $datas[$index]; ?> </a></td>
										</tr>
										<?php
												}
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
								<div class="col-lg-12 col-md-12 commentsContainer">
								<?php
								$result = $User->query("SELECT `TSC`.`id`, `TSC`.`gdComments`, `TSC`.`badComments`, `TSC`.`rating`, `TSC`.`updatedOn`, `TU`.`userId` FROM `tblSadariSportsComment` as `TSC`, `tblUser` as `TU`  WHERE `TSC`.`isRecommanded` = 'Y' AND `TSC`.`userId` = `TU`.`id` AND `TSC`.`sportsId` = '" . $reqID[1] . "'");
								if(is_array($result) && count($result) > 0){
									$index = 0;
								?>
									<div class="margin-top-20 commentsFilterArea">
										<a href="" class="text-yellow m-r-10 commentsFilter" data-filter="ALL">All</a>
										<a href="" class="text-yellow m-r-10 commentsFilter" data-filter="GOOD">Good Comments</a>
										<a href="" class="text-yellow m-r-10 commentsFilter" data-filter="BAD">Bad Comments</a>
									</div>
								<?php
									foreach ($result as $key => $value) {
										$request_Id = $value['id'];
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
													<h5 class="page-header comment-preview-header margin-top-0">
														<span class="text-yellow margin-right-5"><?php echo $value['userId']; ?></span>
														<?php $updateDate = explode(' ', $value['updatedOn']);?>
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
										<?php
											$logedInID = (int)User::loggedInUserId() > 0 ? User::loggedInUserId() : 0;
											if($User->checkLoginStatus()){
												$userid = $User->query("SELECT `userId`, `groupId`, `siteName` FROM `tblUser` WHERE `id` = '" . $logedInID . "' LIMIT 0,1");

												if($userid[0]['userId'] == $value['userId']){
													 $User->query("UPDATE `tblCommentResponse` SET `checkUser` = 'Y' WHERE `responseId`='". $request_Id ."' AND `categoryId` = '" . $reqID[1] . "' AND `isVerified`='Y' AND `category`='3'");
												}
											}
											$innrRes = $User->query("SELECT `id`, `userId`, `responseId`, `comment` FROM `tblCommentResponse` WHERE `categoryId` = '" . $reqID[1] . "' AND `responseId` = '" . $request_Id . "' AND `isVerified`='Y' AND `category`='3' ORDER BY `createdOn`");
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
														<input type="hidden" name="_COMMENT_CAT" value="SADARI_COMMENT" />
														<input type="hidden" name="category" value="SADARI SPORTS" />
													</div>			
												</td>
											</tr>
										</table>
										<div class="col-md-10 col-md-offset-2">
											<p class="text-white">Rate this Sport</p>
											<div class="rating font13 text-white star-margin" style="margin-top:-7px;">
		                                        <div class="rateyo-readonly-widg" data-toggle="tooltip" title=""></div>
		                                        <div class="counter ratingCounter"></div>
		                                        <input type="hidden" name="commentRate" id="commentRate" value="5" />
		                                    </div>
		                                    <p class="text-white"><input type="checkbox" name="checkPost" /><span style="margin-left:15px;">저의 후기는 본인 자신의 경험을 토대로 작성하였으며 진실된 의견임을 선언합니다. 저는 해당 사이트 직원이 아니며, 해당 리뷰로 인해 사이트로부터 인센티브 혹은 어떠한 보너스도 받지 않았습니다. 배팅타임에서는 거짓된 리뷰에 대해 엄격한 조치를 취할 것입니다. </span></p>
		                                    <div style="margin-top:20px;margin-bottom:10px;">
		                                    	<button type="submit" class="btn btn-ask-red" style="margin:0px 20px 0px 0px;">작성하기</button><a href="posting-guidlines.php" class="text-yellow">댓글 가이드 라인 확인하기</a>
	                                    	</div>
										</div>
									</div>
								</form>
							</div>
						</div>
						<div class="ask-page-content ask-land-page-content">
							<div class="ask-page-content-header">
								<h3 class="text-uppercase">News</h3><!--  border-bottom-5 -->
								<p class="custom-text custom-p">Here's a list of casino bonuses and promotions that is updated daily with the latest coupon code,no deposite bonuses, free spin, cash back welcome offers, match deposite bonuses, high roller bonuses and many more.. </p>
							</div>
							<div class="ask-page-content-body"><!--  -->
								<?php
								$result = $User->query("SELECT `id`, `title`, `newsDesc`, `newsImage`, `updatedOn` FROM `tblNewsBlog` WHERE `id` != '" . $_SESSION['value']['0']['id'] . "' AND `isNews` = 'N' ORDER BY `updatedOn` desc LIMIT 3");
								if(is_array($result) && count($result) > 0){
									foreach ($result as $key => $value) {				
							?>
								<div class="col-md-3 col-sm-3 col-xs-3 padding0 ask-land-web-card">
									<div class="ask-cards">
										<div class="ask-item-news-card">
											<div class="front">
												<span class="pull-right fa fa-info info" style="top: 254px; padding: 6px 10px 19px;"></span>
												<div class="news-logo">
													<a href="news-details/<?php echo $value['id']; ?>/<?php echo str_replace(' ', '-', $value['title']); ?>/">
														<img src="<?php echo $value['newsImage']; ?>" class="img-responsive" alt="" />
													</a>
												</div>
												<div class="news-short-desc">
													<a href="news-details/<?php echo $value['id']; ?>/<?php echo str_replace(' ', '-', $value['title']); ?>/"><p class="text-black"><?php echo $value['title']; ?></p></a>
												</div>
												<div class="news-Date">
													<?php 
													$date = explode(' ', $value['updatedOn']);
													$date = $date[0];
													$date = date_create($date);
													 $postDate = date_format($date, 'F d , Y')
													?>
													<p> <?php echo $postDate;?></p>
												</div>
											</div><!-- front -->
											<div class="back">
												<div class="news-short-desc">
													<a href="news-details/<?php echo $value['id']; ?>/<?php echo str_replace(' ', '-', $value['title']); ?>/"><p class="text-black"><b><?php echo $value['title']; ?></b></p></a>
													<!--<span class="pull-right fa fa-close info"></span>-->
												</div>
												<div class="news-about">
													<p class="text-justify"><?php echo C::contentMorewithoutlink($value['newsDesc'], 150); ?></p>
												</div>
												<div class="news-reamore">
													<div class="text-center">
														<a href="news-details/<?php echo $value['id'].'/'.str_replace(' ', '-', $value['title']).'/';?>" class="readMore">Read More</a>
													</div>
												</div>
												<span class="pull-right fa fa-close info" style="top: 250px; padding: 4px 6px 19px;"></span>
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