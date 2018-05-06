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

 $page = 'mini-game';

if(isset($_GET['logout']) && trim($_GET['logout']) == 'logout'){
    UNSET($_SESSION['admin']);
    header("LOCATION:index.php");
}

// if(!$User->checkLoginStatus()){
// 	$Common->redirect('index.php');
// }

$cat = false;
if(isset($_GET['cat']) && trim($_GET['cat'])){
	$cat = true;
	$dtl = trim($_GET['cat']);
	//$dtl = str_replace('-', ' ', $_GET['cat']);
	//$dtl = $dtl['1'];

	switch ($dtl) {
	    case "OS":
	        $dtl = "Online sport";
	        break;
	    case "NS":
	        $dtl = "Newest sport";
	        break;
	    case "VS":
	        $dtl = "Verified sport";
	        break;
	    case "BS":
	        $dtl = "Bitcoin sport";
	        break;
	    case "MS":
	        $dtl = "Mobile sport";
	        break;
	    case "SS":
	        $dtl = "Sadari sport";
	        break;
	    // default:
	    //     echo "!!!!!!";
	}
} else {
	$dtl = 'Sports';
}


?>
<?php require_once('includes/doc_head.php'); ?>
			<div class="ask-content" id="ask-content">
				<div class="row">
					<div class="col-lg-9 col-md-9">
						<div class="ask-page-content ask-land-page-content">
							<div class="ask-page-content-header">
								<?php
									$result = $User->query("SELECT `categoryTitle`, `categoryContent` FROM `tblContent` WHERE `categoryPage` = '" . $dtl . "' LIMIT 1");
									if(isset($result) && count($result) > 0){
								?>
								<h3 class="text-uppercase">MINI GAMES</h3><!--  border-bottom-5 -->
								<article class="text-white custom-text">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Accusantium hic impedit assumenda voluptatem quis quaerat repudiandae ipsum facilis eum, neque. Omnis consectetur consequatur voluptatibus inventore numquam culpa dolores fuga velit!</article>
								<!-- <article class="text-white custom-text"><?php echo $result[0]['categoryContent']; ?></article> -->
								<?php
								}
								?>
							</div>
							<div class="ask-page-content-body AJAX-response onDesktop">
								<div class="clearfix"></div>
								<?php
								$setArray = array(
									"Online sport",
									"Newest sport",
									"Verified sport",
									"Bitcoin sport",
									"Mobile sport",
									"Sadari sport"
								);
								if($cat){
									$setArray = array($dtl);
								}
								//foreach($setArray as $idx => $key){
									//$dtl = $key;
									$pagination = '';
									$page = (isset($_GET['__pGI']) && (int)$_GET['__pGI'] > 0 ? (int)$_GET['__pGI'] : 1);
									$limit = 12;
									$pullSQL = ' LIMIT ' . (($page - 1) * $limit) . ', ' . $limit;
									# [Pagination] instantiate; Set current page; set number of records

									$sql = "SELECT SQL_CALC_FOUND_ROWS * FROM `tblWebCards` WHERE (`sportsType` LIKE '%" . $dtl . "%')";

									// if(isset($_GET['miniGame']) && $_GET['miniGame']!="") {
									// 	$miniGame = [];
									// 	$case = $_GET['miniGame'];
									// 	foreach ($case as $key => $clause) {
									// 		$miniGame = "AND `miniGame` LIKE '%".$clause."%'";
									//     	$sql.=" $miniGame";
									// 	}
									// }

									if(isset($_GET['welcomeBonus']) && $_GET['welcomeBonus']!="") :
									    $sql.=" AND `welcomeBonus` IN ('".implode("','",$_GET['welcomeBonus'])."')";
									endif;

									if(isset($_GET['rating']) && $_GET['rating']!="") :
									    $sql.=" AND `rating` IN ('".implode("','",$_GET['rating'])."')";
									endif;

									// if(isset($_GET['bettingOption']) && $_GET['bettingOption']!="") :
									//     $sql.=" AND `bettingOption` IN ('".implode("','",$_GET['bettingOption'])."')";
									// endif;
									
									// if(isset($_GET['bettingOption']) && $_GET['bettingOption']!="") {
									// 	$bettingOption = [];
									// 	$case = $_GET['bettingOption'];
									// 	foreach ($case as $key => $clause) {
									// 		$bettingOption = "AND `bettingOption` LIKE '%".$clause."%'";
									//     	$sql.=" $bettingOption";
									// 	}
									// }

									if(isset($_GET['dwMethods']) && $_GET['dwMethods']!="") :
									    $sql.=" AND `dwMethods` IN ('".implode("','",$_GET['dwMethods'])."')";
									endif;

									if(isset($_GET['maxWithdrawlLimit']) && $_GET['maxWithdrawlLimit']!="") :
									    $sql.=" AND `maxWithdrawlLimit` IN ('".implode("','",$_GET['maxWithdrawlLimit'])."')";
									endif;

									if(isset($_GET['firstDepositeBonus']) && $_GET['firstDepositeBonus']!="") :
									    $sql.=" AND `firstDepositeBonus` IN ('".implode("','",$_GET['firstDepositeBonus'])."')";
									endif;

									if(isset($_GET['dailyBonus']) && $_GET['dailyBonus']!="") :
									    $sql.=" AND `dailyBonus` IN ('".implode("','",$_GET['dailyBonus'])."')";
									endif;
									if(isset($_GET['link']) && $_GET['link']!="") :
									    $sql.=" AND `link` IN ('".implode("','",$_GET['link'])."')";
									endif;

									if(isset($_GET['rebateBonus']) && $_GET['rebateBonus']!="") :
									    $sql.=" AND `rebateBonus` IN ('".implode("','",$_GET['rebateBonus'])."')";
									endif;
									if(isset($_GET['crossBetting']) && $_GET['crossBetting']!="") :
									    $sql.=" AND `crossBetting` IN ('".implode("','",$_GET['crossBetting'])."')";
									endif;

									if(isset($_GET['rollingBonus']) && $_GET['rollingBonus']!="") :
									    $sql.=" AND `rollingBonus` IN ('".implode("','",$_GET['rollingBonus'])."')";
									endif;

									if(isset($_GET['liveChat']) && $_GET['liveChat']!="") :
									    $sql.=" AND `liveChat` IN ('".implode("','",$_GET['liveChat'])."')";
									endif;

									if(isset($_GET['established']) && $_GET['established']!="") :
									    $sql.=" AND `established` IN ('".implode("','",$_GET['established'])."')";
									endif;

									if(isset($_GET['maxPrizeMoney']) && $_GET['maxPrizeMoney']!="") :
									    $sql.=" AND `maxPrizeMoney` <= '" . $_GET['maxPrizeMoney'] . "'";
									endif;

									if(isset($_GET['maxBettingAmount']) && $_GET['maxBettingAmount']!="") :
									    $sql.=" AND `maxBettingAmount` <= '" . $_GET['maxBettingAmount'] . "'";
									endif;

									if(isset($_GET['minBettingAmount']) && $_GET['minBettingAmount']!="") :
									    $sql.=" AND `minBettingAmount` <= '" . $_GET['minBettingAmount'] . "'";
									endif;

									$sql.=" ORDER BY `rating` DESC, `sportsType` ASC" . $pullSQL;
									//echo $sql;

									$result = $User->query($sql);
									if(is_array($result) && count($result) > 0){
										C::loadLib('Pagination/Pagination');
										$pagination = (new Pagination());
										$pagination->setCurrent($page);
										$pagination->setRPP($limit);
										$pagination->setTotal($User->getFoundRows());
										$pagination->addClasses(array('pagination', 'ask-pagination'));

										# [Pagination] grab rendered/parsed pagination markup
										$pagination = $pagination->parse();
										foreach ($result as $key => $value) {
									?>
									<div class="col-md-3 col-sm-3 col-xs-3 padding0 ask-land-web-card">
									
										<div class="ask-cards">
											<div class="ask-item-web-card">
												<div class="front">
													<div class="cardHeader">
														<a href="mini-game-details/<?php echo $value['id'];?>/<?php echo str_replace(' ', '-', $value['sportsName']);?>/"><h5><?php echo $value['sportsName']; ?></h5></a>
														<span class="pull-right fa fa-info info"></span>
													</div>
													<div class="cardLogo">
														<?php
														if($value['isHot'] == "H"){
														?>
														<span class="card-tag-red">HOT</span>
														<?php
														} elseif($value['isHot'] == "N"){
														?>
														<span class="card-tag-blue">NEW</span>
														<?php
														}
														else
														{
														?>
														<span class="card-tag-private">비공개</span>
															<?php
														}
														?>
														<a href="mini-game-details/<?php echo $value['id'];?>/<?php echo str_replace(' ', '-', $value['sportsName']);?>/"><img src="<?php echo $value['sportsImage']; ?>" width="196px" height="149px" alt=""></a>
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
													<div class="playNow" style="margin-top: -1px;"><!-- custom-play-now -->
														<a href="http://<?php echo $value['link'];?>" class="btn btn-ask btn-w100"><b>PLAY NOW</b></a>
													</div>
												</div><!-- front -->
												<div class="back">
													<div class="cardHeader">
														<a href="mini-game-details/<?php echo $value['id'];?>/<?php echo str_replace(' ', '-', $value['sportsName']);?>/"><h5 style="text-transform:uppercase;"><?php echo $value['sportsName']; ?></h5></a>
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
																<div class="list-right">원<?php echo $value['maxPrizeMoney']; ?></div>
															</li>
															<li>
																<div class="list-left">Cross Betting</div>
																<div class="list-right"><?php echo $value['crossBetting']; ?></div>
															</li>
															<li>
																<div class="list-left">Single Bet</div>
																<div class="list-right"><?php echo $value['singleBet']; ?></div>
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
														<div class="text-center" style="margin-top: 50px;">
															<a href="mini-game-details/<?php echo $value['id'];?>/<?php echo str_replace(' ', '-', $value['sportsName']);?>/" class="readMore">Read More</a>
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
							//}
							?>
							</div>



							<div class="ask-page-content-body AJAX-response1 onMobile">
								<div class="clearfix"></div>
								<?php
							
							if(is_array($result) && count($result) > 0){
								foreach ($result as $key => $value) {
							?>
								<!-- mobile -->
								<div class="col-xs-12" id="formobile">
									<div class="media">
									  	<div class="media-left">
									    	<img src="<?php echo $value['sportsImage']; ?>" class="media-object mobile-mdeia-object">
									  	</div>
									  	<div class="media-body">
									    	<a class="media-left-link" href="sports-details/<?php echo $value['id'];?>/<?php echo str_replace(' ', '-', $value['sportsName']);?>/"><h5 class="media-heading"><?php echo $value['sportsName']; ?></h5></a>
									    	<div class="rating font16">
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
											<p class="text-white mobile-join-code">JOIN CODE<span> : <?php echo $value['joinCode']; ?></span></p>
											<a href="http://<?php echo $value['link'];?>" class="btn btn-default mobile-button"><b>PLAY NOW</b></a>
									  	</div>
									</div>
								</div><!--col-xs-12-->
							<?php
								}
							}
							?>
							</div>
							<!-- extra -->
							<nav class="text-center">
							  	<?php echo $pagination; ?>
							</nav>
						</div><!-- verified sports landing -->
					</div><!-- col-lg-9 col-md-9 -->
					<div class="col-lg-3 col-md-3" style="padding-left: 0px;">
						<?php 
						require_once('includes/miniGameFilter.php');
						require_once('includes/sportsRecommend.php'); 
						?>
						
					</div>
				</div><!-- row -->
			</div><!-- ask-content -->
		</div><!-- parent-container -->
<?php require_once('includes/doc_footer.php'); ?>