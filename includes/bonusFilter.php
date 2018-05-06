						<div class="panel panel-default ask-panelcustom-show respo-fixed-filter-mini leftSlide" id="fixed-right" style="margin-top: 5px;border:0px;">
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
						  		$result = $User->query("SELECT DISTINCT `rating` FROM `tblBonusCards` ORDER BY `rating` DESC");
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
						  	<div class="panel-heading ask-panel-heading-filter ask-panel collapsed" data-toggle="collapse" data-target="#bonusoptionoption"><b style="margin-left: -10px;">보너스 금액</b><span class="acc-drop pull-right"></span></div>

						  	<div class="panel-body ask-panel-body-filter custom-height collapse" id="bonusoptionoption">
						  	<?php
						  		$result = $User->query("SELECT DISTINCT `bonusAmount` FROM `tblBonusCards` ORDER BY `bonusAmount` ASC");
						  		if(is_array($result) && count($result) > 0){
									foreach ($result as $key => $value) {
										// if(isset($_GET['bonusAmount'])) :
						    //                     //$bonusAmount_check=$_GET['bonusAmount'];
						    //                     $bonusAmountCustom_check='checked="checked"';
						    //                 else : //$bonusAmount_check=$value['MAX(`bonusAmount`)'];
						    //                 		$bonusAmount_check='';
						    //             endif;
						                if(isset($_GET['bonusAmount'])) :
	                                        if(in_array($value['bonusAmount'],$_GET['bonusAmount'])) : 
	                                            $bonusAmount_check='checked="checked"';
	                                        else : $bonusAmount_check="";
	                                        endif;
	                                    endif;

						  	?>
								<div class="checkbox custom-checkbox">
								  	<label><input type="checkbox" name=bonusAmount[] value="<?php echo $value['bonusAmount'];?>" class="filter2" <?=@$bonusAmount_check?> /> <?php echo $value['bonusAmount'];?></label>
								</div>
							<?php
									}
								}
							?>
						  	</div>
						  	<!-- <div class="panel-heading ask-panel-heading"><b style="margin-left: -10px;"><i class="fa fa-filter" aria-hidden="true"></i> &nbsp;Filter By</b></div>
						  	<div class="panel-heading ask-panel-heading-filter"><b style="margin-left: -10px;">BONUS AMOUNT</b></div>
						  	<div class="panel-body ask-panel-body-filter custom-height">
						  	<?php
						  		$result = $User->query("SELECT `bonusAmount` FROM `tblBonusCards`");
						  		if(is_array($result) && count($result) > 0){
									foreach ($result as $key => $value) {
										if(isset($_GET['bonusAmount'])) :
						                        $bonusAmount_check=$_GET['bonusAmount'];
						                        $bonusAmountCustom_check='checked="checked"';
						                    else : $bonusAmount_check=$value['MAX(`bonusAmount`)'];
						                    		$bonusAmountCustom_check='';
						                endif;
						  	?>
								<div class="range1">
								    <output for="bonusAmount" class="output text-center"><?php echo $bonusAmount_check;?>%</output>
								    <input type="range" name="" class="filter bonusAmountFilter" min="0" max="<?php echo $value['MAX(`bonusAmount`)'];?>" step="1" value="<?php echo $bonusAmount_check;?>">
							    </div>
							    <input type="checkbox" name="bonusAmount" value="<?php echo $bonusAmount_check;?>" <?=@$bonusAmountCustom_check?> class="custm-check bonusAmountCheck"  />
							<?php
									}
								}
							?>
						  	</div> -->
						  	

						  	<div class="panel-heading ask-panel-heading-filter ask-panel collapsed" data-toggle="collapse" data-target="#rollingConditionoption"><b style="margin-left: -10px;">이용 조건</b><span class="acc-drop pull-right"></span></div>

						  	<div class="panel-body ask-panel-body-filter custom-height collapse" id="rollingConditionoption">
						  	<?php
						  		$result = $User->query("SELECT DISTINCT `wageringRequirements` FROM `tblBonusCards` WHERE `wageringRequirements` != ''");
						  		if(is_array($result) && count($result) > 0){
									foreach ($result as $key => $value) {
										if(isset($_GET['wageringRequirements'])) :
	                                        if(in_array($value['wageringRequirements'],$_GET['wageringRequirements'])) : 
	                                            $wageringRequirements_check='checked="checked"';
	                                        else : $wageringRequirements_check="";
	                                        endif;
	                                    endif;
						  	?>
						  		<div class="checkbox custom-checkbox">
								  	<label><input type="checkbox" name=wageringRequirements[] value="<?php echo $value['wageringRequirements'];?>" class="filter2" <?=@$wageringRequirements_check?>  /> <?php echo $value['wageringRequirements'];?></label>
								</div>
							<?php
									}
								}
							?>
						  	</div>

						  	<div class="panel-heading ask-panel-heading-filter ask-panel collapsed" data-toggle="collapse" data-target="#mindepositeoption"><b style="margin-left: -10px;">최소 입금금액</b><span class="acc-drop pull-right"></span></div>

						  	<div class="panel-body ask-panel-body-filter custom-height collapse" id="mindepositeoption">
						  	<?php
						  		$result = $User->query("SELECT DISTINCT `minDepositeAmpount` FROM `tblBonusCards` WHERE `minDepositeAmpount`!=''");
						  		if(is_array($result) && count($result) > 0){
									foreach ($result as $key => $value) {
										// if(isset($_GET['minDepositeAmpount'])) :
						    //                     $minDepositeAmpount_check=$_GET['minDepositeAmpount'];
						    //                 	$minDepositeAmpountCustom_check='checked="checked"';
						    //                 else : $minDepositeAmpount_check=$value['MAX(`minDepositeAmpount`)'];
						    //                 	$minDepositeAmpountCustom_check='';
						    //             endif;
						                if(isset($_GET['minDepositeAmpount'])) :
	                                        if(in_array($value['minDepositeAmpount'],$_GET['minDepositeAmpount'])) : 
	                                            $minDepositeAmpount_check='checked="checked"';
	                                        else : $minDepositeAmpount_check="";
	                                        endif;
	                                    endif;
						  	?>
						  		<div class="checkbox custom-checkbox">
								  	<label><input type="checkbox" name=minDepositeAmpount[] value="<?php echo $value['minDepositeAmpount'];?>" class="filter2" <?=@$minDepositeAmpount_check?>  /><?php echo $value['minDepositeAmpount'];?></label>
								</div>
								<!-- <div class="range1">
								    <output for="minDepositeAmpount" class="output text-center"><?php echo $minDepositeAmpount_check;?></output>
								    <input type="range" name="" class="filter2 minDepositeAmpountFilter" min="0" max="<?php echo $value['MAX(`minDepositeAmpount`)'];?>" step="1" value="<?php echo $minDepositeAmpount_check;?>">
								    <input type="checkbox" name="minDepositeAmpount" value="<?php echo $minDepositeAmpount_check;?>" <?=@$minDepositeAmpountCustom_check?> class="custm-check minDepositeAmpountCheck"  />
							    </div> -->
							<?php
									}
								}
							?>
						  	</div>
						  	<!-- <div class="panel-heading ask-panel-heading-filter"><b style="margin-left: -10px;">Minimum Deposit amount</b></div>
						  	<div class="panel-body ask-panel-body-filter custom-height">
						  	<?php
						  		$result = $User->query("SELECT MAX(`minDepositeAmpount`) FROM `tblBonusCards`");
						  		if(is_array($result) && count($result) > 0){
									foreach ($result as $key => $value) {
										if(isset($_GET['minDepositeAmpount'])) :
						                        $minDepositeAmpount_check=$_GET['minDepositeAmpount'];
						                    	$minDepositeAmpountCustom_check='checked="checked"';
						                    else : $minDepositeAmpount_check=$value['MAX(`minDepositeAmpount`)'];
						                    	$minDepositeAmpountCustom_check='';
						                endif;
						  	?>
								<div class="range1">
								    <output for="minDepositeAmpount" class="output text-center"><?php echo $minDepositeAmpount_check;?></output>
								    <input type="range" name="" class="filter2 minDepositeAmpountFilter" min="0" max="<?php echo $value['MAX(`minDepositeAmpount`)'];?>" step="1" value="<?php echo $minDepositeAmpount_check;?>">
								    <input type="checkbox" name="minDepositeAmpount" value="<?php echo $minDepositeAmpount_check;?>" <?=@$minDepositeAmpountCustom_check?> class="custm-check minDepositeAmpountCheck"  />
							    </div>
							<?php
									}
								}
							?>
						  	</div>
						  	<div class="panel-heading ask-panel-heading-filter"><b style="margin-left: -10px;">보너스 이용 조건 </b></div>
						  	<div class="panel-body ask-panel-body-filter custom-height">
						  	<?php
						  		$result = $User->query("SELECT DISTINCT `bonusConUtilization` FROM `tblBonusCards` WHERE `bonusConUtilization` != ''");
						  		if(is_array($result) && count($result) > 0){
									foreach ($result as $key => $value) {
										if(isset($_GET['bonusConUtilization'])) :
	                                        if(in_array($value['bonusConUtilization'],$_GET['bonusConUtilization'])) : 
	                                            $bonusConUtilization_check='checked="checked"';
	                                        else : $bonusConUtilization_check="";
	                                        endif;
	                                    endif;
						  	?>
						  		<div class="checkbox custom-checkbox">
								  	<label><input type="checkbox" name=bonusConUtilization[] value="<?php echo $value['bonusConUtilization'];?>" class="filter" <?=@$bonusConUtilization_check?> /> <?php echo $value['bonusConUtilization'];?></label>
								</div>
							<?php
									}
								}
							?>
						  	</div>
						  	<div class="panel-heading ask-panel-heading-filter"><b style="margin-left: -10px;">Max bonus amount</b></div>
						  	<div class="panel-body ask-panel-body-filter custom-height">
						  	<?php
						  		$result = $User->query("SELECT MAX(`maxBonusAmount`) FROM `tblBonusCards`");
						  		if(is_array($result) && count($result) > 0){
									foreach ($result as $key => $value) {
										if(isset($_GET['maxBonusAmount'])) :
						                        $maxBonusAmount_check=$_GET['maxBonusAmount'];
						                        $maxBonusAmountCustom_check='checked="checked"';
						                    else : $maxBonusAmount_check=$value['MAX(`maxBonusAmount`)'];
						                    	$maxBonusAmountCustom_check='';
						                endif;
						  	?>
								<div class="range1">
								    <output for="maxBonusAmount" class="output text-center"><?php echo $maxBonusAmount_check;?>%</output>
								    <input type="range" name="" class="filter maxBonusAmountFilter" min="0" max="<?php echo $value['MAX(`maxBonusAmount`)'];?>" step="1" value="<?php echo $maxBonusAmount_check;?>">
								    <input type="checkbox" name="maxBonusAmount" value="<?php echo $maxBonusAmount_check;?>" <?=@$maxBonusAmountCustom_check?> class="custm-check maxBonusAmountCheck"  />
							    </div>
							<?php
									}
								}
							?>
						  	</div>
						  	<div class="panel-heading ask-panel-heading-filter"><b style="margin-left: -10px;">Max Cashout</b></div>
						  	<div class="panel-body ask-panel-body-filter custom-height">
						  	<?php
						  		$result = $User->query("SELECT MAX(`maxCashout`) FROM `tblBonusCards`");
						  		if(is_array($result) && count($result) > 0){
									foreach ($result as $key => $value) {
										if(isset($_GET['maxCashout'])) :
						                        $maxCashout_check=$_GET['maxCashout'];
						                    $maxCashoutCustom_check='checked="checked"';
						                    else : $maxCashout_check=$value['MAX(`maxCashout`)'];
						                    	$maxCashoutCustom_check='';
						                endif;
						  	?>
								<div class="range1">
								    <output for="maxCashout" class="output text-center"><?php echo $maxCashout_check;?></output>
								    <input type="range" name="" class="filter maxCashoutFilter" min="0" max="<?php echo $value['MAX(`maxCashout`)'];?>" step="1" value="<?php echo $maxCashout_check;?>">
								    <input type="checkbox" name="maxCashout" value="<?php echo $maxCashout_check;?>" <?=@$maxCashoutCustom_check?> class="custm-check maxCashoutCheck"  />
							    </div>
							<?php
									}
								}
							?>
						  	</div>
						  	<div class="panel-heading ask-panel-heading-filter"><b style="margin-left: -10px;">Bonus withdraw condition</b></div>
						  	<div class="panel-body ask-panel-body-filter custom-height">
						  	<?php
						  		$result = $User->query("SELECT DISTINCT `bonusWithdrawlCondition` FROM `tblBonusCards` WHERE `bonusWithdrawlCondition` != ''");
						  		if(is_array($result) && count($result) > 0){
									foreach ($result as $key => $value) {
										if(isset($_GET['bonusWithdrawlCondition'])) :
	                                        if(in_array($value['bonusWithdrawlCondition'],$_GET['bonusWithdrawlCondition'])) : 
	                                            $bonusWithdrawlCondition_check='checked="checked"';
	                                        else : $bonusWithdrawlCondition_check="";
	                                        endif;
	                                    endif;
						  	?>
						  		<div class="checkbox custom-checkbox">
								  	<label><input type="checkbox" name=bonusWithdrawlCondition[] value="<?php echo $value['bonusWithdrawlCondition'];?>" class="filter" <?=@$bonusWithdrawlCondition_check?> /> <?php echo $value['bonusWithdrawlCondition'];?></label>
								</div>
							<?php
									}
								}
							?>
						  	</div> -->
						  	
						  	
						</form>
						<a href="javascript:void(0)" class="btn btn-red pan-slide2">필터링 기준</a>
						</div>						

						