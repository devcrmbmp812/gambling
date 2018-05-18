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



		if(isset($_GET['rating']) && $_GET['rating']!="") :

		    $sql.=" AND `rating` IN ('".implode("','",$_GET['rating'])."')";

		endif;



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



		if(isset($_GET['maxWithdrawlLimit']) && $_GET['maxWithdrawlLimit']!="") :

		    $sql.=" AND `maxWithdrawlLimit` IN ('".implode("','",$_GET['maxWithdrawlLimit'])."')";

		endif;



		if(isset($_GET['everytimeDepositeBonus']) && $_GET['everytimeDepositeBonus']!="") :

		    $sql.=" AND `everytimeDepositeBonus` IN ('".implode("','",$_GET['everytimeDepositeBonus'])."')";

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

		if(isset($_GET['singleBet']) && $_GET['singleBet']!="") :

		    $sql.=" AND `singleBet` IN ('".implode("','",$_GET['singleBet'])."')";

		endif;



		if(isset($_GET['liveChat']) && $_GET['liveChat']!="") :

		    $sql.=" AND `liveChat` IN ('".implode("','",$_GET['liveChat'])."')";

		endif;



		// if(isset($_GET['established']) && $_GET['established']!="") :

		//     $sql.=" AND `established` IN ('".implode("','",$_GET['established'])."')";

		// endif;



		if(isset($_GET['maxPrizeMoney']) && $_GET['maxPrizeMoney']!="") :

		$sql.=" AND `maxPrizeMoney` IN ('".implode("','",$_GET['maxPrizeMoney'])."')";

		endif;



		if(isset($_GET['maxBettingAmount']) && $_GET['maxBettingAmount']!="") :

				$sql.=" AND `maxBettingAmount` IN ('".implode("','",$_GET['maxBettingAmount'])."')";

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



				$detailsLink = 'sports-details/'.$value['id'].'/'.str_replace(' ', '-', $value['sportsName']).'/';



				if($value['isHot'] == "H"){

					$hotNewType = '<span class="card-tag-red">HOT</span>';

				} else if($value['isHot'] == "N"){

					$hotNewType = '<span class="card-tag-blue">NEW</span>';

				}else if($value['isHot'] == "0"){
					$hotNewType = '<span></span>';										

				} else {
					$hotNewType = '<span class="card-tag-private">비공개</span>';
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

			

			echo	'<div class="col-md-3 col-sm-3 col-xs-3 padding0 ask-land-web-card">

						<div class="ask-cards">

							<div class="ask-item-web-card" style="height: 292px ! important;">

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

											<p class="text-center text-black"><span style="font-size:13px;">가입코드</span><b> : '.$value['joinCode'].'</b></p>

										</div>

									</div>

									<div class="playNow" style="margin-top: -1px;"><!-- custom-play-now -->

										<a href="#" class="btn btn-ask btn-w100" data-toggle = "modal" data-target="#exampleModal" id = "modalShow"><b>사이트 바로가기</b></a>

										<input type="hidden" class="hiddenpopup" name="popupjoincode" value="'.$value['joinCode'].'">
										<input type="hidden" class="hiddenpopupweblink" name="popupweblink" value="';
										if(strpos($value['link'], 'http') !== false ) 
											{echo $value['link'];} 
										else {echo 'http://'.$value['link'];}
											echo '">';

									echo '</div>

								</div>

								<div class="back">

									<div class="cardHeader">

										<a href="'.$detailsLink.'"><h5 style="text-transform:uppercase;">'.$value['sportsName'].'</h5></a>

										<span class="pull-right fa fa-close info"></span>

									</div>

									<div class="sport-desc">

	                                	<ul class="information-list">

											<li>

												<div class="list-left">신규 첫충 보너스</div>

												<div class="list-right">'.$value['welcomeBonus'].'</div>

											</li>

											<li>

												<div class="list-left">최대 배팅금액</div>

												<div class="list-right">'.$value['maxBettingAmount'].'</div>

											</li>

											<li>

												<div class="list-left">최대 당첨금액</div>

												<div class="list-right">'.@$value['maxPrizeMoney'].'</div>

											</li>

											<li>

												<div class="list-left">단폴더 제한</div>

												<div class="list-right">'.$value['singleBet'].'</div>

											</li>

											<li>

												<div class="list-left">하루 출금한도</div>

												<div class="list-right">'.$value['maxWithdrawlLimit'].'</div>

											</li>

										</ul>

										<div class="clearfix"></div>

										<div class="text-center" style="margin-top: 50px;">

											<a href="'.$detailsLink.'" class="readMore">Read More</a>

										</div>

									</div>

									<div class="getNow">

										<a href="'.$value['link'].'" class="btn btn-ask btn-w100"><b>PLAY NOW</b></a>

									</div>

								</div>

							</div>

						</div>

					</div>';

				}

			}

			?>

	





