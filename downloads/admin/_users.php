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

$editValue = false;


if(isset($_GET['delete']) && is_array($_GET['delete']) && count($_GET['delete']) > 0){
	if($User->userDelete($_GET['delete'])){
		C::redirect(C::link('users.php', false, true));
	}
}

?>
<?php require_once('includes/doc_head.php'); ?>

<section class="alert">
	<!-- <form method="link" action="page-new.html">
		 <button class="green">Create new blog page</button>
	</form> -->
</section>
<section class="content">
	<section class="widget">
		<header>
			<span class="icon">&#128100;</span>
			<hgroup>
				<h1>Users</h1>
				<h2>Current member accounts</h2>
			</hgroup>
			<!-- <aside>
				<span>
					<a href="#">&#9881;</a>
					<ul class="settings-dd">
						<li><label>Option a</label><input type="checkbox" /></li>
						<li><label>Option b</label><input type="checkbox" checked="checked" /></li>
						<li><label>Option c</label><input type="checkbox" /></li>
					</ul>
				</span>
			</aside> -->
		</header>
		<div class="content">
			<table id="myTable" border="0" width="100">
				<thead>
					<tr>
						<th class="avatar">Nick Name</th>
						<th>Email</th>
						<th>User Id</th>
						<th>Password</th>
						<th>Date</th>
						<th>User Role</th>
						<!-- <th>change role</th> -->
						<th>Action</th>
					</tr>
				</thead>
					<tbody>
						<?php
						$result = $Base->query("SELECT * FROM `tblUser`");
						if(is_array($result) && count($result) > 0){
							foreach ($result as $key => $value) {				
						?>
						<tr>
							<td class="avatar"><img src="images/user2.png" alt="" height="40" width="40" /> <?php echo $value['nickName']; ?></td>
							<td> <?php echo $value['email']; ?></td>
							<td> <?php echo $value['userId']; ?></td>
							<td> <?php echo $value['password']; ?></td>
							<td> <?php echo $value['updatedOn']; ?></td>
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
							<!-- <td>
								<div class="groupUpdate">
									<?php echo C::prepearDDL($User->getUserTypeArray(), ((int)C::setFieldValue($editValue, 'tblUserDetails.groupId') > 0 ? C::setFieldValue($editValue, 'tblUserDetails.groupId') : 0), array('style="border:1px;" name="tblUserDetails[groupId]" class="updateGroupID"')); ?>
									<input type="hidden" value="<?php echo $value['id']; ?>" class="userID" />
								</div>
							</td> -->
							<td>
								<a href="<?php echo C::link('userEdit.php', array('edit' => $value['id']), true);?>" style="color:#fff;background:green;padding:5px;">EDIT</a>
								<a href="<?php echo C::link('users.php', array('delete' => $value['id']), true);?>"  style="color:#fff;background:#ff0000;padding:5px;">DELETE</a>
							</td>
						</tr>
						<?php
						}
					}
					?>
					</tbody>
				</table>
				<div id="result"></div>
		</div>
	</section>
</section>


<?php require_once('includes/doc_footer.php'); ?>