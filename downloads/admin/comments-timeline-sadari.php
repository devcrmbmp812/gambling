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

// if(isset($_POST) && is_array($_POST) && count($_POST) > 0){
//     if($Card->insertSlider($_POST, $_FILES)){
//     	C::redirect(C::link('files.php', false, true));
//     }	
// }
if(isset($_GET['delete']) && trim($_GET['delete'])){
	$idx = $_GET['delete'];

	if($Card->delSadarisportsComment($idx)){
		C::redirect(C::link('comments-timeline-sadari.php', false, true));
	}
}
if(isset($_GET['edit']) && trim($_GET['edit'])){
	$idx = $_GET['edit'];

	if($Card->confirmSadariSportsComment($idx)){
		C::redirect(C::link('comments-timeline-sadari.php', false, true));
	}
}

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
		<header>
			<span class="icon">&#59168;</span>
			<hgroup>
				<h1>Comments</h1>
				<h2>What they're saying</h2>
			</hgroup>
			<!--<aside>
				<span>
					<a href="#">&#9881;</a>
					<ul class="settings-dd">
						<li><label>Option a</label><input type="checkbox" /></li>
						<li><label>Option b</label><input type="checkbox" checked="checked" /></li>
						<li><label>Option c</label><input type="checkbox" /></li>
					</ul>
				</span>
			</aside>-->
		</header>
		<div class="content no-padding timeline">
		<?php
		$result = $User->query("SELECT `id`, `gdComments`, `badComments`, `sportsId`, `userId`, `rating`, `isRecommanded`, `updatedOn` FROM `tblSadariSportsComment`");
		if(is_array($result) && count($result) > 0){
			foreach ($result as $key => $value) {				
		?>
			<div class="tl-post comments">
				<span class="icon">&#59168;</span>
				<p><?php
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
					$res = $User->query("SELECT `id`, `sportsName` FROM `tblSadariCards` WHERE `id` = '" . $value['sportsId'] . "'");
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
							<a href="<?php echo C::link('comments-timeline-sadari.php', array('edit' => $value['id'] . '+news'), true);?>" style="color:#fff;background:green;padding:5px;">Verify</a>
						<?php }
						else{ ?>
							<a href="" style="color:#fff;background:green;padding:5px;">Verified</a>
						<?php } ?>
							<a href="<?php echo C::link('comments-timeline-sadari.php', array('delete' => $value['id']), true);?>"  style="color:#fff;background:#ff0000;padding:5px;">Reject</a>
						</span>
				</p>
			</div>
		<?php
			}
		}
		?>

			<span class="show-more"><a	 href="#">More</a></span>
		</div>
	</section>
</section>
<?php require_once('includes/doc_footer.php'); ?>