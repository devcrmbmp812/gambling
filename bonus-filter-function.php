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



$pagination = '';
	$page = (isset($_GET['__pGI']) && (int)$_GET['__pGI'] > 0 ? (int)$_GET['__pGI'] : 1);
	$limit = 12;
	$pullSQL = ' LIMIT ' . (($page - 1) * $limit) . ', ' . $limit;
	# [Pagination] instantiate; Set current page; set number of records

	$sql = "SELECT SQL_CALC_FOUND_ROWS `id`, `bonusName`, `joinCode`, `bonusAmount`, `link`, `bonusCode`, `bonustype`, `wageringRequirements`, `sportsName`, `rating`, `bonusImage`, `imageName` FROM `tblBonusCards` WHERE `id` != '0'";

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

	if(isset($_GET['rating']) && $_GET['rating']!="") :
	    $sql.=" AND `rating` IN ('".implode("','",$_GET['rating'])."')";
	endif;

	// if(isset($_GET['rollingCondition']) && $_GET['rollingCondition']!="") :
	//     $sql.=" AND `rollingCondition` IN ('".implode("','",$_GET['rollingCondition'])."')";
	// endif;

	if(isset($_GET['wageringRequirements']) && $_GET['wageringRequirements']!="") :
	    $sql.=" AND `wageringRequirements` IN ('".implode("','",$_GET['wageringRequirements'])."')";
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

			$detailsLink = 'bonus-details/'.$data['id'].'/'.$data['bonusName'];

			if ($data['rating'] == 1) {
    			$ratinCon = '<i class="fa fa-star first" aria-hidden="true"></i><i class="fa fa-star-o" aria-hidden="true"></i></i><i class="fa fa-star-o" aria-hidden="true"></i></i><i class="fa fa-star-o" aria-hidden="true"></i></i><i class="fa fa-star-o" aria-hidden="true"></i></i>';
        		} else if($data['rating'] == 2){

    			$ratinCon = '<i class="fa fa-star second" aria-hidden="true"></i><i class="fa fa-star second" aria-hidden="true"></i><i class="fa fa-star-o" aria-hidden="true"></i></i><i class="fa fa-star-o" aria-hidden="true"></i></i><i class="fa fa-star-o" aria-hidden="true"></i></i>';
        		} else if($data['rating'] == 3){

    			$ratinCon = '<i class="fa fa-star third" aria-hidden="true"></i><i class="fa fa-star third" aria-hidden="true"></i><i class="fa fa-star third" aria-hidden="true"></i><i class="fa fa-star-o" aria-hidden="true"></i></i><i class="fa fa-star-o" aria-hidden="true"></i></i>';
        		} else if($data['rating'] == 4){

    			$ratinCon = '<i class="fa fa-star four" aria-hidden="true"></i><i class="fa fa-star four" aria-hidden="true"></i><i class="fa fa-star four" aria-hidden="true"></i><i class="fa fa-star four" aria-hidden="true"></i><i class="fa fa-star-o" aria-hidden="true"></i></i>';

        		} else if($data['rating'] == 5){

				$ratinCon = '<i class="fa fa-star five" aria-hidden="true"></i><i class="fa fa-star five" aria-hidden="true"></i><i class="fa fa-star five" aria-hidden="true"></i><i class="fa fa-star five" aria-hidden="true"></i><i class="fa fa-star five" aria-hidden="true"></i>';
				}
				$font12 = '';
				$marginbottom3 = '';
				$style = '';
				$font121 = '';
				$margintop0 = '';

				if(strlen($data['bonusName']) > 9){ $marginbottom3 = "margin-bottom-3";}
				if(mb_strlen($data['sportsName'], 'UTF-8') > 9){ $font12 = "font12";}
				if(mb_strlen($data['joinCode'], 'UTF-8') > 9){ $style = 'style="font-size:12px;padding-left:3px;padding-right:3px;"';}
				if(mb_strlen($data['bonusName'], 'UTF-8') > '7'){ $font121 = "font12"; $margintop0 = 'style="margin-top:0px;"';}
				//if(mb_strlen($data['bonusName'], 'UTF-8') > '7'){ $margintop0 = 'style="margin-top:0px;"';}


			echo '<div class="col-md-3 col-sm-3 col-xs-3 padding0 ask-land-web-card">
					<div class="ask-cards">
						<div class="ask-item-bonus-card" style="height: 292px ! important;">
							<div class="front">
								<div class="cardHeader">
                                    <a href="'.$detailsLink.'"><h5>'.$data['bonusName'].'</h5></a>
									<span class="fa fa-info info" style="font-size:14px;"></span>
                                </div>
                                <div class="cardLogo" style="overflow:hidden;">
                                    <a href="'.$detailsLink.'"><img src="'.$data['bonusImage'].'" class="img-responsive" style="height:149px;"  alt=""></a>
                                </div>
                                <div class="cardReview text-center text-black" style="overflow:hidden;">
                                    <div class="rating padding-5 font16">
                                    	<strong>'.$data['sportsName'].'</strong>
                                    </div>
                                    <div class="code padding-5">
                                    	<p class="text-center text-black"><span style="font-size:13px;">가입코드</span><b> : '.$data['joinCode'].'</b></p>
                                    </div>
                                </div>
                                
                                <div class="playNow" style="margin-top: -1px;">
                                	<a href="#" class="btn btn-ask btn-w100" data-toggle = "modal" data-target="#exampleModal" id = "modalShow"><b>사이트 바로가기</b></a>

									<input type="hidden" class="hiddenpopup" name="popupjoincode" value="'.$data['joinCode'].'">
									<input type="hidden" class="hiddenpopupweblink" name="popupweblink" value="';
								if(strpos($data["link"], "http") !== false ) 
									{echo $data["link"];} 
								else {echo 'http://'.$data["link"];}
									echo '">';
							echo '</div>
							</div>
							<div class="back">
								<div class="cardHeader">
                                    <a href="'.$detailsLink.'"><h5 class="text-uppercase">'.$data['bonustype'].'</h5></a>
                                    <span class="pull-right fa fa-close info"></span>
                                </div>
                                <div class="bonus-desc">
                                	<ul class="information-list">
										<li>
											<div class="list-left">Bonus</div>
											<div class="list-right">'.$data['bonusAmount'].'</div>
										</li>
										<li>
											<div class="list-left">Sports</div>
											<div class="list-right">'.$data['sportsName'].'</div>
										</li>
										<li>
											<div class="list-left">W.R</div>
											<div class="list-right">'.$data['wageringRequirements'].'</div>
										</li>
										<li>
											<div class="list-left">Type</div>
											<div class="list-right">'.$data['bonustype'].'</div>
										</li>
									</ul>
                                </div>
                                <div class="clearfix"></div>
                                
                                <div class="getNow">
                                	<div class="text-center" style="position:relative;bottom:10px;">
										<a href="'.$detailsLink.'" class="readMore">Read More</a>
									</div>
                                    <a href="http://'.$data['link'].'" class="btn btn-ask btn-w100"><b>GET NOW</b></a>
                                </div>
							</div>
					    </div>
					</div>
				</div>';
			}
		}
		?>