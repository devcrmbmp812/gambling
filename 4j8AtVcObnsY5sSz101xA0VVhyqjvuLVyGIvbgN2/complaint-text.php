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
	//print_r($_POST);die();
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
	//echo "SELECT `id`, `categoryComplaint`, `categoryComplaintContent` FROM `tblComplaintContent` WHERE `id` = '" . $_GET['edit'] . "' LIMIT 0, 1";die();
	$result = $User->query("SELECT `id`, `categoryComplaint`, `categoryComplaintContent` FROM `tblComplaintContent` WHERE `id` = '" . $_GET['edit'] . "' LIMIT 0, 1");
	if($result && is_array($result) && count($result) > 0){
		$editValue['id'] = $result[0]['id'];
		$editValue['categoryComplaint'] = $result[0]['categoryComplaint'];
		$editValue['categoryComplaintContent'] = $result[0]['categoryComplaintContent'];
	}
}

if(isset($_GET['delete']) && trim($_GET['delete'])){
	$getId = $_GET['delete'];
	//$result = $User->query("SELECT `id`, `categoryComplaint`, `categoryComplaintContent` FROM `tblComplaintContent` WHERE `id` = '" . $_GET['edit'] . "' LIMIT 0, 1");
	$res = $User->query("DELETE FROM `tblComplaintContent` WHERE id = '" . $getId . "'");
	Message::addMessage("Content is deleted.", SUCCS);
}

$activeNavigation = "complaint-text";
?>
<?php require_once('includes/doc_head.php'); ?>
<section class="content">
	<section class="widget">
		<div class="panel panel-default bt-panel" style="box-shadow:none;">
			<div class="panel-heading">
				<span class="icon">&#128196;</span>
				<hgroup>
					<h5>Complaint</h5>
					<h6>Complaint User help text</h6>
				</hgroup>
				<button type="button" class="btn btn-primary pull-right" data-toggle="modal" data-target="#myModalconten"style="margin-top: 13px;">DROP BOX</button>
			</div>
			<div class="panel-body">
				<div class="content">
					<form action="" method="post" enctype="multipart/form-data">
						<div class="field-wrap">
							<select name="categoryComplaint">
								<option value="">--select--</option>
								<!--<optgroup label="입금/출금">
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
								</optgroup>-->
								<optgroup label="입금/출금">
									<option <?php if($editValue['categoryComplaint']=='입출금 지연'){echo 'selected';}?> value="입출금 지연">입출금 지연</option>
									<option <?php if($editValue['categoryComplaint']=='입출금 거절'){echo 'selected';}?> value="입출금 거절">입출금 거절</option>
									<option <?php if($editValue['categoryComplaint']=='추가입금 요구'){echo 'selected';}?> value="추가입금 요구">추가입금 요구</option>
								</optgroup>
								<optgroup label="보너스">
							    	<option <?php if($editValue['categoryComplaint']=='보너스 문제'){echo 'selected';}?> value="보너스 문제">보너스 문제</option>
									<!--<option value="보너스 지불 거절">보너스 지불 거절</option>
								    	<option value="보너스 지불 거절">보너스 철회 거절</option> -->
									</optgroup>
									<optgroup label="계정">
								    	<option <?php if($editValue['categoryComplaint']=='계정 잠금'){echo 'selected';}?> value="계정 잠금">계정 잠금</option>
							<!--		<option value="사이트 규정 위반">사이트 규정 위반</option> -->
									</optgroup>
									<optgroup label="배팅">
								    	<option <?php if($editValue['categoryComplaint']=='적중금액 지불 거절'){echo 'selected';}?> value="적중금액 지불 거절">적중금액 지불 거절</option>
								    	<option <?php if($editValue['categoryComplaint']=='양방배팅 관련'){echo 'selected';}?> value="양방배팅 관련">양방배팅 관련</option>
									</optgroup>
									<optgroup label="기타">
								    	<option <?php if($editValue['categoryComplaint']=='기타'){echo 'selected';}?> value="기타">기타</option>
									</optgroup>
							</select>
						</div>
						<div class="field-wrap">
							<input type="hidden" name="id" value="<?php echo $editValue['id'];?>">
							<textarea id="editor" name="categoryComplaintContent" rows="15"><?php echo $editValue['categoryComplaintContent'];?></textarea>
						</div><br />
						<button type="submit" class="btn btn-info">Post</button> <!-- <button type="submit" class="">Preview</button> -->
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
					<h5>Complaint Respons Page</h5>
					<h6>Add your text here</h6>
				</hgroup>
			</div>
			<div class="panel-body">
				<div class="content">
					<table id="myTable" class="table table-striped table-responsive" width="100%">
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
									<a href="<?php echo C::link('complaint-text.php', array('edit' => $value['id']), true);?>" class="btn btn-success btn-xs text-white"><i class="fa fa-edit"></i></a>
									<a href="<?php echo C::link('complaint-text.php', array('delete' => $value['id']), true);?>" class="btn btn-warning btn-xs text-white"><i class="fa fa-trash"></i></a>
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

<!-- Modal -->
<div id="myModalconten" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal">&times;</button>
			<h4 class="modal-title">Copy this code and edit as per your content</h4>
		</div>
		<div class="modal-body" style="overflow-x:scroll;">
			<xmp>
				<div class="panel-group" id="accordion">
					<div class="panel panel-default dynamic-panel">
						<div class="panel-heading">
							<h4 class="panel-title">
								<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapse1">
								Content title goes here</a>
							</h4>
						</div>
						<div id="collapse1" class="panel-collapse collapse in">
							<div class="panel-body">
								Content goes here
							</div>
						</div>
					</div>
					<div class="panel panel-default dynamic-panel">
						<div class="panel-heading">
						  <h4 class="panel-title">
							<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapse2">
							Content title goes here</a>
						  </h4>
						</div>
						<div id="collapse2" class="panel-collapse collapse">
							<div class="panel-body">
								Content goes here
							</div>
						</div>
					</div>
					<div class="panel panel-default dynamic-panel">
					<div class="panel-heading">
						<h4 class="panel-title">
							<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapse3">
						Content title goes here</a>
						</h4>
					</div>
					<div id="collapse3" class="panel-collapse collapse">
					  <div class="panel-body">
						Content goes here
					  </div>
					</div>
					</div>
				</div>
			</xmp>
		</div>
		<div class="modal-footer">
			<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
		</div>
    </div>

  </div>
</div>

<?php require_once('includes/doc_footer.php'); ?>