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
    if($Card->inserSadariCard($_POST, $_FILES)){
    	C::redirect(C::link('sadari.php', false, true));
    }	
}
if(isset($_GET['delete']) && trim($_GET['delete'])){
	if($Card->delsadariCard($_GET['delete'])){
		C::redirect(C::link('sadari.php', false, true));
	}
}
if(isset($_GET['pin']) && trim($_GET['pin'])){
	$User->query("UPDATE `tblSadariCards` SET `isPin` = 'Y' WHERE `id` = '" . $_GET['pin'] . "'");
	C::redirect(C::link('sadari.php', false, true));
}else if (isset($_GET['unpin']) && trim($_GET['unpin'])) {
	$User->query("UPDATE `tblSadariCards` SET `isPin` = 'N' WHERE `id` = '" . $_GET['unpin'] . "'");
	C::redirect(C::link('sadari.php', false, true));
}


$activeNavigation = "sadari";
?>
<?php require_once('includes/doc_head.php'); ?>

<section class="content">
	<section class="widget">
		<form action="" method="post" enctype="multipart/form-data">
			<header>
				<span class="icon">&#128196;</span>
				<hgroup>
					<h1>Sadari</h1>
					<h2>All uploaded files</h2>
				</hgroup>
			</header>
			<div class="content">
				<div class="field-wrap">
					<div class="field-wrap-half">
						<input type="text" value="" name="sportsName" placeholder="Sports Name" required />
					</div>
					<div class="field-wrap-half">
						<input type="text" value="" name="joinCode" placeholder="Join Code" required />
					</div>
				</div>
				<div class="field-wrap">
					<div class="field-wrap-half">
						<input type="text" value="" name="siteName" placeholder="Website Name" required />
						<input type="hidden" value="Sadari sport" name="sportsType" placeholder="Sports Type" />
					</div>
					<div class="field-wrap-half">
						<input type="text" value="" name="link" placeholder="Site Link"  required/>
					</div>
				</div>
				<div class="field-wrap">
					<textarea name="sportsDesc" id="" rows="4" placeholder="Sports Description" required></textarea>
				</div>
				<div class="field-wrap">
					<div class="field-wrap-half">
						<input type="text" value="" name="wager" placeholder="Wager" required />
					</div>
					<div class="field-wrap-half">
						<input type="text" value="" name="closingTime" placeholder="Closing Time" required />
					</div>
				</div>
				<div class="field-wrap">
					<div class="field-wrap-half">
						<input type="text" value="" name="ruMatin" placeholder="Rutin/Matin" required />
					</div>
					<div class="field-wrap-half">
						<input type="text" value="" name="sadariOdd" placeholder="Sadari Odd" required />
					</div>
				</div>
				<div class="field-wrap">
					<div class="field-wrap-half">
						<input type="text" value="" name="maximumBetting" placeholder="Maximum Betting Amount" />
					</div>
					<div class="field-wrap-half">
						<input type="text" value="" name="minBettingAmount" placeholder="Minimum Betting Amount" />
					</div>
				</div>
				<div style="clear:both;"></div>
				<div class="field-wrap">
					<div class="field-wrap-half">
						<input type="file" value="" name="sportsImage" placeholder="Image" required />
					</div>
					<div class="field-wrap-half">
						<input type="text" value="" name="imageName" placeholder="Image Name" required />
						<span style="color:#ff0000;">** every image must have different name in english **</span>
					</div>
				</div>
				
				<h2 style="margin-top:10px;font-size:14px;font-weight:800;">Additional Sports Details <span style="color:red;">ADD ATLEAST ONE</span></h2>
				<div class="addBonusDetailsParent">
					<div class="field-wrap" id="">
						<div class="child-wrap">
							<input type="text" value="" name="addBonusDetailsLabel[]" class="addBonusDetailsLabel" placeholder="Label" />
							<input type="text" value="" name="addBonusDetailsValue[]" class="addBonusDetailsValue" placeholder="Value" />
						</div>
					</div>
				</div>
				<div class="field-wrap">
					<button type="button" class="red" id="addDetails">Add More</button><button type="button" class="blue" id="deleteDetails">Delete Last</button>
				</div><br>
				<div class="field-wrap">
					<div class="field-wrap-half">
						<select name="categoryType" id="categoryType" required>
							<option value="0">-- CHOOSE RECOMMANDATION --</option>
							<option value="N">Normal</option>
							<option value="Y">Recommanded</option>
						</select>
						<input type="hidden" name="categoryType" value="" placeholder="Category Type" />
					</div>
					<div class="field-wrap-half">
						<select name="hotNew" id="hotNew" required>
							<option value="0">-- CHOOSE HOT OR NEW --</option>
							<option value="H">HOT</option>
							<option value="N">NEW</option>
						</select>
						<input type="hidden" name="hotNew" value="" placeholder="" />
					</div>
				</div>
				<h2 style="margin-top:10px;font-size:14px;font-weight:800;">Filter Option</h2>
				<div class="field-wrap">
					<div class="field-wrap-half">
						<select name="" id="rate" required>
							<option value="0">-- GIVE RATING --</option>
							<option value="1">&#9734;</option>
							<option value="2">&#9734;&#9734;</option>
							<option value="3">&#9734;&#9734;&#9734;</option>
							<option value="4">&#9734;&#9734;&#9734;&#9734;</option>
							<option value="5">&#9734;&#9734;&#9734;&#9734;&#9734;</option>
						</select>
						<input type="hidden" name="rate" value="" placeholder="rate" />
					</div>
					<div class="field-wrap-half">
						<!-- <input type="text" value="" name="bettingOption" placeholder="Betting Option" /> -->
						<table width="100%" class="add-new" data-appnd=".mingm" data-type="betting-option">
							<tr>
								<td width="85%">
									<select name="bettingOption[]" class="chosen-select bettingOption" multiple  tabindex="4" >
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
								<td><button type="button" class="add-column add_new" data-open=".add-betting-option">+</button></td>
							</tr>
						</table>
						<table width="100%" class="add-betting-option">
							<tr>
								<td width="70%">
									<input type="text" value="" id="bettingoption" placeholder="Betting Option" />
								</td>
								<td><button type="button" class="add add_new_bettingoption" data-collect="#bettingoption" >ADD</button></td>
								<td><button type="button" class="add_new close_open" data-close=".add-betting-option">CLOSE</button></td>
							</tr>
						</table>
					</div>
				</div>
				<div style="clear:both;"></div>
				<div class="field-wrap">
					<div class="field-wrap-half">
						<input type="text" value="" name="rollingCondition" placeholder="Rolling Condition" />
					</div>
					<div class="field-wrap-half">
						<input type="text" value="" name="maxAwardAmount" placeholder="Max Award Amount" />
					</div>
				</div>
				<div style="clear:both;"></div>
				<div class="field-wrap">
					<textarea name="sportsRevw" id="editor" rows="6"></textarea>
				</div>
				<br />
				
				<button type="submit" class="green">Create Card</button> <!-- <button type="submit" class="">Preview</button> -->
			</div>
		</form>
	</section>
