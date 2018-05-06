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

$page = 'advertise';

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
									$result = $User->query("SELECT `categoryTitle`, `categoryContent` FROM `tblContent` WHERE `categoryPage` = 'advertise' LIMIT 1");
									if(isset($result) && count($result) > 0){
								?>
								<h3 class="text-uppercase"><?php echo $result[0]['categoryTitle']; ?> </h3><!--  border-bottom-5 -->
								<?php
								}
								?>
							</div>
							<div class="ask-page-content-body"><!--  -->
								<div class="content" style="margin-top: -11px; margin-left: 0px; padding-top: 0px;">
									<article class="text-white"><?php echo $result[0]['categoryContent']; ?></article>
								</div>
							</div>
						</div>
					</div><!-- col-lg-9 col-md-9 -->
					<div class="col-lg-3 col-md-3" style="padding-left: 0px;">
						<?php require_once('includes/sportsRecommend.php'); ?>
					</div>
				</div><!-- row -->
			</div><!-- ask-content -->
		</div><!-- parent-container -->
<?php require_once('includes/doc_footer.php'); ?>