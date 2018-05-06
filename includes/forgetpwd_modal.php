<?php
require_once ('config.php');
$User = new User();
$Common = new Common();



?>

<div class="modal fade" id="myModalThree" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-sm"><!--  ask-modal-dialog -->
        <div class="modal-content"><!--  ask-modal-content -->
        	<div><!--  class="ask-modal-content" style="width:95%;margin:10px auto;" -->
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">비밀번호 찾기</h4>
                </div>
                <div class="modal-body">
                    <form class="kode-loginform ask-login-form" id="" name="sndPwd" action="" enctype="multipart/form-data" method="post" autocomplete="off">
                        <input type="hidden" name="__FORM" value="_PASSWORD_" />
                      	<p class="border-bottom-5"><input type="text" name="email" class="login-input" placeholder="가입된 이메일을 입력해주세요."></p>
                      	<div class="row">
	                      	<div class="col-xs-12">
	                      		<!-- <button class="btn btn-ask-green btn-100" type="submit">Send password</button> -->
                                <button type="submit" class="btn btn-subsribe-blue w-100" id="SIGNUPBUTTON"> 비밀번호 확인 요청 </button>
	                      	</div>
	                      	<!-- <div class="col-xs-12">
	                      		<a href="#" class="text-white btn btn-ask-red btn-100 myModalTwoBtn" data-toggle="modal" data-target="#myModalTwo">Sign up</a>
	                      	</div> -->
                      	</div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>