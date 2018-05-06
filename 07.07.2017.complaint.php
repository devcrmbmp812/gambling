<?php require_once('includes/doc_head.php'); ?>
			<div class="ask-content" id="ask-content">
				<div class="row">
					<div class="col-lg-3 col-md-3 col-lg-push-9 col-md-push-9" style="padding-left: 0px;">
						<?php require_once('includes/sportsRecommend.php'); ?>
					</div>
					<div class="col-lg-9 col-md-9 col-lg-pull-3 col-md-pull-3">
						<div class="ask-page-content ask-land-page-content">
							<div class="ask-page-content-header">
								<?php
									$result = $User->query("SELECT `categoryTitle`, `categoryContent` FROM `tblContent` WHERE `categoryPage` = 'complaint' LIMIT 1");
									if(isset($result) && count($result) > 0){
								?>
								<h3 class="text-uppercase"><?php echo $result[0]['categoryTitle']; ?> </h3><!--  border-bottom-5 -->
								<article class="custom-text text-white"><?php echo $result[0]['categoryContent']; ?></article>
								<?php
								}
								?>
							</div>
							<div class="ask-page-content-body">
								<?php
								if(isset($_GET['catComp']) && trim($_GET['catComp'])){
									$catComp = $_GET['catComp'];
									if($catComp == 'OP'){
										$result = $User->query("SELECT `id`, `reason`, `siteName`, `complaintTitle`, `complaintText`, `amount`, `isVerified`, `status` FROM `tblComplaints` WHERE `isVerified` = 'Y' AND `status` = 'P' ORDER BY `updatedOn` DESC");
									} elseif($catComp == 'RE'){
										$result = $User->query("SELECT `id`, `reason`, `siteName`, `complaintTitle`, `complaintText`, `amount`, `isVerified`, `status` FROM `tblComplaints` WHERE `isVerified` = 'Y' AND `status` = 'S' ORDER BY `updatedOn` DESC");
									} elseif($catComp == 'UN'){
										$result = $User->query("SELECT `id`, `reason`, `siteName`, `complaintTitle`, `complaintText`, `amount`, `isVerified`, `status` FROM `tblComplaints` WHERE `isVerified` = 'Y' AND `status` = 'U' ORDER BY `updatedOn` DESC");
									} elseif($catComp == 'PI'){
										$result = $User->query("SELECT `id`, `reason`, `siteName`, `complaintTitle`, `complaintText`, `amount`, `isVerified`, `status` FROM `tblComplaints` WHERE `isVerified` = 'Y' AND `reason` = '입출금 지연' OR '입출금 거절' OR '추가입금 요구' ORDER BY `updatedOn` DESC");
									} elseif($catComp == 'BI'){
										$result = $User->query("SELECT `id`, `reason`, `siteName`, `complaintTitle`, `complaintText`, `amount`, `isVerified`, `status` FROM `tblComplaints` WHERE `isVerified` = 'Y' AND `reason` = '보너스 조건 위반' OR '보너스 지불 거절' OR '보너스 지불 거절' ORDER BY `updatedOn` DESC");
									} elseif($catComp == 'OI'){
										$result = $User->query("SELECT `id`, `reason`, `siteName`, `complaintTitle`, `complaintText`, `amount`, `isVerified`, `status` FROM `tblComplaints` WHERE `isVerified` = 'Y' AND `reason` = '계정 잠금' OR '사이트 규정 위반' OR '기타' ORDER BY `updatedOn` DESC");
									}
								}else{
									$result = $User->query("SELECT `id`, `reason`, `siteName`, `complaintTitle`, `complaintText`, `amount`, `isVerified`, `status` FROM `tblComplaints` WHERE `isVerified` = 'Y' ORDER BY `updatedOn` DESC");
								}
								?>
								<?php
								if(is_array($result) && count($result) > 0){
									foreach ($result as $key => $value) {				
								?>
								<div class="col-md-3 col-sm-3 col-xs-3 padding0  ask-land-web-card">
									<div class="ask-cards">
										<div class="ask-item-complain-card">
											<div class="front">
												<a href="complaint-details/<?php echo $value['id'];?>/">
													<div class="complain-logo">
														<?php
														if($value['status'] == 'P'){
													?>
														<div class="ask-ripple ask-ripple-pending">
															<span class="glyphicon glyphicon-hourglass ask-complai-logo complai-pending"></span>
															<span class="ripple-pending"></span>
														</div>
													<?php
														}else if($value['status'] == 'S'){
													?>
														<div class="ask-ripple ask-ripple-success">
															<span class="glyphicon glyphicon-ok-sign ask-complai-logo complai-success"></span>
															<span class="ripple-success"></span>
														</div>
													<?php
														}else if($value['status'] == 'U'){
													?>
														<div class="ask-ripple ask-ripple-reject">
															<span class="glyphicon glyphicon-remove-circle ask-complai-logo complai-reject"></span>
															<span class="ripple-reject"></span>
														</div>
													<?php } ?>
													</div>
												</a>
														<span class="pull-right fa fa-info info"></span>
												<?php
														if($value['status'] == 'P'){
													?>
														<p class="text-center text-capitalize text-pending pt5" style="font-size:15px";><b>Pending</b></p>
													<?php
														}else if($value['status'] == 'S'){
													?>
														<p class="text-center text-capitalize text-sucess pt5" style="font-size:15px";><b>solved</b></p>
													<?php
														}else if($value['status'] == 'U'){
													?>
														<p class="text-center text-capitalize text-reject pt5" style="font-size:15px";><b>unsolved</b></p>
													<?php } ?>
												<a href="complaint-details/<?php echo $value['id'];?>/">
													<div class="complain-short-desc" style="padding-top: 0px;">
														<p><span class="text-capitalize"><b><?php echo $value['siteName']; ?></b></span> -<?php echo C::contentMorewithoutlink($value['complaintTitle'], 100); ?></p>
													</div>
													<div class="complain-Date" style="padding-top: 2px;">
														<p> <span style="line-height:32px;font-size:20px;font-weight:700;"><?php echo $value['amount']; ?> 만원</span><br>
															<span style="line-height:17px;"><?php echo $value['reason']; ?></span> </p>
													</div>
												</a>
											</div><!-- front -->
											<div class="back">
												<div class="complain-short-desc">
													<p style="font-weight:500;"><?php echo substr($value['complaintTitle'], 0, 50); ?><?php if (strlen($value['complaintTitle']) > 50) {
																echo '...';
															}?></p>
												</div>
												<div class="complain-about">
													<p class="text-justify"><?php echo C::contentMorewithoutlink($value['complaintText'], 200); ?></p>
												</div>
												<div class="complaint-readmore">
													<div class="text-center">
														<a href="complaint-details/<?php echo $value['id'];?>/" class="readMore">Read More</a>
													</div>
													<span class="pull-right fa fa-close info"></span>
												</div>
											</div><!-- back -->
										</div><!-- ask-item-complain-card -->
									</div>
								</div><!-- col-md-3 -->
								<?php
								 }
							}
							?>
								
							</div>
						</div><!-- complaint landing-->
					</div><!-- col-lg-9 col-md-9 -->
				</div><!-- row -->
			</div><!-- ask-content -->
		</div><!-- parent-container -->
<?php require_once('includes/doc_footer.php'); ?>