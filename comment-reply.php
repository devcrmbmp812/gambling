<?php
require_once('config.php');	

// Load Classes
C::loadClass('User');
C::loadClass('Card');
C::loadClass('CMS');
//Init User class
$Base = new Base();
$User = new User();
$Card = new Card();
$Common = new Common();

if(!$User->checkLoginStatus()){
	$Common->redirect('index.php');
}

if(isset($_GET)){
	$cat = $_GET['cat'];
	if($cat == 'bonus'){
		$bonus = true;
		$table = 'tblBonusComment';
		$url = 'comments-timeline-bonus.php';
	}else if($cat == 'sports'){
		$sports = true;
		$table = 'tblSportsComment';
		$url = 'comments-timeline-sport.php';
	}else if($cat == 'sadari'){
		$sadari = true;
		$table = 'tblSadariSportsComment';
		$url = 'comments-timeline-sadari.php';
	}else{
		$news = true;
		$table = 'tblNewsComment';
		$url = 'comments-timeline-news.php';
	}
}
// if(isset($_GET['edit'])){
// 	$User->query("UPDATE ".$table." SET `isRecommanded` = 'Y' WHERE id = '" . $_GET['id'] . "'");
// }
// if(isset($_GET['delete'])){
// 	$User->query("DELETE FROM ".$table." WHERE id = '" . $_GET['id'] . "'");
// 	$Common->redirect($url);
// }

if(isset($_POST) && is_array($_POST) && count($_POST) > 0){
	$s = "UPDATE $table SET `checkAdmin` = 'N', `checkUser` = 'N' WHERE id = '" . $_POST['responseId'] . "'";
	$User->query($s);
	$Card->addComentRespons($_POST, $table);
	//print_r($_POST);die();
}

