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

	        $dtl = "신규 첫충 보너스";

	        $page = '신규 첫충 보너스';

	        break;

	    case "FSD":

	        $dtl = "첫충전 보너스";

	        $page = '첫충전 보너스';

	        break;

	    case "ETB":

	        $dtl = "매번 충전 보너스";

	        $page = '매번 충전 보너스';

	        break;

	    case "RB":

	        $dtl = "롤링 보너스";

	        $page = '롤링 보너스';

	        break;

	    case "FM":

	        $dtl = "꽁머니 보너스";

	        $page = '꽁머니 보너스';

	        break;

	    case "CB":

	        $dtl = "다폴더 보너스";

	        $page = '다폴더 보너스';

	        break;

		case "REB":

	        $dtl = "낙첨금 보너스";

	        $page = '낙첨금 보너스';

	        break;

		case "OB":

	        $dtl = "기타 보너스";

	        $page = '기타 보너스';

	        break;

	    // default:

	    //     echo "!!!!!!";

	}

} else {

	$dtl = 'Bonus';

	$page = 'bonus';

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

							<div class="ask-page-content-body AJAX-response onDesktop">

							<?php

								$setArray = array(

									"신규 첫충 보너스",

									"첫충전 보너스",

									"매번 충전 보너스",

									"롤링 보너스",

									"꽁머니 보너스",

									"다폴더 보너스",

									"낙첨금 보너스",

									"기타 보너스"

								);

								if($cat){

									$setArray = array($dtl);

								}

								//foreach($setArray as $idx => $key){

								//$dtl = $key;

								$pagination = '';

								$page = (isset($_GET['__pGI']) && (int)$_GET['__pGI'] > 0 ? (int)$_GET['__pGI'] : 1);

								$limit = 21;

								$pullSQL = ' LIMIT ' . (($page - 1) * $limit) . ', ' . $limit;

								# [Pagination] instantiate; Set current page; set number of records



								$sql = "SELECT SQL_CALC_FOUND_ROWS `id`, `bonusName`, `joinCode`, `bonusAmount`, `link`, `bonusCode`, `bonustype`, `wageringRequirements`, `sportsName`, `rating`, `bonusImage`, `imageName`, `description` FROM `tblBonusCards` WHERE `bonusType` IN ('" . implode("','", $setArray) . "')";



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

										<div class="ask-item-web-card" style="height: 292px ! important;">

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

										        	<a href="#" class="btn btn-ask btn-w100" data-toggle = "modal" data-target="#exampleModal" id = "modalShow"><b>GET NOW</b></a>

													<input type="hidden" class="hiddenpopup" name="popupjoincode" value="<?php echo $data['joinCode']; ?>">
													<input type="hidden" class="hiddenpopupweblink" name="popupweblink" value="<?php if(strpos($data['link'], 'http') !== false ) {echo $data['link'];} else {echo 'http://'.$data['link'];}?>">

										        </div>

										    </div>
										    <!-- front -->

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

													<div class="playNow">

											        	<a href="#" class="btn btn-ask btn-w100" data-toggle = "modal" data-target="#exampleModal" id = "modalShow"><b>GET NOW</b></a>

														<input type="hidden" class="hiddenpopup" name="popupjoincode" value="<?php echo $data['joinCode']; ?>">
														<input type="hidden" class="hiddenpopupweblink" name="popupweblink" value="<?php if(strpos($data['link'], 'http') !== false ) {echo $data['link'];} else {echo 'http://'.$data['link'];}?>">

											        </div>

				                                </div>

											</div><!-- back -->

										</div>
										<!-- ask-item-bonus-card -->

									</div>

								</div><!-- col-md-3 -->

								<?php

									}

								}

								?>

								

							</div>

							<div class="ask-page-content-body AJAX-response1 onMobile">

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

										        	<a href="#" class="btn btn-default mobile-button" data-toggle = "modal" data-target="#exampleModal" id = "modalShow"><b>GET NOW</b></a>

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