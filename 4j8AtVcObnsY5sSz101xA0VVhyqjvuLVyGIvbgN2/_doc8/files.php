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

if(isset($_POST) && is_array($_POST) && count($_POST) > 0){
    if($Card->insertSlider($_POST, $_FILES)){
    	C::redirect(C::link('files.php', false, true));
    }	
}
/* if(isset($_GET['delete']) && trim($_GET['delete'])){
	if($Card->delwebCard($_GET['delete'])){
		C::redirect(C::link('web-card.php', false, true));
	}
} */

?>
<?php require_once('includes/doc_head.php'); ?>

<section class="alert">
	<div class="green">	
		<p>Hi Lee, you have <a href="#">3 new pages</a> and <a href="#">16 comments</a> to approve, better get going!</p>
		<span class="close">&#10006;</span>
	</div>
</section>
<section class="content">
	<section class="widget">
		<header>
			<span class="icon">&#127748;</span>
			<hgroup>
				<h1>Media gallery</h1>
				<h2>All uploaded files</h2>
			</hgroup>
		</header>
		<div class="content">
			<form action="" method="post" enctype="multipart/form-data">
				<div class="field-wrap">
					<input type="text" name="sliderHeading" placeholder="Heading" />
				</div>
				<div class="field-wrap wysiwyg-wrap">
					<textarea class="post" name="sliderText" rows="5"></textarea>
				</div>
				<div class="field-wrap">
					<input type="file" name="sliderImage" placeholder="Place your Image" />
					<input type="text" name="sliderImageName" placeholder="Image name" />
					<input type="text" name="buttonOneName" placeholder="Button name" />
					<input type="text" name="buttonOneLink" placeholder="Button Link" />
				</div>
				<div class="field-wrap">
					<select name="buttonOneColor" id="buttonOneColor">
						<option>--CHOOSE BUTTON COLOR--</option>
						<option value="green">Green</option>
						<option value="red">Red</option>
					</select>
					<input type="hidden" name="buttonOneColor" value="" />
				</div>
				<br>
				<button type="submit" class="green">Post</button>
			</form>
		</div>
	</section>
</section>
<section class="content">
	<section class="widget">
		<header>
			<span class="icon">&#128196;</span>
			<hgroup>
				<h1>Pages</h1>
				<h2>CMS content pages</h2>
			</hgroup>
		</header>
		<div class="content">
			<table id="myTable" border="0" width="100">
				<thead>
					<tr>
						<th>Heading</th>
						<th>Text</th>
						<th>Image</th>
						<th>Image Name</th>
					</tr>
				</thead>
					<tbody>
					<?php
						$result = $Base->query("SELECT `id`, `sliderImage`, `sliderImageName`, `sliderHeading`, `sliderText` FROM `tblSlider`");
						if(is_array($result) && count($result) > 0){
							foreach ($result as $key => $value) {				
					?>
						<tr>
							<td><input type="checkbox" /> <?php echo $value['sliderHeading']; ?></td>
							<td><?php echo $value['sliderText']; ?></td>
							<td><img src="<?php echo $value['sliderImage']; ?>" style="width:100px;height:50px;" alt="" /></td>
							<td><?php echo $value['sliderImageName']; ?></td>
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