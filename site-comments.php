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

if(!$User->checkLoginStatus()){
	$Common->redirect('index.php');
}
$logedInID = ((int)User::loggedInUserId() > 0 ? User::loggedInUserId() : 0);
$groupId = $User->query("SELECT `siteName`, `groupId` FROM `tblUser` WHERE `id` = '" . $logedInID . "' LIMIT 1");
if ( $groupId[0]['groupId'] != 2) {
	$Common->redirect('index.php');
}else{
	$_SESSION['sitename'] = $groupId[0]['siteName'];
}

?>
<?php require_once('includes/doc_head.php'); ?>
	<div class="ask-content" id="ask-content">
		<div class="row">
		<div class="panel-group site-comment-pannel" id="accordion">

			<div class="col-lg-12 col-md-12 panel panel-default">
			 	<div class="text-white complain-form">
					<div class="ask-page-content-header panel-heading site-coment-arrow" data-toggle="collapse" data-parent="#accordion" href="#collapse2">
						<a class="text-uppercase">보너스 댓글</a>
						<span class="acc-drop pull-right rotate180" style="right: 26px; top: 10px;"></span>
					</div>
					<div class="ask-page-content-body-details panel-collapse collapse in" id="collapse2">

					<?php
						$res = $User->query("SELECT `id` FROM `tblWebCards` WHERE `siteName` = '" . $_SESSION['sitename'] . "'");
							if(is_array($res) && count($res) > 0){
								foreach ($res as $idx => $val) {
									$ids = $val['id'];
								}
							}
							if(isset($ids) && count($ids) > 0){
								$result = $User->query("SELECT `id`, `sportsId`, `userId`, `rating`, `gdComments`, `badComments`, `updatedOn` FROM `tblSportsComment` WHERE `isRecommanded`='Y' AND `sportsId`='" . $ids . "'");
									if(is_array($result) && count($result) > 0){
										foreach ($result as $key => $value) {
											

					?>
						<div class="content">
							<div class="arrow-content">
								<h5 class="page-header comment-preview-header margin-top-0">

								<?php
									$resuser = $User->query("SELECT `id`, `userId` FROM `tblUser` WHERE `id` = '" . $value['userId'] . "'");
										if(is_array($resuser) && count($resuser) > 0){
											foreach ($resuser as $index => $valuser) {
								?>
								<span class="text-yellow"><?php echo $valuser['userId'];?></span>
								<?php
									}
								}
								?>

								 님께서 댓글을 남겨주셨습니다. 
								 <a href="http://www.google.com" target="_blank">
								 <?php
									$bonus = $User->query("SELECT `id`, `sportsName` FROM `tblWebCards` WHERE `id` = '" . $value['sportsId'] . "'");
									if(is_array($bonus) && count($bonus) > 0){
										foreach ($bonus as $indexBonus => $valBonus) {
									?>
								 <span class="text-success text-uppercase"><?php echo $valBonus['sportsName'];?></span>
								 <?php
									}
								}
								?>
								 </a></h5>
								<div class="comment-show">
									<table class="ask-table">
										<tr>
											<td>좋은 점 : <span class="text-yellow"><?php echo $value['gdComments'];?></span></td>
										</tr>
										<tr>
											<td>나쁜 점 : <span class="text-yellow"><?php echo $value['badComments'];?></span></td>
										</tr>
										<tr>
											<td>
												<a href="comment-reply.php?cat=sports&id=<?php echo $value['id'];?>" class="btn btn-ask-red text-white">답장하기</a>
											</td>
										</tr>
									</table>
								</div>
							</div>
					 	</div>
					 	<?php

					 			}
					 		}
					 		else{

					 			echo '<div class="content">
					 			<p>No one commented on sports</p>
					 			</div>';
					 		}
					 	}
					 	?>
				 	</div>
				</div>

			</div><!-- col-lg-12 col-md-12 -->
			
			<div class="col-lg-12 col-md-12 panel panel-default">
			 	<div class="text-white complain-form">
					<div class="ask-page-content-header panel-heading site-coment-arrow" data-toggle="collapse" data-parent="#accordion" href="#collapse1">
						<a class="text-uppercase">스포츠 댓글</a>
						<span class="acc-drop pull-right rotate180" style="right: 26px; top: 10px;"></span>
					</div>
					<div class="ask-page-content-body-details panel-collapse collapse in" id="collapse1">

					<?php
					$res = $User->query("SELECT `id`, `sportsName` FROM `tblWebCards` WHERE `siteName` = '" . $_SESSION['sitename'] . "'");

						if(is_array($res) && count($res) > 0){
							foreach ($res as $idx => $val) {
								$sportsName = $val['sportsName'];
							}
						}
						$resBon = $User->query("SELECT `id` FROM `tblBonusCards` WHERE `sportsName` = '" . $sportsName . "'");

						$ids = array();
						if(is_array($resBon) && count($resBon) > 0){
							foreach ($resBon as $idxx => $valxx) {
								$ids = $valxx['id'];
								$result = $User->query("SELECT `id`, `bonusId`, `userId`, `rating`, `gdComments`, `badComments`, `isRecommanded`, `updatedOn` FROM `tblBonusComment` WHERE `isRecommanded`='Y' AND `bonusId`='" . $ids ."'");

							if(is_array($result) && count($result) > 0){
								foreach ($result as $key => $value) {


					?>
						<div class="content">
							<div class="arrow-content">
								<h5 class="page-header comment-preview-header margin-top-0">
								<?php
									$resuser = $User->query("SELECT `id`, `userId` FROM `tblUser` WHERE `id` = '" . $value['userId'] . "'");
										if(is_array($resuser) && count($resuser) > 0){
											foreach ($resuser as $index => $valuser) {
								?>
								<span class="text-yellow"><?php echo $valuser['userId'];?></span>
								<?php
									}
								}
								?>
								 님께서 댓글을 남겨주셨습니다. <a href="" target="_blank">
								 <?php
									$bonus = $User->query("SELECT `id`, `bonusName` FROM `tblBonusCards` WHERE `id` = '" . $value['bonusId'] . "'");
									if(is_array($bonus) && count($bonus) > 0){
										foreach ($bonus as $indexBonus => $valBonus) {
									?>
								 <span class="text-success text-uppercase"><?php echo $valBonus['bonusName'];?></span>
								 <?php
									}
								}
								?>

								 </a></h5>
								<div class="comment-show">
									<table class="ask-table">
										<tr>
											<td>좋은 점 : <span class="text-yellow"><?php echo $value['gdComments'];?></span></td>
										</tr>
										<tr>
											<td>나쁜 점 : <span class="text-yellow"><?php echo $value['badComments'];?></span></td>
										</tr>
										<tr>
											<td>
												<a href="comment-reply.php?cat=bonus&id=<?php echo $value['id'];?>" class="btn btn-ask-red text-white">답장하기</a>
											</td>
										</tr>
									</table>
								</div>
							</div>
					 	</div>
					 	<?php
					 				}
					 		}
					 			
					 		}
					 			}else{

					 			echo '<div class="content extra-comment">
					 			<p>No one commented on bonus</p>
					 			</div>';
					 	}
					 	?>
				 	</div>
				</div>

			</div><!-- col-lg-12 col-md-12 -->
			

			</div>
		</div><!-- row -->
	</div><!-- ask-content -->
</div><!-- parent-container -->
<?php require_once('includes/doc_footer.php'); ?>