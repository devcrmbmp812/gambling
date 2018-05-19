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
	$User->query("UPDATE `tblSportsComment` SET `isRecommanded` = 'Y', `updatedOn`= '" . $date . "' WHERE id = '" . $_GET['verify'] . "'");
	$Common->redirect($uri);
}
if(isset($_GET['del'])){
	$User->query("DELETE FROM `tblSportsComment` WHERE id = '" . $_GET['del'] . "'");
	$Common->redirect($uri);
} 

$activeNavigation = "comment";

?>

<?php require_once('includes/doc_head.php'); ?>
<!--<section class="alert">
	<div class="orange">	
		<p>Hi Harry, you have <a href="#">3 new pages</a> and <a href="#">16 comments</a> to approve, better get going!</p>
		<span class="close">&#10006;</span>
	</div>
</section>-->
<section class="content">
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
				<div class="content no-padding timeline">
				<?php
				$result = $User->query("SELECT `id`, `gdComments`, `badComments`, `sportsId`, `userId`, `rating`, `isRecommanded`, `updatedOn` FROM `tblSportsComment` ORDER BY `updatedOn` DESC");
				if(is_array($result) && count($result) > 0){
					foreach ($result as $key => $value) {				
				?>
					<div class="tl-post comments">
						<!-- <span class="icon">&#59168;</span> -->
						<p class="tl-post-p"><?php
							$res = $User->query("SELECT `id`, `userId` FROM `tblUser` WHERE `id` = '" . $value['userId'] . "'");
							if(is_array($res) && count($res) > 0){
								foreach ($res as $index => $val) {
							?>
							<strong><?php echo $val['userId']; ?></strong><br />
							<?php
								}
							}
							?>
							<?php
							$res = $User->query("SELECT `id`, `sportsName` FROM `tblWebCards` WHERE `id` = '" . $value['sportsId'] . "'");
							if(is_array($res) && count($res) > 0){
								foreach ($res as $index => $val) {
							?>
							<strong><span style="color:red;"> Comment For : </span><?php echo $val['sportsName']; ?></strong><br />
							<?php
								}
							}
							?>
							<a href="#">Like:</a> <?php echo $value['gdComments']; ?><br />
							<a href="#">Dislike:</a> <?php echo $value['badComments']; ?>
							<span class="reply">
									<?php if($value['isRecommanded'] == 'N'){?>
									<a href="comments-timeline-sport.php?verify=<?php echo $value['id'];?>" style="color:#fff;background:green;padding:5px;">Verify</a>
								<?php }
								else{ ?>
									<a href="" style="color:#fff;background:green;padding:5px;">Checked</a>
								<?php } ?>
									<a href="comments-timeline-sport.php?del=<?php echo $value['id'];?>"  style="color:#fff;background:#ff0000;padding:5px;">Reject</a>
									<a href="comments-reply.php?cat=sports&id=<?php echo $value['id'];?>"  style="color:#fff;background:#177EE5;padding:5px;">Reply</a>
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