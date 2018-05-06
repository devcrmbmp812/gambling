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
	$Common->redirect('complaint.php');
}
?>
<?php require_once('includes/doc_head.php'); ?>
<section class="alert">
	<div class="green">	
		<!-- <p style="text-transform:uppercase;"><?php echo $the_message; ?></p> -->
		<!-- <span class="close">&#10006;</span> -->
		<?php
		if(isset($fieldArray)){
		?>
		<p style="text-transform:uppercase;"><?php echo $the_message; ?></p>
		<span class="close">&#10006;</span>
		<?php
		}
		?>
	</div>
</section>
<section class="content">
	<section class="widget">
		<iframe src="chat.php" id="chatFrame" width="100%" frameborder="0">
			Sorry your browser does not support inline frames.
		</iframe>
	</section>
</section>
<?php require_once('includes/doc_footer.php'); ?>