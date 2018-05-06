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
	$Common->redirect('complaint.php');
}

if(isset($_POST) && is_array($_POST) && count($_POST) > 0){
    if($Card->inserBonusCard($_POST, $_FILES)){
    	C::redirect(C::link('bonus-card.php', false, true));
    }	
}
if(isset($_GET['delete']) && trim($_GET['delete'])){
	if($Card->delBonusCard($_GET['delete'])){
		C::redirect(C::link('bonus-card.php', false, true));
	}
}

?>
<?php require_once('includes/doc_head.php'); ?>

<section class="content">
	<section class="widget">
		<form action="" method="post" enctype="multipart/form-data" autocomplete="on">
			<header>
				<span class="icon">&#128196;</span>
				<hgroup>
					<h1>Bonus Card</h1>
					<h2>All uploaded files</h2>
				</hgroup>
			</header>
			<div class="content">
				<div class="field-wrap">
					<input type="text" value="" name="joinCode" placeholder="Join Code" required />
				</div>
				<div class="field-wrap">
					<input type="text" value="" name="sportsName" placeholder="Sports Name" required />
				</div>
				<div class="field-wrap">
					<input type="text" value="" name="bonusName" placeholder="Bonuse Name" required />
				</div>
				<div class="field-wrap">
					<input type="text" value="" name="bonusCode" placeholder="Bonus Code" required />
				</div>
				<div class="field-wrap">
					<select name="bonustype" id="bonustype" required>
						<option value="0">-- CHOOSE BONUS TYPE --</option>
						<option value="Welcome Bonus">신규 첫충 보너스</option>
						<option value="First Deposite Bonus">첫충전 보너스</option>
						<option value="Every Time Bonus">매번 충전 보너스</option>
						<option value="Rolling Bonus">롤링 보너스</option>
						<option value="Free Money">꽁머니 보너스</option>
						<option value="Combo Bonus">다폴더 보너스</option>
						<option value="Rebate Bonus">리베이트 보너스</option>
						<option value="Other Bonus">기타 보너스</option>
					</select>
					<input type="hidden" value="" name="bonustype" placeholder="Bonus Type" />
				</div>
				<div class="field-wrap">
					<input type="text" value="" name="bonusAmount" placeholder="Bonus Amount" required />
				</div>
				<div class="field-wrap">
					<textarea name="bonusDesc" id="" rows="4" placeholder="Bonus Description" required></textarea>
				</div>
				<div class="field-wrap">
					<input type="text" value="" name="wageringRequirements" placeholder="Wager" required />
				</div>
				<div class="field-wrap">
					<input type="text" value="" name="link" placeholder="Site Link" required />
				</div>
				<div class="field-wrap">
					<input type="file" value="" name="bonusImage" placeholder="Image" required />
				</div>
				<div class="field-wrap">
					<input type="text" value="" name="imageName" placeholder="Image Name" required style="margin-bottom:2px;"/>
					<span style="color:#ff0000;">** every image must have different name **</span>
				</div>
				
				<h2 style="margin-top:10px;font-size:14px;font-weight:800;">Additional Bonus Details</h2>
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
					<select name="categoryType" id="categoryType" required>
						<option value="0">-- CHOOSE BONUS SECTION --</option>
						<option value="N">Normal</option>
						<option value="Y">Popular</option>
					</select>
					<input type="hidden" name="categoryType" value="" placeholder="Category Type" />
				</div>
				<div class="field-wrap">
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
				<h1>list of bonus cards</h1>
				<h2>CMS content pages</h2>
			</hgroup>
		</header>
		<div class="content">
			<table id="myTable" border="0" width="100">
				<thead>
					<tr>
						<th>Bonus Name</th>
						<th>Join Code</th>
						<th>Sports Name</th>
						<th>Bonus Type</th>
						<th>Bonus Amount</th>
						<th>Image</th>
						<th>Update Time</th>
						<th>Action</th>
					</tr>
				</thead>
					<tbody>
					<?php
						$pagination = '';
						$page = (isset($_GET['__pGI']) && (int)$_GET['__pGI'] > 0 ? (int)$_GET['__pGI'] : 1);
						$limit = 12;
						$pullSQL = ' LIMIT ' . (($page - 1) * $limit) . ', ' . $limit;
						# [Pagination] instantiate; Set current page; set number of records
						$result = $Base->query("SELECT SQL_CALC_FOUND_ROWS `id`, `joinCode`, `bonusName`, `sportsName`, `bonustype`, `bonusAmount`, `updatedOn`, `bonusImage` FROM `tblBonusCards`" . $pullSQL);
						if(is_array($result) && count($result) > 0){
							C::loadLib('Pagination/Pagination');
							$pagination = (new Pagination());
							$pagination->setCurrent($page);
							$pagination->setRPP($limit);
							$pagination->setTotal($User->getFoundRows());
							$pagination->addClasses(array('pagination', 'pagination1'));

							# [Pagination] grab rendered/parsed pagination markup
							$pagination = $pagination->parse();
							foreach ($result as $key => $value) {				
					?>
						<tr>
							<td><input type="checkbox" /><?php echo $value['bonusName']; ?></td>
							<td><?php echo $value['joinCode']; ?></td>
							<td><?php echo $value['sportsName']; ?></td>
							<td><?php echo $value['bonustype']; ?></td>
							<td><?php echo $value['bonusAmount']; ?></td>
							<td><img src="<?php echo $value['bonusImage']; ?>" alt="" style="width:60px;height:60px;"></td>
							<td><?php echo $value['updatedOn']; ?></td>
							<td>
								<a href="<?php echo C::link('bonus-card-edit.php', array('edit' => $value['id']), true);?>" style="color:#fff;background:green;padding:5px;">EDIT</a>
								<a href="<?php echo C::link('bonus-card.php', array('delete' => $value['id']), true);?>" style="color:#fff;background:#ff0000;padding:5px;">DELETE</a>
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