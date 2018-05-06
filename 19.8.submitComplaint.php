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




if(isset($_POST) && is_array($_POST) && count($_POST) > 0 && isset($_POST['_IDENTITY']) && $_POST['_IDENTITY'] == 'complainsubmit'){ 
	if(!$User->checkLoginStatus()){
		//$Common->redirect('index.php');
		Message::addMessage("You are not logged in. Please login here to post your Complaints", ERR);
	}else{
		if($Card->addComplaint($_POST, $_FILES)){
			//C::redirect(C::link('submitComplaint.php', false, true));
			Message::addMessage("Your Complaint is posted successfully.It will display after verification!!!", SUCCS);
    	}
	}
}
?>
<?php require_once('includes/doc_head.php'); ?>
			<div class="test">
				<div class="row content">
					<div class="image-complain"></div>
					<h2 class="text-center text-uppercase text-white">사이트와 문제가 있으신가요? 저희가 도와드리겠습니다</h2>
					<div class="details-page">
						<div class="row">
							<div class="col-md-4">
								<div class="complainPage-page-logo">
									<div class="complain-logo">
										<div class="ask-ripple">
											<span class="glyphicon glyphicon-hourglass ask-complai-logo complai-pending"></span>
											<span class="ripple-pending" style="z-index:-1;"></span>
										</div>
									</div>
								</div>
								<div class="complainPage-counter">
									<p class="text-center text-white">진행중</p>
									<?php 
									$result = $User->query("SELECT COUNT( * ) AS `count` , `status` FROM `tblComplaints` GROUP BY `status` ");
									?>
									
									<h2 class="text-center text-white complain-counter"><?php echo $result[0]['count'];?></h2>
								</div>
							</div>
							<div class="col-md-4">
								<div class="complainPage-page-logo">
									<div class="complain-logo">
										<div class="ask-ripple">
											<span class="glyphicon glyphicon glyphicon-ok-sign ask-complai-logo complai-success"></span>
											<span class="ripple-success"></span>
										</div>
									</div>
								</div>
								<div class="complainPage-counter">
									<p class="text-center text-white">해결완료</p>
									<h2 class="text-center text-white complain-counter"><?php echo $result[1]['count'];?></h2>
								</div>
							</div>
							<div class="col-md-4">
								<div class="complainPage-page-logo">
									<div class="complain-logo">
										<div class="ask-ripple">
											<span class="glyphicon glyphicon-remove-circle ask-complai-logo complai-reject"></span>
											<span class="ripple-reject"></span>
										</div>
									</div>
								</div>
								<div class="complainPage-counter">
									<p class="text-center text-white">해결실패</p>
									<h2 class="text-center text-white complain-counter"><?php echo $result[2]['count'];?></h2>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="clearfix"></div>
			<style>
			select option {
				/*margin:40px;*/
				background: rgba(0,0,0,0.3);
				color:#fff;
				text-shadow:0 1px 0 rgba(0,0,0,0.4);
			}
			 #sel2 option {
				/*margin:40px;*/
				background: #051730 !important;
				color:#fff !important;
				text-shadow:0 1px 0 rgba(0,0,0,0.4) !important;
			}
			.not-show{display:none;}
			</style>
			<div class="ask-content" id="ask-content">
				<div class="row">
					<div class="col-lg-12 col-md-12">
						<div class="ask-page-content">
							<div class="ask-page-content-header">
								<h3 class="heading text-white text-uppercase">사이트 분쟁 해결을 신청해주세요 </h3><!--  border-bottom-5 -->
							</div>
							<div class="ask-page-content-body-details" style="overflow:hidden;">
								<div class="content">
									<form action="" method="POST" enctype="multipart/form-data">
										<p class="text-white">회원님의 문제와 가장 가까운 옵션을 선택해주세요</p>
									 	<div class="col-md-6">
										 	<select class="form-control issue-select categoryComplaint" id="sel1" name="reason" required>
										 		<option value=""></option>
										 		<optgroup label="입금/출금">
											    	<option value="입출금 지연">입출금 지연</option>
											    	<option value="입출금 거절">입출금 거절</option>
											    	<option value="추가입금 요구">추가입금 요구</option>
												</optgroup>
												<optgroup label="보너스">
											    	<option value="보너스 조건 위반">보너스 조건 위반</option>
											    	<option value="보너스 지불 거절">보너스 지불 거절</option>
											    	<option value="보너스 지불 거절">보너스 철회 거절</option>
												</optgroup>
												<optgroup label="계정">
											    	<option value="계정 잠금">계정 잠금</option>
											    	<option value="사이트 규정 위반">사이트 규정 위반</option>
												</optgroup>
												<optgroup label="기타">
											    	<option value="기타">기타</option>
												</optgroup>
								  			</select>
									 	</div>
									 	<div class="clearfix"></div>
									 	<div class="col-md-12 margin-top-30">
										 	<h3 id="issue-heading" class="text-yellow page-header"></h3>
											<div class="reason-text">
												<div id="text-paste" class="text-white"></div>
											</div>
									 	</div>
									 	<div class="col-md-12 margin-top-30 text-white">
									 		<h4>위에 해결안이 도움 되셨나요?</h4>
										 	<div class="radio">
										      	<label><input type="radio" name="optradio" autocomplete="off"> 네. 도움 됐습니다. 해결할 수 있을 것 같아요.</label>
										    </div>
										    <div class="radio">
										      	<label><input type="radio" name="optradio" id="optradioNo" autocomplete="off">아니요. 여전히 도움이 필요합니다. (분쟁 해결 신청을 원하시면 여길 클릭해주세요.)
