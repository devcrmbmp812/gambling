<?php

require_once('config.php');	

// Load Classes

C::loadClass('User');
C::loadClass('Card');
C::loadClass('CMS');

//Init User class
$User = new User();
$Card = new Card();

if(isset($_GET['k']) && trim($_GET['k']) != ''){

    if($User->active(trim($_GET['k']))){

		C::redirect('index.php');

	}

}

$page = 'home';

?>

<?php require_once('includes/doc_head.php'); ?>
			<div class="" id="main-bannar"><!-- col-lg-12 -->
				<div id="myCarousel" class="carousel slide onDesktop" data-ride="carousel">
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
								<p class="hidden-sm hidden-xs"><?php echo nl2br(substr($slider['sliderText'], 0, 202)); ?></p>
								<div class="clearfix"></div>


								<?php if($buttonOne[0] != ''){ ?>
								<a class="btn hidden-xs <?php if($buttonOne['2'] == 'red'){echo " btn-ask-red";}else{ echo " btn-ask-green";} ?>" href="http://<?php echo $buttonOne['1']; ?>"><span class="text-capitalize"><?php echo $buttonOne['0']; ?></span></a>

								<?php } ?>
								<?php if($buttonTwo[0] != ''){ ?>
								<a class="btn hidden-xs <?php if($buttonTwo['2'] == 'red'){echo " btn-ask-red";}else{ echo " btn-ask-green";} ?>" href="http://<?php echo $buttonTwo['1']; ?>"><span class="text-capitalize"><?php echo $buttonTwo['0']; ?></span></a>
								<?php } ?>


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







				<!-- mobile -->







				<div id="myCarousel2" class="carousel slide onMobile" data-ride="carousel">



				  	<!-- Indicators -->



				  	<!-- <ol class="carousel-indicators">



				    	<li data-target="#myCarousel" data-slide-to="0" class="active"></li>



				    	<li data-target="#myCarousel" data-slide-to="1"></li>



				    	<li data-target="#myCarousel" data-slide-to="2"></li>



				  	</ol> -->







				  	<!-- Wrapper for slides -->



				  	<div class="carousel-inner">



				  		<?php



						$result = $User->query("SELECT `sliderRespImage`, `sliderHeading`, `sliderText`, `buttonOne`, `buttonTwo` FROM `tblSlider`");



						$counter = 1;



						if(is_array($result) && count($result) > 0){



							foreach ($result as $key => $slider) {



							$buttonOne = explode("+", trim($slider['buttonOne']));			



							$buttonTwo = explode("+", trim($slider['buttonTwo']));			



						?>



				    	<div class="item<?php if($counter <= 1){echo " active"; } ?>">



				      		<img src="<?php echo $slider['sliderRespImage']; ?>" style="width:100%;" alt="">







				      		<div class="carousel-caption">



								<h3 class="respSlider-Heading text-uppercase"><?php echo $slider['sliderHeading']; ?></h3> 



								<div class="clearfix"></div>          



								<!-- <p class="hidden-sm hidden-xs"><?php echo $slider['sliderText']; ?></p> -->



								<div class="clearfix"></div>



								



								<a class="btn <?php if($buttonOne['2'] == 'red'){echo " btn-ask-red";}else{ echo " btn-ask-green";} ?>" href="http://<?php echo $buttonOne['1']; ?>"><span class="text-capitalize"><?php echo $buttonOne['0']; ?></span></a>



								<a class="btn <?php if($buttonTwo['2'] == 'red'){echo " btn-ask-red";}else{ echo " btn-ask-green";} ?>" href="http://<?php echo $buttonTwo['1']; ?>"><span class="text-capitalize"><?php echo $buttonTwo['0']; ?></span></a>



							</div>



				    	</div>



				    	<?php



						$counter++;



							}



						}



						?>



				  	</div>







				  <!-- Left and right controls -->



				  	<a class="left carousel-control" href="#myCarousel2" data-slide="prev">



				    	<span class="glyphicon glyphicon-chevron-left"></span>



				    	<span class="sr-only">Previous</span>



				  	</a>



				  	<a class="right carousel-control" href="#myCarousel2" data-slide="next">



				    	<span class="glyphicon glyphicon-chevron-right"></span>



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



								<h5><b>인기있는 보너스</b></h5>



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



												<a href="bonus-details/<?php echo $value['id']?>/<?php echo $value['bonusName']?>"><img src="<?php echo $value['bonusImage']; ?>" class="img-responsive" alt="" style="width:114px;height:78px;"></a>



											</div><!-- thumbLogo -->



											<div class="thumbDesc">



												<a href="bonus-details/<?php echo $value['id']?>/<?php echo $value['bonusName']?>"><h5><?php echo $value['bonusName']; ?></h5></a>



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



								<h3 class="text-uppercase"><a href="sports/" class="text-white">검증된 배팅사이트</a> <span class="pull-right" style="font-size:12px;line-height:30px;"><a href="sports/" class="text-white">전체보기</a></span></h3><!--  border-bottom-5 -->



								<p class="custom-p custom-text">배팅타임에 등록된 어떠한 배팅사이트를 이용하더라도 100% 안전을 보장합니다.<br>먹튀가 발생할 경우, 100% 전액 금전적인 보상을 해드립니다.</p>



							</div>



							<div class="ask-page-content-body ask-home-card onDesktop">



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
													<a href="sports-details/<?php echo $value['id'];?>/<?php echo str_replace(' ', '-', $value['sportsName']);?>/"><h5><?php echo $value['sportsName']; ?></h5></a>
													<!-- <a href="sportsDetail.php?id=<?php echo $value['id'];?>&name=<?php echo str_replace(' ', '-', $value['sportsName']);?>"><h5><?php echo $value['sportsName']; ?></h5></a> -->
													<span class="pull-right fa fa-info info"></span>
												</div>
												<div class="cardLogo">
													<?php
													if($value['isHot'] == "H"){
													?>
													<span class="card-tag-red">HOT</span>
													<?php
													} else if($value['isHot'] == "N"){
													?>
													<span class="card-tag-blue">NEW</span>
													<?php
													} else if($value['isHot'] == "0"){
													?>
													<?php
													} else {
													?>
														<span class="card-tag-private">비공개</span>
													<?php
													}
													?>
													<a href="sports-details/<?php echo $value['id'];?>/<?php echo str_replace(' ', '-', $value['sportsName']);?>/"><img src="<?php echo $value['sportsImage']; ?>" width="196px" height="132px" alt=""></a>

												</div>
												<div class="cardReview text-center text-black">

													<div class="rating padding-5 font16">
														<?php
														$iddd = $value['id']; 
														echo '<p class="text-black" style="margin-bottom:2px;">'. $sportsExtraText[$iddd] .'</p>'; 
														?>
														<?php 
				                                    		/*if ($value['rating'] == 1) {
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



					                                    		}*/



					                                    	?>



													</div>



													<div class="code padding-5">



														<p class="text-center text-black"><span style="font-size:13px;">가입코드</span><b> : <?php echo $value['joinCode']; ?></b></p>



													</div>



												</div>



												<div class="playNow">

													<a href="#" class="btn btn-ask btn-w100" data-toggle = "modal" data-target="#exampleModal" id = "modalShow"><b>사이트 바로가기</b></a>

													<input type="hidden" class="hiddenpopup" name="popupjoincode" value="<?php echo $value['joinCode']; ?>">
													<input type="hidden" class="hiddenpopupweblink" name="popupweblink" value="<?php if(strpos($value['link'], 'http') !== false ) {echo $value['link'];} else {echo 'http://'.$value['link'];}?>">

												</div>



											</div><!-- front -->



											<div class="back">



												<div class="cardHeader">



													<a href="sports-details/<?php echo $value['id'];?>/<?php echo str_replace(' ', '-', $value['sportsName']);?>/"><h5 style="text-transform:uppercase;"><?php echo $value['sportsName']; ?></h5></a>



													<span class="pull-right fa fa-close info"></span>



												</div>



												<div class="sport-desc">



				                                	<ul class="information-list">



														<li>



															<div class="list-left">신규 첫충 보너스</div>



															<div class="list-right"><?php echo $value['welcomeBonus']; ?></div>



														</li>



														<li>



															<div class="list-left">최대 배팅금액</div>



															<div class="list-right"><?php echo $value['maxBettingAmount']; ?></div>



														</li>



														<li>



															<div class="list-left">최대 당첨금액</div>



															<div class="list-right"><?php echo $value['maxPrizeMoney']; ?></div>



														</li>



														<li>



																<div class="list-left">단폴더 제한</div>



																<div class="list-right"><?php echo $value['singleBet']; ?></div>



														</li>



														<li>



																<div class="list-left">하루 출금한도</div>



																<div class="list-right"><?php echo $value['maxWithdrawlLimit']; ?></div>



														</li>



														<!-- <li>



															<div class="list-left">졸업금액</div>



															<?php $v = explode(',', $value['miniGame']);?>



															<div class="list-right"><?php echo $v[0]; if (count($v) > 1) {



																echo ' etc...';



															}?> </div>



														</li> -->



													</ul>



													<div class="clearfix"></div>



													



												</div><!-- sport-desc -->



												<div class="getNow">



													<div class="text-center" style="position:relative;bottom:10px;">



														<a href="sports-details/<?php echo $value['id'];?>/<?php echo str_replace(' ', '-', $value['sportsName']);?>/" class="readMore">자세히 보기</a>



													</div>



													<a href="<?php echo $value['link'];?>" target="_blank" class="btn btn-ask btn-w100"><b>사이트 바로가기</b></a>



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



							<!-- mobile div -->



							<div class="ask-page-content-body ask-home-card onMobile">



							<?php



							//$result = $User->query("SELECT * FROM `tblWebCards` WHERE `isPin` = 'Y' ORDER BY `id` desc LIMIT 4");



							if(is_array($result) && count($result) > 0){



								foreach ($result as $key => $value) {



							?>



								<!-- mobile -->



								<div class="col-xs-12" id="formobile">



									<div class="media">



									  	<div class="media-left">



									  		<a href="sports-details/<?php echo $value['id'];?>/<?php echo str_replace(' ', '-', $value['sportsName']);?>/">



									    		<img src="<?php echo $value['sportsImage']; ?>" class="media-object mobile-mdeia-object">



									    	</a>



									  	</div>



									  	<div class="media-body">



									    	<a class="media-left-link" href="sports-details/<?php echo $value['id'];?>/<?php echo str_replace(' ', '-', $value['sportsName']);?>/"><h5 class="media-heading"><?php echo $value['sportsName']; ?></h5></a>



									    	<div class="rating font16">
												<?php
												$iddd = $value['id']; 
												echo '<p class="text-white" style="margin-bottom:2px;">'. $sportsExtraText[$iddd] .'</p>'; 
												?>


												<?php 

													/*

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



			                                    		} */



			                                    	?>



											</div>



											<p class="text-white mobile-join-code">가입코드<span> : <?php echo $value['joinCode']; ?></span></p>

											<div class="playNow">
												<a href="#" data-toggle = "modal" data-target="#exampleModal" id = "modalShow" class="btn btn-default mobile-button"><b>사이트 바로가기</b></a>

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



							<!-- extra -->



						</div><!-- verified sports -->



						<div class="clearfix"></div>



						<div class="ask-page-content">



							<div class="ask-page-content-header">



								<h3 class="text-uppercase"><a href="bonus/" class="text-white">보너스</a> <span class="pull-right" style="font-size:12px;line-height:30px;"><a href="bonus/" class="text-white">전체보기</a></span></h3><!--  border-bottom-5 -->



								<p class="custom-p custom-text">신규 첫충 보너스, 낙첨금 보너스, 첫충전 보너스 등 다양한 보너스를 함께 누려보세요!<br>자신이 찾고 있는 보너스가 있다면 쉽게 찾아 볼 수 있으며 배팅의 재미를 배로 느껴보실 수 있습니다.</p>



							</div>



							<div class="ask-page-content-body ask-home-card onDesktop">



								<?php



								$result = $User->query("SELECT `id`, `isPopular`, `bonusName`, `joinCode`, `bonusAmount`, `link`, `bonusCode`, `bonustype`, `wageringRequirements`, `sportsName`, `rating`, `bonusImage`, `imageName`, `description` FROM `tblBonusCards` ORDER BY `updatedOn` desc LIMIT 4");



								if(is_array($result) && count($result) > 0){



									foreach ($result as $key => $value) {				



								?>



								<div class="col-md-3 col-sm-3 col-xs-3 padding0">



									<div class="ask-cards">



										<div class="ask-item-web-card">


			                                <div class="front">
												<div class="cardHeader">
													<a href="bonus-details/<?php echo $value['id']?>/<?php echo $value['bonusName']?>"><h5><?php echo $value['bonusName']; ?></h5></a>
													<span class="pull-right fa fa-info info"></span>
												</div>
												<div class="cardLogo">
													
													<a href="bonus-details/<?php echo $value['id']?>/<?php echo $value['bonusName']?>"><img src="<?php echo $value['bonusImage'];?>" width="196px" height="132px" alt=""></a>

												</div>
												<div class="cardReview text-center text-black">

													<div class="rating padding-5 font16">

														<strong><?php echo $value['sportsName']; ?></strong>
												    </div>


													<div class="code padding-5">



														<p class="text-center text-black"><span style="font-size:13px;">가입코드</span><b> : <?php echo $value['joinCode']; ?></b></p>



													</div>



												</div>



												<div class="playNow">

													<a href="#" class="btn btn-ask btn-w100" data-toggle = "modal" data-target="#exampleModal" id = "modalShow"><b>사이트 바로가기</b></a>

													<input type="hidden" class="hiddenpopup" name="popupjoincode" value="<?php echo $value['joinCode']; ?>">
													<input type="hidden" class="hiddenpopupweblink" name="popupweblink" value="<?php if(strpos($value['link'], 'http') !== false ) {echo $value['link'];} else {echo 'http://'.$value['link'];}?>">

												</div>

											</div>


											<div class="back">



												<div class="cardHeader">



				                                    <a href="bonus-details/<?php echo $value['id']?>/<?php echo $value['bonusName']?>"><h5 class="text-uppercase"><?php echo $value['bonustype']; ?></h5></a>



				                                    <span class="pull-right fa fa-close info"></span>



				                                </div>



				                                <div class="bonus-desc">



				                                	<ul class="information-list">



														<li>



															<div class="list-left">보너스금액</div>



															<div class="list-right"><?php echo $value['bonusAmount']; ?></div>



														</li>



														<li>



															<div class="list-left">사이트</div>



															<div class="list-right"><?php echo $value['sportsName']; ?></div>



														</li>



														<li>



															<div class="list-left">롤링조건</div>



															<div class="list-right"><?php echo $value['wageringRequirements']; ?></div>



														</li>



														<li>



															<div class="list-left">보너스타입</div>



															<div class="list-right"><?php echo $value['bonustype']; ?></div>



														</li>



													</ul>



				                                </div>



				                                <div class="clearfix"></div>



				                                <div class="getNow">



				                                	<div class="text-center" style="position:relative;bottom:10px;font-size:14px;">



														<a href="bonus-details/<?php echo $value['id']?>/<?php echo $value['bonusName']?>" class="readMore">자세히 보기</a>



													</div>



				                                    <a href="http://<?php echo $value['link'];?>" class="btn btn-ask btn-w100"><b>사이트 바로가기</b></a>



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







							<div class="ask-page-content-body ask-home-card onMobile">



								<?php



								//$result = $User->query("SELECT `id`, `bonusName`, `joinCode`, `bonusAmount`, `link`, `bonusCode`, `bonustype`, `wageringRequirements`, `sportsName`, `rating`, `bonusImage`, `imageName` FROM `tblBonusCards` ORDER BY `updatedOn` desc LIMIT 4");



								if(is_array($result) && count($result) > 0){



									foreach ($result as $key => $value) {				



								?>



								<div class="col-xs-12" id="formobile">



										<div class="media">



										  	<div class="media-left">



										  		<a href="bonus-details/<?php echo $value['id']?>/<?php echo $value['bonusName']?>">



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



						</div><!-- bonus code -->



						<div class="clearfix"></div>



						<div class="ask-page-content">



							<div class="ask-page-content-header">



								<h3 class="text-uppercase"><a href="complaints/" class="text-white">사이트 분쟁해결</a><span class="pull-right" style="font-size:12px;line-height:30px;"><a href="complaints/" class="text-white">전체보기</a></span></h3><!--  border-bottom-5 -->



								<p class="custom-p custom-text">이용하시는 사이트와 문제가 있으신가요?<br>저희 배팅타임에서는 사이트와 유저 분의 갈등을 완만하게 해결 볼 수 있도록 도와드리고 있습니다.</p>



							</div>



							<div class="ask-page-content-body ask-home-card fordesktop">



							<?php



								$result = $User->query("SELECT `id`, `reason`, `siteName`, `complaintTitle`, `complaintText`, `amount`, `isVerified`, `status` FROM `tblComplaints` WHERE `isVerified` = 'Y'  ORDER BY `updatedOn` ASC LIMIT 4");



								if(is_array($result) && count($result) > 0){



									foreach ($result as $key => $value) {				



								?>



								<div class="col-md-3 col-sm-3 col-xs-3 padding0">



									<div class="ask-cards">



										<div class="ask-item-complain-card">



											<div class="front">



											<span class="pull-right fa fa-info info"></span>



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



												<a href="complaint-details/<?php echo $value['id'];?>/">



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



												</a>



												<a href="complaint-details/<?php echo $value['id'];?>/">



												<div class="complain-short-desc" style="padding-top: 0px;">



													<p><span class="text-capitalize"><b><?php echo $value['siteName']; ?></b></span> -<?php echo C::contentMorewithoutlink($value['complaintTitle'], 70); ?></p>



												</div>



												<div class="complain-Date" style="padding-top: 2px;">



													<p> <span style="line-height:32px;font-size:20px;font-weight:700;"><?php echo $value['amount']; ?> 만원</span><br>



														<span style="line-height:17px;"><?php echo $value['reason']; ?></span> </p>



												</div>



												</a>



											</div><!-- front -->



											<div class="back">



												<div class="complain-short-desc">



													<p><?php echo substr($value['complaintTitle'], 0, 45); ?><?php if (strlen($value['complaintTitle']) > 45) {



																echo '...';



															}?></p>



													<!-- <span class="pull-right fa fa-close info"></span> -->



												</div>



												<div class="complain-about">



													<!-- <p><?php echo $value['complaintText']; ?></p> -->







													<p class="text-center"><?php echo C::contentMorewithoutlink($value['complaintText'], 100); ?></p>



												</div>



												<div class="complaint-readmore">



													<div class="text-center">



														<a href="complaint-details/<?php echo $value['id'];?>/" class="readMore">자세히 보기</a>



													</div>



													<span class="pull-right fa fa-close info" style="margin-right: 6px;"></span>



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











							<div class="ask-page-content-body ask-home-card onMobile">



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



							?>



							</div><!-- ask-page-content-body -->







						</div><!-- Site News -->



						<div class="ask-page-content">



							<div class="ask-page-content-header">



								<h3 class="text-uppercase"><a href="site-news/" class="text-white">배팅사이트 소식</a> <span class="pull-right" style="font-size:12px;line-height:30px;"><a href="site-news/" class="text-white">전체보기</a></span></h3><!--  border-bottom-5 -->



								<p class="custom-p custom-text">새로운 이벤트, 새로운 기능, 새로운 컨텐츠.. 배팅타임에 등록된 배팅사이트들의 새로운 소식을 재빠르게 전달해드립니다.<br>이젠 배팅타임에서 모든 배팅사이트의 소식을 편하게 확인해보세요! </p>



							</div>



							<div class="ask-page-content-body ask-home-card onDesktop">



							<?php



								$result = $User->query("SELECT `id`, `title`, `newsDesc`, `newsImage`, `createdOn` FROM `tblNewsBlog` WHERE `isNews` = 'N' ORDER BY `createdOn` desc LIMIT 4");



								if(is_array($result) && count($result) > 0){



									foreach ($result as $key => $value) {				



							?>



								<div class="col-md-3 col-sm-3 col-xs-3 padding0 fordesktop">



									<div class="ask-cards">



										<div class="ask-item-news-card">



											<div class="front">



											<span class="pull-right fa fa-info info" style="top: 240px; padding: 5px 10px 19px;"></span>



												<div class="news-logo">



													<a href="news-details/<?php echo $value['id']; ?>/<?php echo str_replace(' ', '-', $value['title']); ?>/">



														<img src="<?php echo $value['newsImage']; ?>" class="img-responsive" alt="" />



													</a>



													



												</div>



												<a href="news-details/<?php echo $value['id']; ?>/<?php echo str_replace(' ', '-', $value['title']); ?>/">



													<div class="news-short-desc">

														<p class="text-black"><?php 
															mb_internal_encoding("UTF-8");
															$string = $value['title'];
															$mystring = mb_substr($string,0,81);
															$textlen=mb_strlen($string);
															if($textlen > 81){echo $mystring.'...';}
															else{echo $mystring;}

															?></p>

													</div>



													<div class="news-Date b">



														<?php 



														$date = explode(' ', $value['createdOn']);



														$date = $date[0];



														$date = date_create($date);



														 $postDate = date_format($date, 'Y-m-d')



														?>



														<p> <?php echo $postDate;?></p>



													</div>



												</a>



											</div><!-- front -->



											<div class="back">



												<div class="news-short-desc">



													<a href="news-details/<?php echo $value['id']; ?>/<?php echo str_replace(' ', '-', $value['title']); ?>/"><p class="text-black"><b><?php
															mb_internal_encoding("UTF-8");
															$string = $value['title'];
															$mystring = mb_substr($string,0,62);
															$textlen=mb_strlen($string);
															if($textlen > 62){echo $mystring.'...';}
															else{echo $mystring;}

															?></b></p></a>



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



												<span class="pull-right fa fa-close info" style="top: 235px; padding: 4px 6px 19px;"></span>



											</div><!-- back -->



										</div><!-- ask-item-news-card -->



									</div>



								</div><!-- col-md-3 -->



							<?php



								}



							}



							?>



							</div><!-- ask-page-content-body -->



							



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



												$date = explode(' ', $value['updatedOn']);



												$date = $date[0];



												$date = date_create($date);



											 	$postDate = date_format($date, 'F d , Y')



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



						</div><!-- Site News -->



						<div class="clearfix"></div>



						<div class="ask-page-content">



							<div class="ask-page-content-header">



								<h3 class="text-uppercase"><a href="blog/" class="text-white">블로그</a><span class="pull-right" style="font-size:12px;line-height:30px;"><a href="blog/" class="text-white">전체보기</a></span></h3><!--  border-bottom-5 -->



								<p class="custom-p custom-text">"블로그"에서는 모든 핫 이슈에 대해 전체적으로 다루고 있습니다.<br>평소에 우리가 알지 못했고 궁금했던 부분들을 배팅타임에서 시원하게 파헤쳐 보겠습니다! </p>



							</div>



							<div class="ask-page-content-body ask-home-card onDesktop">



							<?php



								$result = $User->query("SELECT `id`, `title`, `newsDesc`, `newsImage`, `createdOn` FROM `tblNewsBlog` WHERE `isNews` = 'B' ORDER BY `createdOn` desc LIMIT 4");



								if(is_array($result) && count($result) > 0){



									foreach ($result as $key => $value) {				



							?>



								<div class="col-md-3 col-sm-3 col-xs-3 padding0">



									<div class="ask-cards">



										<div class="ask-item-news-card">



											<div class="front">



												<span class="pull-right fa fa-info info" style="top: 240px; padding: 5px 10px 19px;"></span>



												<div class="news-logo">



													<a href="news-details/<?php echo $value['id']; ?>/<?php echo str_replace(' ', '-', $value['title']); ?>/">



														<img src="<?php echo $value['newsImage']; ?>" class="img-responsive" alt="" />



													</a>



												</div>



												<a href="news-details/<?php echo $value['id']; ?>/<?php echo str_replace(' ', '-', $value['title']); ?>/">



													<div class="news-short-desc">



														<p class="text-black"><?php 
															mb_internal_encoding("UTF-8");
															$string = $value['title'];
															$mystring = mb_substr($string,0,33);
															$textlen=mb_strlen($string);
															if($textlen > 33){echo $mystring.'...';}
															else{echo $mystring;}
															?></p>



													</div>



													<div class="news-Date a">



														<?php 



														$date = explode(' ', $value['createdOn']);



														$date = $date[0];



														$date = date_create($date);



														 $postDate = date_format($date, 'Y-m-d')



														?>



														<p> <?php echo $postDate;?></p>



													</div>



												</a>



											</div><!-- front -->



											<div class="back">



												<div class="news-short-desc">



													<a href="news-details/<?php echo $value['id']; ?>/<?php echo str_replace(' ', '-', $value['title']); ?>/"><p class="text-black"><b><?php 
															mb_internal_encoding("UTF-8");
															$string = $value['title'];
															$mystring = mb_substr($string,0,62);
															$textlen=mb_strlen($string);
															if($textlen > 62){echo $mystring.'...';}
															else{echo $mystring;}

															?></b></p></a>



													<!-- <span class="pull-right fa fa-close info"></span> -->



												</div>



												<div class="news-about">



													<p class="text-center" style="text-align: center;"><?php 
															mb_internal_encoding("UTF-8");
															$string = $value['newsDesc'];
															$mystring = mb_substr($string,0,201);
															echo $mystring.'...';
													?></p>



												</div>



												<div class="news-reamore">



													<div class="text-center">



														<a href="news-details/<?php echo $value['id'].'/'.str_replace(' ', '-', $value['title']).'/';?>" class="readMore">자세히 보기</a>



													</div>



												</div>



												<span class="pull-right fa fa-close info" style="top: 235px; padding: 4px 6px 19px;"></span>



											</div><!-- back -->



										</div><!-- ask-item-news-card -->



									</div>



								</div><!-- col-md-3 -->



							<?php



								}



							}



							?>



						</div><!-- Site News -->







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



											$date = explode(' ', $value['updatedOn']);



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



						<div class="clearfix"></div>



					</div><!-- col-lg-9 col-md-9 -->



				</div><!-- row -->



			</div><!-- ask-content -->



		</div><!-- parent-container -->

	</div>



<?php require_once('includes/doc_footer.php'); ?>



