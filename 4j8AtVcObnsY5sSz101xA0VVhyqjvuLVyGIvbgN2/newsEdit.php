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


$editValue = array(
	'id' => '',
	'title' => '',
	'author' => '',
	'newsDesc' => '',
	'newsImage' => '',
	'newsImageName' => '',
	'isNews' => '',
	'metaTitle' => '',
	'metaDesc' => '',
	'metaKeyword' => ''
);

if(isset($_POST) && is_array($_POST) && count($_POST) > 0){
	//print_r($_POST);
	//print_r($_FILES);die();
    if($Card->updateNewsBlog($_POST, $_FILES)){
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
		<div class="panel panel-default bt-panel" style="box-shadow:none;">
			<div class="panel-heading">
				<span class="icon">&#128196;</span>
				<hgroup>
					<h5>Blog</h5>
					<h6>Blog Edit Page</h6>
				</hgroup>
			</div>
			<div class="panel-body">
				<div class="content">
					<form action="" method="post" enctype="multipart/form-data">
					<?php 
						if(isset($_GET['edit']) && trim($_GET['edit'])){
							$editID = $_GET['edit'];
							$result = $User->query("SELECT `id`, `title`, `author`, `newsDesc`, `newsImage`, `newsImageName`, `isNews`, `metaTitle`, `metaDesc`, `metaKeyword` FROM `tblNewsBlog` WHERE `id` = '" . $editID . "' LIMIT 0, 1");
							if($result && is_array($result) && count($result) > 0){
								$editValue['id'] = $result[0]['id'];
								$editValue['title'] = $result[0]['title'];
								$editValue['author'] = $result[0]['author'];
								$editValue['newsDesc'] = $result[0]['newsDesc'];
								$editValue['newsImage'] = $result[0]['newsImage'];
								$editValue['newsImageName'] = $result[0]['newsImageName'];
								$editValue['isNews'] = $result[0]['isNews'];
								$editValue['metaTitle'] = $result[0]['metaTitle'];
								$editValue['metaDesc'] = $result[0]['metaDesc'];
								$editValue['metaKeyword'] = $result[0]['metaKeyword'];
							}
					?>
						<div class="field-wrap form-group">
							<input type="text" value="<?php echo $editValue['title']; ?>" name="Title" placeholder="Title"/>
							<input type="hidden" value="<?php echo $editValue['id']; ?>" name="id" placeholder="id"/>
						</div>
						<div class="field-wrap form-group">
							<input type="text" value="<?php echo $editValue['author']; ?>" name="Author" placeholder="Author"/>
						</div>
						<div class="field-wrap form-group">
							<img src="<?php echo $editValue['newsImage']; ?>" style="width:100%;" />
						</div>
						<div class="field-wrap form-group">
							<input type="file" name="newsImage" placeholder=""/>
						</div>
						<div class="field-wrap form-group">
							<input type="text" value="<?php echo $editValue['newsImageName']; ?>" name="newsImageName" placeholder="Image Name"/>
						</div>
						<div class="field-wrap form-group">
							<textarea name="newsDesc" id="editor" rows="30"><?php echo $editValue['newsDesc']; ?></textarea>
						</div><br>
						<div class="field-wrap form-group">
							<select name="newsType" value="" id="newsType">
								<option>-- CHOOSE NEWS TYPE --</option>
								<option <?php if ($editValue['isNews'] == 'N' ) echo 'selected' ; ?> value="N">NEWS</option>
								<option <?php if ($editValue['isNews'] == 'B' ) echo 'selected' ; ?> value="B">BLOG</option>
							</select>
						</div>
						<h2 style="margin-top:10px;font-size:14px;font-weight:800;">Add <span style="color:red;">META TAGS</span> for Search engine optimization</h2>
						<div class="field-wrap form-group form-relative">
							<input type="text" value="<?php echo $editValue['metaTitle']; ?>" name="metaTitle" placeholder="Meta Title" required  />
						</div>
						<div class="field-wrap form-group form-relative">
							<textarea name="metaDesc" id="" rows="4" placeholder="Meta Description" required ><?php echo $editValue['metaDesc']; ?></textarea>
						</div>
						<div class="field-wrap form-group form-relative">
							<input type="text" value="<?php echo $editValue['metaKeyword']; ?>" name="metaKeyword" placeholder="Meta Keyword" required  />
						</div>
						<?php
						}
						?>
						<button type="submit" class="btn btn-info">Update Blog</button>
					</form>
				</div>
			</div>
		</div>
	</section>
</section>
<?php require_once('includes/doc_footer.php'); ?>