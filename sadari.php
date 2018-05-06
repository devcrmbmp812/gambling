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


?>
<?php require_once('includes/doc_head.php'); ?>
			<div class="ask-content" id="ask-content">
				<div class="row">
					<div class="col-lg-9 col-md-9">
						<div class="ask-page-content ask-land-page-content">
							<div class="ask-page-content-header">
								<?php
									$result = $User->query("SELECT `categoryTitle`, `categoryContent` FROM `tblContent` WHERE `categoryPage` = 'Sadari sport' LIMIT 1");
									if(isset($result) && count($result) > 0){
								?>
								<h3 class="text-uppercase"><?php echo $result[0]['categoryTitle']; ?> </h3><!--  border-bottom-5 -->
								<article class="text-white custom-text"><?php echo $result[0]['categoryContent']; ?></article>
								<?php
								}
								?>
							</div>
							<div class="ask-page-content-body AJAX-response">
								<?php
								$pagination = '';
								$page = (isset($_GET['__pGI']) && (int)$_GET['__pGI'] > 0 ? (int)$_GET['__pGI'] : 1);
								$limit = 12;
								$pullSQL = ' LIMIT ' . (($page - 1) * $limit) . ', ' . $limit;
								# [Pagination] instantiate; Set current page; set number of records

								$sql = "SELECT SQL_CALC_FOUND_ROWS * FROM `tblSadariCards` WHERE `id` != '0'";

								if(isset($_GET['rating']) && $_GET['rating']!="") :
								    $sql.=" AND `rating` IN ('".implode("','",$_GET['rating'])."')";
								endif;

								if(isset($_GET['sadariOdd']) && $_GET['sadariOdd']!="") :
								    $sql.=" AND `sadariOdd` IN ('".implode("','",$_GET['sadariOdd'])."')";
								endif;

								if(isset($_GET['closingTime']) && $_GET['closingTime']!="") :
								    $sql.=" AND `closingTime` IN ('".implode("','",$_GET['closingTime'])."')";
								endif;

								if(isset($_GET['wager']) && $_GET['wager']!="") :
								    $sql.=" AND `wager` IN ('".implode("','",$_GET['wager'])."')";
								endif;

								if(isset($_GET['bettingOption']) && $_GET['bettingOption']!="") :
								    $sql.=" AND `bettingOption` IN ('".implode("','",$_GET['bettingOption'])."')";
								endif;
								// if(isset($_GET['bettingOption']) && $_GET['bettingOption']!="") {
								// 	$bettingOption = [];
								// 	$case = $_GET['bettingOption'];
								// 	foreach ($case as $key => $clause) {
								// 		$bettingOption = "AND `bettingOption` LIKE '%".$clause."%'";
								//     	$sql.=" $bettingOption";
								// 	}
								// }

								if(isset($_GET['rollingCondition']) && $_GET['rollingCondition']!="") :
								    $sql.=" AND `rollingCondition` IN ('".implode("','",$_GET['rollingCondition'])."')";
								endif;

								if(isset($_GET['maximumBetting']) && $_GET['maximumBetting']!="") :
								    $sql.=" AND `maximumBetting` < '" . $_GET['maximumBetting'] . "'";
								endif;

								if(isset($_GET['maxAwardAmount']) && $_GET['maxAwardAmount']!="") :
								    $sql.=" AND `maxAwardAmount` < '" . $_GET['maxAwardAmount'] . "'";
								endif;

								if(isset($_GET['minBettingAmount']) && $_GET['minBettingAmount']!="") :
								    $sql.=" AND `minBettingAmount` < '" . $_GET['minBettingAmount'] . "'";
								endif;

								$sql.=" ORDER BY `id` DESC" . $pullSQL;
								//$sql.=" ORDER BY `rating` DESC, `sportsType` ASC" . $pullSQL;
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
													<a href="sadari-details/<?php echo $value['id'];?>/<?php echo str_replace(' ', '-', $value['sportsName']);?>/"><h5><?php echo $value['sportsName']; ?></h5></a>
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
													<a href="sadari-details/<?php echo $value['id'];?>/<?php echo str_replace(' ', '-', $value['sportsName']);?>/"><img src="<?php echo $value['sportsImage']; ?>" width="196px" height="149px" alt=""></a>
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
													<a href="sadari-details/<?php echo $value['id'];?>/<?php echo str_replace(' ', '-', $value['sportsName']);?>/"><h5 style="text-transform:uppercase;"><?php echo $value['sportsName']; ?></h5></a>
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
															<div class="list-right">원<?php echo $value['maximumBetting']; ?></div>
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
														<a href="sadari-details/<?php echo $value['id'];?>/<?php echo str_replace(' ', '-', $value['sportsName']);?>/" class="readMore">Read More</a>
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
							<nav class="text-center">
							  	<?php echo $pagination; 
							  	/*
							  	<ul class="pagination ask-pagination">
							    	<li class=""><a href="#" aria-label="Previous"><span aria-hidden="true">&laquo;</span></a></li><!-- disabled -->
							    	<li class="active"><a href="#">1 <span class="sr-only">(current)</span></a></li>
							    	<li><a href="#">2</a></li>
								    <li><a href="#">3</a></li>
								    <li><a href="#">4</a></li>
								    <li><a href="#">5</a></li>
								    <li>
								      	<a href="#" aria-label="Next">
								        	<span aria-hidden="true">&raquo;</span>
								      	</a>
								    </li>
							  	</ul>
							  	*/
							  	?>
							</nav>
						</div><!-- verified sports landing -->
					</div><!-- col-lg-9 col-md-9 -->
					<div class="col-lg-3 col-md-3" style="padding-left: 0px;">
						<?php require_once('includes/sadari-filter.php'); ?>
						<?php require_once('includes/sportsRecommend.php'); ?>
					</div>
				</div><!-- row -->
			</div><!-- ask-content -->
		</div><!-- parent-container -->
<?php require_once('includes/doc_footer.php'); ?>
