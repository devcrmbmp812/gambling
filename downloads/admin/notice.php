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

if(isset($_POST) && is_array($_POST) && count($_POST) > 0){
    if($Card->addNotice($_POST)){
    	C::redirect(C::link('notice.php', false, true));
    }	
}
if(isset($_GET['edit']) && trim($_GET['edit'])){
 	$reqID = explode("+", trim($_GET['edit']));
	if($reqID['1'] == 'pin'){
		$Base->query("UPDATE `tblNotice` SET `isPined` = 'Y' WHERE id = '" . $reqID['0'] . "'");
		C::redirect(C::link('notice.php', false, true));
	} else if($reqID['1'] == 'unpin') {
		$Base->query("UPDATE `tblNotice` SET `isPined` = 'N' WHERE id = '" . $reqID['0'] . "'");
		C::redirect(C::link('notice.php', false, true));
	}
}
if(isset($_GET['delete']) && trim($_GET['delete'])){
		$Base->query("DELETE FROM `tblNotice` WHERE id = '" . $_GET['delete'] . "'");
		C::redirect(C::link('notice.php', false, true));
}
?>

<?php require_once('includes/doc_head.php'); ?>

<!-- <section class="alert">
	<form method="link" action="page-new.html">
		 <button class="green">Create new Category</button>
	</form>
</section> -->
<section class="content">
	<section class="widget">
		<header>
			<span class="icon">&#128196;</span>
			<hgroup>
				<h1>Notice</h1>
				<h2>Add new notice here</h2>
			</hgroup>
		</header>
		<div class="content">
			<form action="" method="post" enctype="multipart/form-data">
				<div class="field-wrap">
					<input type="text" name="noticeTitle" value="" placeholder="Notice Title" />
				</div>
				<div class="field-wrap">
					<textarea name="noticeText" rows="5"></textarea>
				</div><br />
				<button type="submit" class="green">Post</button> <!-- <button type="submit" class="">Preview</button> -->
			</form>
		</div>
	</section>
</section>
<section class="content">
	<section class="widget">
		<header>
			<span class="icon">&#128196;</span>
			<hgroup>
				<h1>Category</h1>
				<h2>CMS content pages</h2>
			</hgroup>
		</header>
		<div class="content">
			<table id="myTable" border="0" width="100">
				<thead>
					<tr>
						<th>Title</th>
						<th>Description</th>
						<th>Author</th>
						<th>Date</th>
						<th>Action</th>
					</tr>
				</thead>
					<tbody>
					<?php
						$result = $User->query("SELECT `id`, `userId`, `noticeTitle`, `noticeText`, `isPined`, `updatedOn` FROM `tblNotice` ORDER BY `updatedOn` DESC");
						if(is_array($result) && count($result) > 0){
							foreach ($result as $key => $value) {			
						?>
						<tr>
							<td><?php echo $value['noticeTitle']; ?></td>
							<?php $noticeText = mb_strlen($value['noticeText'], 'UTF-8') > 150 ? substr($value['noticeText'],0,150)."..." : $value['noticeText'];?>
							<td><?php echo $noticeText; ?></td>
							<td>Admin</td>
							<td><?php echo $value['updatedOn']; ?></td>
							<td style="	white-space: nowrap;">
							<?php
								if($value['isPined'] == 'N'){
							?>
								<a href="<?php echo C::link('notice.php', array('edit' => $value['id'] . '+pin'), true);?>" style="color:#fff;background:green;padding:5px;">PIN</a>
							<?php } else {?>
								<a href="<?php echo C::link('notice.php', array('edit' => $value['id'] . '+unpin'), true);?>" style="color:#fff;background:Orange;padding:5px;">UNPIN</a>
							<?php } ?>
								<a href="<?php echo C::link('notice.php', array('delete' => $value['id']), true);?>" style="color:#fff;background:#ff0000;padding:5px;">DELETE</a>
							</td>
						</tr>
						<?php 
							}
						}
						?>
					</tbody>
				</table>
		</div>
		<!--<div align="center">
			<ul class="pagination">
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
		</div>-->
	</section>
</section>
<?php require_once('includes/doc_footer.php'); ?>