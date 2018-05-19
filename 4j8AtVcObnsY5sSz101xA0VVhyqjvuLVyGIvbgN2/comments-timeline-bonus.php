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

$uri = $_SERVER['HTTP_REFERER'];
if(isset($_GET['verify'])){
	$date = date('Y-m-d H:i:s');
	$User->query("UPDATE `tblBonusComment` SET `isRecommanded` = 'Y', `updatedOn`= '" . $date . "' WHERE id = '" . $_GET['verify'] . "'");
	$Common->redirect($uri);
}
if(isset($_GET['del'])){
	$User->query("DELETE FROM `tblBonusComment` WHERE id = '" . $_GET['del'] . "'");
	$Common->redirect($uri);
}


$activeNavigation = "comment";
?>

<?php require_once('includes/doc_head.php'); ?>
<!--<section class="alert">
	<div class="orange">	
		<p>Hi Lee, you have <a href="#">3 new pages</a> and <a href="#">16 comments</a> to approve, better get going!</p>
		<span class="close">&#10006;</span>
	</div>
</section>-->
<section class="content">
	<section class="widget">
		<div class="panel panel-default bt-panel" style="box-shadow:none;">
			<div class="panel-heading">
				<span class="icon">&#128196;</span>
				<hgroup>
					<h5>Bonus Comments</h5>
					<h6>What they're saying about bonus</h6>
				</hgroup>
			</div>
			<div class="panel-body">
				<div class="content no-padding timeline">
				<?php
				
				$result = $User->query("SELECT `id`, `gdComments`, `badComments`, `bonusId`, `userId`, `rating`, `isRecommanded`, `updatedOn` FROM `tblBonusComment` ORDER BY `updatedOn` DESC");
				if(is_array($result) && count($result) > 0){
					foreach ($result as $key => $value) {				
				?>
					<div class="tl-post comments">
						<!-- <span class="icon">&#59168;</span> -->
						<p class="tl-post-p">
						<?php
							$bonus = $User->query("SELECT `id`, `bonusName` FROM `tblbonusCards` WHERE `id` = '" . $value['bonusId'] . "'");
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
							<a href="#">Dislike:</a> <?php echo $value['badComments']; ?>
							<span class="reply">
									<?php if($value['isRecommanded'] == 'N'){?>
									<a href="comments-timeline-bonus.php?verify=<?php echo $value['id'];?>" style="color:#fff;background:green;padding:5px;">Verify</a>
								<?php }
								else{ ?>
									<a href="" style="color:#fff;background:green;padding:5px;">Checked</a>
								<?php } ?>
									<a href="comments-timeline-bonus.php?del=<?php echo $value['id'];?>"  style="color:#fff;background:#ff0000;padding:5px;">Reject</a>
									<a href="comments-reply.php?cat=bonus&id=<?php echo $value['id'];?>"  style="color:#fff;background:#177EE5;padding:5px;">Reply</a>
							</span>
						</p>
					</div>
				<?php
					}
				}
				?>

					<!-- <span class="show-more"><a	 href="#">More</a></span> -->
				</div>
			</div>
		</div>
	</section>
</section>
<?php require_once('includes/doc_footer.php'); ?>