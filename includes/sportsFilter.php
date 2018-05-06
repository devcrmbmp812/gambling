						<div class="panel panel-default ask-panelcustom-show respo-fixed-filter leftSlide" id="fixed-right" style="margin-top: 5px;border:0px;">
						<form method="get" id="search_form">
					  		<!-- <div class="panel-heading ask-panel-heading-filter ask-panel collapsed" data-toggle="collapse" data-target="#ratingoption"><b style="margin-left: -10px;">Rate</b><span class="acc-drop pull-right"></span></div>
						  	<div class="panel-body ask-panel-body-filter custom-height collapse" id="ratingoption">
						  	<?php 
						  		if(isset($_GET['rating'])) :
                                    if(in_array($_GET['rating'], $_GET['rating'])) : 
                                        $rating_check='checked="checked"';
                                    else : $rating_check="";
                                    endif;
                                endif;
						  	?>
						  	<?php
						  		$result = $User->query("SELECT DISTINCT `rating` FROM `tblWebCards` ORDER BY `rating` DESC");
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
								  	<label><input type="checkbox" name=rating[] value="<?php echo $value['rating'];?>" class="filter" <?=@$rating_check?> /> <?php echo $value['rating'];?> STAR</label>
								</div>
							<?php
									}
								}
							?>
						  	</div> -->
						  	<div class="panel-heading ask-panel-heading rotate-panel custom-rotate"><b style="margin-left: -10px;"><i class="fa fa-filter" aria-hidden="true"></i> &nbsp;어떤 조건을 찾으세요?</b></div>
						  	<div class="panel-heading ask-panel-heading-filter ask-panel collapsed" data-toggle="collapse" data-target="#welcomeBonusoption">
							<b style="margin-left: -10px;">신규 첫충 보너스</b><span class="acc-drop pull-right"></span></div>

						  	<div class="panel-body ask-panel-body-filter custom-height collapse" id="welcomeBonusoption">
						  	<?php
						  		$result = $User->query("SELECT DISTINCT `welcomeBonus` FROM `tblWebCards` ORDER BY `welcomeBonus` ASC");
						  		if(is_array($result) && count($result) > 0){
									foreach ($result as $key => $value) {
										if(isset($_GET['welcomeBonus'])) :
	                                        if(in_array($value['welcomeBonus'],$_GET['welcomeBonus'])) : 
	                                            $welcomeBonus_check='checked="checked"';
	                                        else : $welcomeBonus_check="";
	                                        endif;
	                                    endif;
						  	?>
						  		<div class="checkbox custom-checkbox">
								  	<label><input type="checkbox" name=welcomeBonus[] value="<?php echo $value['welcomeBonus'];?>" class="filter" <?=@$welcomeBonus_check?>  /> <?php echo $value['welcomeBonus'];?></label>
								</div>
							<?php
									}
								}
							?>
						  	</div>
						  	
						  	<div class="panel-heading ask-panel-heading-filter ask-panel collapsed" data-toggle="collapse" data-target="#miniGameoption"><b style="margin-left: -10px;">미니게임</b><span class="acc-drop pull-right"></span></div>

						  	<div class="panel-body ask-panel-body-filter custom-height collapse" id="miniGameoption">
						  	<?php
						  		$result = $User->query("SELECT `value` FROM `tblFilter` WHERE `name` = 'mini-game'");
						  		if(is_array($result) && count($result) > 0){
									foreach ($result as $key => $value) {
										if(isset($_GET['miniGame'])) :
	                                        if(in_array($value['value'],$_GET['miniGame'])) : 
	                                            $miniGame_check='checked="checked"';
	                                        else : $miniGame_check="";
	                                        endif;
	                                    endif;
						  	?>
						  		<div class="checkbox custom-checkbox">
								  	<label><input type="checkbox" name=miniGame[] value="<?php echo $value['value'];?>" class="filter" <?=@$miniGame_check?>  /> <?php echo $value['value'];?></label>
								</div>
							<?php
									}
								}
							?>
						  	</div>
						  	
						  	<div class="panel-heading ask-panel-heading-filter ask-panel collapsed" data-toggle="collapse" data-target="#bettingOptionoption"><b style="margin-left: -10px;">배팅 가능 여부</b><span class="acc-drop pull-right"></span></div>

						  	<div class="panel-body ask-panel-body-filter custom-height collapse" id="bettingOptionoption">
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
								  	<label><input type="checkbox" name=bettingOption[] value="<?php echo $value['value'];?>" class="filter" <?=@$bettingOption_check?> /> <?php echo $value['value'];?></label>
								</div>
							<?php
									}
								}
							?>
						  	</div>
						  	
						  	<div class="panel-heading ask-panel-heading-filter ask-panel collapsed" data-toggle="collapse" data-target="#dwmethodoption"><b style="margin-left: -10px;">입출금 방법</b><span class="acc-drop pull-right"></span></div>

						  	<div class="panel-body ask-panel-body-filter custom-height collapse" id="dwmethodoption">
						  	<?php
						  		$result = $User->query("SELECT DISTINCT `dwMethods` FROM `tblWebCards` WHERE `dwMethods` != ''");
						  		if(is_array($result) && count($result) > 0){
									foreach ($result as $key => $value) {
										if(isset($_GET['dwMethods'])) :
	                                        if(in_array($value['dwMethods'],$_GET['dwMethods'])) : 
	                                            $dwMethods_check='checked="checked"';
	                                        else : $dwMethods_check="";
	                                        endif;
	                                    endif;
						  	?>
						  		<div class="checkbox custom-checkbox">
								  	<label><input type="checkbox" name=dwMethods[] value="<?php echo $value['dwMethods'];?>" class="filter" <?=@$dwMethods_check?> /> <?php echo $value['dwMethods'];?></label>
								</div>
							<?php
									}
								}
							?>
						  	</div>
						  	
						  	<div class="panel-heading ask-panel-heading-filter ask-panel collapsed" data-toggle="collapse" data-target="#mxawardoption"><b style="margin-left: -10px;">최대 당첨금액</b><span class="acc-drop pull-right"></span></div>

						  	<div class="panel-body ask-panel-body-filter custom-height collapse" id="mxawardoption">
							<?php
						  		$result = $User->query("SELECT `maxPrizeMoney` FROM `tblWebCards` where `maxPrizeMoney` > 0 GROUP BY maxPrizeMoney");
						  		if(is_array($result) && count($result) > 0){
									foreach ($result as $key => $value) {
										if(isset($_GET['maxPrizeMoney'])) :
						                        $maxPrizeMoney_check=$_GET['maxPrizeMoney'];
						                    $maxPrizeMoneyCustom_check='checked="checked"';
						                    else : $maxPrizeMoney_check=$value['maxPrizeMoney'];
						                    	$maxPrizeMoneyCustom_check='';
						                endif;
						  	?>
								<div class="checkbox custom-checkbox">
								  	<label><input type="checkbox" value="<?php echo $maxPrizeMoney_check; ?>" name="maxPrizeMoney[]" class="filter maxPrizeMoneyFilter"  /> <?php echo $maxPrizeMoney_check; ?></label>
								</div>
							<?php
									}
								}
							?>
						  	</div>
						  	 
						  	<div class="panel-heading ask-panel-heading-filter ask-panel collapsed" data-toggle="collapse" data-target="#maxwithdrawloption"><b style="margin-left: -10px;">하루 출금한도</b><span class="acc-drop pull-right"></span></div>

						  	<div class="panel-body ask-panel-body-filter custom-height collapse" id="maxwithdrawloption">
						  	<?php
						  		$result = $User->query("SELECT DISTINCT `maxWithdrawlLimit` FROM `tblWebCards` WHERE `maxWithdrawlLimit` != ''");
						  		if(is_array($result) && count($result) > 0){
									foreach ($result as $key => $value) {
										if(isset($_GET['maxWithdrawlLimit'])) :
	                                        if(in_array($value['maxWithdrawlLimit'],$_GET['maxWithdrawlLimit'])) : 
	                                            $maxWithdrawlLimit_check='checked="checked"';
	                                        else : $maxWithdrawlLimit_check="";
	                                        endif;
	                                    endif;
						  	?>
						  		<div class="checkbox custom-checkbox">
								  	<label><input type="checkbox" name=maxWithdrawlLimit[] value="<?php echo $value['maxWithdrawlLimit'];?>" class="filter" <?=@$maxWithdrawlLimit_check?> /> <?php echo $value['maxWithdrawlLimit'];?></label>
								</div>
							<?php
									}
								}
							?>
						  	</div>
						  	 
						  	<div class="panel-heading ask-panel-heading-filter ask-panel collapsed" data-toggle="collapse" data-target="#mxbettingamountoption"><b style="margin-left: -10px;">최대 배팅금액</b><span class="acc-drop pull-right"></span></div>

						  	<div class="panel-body ask-panel-body-filter custom-height collapse" id="mxbettingamountoption">
						  	<?php
						  		$result = $User->query("SELECT `maxBettingAmount` FROM `tblWebCards` where `maxBettingAmount` > 0 GROUP BY maxBettingAmount");
						  		if(is_array($result) && count($result) > 0){
									foreach ($result as $key => $value) {
										if(isset($_GET['maxBettingAmount'])) :
						                        $maxBettingAmount_check=$_GET['maxBettingAmount'];
												$maxBettingAmountCustom_check='checked="checked"';
						                 else : $maxBettingAmount_check=$value['maxBettingAmount'];
						                    	$maxBettingAmountCustom_check='';
						                endif;
						  	?>
								<div class="checkbox custom-checkbox">
								  	<label><input type="checkbox" value="<?php echo $maxBettingAmount_check; ?>" name="maxBettingAmount[]" class="filter maxBettingAmountFilter"  /> <?php echo $maxBettingAmount_check; ?></label>
								</div>
							<?php
									}
									
								}
							?>
						  	</div>
						  	
						  	<!-- <div class="panel-heading ask-panel-heading-filter ask-panel collapsed" data-toggle="collapse" data-target="#minbettingamountoption"><b style="margin-left: -10px;">Min BETTING AMOUNT</b><span class="acc-drop pull-right"></span></div>

						  	<div class="panel-body ask-panel-body-filter collapse" id="minbettingamountoption">
						  	<?php
						  		$result = $User->query("SELECT MAX(`minBettingAmount`) FROM `tblWebCards`");
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
								    <output for="minBettingAmount" class="output text-center">$<?php echo $minBettingAmount_check;?></output>
								    <input type="range" name="" class="filter minBettingAmountFilter" min="0" max="<?php echo $value['MAX(`minBettingAmount`)'];?>" step="1" value="<?php echo $minBettingAmount_check;?>">
								    <input type="checkbox" name="minBettingAmount" value="<?php echo $minBettingAmount_check;?>" <?=@$minBettingAmountCustom_check?> class="custm-check minBettingAmountCheck"  />
							    </div>
							<?php
									}
								}
							?>
						  	</div> -->
						  	
						  	<div class="panel-heading ask-panel-heading-filter ask-panel collapsed" data-toggle="collapse" data-target="#firstdepositeBonusoption"><b style="margin-left: -10px;">첫충전 보너스</b><span class="acc-drop pull-right"></span></div>

						  	<div class="panel-body ask-panel-body-filter custom-height collapse" id="firstdepositeBonusoption">
						  	<?php
						  		$result = $User->query("SELECT DISTINCT `everytimeDepositeBonus` FROM `tblWebCards` WHERE `everytimeDepositeBonus` != '' ORDER BY `everytimeDepositeBonus` DESC");
						  		if(is_array($result) && count($result) > 0){
									foreach ($result as $key => $value) {
										if(isset($_GET['everytimeDepositeBonus'])) :
	                                        if(in_array($value['everytimeDepositeBonus'],$_GET['everytimeDepositeBonus'])) : 
	                                            $firstDepositeBonus_check='checked="checked"';
	                                        else : $firstDepositeBonus_check="";
	                                        endif;
	                                    endif;
						  	?>
						  		<div class="checkbox custom-checkbox">
								  	<label><input type="checkbox" name=everytimeDepositeBonus[] value="<?php echo $value['everytimeDepositeBonus'];?>" class="filter" <?=@$firstDepositeBonus_check?> /> <?php echo $value['everytimeDepositeBonus'];?></label>
								</div>
							<?php
									}
								}
							?>
						  	</div>

						  	<div class="panel-heading ask-panel-heading-filter ask-panel collapsed" data-toggle="collapse" data-target="#dailyBonusoption"><b style="margin-left: -10px;">매번 충전 보너스</b><span class="acc-drop pull-right"></span></div>

						  	<div class="panel-body ask-panel-body-filter custom-height collapse" id="dailyBonusoption">
						  	<?php
						  		$result = $User->query("SELECT DISTINCT `dailyBonus` FROM `tblWebCards` WHERE `dailyBonus` != '' ORDER BY `dailyBonus` DESC");
						  		if(is_array($result) && count($result) > 0){
									foreach ($result as $key => $value) {
										if(isset($_GET['dailyBonus'])) :
	                                        if(in_array($value['dailyBonus'],$_GET['dailyBonus'])) : 
	                                            $dailyBonus_check='checked="checked"';
	                                        else : $dailyBonus_check="";
	                                        endif;
	                                    endif;
						  	?>
						  		<div class="checkbox custom-checkbox">
								  	<label><input type="checkbox" name=dailyBonus[] value="<?php echo $value['dailyBonus'];?>" class="filter" <?=@$dailyBonus_check?> /> <?php echo $value['dailyBonus'];?></label>
								</div>
							<?php
									}
								}
							?>
						  	</div>
						  	

						  	<div class="panel-heading ask-panel-heading-filter ask-panel collapsed" data-toggle="collapse" data-target="#rebateBonusoption"><b style="margin-left: -10px;">낙첨금 보너스</b><span class="acc-drop pull-right"></span></div>

						  	<div class="panel-body ask-panel-body-filter custom-height collapse" id="rebateBonusoption">
						  	<?php
						  		$result = $User->query("SELECT DISTINCT `rebateBonus` FROM `tblWebCards` WHERE `rebateBonus` != '' ORDER BY `rebateBonus` ASC");
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
						  	

						  	<div class="panel-heading ask-panel-heading-filter ask-panel collapsed" data-toggle="collapse" data-target="#rollingBonusoption"><b style="margin-left: -10px;">롤링 보너스</b><span class="acc-drop pull-right"></span></div>

						  	<div class="panel-body ask-panel-body-filter custom-height collapse" id="rollingBonusoption">
						  	<?php
						  		$result = $User->query("SELECT DISTINCT `rollingBonus` FROM `tblWebCards` WHERE `rollingBonus` != '' ORDER BY `rollingBonus` ASC");
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


						  	<div class="panel-heading ask-panel-heading-filter ask-panel collapsed" data-toggle="collapse" data-target="#singleBet"><b style="margin-left: -10px;">단폴더 제한</b><span class="acc-drop pull-right"></span></div>

						  	<div class="panel-body ask-panel-body-filter custom-height collapse" id="singleBet">
						  	<?php
						  		$result = $User->query("SELECT DISTINCT `singleBet` FROM `tblWebCards` WHERE `singleBet` != '' ORDER BY `singleBet` ASC");
						  		if(is_array($result) && count($result) > 0){
									foreach ($result as $key => $value) {
										if(isset($_GET['singleBet'])) :
	                                        if(in_array($value['singleBet'],$_GET['singleBet'])) : 
	                                            $singleBet_check='checked="checked"';
	                                        else : $singleBet_check="";
	                                        endif;
	                                    endif;
						  	?>
						  		<div class="checkbox custom-checkbox">
								  	<label><input type="checkbox" name=singleBet[] value="<?php echo $value['singleBet'];?>" class="filter" <?=@$singleBet_check?> /> <?php echo $value['singleBet'];?></label>
								</div>
							<?php
									}
								}
							?>
						  	</div>
						  	
						  	<div class="panel-heading ask-panel-heading-filter ask-panel collapsed" data-toggle="collapse" data-target="#liveChatoption"><b style="margin-left: -10px;">라이브 채팅</b><span class="acc-drop pull-right"></span></div>

						  	<div class="panel-body ask-panel-body-filter collapse" id="liveChatoption">
						  	<?php
						  		$result = $User->query("SELECT DISTINCT `liveChat` FROM `tblWebCards` WHERE `liveChat` != ''");
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
						  	
						  	<!-- <div class="panel-heading ask-panel-heading-filter ask-panel collapsed" data-toggle="collapse" data-target="#establishedoption"><b style="margin-left: -10px;">Established</b><span class="acc-drop pull-right"></span></div>

						  	<div class="panel-body ask-panel-body-filter custom-height collapse" id="establishedoption">
						  	<?php
						  		$result = $User->query("SELECT DISTINCT `established` FROM `tblWebCards` WHERE `established` != '' ORDER BY `established` ASC");
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
						  	</div> -->
						</form>
						<a href="javascript:void(0)" class="btn btn-red pan-slide1">필터링 기준</a>
						</div>
						

						