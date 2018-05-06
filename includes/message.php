<?php
$msg = Message::getMessage();
if(isset($msg) && is_array($msg) && count($msg) > 0){
	 if(isset($msg) && is_array($msg) && count($msg) > 0){
	?>
	<div class="col-md-12 no-padding pl0">
	<?php if(isset($msg[ERR]) && is_array($msg[ERR]) && count($msg[ERR]) > 0){ ?>
		<div class="alert alert-danger alert-dismissable">
			<button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>
			<?php echo '<strong><i class="icon-diamond"></i> 에러!</strong><ul><li>' . implode('<br /></li><li>', $msg[ERR]) . '</li></ul>';?>
		</div>
	<?php } ?>
	<?php if(isset($msg[WARN]) && is_array($msg[WARN]) && count($msg[WARN]) > 0){ ?>
		<div class="alert alert-warning alert-dismissable">
			<button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>
			<?php echo '<strong><i class="icon-diamond"></i> 경고!</strong><ul><li>' . implode('<br /></li><li>', $msg[WARN]) . '</li></ul>';?>
		</div>
	<?php } ?>
	<?php if(isset($msg[INFO]) && is_array($msg[INFO]) && count($msg[INFO]) > 0){ ?>
		<div class="alert alert-info alert-dismissable">
			<button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>
			<?php echo '<strong><i class="icon-diamond"></i> 정보!</strong><ul><li>' . implode('<br /></li><li>', $msg[INFO]) . '</li></ul>';?>
		</div>
	<?php } ?>
	<?php if(isset($msg[SUCCS]) && is_array($msg[SUCCS]) && count($msg[SUCCS]) > 0){ ?>
		<div class="alert alert-success alert-dismissable">
			<button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>
			<?php echo '<strong><i class="icon-diamond"></i> 성공!</strong><ul><li>' . implode('<br /></li><li>', $msg[SUCCS]) . '</li></ul>';?>
		</div>
	<?php } ?>
	</div>
	<?php }
}?>
