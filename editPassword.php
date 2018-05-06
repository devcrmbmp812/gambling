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



if(isset($_POST) && is_array($_POST) && count($_POST) > 0){
	if($User->changePassword($_POST)){
		C::redirect(C::link('index.php', false, true));
	}
}
?>
<?php require_once('includes/doc_head.php'); ?>
	<div class="ask-content" id="ask-content">
		<div class="row">
			<div class="col-lg-12 col-md-12">
				<div class="ask-page-content-body-details" style="overflow:hidden;">
					<div class="content">
						 	<div class="col-md-12 text-white complain-form">
						 		<h4>개인정보 수정</h4>
							 	<div class="">
						 			<div class="col-md-6">
										<form action="" method="post" enctype="multipart/form-data">
							 				<div class="form-group">
							 					<input type="hidden" value="<?php echo ((int)User::loggedInUserId() > 0 ? User::loggedInUserId() : 0); ?>" name="id" class="form-control" />
							 				</div>
							 				<div class="form-group">
							 					<input type="password" name="oldPassword" class="form-control" placeholder="Old Password" />
							 				</div>
							 				<div class="form-group">
							 					<input type="password" name="newPassword" class="form-control" placeholder="New Password" />
							 				</div>
							 				<div class="form-group">
							 					<input type="password" name="confirmNewPassword" class="form-control" placeholder="Confirm Password" />
							 				</div>
										    <div>
										      	<button type="submit" class="btn btn-ask-red btn-w100" style="margin-left:0px;margin-right:2px;">변경하기</button>
										    </div>
										</form>
						 			</div>
						 			<div class="col-md-6">
						 				<div>
						 					<p class="text-center text-yellow text-capitalize">Connect with us:</p>
						 					<ul class="nav navbar-nav ask-social" style="margin-left:30%;">
												<li class=""><a href="#" class="hvr-shutter-in-vertical-chat" data-backdrop="false" data-toggle="modal" data-target="#modalSocial" data-header="chat" data-content="chat"><b><i class="fa fa-comments-o"></i></b></a></li>
												<li class=""><a href="#" class="hvr-shutter-in-vertical-twitter" data-backdrop="false" data-toggle="modal" data-target="#modalSocial" data-header="twitter" data-content="twit"><b><i class="fa fa-twitter"></i></b></a></li>
												<li class=""><a href="#" class="hvr-shutter-in-vertical-facebook" data-backdrop="false" data-toggle="modal" data-target="#modalSocial" data-header="facebook" data-content="facebook"><b><i class="fa fa-facebook"></i></b></a></li>
												<li class=""><a href="#" class="hvr-shutter-in-vertical-google" data-backdrop="false" data-toggle="modal" data-target="#modalSocial" data-header="google" data-content="google"><b><i class="fa fa-google-plus"></i></b></a></li>

											</ul>
						 				</div>
						 			</div>
							 	</div>
						 	</div>
						</div>
				</div>
			</div><!-- col-lg-12 col-md-12 -->
			
			</div><!-- row -->
		</div><!-- ask-content -->
	</div><!-- parent-container -->
<?php require_once('includes/doc_footer.php'); ?>