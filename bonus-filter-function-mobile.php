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


			echo '<div class="col-xs-12" id="formobile">
					<div class="media">
					  	<div class="media-left">
					  		<a href="'.$detailsLink.'">
					    		<img src="'.$data['bonusImage'].'" class="media-object mobile-mdeia-object">
					    	</a>
					  	</div>
					  	<div class="media-body">
					    	<a class="media-left-link" href="'.$detailsLink.'"><h5 class="media-heading">'.$data['bonusName'].'</h5></a>
							<p class="text-white" style="margin-bottom: 5px;"><b>'.$data['bonusAmount'].'</b></p>
							<p class="text-green" style="margin-bottom: 5px;"><b>'.$data['sportsName'].'</b></p>
							<div class="playNow">
								
					        	<a href="#" class="btn btn-default mobile-button" data-toggle = "modal" data-target="#exampleModal" id = "modalShow"><b>사이트 바로가기</b></a>

								<input type="hidden" class="hiddenpopup" name="popupjoincode" value="'.$data['joinCode'].'">
								<input type="hidden" class="hiddenpopupweblink" name="popupweblink" value="';
								if(strpos($data['link'], 'http') !== false ) 
									{echo $data['link'];} 
								else {echo 'http://'.$data['link'];}
								echo '">';

				     echo '</div>
					  	</div>
					</div>
				</div><!--col-xs-12-->';
			}
		}
		?>