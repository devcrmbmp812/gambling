<?php
require_once('../config.php');	

// Load Classes
C::loadClass('User');
C::loadClass('Card');
C::loadClass('CMS');
//Init User class
$Base = new Base();
$User = new User();
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
	'nickName' => '',
	'email' => '',
	'userId' => '',
	'password' => '',
	'groupId' => '',
	'id' => '',
	'profile_img' => '',
	'parentId' => '',
	'emailValid' => ''
);

if(isset($_POST) && is_array($_POST) && count($_POST) > 0){
    if($User->updateUser($_POST)){
    	C::redirect(C::link('users.php', false, true));
    }	
}

?>
<?php require_once('includes/doc_head.php'); ?>

<section class="alert"></section>
<section class="content">
	<section class="widget">
		<div class="panel panel-default bt-panel" style="box-shadow:none;">
			<div class="panel-heading">
				<span class="icon">&#128196;</span>
				<hgroup>
					<h5>User</h5>
					<h6>Edit current member account</h6>
				</hgroup>
			</div>
			<div class="panel-body">
				<div class="content">
					
				<?php
				if(isset($_GET['edit']) && trim($_GET['edit'])){
					$editID = $_GET['edit'];
					$result = $User->query("SELECT * FROM `tblUser` WHERE `id` = '" . $editID . "' LIMIT 0, 1");
					if($result && is_array($result) && count($result) > 0){
						$editValue['nickName'] = $result[0]['nickName'];
						$editValue['email'] = $result[0]['email'];
						$editValue['userId'] = $result[0]['userId'];
						$editValue['password'] = $result[0]['password'];
						$editValue['groupId'] = $result[0]['groupId'];
						$editValue['id'] = $result[0]['id'];
						$editValue['parentId'] = $result[0]['parentId'];
						$editValue['adminSite'] = $result[0]['siteName'];
						$editValue['emailValid'] = $result[0]['emailValid'];
					}
				?>
								
					<form action="" method="post" enctype="multipart/form-data">
					<div class="widget-container">
						<section class="widget 	small">
							<div class="content">
								<div class="field-wrap form-group">
									<div class="col-md-12">
										<label>Nick Name</label>
										<input type="hidden" name="id" value="<?php echo $editValue['id'];?>"/>
										<input type="hidden" name="parentId" value="<?php echo $editValue['parentId'];?>"/>
										<input type="text" name="nickName" value="<?php echo $editValue['nickName'];?>"/>
									</div>
								</div>
								<br>
								<div class="field-wrap form-group">
									<div class="col-md-12">
										<label>Email</label>
										<input type="text" name="email" value="<?php echo $editValue['email'];?>"/>
									</div>
								</div>
								<br>
								<div class="field-wrap form-group">
									<div class="col-md-12">
										<label>User Id</label>
										<input type="text" name="userId" value="<?php echo $editValue['userId'];?>"/>
									</div>
								</div>
								<br>
								<div class="field-wrap form-group">
									<div class="col-md-12">
										<label>Password</label>
										<input type="text" name="password" value="<?php echo $editValue['password'];?>"/>
									</div>
								</div>
								<br>
								<div class="field-wrap form-group">
									<div class="col-md-12">
										<label>Email Verification</label>
										<select name="emailValid">
											<option <?php if ($editValue['emailValid'] == 'Y' ) echo 'selected' ; ?> value="Y">Verified</option>
											<option <?php if ($editValue['emailValid'] == 'N' ) echo 'selected' ; ?> value="N">Pending Verification</option>
										</select>
									</div>
								</div>
								<br>
								<div class="field-wrap form-group">
									<div class="col-md-12">
										<label>change role</label>
										<?php echo C::prepearDDL($User->getUserTypeArray(), $editValue['groupId'], array('name="groupId" class="updateGroupID"')); ?>
									</div>
								</div>
								<br>
								<div class="field-wrap form-group">
									<div class="col-md-12">
										<label>Select Site</label>
										<input type="hidden" value="<?php $editValue['adminSite']; ?>" />
										<select id="adminSite" name="adminSite">
											<?php
												$res = $User->query("SELECT `siteName`, `link`, `sportsImage` FROM `tblWebCards` GROUP BY `siteName`");
													if(isset($res) && is_array($res) && count($res) > 0){
														foreach ($res as $id => $data) {
											?>
												<option value="<?php echo $data['siteName']; ?>"><?php echo $data['siteName']; ?></option>
											<?php
												}
											}
											?>
										</select>
										<input type="hidden" name="profile_img" id="profile_img" value="" />
									</div>
								</div>
								<br>
								<button type="submit" class="btn btn-info">Save</button>
							</div>
						</section>
					</div>
				</form>
				<?php
				}
				?>	
				</div>
			</div>
		</div>
	</section>
</section>


<?php require_once('includes/doc_footer.php'); ?>