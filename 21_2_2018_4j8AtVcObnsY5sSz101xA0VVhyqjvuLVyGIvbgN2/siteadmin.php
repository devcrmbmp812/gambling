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

?>
<?php require_once('includes/doc_head.php'); ?>

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
			<form action="userSearch.php" action="GET" enctype="multipart/form-data">
				<input type="text" name="query" value="search" />
			</form>
			<a href="users.php"style="color:#fff;background:#ff0000;padding:5px;float:right;margin-bottom:10px;">Back to User</a>
			<table id="myTable" border="0" width="100">
				<thead>
					<tr>
						<th class="avatar">Nick Name</th>
						<th>Email</th>
						<th>User Id</th>
						<th>Site Name</th>
						<th>Password</th>
						<th>Date</th>
						<th>User Role</th>
						<!-- <th>change role</th> -->
						<th>Action</th>
					</tr>
				</thead>
					<tbody>
						<?php
							$result = $Base->query("SELECT `id`, `email`, `siteName`, `nickName`, `userId`, `password`, `updatedOn`, `groupId` FROM `tblUser` WHERE `groupId` = '2'");
							if(is_array($result) && count($result) > 0){
								foreach ($result as $key => $value) {
						?>
						<tr>
							<td class="avatar"><img src="images/user2.png" alt="" height="40" width="40" /> <?php echo $value['nickName']; ?></td>
							<td> <?php echo $value['email']; ?></td>
							<td> <?php echo $value['userId']; ?></td>
							<td> <?php echo $value['siteName']; ?></td>
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
		</div>
		<!-- <div align="center">
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
		</div> -->
	</section>
</section>


<?php require_once('includes/doc_footer.php'); ?>