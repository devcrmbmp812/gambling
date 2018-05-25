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





$page = 'notice';

?>

<?php require_once('includes/doc_head.php'); ?>

			

			<div class="ask-content" id="ask-content">

				<div class="row">

					<div class="col-lg-3 col-md-3 col-lg-push-9 col-md-push-9" style="padding-left: 0px;">

						<?php require_once('includes/sportsRecommend.php'); ?>

					</div>

					<div class="col-lg-9 col-md-9 col-lg-pull-3 col-md-pull-3">

						<?php 

						if(isset($_GET['notice']) && trim($_GET['notice'])){

							$selectdId = $_GET['notice'];

							?>

						<div class="ask-page-content">

							<div class="ask-page-content-header">

								<h3 class="heading text-white text-uppercase">클릭한 공지사항 </h3><!--  border-bottom-5 -->

							</div>

							<div class="ask-page-content-body-details" style="overflow:hidden;">

							<?php

							$result = $User->query("SELECT `id`, `userId`, `noticeTitle`, `noticeText`, `isPined`, `updatedOn` FROM `tblNotice` WHERE `id` = '" . $selectdId . "'");

								if(is_array($result) && count($result) > 0){

									foreach ($result as $key => $value) {			

							?>

								<div class="content hvr-underline-from-center">

									<div class="arrow-content">

										<h5 class="page-header comment-preview-header margin-top-0">

											<?php

											if($value['isPined']=='Y'){

											?>

												<span class="text-red margin-right-5"><i class="fa fa-thumb-tack" aria-hidden="true"></i></span>

											<?php

											}

											?>

											<span class="text-yellow margin-right-5"><?php echo $value['noticeTitle']; ?></span>

											<?php

												$date = explode(' ', $value['updatedOn']);

											?>

											<span class="text-white"><?php echo $date[0]; ?></span>

										</h5>

										<div class="comment-show">

											<table class="ask-table">

												<tr>

													<td style="padding-bottom:10px;">

														<span><?php echo $value['noticeText']; ?></span>

													</td>

												</tr>

											</table>

										</div>

									</div>		

								</div>

							<?php

								}

							}

							?>

							</div>

						</div>		

						<?php }?>

						<div class="ask-page-content">

							<div class="ask-page-content-header">

								<h3 class="heading text-white text-uppercase">배팅타임 공지사항</h3><!--  border-bottom-5 -->

							</div>

							<div class="ask-page-content-body-details" style="overflow:hidden;">

							<?php

							if(!isset($selectdId)){

								$selectdId = 0;

							}

							$result = $User->query("SELECT `id`, `userId`, `noticeTitle`, `noticeText`, `isPined`, `updatedOn` FROM `tblNotice` WHERE `id` != '" . $selectdId . "' ORDER BY `updatedOn` DESC");

								if(is_array($result) && count($result) > 0){

									foreach ($result as $key => $value) {			

							?>

								<div class="content hvr-underline-from-center">

									<div class="arrow-content">

										<h5 class="page-header comment-preview-header margin-top-0">

											<?php

											if($value['isPined']=='Y'){

											?>

												<span class="text-red margin-right-5"><i class="fa fa-thumb-tack" aria-hidden="true"></i></span>

											<?php

											}

											?>

											<span class="text-yellow margin-right-5"><?php echo $value['noticeTitle']; ?></span>

											<?php

												$date = explode(' ', $value['updatedOn']);

											?>

											<span class="text-white notice_date_mobile"><?php echo $date[0]; ?></span>

										</h5>

										<div class="comment-show">

											<table class="ask-table">

												<tr>

													<td style="padding-bottom:10px;">

														<span><?php echo $value['noticeText']; ?></span>

													</td>

												</tr>

											</table>

										</div>

									</div>		

								</div>

							<?php

								}

							}

							?>

							</div>

						</div>

					</div><!-- col-lg-12 col-md-12 -->

				</div><!-- row -->

			</div><!-- ask-content -->

		</div><!-- parent-container -->

		<script>

			$(document).ready(function(){

			var _v = $(location).attr('hash');

		alert(_v);

});

		</script>

<?php require_once('includes/doc_footer.php'); ?>