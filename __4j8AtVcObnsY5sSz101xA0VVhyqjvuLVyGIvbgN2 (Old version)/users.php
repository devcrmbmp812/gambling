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
			<a href="siteadmin.php"style="color:#fff;background:#ff0000;padding:5px;float:right;margin-bottom:10px;">List site admin</a>
			<table id="myTable" border="0" width="100">
				<thead>
					<tr>
						<th class="avatar">Nick Name</th>
						<th>Email</th>
						<th>User Id</th>
						<th>Password</th>
						<th>Date</th>
						<th>User Role</th>
						<th>Action</th>
					</tr>
				</thead>
					<tbody>
						<?php
						$result = $Base->query("SELECT * FROM `tblUser`");
						if(is_array($result) && count($result) > 0){
							foreach ($result as $key => $value) {	
							if($value['groupId'] == '0'){

							} else {			
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
							<td>
								<a href="<?php echo C::link('userEdit.php', array('edit' => $value['id']), true);?>" style="color:#fff;background:green;padding:5px;">EDIT</a>
								<a href="<?php echo C::link('users.php', array('delete' => $value['id']), true);?>"  style="color:#fff;background:#ff0000;padding:5px;">DELETE</a>
							</td>
						</tr>
						<?php
						} }
					}
					?>
					</tbody>
				</table>
		</div>
		<div align="center">
			<!-- <ul class="pagination1">
			  	<li><a href="#">«</a></li>
			 	<li><a href="#">1</a></li>
				<li><a class="active" href="#">2</a></li>
				<li><a href="#">3</a></li>
				<li><a href="#">4</a></li>
				<li><a href="#">5</a></li>
				<li><a href="#">6</a></li>
				<li><a href="#">7</a></li>
				<li><a href="#">»</a></li>
			</ul> -->
		</div>
	</section>

	<!-- <section class="">
		<table id="testTable" border="0" width="100">
				<thead>
					<tr>
						<th class="avatar">Nick Name</th>
						<th>Email</th>
						<th>User Id</th>
						<th>Password</th>
						<th>Date</th>
						<th>User Role</th>
						<th>Action</th>
					</tr>
				</thead>
					<tbody>
												<tr>
							<td class="avatar"><img src="images/user2.png" alt="" height="40" width="40" /> test123</td>
							<td> <a href="/cdn-cgi/l/email-protection" class="__cf_email__" data-cfemail="cdaca9a0a4a38daaa0aca4a1e3aea2a0">[email&#160;protected]</a></td>
							<td> vbb89</td>
							<td> test1234</td>
							<td> 2018-01-27 20:56:22</td>
							<td> 
								User							</td>
							<td>
								<a href="userEdit.php?edit=22" style="color:#fff;background:green;padding:5px;">EDIT</a>
								<a href="users.php?delete=22"  style="color:#fff;background:#ff0000;padding:5px;">DELETE</a>
							</td>
						</tr>
												<tr>
							<td class="avatar"><img src="images/user2.png" alt="" height="40" width="40" /> Bunny</td>
							<td> <a href="/cdn-cgi/l/email-protection" class="__cf_email__" data-cfemail="97f5e2f9f9eed7f0faf6fefbb9f4f8fa">[email&#160;protected]</a></td>
							<td> bunny89</td>
							<td> test123</td>
							<td> 2016-05-26 23:27:47</td>
							<td> 
								Site Admin							</td>
							<td>
								<a href="userEdit.php?edit=23" style="color:#fff;background:green;padding:5px;">EDIT</a>
								<a href="users.php?delete=23"  style="color:#fff;background:#ff0000;padding:5px;">DELETE</a>
							</td>
						</tr>
												<tr>
							<td class="avatar"><img src="images/user2.png" alt="" height="40" width="40" /> tommy</td>
							<td> <a href="/cdn-cgi/l/email-protection" class="__cf_email__" data-cfemail="f783928483b7959283839e999080968ed994989a">[email&#160;protected]</a></td>
							<td> tom67</td>
							<td> test123</td>
							<td> 2016-07-05 06:39:35</td>
							<td> 
								Site Admin							</td>
							<td>
								<a href="userEdit.php?edit=24" style="color:#fff;background:green;padding:5px;">EDIT</a>
								<a href="users.php?delete=24"  style="color:#fff;background:#ff0000;padding:5px;">DELETE</a>
							</td>
						</tr>
												<tr>
							<td class="avatar"><img src="images/user2.png" alt="" height="40" width="40" /> test123</td>
							<td> <a href="/cdn-cgi/l/email-protection" class="__cf_email__" data-cfemail="88e9e6e1b9bab8b0b9babbc8efe5e9e1e4a6ebe7e5">[email&#160;protected]</a></td>
							<td> test123</td>
							<td> test123</td>
							<td> 2017-02-25 06:48:35</td>
							<td> 
								User							</td>
							<td>
								<a href="userEdit.php?edit=28" style="color:#fff;background:green;padding:5px;">EDIT</a>
								<a href="users.php?delete=28"  style="color:#fff;background:#ff0000;padding:5px;">DELETE</a>
							</td>
						</tr>
												<tr>
							<td class="avatar"><img src="images/user2.png" alt="" height="40" width="40" /> test</td>
							<td> <a href="/cdn-cgi/l/email-protection" class="__cf_email__" data-cfemail="f8999691c9cab89f95999194d69b9795">[email&#160;protected]</a></td>
							<td> test</td>
							<td> test123</td>
							<td> 2017-02-25 08:30:19</td>
							<td> 
								User							</td>
							<td>
								<a href="userEdit.php?edit=29" style="color:#fff;background:green;padding:5px;">EDIT</a>
								<a href="users.php?delete=29"  style="color:#fff;background:#ff0000;padding:5px;">DELETE</a>
							</td>
						</tr>
												<tr>
							<td class="avatar"><img src="images/user2.png" alt="" height="40" width="40" /> anirban paul</td>
							<td> <a href="/cdn-cgi/l/email-protection" class="__cf_email__" data-cfemail="f3929d9a8191929dc5c4b3949e929a9fdd909c9e">[email&#160;protected]</a></td>
							<td> anirban67</td>
							<td> test123</td>
							<td> 2017-02-25 12:31:05</td>
							<td> 
								User							</td>
							<td>
								<a href="userEdit.php?edit=30" style="color:#fff;background:green;padding:5px;">EDIT</a>
								<a href="users.php?delete=30"  style="color:#fff;background:#ff0000;padding:5px;">DELETE</a>
							</td>
						</tr>
												<tr>
							<td class="avatar"><img src="images/user2.png" alt="" height="40" width="40" /> Anirban</td>
							<td> <a href="/cdn-cgi/l/email-protection" class="__cf_email__" data-cfemail="f99897908b9b9897d7908f98978e9c9bb99e94989095d79a9694">[email&#160;protected]</a></td>
							<td> anirban76</td>
							<td> test123</td>
							<td> 2017-02-26 20:54:30</td>
							<td> 
								User							</td>
							<td>
								<a href="userEdit.php?edit=31" style="color:#fff;background:green;padding:5px;">EDIT</a>
								<a href="users.php?delete=31"  style="color:#fff;background:#ff0000;padding:5px;">DELETE</a>
							</td>
						</tr>
												<tr>
							<td class="avatar"><img src="images/user2.png" alt="" height="40" width="40" /> kevin</td>
							<td> <a href="/cdn-cgi/l/email-protection" class="__cf_email__" data-cfemail="20534b444b584c574b44121260474d41494c0e434f4d">[email&#160;protected]</a></td>
							<td> test123</td>
							<td> sss12345</td>
							<td> 2017-02-28 04:14:19</td>
							<td> 
								User							</td>
							<td>
								<a href="userEdit.php?edit=32" style="color:#fff;background:green;padding:5px;">EDIT</a>
								<a href="users.php?delete=32"  style="color:#fff;background:#ff0000;padding:5px;">DELETE</a>
							</td>
						</tr>
												<tr>
							<td class="avatar"><img src="images/user2.png" alt="" height="40" width="40" /> ???</td>
							<td> <a href="/cdn-cgi/l/email-protection" class="__cf_email__" data-cfemail="0f687d6a6e68687f637a626d4f68626e6663216c6062">[email&#160;protected]</a></td>
							<td> sam123</td>
							<td> sss12345</td>
							<td> 2018-01-22 09:03:29</td>
							<td> 
								User							</td>
							<td>
								<a href="userEdit.php?edit=33" style="color:#fff;background:green;padding:5px;">EDIT</a>
								<a href="users.php?delete=33"  style="color:#fff;background:#ff0000;padding:5px;">DELETE</a>
							</td>
						</tr>
						<tr>
							<td class="avatar"><img src="images/user2.png" alt="" height="40" width="40" /> 안녕하세요</td>
							<td> <a href="/cdn-cgi/l/email-protection" class="__cf_email__" data-cfemail="aad8c5d9cbc3cfc4d8c5c4cecfcbdfeacdc7cbc3c684c9c5c7">[email&#160;protected]</a></td>
							<td> vip5555</td>
							<td> test1234</td>
							<td> 2018-02-01 19:30:30</td>
							<td> 
								User							
							</td>
							<td>
								<a href="userEdit.php?edit=34" style="color:#fff;background:green;padding:5px;">EDIT</a>
								<a href="users.php?delete=34"  style="color:#fff;background:#ff0000;padding:5px;">DELETE</a>
							</td>
						</tr>
					</tbody>
				</table>

	</section> -->
</section>


<?php require_once('includes/doc_footer.php'); ?>