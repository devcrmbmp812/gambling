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
	'parentId' => ''
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
		<header>
			<span class="icon">&#128100;</span>
			<hgroup>
				<h1>User Edit</h1>
				<h2>Edit User accounts</h2>
			</hgroup>
		</header>
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
			}
		?>
						
			<form action="" method="post" enctype="multipart/form-data">
			<div class="widget-container">
				<section class="widget 	small">
					<div class="content">
						<div class="field-wrap">
							<div class="w-20">
								<label>Nick Name</label>
							</div>
							<div class="w-80">
								<input type="hidden" name="id" value="<?php echo $editValue['id'];?>"/>
								<input type="hidden" name="parentId" value="<?php echo $editValue['parentId'];?>"/>
								<input type="text" name="nickName" value="<?php echo $editValue['nickName'];?>"/>
							</div>
						</div>
						<div class="field-wrap">
							<div class="w-20">
								<label>Email</label>
							</div>
							<div class="w-80">
								<input type="text" name="email" value="<?php echo $editValue['email'];?>"/>
							</div>
						</div>
						<div class="field-wrap">
							<div class="w-20">
								<label>User Id</label>
							</div>
							<div class="w-80">
								<input type="text" name="userId" value="<?php echo $editValue['userId'];?>"/>
							</div>
						</div>
						<div class="field-wrap">
							<div class="w-20">
								<label>Password</label>
							</div>
							<div class="w-80">
								<input type="text" name="password" value="<?php echo $editValue['password'];?>"/>
							</div>
						</div>
						<div class="field-wrap">
							<div class="w-20">
								<label>change role</label>
							</div>
							<div class="w-80">
								<?php echo C::prepearDDL($User->getUserTypeArray(), $editValue['groupId'], array('name="groupId" class="updateGroupID"')); ?>
							</div>
						</div>
						<div class="field-wrap">
							<div class="w-20">
								<label>Select Site</label>
							</div>
							<div class="w-80">
								<input type="hidden" value="<?php $editValue['adminSite']; ?>" />
								<select id="adminSite" name="adminSite">
									<?php
										$res = $User->query("SELECT `siteName`, `link` FROM `tblWebCards` GROUP BY `siteName`");
											if(isset($res) && is_array($res) && count($res) > 0){
												foreach ($res as $id => $data) {
									?>
								    	<option value="<?php echo $data['siteName']; ?>"><?php echo $data['siteName']; ?></option>
							    	<?php
							    		}
							    	}
							    	?>
								</select>
							</div>
						</div>
						<button type="submit" class="green">Save</button>
					</div>
				</section>
			</div>
		</form>
		<?php
		}
		?>	
		</div>
	</section>
</section>


<?php require_once('includes/doc_footer.php'); ?>