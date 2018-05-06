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

if(isset($_POST) && is_array($_POST) && count($_POST) > 0 ){
    if($Card->complaintContent($_POST)){
    	C::redirect(C::link('complaint-text.php', false, true));
    }
    //print_r($_POST)	;
}
$editValue = array(
	'id' => '',
	'categoryComplaintContent' => '',
	'categoryComplaint' => ''
);
if(isset($_GET['edit']) && trim($_GET['edit'])){
	$result = $User->query("SELECT `id`, `categoryComplaint`, `categoryComplaintContent` FROM `tblComplaintContent` WHERE `id` = '" . $_GET['edit'] . "' LIMIT 0, 1");
	if($result && is_array($result) && count($result) > 0){
		$editValue['id'] = $result[0]['id'];
		$editValue['categoryComplaint'] = $result[0]['categoryComplaint'];
		$editValue['categoryComplaintContent'] = $result[0]['categoryComplaintContent'];
	}
}
$activeNavigation = "complaint-text";
?>
<?php require_once('includes/doc_head.php'); ?>
<section class="content">
	<section class="widget">
		<header>
			<span class="icon">&#128196;</span>
			<hgroup>
				<h1>Complaint Data</h1>
				<h2>Put your complaint data here</h2>
			</hgroup>
		</header>
		<div class="content">
			<form action="" method="post" enctype="multipart/form-data">
				<div class="field-wrap">
					<select name="categoryComplaint">
						<option value="">--select--</option>
						<optgroup label="입금/출금">
					    	<option <?php if($editValue['categoryComplaint']=='입출금 지연'){echo 'selected';}?> value="입출금 지연">입출금 지연</option>
					    	<option <?php if($editValue['categoryComplaint']=='입출금 거절'){echo 'selected';}?> value="입출금 거절">입출금 거절</option>
					    	<option <?php if($editValue['categoryComplaint']=='추가입금 요구'){echo 'selected';}?> value="추가입금 요구">추가입금 요구</option>
						</optgroup>
						<optgroup label="보너스">
					    	<option <?php if($editValue['categoryComplaint']=='보너스 조건 위반'){echo 'selected';}?> value="보너스 조건 위반">보너스 조건 위반</option>
					    	<option <?php if($editValue['categoryComplaint']=='보너스 지불 거절'){echo 'selected';}?> value="보너스 지불 거절">보너스 지불 거절</option>
					    	<option <?php if($editValue['categoryComplaint']=='보너스 철회 거절'){echo 'selected';}?> value="보너스 지불 거절">보너스 철회 거절</option>
						</optgroup>
						<optgroup label="계정">
					    	<option <?php if($editValue['categoryComplaint']=='계정 잠금'){echo 'selected';}?> value="계정 잠금">계정 잠금</option>
					    	<option <?php if($editValue['categoryComplaint']=='사이트 규정 위반'){echo 'selected';}?> value="사이트 규정 위반">사이트 규정 위반</option>
						</optgroup>
						<optgroup label="기타">
					    	<option <?php if($editValue['categoryComplaint']=='기타'){echo 'selected';}?> value="기타">기타</option>
						</optgroup>
					</select>
				</div>
				<div class="field-wrap">
					<input type="hidden" name="id" value="<?php echo $editValue['id'];?>">
					<textarea id="editor" name="categoryComplaintContent" rows="10"><?php echo $editValue['categoryComplaintContent'];?></textarea>
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
						<th>Page Name</th>
						<th>Page Title</th>
						<th>Action</th>
					</tr>
				</thead>
					<tbody>
						<?php 
						$result = $User->query("SELECT `id`, `categoryComplaint` FROM `tblComplaintContent`");
						if(isset($result) && is_array($result) && count($result) > 0){
							foreach ($result as $key => $value) {
						?>
						<tr>
							<td><input type="checkbox" /> <?php echo $value['categoryComplaint'];?></td>
							<td>Admin</td>
							<td>
								<a href="<?php echo C::link('complaint-text.php', array('edit' => $value['id']), true);?>" style="color:#fff;background:green;padding:5px;">EDIT</a>
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