</section>
<section class="content">
	<section class="widget">
		<header>
			<span class="icon">&#128196;</span>
			<hgroup>
				<h1>list of web cards</h1>
				<h2>CMS content pages</h2>
			</hgroup>
		</header>
		<div class="content">
			<table id="myTable" border="0" width="100">
				<thead>
					<tr>
						<th>Sports Name</th>
						<th>Join Code</th>
						<th>Sadari Odd</th>
						<th>Wager</th>
						<th>Maximum Betting</th>
						<th>Image</th>
						<th>Update Time</th>
						<th>Action</th>
					</tr>
				</thead>
					<tbody>
					<?php
						$result = $Base->query("SELECT `id`, `joinCode`, `sportsName`, `siteName`, `sadariOdd`, `updatedOn`, `sportsImage`, `wager`, `maximumBetting`, `isPin` FROM `tblSadariCards`");

						if(is_array($result) && count($result) > 0){
							foreach ($result as $key => $value) {				
					?>
						<tr>
							<td><input type="checkbox" /><?php echo $value['sportsName']; ?></td>
							<td><?php echo $value['joinCode']; ?></td>
							<td><?php echo $value['sadariOdd']; ?></td>
							<td><?php echo $value['wager']; ?></td>
							<td><?php echo $value['maximumBetting']; ?></td>
							<td><img src="<?php echo HOST . '/' .$value['sportsImage']; ?>" alt="" style="width:60px;height:60px;"></td>
							<td><?php echo $value['updatedOn']; ?></td>
							<td>
								<?php
								if($value['isPin'] != 'Y'){
								?>
								<a href="<?php echo C::link('sadari.php', array('pin' => $value['id']), true);?>" style="color:#fff;background:orange;padding:5px;"><span class="icon icon-custom">&#128206;</span></a>
								<?php } else{ ?>
								<a href="<?php echo C::link('sadari.php', array('unpin' => $value['id']), true);?>" style="color:#fff;background:orange;padding:5px;"><span class="icon icon-custom">&#59196;</span></a>
								<?php } ?>
								<a href="<?php echo C::link('sadariEdit.php', array('edit' => $value['id']), true);?>" style="color:#fff;background:green;padding:5px;"><span class="icon icon-custom">&#9998;</span></a>
								<a href="<?php echo C::link('sadari.php', array('delete' => $value['id']), true);?>"  style="color:#fff;background:#ff0000;padding:5px;"><span class="icon icon-custom">&#10062;</span></a>
							</td>
						</tr>
					<?php
						}
					}
					?>
					</tbody>
				</table>
		</div>
	</section>
</section>

<?php require_once('includes/doc_footer.php'); ?>