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

		$sql = "SELECT SQL_CALC_FOUND_ROWS * FROM `tblWebCards` WHERE `id` != '0'";

		if(isset($_GET['miniGame']) && $_GET['miniGame']!="") {
			$miniGame = [];
			$case = $_GET['miniGame'];
			foreach ($case as $key => $clause) {
				$miniGame = "AND `miniGame` LIKE '%".$clause."%'";
		    	$sql.=" $miniGame";
			}
		}

		if(isset($_GET['welcomeBonus']) && $_GET['welcomeBonus']!="") :
		    $sql.=" AND `welcomeBonus` IN ('".implode("','",$_GET['welcomeBonus'])."')";
		endif;

		// if(isset($_GET['rating']) && $_GET['rating']!="") :
		//     $sql.=" AND `rating` IN ('".implode("','",$_GET['rating'])."')";
		// endif;

		if(isset($_GET['bettingOption']) && $_GET['bettingOption']!="") {
			$bettingOption = [];
			$case = $_GET['bettingOption'];
			foreach ($case as $key => $clause) {
				$bettingOption = "AND `bettingOption` LIKE '%".$clause."%'";
		    	$sql.=" $bettingOption";
			}
		}

		if(isset($_GET['dwMethods']) && $_GET['dwMethods']!="") :
		    $sql.=" AND `dwMethods` IN ('".implode("','",$_GET['dwMethods'])."')";
		endif;

		// if(isset($_GET['maxWithdrawlLimit']) && $_GET['maxWithdrawlLimit']!="") :
		//     $sql.=" AND `maxWithdrawlLimit` IN ('".implode("','",$_GET['maxWithdrawlLimit'])."')";
		// endif;

		if(isset($_GET['firstDepositeBonus']) && $_GET['firstDepositeBonus']!="") :
		    $sql.=" AND `firstDepositeBonus` IN ('".implode("','",$_GET['firstDepositeBonus'])."')";
		endif;

		if(isset($_GET['dailyBonus']) && $_GET['dailyBonus']!="") :
		    $sql.=" AND `dailyBonus` IN ('".implode("','",$_GET['dailyBonus'])."')";
		endif;

		if(isset($_GET['rebateBonus']) && $_GET['rebateBonus']!="") :
		    $sql.=" AND `rebateBonus` IN ('".implode("','",$_GET['rebateBonus'])."')";
		endif;

		if(isset($_GET['rollingBonus']) && $_GET['rollingBonus']!="") :
		    $sql.=" AND `rollingBonus` IN ('".implode("','",$_GET['rollingBonus'])."')";
		endif;

		if(isset($_GET['liveChat']) && $_GET['liveChat']!="") :
		    $sql.=" AND `liveChat` IN ('".implode("','",$_GET['liveChat'])."')";
		endif;

		// if(isset($_GET['established']) && $_GET['established']!="") :
		//     $sql.=" AND `established` IN ('".implode("','",$_GET['established'])."')";
		// endif;

		if(isset($_GET['maxPrizeMoney']) && $_GET['maxPrizeMoney']!="") :
		    $sql.=" AND `maxPrizeMoney` <= '" . $_GET['maxPrizeMoney'] . "'";
		endif;

		if(isset($_GET['maxBettingAmount']) && $_GET['maxBettingAmount']!="") :
		    $sql.=" AND `maxBettingAmount` <= '" . $_GET['maxBettingAmount'] . "'";
		endif;

		// if(isset($_GET['minBettingAmount']) && $_GET['minBettingAmount']!="") :
		//     $sql.=" AND `minBettingAmount` <= '" . $_GET['minBettingAmount'] . "'";
		// endif;

		$sql.=" ORDER BY `rating` DESC, `sportsType` ASC" . $pullSQL;

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
			$data = array();
			foreach ($result as $key => $value) {

				$detailsLink = 'mini-game-details/'.$value['id'].'/'.str_replace(' ', '-', $value['sportsName']).'/';

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
			
			echo	'<div class="col-xs-12" id="formobile">
						<div class="media">
						  	<div class="media-left">
						    	<img src="'.$value['sportsImage'].'" class="media-object mobile-mdeia-object">
						  	</div>
						  	<div class="media-body">
						    	<a class="media-left-link" href="'.$detailsLink.'"><h5 class="media-heading">'.$value['sportsName'].'</h5></a>
						    	<div class="rating font16">
									'.$ratinCon.'
								</div>
								<p class="text-white mobile-join-code">JOIN CODE<span> : '.$value['joinCode'].'</span></p>
								<a href="http://'.$value['link'].'" class="btn btn-default mobile-button"><b>PLAY NOW</b></a>
						  	</div>
						</div>
					</div><!--col-xs-12-->';
				}
			}
			?>
	


