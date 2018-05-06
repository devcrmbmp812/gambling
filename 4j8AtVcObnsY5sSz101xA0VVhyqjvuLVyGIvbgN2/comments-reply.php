<?php
require_once('../config.php');	

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
if(isset($_GET['edit'])){
	$User->query("UPDATE ".$table." SET `isRecommanded` = 'Y' WHERE id = '" . $_GET['id'] . "'");
}
if(isset($_GET['delete'])){
	$User->query("DELETE FROM ".$table." WHERE id = '" . $_GET['id'] . "'");
	$Common->redirect($url);
}

$uri = $_SERVER['HTTP_REFERER'];
if(isset($_GET['edt'])){
	$User->query("UPDATE `tblCommentResponse` SET `isVerified` = 'Y' WHERE id = '" . $_GET['id'] . "'");
	$Common->redirect($uri);
}
if(isset($_GET['del'])){
	$User->query("DELETE FROM `tblCommentResponse` WHERE id = '" . $_GET['id'] . "'");
	$Common->redirect($uri);
}

if(isset($_POST) && is_array($_POST) && count($_POST) > 0){
	//$s = "UPDATE $table SET `checkSiteAdmin` = 'N', `checkUser` = 'N' WHERE id = '" . $_POST['responseId'] . "'";
	//$User->query($s);
	$Card->addComentRespons($_POST, $table);
}

?>
<?php require_once('includes/doc_head.php'); ?>
<section class="content">
<style>
	.reply-comment-button{
		background: #1987CE !important;
		color:#fff !important;
		cursor: pointer !important;
	}
