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



if(isset($_GET['cat']) && trim($_GET['cat'])){

	$dtl = trim($_GET['cat']);

	//$dtl = $dtl['1'];



	switch ($dtl) {

    case "SN":

        $page = $dtl = "N";

        break;

    case "B":

        $page = $dtl = "B";

        break;

    // default:

    //     echo "!!!!!!";

}

}





?>

<?php require_once('includes/doc_head.php'); ?>
<style>#fixed-right{margin-top:5px;}</style>
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

							<div class="ask-page-content-body onDesktop"><!--  -->

								<?php

								$pagination = '';

								$page = (isset($_GET['__pGI']) && (int)$_GET['__pGI'] > 0 ? (int)$_GET['__pGI'] : 1);

								$limit = 21;

								$pullSQL = ' LIMIT ' . (($page - 1) * $limit) . ', ' . $limit;

								# [Pagination] instantiate; Set current page; set number of records

								$result = $User->query("SELECT SQL_CALC_FOUND_ROWS `id`, `title`, `newsDesc`, `newsImage`, `createdOn` FROM `tblNewsBlog` WHERE `isNews` = '" . $dtl . "' ORDER BY `createdOn` DESC" . $pullSQL);

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

										<div class="ask-item-news-card">

											<div class="front">

												<span class="pull-right fa fa-info info"></span>

												<div class="news-logo">

													<a href="news-details/<?php echo $value['id']; ?>/<?php echo str_replace(' ', '-', $value['title']); ?>/">

														<img src="<?php echo $value['newsImage']; ?>" class="img-responsive" alt="" />

													</a>

												</div>

												<a href="news-details/<?php echo $value['id']; ?>/<?php echo str_replace(' ', '-', $value['title']); ?>/">

													<div class="news-short-desc">

														<p class="text-black"><?php echo substr($value['title'], 0, 81); ?></p>

													</div>

													<div class="news-Date">

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

													<a href="news-details/<?php echo $value['id']; ?>/<?php echo str_replace(' ', '-', $value['title']); ?>/"><p class="text-black"><b><?php echo substr($value['title'], 0, 62); ?></b></p></a>

													<!--<span class="pull-right fa fa-close info"></span>-->

												</div>

												<div class="news-about">

													<p class="text-center"><?php //echo C::contentMorewithoutlink($value['newsDesc'], 150); ?><?php echo substr($value['newsDesc'], 0, 201);
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

												<span class="pull-right fa fa-close info" style="top: 250px; padding: 4px 6px 19px;"></span>

											</div><!-- back -->

										</div><!-- ask-item-news-card -->

									</div>

								</div><!-- col-md-3 -->

								<?php

								}

							}

							?>

							</div>



							<div class="ask-page-content-body onMobile"><!--  -->

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

											$date = explode(' ', $value['createdOn']);

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

							</div>

							<!-- extra -->

							<nav class="text-center">

							  	<?php echo $pagination; ?>

							</nav>

						</div><!-- verified sports landing -->

					</div><!-- col-lg-9 col-md-9 -->

					<div class="col-lg-3 col-md-3" style="padding-left: 0px;">

						<?php require_once('includes/sportsRecommend.php'); ?>

					</div>

				</div><!-- row -->

			</div><!-- ask-content -->

		</div><!-- parent-container -->

<?php require_once('includes/doc_footer.php'); ?>