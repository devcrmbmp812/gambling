<?php
require_once('config.php');	

// Load Classes
C::loadClass('User');
C::loadClass('Card');
C::loadClass('CMS');
//Init User class
$User = new User();
$Card = new Card();

?>
<?php require_once('includes/doc_head.php'); ?>
<?php if(isset($_GET)){
	$email = $_GET['email'];
	$hash = $_GET['hash'];

	$fetch = $User->query("SELECT `id` FROM `tblUser` WHERE `email`='".$email."' AND `hash`='".$hash."' LIMIT 0, 1");
	if($fetch > 0){
		$User->query("UPDATE `tblUser` SET `emailValid` ='Y' WHERE `id`='".$fetch[0]['id']."'");
?>
	<div class="ask-content">
		<div class="row">
			<div class="col-lg-12 col-md-12">
				<div class="ask-page-content ask-land-page-content">
					<div style="padding: 45px 20px">
						<p class="text-yellow">이메일 인증이 완료되었습니다. 배팅타임의 회원이 되신걸 환영합니다!</p>
						<p class="text-yellow">회원가입하실 때 입력해주신 <strong>아이디</strong> 와 <strong>비밀번호</strong>를 입력하여 로그인해주세요.</p>
						<p class="text-yellow">만약 배팅타임 혹은 배팅타임에 등록된 사이트 관련하여 문의가 있으실 경우, 오른쪽 하단 고객센터를 이용해주세요.</p>
					</div>
				</div>
			</div>
		</div>
	</div>
<?php
	}
}
?>
</div>

<?php require_once('includes/doc_footer.php'); ?>

