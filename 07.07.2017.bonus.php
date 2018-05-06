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

$cat = false;
if(isset($_GET['cat']) && trim($_GET['cat'])){
	$cat = true;
	$dtl = trim($_GET['cat']);
	//$dtl = $dtl['1'];

	switch ($dtl) {
	    case "WB":
	        $dtl = "Welcome Bonus";
	        break;
	    case "FSD":
	        $dtl = "First Deposite Bonus";
	        break;
	    case "ETB":
	        $dtl = "Every Time Bonus";
	        break;
	    case "RB":
	        $dtl = "Rolling Bonus";
	        break;
	    case "FM":
	        $dtl = "Free Money";
	        break;
	    case "CB":
	        $dtl = "Combo Bonus";
	        break;
		case "REB":
	        $dtl = "Rebate Bonus";
	        break;
		case "OB":
	        $dtl = "Other Bonus";
	        break;
	    // default:
	    //     echo "!!!!!!";
	}
} else {
	$dtl = 'Bonus';
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
								<h3 class="text-uppercase"><?php echo $result[0]['categoryTitle']; ?> </h3><!--  border-bottom-5 -->
								<article class="text-white custom-text"><?php echo $result[0]['categoryContent']; ?></article>
								<?php
								}
								?>
							</div>
							<div class="ask-page-content-body AJAX-response">
							<?php
								$setArray = array(
									"Welcome Bonus",
									"First Deposite Bonus",
									"Every Time Bonus",
									"Rolling Bonus",
									"Free Money",
									"Combo Bonus",
									"Rebate Bonus",
									"Other Bonus"
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

								$sql = "SELECT SQL_CALC_FOUND_ROWS `id`, `bonusName`, `joinCode`, `bonusAmount`, `link`, `bonusCode`, `bonustype`, `wageringRequirements`, `sportsName`, `rating`, `bonusImage`, `imageName` FROM `tblBonusCards` WHERE `bonusType` IN ('" . implode("','", $setArray) . "')";

								if(isset($_GET['minDepositeAmpount']) && $_GET['minDepositeAmpount']!="") :
								    //$sql.=" AND `minDepositeAmpount` <= '" . $_GET['minDepositeAmpount'] . "'";
									$sql.=" AND `minDepositeAmpount` IN ('".implode("','",$_GET['minDepositeAmpount'])."')";
								endif;

								if(isset($_GET['maxBonusAmount']) && $_GET['maxBonusAmount']!="") :
								    $sql.=" AND `maxBonusAmount` <= '" . $_GET['maxBonusAmount'] . "'";
								endif;

								if(isset($_GET['maxCashout']) && $_GET['maxCashout']!="") :
								    $sql.=" AND `maxCashout` <= '" . $_GET['maxCashout'] . "'";
								endif;

								if(isset($_GET['bonusAmount']) && $_GET['bonusAmount']!="") :
								    $sql.=" AND `bonusAmount` IN ('".implode("','",$_GET['bonusAmount'])."')";
								endif;

								if(isset($_GET['wageringRequirements']) && $_GET['wageringRequirements']!="") :
								    $sql.=" AND `wageringRequirements` IN ('".implode("','",$_GET['wageringRequirements'])."')";
								endif;

								if(isset($_GET['bonustype']) && $_GET['bonustype']!="") :
								    $sql.=" AND `bonustype` IN ('".implode("','",$_GET['bonustype'])."')";
								endif;

								if(isset($_GET['rating']) && $_GET['rating']!="") :
								    $sql.=" AND `rating` IN ('".implode("','",$_GET['rating'])."')";
								endif;

								if(isset($_GET['rollingCondition']) && $_GET['rollingCondition']!="") :
								    $sql.=" AND `rollingCondition` IN ('".implode("','",$_GET['rollingCondition'])."')";
								endif;

								if(isset($_GET['bonusConUtilization']) && $_GET['bonusConUtilization']!="") :
								    $sql.=" AND `bonusConUtilization` IN ('".implode("','",$_GET['bonusConUtilization'])."')";
								endif;

								if(isset($_GET['bonusWithdrawlCondition']) && $_GET['bonusWithdrawlCondition']!="") :
								    $sql.=" AND `bonusWithdrawlCondition` IN ('".implode("','",$_GET['bonusWithdrawlCondition'])."')";
								endif;

								$sql.=" ORDER BY `id` ASC, `bonusType` ASC" . $pullSQL;

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

									foreach ($result as $id => $data) {
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
				                                    <div class="cardReview text-center text-black <?php if(strlen($data['bonusName']) > 9){ echo "margin-bottom-3";}?>">
				                                    	<span class="bonus-name text-center text-uppercase <?php if(mb_strlen($data['sportsName'], 'UTF-8') > 9){ echo "font12";}?>"><?php echo $data['sportsName'];?></span>
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
				                                        	<p class="custom-border1">가입코드</p> <br>
				                                        	<span class="custom-border" <?php if(mb_strlen($data['joinCode'], 'UTF-8') > 9){ echo 'style="font-size:12px;padding-left:3px;padding-right:3px;"';}?>><?php echo $data['joinCode']; ?></span>
					                                    </div>
					                                </div>
				                                </div>
				                                <div class="mainView" style="overflow:hidden;">
			                                        <div class="bonus">
			                                            <div class="bonusAmount">
			                                                <span class="text-center"><?php echo $data['bonusAmount']; ?></span>
			                                            </div>
			                                            <div class="bonusType">
			                                                <span class="text-center text-uppercase <?php if(mb_strlen($data['bonusName'], 'UTF-8') > '7'){ echo "font12";}?>"><?php echo $data['bonusName'];?></span>
			                                            </div>
			                                        </div>
			                                    </div>
			                                    <div class="bonusCode text-center" <?php if(mb_strlen($data['bonusName'], 'UTF-8') > '7'){ echo 'style="margin-top:0px;"';}?>>
			                                        <span style="font-size:12px">BONUS CODE</span><br>
			                                        <span><b><?php echo $data['bonusCode']; ?></b></span>
			                                    </div>
				                                <div class="playNow custom-play-now" style="margin-top: 20px;">
													<a href="http://<?php echo $data['link'];?>" class="btn btn-ask btn-w100"><b>GET NOW</b></a>
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
				                                <div class="clearfix"></div>
				                                
				                                <div class="getNow">
				                                	<div class="text-center" style="position:relative;bottom:10px;">
														<a href="bonus-details/<?php echo $data['id']?>/<?php echo $data['bonusName']?>" class="readMore">Read More</a>
													</div>
				                                    <a href="http://<?php echo $data['link'];?>" class="btn btn-ask btn-w100"><b>GET NOW</b></a>
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
							<nav class="text-center">
							  	<?php echo $pagination;?>
							</nav>
						</div><!-- bonus code landing-->
					</div><!-- col-lg-9 col-md-9 -->
					<div class="col-lg-3 col-md-3" style="padding-left: 0px;">
						<?php require_once('includes/bonusFilter.php'); ?>
						<?php require_once('includes/sportsRecommend.php'); ?>
					</div>
				</div><!-- row -->
			</div><!-- ask-content -->
		</div><!-- parent-container -->
<?php require_once('includes/doc_footer.php'); ?>