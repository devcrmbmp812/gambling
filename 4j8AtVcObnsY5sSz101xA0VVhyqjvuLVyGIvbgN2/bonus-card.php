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
$activeNavigation = "bonus";
?>
<?php require_once('includes/doc_head.php'); ?>

<section class="content">
	<section class="widget">
		<div class="panel panel-default bt-panel" style="box-shadow:none;">
			<div class="panel-heading">
				<span class="icon">&#128196;</span>
				<hgroup>
					<h5>Bonus Card</h5>
					<h6>All uploaded files</h6>
				</hgroup>
			</div>
			<div class="panel-body">
				<div class="content">
					<form action="" method="post" enctype="multipart/form-data" autocomplete="on">
					<div class="field-wrap">
						<div class="field-wrap-half form-group">
							<select name="sportsName" id="dynamic-sports">
								<option>--Select sports name--</option>
								<?php
									$res = $User->query("SELECT DISTINCT `sportsName`, `link` FROM `tblWebCards`");
										if(isset($res) && is_array($res) && count($res) > 0){
											foreach ($res as $id => $data) {
								?>
								<option value="<?php echo $data['sportsName']; ?>"><?php echo $data['sportsName']; ?></option>
								<?php
									}
								}
								?>
							</select>
						</div>
						<div class="field-wrap-half form-group">
							<input type="text" value="" name="joinCode" id="spotsBonusJoincode" placeholder="Join Code"/>
						</div>
					</div>
					<div class="field-wrap">
						<div class="field-wrap-half form-group">
							<input type="text" value="" name="bonusName" placeholder="Bonuse Name"/>
						</div>
						<!-- <div class="field-wrap-half form-group">
							<input type="text" value="" name="bonusCode" placeholder="Bonus Code"/>
						</div> -->
					</div>
					<div class="field-wrap">
						<div class="field-wrap-half form-group">
							<select name="bonustype" id="bonustype">
								<option value="0">-- CHOOSE BONUS TYPE --</option>
								<option value="신규 첫충 보너스">신규 첫충 보너스</option>
								<option value="첫충전 보너스">첫충전 보너스</option>
								<option value="매번 충전 보너스">매번 충전 보너스</option>
								<option value="롤링 보너스">롤링 보너스</option>
								<option value="꽁머니 보너스">꽁머니 보너스</option>
								<option value="다폴더 보너스">다폴더 보너스</option>
								<option value="낙첨금 보너스">낙첨금 보너스</option>
								<option value="기타 보너스">기타 보너스</option>
							</select>
							<input type="hidden" value="" name="bonustype" placeholder="Bonus Type" />
						</div>
						<div class="field-wrap-half form-group">
							<input type="text" value="" name="bonusAmount" placeholder="Bonus Amount"/>
						</div>
					</div>
					<div class="field-wrap form-group">
						<textarea name="bonusDesc" rows="4" placeholder="Bonus Description"></textarea>
					</div>
					<div class="field-wrap">
						<div class="field-wrap-half form-group">
							<input type="text" value="" name="wageringRequirements" placeholder="이용 조건 (스포츠)"/>
						</div>
						
						<div class="field-wrap-half form-group">
							<input type="text" value="" name="wageringRequirementsMinigame" placeholder="이용 조건 (미니게임)"/>
						</div>
					</div>
					<div class="field-wrap">
						<div class="field-wrap-half form-group">
							<input type="text" value="" name="link" id="spotsBonuslink" placeholder="Site Link"/>
						</div>
					</div>
					<div style="clear:both;"></div>
					<div class="field-wrap">
						<div class="field-wrap-half form-group">
							<input type="file" value="" name="bonusImage" placeholder="Image"/>
						</div>
						<div class="field-wrap-half form-group">
							<input type="text" value="" name="imageName" id="bonusImageName" placeholder="Image Name"style="margin-bottom:2px;"/>
							<input type="hidden" id="sportsImagesname" name="sportsImagesname" value="">
							<span style="color:#ff0000;">** every image must have different name **</span>
						</div>
					</div>
					<div class="addBonusDetailsParent">
						<div class="field-wrap form-group" id="">
							<h2 style="margin-top:10px;font-size:14px;font-weight:800;">Additional Bonus Details</h2>
							<div class="child-wrap">
								<input type="text" value="" name="addBonusDetailsLabel[]" class="addBonusDetailsLabel" placeholder="Label" style="margin-left: 0px;margin-bottom:10px;" />
								<input type="text" value="" name="addBonusDetailsValue[]" class="addBonusDetailsValue" placeholder="Value" style="margin-left: 0px;margin-bottom:10px;" />
							</div>
						</div>
					</div>
					<div class="field-wrap">
						<button type="button" class="btn btn-success" id="addDetails" style="margin-right:5px;">Add More</button><button type="button" class="btn btn-warning" id="deleteDetails">Delete Last</button>
					</div><br>
					<div class="field-wrap">
						<h2 style="margin-top:10px;font-size:14px;font-weight:800;">Filter Option</h2>

						<div class="field-wrap-half form-group">
							<select name="categoryType" id="categoryType">
								<option value="0">-- CHOOSE BONUS SECTION --</option>
								<option value="N">Normal</option>
								<option value="Y">Popular</option>
							</select>
							<input type="hidden" name="categoryType" value="" placeholder="Category Type" />
						</div>
						<div class="field-wrap-half form-group">
							<select name="" id="rate">
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
					<div class="field-wrap">
						<div class="field-wrap-half form-group">
							<input type="text" value="" name="minDepositeAmpount" placeholder="Minimum Deposite Amount"/>
						</div>
						<!-- <div class="field-wrap-half form-group">
							<input type="text" value="" name="rollingCondition" placeholder="Rolling Condition"/>
						</div> -->
						<div class="field-wrap-half form-group">
							<input type="text" value="" name="maxBonusAmount" placeholder="Max Bonus Amount"/>
						</div>
					</div>
					<div class="field-wrap">
						<!-- <div class="field-wrap-half form-group">
							<input type="text" value="" name="bonusConUtilization" placeholder="Bonus condition of utilization"/>
						</div>
						<div class="field-wrap-half form-group">
							<input type="text" value="" name="maxBonusAmount" placeholder="Max Bonus Amount"/>
						</div> -->
					</div>
					<div class="field-wrap">
						<div class="field-wrap-half form-group">
							<input type="text" value="" name="maxCashout" placeholder="Max Cashout"/>
						</div>
						<div class="field-wrap-half form-group">
							<input type="text" value="" name="bonusWithdrawlCondition" placeholder="Bonus Withdrawl Condition"/>
						</div>
					</div>
					<h2 style="margin-top:10px;font-size:14px;font-weight:800;">Add <span style="color:red;">META TAGS</span> for Search engine optimization</h2>
						<div class="field-wrap form-group form-relative">
							<input type="text" value="" name="metaTitle" placeholder="Meta Title" required  />
							<!-- <button class="btn btn-info btn-xs btn-reset" type="button"><i class="fa fa-repeat fa-2x"></i></button> -->
						</div>
						<div class="field-wrap form-group form-relative">
							<!-- <input type="text" value="" name="metaDesc" placeholder="Meta Description" required  /> -->
							<textarea name="metaDesc" id="" rows="4" placeholder="Meta Description" required ></textarea>
							<!-- <button class="btn btn-info btn-xs btn-reset" type="button"><i class="fa fa-repeat fa-2x"></i></button> -->
						</div>
						<div class="field-wrap form-group form-relative">
							<input type="text" value="" name="metaKeyword" placeholder="Meta Keyword" required  />
							<!-- <button class="btn btn-info btn-xs btn-reset" type="button"><i class="fa fa-repeat fa-2x"></i></button> -->
						</div>
					<button type="submit" class="btn btn-info">Create Card</button> <!-- <button type="submit" class="">Preview</button> -->
				</div>
			</form>
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
							//$limit = 12;
							//$pullSQL = ' LIMIT ' . (($page - 1) * $limit) . ', ' . $limit;
							# [Pagination] instantiate; Set current page; set number of records
							$result = $Base->query("SELECT SQL_CALC_FOUND_ROWS `id`, `joinCode`, `bonusName`, `sportsName`, `bonustype`, `bonusAmount`, `updatedOn`, `bonusImage` FROM `tblBonusCards`");
							if(is_array($result) && count($result) > 0){
								C::loadLib('Pagination/Pagination');
								$pagination = (new Pagination());
								$pagination->setCurrent($page);
								//$pagination->setRPP($limit);
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
								<td><img src="<?php echo HOST . '/' .$value['bonusImage']; ?>" alt="" style="width:60px;height:60px;"></td>
								<td><?php echo $value['updatedOn']; ?></td>
								<td>
									<a href="<?php echo C::link('bonus-card-edit.php', array('edit' => $value['id']), true);?>" class="btn btn-success btn-xs text-white"><i class="fa fa-edit"></i></a>
									<a href="<?php echo C::link('bonus-card.php', array('delete' => $value['id']), true);?>" class="btn btn-danger btn-xs text-white" onclick="return confirm('Are you sure?');"><i class="fa fa-trash"></i></a>
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