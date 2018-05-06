<?php
$msg = Message::getMessage();
if(isset($msg) && is_array($msg) && count($msg) > 0){
	 if(isset($msg) && is_array($msg) && count($msg) > 0){
	?>
	<div class="col-md-12 no-padding pl0" style="padding-left: 0px;">
	<?php if(isset($msg[ERR]) && is_array($msg[ERR]) && count($msg[ERR]) > 0){ ?>
		<div class="alert alert-danger alert-dismissable">
			<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
			<?php echo '<strong><i class="icon-diamond"></i> Error!</strong><ul><li>' . implode('<br /></li><li>', $msg[ERR]) . '</li></ul>';?>
		</div>
	<?php } ?>
	<?php if(isset($msg[WARN]) && is_array($msg[WARN]) && count($msg[WARN]) > 0){ ?>
		<div class="alert alert-warning alert-dismissable">
			<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
			<?php echo '<strong><i class="icon-diamond"></i> Warning!</strong><ul><li>' . implode('<br /></li><li>', $msg[WARN]) . '</li></ul>';?>
		</div>
	<?php } ?>
	<?php if(isset($msg[INFO]) && is_array($msg[INFO]) && count($msg[INFO]) > 0){ ?>
		<div class="alert alert-info alert-dismissable">
			<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
			<?php echo '<strong><i class="icon-diamond"></i> Information!</strong><ul><li>' . implode('<br /></li><li>', $msg[INFO]) . '</li></ul>';?>
		</div>
	<?php } ?>
	<?php if(isset($msg[SUCCS]) && is_array($msg[SUCCS]) && count($msg[SUCCS]) > 0){ ?>
		<div class="alert alert-success alert-dismissable">
			<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
			<?php echo '<strong><i class="icon-diamond"></i> Success!</strong><ul><li>' . implode('<br /></li><li>', $msg[SUCCS]) . '</li></ul>';?>
		</div>
	<?php } ?>
	</div>
	<?php }
}?>
