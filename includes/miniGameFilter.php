						<div class="panel panel-default ask-panelcustom-show respo-fixed-filter-mini leftSlide" id="fixed-right" style="margin-top: 5px;border:0px;">
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
						  	<div class="panel-heading ask-panel-heading rotate-panel custom-rotate"><b style="margin-left: -10px;"><i class="fa fa-filter" aria-hidden="true"></i> &nbsp;Filter By</b></div>
						  	
						  	
						  	<div class="panel-heading ask-panel-heading-filter ask-panel collapsed" data-toggle="collapse" data-target="#miniGameoption"><b style="margin-left: -10px;">Mini game</b><span class="acc-drop pull-right"></span></div>

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
								  	<label><input type="checkbox" name=miniGame[] value="<?php echo $value['value'];?>" class="filter3" <?=@$miniGame_check?>  /> <?php echo $value['value'];?></label>
								</div>
							<?php
									}
								}
							?>
						  	</div>
						  	
						  	<div class="panel-heading ask-panel-heading-filter ask-panel collapsed" data-toggle="collapse" data-target="#maxawardoption"><b style="margin-left: -10px;">MAX AWARD AMOUNT</b><span class="acc-drop pull-right"></span></div>

						  	<div class="panel-body ask-panel-body-filter collapse" id="maxawardoption">
						  	<?php
						  		$result = $User->query("SELECT MAX(`maxPrizeMoney`) FROM `tblWebCards`");
						  		if(is_array($result) && count($result) > 0){
									foreach ($result as $key => $value) {
										if(isset($_GET['maxPrizeMoney'])) :
						                        $maxPrizeMoney_check=$_GET['maxPrizeMoney'];
						                    $maxPrizeMoneyCustom_check='checked="checked"';
						                    else : $maxPrizeMoney_check=$value['MAX(`maxPrizeMoney`)'];
						                    	$maxPrizeMoneyCustom_check='';
						                endif;
						  	?>
								<div class="range1">
								    <output for="maxPrizeMoney" class="output text-center text-white"><?php echo $maxPrizeMoney_check;?> 원</output>
								    <input type="range" name="" class="filter3 maxPrizeMoneyFilter" min="0" max="<?php echo $value['MAX(`maxPrizeMoney`)'];?>" step="1" value="<?php echo $maxPrizeMoney_check;?>">
								    <input type="checkbox" name="maxPrizeMoney" value="<?php echo $maxPrizeMoney_check;?>" <?=@$maxPrizeMoneyCustom_check?> class="custm-check maxPrizeMoneyCheck"  />
							    </div>
							<?php
									}
								}
							?>
						  	</div>
						  	 
						  	<div class="panel-heading ask-panel-heading-filter ask-panel collapsed" data-toggle="collapse" data-target="#maxbettingamountoption"><b style="margin-left: -10px;">MAX BETTING AMOUNT</b><span class="acc-drop pull-right"></span></div>

						  	<div class="panel-body ask-panel-body-filter collapse" id="maxbettingamountoption">
						  	<?php
						  		$result = $User->query("SELECT MAX(`maxBettingAmount`) FROM `tblWebCards`");
						  		if(is_array($result) && count($result) > 0){
									foreach ($result as $key => $value) {
										if(isset($_GET['maxBettingAmount'])) :
						                        $maxBettingAmount_check=$_GET['maxBettingAmount'];
						                    $maxBettingAmountCustom_check='checked="checked"';
						                    else : $maxBettingAmount_check=$value['MAX(`maxBettingAmount`)'];
						                    	$maxBettingAmountCustom_check='';
						                endif;
						  	?>
								<div class="range1">
								    <output for="maxBettingAmount" class="output text-center text-white"> <?php echo $maxBettingAmount_check;?> 원</output>
								    <input type="range" name="" class="filter3 maxBettingAmountFilter" min="0" max="<?php echo $value['MAX(`maxBettingAmount`)'];?>" step="1" value="<?php echo $maxBettingAmount_check;?>">
								    <input type="checkbox" name="maxBettingAmount" value="<?php echo $maxBettingAmount_check;?>" <?=@$maxBettingAmountCustom_check?> class="custm-check maxBettingAmountCheck"  />
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
						  	

						  	<div class="panel-heading ask-panel-heading-filter ask-panel collapsed" data-toggle="collapse" data-target="#rollingBonusoption"><b style="margin-left: -10px;">Rolling BONUS</b><span class="acc-drop pull-right"></span></div>

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
								  	<label><input type="checkbox" name=rollingBonus[] value="<?php echo $value['rollingBonus'];?>" class="filter3" <?=@$rollingBonus_check?> /> <?php echo $value['rollingBonus'];?></label>
								</div>
							<?php
									}
								}
							?>
						  	</div>
						</form>
						<a href="javascript:void(0)" class="btn btn-red pan-slide2">필터링 기준</a>
						</div>
						

						