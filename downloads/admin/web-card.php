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

?>
<?php require_once('includes/doc_head.php'); ?>
<section class="content">
	<section class="widget">
		<form action="" method="post" enctype="multipart/form-data">
			<header>
				<span class="icon">&#128196;</span>
				<hgroup>
					<h1>Web Card</h1>
					<h2>All uploaded files</h2>
				</hgroup>
			</header>
			<div class="content">
				<div class="field-wrap">
					<input type="text" value="" name="sportsName" placeholder="Sports Name" required />
				</div>
				<div class="field-wrap">
					<input type="text" value="" name="joinCode" placeholder="Join Code" required />
				</div>
				<!-- <div class="field-wrap">
					<input type="text" value="" name="siteName" placeholder="Website Name" />
				</div> -->
				<div class="field-wrap">
					<select name="sportsType[]" id="sportsType" class="chosen-select" multiple  tabindex="4" required >
						<!-- <option value="0">-- CHOOSE SPORTS TYPE --</option> -->
						<option value="Online sport">Online sport</option>
						<option value="Newest sport">Newest sport</option>
						<option value="Verified sport">Verified sport</option>
						<option value="Bitcoin sport">Bitcoin sport</option>
						<option value="Mobile sport">Mobile sport</option>
						<option value="Sadari sport">Sadari sport</option>
					</select>
					<!-- <input type="hidden" value="" name="sportsType" placeholder="Sports Type" /> -->
					
				</div>
			</br>
				<!-- <div class="field-wrap">
					<input type="text" value="" name="bonusAmount" placeholder="Bonus Amount" />
				</div> -->
				<div class="field-wrap">
					<textarea name="sportsDesc" id="" rows="4" placeholder="Sports Description" required ></textarea>
				</div>
				<!--<div class="field-wrap">
					<input type="text" value="" name="wageringRequirements" placeholder="Wager" />
				</div>-->
				<div class="field-wrap">
					<input type="text" value="" name="link" placeholder="Site Link" required  />
				</div>
				<div class="field-wrap">
					<input type="text" value="" name="maxPrizeMoney" placeholder="Max Prize Money" required  />
				</div>
				<div class="field-wrap">
					<input type="text" value="" name="singleBet" placeholder="Single Bet" required  />
				</div>
				<div class="field-wrap">
					<input type="text" value="" name="crossBetting" placeholder="Cross Betting" required  />
				</div>
				<div class="field-wrap">
					<input type="text" value="" name="welcomeBonus" placeholder="Welcome Bonus" required  />
				</div>
				<div class="field-wrap">
					<input type="text" value="" name="miniGame" placeholder="Mini Game" required  />
				</div>
				<div class="field-wrap">
					<input type="file" value="" name="sportsImage" placeholder="Image" required  />
				</div>
				<div class="field-wrap">
					<input type="text" value="" name="imageName" placeholder="Image Name" required  />
					<span style="color:#ff0000;">** every image must have different name **</span>
				</div>
				
				<h2 style="margin-top:10px;font-size:14px;font-weight:800;">Additional Sports Details</h2>
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
					<select name="categoryType" id="categoryType" required >
						<option value="0">-- CHOOSE RECOMMANDATION --</option>
						<option value="N">Normal</option>
						<option value="Y">Recommanded</option>
					</select>
					<input type="hidden" name="categoryType" value="" placeholder="Category Type" />
				</div>
				<div class="field-wrap">
					<select name="hotNew" id="hotNew" required >
						<option value="0">-- CHOOSE HOT OR NEW --</option>
						<option value="H">HOT</option>
						<option value="N">NEW</option>
					</select>
					<input type="hidden" name="hotNew" value="" placeholder="" />
				</div>
				<div class="field-wrap">
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
				<div class="field-wrap">
					<textarea name="sportsRevw" id="editor" rows="6" required ></textarea>
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
						$result = $Base->query("SELECT `id`, `joinCode`, `sportsName`, `siteName`, `sportsType`, `updatedOn`, `sportsImage`, `maxPrizeMoney`, `singleBet`, `crossBetting`, `isPin` FROM `tblWebCards`");
						if(is_array($result) && count($result) > 0){
							foreach ($result as $key => $value) {				
					?>
						<tr>
							<td><input type="checkbox" /><?php echo $value['sportsName']; ?></td>
							<td><?php echo $value['joinCode']; ?></td>
							<td><?php echo $value['sportsType']; ?></td>
							<td><?php echo $value['maxPrizeMoney']; ?></td>
							<td><?php echo $value['singleBet']; ?></td>
							<td><img src="<?php echo $value['sportsImage']; ?>" alt="" style="width:60px;height:60px;"></td>
							<td><?php echo $value['updatedOn']; ?></td>
							<td>
								<?php
								if($value['isPin'] != 'Y'){
								?>
								<a href="<?php echo C::link('web-card.php', array('pin' => $value['id']), true);?>" style="color:#fff;background:orange;padding:5px;"><span class="icon icon-custom">&#128206;</span></a>
								<?php } else{ ?>
								<a href="<?php echo C::link('web-card.php', array('unpin' => $value['id']), true);?>" style="color:#fff;background:orange;padding:5px;"><span class="icon icon-custom">&#59196;</span></a>
								<?}?>
								<a href="<?php echo C::link('webCardEdit.php', array('edit' => $value['id']), true);?>" style="color:#fff;background:green;padding:5px;"><span class="icon icon-custom">&#9998;</span></a>
								<a href="<?php echo C::link('web-card.php', array('delete' => $value['id']), true);?>"  style="color:#fff;background:#ff0000;padding:5px;"><span class="icon icon-custom">&#10062;</span></a>
							</td>
						</tr>
					<?php
						}
					}
					?>
					</tbody>
				</table>
		</div>
		<div align="center">
			<ul class="pagination1">
			  	<li><a href="#">«</a></li>
			 	<li><a href="#">1</a></li>
				<li><a class="active" href="#">2</a></li>
				<li><a href="#">3</a></li>
				<li><a href="#">4</a></li>
				<li><a href="#">5</a></li>
				<li><a href="#">6</a></li>
				<li><a href="#">7</a></li>
				<li><a href="#">»</a></li>
			</ul>
		</div>
	</section>
</section>

<?php require_once('includes/doc_footer.php'); ?>