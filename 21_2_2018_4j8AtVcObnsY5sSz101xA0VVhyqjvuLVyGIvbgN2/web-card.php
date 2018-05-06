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



if(isset($_POST) && is_array($_POST) && count($_POST) > 0){

    	//print_r($_POST);

    if($Card->inserWebCard($_POST, $_FILES)){

    	C::redirect(C::link('web-card.php', false, true));

    }	

}

if(isset($_GET['delete']) && trim($_GET['delete'])){

	if($Card->delwebCard($_GET['delete'])){

		C::redirect(C::link('web-card.php', false, true));

	}

}

if(isset($_GET['pin']) && trim($_GET['pin'])){

	$User->query("UPDATE `tblWebCards` SET `isPin` = 'Y' WHERE `id` = '" . $_GET['pin'] . "'");

	C::redirect(C::link('web-card.php', false, true));

}else if (isset($_GET['unpin']) && trim($_GET['unpin'])) {

	$User->query("UPDATE `tblWebCards` SET `isPin` = 'N' WHERE `id` = '" . $_GET['unpin'] . "'");

	C::redirect(C::link('web-card.php', false, true));

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
				<div class="content custom-content">
					<form action="" method="post" enctype="multipart/form-data">
						<div class="field-wrap">
							<div class="field-wrap-half form-group">
								<input type="text" value="" name="sportsName" placeholder="Sports Name" required />
							</div>
							<div class="field-wrap-half form-group">
								<input type="text" value="" name="joinCode" placeholder="Join Code" required />
							</div>
						</div><!--field-wrap-->
						<div class="field-wrap form-group">
							<select name="sportsType[]" id="sportsType" class="chosen-select" multiple  tabindex="4" >
								<option value="Online sport">Online sport</option>
								<option value="Newest sport">Newest sport</option>
								<option value="Verified sport">Verified sport</option>
								<option value="Bitcoin sport">Bitcoin sport</option>
								<option value="Livebetting sport">Livebetting sport</option>
								<option value="Sadari sport">Sadari sport</option>
							</select>	
						</div>
						</br>
						<div class="field-wrap form-group">
							<textarea name="sportsDesc" id="" rows="4" placeholder="Sports Description" required ></textarea>
						</div>
						<div class="field-wrap">
							<div class="field-wrap-half form-group">
								<input type="text" value="" name="welcomeBonus" placeholder="Welcome Bonus"  required />
							</div>
							<div class="field-wrap-half form-group">
								<input type="text" value="" name="maxBettingAmount" placeholder="Max Betting Amount" />
							</div>
							<div class="field-wrap-half form-group">
								<input type="text" value="" name="maxPrizeMoney" placeholder="Max Prize Money" required  />
							</div>
							<div class="field-wrap-half form-group">
								<input type="text" value="" name="singleBet" placeholder="Single Bet"  required required />
							</div>
						</div><!--field-wrap-->

						<div class="field-wrap">
							<div class="field-wrap-half form-group">
								<input type="text" value="" name="maxWithdrawlLimit" placeholder="Max Withdrawl Limit" />
							</div>
							<div class="field-wrap-half form-group">
								<select name="" id="rate" required >
									<option value="0">-- GIVE RATING --</option>
									<option value="1">&#9734;</option>
									<option value="2">&#9734;&#9734;</option>
									<option value="3">&#9734;&#9734;&#9734;</option>
									<option value="4">&#9734;&#9734;&#9734;&#9734;</option>
									<option value="5">&#9734;&#9734;&#9734;&#9734;&#9734;</option>
								</select>
								<input type="hidden" name="rate" value="" placeholder="rate" />
							</div>
						</div>

						<div class="field-wrap form-group">
							<table width="100%" class="add-new" data-appnd=".mingm" data-type="miniGame">
								<tr>
									<td>
										<div class="">
											<select name="miniGame[]" class="miniGame" multiple  tabindex="6" >
												<?php 
												$res = $Base->query("SELECT `id`, `value` FROM `tblFilter` WHERE `name` = 'mini-game'");
													if(is_array($res) && count($res) > 0){
														foreach ($res as $key => $value) {
															$v = $value['value'];
												?>
												<option value="<?php echo $v;?>"><?php echo $v;?></option>
												<?php 
													}
												}
												?>
											</select><!--.chosen-select -->
										</div>
									</td>
								</tr>
								<tr>
									<td>
										<button type="button" class="btn btn-success add-column" data-open=".add-minigame-option"><i class="fa fa-plus"></i></button>
										<button type="button" class="btn btn-danger ksc_delete"><i class="fa fa-minus"></i></button>
									</td>
								</tr>
							</table>
							<br>
							<table width="100%" class="add-minigame-option">
								<tr>
									<td width="90%">
										<input type="text" value="" id="minigame" placeholder="mini game" />
									</td>
									<td>
										<button type="button" class="btn btn-success add add_new_mini" data-collect="#minigame" ><i class="fa fa-plus"></i></button>
									</td>
									<td>
										<button type="button" class="btn btn-danger close_open" data-close=".add-minigame-option"><i class="fa fa-minus"></i></button>
									</td>
								</tr>
							</table>
						</div>
							<!--<div class="field-wrap">
								<table width="100%" class="delete-new">
									<tr>
										<td>
										<div class="">
											<select name="ksc_miniGame" class="ksc_miniGame"  tabindex="4" >
											<option value="">Select option</option>
												<?php 
												$res = $Base->query("SELECT `id`, `value` FROM `tblFilter` WHERE `name` = 'mini-game'");
													if(is_array($res) && count($res) > 0){
														foreach ($res as $key => $value) {
															$v = $value['value'];
															$id = $value['id'];
												?>
												<option value="<?php echo $id;?>"><?php echo $v;?></option>
												<?php 
													}
												}
												?>
											</select>
										</div>
										</td>
										<td><button type="button" class="ksc_delete">Delete</button></td>
									</tr>
								</table>

							<style>.add-Minigame{padding-top: 6px;}</style>

						</div>--><!--field-wrap-->
						<br>

						<div class="field-wrap form-group">
							<table width="100%" class="add-new" data-appnd=".mingm" data-type="betting-option">
								<tr>
									<td>
										<select name="bettingOption[]" class="bettingOption" multiple  tabindex="4">
											<?php 
											$res = $Base->query("SELECT `id`, `value` FROM `tblFilter` WHERE `name` = 'betting-option'");
												if(is_array($res) && count($res) > 0){
													foreach ($res as $key => $value) {
														$v = $value['value'];
											?>
											<option value="<?php echo $v;?>"><?php echo $v;?></option>
											<?php 
												}
											}
											?>
										</select>
									</td>
								</tr>
								<tr>
									<td>
										<button type="button" class="btn btn-success text-white add-column add_new" data-open=".add-betting-option"><i class="fa fa-plus"></i></button>
										<button type="button" class="btn btn-danger text-white ksc_betting_delete"><i class="fa fa-minus"></i></button>
									</td>
								</tr>
							</table>
							<br>
							<table width="100%" class="add-betting-option">
								<tr>
									<td width="90%">
										<input type="text" value="" id="bettingoption" placeholder="Betting Option" />
									</td>
									<td><button type="button" class="btn btn-success add add_new_bettingoption text-white" data-collect="#bettingoption"><i class="fa fa-plus"></i></button></td>
									<td><button type="button" class="btn btn-danger add_new close_open text-white" data-close=".add-betting-option"><i class="fa fa-minus"></i></button></td>
								</tr>
							</table>

						</div>
							<br>
						<div style="clear:both;"></div>

						<div class="field-wrap">
							<div class="field-wrap-half form-group">
								<input type="file" value="" name="sportsImage" placeholder="Image" required  />
							</div>

							<div class="field-wrap-half form-group">
								<input type="text" value="" name="imageName" placeholder="Image Name" required  />
								<span style="color:#ff0000;">** every image must have different name in English **</span>
							</div>
						</div><!--field-wrap-->

						<div class="field-wrap">
							<div class="field-wrap-half form-group">
								<select name="categoryType" id="categoryType" required >
									<option value="0">-- CHOOSE RECOMMANDATION --</option>
									<option value="N">Normal</option>
									<option value="Y">Recommanded</option>
								</select>
								<input type="hidden" name="categoryType" value="" placeholder="Category Type" />
							</div>

							<div class="field-wrap-half form-group">
								<select name="hotNew" id="hotNew" required >
									<option value="0">-- CHOOSE HOT OR NEW --</option>
									<option value="H">HOT</option>
									<option value="N">NEW</option>
									<option value="P">비공개</option>
								</select>
								<input type="hidden" name="hotNew" value="" placeholder="" />
							</div>
						</div><!--field-wrap-->

						<h2 style="margin-top:10px;font-size:14px;font-weight:800;">Filter options</h2>

						<!--<div class="field-wrap">

							<div class="field-wrap-half">

								<select name="" id="rate" required >

									<option value="0">-- GIVE RATING --</option>

									<option value="1">&#9734;</option>

									<option value="2">&#9734;&#9734;</option>

									<option value="3">&#9734;&#9734;&#9734;</option>

									<option value="4">&#9734;&#9734;&#9734;&#9734;</option>

									<option value="5">&#9734;&#9734;&#9734;&#9734;&#9734;</option>

								</select>

								<input type="hidden" name="rate" value="" placeholder="rate" />

							</div>

						</div>--><!--field-wrap-->

						<!-- <div class="field-wrap">

						<div class="field-wrap-half">

							<table width="100%" class="delete-new">

								<tr>

									<td>

									<div class="">

										<select name="ksc_betting" class="ksc_betting"  tabindex="4" >

										<option value="">Select option</option>

											<?php 

											$res = $Base->query("SELECT `id`, `value` FROM `tblFilter` WHERE `name` = 'betting-option'");

												if(is_array($res) && count($res) > 0){

													foreach ($res as $key => $value) {

														$v = $value['value'];

														$id = $value['id'];

											?>

											<option value="<?php echo $id;?>"><?php echo $v;?></option>

											<?php 

												}

											}

											?>

										</select>

									</div>

									</td>

									<td><button type="button" class="ksc_delete_betting">Delete</button></td>

								</tr>

								

							</table>

						</div>

						</div> -->

						<div style="clear:both;"></div>

						<div class="field-wrap">

							<div class="field-wrap-half form-group">

								<input type="text" value="" name="dwMethods" placeholder="D/W Methods" />

							</div>

							<!-- <div class="field-wrap-half">
								<input type="text" value="" name="maxWithdrawlLimit" placeholder="Max Withdrawl Limit" />
							</div> -->

						</div><!--field-wrap-->

						<div class="field-wrap">
							<!-- need to change place -->
							<!-- <div class="field-wrap-half">
								<input type="text" value="" name="maxBettingAmount" placeholder="Max Betting Amount" />
							</div> -->

							<div class="field-wrap-half form-group">
								<input type="text" value="" name="dailyBonus" placeholder="Daily Bonus" />
							</div>

						</div><!--field-wrap-->

						<div class="field-wrap">
							<div class="field-wrap-half form-group">
								<input type="text" value="" name="minBettingAmount" placeholder="Min Betting Amount" />
							</div>
							<div class="field-wrap-half form-group">
								<input type="text" value="" name="everytimeDepositeBonus" placeholder="Everytime Deposite Bonus" />
							</div>

						</div><!--field-wrap-->

						<div class="field-wrap">
							<div class="field-wrap-half form-group">
								<input type="text" value="" name="rebateBonus" placeholder="Rebate Bonus" />
							</div>

							<div class="field-wrap-half form-group">
								<input type="text" value="" name="rollingBonus" placeholder="Rolling Bonus" />
							</div>
						</div><!--field-wrap-->

						<div class="field-wrap">
							<div class="field-wrap-half form-group">
								<input type="text" value="" name="link" placeholder="Site Link" required  />
							</div>
							<div class="field-wrap-half form-group">
								<select name="liveChat" id="liveChat" >
									<option value="">-- CHOOSE LIVE CHAT  --</option>
									<option value="Y">YES</option>
									<option value="N">NO</option>
								</select>
							</div>
						</div><!--field-wrap-->

						<!--<div class="field-wrap">
							<div class="field-wrap-half">
								<input type="text" value="" name="established" placeholder="Established" />
							</div>
							<div class="field-wrap-half">
								<input type="text" value="" name="crossBetting" placeholder="Cross Betting" required  />
							</div>
						</div>--><!--field-wrap-->

						<br>
						<br>
						<br>
						<br>
						<div style="clear:both;"></div>
						<h2 style="margin-top:10px;font-size:14px;font-weight:800;">Additional Sports Details <span style="color:red;">ADD ATLEAST ONE</span></h2>

						<div class="addBonusDetailsParent">
							<div class="field-wrap form-group" id="">
								<div class="child-wrap">
									<input type="text" value="" name="addBonusDetailsLabel[]" class="addBonusDetailsLabel" placeholder="Label" style="margin-left: 0px;margin-bottom:10px;" />
									<input type="text" value="" name="addBonusDetailsValue[]" class="addBonusDetailsValue" placeholder="Value" style="margin-left: 0px;margin-bottom:10px;" />
								</div>
							</div>
						</div>

						<div class="field-wrap form-group">
							<button type="button" class="btn btn-success" id="addDetails">Add More</button><button type="button" class="btn btn-warning" id="deleteDetails">Delete Last</button>
						</div><br>

						<div style="clear:both;"></div>

						<div class="field-wrap form-group">
							<textarea name="sportsRevw" id="editor" rows="6" ></textarea>
						</div>

						<br />

						<button type="submit" class="btn btn-info">Create Card</button> <!-- <button type="submit" class="">Preview</button> -->


					</form>

				</div><!-- content -->
			</div>
		</div>
	</section>

</section>

<section class="content">

	<section class="widget">

		<div class="panel panel-default bt-panel" style="box-shadow:none;">
			<div class="panel-heading">
				<span class="icon">&#128196;</span>
				<hgroup>
					<h5>Category</h5>
					<h6>CMS content pages</h6>
				</hgroup>
			</div>
			<div class="panel-body">

				<div class="content">
					<table id="myTable" class="table table-striped table-responsive" width="100%">
						<thead>
							<tr>
								<th>Sports Name</th>
								<th>Join Code</th>
								<th>Sports Type</th>
								<th>Max Prize Money</th>
								<th>Single Bet</th>
								<th>Image</th>
								<th>Update Time</th>
								<th>Action</th>
							</tr>
						</thead>
						<tbody>
							<?php
								$result = $Base->query("SELECT `id`, `joinCode`, `sportsName`, `siteName`, `sportsType`, `updatedOn`, `sportsImage`, `maxPrizeMoney`, `singleBet`, `isPin` FROM `tblWebCards`");

								if(is_array($result) && count($result) > 0){

									foreach ($result as $key => $value) {				

							?>

							<tr>
								<td><input type="checkbox" /><?php echo $value['sportsName']; ?></td>
								<td><?php echo $value['joinCode']; ?></td>
								<td><?php echo $value['sportsType']; ?></td>
								<td><?php echo $value['maxPrizeMoney']; ?></td>
								<td><?php echo $value['singleBet']; ?></td>
								<td><img src="<?php echo HOST . '/' .$value['sportsImage']; ?>" alt="" style="width:60px;height:60px;"></td>
								<td><?php echo $value['updatedOn']; ?></td>
								<td>
									<?php
									if($value['isPin'] != 'Y'){
									?>
									<a href="<?php echo C::link('web-card.php', array('pin' => $value['id']), true);?>" class="btn btn-success btn-xs text-white"><i class="fa fa-paperclip"></i></a>
									<?php } else{ ?>
									<a href="<?php echo C::link('web-card.php', array('unpin' => $value['id']), true);?>" class="btn btn-success btn-xs text-white"><i class="fa fa-unlink"></i></a>
									<?php } ?>
									<a href="<?php echo C::link('webCardEdit.php', array('edit' => $value['id']), true);?>" class="btn btn-danger btn-xs text-white"><i class="fa fa-edit"></i></a>
									<a href="<?php echo C::link('web-card.php', array('delete' => $value['id']), true);?>" class="btn btn-warning btn-xs text-white"><i class="fa fa-trash"></i></a>
								</td>

							</tr>

							<?php

								}

							}

							?>
							</tbody>
					</table>
				</div>
			</div>
		</div>
	</section>

</section>

<?php require_once('includes/doc_footer.php'); ?>

