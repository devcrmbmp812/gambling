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
	//print_r($_POST);
    if($Card->inserNewsBlog($_POST, $_FILES)){
    	C::redirect(C::link('blog-new.php', false, true));
    }	
}
if(isset($_GET['delete']) && trim($_GET['delete'])){
	if($Card->delnews($_GET['delete'])){
		C::redirect(C::link('blog-new.php', false, true));
	}
}

?>
<?php require_once('includes/doc_head.php'); ?>


<section class="content">
	<section class="widget" style="min-height:300px">
		<header>
			<span class="icon">&#59160;</span>
			<hgroup>
				<h1>Blog</h1>
				<h2>Create new blog page</h2>
			</hgroup>
			<aside>
				<span>
					<a href="#">&#9881;</a>
					<ul class="settings-dd">
						<li><label>Option a</label><input type="checkbox" /></li>
						<li><label>Option b</label><input type="checkbox" checked="checked" /></li>
						<li><label>Option c</label><input type="checkbox" /></li>
					</ul>
				</span>
			</aside>
		</header>
		<div class="content">
			<form action="" method="post" enctype="multipart/form-data">
				<div class="field-wrap">
					<input type="text" name="Title" placeholder="Title"/>
				</div>
				<div class="field-wrap">
					<input type="text" name="Author" placeholder="Author"/>
				</div>
				<div class="field-wrap">
					<input type="file" name="newsImage" placeholder=""/>
				</div>
				<div class="field-wrap">
					<input type="text" name="newsImageName" placeholder="Image Name"/>
				</div>
				<div class="field-wrap" style="width:70%;">
					<textarea name="newsDesc" id="editor" rows="20"></textarea>
				</div><br>
				<div class="field-wrap">
					<select name="newsType	" id="newsType">
						<option>-- CHOOSE NEWS TYPE --</option>
						<option value="N">NEWS</option>
						<option value="B">BLOG</option>
					</select>
					<input type="hidden" value="" name="newsType" placeholder="News Type" />
				</div>
				<button type="submit" class="green">Post</button>
			</form>
		</div>


		<div class="content">
			<table id="myTable" border="0" width="100">
				<thead>
					<tr>
						<th class="avatar">TITLE</th>
						<th>AUTHOR</th>
						<th>IMAGE</th>
						<th>TYPE</th>
						<th>Date</th>
						<th>Action</th>
					</tr>
				</thead>
					<tbody>
						<?php
						$result = $Base->query("SELECT `id`, `title`, `author`, `newsImage`, `isNews`, `updatedOn` FROM `tblNewsBlog` ORDER BY `updatedOn` DESC");
						if(is_array($result) && count($result) > 0){
							foreach ($result as $key => $value) {				
						?>
						<tr>
							<td class="avatar"> <?php echo $value['title']; ?></td>
							<td> <?php echo $value['author']; ?></td>
							<td> <img src="<?php echo $value['newsImage']; ?>" alt="" height="40" width="100" /></td>
							<td> <?php echo $value['isNews']; ?></td>
							<td> <?php echo $value['updatedOn']; ?></td>
							<td>
								<a href="<?php echo C::link('newsEdit.php', array('edit' => $value['id']), true);?>" style="color:#fff;background:green;padding:5px;">EDIT</a>
								<a href="<?php echo C::link('blog-new.php', array('delete' => $value['id']), true);?>"  style="color:#fff;background:#ff0000;padding:5px;">DELETE</a>
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