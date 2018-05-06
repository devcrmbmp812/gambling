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

if(isset($_POST) && is_array($_POST) && count($_POST) > 0){
    if($Card->updateNotice($_POST)){
    	C::redirect(C::link('notice.php', false, true));
    }	
}


$editValue = array(
	'id' => '',
	'noticeTitle' => '',
	'noticeText' => ''
);
if(isset($_GET['edit']) && trim($_GET['edit'])){
 	$reqID = explode("+", trim($_GET['edit']));
if($reqID['1'] == 'edit') {
// 	$Base->query("UPDATE `tblNotice` SET `isPined` = 'N' WHERE id = '" . $reqID['0'] . "'");
	$r = $User->query("SELECT `id`, `noticeTitle`, `noticeText` FROM `tblNotice` WHERE `id` = '" . $_GET['edit'] . "' LIMIT 0, 1");

	if($r && is_array($r) && count($r) > 0){
		$editValue['id'] = $r[0]['id'];
		$editValue['noticeTitle'] = $r[0]['noticeTitle'];
		$editValue['noticeText'] = $r[0]['noticeText'];
	}
// 	C::redirect(C::link('notice.php', false, true));
	}
}	

$activeNavigation = "notice";
?>



<?php require_once('includes/doc_head.php'); ?>

<!-- <section class="alert">
	<form method="link" action="page-new.html">
		 <button class="green">Create new Category</button>
	</form>
</section> -->
<section class="content">
	<section class="widget">
		<div class="panel panel-default bt-panel" style="box-shadow:none;">
			<div class="panel-heading">
				<span class="icon">&#128196;</span>
				<hgroup>
					<h5>Notice</h5>
					<h6>Add notice here</h6>
				</hgroup>
			</div>
			<div class="panel-body">
				<div class="content">
					<form action="" method="post" enctype="multipart/form-data">
						<div class="field-wrap form-group">
							<input type="text" name="noticeTitle" value="<?php echo $editValue['noticeTitle']; ?>" placeholder="Notice Title" />
							<input type="hidden" name="id" value="<?php echo $editValue['id']; ?>" />
						</div>
						<div class="field-wrap form-group">
							<textarea name="noticeText" rows="5"><?php echo $editValue['noticeText']; ?></textarea>
						</div><br />
						<button type="submit" class="btn btn-info">POST</button> <!-- <button type="submit" class="">Preview</button> -->
					</form>
				</div>
			</div>
		</div>
	</section>
</section>

<?php require_once('includes/doc_footer.php'); ?>