<?php
require_once('config.php');	

// Load Classes
C::loadClass('User');
C::loadClass('Card');
C::loadClass('CMS');
//Init User class
$User = new User();
$Card = new Card();

if(isset($_GET['logout']) && trim($_GET['logout']) == 'logout'){
    UNSET($_SESSION['admin']);
   	C::redirect('index.php');
}

if(isset($_GET['k']) && trim($_GET['k']) != ''){
    if($User->active(trim($_GET['k']))){
		C::redirect('index.php');
	}
}



?>
<?php require_once('includes/doc_head.php'); ?>
			<div class="" id="main-bannar"><!-- col-lg-12 -->
				<div id="myCarousel" class="carousel slide" data-ride="carousel">
				  <!-- Indicators -->
					<ol class="carousel-indicators">
						<li data-target="#myCarousel" data-slide-to="0" class="active"></li>
						<li data-target="#myCarousel" data-slide-to="1"></li>
						<li data-target="#myCarousel" data-slide-to="2"></li>
						<li data-target="#myCarousel" data-slide-to="3"></li>
						<li data-target="#myCarousel" data-slide-to="4"></li>
						<li data-target="#myCarousel" data-slide-to="5"></li>
					</ol>

				  <!-- Wrapper for slides -->
					<div class="carousel-inner slider" role="listbox">
						<?php
						$result = $User->query("SELECT `sliderImage`, `sliderHeading`, `sliderText`, `buttonOne`, `buttonTwo` FROM `tblSlider`");
						$counter = 1;
						if(is_array($result) && count($result) > 0){
							foreach ($result as $key => $slider) {
							$buttonOne = explode("+", trim($slider['buttonOne']));			
							$buttonTwo = explode("+", trim($slider['buttonTwo']));			
						?>
						<div class="item<?php if($counter <= 1){echo " active"; } ?>">
							<img src="<?php echo $slider['sliderImage']; ?>" class="img-responsive center-block" alt="slider">
							<div class="carousel-caption ask-carousel-caption">
								<h3 class="hidden-xs"><?php echo $slider['sliderHeading']; ?></h3> 
								<div class="clearfix"></div>          
								<p class="hidden-sm hidden-xs"><?php echo $slider['sliderText']; ?></p>
								<div class="clearfix"></div>

								<a class="btn hidden-xs <?php if($buttonOne['2'] == 'red'){echo " btn-ask-red";}else{ echo " btn-ask-green";} ?>" href="http://<?php echo $buttonOne['1']; ?>"><span class="text-capitalize"><?php echo $buttonOne['0']; ?></span></a>
								<a class="btn hidden-xs <?php if($buttonTwo['2'] == 'red'){echo " btn-ask-red";}else{ echo " btn-ask-green";} ?>" href="http://<?php echo $buttonTwo['1']; ?>"><span class="text-capitalize"><?php echo $buttonTwo['0']; ?></span></a>
							</div>
						</div>
						<?php
						$counter++;
							}
						}
						?>
					</div>

				  <!-- Left and right controls -->
					<a class="left carousel-control custom-control" href="#myCarousel" role="button" data-slide="prev">
						<span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
						<span class="sr-only">Previous</span>
					</a>
					<a class="right carousel-control custom-control" href="#myCarousel" role="button" data-slide="next">
						<span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
						<span class="sr-only">Next</span>
					</a>
				</div>
			</div><!-- main-bannar -->
			<div class="ask-content" id="ask-content">
				<div class="row">
					<div class="col-lg-3 col-md-3 col-lg-push-9 col-md-push-9 sticky_column">
						<?php require_once('includes/sportsRecommend.php'); ?>
					</div>
					<div class="col-lg-9 col-md-9 col-lg-pull-3 col-md-pull-3">
						<div class="ask-popular-betteing">
							<div class="ask-page-content-header">
								<h5><b>Popular betting bonus</b></h5>
							</div>
							<div class="ask-popular-betteing-content"><!-- owl-carousel -->
								<div class="owl-carousel-team owl-theme kode-team-list next-prev-style">
									<?php
									$result = $User->query("SELECT `id`, `bonusName`, `bonusAmount`, `sportsName`, `bonusImage`, `imageName` FROM `tblBonusCards` WHERE `isPopular` = 'Y' ORDER BY `updatedOn` desc");
									if(is_array($result) && count($result) > 0){
										foreach ($result as $key => $value) {				
									?>
									<div class="item" style="margin-top: -5px;">
										<div class="smallThumb">
											<div class="thumbLogo">
												<a href="<?php echo C::link('bonusDetail.php', array('detail' => base64_encode(str_replace(' ', '-', $value['bonusName']) . '+' . $value['id'] )), true);?>"><img src="<?php echo $value['bonusImage']; ?>" class="img-responsive" alt="" style="width:114px;height:78px;"></a>
											</div><!-- thumbLogo -->
											<div class="thumbDesc">
												<a href="<?php echo C::link('bonusDetail.php', array('detail' => base64_encode(str_replace(' ', '-', $value['bonusName']) . '+' . $value['id'] )), true);?>"><h5><?php echo $value['bonusName']; ?></h5></a>
												<span class="thumbPrice text-yellow"><b><?php echo $value['bonusAmount']; ?></b></span><br>
												<span class="thumbCode"><?php echo $value['sportsName']; ?></span>
											</div><!-- thumbDesc -->
										</div><!-- smallThumb -->
									</div><!-- /item -->
									<?php
										}
									}
									?>
								</div>
							</div>
						</div>
						<div class="clearfix"></div>
						<div class="ask-page-content">
							<div class="ask-page-content-header">
								<h3 class="text-uppercase">Sports <span class="pull-right" style="font-size:12px;line-height:30px;"><a href="sports.php" class="text-white">View more</a></span></h3><!--  border-bottom-5 -->
								<p class="custom-p custom-text">Here's a list of casino bonuses and promotions that is updated daily with the latest coupon code,no deposite bonuses, free spin, cash back <br>, welcome offers, match deposite bonuses, high roller bonuses and many more.. </p>
							</div>
							<div class="ask-page-content-body ask-home-card">
							<?php
							$result = $User->query("SELECT * FROM `tblWebCards` WHERE `isPin` = 'Y' ORDER BY `id` desc LIMIT 4");
							if(is_array($result) && count($result) > 0){
								foreach ($result as $key => $value) {
							?>
								<div class="col-md-3 col-sm-3 col-xs-3 padding0">
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
													<a href="<?php echo C::link('sportsDetail.php', array('detail' => base64_encode(str_replace(' ', '-', $value['sportsName']) . '+' . $value['id']) ), true);?>"><img src="<?php echo $value['sportsImage']; ?>" width="196px" height="133px" alt=""></a>
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
												<div class="playNow">
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
															<?php $v = explode(',', $value['miniGame']);?>
															<div class="list-right"><?php echo $v[0]; if (count($v) > 1) {
																echo ' etc...';
															}?> </div>
														</li>
													</ul>
													<div class="clearfix"></div>
													
												</div><!-- sport-desc -->
												<div class="getNow">
													<div class="text-center" style="position:relative;bottom:10px;">
														<a href="<?php echo C::link('sportsDetail.php', array('detail' => base64_encode(str_replace(' ', '-', $value['sportsName']) . '+' . $value['id']) ), true);?>" class="readMore">Read More</a>
													</div>
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
						</div><!-- verified sports -->
						<div class="clearfix"></div>
						<div class="ask-page-content">
							<div class="ask-page-content-header">
								<h3 class="text-uppercase">Sadari Sport <span class="pull-right" style="font-size:12px;line-height:30px;"><a href="sadari.php" class="text-white">View more</a></span></h3><!--  border-bottom-5 -->
								<p class="custom-p custom-text">Here's a list of casino bonuses and promotions that is updated daily with the latest coupon code,no deposite bonuses, free spin, cash back , welcome offers, match deposite bonuses, high roller bonuses and many more.. </p>
							</div>
							<div class="ask-page-content-body ask-home-card">
							<?php
							$result = $User->query("SELECT * FROM `tblSadariCards` WHERE `isPin` = 'Y' ORDER BY `id` desc LIMIT 4");
							if(is_array($result) && count($result) > 0){
								foreach ($result as $key => $value) {
							?>
								<div class="col-md-3 col-sm-3 col-xs-3 padding0">
									<div class="ask-cards">
										<div class="ask-item-web-card">
											<div class="front">
												<div class="cardHeader">
													<a href="<?php echo C::link('sadariDetails.php', array('detail' => base64_encode(str_replace(' ', '-', $value['sportsName']) . '+' . $value['id']) ), true);?>"><h5><?php echo $value['sportsName']; ?></h5></a>
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
													<a href="<?php echo C::link('sadariDetails.php', array('detail' => base64_encode(str_replace(' ', '-', $value['sportsName']) . '+' . $value['id']) ), true);?>"><img src="<?php echo $value['sportsImage']; ?>" width="196px" height="133px" alt=""></a>
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
												<div class="playNow">
													<a href="http://<?php echo $value['link'];?>" class="btn btn-ask btn-w100"><b>PLAY NOW</b></a>
												</div>
											</div><!-- front -->
											<div class="back">
												<div class="cardHeader">
													<a href="<?php echo C::link('sadariDetails.php', array('detail' => base64_encode(str_replace(' ', '-', $value['sportsName']) . '+' . $value['id']) ), true);?>"><h5 style="text-transform:uppercase;"><?php echo $value['sportsName']; ?></h5></a>
													<span class="pull-right fa fa-close info"></span>
												</div>
												<div class="sport-desc">
				                                	<ul class="information-list">
														<li>
															<div class="list-left">Sadari Odd</div>
															<div class="list-right"><?php echo $value['sadariOdd']; ?></div>
														</li>
														<li>
															<div class="list-left">Wager</div>
															<div class="list-right"><?php echo $value['wager']; ?></div>
														</li>
														<li>
															<div class="list-left">Maximum Betting</div>
															<div class="list-right"><?php echo $value['maximumBetting']; ?></div>
														</li>
														<li>
															<div class="list-left">Rutin/Matin</div>
															<div class="list-right"><?php echo $value['ruMatin']; ?></div>
														</li>
														<li>
															<div class="list-left">Closing time</div>
															<div class="list-right"><?php echo $value['closingTime']; ?></div>
														</li>
													</ul>
													<div class="clearfix"></div>
													<div class="text-center" style="margin-top: 50px;">
														<a href="<?php echo C::link('sadariDetails.php', array('detail' => base64_encode(str_replace(' ', '-', $value['sportsName']) . '+' . $value['id']) ), true);?>" class="readMore">Read More</a>
													</div>
												</div><!-- sport-desc -->
												<div class="getNow">
													<a href="http://<?php echo $value['link'];?>" class="btn btn-ask btn-w100"><b>PLAY NOW</b></a>
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
						</div><!-- verified sports -->
						<div class="clearfix"></div>
						<div class="ask-page-content">
							<div class="ask-page-content-header">
								<h3 class="text-uppercase">bonus codes <span class="pull-right" style="font-size:12px;line-height:30px;"><a href="bonus.php" class="text-white">View more</a></span></h3><!--  border-bottom-5 -->
								<p class="custom-p custom-text">Here's a list of casino bonuses and promotions that is updated daily with the latest coupon code,no deposite bonuses, free spin, cash back <br>, welcome offers, match deposite bonuses, high roller bonuses and many more.. </p>
							</div>
							<div class="ask-page-content-body ask-home-card">
								<?php
								$result = $User->query("SELECT `id`, `bonusName`, `joinCode`, `bonusAmount`, `link`, `bonusCode`, `bonustype`, `wageringRequirements`, `sportsName`, `rating`, `bonusImage`, `imageName` FROM `tblBonusCards` ORDER BY `updatedOn` desc LIMIT 4");
								if(is_array($result) && count($result) > 0){
									foreach ($result as $key => $value) {				
								?>
								<div class="col-md-3 col-sm-3 col-xs-3 padding0">
									<div class="ask-cards">
										<div class="ask-item-bonus-card">
											<div class="front">
												<div class="cardHeader">
				                                    <a href="<?php echo C::link('bonusDetail.php', array('detail' => base64_encode(str_replace(' ', '-', $value['bonusName']) . '+' . $value['id'] )), true);?>"><h5><?php echo $value['bonustype']; ?></h5></a>
													<span class="fa fa-info info" style="font-size:14px;"></span>
				                                </div>
				                                <div class="cardLogo" style="overflow:hidden;">
				                                    <a href="<?php echo C::link('bonusDetail.php', array('detail' => base64_encode(str_replace(' ', '-', $value['bonusName']) . '+' . $value['id'] )), true);?>"><img src="<?php echo $value['bonusImage'];?>" class="img-responsive" style="height:87px;"  alt=""></a>
				                                    <div class="cardReview text-center text-black <?php if(strlen($value['bonusName']) > 9){ echo "margin-bottom-3";}?>">
				                                    	<span class="bonus-name text-center text-uppercase <?php if(strlen($value['bonusName']) > 9){ echo "font12";}?>"><?php echo $value['bonusName'];?></span>
					                                    <div class="rating padding3 font13 color" style="margin-top: -1px; margin-left: 2px;">
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
					                                    <div class="ask-code">
				                                        	<p class="custom-border1">JOIN CODE</p> <br>
				                                        	<span class="custom-border"><?php echo $value['joinCode']; ?></span>
					                                    </div>
					                                </div>
				                                </div>
				                                <div class="mainView" style="overflow:hidden;">
			                                        <div class="bonus">
			                                            <div class="bonusAmount">
			                                                <span class="text-center"><?php echo $value['bonusAmount']; ?></span>
			                                            </div>
			                                            <div class="bonusType">
			                                                <span class="text-center text-uppercase"><?php echo $value['bonusName'];?></span>
			                                            </div>
			                                        </div>
			                                    </div>
			                                    <div class="bonusCode text-center">
			                                        <span style="font-size:12px">BONUS CODE</span><br>
			                                        <span><b><?php echo $value['bonusCode']; ?></b></span>
			                                    </div>
				                                <div class="playNow" style="margin-top: 5px;">
													<a href="<?php echo $value['link'];?>" class="btn btn-ask btn-w100"><b>GET NOW</b></a>
												</div>
											</div><!-- front -->
											<div class="back">
												<div class="cardHeader">
				                                    <a href="<?php echo C::link('bonusDetail.php', array('detail' => base64_encode(str_replace(' ', '-', $value['bonusName']) . '+' . $value['id'] )), true);?>"><h5 class="text-uppercase"><?php echo $value['bonustype']; ?></h5></a>
				                                    <span class="pull-right fa fa-close info"></span>
				                                </div>
				                                <div class="bonus-desc">
				                                	<ul class="information-list">
														<li>
															<div class="list-left">Bonus</div>
															<div class="list-right"><?php echo $value['bonusAmount']; ?></div>
														</li>
														<li>
															<div class="list-left">Sports</div>
															<div class="list-right"><?php echo $value['sportsName']; ?></div>
														</li>
														<li>
															<div class="list-left">W.R</div>
															<div class="list-right"><?php echo $value['wageringRequirements']; ?></div>
														</li>
														<li>
															<div class="list-left">Type</div>
															<div class="list-right"><?php echo $value['bonustype']; ?></div>
														</li>
													</ul>
				                                </div>
				                                <div class="clearfix"></div>
				                                <div class="text-center" style="margin-top: 20px;font-size:12px;">
													<a href="<?php echo C::link('bonusDetail.php', array('detail' => base64_encode(str_replace(' ', '-', $value['bonusName']) . '+' . $value['id'] )), true);?>" class="readMore">Read More</a>
												</div>
				                                <div class="getNow">
				                                    <a href="http://<?php echo $value['link'];?>" class="btn btn-ask btn-w100"><b>GET NOW</b></a>
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
						</div><!-- bonus code -->
						<div class="clearfix"></div>
						<div class="ask-page-content">
							<div class="ask-page-content-header">
								<h3 class="text-uppercase">Complaints<span class="pull-right" style="font-size:12px;line-height:30px;"><a href="complaint.php" class="text-white">View more</a></span></h3><!--  border-bottom-5 -->
								<p class="custom-p custom-text">Here's a list of casino bonuses and promotions that is updated daily with the latest coupon code,no deposite bonuses, free spin, cash back <br>, welcome offers, match deposite bonuses, high roller bonuses and many more.. </p>
							</div>
							<div class="ask-page-content-body ask-home-card">
							<?php
								$result = $User->query("SELECT `id`, `reason`, `complaintTitle`, `complaintText`, `amount`, `isVerified`, `status` FROM `tblComplaints` WHERE `isVerified` = 'Y'  ORDER BY `updatedOn` ASC LIMIT 4");
								if(is_array($result) && count($result) > 0){
									foreach ($result as $key => $value) {				
								?>
								<div class="col-md-3 col-sm-3 col-xs-3 padding0">
									<div class="ask-cards">
										<div class="ask-item-complain-card">
											<div class="front">
											<span class="pull-right fa fa-info info"></span>
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
															<span class="glyphicon glyphicon glyphicon-ok-sign ask-complai-logo complai-success"></span>
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
													<p> <span style="line-height:32px;font-size:20px;font-weight:700;"><?php echo $value['amount']; ?> 만원</span><br>
														<span style="line-height:17px;"><?php echo $value['reason']; ?></span> </p>
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
							</div><!-- ask-page-content-body -->
						</div><!-- Site News -->
						<div class="ask-page-content">
							<div class="ask-page-content-header">
								<h3 class="text-uppercase">site news <span class="pull-right" style="font-size:12px;line-height:30px;"><a href="news.php?cat=Site-News%2FSN" class="text-white">View more</a></span></h3><!--  border-bottom-5 -->
								<p class="custom-p custom-text">Here's a list of casino bonuses and promotions that is updated daily with the latest coupon code,no deposite bonuses, free spin, cash back <br>, welcome offers, match deposite bonuses, high roller bonuses and many more.. </p>
							</div>
							<div class="ask-page-content-body ask-home-card">
							<?php
								$result = $User->query("SELECT `id`, `title`, `newsDesc`, `newsImage`, `updatedOn` FROM `tblNewsBlog` WHERE `isNews` = 'N' ORDER BY `updatedOn` desc LIMIT 4");
								if(is_array($result) && count($result) > 0){
									foreach ($result as $key => $value) {				
							?>
								<div class="col-md-3 col-sm-3 col-xs-3 padding0">
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
													<p><?php echo C::contentMore($value['newsDesc'], 150, C::link('newsDetail.php', array('detail' => base64_encode(str_replace(' ', '-', $value['title']) . '+' . $value['id'] )), true)); ?></p>
												</div>
											</div><!-- back -->
										</div><!-- ask-item-news-card -->
									</div>
								</div><!-- col-md-3 -->
							<?php
								}
							}
							?>
							</div><!-- ask-page-content-body -->
						</div><!-- Site News -->
						<div class="clearfix"></div>
						<div class="ask-page-content">
							<div class="ask-page-content-header">
								<h3 class="text-uppercase">Blog <span class="pull-right" style="font-size:12px;line-height:30px;"><a href="news.php?cat=Blog%2FB" class="text-white">View more</a></span></h3><!--  border-bottom-5 -->
								<p class="custom-p custom-text">Here's a list of casino bonuses and promotions that is updated daily with the latest coupon code,no deposite bonuses, free spin, cash back <br>, welcome offers, match deposite bonuses, high roller bonuses and many more.. </p>
							</div>
							<div class="ask-page-content-body ask-home-card">
							<?php
								$result = $User->query("SELECT `id`, `title`, `newsDesc`, `newsImage`, `updatedOn` FROM `tblNewsBlog` WHERE `isNews` = 'B' ORDER BY `updatedOn` desc LIMIT 4");
								if(is_array($result) && count($result) > 0){
									foreach ($result as $key => $value) {				
							?>
								<div class="col-md-3 col-sm-3 col-xs-3 padding0">
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
													<a href="<?php echo C::link('newsDetail.php', array('detail' => base64_encode(str_replace(' ', '-', $value['title']) . '/' . $value['id'] )), true);?>"><p class="text-black"><b><?php echo $value['title']; ?></b></p></a>
													<span class="pull-right fa fa-close info"></span>
												</div>
												<div class="news-about">
													<p><?php echo C::contentMore($value['newsDesc'], 150, C::link('newsDetail.php', array('detail' => base64_encode(str_replace(' ', '-', $value['title']) . '+' . $value['id'] )), true)); ?></p>
												</div>
											</div><!-- back -->
										</div><!-- ask-item-news-card -->
									</div>
								</div><!-- col-md-3 -->
							<?php
								}
							}
							?>
							</div><!-- ask-page-content-body -->
						</div><!-- Site News -->
						<div class="clearfix"></div>
					</div><!-- col-lg-9 col-md-9 -->
				</div><!-- row -->
			</div><!-- ask-content -->
		</div><!-- parent-container -->
		<div class="json"></div>
<?php require_once('includes/doc_footer.php'); ?>
