
<!-- modal signup myModalTwo-->
	    <div class="modal fade" id="myModalTwo" tabindex="-1" role="dialog" aria-hidden="true">
	        <div class="modal-dialog modal-sm"><!--  ask-modal-dialog -->
	            <div class="modal-content"><!--  ask-modal-content -->
	            	<div><!--  class="ask-modal-content" style="width:95%;margin:10px auto;" -->
		                <div class="modal-header">
		                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		                    <h4 class="modal-title"><i class="fa fa-bookmark" aria-hidden="true"></i> &nbsp; 배팅타임 회원가입</h4>
		                </div>
		                <div class="modal-body">
		                	<!-- <div class="login-icon-ask visible-md visible-lg">
		                		<span class="glyphicon glyphicon-pin login-glymph-icon"></span>
		                		<img src="images/user2.png" class=""  alt="">
		                	</div> -->
		                	<!-- <?php require_once(INCLUDES . "message.php");?> -->
		                	<style>
		                		.user-check-result, .user-email-result{
		                			display: none;
		                		}

		                	</style>
		                    <form class="kode-loginform ask-login-form" id="signupForm" action="" enctype="multipart/form-data" method="post" autocomplete="off">
		                    	<input type="hidden" name="__FORM" value="_SIGNUP_" />
		                    	<p class="border-bottom-2 user-check-style"><input type="text" name="tblUser[userId]" id="tblUser_userId" placeholder="아이디" required></p>
		                    	<span class="user-check-result text-red"></span>
		                    	<p class="border-bottom-2"><input type="text" name="tblUser[nickName]" id="tblUser_nickName" placeholder="닉네임" required></p>
		                      	<p class="border-bottom-2 user-email-style"><input type="email" name="tblUser[email]" id="tblUser_email" placeholder="이메일(인증필수)" required></p>
		                      	<span class="user-email-result text-red"></span>
		                      	<p class="border-bottom-2"><input type="password" name="tblUser[password]" id="tblUser_password" placeholder="비밀번호" required></p>
		                      	<p class="border-bottom-2"><input type="password" name="tblUser[confirmpassword]" id="tblUser_confirm_password" placeholder="비밀번호 확인" required></p>
		                      	<div class="row">
		                      		<div class="col-xs-12">
		                      			<button type="submit" class="btn btn-subsribe-blue w-100" id="SIGNUPBUTTON"> 회원가입 신청하기</button>
		                      		</div>
	                      		</div>
	                      		<p class="text-center" style="margin-top:10px;color:#ccc;">----------  OR  ----------</p>
								<!-- <div class="clearfix">
									<a href="" class="btn btn-facebook w-100"><i class="fa fa-facebook-square fa-2x pull-left" aria-hidden="true"></i>페이스북으로 가입 신청하기</a>
								</div> -->
								<br>
								<div class="clearfix">
									<?php echo $output; ?>
								</div>
		                    </form>
		                </div>
	                </div>
	            </div>
	        </div>
	    </div>
	    <!-- modal signup -->