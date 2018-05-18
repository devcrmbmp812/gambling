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
						 				<h4 class="page-header">배팅타임에서 사용할 닉네임을 설정해주세요. </h4>
									    <div class="panel-group" id="accordion">
										    <div class="panel panel-default custom-panel">
										      	<div class="panel-heading">
											        <h4 class="panel-title">
										          		<a data-toggle="" data-parent="#accordion" href="#1">닉네임을 입력해주세요.</a>
											        </h4>
										      	</div>
									      		<div id="1" class="panel-  in">
										        	<div class="panel-body">
										        		<form action="index.php" method="post" enctype="multipart/form-data">
											 				
											 				<div class="form-group custom-fields" id="frmCheckNickName">
											 					<label for="nickName"> 닉네임</label>
											 						<input type="text" name="nickName" id="nickName" class="form-control" placeholder="Nick Name" required /><span id="user-availability-status" class="text-yellow"></span>
											 				</div>
														    <div>
														      	<button type="submit" class="btn btn-ask-red btn-w50" style="margin-left:0px;margin-right:2px;">등록하기</button>
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