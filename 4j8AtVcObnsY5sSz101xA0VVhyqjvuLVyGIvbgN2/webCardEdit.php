<?php

require_once('../config.php');	



// Load Classes

C::loadClass('User');

C::loadClass('Card');

C::loadClass('CMS');

//Init User class

$Base = new Base();

$User = new User();

$Card = new Card();

$Common = new Common();



if(!$User->checkLoginStatus()){

	$Common->redirect('index.php');

}

$logedInID = ((int)User::loggedInUserId() > 0 ? User::loggedInUserId() : 0);

$groupId = $Base->query("SELECT `groupId` FROM `tblUser` WHERE `id` = '" . $logedInID . "' LIMIT 1");

if ( $groupId[0]['groupId'] != 0) {

	$Common->redirect('index.php');

}



$editValue = array(

	'sportsName' => '',

	'joinCode' => '',

	'siteName' => '',

	'maxPrizeMoney' => '',

	'singleBet' => '',

	'liveChatText' => '',

	'sportsDesc' => '',

	'welcomeBonus' => '',

	'miniGame' => '',

	'sportsImage' => '',

	'imageName' => '',

	'id' => '',

	'link' => '',

	'rating' => '',

	'isRecommanded' => '',

	'sportsOtherDetails' => '',

	'isHot' => '',

	'sportsType' => '',

	'sportsRevw' => '',

	'bettingOption' => '',

	'dwMethods' => '',

	'maxWithdrawlLimit' => '',

	'maxBettingAmount' => '',

	'minBettingAmount' => '',

	'everytimeDepositeBonus' => '',

	'dailyBonus' => '',

	'rebateBonus' => '',

	'rollingBonus' => '',

	'established' => '',

	'liveChat' => '',
	'metaTitle' => '',
	'metaDesc' => '',
	'metaKeyword' => ''

);



if(isset($_POST) && is_array($_POST) && count($_POST) > 0){


//print_r($_FILES);die();
    if($Card->updateWebCard($_POST, $_FILES)){

    	C::redirect(C::link('web-card.php', false, true));

    }	

}



$activeNavigation = "sports";

?>

<?php require_once('includes/doc_head.php'); ?>



