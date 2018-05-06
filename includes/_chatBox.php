<div class="chatboxContainer">
			<div class="chat">
				<div class="chatBox">
					<div class="chatBoxHeader">
						<div class="col-xs-6">
							<ul class="list-inline" style="margin-top: 6px; margin-bottom: 0px;">
							    <li><strong>CHAT</strong></li>
							</ul>
						</div>
						<div class="col-xs-6">
							<ul class="list-inline pull-right" style="margin-top: 3px; margin-bottom: 0px;">
							    <li><a href=""><i class="icon-user"></i></a></li>
							    <li id="showChatBox" style="cursor:pointer;"><i class="fa fa-plus-square-o minimize"></i></li>
							</ul>
						</div>
						
					</div><!-- chatBoxHeader -->
					<div class="chatContent">
						<div class="chatBoxBody ___chatBoxBody_<?php echo User::loggedInUserId();?>_1">
							<?php
							if(User::loggedInUserId() > 0){
							?>
							<ul class="nav chatContainer">
								
							</ul>
							<?php
							} else{
							?>
							<ul class="nav">
								<li class="other">
									<div class="col-xs-12">
										<p class="page-header" style="margin:0px;padding:0px;">Hello User!!</p>
										<p class="text-yellow">Chat support is available to assist you:</p>
										<p class="text-white">If, perhaps you see this page, our operators might be back in a minute, or you can submit the form below, and we'll get back to you very soon.</p>
									</div>
								</li>
								<li class="me">
									<div class="col-xs-12">
										<p class="page-header" style="margin:0px;padding:0px;">Admin</p>
										<p class="text-yellow">Please Login to Use our chat service</p>
									</div>
								</li>
							</ul>
							<?php } ?>
						</div><!-- chatBoxBody -->
						<div class="textBox">
							<form action="" method="POST" class="myChatForm" enctype="multipart/form-data" id="myChatForm_1" name="myChatForm_1">
								<div class="input-group">
									<?php $logedInID = (int)User::loggedInUserId() > 0 ? User::loggedInUserId() : 0; ?>
									<input type="hidden" name="chatId" value="<?php echo $logedInID; ?>" />
									<input type="hidden" name="receiverId" value="1" />
							      	<textarea class="inputChat chatText" name="chatText" id="chatText" cols="" style="width:100%;" rows="1" <?php if(!User::loggedInUserId() > 0){ echo " disabled"; }?>></textarea>
						        	<button class="btn btn-ask-red chatSend" type="submit" id="chatSend_1" style="margin-top: -54px; margin-left: 230px;">SEND</button>
							    </div><!-- /input-group -->
							</form>
						</div><!-- textBox -->
					</div><!-- chatContent -->
				</div><!-- chatBox -->
			</div>
			<div class="chat">
				<div class="chatBox">
					<div class="chatBoxHeader">
						<div class="col-xs-6">
							<ul class="list-inline" style="margin-top: 6px; margin-bottom: 0px;">
							    <li><strong>CHAT</strong></li>
							</ul>
						</div>
						<div class="col-xs-6">
							<ul class="list-inline pull-right" style="margin-top: 3px; margin-bottom: 0px;">
							    <li><a href=""><i class="icon-user"></i></a></li>
							    <li id="showChatBox" style="cursor:pointer;"><i class="fa fa-plus-square-o minimize"></i></li>
							</ul>
						</div>
						
					</div><!-- chatBoxHeader -->
					<div class="chatContent">
						<div class="chatBoxBody ___chatBoxBody_<?php echo User::loggedInUserId();?>_1">
							<?php
							if(User::loggedInUserId() > 0){
							?>
							<ul class="nav chatContainer">
								
							</ul>
							<?php
							} else{
							?>
							<ul class="nav">
								<li class="other">
									<div class="col-xs-12">
										<p class="page-header" style="margin:0px;padding:0px;">Hello User!!</p>
										<p class="text-yellow">Chat support is available to assist you:</p>
										<p class="text-white">If, perhaps you see this page, our operators might be back in a minute, or you can submit the form below, and we'll get back to you very soon.</p>
									</div>
								</li>
								<li class="me">
									<div class="col-xs-12">
										<p class="page-header" style="margin:0px;padding:0px;">Admin</p>
										<p class="text-yellow">Please Login to Use our chat service</p>
									</div>
								</li>
							</ul>
							<?php } ?>
						</div><!-- chatBoxBody -->
						<div class="textBox">
							<form action="" method="POST" class="myChatForm" enctype="multipart/form-data" id="myChatForm_1" name="myChatForm_1">
								<div class="input-group">
									<?php $logedInID = (int)User::loggedInUserId() > 0 ? User::loggedInUserId() : 0; ?>
									<input type="hidden" name="chatId" value="<?php echo $logedInID; ?>" />
									<input type="hidden" name="receiverId" value="1" />
							      	<textarea class="inputChat chatText" name="chatText" id="chatText" cols="" style="width:100%;" rows="1" <?php if(!User::loggedInUserId() > 0){ echo " disabled"; }?>></textarea>
						        	<button class="btn btn-ask-red chatSend" type="submit" id="chatSend_1" style="margin-top: -54px; margin-left: 230px;">SEND</button>
							    </div><!-- /input-group -->
							</form>
						</div><!-- textBox -->
					</div><!-- chatContent -->
				</div><!-- chatBox -->
			</div>
		</div>