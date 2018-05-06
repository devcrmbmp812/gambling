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

if(isset($_GET['logout']) && trim($_GET['logout']) == 'logout'){
    UNSET($_SESSION['admin']);
    header("LOCATION:index.php");
}

// if(!$User->checkLoginStatus()){
// 	$Common->redirect('index.php');
// }

if(isset($_GET['filter']) && trim($_GET['filter'])){
	$colName = trim($_GET['filter']);
	$colValue = '';

	switch ($colName) {
    case "top-rated":
        $_SESSION['colName'] = "bonusAmount";
        //$colValue = ;
        break;
    case "NS":
        $colName = "Newest sport";
        break;
    case "VS":
        $colName = "Verified sport";
        break;
    case "BS":
        $colName = "Bitcoin sport";
        break;
    case "MS":
        $colName = "Mobile sport";
        break;
    case "SS":
        $colName = "Sadari sport";
        break;
    // default:
    //     echo "!!!!!!";
}
}


?>
<?php require_once('includes/doc_head.php'); ?>
			<div class="ask-content" id="ask-content">
				<div class="row">
					<div class="col-lg-9 col-md-9">
						<div class="ask-page-content ask-land-page-content">
							<div class="ask-page-content-header">
								<h3 class="text-uppercase"><?php echo $colName; ?> </h3><!--  border-bottom-5 -->
								<p class="custom-text">Here's a list of casino bonuses and promotions that is updated daily with the latest coupon code,no deposite bonuses, free spin, cash back <br>, welcome offers, match deposite bonuses, high roller bonuses and many more.. </p>
							</div>
							<div class="ask-page-content-body"><!--  -->
								<div class="filterBy" style="overflow:hidden;">
									<ul class="text-success">
										<li><a href="<?php echo C::link('filter.php', array('filter' => str_replace(' ', '-', 'top-rated') ), true);?>" class="text-success btn btn-ask-green"><i class="fa fa-tag" aria-hidden="true"></i> Top Rated</a></li>
										<li><a href="" class="text-success btn btn-ask-green"><i class="fa fa-tag" aria-hidden="true"></i> 10% Bonus</a></li>
										<li><a href="" class="text-success btn btn-ask-green"><i class="fa fa-tag" aria-hidden="true"></i> Bonus Amount</a></li>
										<li><a href="" class="text-success btn btn-ask-green"><i class="fa fa-tag" aria-hidden="true"></i> Hot</a></li>
										<li><a href="" class="text-success btn btn-ask-green"><i class="fa fa-tag" aria-hidden="true"></i> New</a></li>
										<li><a href="" class="text-success btn btn-ask-green"><i class="fa fa-tag" aria-hidden="true"></i> Max Review</a></li>
										<li><a href="" class="text-success btn btn-ask-green"><i class="fa fa-tag" aria-hidden="true"></i> Max Prize Money</a></li>
									</ul>
								</div>
								<?php
								$result = $User->query("SELECT * FROM `tblWebCards` WHERE `sportsType` = '" . $colName . "' ORDER BY `id` desc LIMIT 12");
								if(is_array($result) && count($result) > 0){
									foreach ($result as $key => $value) {
								?>
								<div class="col-md-3 col-sm-3 col-xs-3 padding0 ask-land-web-card">
									<div class="ask-cards">
										<div class="ask-item-web-card">
											<div class="front">
												<div class="cardHeader">
													<a href="<?php echo C::link('sportsDetail.php', array('detail' => base64_encode(str_replace(' ', '-', $value['sportsName']) . '+' . $value['id']) ), true);?>"><h5><?php echo $value['sportsName']; ?></h5></a>
													<span class="pull-right fa fa-info info"></span>
												</div>
												<div class="cardLogo">
													<?php
													if($value['isHot'] == "H"){
													?>
													<span class="card-tag-red">HOT</span>
													<?php
													} else{
													?>
													<span class="card-tag-blue">NEW</span>
													<?php
													}
													?>
													<a href="<?php echo C::link('sportsDetail.php', array('detail' => base64_encode(str_replace(' ', '-', $value['sportsName']) . '+' . $value['id']) ), true);?>"><img src="<?php echo $value['sportsImage']; ?>" width="196px" height="149px" alt=""></a>
												</div>
												<div class="cardReview text-center text-black">
													<div class="rating padding-5 font16">
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
			                                    			<i class="fa fa-star third" aria-hidden="true"></i><i class="fa fa-star third" aria-hidden="true"></i><i class="fa fa-star third" aria-hidden="true"></i><i class="fa fa-star-o" aria-hidden="true"></i></i><i class="fa fa-star-o" aria-hidden="true"></i></i>
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
													</div>
													<div class="code padding-5">
														<p class="text-center text-black"><span style="font-size:13px;">JOIN CODE</span><b> : <?php echo $value['joinCode']; ?></b></p>
													</div>
												</div>
												<div class="playNow"><!-- custom-play-now -->
													<a href="http://<?php echo $value['link'];?>" class="btn btn-ask btn-w100"><b>PLAY NOW</b></a>
												</div>
											</div><!-- front -->
											<div class="back">
												<div class="cardHeader">
													<a href="<?php echo C::link('sportsDetail.php', array('detail' => base64_encode(str_replace(' ', '-', $value['sportsName']) . '+' . $value['id']) ), true);?>"><h5 style="text-transform:uppercase;"><?php echo $value['sportsName']; ?></h5></a>
													<span class="pull-right fa fa-close info"></span>
												</div>
												<div class="sport-desc">
				                                	<ul class="information-list">
														<li>
															<div class="list-left">Welcome Bonus</div>
															<div class="list-right"><?php echo $value['welcomeBonus']; ?></div>
														</li>
														<li>
															<div class="list-left">Max Prize</div>
															<div class="list-right"><?php echo $value['maxPrizeMoney']; ?></div>
														</li>
														<li>
															<div class="list-left">Cross Betting</div>
															<div class="list-right"><?php echo $value['crossBetting']; ?></div>
														</li>
														<li>
															<div class="list-left">Mini Game</div>
															<div class="list-right"><?php echo $value['miniGame']; ?></div>
														</li>
													</ul>
													<div class="clearfix"></div>
													<div class="text-center" style="margin-top: 50px;">
														<a href="<?php echo C::link('sportsDetail.php', array('detail' => base64_encode(str_replace(' ', '-', $value['sportsName']) . '+' . $value['id']) ), true);?>" class="readMore">Read More</a>
													</div>
												</div><!-- sport-desc -->
												<div class="getNow">
													<a href="<?php echo $value['link'];?>" class="btn btn-ask btn-w100"><b>PLAY NOW</b></a>
												</div>
											</div><!-- back -->
										</div><!-- ask-item-web-card -->
									</div>
								</div><!-- col-md-3 -->
							<?php
								}
							}
							?>
							</div>
							<!-- extra -->
						</div><!-- verified sports landing -->
					</div><!-- col-lg-9 col-md-9 -->
					<div class="col-lg-3 col-md-3" style="padding-left: 0px;">
						<?php require_once('includes/sportsRecommend.php'); ?>
					</div>
				</div><!-- row -->
			</div><!-- ask-content -->
		</div><!-- parent-container -->
<?php require_once('includes/doc_footer.php'); ?>