<section class="content">

	<section class="widget">
		<div class="panel panel-default bt-panel" style="box-shadow:none;">
			<div class="panel-heading">
				<span class="icon">&#128196;</span>
				<hgroup>
					<h5>Web Card</h5>
					<h6>All uploaded files</h6>
				</hgroup>
			</div>
			<div class="panel-body">

			<?php

			if(isset($_GET['edit']) && trim($_GET['edit'])){

				$editID = $_GET['edit'];

				$result = $User->query("SELECT `sportsName`, `joinCode`, `siteName`, `sportsReview`, `description`, `maxPrizeMoney`, `singleBet`,`welcomeBonus`, `miniGame`, `sportsImage`, `imageName`, `link`, `id`, `rating`, `isRecommanded`, `isHot`, `sportsType`, `sportsOtherDetails`, `bettingOption`, `dwMethods`, `maxWithdrawlLimit`, `maxBettingAmount`, `minBettingAmount`, `everytimeDepositeBonus`, `dailyBonus`, `rebateBonus`, `rollingBonus`, `established`, `liveChat`,`liveChatText`, `metaTitle`, `metaDesc`, `metaKeyword` FROM `tblWebCards` WHERE `id` = '" . $editID . "' LIMIT 0, 1");

				if($result && is_array($result) && count($result) > 0){

					if(array_key_exists("liveChatText",$result[0]))

					{

						$editValue['liveChatText'] = $result[0]['liveChatText'];

					}

					else

					{

						$editValue['liveChatText'] = "";

					}

					$editValue['sportsName'] = $result[0]['sportsName'];

					$editValue['joinCode'] = $result[0]['joinCode'];

					$editValue['siteName'] = $result[0]['siteName'];

					$editValue['sportsDesc'] = $result[0]['description'];

					$editValue['maxPrizeMoney'] = $result[0]['maxPrizeMoney'];

					$editValue['singleBet'] = $result[0]['singleBet'];

					$editValue['welcomeBonus'] = $result[0]['welcomeBonus'];

					$editValue['miniGame'] = $result[0]['miniGame'];

					$editValue['sportsImage'] = $result[0]['sportsImage'];

					$editValue['imageName'] = $result[0]['imageName'];

					$editValue['link'] = $result[0]['link'];

					$editValue['sportsRevw'] = $result[0]['sportsReview'];

					$editValue['id'] = $result[0]['id'];

					$editValue['rating'] = $result[0]['rating'];

					$editValue['isRecommanded'] = $result[0]['isRecommanded'];

					$editValue['isHot'] = $result[0]['isHot'];

					$editValue['sportsType'] = $result[0]['sportsType'];

					$editValue['sportsOtherDetails'] = $result[0]['sportsOtherDetails'];

					$editValue['bettingOption'] = $result[0]['bettingOption'];

					$editValue['dwMethods'] = $result[0]['dwMethods'];

					$editValue['maxWithdrawlLimit'] = $result[0]['maxWithdrawlLimit'];

					$editValue['maxBettingAmount'] = $result[0]['maxBettingAmount'];

					$editValue['minBettingAmount'] = $result[0]['minBettingAmount'];

					$editValue['everytimeDepositeBonus'] = $result[0]['everytimeDepositeBonus'];

					$editValue['dailyBonus'] = $result[0]['dailyBonus'];

					$editValue['rebateBonus'] = $result[0]['rebateBonus'];

					$editValue['rollingBonus'] = $result[0]['rollingBonus'];

					$editValue['established'] = $result[0]['established'];

					$editValue['liveChat'] = $result[0]['liveChat'];
					$editValue['metaTitle'] = $result[0]['metaTitle'];
					$editValue['metaDesc'] = $result[0]['metaDesc'];
					$editValue['metaKeyword'] = $result[0]['metaKeyword'];

				}

			?>

				<div class="content">
					<form action="" method="post" enctype="multipart/form-data">

						<div class="field-wrap">

							<div class="field-wrap-half form-group form-relative">

								<input type="text" value="<?php echo $editValue['sportsName'];?>" name="sportsName" placeholder="Sports Name" />
								<button class="btn btn-info btn-xs btn-reset" type="button"><i class="fa fa-repeat fa-2x"></i></button>
								<input type="hidden" value="<?php echo $editValue['id'];?>" name="id" />

							</div>

							<div class="field-wrap-half form-group form-relative">

								<input type="text" value="<?php echo $editValue['joinCode'];?>" name="joinCode" placeholder="Join Code" />
								<button class="btn btn-info btn-xs btn-reset" type="button"><i class="fa fa-repeat fa-2x"></i></button>

							</div>

						</div>

						<?php 

						$str = $editValue['sportsType'];

						$sprtsType = explode(",",$str);

						?>

						<div class="field-wrap form-group">

							<select name="sportsType[]" id="sportsType" class="chosen-select" multiple  tabindex="4" required >

								<option <?php if(in_array("Online sport", $sprtsType)){ echo "selected";}?> value="Online sport">Online sport</option>

								<option <?php if(in_array("Newest sport", $sprtsType)){ echo "selected"; }?>  value="Newest sport">Newest sport</option>

								<option <?php if(in_array("Verified sport", $sprtsType)){ echo "selected"; }?>  value="Verified sport">Verified sport</option>

								<option <?php if(in_array("Bitcoin sport", $sprtsType)){ echo "selected"; } ?>  value="Bitcoin sport">Bitcoin sport</option>

								<option <?php if(in_array("Livebetting sport", $sprtsType)){ echo "selected"; }?>  value="Livebetting sport">Livebetting sport</option>

								<option <?php if(in_array("Sadari sport", $sprtsType)){ echo "selected"; }?>  value="Sadari sport">Sadari sport</option>

							</select>

							

						</div>

					</br>

						<div class="field-wrap form-group">

							<textarea name="sportsDesc" id="" rows="4" placeholder="Sports Description"><?php echo $editValue['sportsDesc'];?></textarea>

						</div>

						<div class="field-wrap">

							<div class="field-wrap-half form-group form-relative">
								<input type="text" value="<?php echo $editValue['welcomeBonus'];?>" name="welcomeBonus" placeholder="Welcome Bonus" />
								<button class="btn btn-info btn-xs btn-reset" type="button"><i class="fa fa-repeat fa-2x"></i></button>
							</div>

							<div class="field-wrap-half form-group form-relative">
								<input type="text" value="<?php echo $editValue['maxBettingAmount'];?>" name="maxBettingAmount" placeholder="Max Betting Amount" />
								<button class="btn btn-info btn-xs btn-reset" type="button"><i class="fa fa-repeat fa-2x"></i></button>
							</div>


						</div>

						<div class="field-wrap">
							<div class="field-wrap-half form-group form-relative">
								<input type="text" value="<?php echo $editValue['maxPrizeMoney'];?>" name="maxPrizeMoney" placeholder="Max Prize Money" />
								<button class="btn btn-info btn-xs btn-reset" type="button"><i class="fa fa-repeat fa-2x"></i></button>
							</div>

							<div class="field-wrap-half form-group form-relative">
								<input type="text" value="<?php echo $editValue['singleBet'];?>" name="singleBet" placeholder="Single Bet" />
								<button class="btn btn-info btn-xs btn-reset" type="button"><i class="fa fa-repeat fa-2x"></i></button>
							</div>
						</div>

						<div class="field-wrap">
							<div class="field-wrap-half form-group form-relative">

								<input type="text" value="<?php echo $editValue['maxWithdrawlLimit'];?>" name="maxWithdrawlLimit" placeholder="Max Withdrawl Limit" />
								<button class="btn btn-info btn-xs btn-reset" type="button"><i class="fa fa-repeat fa-2x"></i></button>

							</div>

							<div class="field-wrap-half form-group">
								<select name="rate" id="rate">
									<option value="0">-- GIVE RATING --</option>
									<option <?php if ($editValue['rating'] == 1 ) echo 'selected' ; ?> value="1">&#9734;</option>
									<option <?php if ($editValue['rating'] == 2 ) echo 'selected' ; ?> value="2">&#9734;&#9734;</option>
									<option <?php if ($editValue['rating'] == 3 ) echo 'selected' ; ?> value="3">&#9734;&#9734;&#9734;</option>
									<option <?php if ($editValue['rating'] == 4 ) echo 'selected' ; ?> value="4">&#9734;&#9734;&#9734;&#9734;</option>
									<option <?php if ($editValue['rating'] == 5 ) echo 'selected' ; ?> value="5">&#9734;&#9734;&#9734;&#9734;&#9734;</option>
								</select>
							</div>
						</div>


						<div class="field-wrap form-group">

							<?php 
							$str1 = $editValue['miniGame'];
							$minigame = explode(",",$str1);
							?>

								<table width="100%" class="add-new" data-appnd=".mingm" data-type="miniGame">
									<tr>
										<td>
											<!-- <input type="text" value="" name="miniGame" placeholder="Mini Game"  /> -->
											<select name="miniGame[]" class="" multiple  tabindex="4" >
												<?php 
												$res = $Base->query("SELECT `id`, `value` FROM `tblFilter` WHERE `name` = 'mini-game'");
													if(is_array($res) && count($res) > 0){
														foreach ($res as $key => $value) {
															$v = $value['value'];
												?>
												<option <?php if(in_array("$v", $minigame)){ echo "selected";}?> value="<?php echo $v;?>"><?php echo $v;?></option>
												<?php 
													}
												}
												?>
											</select>

										</td>

									</tr>

								</table>

						</div>

						<div style="clear:both;"></div>

						<div class="field-wrap form-group">

							<img src="<?php echo HOST . $editValue['sportsImage'];?>" alt="" style="width:100px;height:100px;" />

							<input type="file" name="sportsImageUpdate" />

						</div><br />

						<div class="field-wrap form-group">

							<input type="text" value="<?php echo $editValue['imageName'];?>" name="imageName" placeholder="Image Name" />

						</div>

						<div class="field-wrap form-group">



							<?php 

							$str2 = $editValue['bettingOption'];

							$bettingOption = explode(",",$str2);

							?>

							<table width="100%" class="add-new" data-appnd=".mingm" data-type="betting-option">
								<tr>
									<td>
										<select name="bettingOption[]" class="" multiple  tabindex="4" >
											<?php 
											$res = $Base->query("SELECT `id`, `value` FROM `tblFilter` WHERE `name` = 'betting-option'");
												if(is_array($res) && count($res) > 0){
													foreach ($res as $key => $value) {
														$v = $value['value'];
														//echo $v;
														//print_r($bettingOption);
											?>
											<option <?php if(in_array("$v", $bettingOption)){ echo "selected";}?> value="<?php echo $v;?>"><?php echo $v;?></option>
											<?php 
												}
											}
											?>
										</select>
									</td>
								</tr>
							</table>
						</div>

						<div style="clear:both;"></div>

						<div class="field-wrap">

							<div class="field-wrap-half form-group">

								<select name="categoryType" id="categoryType">

									<option value="0">-- CHOOSE RECOMMANDATION --</option>
									<option <?php if ($editValue['isRecommanded'] == 'N' ) echo 'selected' ; ?> value="N">Normal</option>
									<option <?php if ($editValue['isRecommanded'] == 'Y' ) echo 'selected' ; ?> value="Y">Recommanded</option>
								</select>
							</div>

							<div class="field-wrap-half form-group">

								<select name="hotNew" id="hotNew">
									<option value="0">-- CHOOSE HOT OR NEW --</option>
									<option <?php if ($editValue['isHot'] == 'H' ) echo 'selected' ; ?> value="H">HOT</option>
									<option <?php if ($editValue['isHot'] == 'N' ) echo 'selected' ; ?> value="N">NEW</option>
									<option <?php if ($editValue['isHot'] == 'P' ) echo 'selected' ; ?> value="비공개">비공개</option>

								</select>
							</div>
						</div>

						<h2 style="margin-top:10px;font-size:14px;font-weight:800;">Filter options</h2>
						<div class="field-wrap">

							<div class="field-wrap-half form-group form-relative">

								<input type="text" value="<?php echo $editValue['dwMethods'];?>" name="dwMethods" placeholder="D/W Methods" />
								<button class="btn btn-info btn-xs btn-reset" type="button"><i class="fa fa-repeat fa-2x"></i></button>

							</div>
							<div class="field-wrap-half form-group form-relative">
								<input type="text" value="<?php echo $editValue['dailyBonus'];?>" name="dailyBonus" placeholder="Daily Bonus" />
								<button class="btn btn-info btn-xs btn-reset" type="button"><i class="fa fa-repeat fa-2x"></i></button>
							</div>

						</div><!--field-wrap-->

						<div class="field-wrap">
							<div class="field-wrap-half form-group form-relative">
								<input type="text" value="<?php echo $editValue['everytimeDepositeBonus'];?>" name="everytimeDepositeBonus" placeholder="Everytime Deposite Bonus" />
								<button class="btn btn-info btn-xs btn-reset" type="button"><i class="fa fa-repeat fa-2x"></i></button>
							</div>

							<div class="field-wrap-half form-group form-relative">
								<input type="text" value="<?php echo $editValue['minBettingAmount'];?>" name="minBettingAmount" placeholder="Min Betting Amount" />
								<button class="btn btn-info btn-xs btn-reset" type="button"><i class="fa fa-repeat fa-2x"></i></button>

							</div>

						</div><!--field-wrap-->

						<div class="field-wrap">

							<div class="field-wrap-half form-group form-relative">

								<input type="text" value="<?php echo $editValue['rebateBonus'];?>" name="rebateBonus" placeholder="Rebate Bonus" />
								<button class="btn btn-info btn-xs btn-reset" type="button"><i class="fa fa-repeat fa-2x"></i></button>

							</div>

							<div class="field-wrap-half form-group form-relative">

								<input type="text" value="<?php echo $editValue['rollingBonus'];?>" name="rollingBonus" placeholder="Rolling Bonus" />
								<button class="btn btn-info btn-xs btn-reset" type="button"><i class="fa fa-repeat fa-2x"></i></button>

							</div>

						</div><!--field-wrap-->

						<div class="field-wrap">

							<!-- <div class="field-wrap-half">

								<input type="text" value="<?php echo $editValue['established'];?>" name="established" placeholder="Established" />

							</div> -->
							<div class="field-wrap-half form-group form-relative">
								<input type="text" value="<?php echo $editValue['link'];?>" name="link" placeholder="Site Link" />
								<button class="btn btn-info btn-xs btn-reset" type="button"><i class="fa fa-repeat fa-2x"></i></button>
							</div>

							<div class="field-wrap-half form-group">

								<select name="liveChat" id="liveChat" >

									<option value="">-- CHOOSE LIVE CHAT  --</option>

									<option <?php if ($editValue['liveChat'] == 'Y' ) echo 'selected' ; ?> value="Y">YES</option>

									<option <?php if ($editValue['liveChat'] == 'N' ) echo 'selected' ; ?> value="N">NO</option>

								</select>

							</div>

						</div><!--field-wrap-->
						<!-- <div class="field-wrap">
							<div class="field-wrap-half">
								<input type="text" value="<?php echo $editValue['crossBetting'];?>" name="crossBetting" placeholder="Cross Betting" />
							</div>

							<div class="field-wrap-half">
								<input type="text" value="<?php echo $editValue['liveChatText'];?>" name="liveChatText" placeholder="live chat" />
							</div>
						</div> -->
						<div style="clear:both;"></div>


						<h2 style="margin-top:10px;font-size:14px;font-weight:800;">Additional Sports Details</h2>

						<div class="addBonusDetailsParent">

							<!-- <div class="field-wrap form-group" id="">

							

								<?php 

								$res = unserialize($editValue['sportsOtherDetails']);

								if(isset($res)){

									foreach($res as $k=>$v)

									{

									/* $res = explode('+', $editValue['sportsOtherDetails']);

									$label = json_decode($res['0']);

									$datas = json_decode($res['1']); */

								?>

								<div class="child-wrap">

									<input type="text" value="<?php echo $k; ?>" name="addBonusDetailsLabel[]" class="addBonusDetailsLabel" placeholder="Label" />

									<input type="text" value="<?php echo $v; ?>" name="addBonusDetailsValue[]" class="addBonusDetailsValue" placeholder="Value" />

								</div>

							<?php

									}

								}

							?>

							</div> -->
							<div class="field-wrap form-group" id="">
							<?php 
							$res = $editValue['sportsOtherDetails'];
							//echo $editValue['sportsOtherDetails'];
							if(isset($res) && $res != 'Array+Array'){
								$res = explode('+', $editValue['sportsOtherDetails']);
								$label = explode(',', $res['0']);
								$datas = explode(',',$res['1']);
								foreach ($label as $index => $val) {
							?>
							<div class="child-wrap form-group">
								<input type="text" value="<?php echo $val; ?>" name="addBonusDetailsLabel[]" class="addBonusDetailsLabel" placeholder="Label" style="margin-left: 0px;margin-bottom:10px;" />
								<input type="text" value="<?php echo $datas[$index]; ?>" name="addBonusDetailsValue[]" class="addBonusDetailsValue" placeholder="Value" style="margin-left: 0px;margin-bottom:10px;" />
							</div>
						<?php
								}
							}else{
						?>
							<div class="child-wrap form-group">
								<input type="text" value="" name="addBonusDetailsLabel[]" class="addBonusDetailsLabel" placeholder="Label" style="margin-left: 0px;margin-bottom:10px;" />
								<input type="text" value="" name="addBonusDetailsValue[]" class="addBonusDetailsValue" placeholder="Value" style="margin-left: 0px;margin-bottom:10px;" />
							</div>
						<?php		
							}
						?>
						</div>

						</div>
						<div class="field-wrap">

							<button type="button" class="btn btn-success text-white" id="addDetails"><i class="fa fa-plus"></i></button><button type="button" class="btn btn-success text-white" id="deleteDetails"><i class="fa fa-minus"></i></button>

						</div><br>

						<div style="clear:both;"></div>

						<div class="field-wrap">

							<textarea name="sportsRevw" id="editor" rows="20"><?php echo $editValue['sportsRevw'];?></textarea>

						</div>

						<br />

						<h2 style="margin-top:10px;font-size:14px;font-weight:800;">Add <span style="color:red;">META TAGS</span> for Search engine optimization</h2>
						<div class="field-wrap form-group form-relative">
							<input type="text" value="<?php echo $editValue['metaTitle'];?>" name="metaTitle" placeholder="Meta Title" required  />
							<button class="btn btn-info btn-xs btn-reset" type="button"><i class="fa fa-repeat fa-2x"></i></button>
						</div>
						<div class="field-wrap form-group form-relative">
							<!-- <input type="text" value="" name="metaDesc" placeholder="Meta Description" required  /> -->
							<textarea name="metaDesc" id="" rows="4" placeholder="Meta Description" required ><?php echo $editValue['metaDesc'];?></textarea>
							<button class="btn btn-info btn-xs btn-reset" type="button"><i class="fa fa-repeat fa-2x"></i></button>
						</div>
						<div class="field-wrap form-group form-relative">
							<input type="text" value="<?php echo $editValue['metaKeyword'];?>" name="metaKeyword" placeholder="Meta Keyword" required  />
							<button class="btn btn-info btn-xs btn-reset" type="button"><i class="fa fa-repeat fa-2x"></i></button>
						</div>

						<?php

						}

						?>

						<button type="submit" class="btn btn-info">Update Card</button> <!-- <button type="submit" class="">Preview</button> -->

					</form>
				</div>
			</div>

	</section>

</section>



<?php require_once('includes/doc_footer.php'); ?>