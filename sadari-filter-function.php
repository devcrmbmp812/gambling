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

	// if(isset($_GET['bettingOption']) && $_GET['bettingOption']!="") :
	//     $sql.=" AND `bettingOption` IN ('".implode("','",$_GET['bettingOption'])."')";
	// endif;

	if(isset($_GET['bettingOption']) && $_GET['bettingOption']!="") {
		$bettingOption = [];
		$case = $_GET['bettingOption'];
		foreach ($case as $key => $clause) {
			$bettingOption = "AND `bettingOption` LIKE '%".$clause."%'";
	    	$sql.=" $bettingOption";
		}
	}

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
			$detailsLink = 'sadari-details/'.$value['id'].'/'.str_replace(' ', '-', $value['sportsName']).'/';

				if($value['isHot'] == "H"){
					$hotNewType = '<span class="card-tag-red">HOT</span>';
				}else{
					$hotNewType = '<span class="card-tag-blue">NEW</span>';
				}


        		if ($value['rating'] == 1) {
    			$ratinCon = '<i class="fa fa-star first" aria-hidden="true"></i><i class="fa fa-star-o" aria-hidden="true"></i></i><i class="fa fa-star-o" aria-hidden="true"></i></i><i class="fa fa-star-o" aria-hidden="true"></i></i><i class="fa fa-star-o" aria-hidden="true"></i></i>';
        		} else if($value['rating'] == 2){
    			
    			$ratinCon = '<i class="fa fa-star second" aria-hidden="true"></i><i class="fa fa-star second" aria-hidden="true"></i><i class="fa fa-star-o" aria-hidden="true"></i></i><i class="fa fa-star-o" aria-hidden="true"></i></i><i class="fa fa-star-o" aria-hidden="true"></i></i>';
    			} else if($value['rating'] == 3){
    			
    			$ratinCon = '<i class="fa fa-star third" aria-hidden="true"></i><i class="fa fa-star third" aria-hidden="true"></i><i class="fa fa-star third" aria-hidden="true"></i><i class="fa fa-star-o" aria-hidden="true"></i></i><i class="fa fa-star-o" aria-hidden="true"></i></i>';
    			} else if($value['rating'] == 4){
    			$ratinCon = '<i class="fa fa-star four" aria-hidden="true"></i><i class="fa fa-star four" aria-hidden="true"></i><i class="fa fa-star four" aria-hidden="true"></i><i class="fa fa-star four" aria-hidden="true"></i><i class="fa fa-star-o" aria-hidden="true"></i></i>';
    			
            	} else if($value['rating'] == 5){
    			
				$ratinCon = '<i class="fa fa-star five" aria-hidden="true"></i><i class="fa fa-star five" aria-hidden="true"></i><i class="fa fa-star five" aria-hidden="true"></i><i class="fa fa-star five" aria-hidden="true"></i><i class="fa fa-star five" aria-hidden="true"></i>';
        		}


        		echo '<div class="col-md-3 col-sm-3 col-xs-3 padding0 ask-land-web-card">
						<div class="ask-cards">
							<div class="ask-item-web-card">
								<div class="front">
									<div class="cardHeader">
										<a href="'.$detailsLink.'"><h5>'.$value['sportsName'].'</h5></a>
										<span class="pull-right fa fa-info info"></span>
									</div>
									<div class="cardLogo">
										'.$hotNewType.'
										<a href="'.$detailsLink.'"><img src="'.$value['sportsImage'].'" width="196px" height="149px" alt=""></a>
									</div>
									<div class="cardReview text-center text-black">
										<div class="rating padding-5 font16">
											'.$ratinCon.'
										</div>
										<div class="code padding-5">
											<p class="text-center text-black"><span style="font-size:13px;">JOIN CODE</span><b> : '.$value['joinCode'].'</b></p>
										</div>
									</div>
									<div class="playNow" style="margin-top: -1px;">
										<a href="http://'.$value['link'].'" class="btn btn-ask btn-w100"><b>PLAY NOW</b></a>
									</div>
								</div>
								<div class="back">
									<div class="cardHeader">
										<a href="'.$detailsLink.'"><h5 style="text-transform:uppercase;">'.$value['sportsName'].'</h5></a>
										<span class="pull-right fa fa-close info"></span>
									</div>
									<div class="sport-desc">
	                                	<ul class="information-list">
											<li>
												<div class="list-left">Sadari Odd</div>
												<div class="list-right">'.$value['sadariOdd'].'</div>
											</li>
											<li>
												<div class="list-left">Wager</div>
												<div class="list-right">'.$value['wager'].'</div>
											</li>
											<li>
												<div class="list-left">Maximum Betting</div>
												<div class="list-right">'.$value['maximumBetting'].'</div>
											</li>
											<li>
												<div class="list-left">Rutin/Matin</div>
												<div class="list-right">'.$value['ruMatin'].'</div>
											</li>
											<li>
												<div class="list-left">Closing time</div>
												<div class="list-right">'.$value['closingTime'].'</div>
											</li>
										</ul>
										<div class="clearfix"></div>
										<div class="text-center" style="margin-top: 50px;">
											<a href="'.$detailsLink.'" class="readMore">Read More</a>
										</div>
									</div>
									<div class="getNow">
										<a href="http://'.$value['link'].'" class="btn btn-ask btn-w100"><b>PLAY NOW</b></a>
									</div>
								</div>
							</div>
						</div>
					</div>';
				}
			}
					?>