?>
<?php require_once('includes/doc_head.php'); ?>
<div class="ask-content" id="ask-content">
			<?php if(isset($bonus)){ ?>
		<div class="row">
			<div class="col-lg-12 col-md-12">
			 	<div class="text-white complain-form">
					<div class="ask-page-content-header">
						<h3 class="text-uppercase">댓글 답장하기</h3>
					</div>
					<div class="ask-page-content">
						<div class="content">
						<?php

							$User->query("UPDATE `tblBonusComment` SET `checkSiteAdmin` = 'Y' WHERE id = '" . $_GET['id'] . "'");
							$User->query("UPDATE `tblCommentResponse` SET `checkSiteAdmin` = 'Y' WHERE responseId = '" . $_GET['id'] . "' AND `category`='2'");
							
							$result = $User->query("SELECT `id`, `gdComments`, `badComments`, `bonusId`, `userId`, `rating`, `isRecommanded`, `updatedOn` FROM " . $table . " WHERE `id` = '" . $_GET['id'] . "'");
							
							if(is_array($result) && count($result) > 0){
								foreach ($result as $key => $value) {				
							?>
								
							<div class="arrow-content">
							<?php
								$bonus = $User->query("SELECT `id`, `bonusName` FROM `tblBonusCards` WHERE `id` = '" . $value['bonusId'] . "'");
								if(is_array($bonus) && count($bonus) > 0){
									foreach ($bonus as $indexBonus => $valBonus) {
								?>
								<h5 class="page-header comment-preview-header margin-top-0"> 댓글을 남기셨습니다. <a href="bonus-card-edit.php?edit=<?php echo $valBonus['id']; ?>" target="_blank"><span class="text-yellow"><?php echo $valBonus['bonusName']; ?></span></a></h5>
								<?php
									}
								}
							?>
								<div class="comment-show">
									<table class="ask-table">
									<?php
										$res = $User->query("SELECT `id`, `userId` FROM `tblUser` WHERE `id` = '" . $value['userId'] . "'");
										if(is_array($res) && count($res) > 0){
											foreach ($res as $index => $val) {
										?>
										<tr>
											<td>유저명 : <span class="text-yellow"><?php echo $val['userId']; ?></span></td>
										</tr>
										<?php
											}
										}
										?>
										<tr>
											<td>좋은 점 : <span class="text-yellow"><?php echo $value['gdComments']; ?></span></td>
										</tr>
										<tr>
											<td>나쁜 점 : <span class="text-yellow"><?php echo $value['badComments']; ?></span></td>
										</tr>
										<tr>
											<td style="padding-top:20px;">
												<?php if($value['isRecommanded'] == 'N'){?>
												<span style="color:#fff;background:#5FB962;padding:5px;">Verified</span>
												<?php } ?>
											</td>
										</tr>
									</table>
								</div>
							</div>

						<?php
						$innrRes = $User->query("SELECT `id`, `userId`, `responseId`, `comment`, `isVerified` FROM `tblCommentResponse` WHERE `responseId` = '" . $_GET['id'] . "' ORDER BY `createdOn`");
								if(is_array($innrRes) && count($innrRes) > 0){
									foreach ($innrRes as $key1 => $value1) {

						?>
							


							<div class="ask-page-content-body-details responseMsg">
								<div class="content">
									<div class="arrow-content">
									<?php
									$res1 = $User->query("SELECT `id`, `userId`, `groupId`, `siteName` FROM `tblUser` WHERE `id` = '" . $value1['userId'] . "'");
										if(is_array($res1) && count($res1) > 0){
											foreach ($res1 as $index1 => $val1) {
												$gID = $val1['groupId'];
												$admin = 'Admin';
									?>
										<h5 class="page-header comment-preview-header margin-top-0"><span class="text-yellow"><?php echo ($gID == 0 ? $admin : $val1['siteName']); ?></span> </h5>
										<?php
											}
										}
										?>
										<div class="comment-show">
											<table class="ask-table">
												<tr>
													<td>댓글 : <?php echo $value1['comment']; ?></td>
												</tr>
												<tr>
													<td class="text-yellow"></td>
												</tr>
												
											</table>
										</div>
									</div>
								</div>					
							</div>
							<?php
								}
							}
					?>
					 	</div>
					 	<hr>
				 	</div>
					<!-- reply area for bonus comment -->
				 	<div class="ask-page-content">
						<div class="">
							<div class="content">
							 	<form action="" method="POST" enctype="multipart/form-data">
							 		<div class="form-group arrow-content">
							 			<textarea id="" name="comment" placeholder="Respond to comment..." class="form-control" rows="5" style="width:100%;" required></textarea>
							 			<input type="hidden" name="responseId" value="<?php echo $_GET['id']; ?>">
										<input type="hidden" name="category" value="2">
										<input type="hidden" name="categoryId" value="<?php echo $valBonus['id']; ?>">
										<input type="hidden" name="check" value="checkSiteAdmin" />
							 		</div>
							 		<div>
							 			<button type="submit" class="btn btn-ask-red">작성하기</button>
							 		</div>

							 	</form>
						 	</div>
				 		</div>
					</div>
				</div>
			</div>
		</div>
					<?php
					}
				}
			}
				?>
			<?php if(isset($sports)){ ?>
		<div class="row">
			<div class="col-lg-12 col-md-12">
			 	<div class="text-white complain-form">
					<div class="ask-page-content-header">
						<h3 class="text-uppercase">댓글 답장하기</h3>
					</div>
					<div class="ask-page-content">
						<div class="content">
						<?php

							$User->query("UPDATE `tblSportsComment` SET `checkSiteAdmin` = 'Y' WHERE id = '" . $_GET['id'] . "'");
							$User->query("UPDATE `tblCommentResponse` SET `checkSiteAdmin` = 'Y' WHERE responseId = '" . $_GET['id'] . "' AND `category`='1'");
							
							$result = $User->query("SELECT `id`, `gdComments`, `badComments`, `sportsId`, `userId`, `rating`, `isRecommanded`, `updatedOn` FROM " . $table . " WHERE `id` = '" . $_GET['id'] . "'");
							
							if(is_array($result) && count($result) > 0){
								foreach ($result as $key => $value) {				
							?>
								
							<div class="arrow-content">
							<?php
							$sports1 = $User->query("SELECT `id`, `sportsName` FROM `tblWebCards` WHERE `id` = '" . $value['sportsId'] . "'");
							if(is_array($sports1) && count($sports1) > 0){
								foreach ($sports1 as $indexBonus => $valsports) {
							?>
								<h5 class="page-header comment-preview-header margin-top-0"> 댓글을 남기셨습니다. <a href="webCardEdit.php?edit=<?php echo $valsports['id']; ?>" target="_blank"><span class="text-yellow"><?php echo $valsports['sportsName']; ?></span></a></h5>
								<?php
									}
								}
							?>
								<div class="comment-show">
									<table class="ask-table">
									<?php
										$res = $User->query("SELECT `id`, `userId` FROM `tblUser` WHERE `id` = '" . $value['userId'] . "'");
										if(is_array($res) && count($res) > 0){
											foreach ($res as $index => $val) {
										?>
										<tr>
											<td>유저명 : <span class="text-yellow"><?php echo $val['userId']; ?></span></td>
										</tr>
										<?php
											}
										}
										?>
										<tr>
											<td>좋은 점 : <span class="text-yellow"><?php echo $value['gdComments']; ?></span></td>
										</tr>
										<tr>
											<td>나쁜 점 : <span class="text-yellow"><?php echo $value['badComments']; ?></span></td>
										</tr>
										<tr>
											<td style="padding-top:20px;">
												<?php if($value['isRecommanded'] == 'N'){?>
												<span style="color:#fff;background:#5FB962;padding:5px;">승인완료</span>
												<?php } ?>
											</td>
										</tr>
									</table>
								</div>
							</div>

						<?php
						$innrRes = $User->query("SELECT `id`, `userId`, `responseId`, `comment`, `isVerified` FROM `tblCommentResponse` WHERE `isVerified`='Y' AND `responseId` = '" . $_GET['id'] . "' ORDER BY `createdOn`");
								if(is_array($innrRes) && count($innrRes) > 0){
									foreach ($innrRes as $key1 => $value1) {

						?>
							


							<div class="ask-page-content-body-details responseMsg">
								<div class="content">
									<div class="arrow-content">
									<?php
									$res1 = $User->query("SELECT `id`, `userId`, `groupId`, `siteName` FROM `tblUser` WHERE `id` = '" . $value1['userId'] . "'");
										if(is_array($res1) && count($res1) > 0){
											foreach ($res1 as $index1 => $val1) {
												$gID = $val1['groupId'];
												$admin = 'Admin';
									?>
										<h5 class="page-header comment-preview-header margin-top-0"><span class="text-yellow"><?php echo ($gID == 0 ? $admin : $val1['siteName']); ?></span> </h5>
										<?php
											}
										}
										?>
										<div class="comment-show">
											<table class="ask-table">
												<tr>
													<td>댓글 : <?php echo $value1['comment']; ?></td>
												</tr>
												<tr>
													<td class="text-yellow"></td>
												</tr>
												
											</table>
										</div>
									</div>
								</div>					
							</div>
							<?php
								}
							}
					?>
					 	</div>
					 	<hr>
				 	</div>
					<!-- reply area for bonus comment -->
				 	<div class="ask-page-content">
						<div class="">
							<div class="content">
							 	<form action="" method="POST" enctype="multipart/form-data">
							 		<div class="form-group arrow-content">
							 			<textarea id="" name="comment" placeholder="Respond to comment..." class="form-control" rows="5" style="width:100%;" required></textarea>
							 			<input type="hidden" name="responseId" value="<?php echo $_GET['id']; ?>">
										<input type="hidden" name="category" value="1">
										<input type="hidden" name="categoryId" value="<?php echo $valsports['id']; ?>">
										<input type="hidden" name="check" value="checkSiteAdmin" />
							 		</div>
							 		<div>
							 			<button type="submit" class="btn btn-ask-red">작성하기</button>
							 		</div>

							 	</form>
						 	</div>
				 		</div>
					</div>
				</div>

			</div><!-- col-lg-12 col-md-12 -->
			</div><!-- row -->
					<?php
					}
				}
			}
				?>

				<?php if(isset($sadari)){ ?>
		<div class="row">
			<div class="col-lg-12 col-md-12">
			 	<div class="text-white complain-form">
					<div class="ask-page-content-header">
						<h3 class="text-uppercase">댓글 답장하기</h3>
					</div>
					<div class="ask-page-content">
						<div class="content">
						<?php

							$User->query("UPDATE `tblSadariSportsComment` SET `checkSiteAdmin` = 'Y' WHERE id = '" . $_GET['id'] . "'");
							$User->query("UPDATE `tblCommentResponse` SET `checkSiteAdmin` = 'Y' WHERE responseId = '" . $_GET['id'] . "' AND `category`='3'");
							
							$result = $User->query("SELECT `id`, `gdComments`, `badComments`, `sportsId`, `userId`, `rating`, `isRecommanded`, `updatedOn` FROM " . $table . " WHERE `id` = '" . $_GET['id'] . "'");
							
							if(is_array($result) && count($result) > 0){
								foreach ($result as $key => $value) {				
							?>
								
							<div class="arrow-content">
							<?php
							$sports1 = $User->query("SELECT `id`, `sportsName` FROM `tblSadariCards` WHERE `id` = '" . $value['sportsId'] . "'");
							if(is_array($sports1) && count($sports1) > 0){
								foreach ($sports1 as $indexBonus => $valsports) {
							?>
								<h5 class="page-header comment-preview-header margin-top-0"> 글을 남기셨습니다. <a href="webCardEdit.php?edit=<?php echo $valsports['id']; ?>" target="_blank"><span class="text-yellow"><?php echo $valsports['sportsName']; ?></span></a></h5>
								<?php
									}
								}
							?>
								<div class="comment-show">
									<table class="ask-table">
									<?php
										$res = $User->query("SELECT `id`, `userId` FROM `tblUser` WHERE `id` = '" . $value['userId'] . "'");
										if(is_array($res) && count($res) > 0){
											foreach ($res as $index => $val) {
										?>
										<tr>
											<td>유저명 : <span class="text-yellow"><?php echo $val['userId']; ?></span></td>
										</tr>
										<?php
											}
										}
										?>
										<tr>
											<td>좋은 점 : <span class="text-yellow"><?php echo $value['gdComments']; ?></span></td>
										</tr>
										<tr>
											<td>나쁜 점 : <span class="text-yellow"><?php echo $value['badComments']; ?></span></td>
										</tr>
										<tr>
											<td style="padding-top:20px;">
												<?php if($value['isRecommanded'] == 'N'){?>
												<span style="color:#fff;background:#5FB962;padding:5px;">승인완료</span>
												<?php } ?>
											</td>
										</tr>
									</table>
								</div>
							</div>

						<?php
						$innrRes = $User->query("SELECT `id`, `userId`, `responseId`, `comment`, `isVerified` FROM `tblCommentResponse` WHERE `responseId` = '" . $_GET['id'] . "' ORDER BY `createdOn`");
								if(is_array($innrRes) && count($innrRes) > 0){
									foreach ($innrRes as $key1 => $value1) {

						?>
							


							<div class="ask-page-content-body-details responseMsg">
								<div class="content">
									<div class="arrow-content">
									<?php
									$res1 = $User->query("SELECT `id`, `userId`, `groupId`, `siteName` FROM `tblUser` WHERE `id` = '" . $value1['userId'] . "'");
										if(is_array($res1) && count($res1) > 0){
											foreach ($res1 as $index1 => $val1) {
												$gID = $val1['groupId'];
												$admin = 'Admin';
									?>
										<h5 class="page-header comment-preview-header margin-top-0"><span class="text-yellow"><?php echo ($gID == 0 ? $admin : $val1['siteName']); ?></span> </h5>
										<?php
											}
										}
										?>
										<div class="comment-show">
											<table class="ask-table">
												<tr>
													<td>댓글 : <?php echo $value1['comment']; ?></td>
												</tr>
												<tr>
													<td class="text-yellow"></td>
												</tr>
											</table>
										</div>
									</div>
								</div>					
							</div>
							<?php
								}
							}
					?>
					 	</div>
					 	<hr>
				 	</div>
					<!-- reply area for bonus comment -->
				 	<div class="ask-page-content">
						<div class="">
							<div class="content">
							 	<form action="" method="POST" enctype="multipart/form-data">
							 		<div class="form-group arrow-content">
							 			<textarea id="" name="comment" placeholder="Respond to comment..." class="form-control" rows="5" style="width:100%;" required></textarea>
							 			<input type="hidden" name="responseId" value="<?php echo $_GET['id']; ?>">
					<input type="hidden" name="category" value="3">
					<input type="hidden" name="categoryId" value="<?php echo $valsports['id']; ?>">
					<input type="hidden" name="check" value="checkSiteAdmin" />
							 		</div>
							 		<div>
							 			<button type="submit" class="btn btn-ask-red">작성하기</button>
							 		</div>

							 	</form>
						 	</div>
				 		</div>
					</div>
				</div>

			</div><!-- col-lg-12 col-md-12 -->
			</div><!-- row -->
					<?php
					}
				}
			}
				?>
		</div><!-- ask-content -->
	</div><!-- parent-container -->
<?php require_once('includes/doc_footer.php'); ?>