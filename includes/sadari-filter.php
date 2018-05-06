						<div class="panel panel-default ask-panel custom-show" id="fixed-right" style="margin-top: 5px;">
						<form method="get" id="search_form">
					  		<!-- <div class="panel-heading ask-panel-heading-filter ask-panel"><b style="margin-left: -10px;">평점</b></div>
						  	<div class="panel-body ask-panel-body-filter custom-height">
						  	<?php 
						  		if(isset($_GET['rating'])) :
                                    if(in_array($_GET['rating'], $_GET['rating'])) : 
                                        $rating_check='checked="checked"';
                                    else : $rating_check="";
                                    endif;
                                endif;
						  	?>
						  	<?php
						  		$result = $User->query("SELECT DISTINCT `rating` FROM `tblSadariCards` ORDER BY `rating` DESC");
						  		if(is_array($result) && count($result) > 0){
									foreach ($result as $key => $value) {
										if(isset($_GET['rating'])) :
	                                        if(in_array($value['rating'],$_GET['rating'])) : 
	                                            $rating_check='checked="checked"';
	                                        else : $rating_check="";
	                                        endif;
	                                    endif;
						  	?>
						  		<div class="checkbox custom-checkbox">
								  	<label><input type="checkbox" name=rating[] value="<?php echo $value['rating'];?>" class="filter1" <?=@$rating_check?> /> <?php echo $value['rating'];?> STAR</label>
								</div>
							<?php
									}
								}
							?>
						  	</div> -->
						  	<div class="panel-heading ask-panel-heading"><b style="margin-left: -10px;"><i class="fa fa-filter" aria-hidden="true"></i> &nbsp;Filter By</b></div>
						  	<div class="panel-heading ask-panel-heading-filter ask-panel collapsed" data-toggle="collapse" data-target="#sadariOddoption"><b style="margin-left: -10px;">사다리 배당</b><span class="acc-drop pull-right"></span></div>

						  	<div class="panel-body ask-panel-body-filter custom-height collapse" id="sadariOddoption">
						  	<?php
						  		$result = $User->query("SELECT DISTINCT `sadariOdd` FROM `tblSadariCards`");
						  		if(is_array($result) && count($result) > 0){
									foreach ($result as $key => $value) {
										if(isset($_GET['sadariOdd'])) :
	                                        if(in_array($value['sadariOdd'],$_GET['sadariOdd'])) : 
	                                            $sadariOdd_check='checked="checked"';
	                                        else : $sadariOdd_check="";
	                                        endif;
	                                    endif;
						  	?>
						  		<div class="checkbox custom-checkbox">
								  	<label><input type="checkbox" name=sadariOdd[] value="<?php echo $value['sadariOdd'];?>" class="filter1" <?=@$sadariOdd_check?>  /> <?php echo $value['sadariOdd'];?></label>
								</div>
							<?php
									}
								}
							?>
						  	</div>
						  	

						  	<div class="panel-heading ask-panel-heading-filter ask-panel collapsed" data-toggle="collapse" data-target="#closingTimeoption"><b style="margin-left: -10px;">배당 닫히는 시간 (sec)</b><span class="acc-drop pull-right"></span></div>

						  	<div class="panel-body ask-panel-body-filter custom-height collapse" id="closingTimeoption">
						  	<?php
						  		$result = $User->query("SELECT DISTINCT `closingTime` FROM `tblSadariCards`");
						  		if(is_array($result) && count($result) > 0){
									foreach ($result as $key => $value) {
										if(isset($_GET['closingTime'])) :
	                                        if(in_array($value['closingTime'],$_GET['closingTime'])) : 
	                                            $closingTime_check='checked="checked"';
	                                        else : $closingTime_check="";
	                                        endif;
	                                    endif;
						  	?>
						  		<div class="checkbox custom-checkbox">
								  	<label><input type="checkbox" name=closingTime[] value="<?php echo $value['closingTime'];?>" class="filter1" <?=@$closingTime_check?>  /> <?php echo $value['closingTime'];?></label>
								</div>
							<?php
									}
								}
							?>
						  	</div>
						  	
						  	<div class="panel-heading ask-panel-heading-filter ask-panel collapsed" data-toggle="collapse" data-target="#betting-optionoption"><b style="margin-left: -10px;">배팅 가능 여부</b><span class="acc-drop pull-right"></span></div>

						  	<div class="panel-body ask-panel-body-filter custom-height collapse" id="betting-optionoption">
						  	<?php
						  		$result = $User->query("SELECT `value` FROM `tblFilter` WHERE `name` = 'betting-option'");
						  		if(is_array($result) && count($result) > 0){
									foreach ($result as $key => $value) {
										if(isset($_GET['bettingOption'])) :
	                                        if(in_array($value['value'],$_GET['bettingOption'])) : 
	                                            $bettingOption_check='checked="checked"';
	                                        else : $bettingOption_check="";
	                                        endif;
	                                    endif;
						  	?>
						  		<div class="checkbox custom-checkbox">
								  	<label><input type="checkbox" name=bettingOption[] value="<?php echo $value['value'];?>" class="filter1" <?=@$bettingOption_check?> /> <?php echo $value['value'];?></label>
								</div>
							<?php
									}
								}
							?>
						  	</div>
						  	

						  	<div class="panel-heading ask-panel-heading-filter ask-panel collapsed" data-toggle="collapse" data-target="#rollingConditionoption"><b style="margin-left: -10px;">사다리 롤링 조건</b><span class="acc-drop pull-right"></span></div>

						  	<div class="panel-body ask-panel-body-filter custom-height collapse" id="rollingConditionoption">
						  	<?php
						  		$result = $User->query("SELECT DISTINCT `rollingCondition` FROM `tblSadariCards` WHERE `rollingCondition` != ''");
						  		if(is_array($result) && count($result) > 0){
									foreach ($result as $key => $value) {
										if(isset($_GET['rollingCondition'])) :
	                                        if(in_array($value['rollingCondition'],$_GET['rollingCondition'])) : 
	                                            $rollingCondition_check='checked="checked"';
	                                        else : $rollingCondition_check="";
	                                        endif;
	                                    endif;
						  	?>
						  		<div class="checkbox custom-checkbox">
								  	<label><input type="checkbox" name=rollingCondition[] value="<?php echo $value['rollingCondition'];?>" class="filter1" <?=@$rollingCondition_check?> /> <?php echo $value['rollingCondition'];?></label>
								</div>
							<?php
									}
								}
							?>
						  	</div>
						  	
						  	<div class="panel-heading ask-panel-heading-filter ask-panel collapsed" data-toggle="collapse" data-target="#maximumBettingoption"><b style="margin-left: -10px;">MAX BETTING AMOUNT</b><span class="acc-drop pull-right"></span></div>

						  	<div class="panel-body ask-panel-body-filter collapse" id="maximumBettingoption">
						  	<?php
						  		$result = $User->query("SELECT MAX(`maximumBetting`) FROM `tblSadariCards`");
						  		if(is_array($result) && count($result) > 0){
									foreach ($result as $key => $value) {
										if(isset($_GET['maximumBetting'])) :
						                        $maximumBetting_check=$_GET['maximumBetting'];
						                    $maximumBettingCustom_check='checked="checked"';
						                    else : $maximumBetting_check=$value['MAX(`maximumBetting`)'];
						                    	$maximumBettingCustom_check='';
						                endif;
						  	?>
								<div class="range1">
								    <output for="maximumBetting" class="output text-center text-white"><?php echo $maximumBetting_check;?> 원</output>
								    <input type="range" name="" class="filter1 maximumBettingFilter" min="0" max="<?php echo $value['MAX(`maximumBetting`)'];?>" step="1" value="<?php echo $maximumBetting_check;?>">
								    <input type="checkbox" name="maximumBetting" value="<?php echo $maximumBetting_check;?>" <?=@$maximumBettingCustom_check?> class="custm-check maximumBettingCheck"  />
							    </div>
							<?php
									}
								}
							?>
						  	</div>
						  	<!-- <div class="panel-heading ask-panel-heading-filter"><b style="margin-left: -10px;">Min BETTING AMOUNT</b></div>
						  	<div class="panel-body ask-panel-body-filter custom-height">
						  	<?php
						  		$result = $User->query("SELECT MAX(`minBettingAmount`) FROM `tblSadariCards`");
						  		if(is_array($result) && count($result) > 0){
									foreach ($result as $key => $value) {
										if(isset($_GET['minBettingAmount'])) :
						                        $minBettingAmount_check=$_GET['minBettingAmount'];
						                    $minBettingAmountCustom_check='checked="checked"';
						                    else : $minBettingAmount_check=$value['MAX(`minBettingAmount`)'];
						                    	$minBettingAmountCustom_check='';
						                endif;
						  	?>
								<div class="range1">
								    <output for="minBettingAmount" class="output text-center"><?php echo $minBettingAmount_check;?></output>
								    <input type="range" name="" class="filter minBettingAmountFilter" min="0" max="<?php echo $value['MAX(`minBettingAmount`)'];?>" step="1" value="<?php echo $minBettingAmount_check;?>">
								    <input type="checkbox" name="minBettingAmount" value="<?php echo $minBettingAmount_check;?>" <?=@$minBettingAmountCustom_check?> class="custm-check minBettingAmountCheck"  />
							    </div>
							<?php
									}
								}
							?>
						  	</div> -->
						  	
						  	<div class="panel-heading ask-panel-heading-filter ask-panel collapsed" data-toggle="collapse" data-target="#maxAwardAmountoption"><b style="margin-left: -10px;">Max award amount</b><span class="acc-drop pull-right"></span></div>

						  	<div class="panel-body ask-panel-body-filter collapse" id="maxAwardAmountoption">
						  	<?php
						  		$result = $User->query("SELECT MAX(`maxAwardAmount`) FROM `tblSadariCards`");
						  		if(is_array($result) && count($result) > 0){
									foreach ($result as $key => $value) {
										if(isset($_GET['maxAwardAmount'])) :
						                        $maxAwardAmount_check=$_GET['maxAwardAmount'];
						                    $maxAwardAmountCustom_check='checked="checked"';
						                    else : $maxAwardAmount_check=$value['MAX(`maxAwardAmount`)'];
						                    	$maxAwardAmountCustom_check='';
						                endif;
						  	?>
								<div class="range1">
								    <output for="maxAwardAmount" class="output text-center text-white"><?php echo $maxAwardAmount_check;?> 원</output>
								    <input type="range" name="" class="filter1 maxAwardAmountFilter" min="0" max="<?php echo $value['MAX(`maxAwardAmount`)'];?>" step="1" value="<?php echo $maxAwardAmount_check;?>">
								    <input type="checkbox" name="maxAwardAmount" value="<?php echo $maxAwardAmount_check;?>" <?=@$maxAwardAmountCustom_check?> class="custm-check maxAwardAmountCheck"  />
							    </div>
							<?php
									}
								}
							?>
						  	</div>
						  	<!--<div class="panel-heading ask-panel-heading-filter"><b style="margin-left: -10px;">REBATE BONUS</b></div>
						  	<div class="panel-body ask-panel-body-filter custom-height">
						  	<?php
						  		$result = $User->query("SELECT DISTINCT `rebateBonus` FROM `tblSadariCards` WHERE `rebateBonus` != ''");
						  		if(is_array($result) && count($result) > 0){
									foreach ($result as $key => $value) {
										if(isset($_GET['rebateBonus'])) :
	                                        if(in_array($value['rebateBonus'],$_GET['rebateBonus'])) : 
	                                            $rebateBonus_check='checked="checked"';
	                                        else : $rebateBonus_check="";
	                                        endif;
	                                    endif;
						  	?>
						  		<div class="checkbox custom-checkbox">
								  	<label><input type="checkbox" name=rebateBonus[] value="<?php echo $value['rebateBonus'];?>" class="filter" <?=@$rebateBonus_check?> /> <?php echo $value['rebateBonus'];?></label>
								</div>
							<?php
									}
								}
							?>
						  	</div>
						  	<div class="panel-heading ask-panel-heading-filter"><b style="margin-left: -10px;">Rolling BONUS</b></div>
						  	<div class="panel-body ask-panel-body-filter custom-height">
						  	<?php
						  		$result = $User->query("SELECT DISTINCT `rollingBonus` FROM `tblSadariCards` WHERE `rollingBonus` != ''");
						  		if(is_array($result) && count($result) > 0){
									foreach ($result as $key => $value) {
										if(isset($_GET['rollingBonus'])) :
	                                        if(in_array($value['rollingBonus'],$_GET['rollingBonus'])) : 
	                                            $rollingBonus_check='checked="checked"';
	                                        else : $rollingBonus_check="";
	                                        endif;
	                                    endif;
						  	?>
						  		<div class="checkbox custom-checkbox">
								  	<label><input type="checkbox" name=rollingBonus[] value="<?php echo $value['rollingBonus'];?>" class="filter" <?=@$rollingBonus_check?> /> <?php echo $value['rollingBonus'];?></label>
								</div>
							<?php
									}
								}
							?>
						  	</div>
						  	<div class="panel-heading ask-panel-heading-filter"><b style="margin-left: -10px;">LIVE CHAT</b></div>
						  	<div class="panel-body ask-panel-body-filter">
						  	<?php
						  		$result = $User->query("SELECT DISTINCT `liveChat` FROM `tblSadariCards` WHERE `liveChat` != ''");
						  		if(is_array($result) && count($result) > 0){
									foreach ($result as $key => $value) {
										if(isset($_GET['liveChat'])) :
	                                        if(in_array($value['liveChat'],$_GET['liveChat'])) : 
	                                            $liveChat_check='checked="checked"';
	                                        else : $liveChat_check="";
	                                        endif;
	                                    endif;
						  	?>
						  		<div class="checkbox custom-checkbox">
								  	<label><input type="checkbox" name=liveChat[] value="<?php echo $value['liveChat'];?>" class="filter" <?=@$liveChat_check?> /> <?php echo $value['liveChat'];?></label>
								</div>
							<?php
									}
								}
							?>
						  	</div>
						  	<div class="panel-heading ask-panel-heading-filter"><b style="margin-left: -10px;">Established</b></div>
						  	<div class="panel-body ask-panel-body-filter custom-height">
						  	<?php
						  		$result = $User->query("SELECT DISTINCT `established` FROM `tblSadariCards` WHERE `established` != ''");
						  		if(is_array($result) && count($result) > 0){
									foreach ($result as $key => $value) {
										if(isset($_GET['established'])) :
	                                        if(in_array($value['established'],$_GET['established'])) : 
	                                            $established_check='checked="checked"';
	                                        else : $established_check="";
	                                        endif;
	                                    endif;
						  	?>
						  		<div class="checkbox custom-checkbox">
								  	<label><input type="checkbox" name=established[] value="<?php echo $value['established'];?>" class="filter" <?=@$established_check?> /> <?php echo $value['established'];?></label>
								</div>
							<?php
									}
								}
							?>
						  	</div>-->
						  	<!-- <style>
							.ask-panel-heading-filter{
								background: rgba(0, 0, 0, 0) linear-gradient(to bottom, #21272d 35%, #21272d 80%, #293039 100%) repeat scroll 0 0;
								border:0px !important;
								border-radius:0px !important;
								border-bottom: 1px solid #595a5c !important;
								border-top: 1px solid #595a5c !important;
								color: #fff !important;
								text-transform:uppercase !important;
								padding-left: 20px !important;
								font-size: 12px;
								padding-top: 5px !important;
								padding-bottom: 5px !important;
							}
							.ask-panel-body-filter{
								background: #21272d;
								border:0px !important;
								color: #fff;
								font-size: 12px;
								padding-top: 0px !important;
								padding-bottom: 0px !important;
							}
							.custom-height{
								height:70px;
								overflow-y: scroll;
							}
							.custom-checkbox{
								margin-top: 5px !important; 
								margin-bottom: 5px !important;
							}
						</style> -->
						</form>
						</div>
						

						