
<!-- modal login -->

		<div class="modal fade in" id="myModal" role="dialog">
	        <div class="modal-dialog modal-sm"><!--  ask-modal-dialog -->
	            <div class="modal-content"><!--  ask-modal-content -->
	            	<div><!--  class="ask-modal-content" style="width:95%;margin:10px auto;" -->
		                <div class="modal-header">
		                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		                    <h4 class="modal-title"><i class="fa fa-sign-in" aria-hidden="true"></i> &nbsp; 로그인</h4>
		                </div>
		                <div class="modal-body">
		                    <form class="kode-loginform ask-login-form" id="loginForm" action="" enctype="multipart/form-data" method="post" autocomplete="off">
		                      	<input type="hidden" name="__FORM" value="_LOGIN_" />
		                      	<p class="border-bottom-5"><input type="text" name="userId" placeholder="아이디" required></p>
		                      	<p class="border-bottom-5"><input type="password" name="password" placeholder="비밀번호" required></p>
		                      	<a href="" class="pull-right myModalThreeBtn" data-toggle="modal" data-target="#myModalThree">비밀번호 찾기</a>
		                      	<br/>
		                      	<div class="row">
			                      	<!-- <div class="col-xs-12">
			                      		<button class="btn btn-ask-green btn-100" type="submit">Sign in</button>
			                      	</div> -->
			                      	<div class="col-xs-12">
			                      		<!-- <a href="#" class="text-white btn btn-ask-red btn-100 myModalTwoBtn" data-backdrop="true" data-toggle="modal" data-target="#myModalTwo">Sign up</a> -->
			                      		<!-- <a href="#" class="text-white btn btn-ask-red btn-100 myModalTwoBtn" data-backdrop="true" data-toggle="modal" data-target="#myModalTwo">Sign up</a> -->
			                      		<!-- <a href="#" class="text-white btn btn-ask-red btn-100 myModalTwoBtn" data-backdrop="false" data-toggle="modal" data-target="#myModalTwo" id="signUp">회원가입</a> -->
			                      		<button type="submit" class="btn btn-subsribe-blue w-100" id="SIGNUPBUTTON"> 로그인 </button>
			                      	</div>
		                      	</div>
		                      	<p class="text-center" style="margin-top:10px;color:#ccc;">----------  OR  ----------</p>
								<!-- <div class="clearfix">
									<a href="" class="btn btn-facebook w-100"><i class="fa fa-facebook-square fa-2x pull-left" aria-hidden="true"></i>페이스북으로 로그인</a>
								</div>
								<br> -->
								<div class="clearfix">
									<?php echo $output_signin; ?>
								</div>
		                    </form>
		                </div>
	                </div>
	            </div>
	        </div>
	    </div>
	    <?php require_once('includes/forgetpwd_modal.php'); ?>
		
        

	    <!-- modal login -->