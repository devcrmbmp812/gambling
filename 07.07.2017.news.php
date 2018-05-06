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
        $dtl = "N";
        break;
    case "B":
        $dtl = "B";
        break;
    // default:
    //     echo "!!!!!!";
}
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
							<div class="ask-page-content-body"><!--  -->
								<?php
								$pagination = '';
								$page = (isset($_GET['__pGI']) && (int)$_GET['__pGI'] > 0 ? (int)$_GET['__pGI'] : 1);
								$limit = 12;
								$pullSQL = ' LIMIT ' . (($page - 1) * $limit) . ', ' . $limit;
								# [Pagination] instantiate; Set current page; set number of records
								$result = $User->query("SELECT SQL_CALC_FOUND_ROWS `id`, `title`, `newsDesc`, `newsImage`, `updatedOn` FROM `tblNewsBlog` WHERE `isNews` = '" . $dtl . "'" . $pullSQL);
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
												<span class="pull-right fa fa-info info" style="top: 254px; padding: 6px 10px 19px;"></span>
												<div class="news-logo">
													<a href="news-details/<?php echo $value['id']; ?>/<?php echo str_replace(' ', '-', $value['title']); ?>/">
														<img src="<?php echo $value['newsImage']; ?>" class="img-responsive" alt="" />
													</a>
												</div>
												<a href="news-details/<?php echo $value['id']; ?>/<?php echo str_replace(' ', '-', $value['title']); ?>/">
													<div class="news-short-desc">
														<p class="text-black"><?php echo $value['title']; ?></p>
													</div>
													<div class="news-Date">
														<?php 
													$date = explode(' ', $value['updatedOn']);
													$date = $date[0];
													$date = date_create($date);
													 $postDate = date_format($date, 'F d , Y')
													?>
													<p> <?php echo $postDate;?></p>
													</div>
												</a>
											</div><!-- front -->
											<div class="back">
												<div class="news-short-desc">
													<a href="news-details/<?php echo $value['id']; ?>/<?php echo str_replace(' ', '-', $value['title']); ?>/"><p class="text-black"><b><?php echo $value['title']; ?></b></p></a>
													<!--<span class="pull-right fa fa-close info"></span>-->
												</div>
												<div class="news-about">
													<p class="text-justify"><?php echo C::contentMorewithoutlink($value['newsDesc'], 150); ?></p>
												</div>
												<div class="news-reamore">
													<div class="text-center">
														<a href="news-details/<?php echo $value['id'].'/'.str_replace(' ', '-', $value['title']).'/';?>" class="readMore">Read More</a>
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