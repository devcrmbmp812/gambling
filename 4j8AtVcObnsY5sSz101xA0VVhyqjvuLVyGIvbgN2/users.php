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




if(isset($_GET['delete']) && trim($_GET['delete'])){
	if($User->userDel($_GET['delete'])){
		C::redirect(C::link('users.php', false, true));
	}
}
$activeNavigation = "users";
?>
<?php require_once('includes/doc_head.php'); ?>


<section class="content">
	<section class="widget">
		<div class="panel panel-default bt-panel" style="box-shadow:none;">
			<div class="panel-heading">
				<span class="icon">&#128196;</span>
				<hgroup>
					<h5>User</h5>
					<h6>Current member account</h6>
				</hgroup>
			</div>
			<div class="panel-body">
				<div class="content clearfix">
					<table id="myTable" class="table table-striped table-responsive" width="100%">
						<thead>
							<tr>
								<th class="avatar">Nick Name</th>
								<th>Email</th>
								<th>User Id</th>
								<th>Password</th>
								<th>Registered Date</th>
								<th>User Role</th>
								<th>Verification</th>
								<th>Action</th>
							</tr>
						</thead>
							<tbody>
								<?php
								$result = $Base->query("SELECT * FROM `tblUser` ORDER BY `createdOn` DESC");
								if(is_array($result) && count($result) > 0){
									foreach ($result as $key => $value) {	
									 if($value['groupId'] == '0'){

									 } else {

									// echo "<pre>";
									// print_r($value);			
									// echo "<pre>";			
								?>
								<tr>
									<td class="avatar"><img src="images/user2.png" alt="" height="40" width="40" /> <?php echo $value['nickName']; ?></td>
									<td> <?php echo $value['email']; ?></td>
									<td> <?php echo $value['userId']; ?></td>
									<td> <?php echo $value['password']; ?></td>
									<td> <?php echo $value['createdOn']; ?></td>
									<td> 
										<?php
											if ($value['groupId'] == 0) {
												echo "Admin";
											} else if ($value['groupId'] == 2){
												echo "Site Admin";
											} else if ($value['groupId'] == 3){
												echo "User";
											}
										?>
									</td>
									<td> <a href="javascript:void(0);"><?php echo $emailValid = ($value['emailValid'] == 'Y') ? '<i class="fa fa-toggle-on" aria-hidden="true"></i>' : '<i class="fa fa-toggle-off" aria-hidden="true"></i>' ; ?></a></td>
									<td>
										<a href="<?php echo C::link('userEdit.php', array('edit' => $value['id']), true);?>" class="btn btn-danger btn-xs text-white"><i class="fa fa-edit"></i></a>
										<a href="<?php echo C::link('users.php', array('delete' => $value['id']), true);?>" class="btn btn-warning btn-xs text-white" onclick="return confirm('Are you sure?');"><i class="fa fa-trash"></i></a>
									</td>
								</tr>
								<?php
								} }
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