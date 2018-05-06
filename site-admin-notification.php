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

if(isset($_GET['detail']) && trim($_GET['detail'])){
	$reqID = base64_decode($_GET['detail']);
	$reqID = explode("+", trim($reqID));
	$reqName = str_replace('-', ' ', $reqID['0']);
	$result = $User->query("SELECT * FROM `tblBonusCards` WHERE `id` = '" . $reqID[1] . "'");
	if(isset($result) && is_array($result) && count($result) > 0){
		$_SESSION['value'] = $result;
	}
}

if(isset($_POST) && is_array($_POST) && count($_POST) > 0 && isset($_POST['_COMMENT_CAT']) && $_POST['_COMMENT_CAT'] == 'BONUS_COMMENT' ){
	if(!$User->checkLoginStatus()){
		//$Common->redirect('index.php');
		Message::addMessage("You are not logged in. Please login here to post your comment", ERR);
	}else{
		if($Card->addBonusComments($_POST, $reqID['1'])){
    		//C::redirect(C::link('bonusDetail.php', false, true));
			Message::addMessage("방금 유저 분이 남겨주신 댓글은 관리자의 승인 후 공개됩니다.", SUCCS);
    	}
	}
}


?>
<?php require_once('includes/doc_head.php'); ?>
		<div class="ask-content" id="ask-content">
			<div class="ask-page-content">
				<div class="ask-page-content-header">
					<h3 class="heading text-white text-uppercase">알림 확인하기 </h3><!--  border-bottom-5 -->
				</div>
			</div>
			<div class="ask-page-content notification-siteAdmin">
				<div class="row content hideOnNotification">
					<p class="text-yellow">새로운 알림이 없습니다.</p>
				</div>
			</div>
		</div><!-- #ask-content -->
	</div><!-- parent-container -->
<?php require_once('includes/doc_footer.php'); ?>