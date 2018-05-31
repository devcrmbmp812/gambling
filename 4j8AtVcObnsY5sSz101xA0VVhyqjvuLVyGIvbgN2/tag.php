<?php
require_once('../config.php');	

// Load Classes
C::loadClass('User');
C::loadClass('Forum');
C::loadClass('CMS');
//Init User class
$Base = new Base();
$User = new User();
$Forum = new Forum();
$Common = new Common();

if(!$User->checkLoginStatus()){
	$Common->redirect('index.php');
}

if(isset($_POST) && is_array($_POST) && count($_POST) > 0 && $_POST['formname'] == 'postform'){
	//print_r($_POST);
    if($Forum->addTags($_POST)){
    	C::redirect(C::link('tag.php', false, true));
    }	
}
if(isset($_POST) && is_array($_POST) && count($_POST) > 0 && $_POST['formname'] == 'editform' ){
	//print_r($_POST);
    if($Forum->updateTags($_POST)){
    	C::redirect(C::link('tag.php', false, true));
    }	
}

$editValue = array(
	'id' => '',
	'tagTitle' => '',
	'tagDescription' => '',
	'tagColor' => '',
	'isDispaly' => '',
	'formname' => ''
);

if(isset($_GET['edit']) && trim($_GET['edit'])){
	$edtTag = $Base->query("SELECT * FROM `tblTags` WHERE id = '" . $_GET['edit'] . "'");
	//C::redirect(C::link('tag.php', false, true));
	$editValue = array(
		'id' => $edtTag[0]['id'],
		'tagTitle' => $edtTag[0]['tagTitle'],
		'tagDescription' => $edtTag[0]['tagDescription'],
		'tagColor' => $edtTag[0]['tagColor'],
		'isDispaly' => $edtTag[0]['isDispaly'],
		'formname' => 'editform'
	);
}
if(isset($_GET['delete']) && trim($_GET['delete'])){
	$Base->query("DELETE FROM `tblTags` WHERE id = '" . $_GET['delete'] . "'");
	C::redirect(C::link('tag.php', false, true));
}

$activeNavigation = "tags";
?>



<?php require_once('includes/doc_head.php'); ?>


<section class="content">
	<section class="widget">
		<div class="panel panel-default bt-panel" style="box-shadow:none;">
			<div class="panel-heading">
				<span class="icon">&#128196;</span>
				<hgroup>
					<h5>Notice</h5>
					<h6>Add notice here</h6>
				</hgroup>
			</div>
			<div class="panel-body">
				<div class="content">
					<form action="" method="POST" enctype="multipart/form-data">
						<div class="field-wrap form-group">
							<input type="text" name="tagTitle" value="<?php echo $editValue['tagTitle']; ?>" placeholder="Tag Title" />
							<input type="hidden" name="id" value="<?php echo $editValue['id']; ?>" />
							<input type="hidden" name="formname" value="<?php echo $formname = ($editValue['formname'] == '') ? 'postform' : $editValue['formname']; ?>" />
						</div>
						<div class="field-wrap form-group">
							<input type="color" name="tagColor" value="<?php echo $editValue['tagColor']; ?>" placeholder="Tag Color" style="height:35px;" />
						</div>
						<div class="field-wrap form-group">
							<textarea name="tagDescription" rows="5"><?php echo $editValue['tagDescription']; ?></textarea>
						</div>
						<div class="field-wrap form-group">
							<select name="isDispaly" id="">
								<option value="">Select display option</option>
								<option <?php if(($editValue['isDispaly']) == 'Y'){ echo 'selected'; } ?> value="Y">Yes</option>
								<option <?php if(($editValue['isDispaly']) == 'N'){ echo 'selected'; } ?> value="N">No</option>
							</select>
						</div>
						<br />
						<button type="submit" class="btn btn-info">Post</button>
					</form>
				</div>
			</div>
		</div>
	</section>
</section>
<section class="content">
	<section class="widget">
		<div class="row">
			<?php 
			$result = $User->query("SELECT `id`, `tagTitle`, `tagColor`, `tagDescription`, `createdOn` FROM `tblTags`");
			foreach ($result as $tagKey => $tagValue) {
			?>

			<div class="col-md-4">
				<div class="panel panel-tags">
				  	<div class="panel-heading" style="background:<?php echo $tagValue['tagColor'];?>;"><?php echo $tagValue['tagTitle'];?><i class="fa fa-calendar pull-right" aria-hidden="true" title="Created on <?php echo $tagValue['createdOn'];?>"></i></div>
				  	<div class="panel-body" style="background-color:<?php echo $tagValue['tagColor'];?>;"><?php echo $tagValue['tagDescription'];?></div>
				  	<div class="panel-footer" style="background-color:<?php echo $tagValue['tagColor'];?>;">
				  		<a href="<?php echo C::link('tag.php', array('delete' => $tagValue['id']), true);?>" class="btn btn-xs btn-danger text-white pull-right">Delete</a>
				  		<a href="<?php echo C::link('tag.php', array('edit' => $tagValue['id']), true);?>" class="btn btn-xs btn-success text-white pull-right">Edit</a>
				  	</div>
				</div>
			</div>
			<?php
			}
			?>
		</div>
	</section>
</section>
<?php require_once('includes/doc_footer.php'); ?>