</style>
	<section class="widget">
		<div class="panel panel-default bt-panel" style="box-shadow:none;">
			<div class="panel-heading">
				<span class="icon">&#128196;</span>
				<hgroup>
					<h5>Sports Comments</h5>
					<h6>What they're saying about sports</h6>
				</hgroup>
			</div>
			<div class="panel-body">
		<?php if(isset($bonus)){?>
				<div class="content no-padding timeline">
				<?php

				$User->query("UPDATE `tblBonusComment` SET `checkAdmin` = 'Y' WHERE id = '" . $_GET['id'] . "'");
				$User->query("UPDATE `tblCommentResponse` SET `checkAdmin` = 'Y' WHERE responseId = '" . $_GET['id'] . "' AND `category`='2'");
				
				$result = $User->query("SELECT `id`, `gdComments`, `badComments`, `bonusId`, `userId`, `rating`, `isRecommanded`, `updatedOn` FROM " . $table . " WHERE `id` = '" . $_GET['id'] . "'");
				
				if(is_array($result) && count($result) > 0){
					foreach ($result as $key => $value) {				
				?>
					<div class="tl-post comments">
					<form method="POST" enctype="multipart/form-data">
					<p class="tl-post-p">

						<?php
							$bonus = $User->query("SELECT `id`, `bonusName` FROM `tblBonusCards` WHERE `id` = '" . $value['bonusId'] . "'");
							if(is_array($bonus) && count($bonus) > 0){
								foreach ($bonus as $indexBonus => $valBonus) {
							?>
							
							<strong><a href="bonus-card-edit.php?edit=<?php echo $valBonus['id']; ?>" target="_blank"><?php echo $valBonus['bonusName']; ?></a></strong><br />
							<?php
								}
							}
							?>

					<?php
							$res = $User->query("SELECT `id`, `userId` FROM `tblUser` WHERE `id` = '" . $value['userId'] . "'");
							if(is_array($res) && count($res) > 0){
								foreach ($res as $index => $val) {
							?>
							<strong><?php echo $val['userId']; ?></strong><br />
							<?php
								}
							}
							?>
							<a href="#">Like:</a> <?php echo $value['gdComments']; ?><br />
							<a href="#">Dislike:</a> <?php echo $value['badComments']; ?><br /><br />
							<span>
								<?php if($value['isRecommanded'] == 'N'){?>
								<a href="comments-reply.php?cat=bonus&id=<?php echo $value['id'];?>&edit=<?php echo $value['id'];?>" style="color:#fff;background:green;padding:5px;">Verify</a>
								<?php }
								else{ ?>
									<a href="javascript:void(0)" style="color:#fff;background:green;padding:5px;">Verified</a>
								<?php } ?>
									<a href="comments-reply.php?cat=bonus&id=<?php echo $value['id'];?>&delete=<?php echo $value['id'];?>"  style="color:#fff;background:#ff0000;padding:5px;">Reject</a>
							</span>

							</br></br>
							<?php
								$innrRes = $User->query("SELECT `id`, `userId`, `responseId`, `comment`, `isVerified` FROM `tblCommentResponse` WHERE `responseId` = '" . $_GET['id'] . "' ORDER BY `createdOn`");
										if(is_array($innrRes) && count($innrRes) > 0){
											foreach ($innrRes as $key1 => $value1) {

									$res1 = $User->query("SELECT `id`, `userId`, `groupId`, `siteName` FROM `tblUser` WHERE `id` = '" . $value1['userId'] . "'");
										if(is_array($res1) && count($res1) > 0){
											foreach ($res1 as $index1 => $val1) {
												$gID = $val1['groupId'];
												$admin = 'Admin';
							?>
										<strong style="text-transform:uppercase;"><?php echo ($gID == 0 ? $admin : $val1['siteName']); ?></strong><br />
							<?php
										}
									}
							?>
							<a href="#">comment:</a> <?php echo $value1['comment']; ?><br><br>
							<span>
								<?php if($value1['isVerified'] == 'N'){?>
								<a href="comments-reply.php?cat=bonus&id=<?php echo $value1['id'];?>&edt=<?php echo $value1['id'];?>" style="color:#fff;background:green;padding:5px;">Verify</a>
								<?php }
								else{ ?>
									<a href="javascript:void(0)" style="color:#fff;background:green;padding:5px;">Verified</a>
								<?php } ?>
									<a href="comments-reply.php?cat=bonus&id=<?php echo $value1['id'];?>&del=<?php echo $value1['id'];?>"  style="color:#fff;background:#ff0000;padding:5px;">Reject</a>
							</span><br><br>
							<?php
										}
									}
							?>



							<br><br><br><br><br><br>


							<input type="hidden" name="responseId" value="<?php echo $_GET['id']; ?>">
							<input type="hidden" name="category" value="2">
							<input type="hidden" name="categoryId" value="<?php echo $valBonus['id']; ?>">
							<input type="hidden" name="check" value="checkAdmin" />
							<span class="reply">
								<!-- <input type="text" name="comment" placeholder="Respond to comment..."/> -->
								<textarea name="comment" placeholder="Respond to comment..." rows="1" style="width:100%;" required></textarea>
								<input type="submit" class="reply-comment-button" value="Reply" />
							</span>
						</p>
						</form>
					</div>
				<?php
					}
				}
				?>
				</div>
		<?php } else if(isset($sports)){ ?>
				<div class="content no-padding timeline">
				<?php
				
				$User->query("UPDATE `tblSportsComment` SET `checkAdmin` = 'Y' WHERE id = '" . $_GET['id'] . "'");
				$User->query("UPDATE `tblCommentResponse` SET `checkAdmin` = 'Y' WHERE responseId = '" . $_GET['id'] . "' AND `category`='1'");


				$result = $User->query("SELECT `id`, `gdComments`, `badComments`, `sportsId`, `userId`, `rating`, `isRecommanded`, `updatedOn` FROM " . $table . " WHERE `id` = '" . $_GET['id'] . "'");
				
				if(is_array($result) && count($result) > 0){
					foreach ($result as $key => $value) {				
				?>
					<div class="tl-post comments">
					<form method="POST" enctype="multipart/form-data">
					<p class="tl-post-p">

						<?php
							$sports1 = $User->query("SELECT `id`, `sportsName` FROM `tblWebCards` WHERE `id` = '" . $value['sportsId'] . "'");
							if(is_array($sports1) && count($sports1) > 0){
								foreach ($sports1 as $indexBonus => $valsports) {
							?>
							
							<strong><a href="webCardEdit.php?edit=<?php echo $valsports['id']; ?>" target="_blank"><?php echo $valsports['sportsName']; ?></a></strong><br />
							<?php
								}
							}
							?>

						<?php
							$res = $User->query("SELECT `id`, `userId` FROM `tblUser` WHERE `id` = '" . $value['userId'] . "'");
							if(is_array($res) && count($res) > 0){
								foreach ($res as $index => $val) {
						?>
							<strong><?php echo $val['userId']; ?></strong><br />
						<?php
								}
							}
						?>
							<a href="#">Like:</a> <?php echo $value['gdComments']; ?><br />
							<a href="#">Dislike:</a> <?php echo $value['badComments']; ?><br /><br />
							<span>
								<?php if($value['isRecommanded'] == 'N'){?>
								<a href="comments-reply.php?cat=sports&id=<?php echo $value['id'];?>&edit=<?php echo $value['id'];?>" style="color:#fff;background:green;padding:5px;">Verify</a>
								<?php }
								else{ ?>
									<a href="javascript:void(0)" style="color:#fff;background:green;padding:5px;">Verified</a>
								<?php } ?>
									<a href="comments-reply.php?cat=sports&id=<?php echo $value['id'];?>&delete=<?php echo $value['id'];?>"  style="color:#fff;background:#ff0000;padding:5px;">Reject</a>
							</span>	
							</br></br>
							<?php
								$innrRes = $User->query("SELECT `id`, `userId`, `responseId`, `comment`, `isVerified` FROM `tblCommentResponse` WHERE `responseId` = '" . $_GET['id'] . "' ORDER BY `createdOn`");
										if(is_array($innrRes) && count($innrRes) > 0){
											foreach ($innrRes as $key1 => $value1) {

									$res1 = $User->query("SELECT `id`, `userId`, `groupId`, `siteName` FROM `tblUser` WHERE `id` = '" . $value1['userId'] . "'");
										if(is_array($res1) && count($res1) > 0){
											foreach ($res1 as $index1 => $val1) {
												$gID = $val1['groupId'];
												$admin = 'Admin';
							?>
										<strong style="text-transform:uppercase;"><?php echo ($gID == 0 ? $admin : $val1['siteName']); ?></strong><br />
							<?php
										}
									}
							?>
							<a href="#">comment:</a> <?php echo $value1['comment']; ?><br><br>
							<span>
								<?php if($value1['isVerified'] == 'N'){?>
								<a href="comments-reply.php?cat=sports&id=<?php echo $value1['id'];?>&edt=<?php echo $value1['id'];?>" style="color:#fff;background:green;padding:5px;">Verify</a>
								<?php }
								else{ ?>
									<a href="javascript:void(0)" style="color:#fff;background:green;padding:5px;">Verified</a>
								<?php } ?>
									<a href="comments-reply.php?cat=sports&id=<?php echo $value1['id'];?>&del=<?php echo $value1['id'];?>"  style="color:#fff;background:#ff0000;padding:5px;">Reject</a>
							</span><br><br><br>
							<?php
										}
									}
							?>


							<br><br><br><br><br><br>
							<input type="hidden" name="responseId" value="<?php echo $_GET['id']; ?>">
							<input type="hidden" name="category" value="1">
							<input type="hidden" name="categoryId" value="<?php echo $valsports['id']; ?>">
							<input type="hidden" name="check" value="checkAdmin" />
							<span class="reply">
								<!-- <input type="text" name="comment" placeholder="Respond to comment..."/> -->
								<textarea name="comment" placeholder="Respond to comment..." rows="1" style="width:100%;" required></textarea>
								<input type="submit" class="reply-comment-button" value="Reply" />
							</span>
						</p>
						</form>
					</div>
				<?php
					}
				}
				?>
				</div>
	    <?php } else if(isset($sadari)){ ?>
				<div class="content no-padding timeline">
				<?php
				
				$User->query("UPDATE `tblSadariSportsComment` SET `checkAdmin` = 'Y' WHERE id = '" . $_GET['id'] . "'");
				$User->query("UPDATE `tblCommentResponse` SET `checkAdmin` = 'Y' WHERE responseId = '" . $_GET['id'] . "' AND `category`='3'");


				$result = $User->query("SELECT `id`, `gdComments`, `badComments`, `sportsId`, `userId`, `rating`, `isRecommanded`, `updatedOn` FROM " . $table . " WHERE `id` = '" . $_GET['id'] . "'");
				
				
				if(is_array($result) && count($result) > 0){
					foreach ($result as $key => $value) {				
				?>
					<div class="tl-post comments">
					<form method="POST" enctype="multipart/form-data">
					<p class="tl-post-p">

						<?php
							$sports = $User->query("SELECT `id`, `sportsName` FROM `tblSadariCards` WHERE `id` = '" . $value['sportsId'] . "'");
							if(is_array($sports) && count($sports) > 0){
								foreach ($sports as $indexBonus => $valsports) {
							?>
							
							<strong><a href="sadariEdit.php?edit=<?php echo $valsports['id']; ?>" target="_blank"><?php echo $valsports['sportsName']; ?></a></strong><br />
							<?php
								}
							}
							?>

					<?php
							$res = $User->query("SELECT `id`, `userId` FROM `tblUser` WHERE `id` = '" . $value['userId'] . "'");
							if(is_array($res) && count($res) > 0){
								foreach ($res as $index => $val) {
							?>
							<strong><?php echo $val['userId']; ?></strong><br />
							<?php
								}
							}
							?>
							<a href="#">Like:</a> <?php echo $value['gdComments']; ?><br />
							<a href="#">Dislike:</a> <?php echo $value['badComments']; ?><br /><br />
							<span>
								<?php if($value['isRecommanded'] == 'N'){?>
								<a href="comments-reply.php?cat=sadari&id=<?php echo $value['id'];?>&edit=<?php echo $value['id'];?>" style="color:#fff;background:green;padding:5px;">Verify</a>
								<?php }
								else{ ?>
									<a href="javascript:void(0)" style="color:#fff;background:green;padding:5px;">Verified</a>
								<?php } ?>
									<a href="comments-reply.php?cat=sadari&id=<?php echo $value['id'];?>&delete=<?php echo $value1['id'];?>"  style="color:#fff;background:#ff0000;padding:5px;">Reject</a>
							</span>
							
							</br></br>
							<?php
								$innrRes = $User->query("SELECT `id`, `userId`, `responseId`, `comment`, `isVerified` FROM `tblCommentResponse` WHERE `responseId` = '" . $_GET['id'] . "' ORDER BY `createdOn`");
										if(is_array($innrRes) && count($innrRes) > 0){
											foreach ($innrRes as $key1 => $value1) {

									$res1 = $User->query("SELECT `id`, `userId`, `groupId`, `siteName` FROM `tblUser` WHERE `id` = '" . $value1['userId'] . "'");
										if(is_array($res1) && count($res1) > 0){
											foreach ($res1 as $index1 => $val1) {
												$gID = $val1['groupId'];
												$admin = 'Admin';
							?>
										<strong style="text-transform:uppercase;"><?php echo ($gID == 0 ? $admin : $val1['siteName']); ?></strong><br />
							<?php
										}
									}
							?>
							<a href="#">comment:</a> <?php echo $value1['comment']; ?><br><br>
							<span>
								<?php if($value1['isVerified'] == 'N'){?>
								<a href="comments-reply.php?cat=sadari&id=<?php echo $value1['id'];?>&edt=<?php echo $value1['id'];?>" style="color:#fff;background:green;padding:5px;">Verify</a>
								<?php }
								else{ ?>
									<a href="javascript:void(0)" style="color:#fff;background:green;padding:5px;">Verified</a>
								<?php } ?>
									<a href="comments-reply.php?cat=sadari&id=<?php echo $value1['id'];?>&del=<?php echo $value1['id'];?>"  style="color:#fff;background:#ff0000;padding:5px;">Reject</a>
							</span></br></br></br></br>
							<?php
										}
									}
							?>


							<br><br><br><br><br><br>


							<input type="hidden" name="responseId" value="<?php echo $_GET['id']; ?>">
							<input type="hidden" name="category" value="3">
							<input type="hidden" name="categoryId" value="<?php echo $valsports['id']; ?>">
							<input type="hidden" name="check" value="checkAdmin" />
							<span class="reply">
								<!-- <input type="text" name="comment" placeholder="Respond to comment..."/> -->
								<textarea name="comment" placeholder="Respond to comment..." rows="1" style="width:100%;" required></textarea>
								<input type="submit" class="reply-comment-button" value="Reply" />
							</span>
						</p>
						</form>
					</div>
				<?php
					}
				}
				?>
				</div>
	    <?php } else if(isset($news)){ ?>
				<div class="content no-padding timeline">
				<?php
				
				$User->query("UPDATE `tblNewsComment` SET `checkAdmin` = 'Y' WHERE id = '" . $_GET['id'] . "'");
				$User->query("UPDATE `tblCommentResponse` SET `checkAdmin` = 'Y' WHERE responseId = '" . $_GET['id'] . "' AND `category`='4'");

				$result = $User->query("SELECT `id`, `gdComments`, `badComments`, `newsId`, `userId`, `rating`, `isRecommanded`, `updatedOn` FROM " . $table . " WHERE `id` = '" . $_GET['id'] . "'");
				
				
				if(is_array($result) && count($result) > 0){
					foreach ($result as $key => $value) {				
				?>
					<div class="tl-post comments">
					<form method="POST" enctype="multipart/form-data">
					<p class="tl-post-p">

						<?php
							$blog = $User->query("SELECT `id`, `title` FROM `tblNewsBlog` WHERE `id` = '" . $value['newsId'] . "'");
							if(is_array($blog) && count($blog) > 0){
								foreach ($blog as $indexBonus => $valblog) {
							?>
							
							<strong><a href="sadariEdit.php?edit=<?php echo $valblog['id']; ?>" target="_blank"><?php echo $valblog['title']; ?></a></strong><br />
							<?php
								}
							}
							?>

					<?php
							$res = $User->query("SELECT `id`, `userId` FROM `tblUser` WHERE `id` = '" . $value['userId'] . "'");
							if(is_array($res) && count($res) > 0){
								foreach ($res as $index => $val) {
							?>
							<strong><?php echo $val['userId']; ?></strong><br />
							<?php
								}
							}
							?>
							<a href="#">Like:</a> <?php echo $value['gdComments']; ?><br />
							<a href="#">Dislike:</a> <?php echo $value['badComments']; ?><br /><br />
							<span>
								<?php if($value['isRecommanded'] == 'N'){?>
								<a href="comments-reply.php?cat=newsi&id=<?php echo $value['id'];?>&edit=<?php echo $value['id'];?>" style="color:#fff;background:green;padding:5px;">Verify</a>
								<?php }
								else{ ?>
									<a href="javascript:void(0)" style="color:#fff;background:green;padding:5px;">Verified</a>
								<?php } ?>
									<a href="comments-reply.php?cat=news&id=<?php echo $value['id'];?>&delete=<?php echo $value['id'];?>"  style="color:#fff;background:#ff0000;padding:5px;">Reject</a>
							</span>
							
							</br></br>
							<?php
								$innrRes = $User->query("SELECT `id`, `userId`, `responseId`, `comment`, `isVerified` FROM `tblCommentResponse` WHERE `responseId` = '" . $_GET['id'] . "' ORDER BY `createdOn`");
										if(is_array($innrRes) && count($innrRes) > 0){
											foreach ($innrRes as $key1 => $value1) {

									$res1 = $User->query("SELECT `id`, `userId`, `groupId`, `siteName` FROM `tblUser` WHERE `id` = '" . $value1['userId'] . "'");
										if(is_array($res1) && count($res1) > 0){
											foreach ($res1 as $index1 => $val1) {
												$gID = $val1['groupId'];
												$admin = 'Admin';
							?>
										<strong style="text-transform:uppercase;"><?php echo ($gID == 0 ? $admin : $val1['siteName']); ?></strong><br />
							<?php
										}
									}
							?>
							<a href="#">comment:</a> <?php echo $value1['comment']; ?><br><br>
							<span>
								<?php if($value1['isVerified'] == 'N'){?>
								<a href="comments-reply.php?cat=sports&id=<?php echo $value1['id'];?>&edt=<?php echo $value1['id'];?>" style="color:#fff;background:green;padding:5px;">Verify</a>
								<?php }
								else{ ?>
									<a href="javascript:void(0)" style="color:#fff;background:green;padding:5px;">Verified</a>
								<?php } ?>
									<a href="comments-reply.php?cat=sports&id=<?php echo $value1['id'];?>&del=<?php echo $value1['id'];?>"  style="color:#fff;background:#ff0000;padding:5px;">Reject</a>
							</span><br><br>
							<?php
										}
									}
							?>





							<br><br><br><br><br><br>


							<input type="hidden" name="responseId" value="<?php echo $_GET['id']; ?>">
							<input type="hidden" name="category" value="4">
							<input type="hidden" name="categoryId" value="<?php echo $valblog['id']; ?>">
							<input type="hidden" name="check" value="checkAdmin" />
							<span class="reply">
								
								<textarea name="comment" placeholder="Respond to comment..." rows="1" style="width:100%;" required></textarea>
								<input type="submit" class="reply-comment-button" value="Reply" />
							</span>
						</p>
						</form>
					</div>
				<?php
					}
				}
				?>
				</div>
	    <?php } ?>
			</div>
		</div>
	</section>
</section>
<?php require_once('includes/doc_footer.php'); ?>