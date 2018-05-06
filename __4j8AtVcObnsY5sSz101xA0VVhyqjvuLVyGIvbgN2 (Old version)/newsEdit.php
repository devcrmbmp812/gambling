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
	'isNews' => ''
);

if(isset($_POST) && is_array($_POST) && count($_POST) > 0){
	//print_r($_POST);
    if($Card->updateNewsBlog($_POST)){
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
		</header>
		<div class="content">
			<form action="" method="post" enctype="multipart/form-data">
			<?php 
				if(isset($_GET['edit']) && trim($_GET['edit'])){
					$editID = $_GET['edit'];
					$result = $User->query("SELECT `id`, `title`, `author`, `newsDesc`, `newsImage`, `newsImageName`, `isNews` FROM `tblNewsBlog` WHERE `id` = '" . $editID . "' LIMIT 0, 1");
					if($result && is_array($result) && count($result) > 0){
						$editValue['id'] = $result[0]['id'];
						$editValue['title'] = $result[0]['title'];
						$editValue['author'] = $result[0]['author'];
						$editValue['newsDesc'] = $result[0]['newsDesc'];
						$editValue['newsImage'] = $result[0]['newsImage'];
						$editValue['newsImageName'] = $result[0]['newsImageName'];
						$editValue['isNews'] = $result[0]['isNews'];
					}
			?>
				<div class="field-wrap">
					<input type="text" value="<?php echo $editValue['title']; ?>" name="Title" placeholder="Title"/>
					<input type="hidden" value="<?php echo $editValue['id']; ?>" name="id" placeholder="id"/>
				</div>
				<div class="field-wrap">
					<input type="text" value="<?php echo $editValue['author']; ?>" name="Author" placeholder="Author"/>
				</div>
				<div class="field-wrap">
					<img src="<?php echo $editValue['newsImage']; ?>" style="width:80%;" />
				</div>
				<div class="field-wrap">
					<input type="text" value="<?php echo $editValue['newsImageName']; ?>" name="newsImageName" placeholder="Image Name"/>
				</div>
				<div class="field-wrap" style="width:70%;">
					<textarea name="newsDesc" id="editor" rows="30"><?php echo $editValue['newsDesc']; ?></textarea>
				</div><br>
				<div class="field-wrap">
					<select name="newsType" value="" id="newsType">
						<option>-- CHOOSE NEWS TYPE --</option>
						<option <?php if ($editValue['isNews'] == 'N' ) echo 'selected' ; ?> value="N">NEWS</option>
						<option <?php if ($editValue['isNews'] == 'B' ) echo 'selected' ; ?> value="B">BLOG</option>
					</select>
				</div>
				<?php
				}
				?>
				<button type="submit" class="green">Update</button>
			</form>
		</div>
	</section>
</section>
<?php require_once('includes/doc_footer.php'); ?>