<?php
$msg = Message::getMessage();
if(isset($msg) && is_array($msg) && count($msg) > 0){
	 if(isset($msg) && is_array($msg) && count($msg) > 0){
	?>
	<!--<div class="col-md-12 no-padding pl0">-->
	<?php if(isset($msg[ERR]) && is_array($msg[ERR]) && count($msg[ERR]) > 0){ ?>
		<section class="alert">
			<div class="red">	
				<p><?php echo '<strong><i class="fa fa-diamond"></i> Error! &nbsp;</strong><span>' . implode('</span><span>', $msg[ERR]) . '</span>';?></p>
				<span class="close">&#10006;</span>
			</div>
		</section>
	<?php } ?>
	<?php if(isset($msg[WARN]) && is_array($msg[WARN]) && count($msg[WARN]) > 0){ ?>
		<section class="alert">
			<div class="orange">	
				<p><?php echo '<strong><i class="fa fa-diamond"></i> Warning! &nbsp;</strong><span>' . implode('</span><span>', $msg[WARN]) . '</span>';?></p>
				<span class="close">&#10006;</span>
			</div>
		</section>
	<?php } ?>
	<?php if(isset($msg[INFO]) && is_array($msg[INFO]) && count($msg[INFO]) > 0){ ?>
		<section class="alert">
			<div class="blue">	
				<p><?php echo '<strong><i class="fa fa-diamond"></i> Information! &nbsp;</strong><span>' . implode('</span><span>', $msg[INFO]) . '</span>';?></p>
				<span class="close">&#10006;</span>
			</div>
		</section>
	<?php } ?>
	<?php if(isset($msg[SUCCS]) && is_array($msg[SUCCS]) && count($msg[SUCCS]) > 0){ ?>
		<section class="alert">
			<div class="green">	
				<p><?php echo '<strong><i class="fa fa-diamond"></i> Success! &nbsp;</strong><span>' . implode('</span><span>', $msg[SUCCS]) . '</span>';?></p>
				<span class="close">&#10006;</span>
			</div>
		</section>
	<?php } ?>
	<!--</div>-->
	<?php }
}?>
