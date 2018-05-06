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
	// if($Card->delnews($_GET['delete'])){
		// C::redirect(C::link('blog-new.php', false, true));
	// }
	$id = $_GET['delete'];
	$Base->query("DELETE FROM `tblNewsBlog` WHERE id = '" . $id . "'");
	 C::redirect(C::link('blog-new.php', false, true));
}

?>
<?php require_once('includes/doc_head.php'); ?>

<section class="content">
	<section class="widget" style="min-height:300px">
		<div class="panel panel-default bt-panel" style="box-shadow:none;">
			<div class="panel-heading">
				<span class="icon">&#128196;</span>
				<hgroup>
					<h5>blog & News</h5>
					<h6>All uploaded files</h6>
				</hgroup>
			</div>
			<div class="panel-body">
				<div class="content">
					<form action="" method="post" enctype="multipart/form-data">
						<div class="field-wrap form-group">
							<input type="text" name="Title" placeholder="Title"/>
						</div>
						<div class="field-wrap form-group">
							<input type="text" name="Author" placeholder="Author"/>
						</div>
						<div class="field-wrap form-group">
							<input type="file" name="newsImage" placeholder=""/>
						</div>
						<div class="field-wrap form-group">
							<input type="text" name="newsImageName" placeholder="Image Name"/>
						</div>
						<div class="field-wrap form-group">
							<textarea name="newsDesc" id="editor" rows="15"></textarea>
						</div><br>
						<div class="field-wrap form-group">
							<select name="newsType	" id="newsType">
								<option>-- CHOOSE NEWS TYPE --</option>
								<option value="N">NEWS</option>
								<option value="B">BLOG</option>
							</select>
							<input type="hidden" value="" name="newsType" placeholder="News Type" />
						</div>
						<h2 style="margin-top:10px;font-size:14px;font-weight:800;">Add <span style="color:red;">META TAGS</span> for Search engine optimization</h2>
						<div class="field-wrap form-group form-relative">
							<input type="text" value="" name="metaTitle" placeholder="Meta Title" required  />
						</div>
						<div class="field-wrap form-group form-relative">
							<textarea name="metaDesc" id="" rows="4" placeholder="Meta Description" required ></textarea>
						</div>
						<div class="field-wrap form-group form-relative">
							<input type="text" value="" name="metaKeyword" placeholder="Meta Keyword" required  />
						</div>

						<button type="submit" class="btn btn-info">Post Blog</button>
					</form>
				</div>
			</div>
		</div>
	</section>
</section>
<section class="content">
	<section class="widget">
		<div class="panel panel-default bt-panel" style="box-shadow:none;">
			<div class="panel-heading">
				<span class="icon">&#128196;</span>
				<hgroup>
					<h5>Blog</h5>
					<h6>Blog Table</h6>
				</hgroup>
			</div>
			<div class="panel-body">
				<div class="content">
					<table id="myTable" class="table table-striped table-responsive" width="100%">
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
									<a href="<?php echo C::link('newsEdit.php', array('edit' => $value['id']), true);?>" class="btn btn-danger btn-xs text-white"><i class="fa fa-edit"></i></a>
									<a href="<?php echo C::link('blog-new.php', array('delete' => $value['id']), true);?>" class="btn btn-warning btn-xs text-white" onclick="return confirm('Are you sure?');"><i class="fa fa-trash"></i></a>
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