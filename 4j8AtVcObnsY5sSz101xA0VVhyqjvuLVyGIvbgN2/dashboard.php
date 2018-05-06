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
$logedInID = ((int)User::loggedInUserId() > 0 ? User::loggedInUserId() : 0);
$groupId = $Base->query("SELECT `groupId` FROM `tblUser` WHERE `id` = '" . $logedInID . "' LIMIT 1");
if ( $groupId[0]['groupId'] != 0) {
	$Common->redirect('index.php');
}
$activeNavigation = "dashboard";
?>

<?php require_once('includes/doc_head.php'); ?>
<section class="content">
	<!--<div class="widget-container">
	</div>-->
	
	<div class="widget-container">
		<section class="widget small">
			<div class="panel panel-default bt-panel" style="box-shadow:none;">
				<div class="panel-heading">
					<span class="icon">&#128363;</span>
					<hgroup>
						<h5>Timeline</h5>
						<h6>Insiders news</h6>
					</hgroup>
				</div>
				<div class="panel-body">
					<div class="content">
					<?php
					$result = $Base->query("SELECT 
											( SELECT COUNT( * ) FROM `tblBonusCards` ) AS `TBC`,
											( SELECT COUNT( * ) FROM `tblWebCards` ) AS `TWC`, 
											( SELECT COUNT( * ) FROM `tblUser` ) AS `TU`");
					if(is_array($result) && count($result) > 0){
						foreach ($result as $key => $value) {		
					?>
						<section class="stats-wrapper">
							<div class="stats">
								<p><span><?php echo $value['TBC']; ?></span></p>
								<p>Bonus Codes</p>
							</div>
							<div class="stats">
								<p><span><?php echo $value['TWC']; ?></span></p>
								<p>Web Cards</p>
							</div>
						</section>
						<section class="stats-wrapper">
							<div class="stats">
								<p><span><?php echo $value['TU']; ?></span></p>
								<p>Users</p>
							</div>
							<div class="stats">
								<p><span>362</span></p>
								<p>Comments</p>
							</div>
						</section>
					<?php
						}
					}
					?>
					</div>
				</div>
			</div>
		</section>
		
		<section class="widget small">
			<div class="panel panel-default bt-panel" style="box-shadow:none;">
				<div class="panel-heading">
					<span class="icon">&#128363;</span>
					<hgroup>
						<h5>Timeline</h5>
						<h6>Insiders news</h6>
					</hgroup>
				</div>
				<div class="panel-body">
					<div class="content no-padding timeline">
						<div class="tl-post">
							<span class="icon">&#128206;</span>
							<p><a href="#">John Doe</a> attached an image to a blog post.</p>
						</div>
						<div class="tl-post">
							<span class="icon">&#59172;</span>
							<p><a href="#">John Doe</a> added his location.</p>
						</div>
						<div class="tl-post">
							<span class="icon">&#59170;</span>
							<p><a href="#">John Doe</a> edited his profile.</p>
						</div>
						<div class="tl-post">
							<span class="icon">&#9993;</span>
							<p><a href="#">John Doe</a> has sent you  private message.</p>
						</div>
						<div class="pie graph-area"></div>
					</div>
				</div>
			</div>
		</section>
	</div>
</section>
<?php require_once('includes/doc_footer.php'); ?>