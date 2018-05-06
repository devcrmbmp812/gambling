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


$editValue = array(
	'id' => '',
	'userId' => '',
	'nickName' => '',
	'email' => '',
	'password' => '',
	'groupId' => ''
);
if(isset($_POST) && is_array($_POST) && count($_POST) > 0 && isset($_POST['__FORM']) && $_POST['__FORM'] == '_DETAILS_EDIT_'){

	print_r($_POST);
	if($User->updateUserfront($_POST)){
		C::redirect(C::link('index.php', false, true));
	}
}
if(isset($_POST) && is_array($_POST) && count($_POST) > 0 && isset($_POST['__FORM']) && $_POST['__FORM'] == '_PASSWORD_EDIT_'){
	if($User->changePassword($_POST)){
		C::redirect(C::link('index.php', false, true));
	}
}
?>
<?php require_once('includes/doc_head.php'); ?>
	<div class="ask-content" id="ask-content">
		<div class="row">
			<div class="col-lg-9 col-md-9">
				<div class="ask-page-content-body-details" style="overflow:hidden;">
					<div class="content">
						 	<div class="col-md-12 text-white complain-form">
							 	<div class="">
						 			<div class="col-md-12">
						 				<h4 class="page-header">개인정보 수정</h4>
									    <div class="panel-group" id="accordion">
										    <div class="panel panel-default custom-panel">
										      	<div class="panel-heading">
											        <h4 class="panel-title">
										          		<a data-toggle="" data-parent="#accordion" href="#1">프로필 수정하기</a>
											        </h4>
										      	</div>
									      		<div id="1" class="panel-  in">
										        	<div class="panel-body">
										        		<form action="" method="post" enctype="multipart/form-data">
															<?php 
																$logedInID = (int)User::loggedInUserId() > 0 ? User::loggedInUserId() : 0;
															if(isset($logedInID)){
																$result = $User->query("SELECT `id`, `userId`, `nickName`, `email`,`password`, `groupId` FROM `tblUser` WHERE `id` = '" . $logedInID . "' LIMIT 0, 1");
																if($result && is_array($result) && count($result) > 0){
																	$editValue['id'] = $result[0]['id'];
																	$editValue['userId'] = $result[0]['userId'];
																	$editValue['nickName'] = $result[0]['nickName'];
																	$editValue['password'] = $result[0]['password'];
																	$editValue['email'] = $result[0]['email'];
																	$editValue['groupId'] = $result[0]['groupId'];
																}
															}
															?>
											 				<div class="form-group custom-fields">
											 					<label for="userId"> 아이디</label>
											 					<p style=""><strong><?php echo $editValue['userId']; ?></strong></p>
											 					<input type="hidden" value="<?php echo $editValue['userId']; ?>" name="userId" class="form-control" placeholder="USER ID" />
											 					<input type="hidden" value="<?php echo $editValue['id']; ?>" name="id" class="form-control" />
											 					<input type="hidden" value="<?php echo $editValue['groupId']; ?>" name="groupId" class="form-control" />
											 					<input type="hidden" name="__FORM" value="_DETAILS_EDIT_" />
											 				</div>
											 				<div class="form-group custom-fields" id="frmCheckNickName">
											 					<label for="nickName"> 닉네임</label>
											 						<input type="text" value="<?php echo $editValue['nickName']; ?>" name="nickName" id="nickName" class="form-control" placeholder="Nick Name" /><span id="user-availability-status" class="text-yellow"></span>
											 				</div>
											 				<div class="form-group custom-fields">
											 					<label for="email"> 이메일</label>
											 					<input type="email" value="<?php echo $editValue['email']; ?>" name="email" class="form-control" placeholder="Email" />
											 				</div>
														    <div>
														      	<button type="submit" class="btn btn-ask-red btn-w50" style="margin-left:0px;margin-right:2px;">변경하기</button>
														    </div>
														    <style>
																.custom-fields input{
																	width:50%;
																}
														    </style>
														</form>
										        	</div>
									      		</div>
									    	</div>
									    	<div class="panel panel-default custom-panel">
									      		<div class="panel-heading">
									        		<h4 class="panel-title">
									          			<a data-toggle="" data-parent="#accordion" href="#2">비밀번호 변경</a>
									        		</h4>
									      		</div>
									      		<div id="2" class="panel- ">
									        		<div class="panel-body">
									        			<form action="" method="post" enctype="multipart/form-data">
											 				<div class="form-group custom-fields">
											 					<input type="hidden" name="__FORM" value="_PASSWORD_EDIT_" />
											 					<input type="hidden" value="<?php echo ((int)User::loggedInUserId() > 0 ? User::loggedInUserId() : 0); ?>" name="id" class="form-control" />
											 				</div>
											 				<div class="form-group custom-fields">
											 					<label for="oldPassword">기존 비밀번호 입력</label>
											 					<input type="password" name="oldPassword" class="form-control" placeholder="Old Password" />
											 				</div>
											 				<div class="form-group custom-fields">
											 					<label for="newPassword">새로운 비밀번호 입력</label>
											 					<input type="password" name="newPassword" class="form-control" placeholder="New Password" />
											 				</div>
											 				<div class="form-group custom-fields">
											 					<label for="confirmNewPassword">새로운 비밀번호 확인</label>
											 					<input type="password" name="confirmNewPassword" class="form-control" placeholder="Confirm Password" />
											 				</div>
														    <div>
														      	<button type="submit" class="btn btn-ask-red btn-w50" style="margin-left:0px;margin-right:2px;">변경하기</button>
														    </div>
														</form>
									        		</div>
									      		</div>
									    	</div>
									  	</div>
						 			</div>
							 	</div>
						 	</div>
						</div>
				</div>
			</div><!-- col-lg-9 col-md-9 -->
			<div class="col-lg-3 col-md-3 sticky_column">
				<?php require_once('includes/sportsRecommend.php'); ?>
			</div>
			
			</div><!-- row -->
		</div><!-- ask-content -->
	</div><!-- parent-container -->
<?php require_once('includes/doc_footer.php'); ?>