</label>
										    </div>
									 	</div>
									 	<div class="col-md-12 margin-top-30 text-white" id="complain-form">
									 		<h4>분쟁해결 신청서:</h4>
										 	<ul>
										 		<li>자세한 내용을 적어주세요.</li>
										 		<li>해당 내용을 뒷받침해줄 증거 자료를 올려주세요</li>
										 		<li>욕설과 비속어는 자제해주세요</li>
										 		<li>거짓된 자료와 사실이 아닌 내용으로 신청할 경우, 해당 회원은 제재대상입니다</li>
										 	</ul>
										 	<div class="">
									 			<div class="col-md-6">
									 				<div class="form-group">
									 					<input type="text" name="complaintTitle" class="form-control" placeholder="제목" required />
									 					<input type="hidden" name="_IDENTITY" class="form-control" value="complainsubmit" />
									 				</div>
									 				<div class="form-group">
									 					<select class="form-control" id="sel2" name="link" required>
													    <?php
															$res = $User->query("SELECT `siteName`, `link` FROM `tblWebCards` GROUP BY `siteName`");
																if(isset($res) && is_array($res) && count($res) > 0){
																	foreach ($res as $id => $data) {
														?>
													    	<!-- <option value="<?php echo $data['link'].'/'.$data['siteName']; ?>"><?php echo $data['siteName']; ?></option> -->
													    	<option value="<?php echo $data['link']; ?>"><?php echo $data['siteName']; ?></option>
												    	<?php
												    		}
												    	}
												    	?>
											  			</select>
											  			<input type="hidden" name="siteName" id="complaintSitName" value="" />
									 				</div>
									 				<div class="form-group">
									 					<textarea name="complaintText" id="" rows="3" style="width:100%;" placeholder="내용" required></textarea>
									 				</div>
									 				<div class="form-group">
									 					<input type="text" name="amount" class="form-control" placeholder="피해금액 (만원단위로 입력해주세요. 10만원일 경우, 10)" required />
									 				</div>
									 				<div class="form-group addMoreContainer">
									 					<input type="file" name="complaintFiles[]" class="form-control complaintFiles" />
									 					<button type="button" class="btn btn-ask-green" id="addMoreFile">파일 추가</button>
									 					<button type="button" class="btn btn-ask-red" id="removeFile">파일 삭제</button>
									 				</div>
									 				<h4 class="text-yellow">아래 개인정보는 사이트에 공개되지 않습니다</h4>
									 				<div class="form-group">
									 					<input type="text" name="onSiteAccountName" class="form-control" placeholder="사이트에서 사용 하신 아이디를 입력해주세요" required />
									 				</div>
									 				<div class="form-group">
									 					<input type="text" name="onSiteEmail" class="form-control" placeholder="회원님의 연락처를 남겨주세요" />
									 				</div>
									 				<div class="radio">
												      	<label><input type="radio" name="radioTerms" autocomplete="off" required>I read the <a href="termsandcondition.php" class="text-red">Terms and Conditions</a></label>
												    </div>
												    <div>
												      	<button type="submit" class="btn btn-ask-red btn-w100">분쟁해결 신청하기</button>
												    </div>
									 			</div>
										 	</div>
									 	</div>
									</div>
								</form>
							</div>
						</div>
					</div><!-- col-lg-12 col-md-12 -->
				</div><!-- row -->
			</div><!-- ask-content -->
		</div><!-- parent-container -->
		
<?php require_once('includes/doc_footer.php'); ?>