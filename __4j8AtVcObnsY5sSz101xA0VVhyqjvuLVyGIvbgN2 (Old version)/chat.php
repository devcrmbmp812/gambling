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

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>chat</title>
  <link href="css/chat.css" rel="stylesheet" type="text/css" />
</head>
<body>
		<div class="ui">
		<div class="left-menu" style="overflow-y:scroll;">
			<menu class="list-friends">
				<?php
					$userInfo =  $Base->query("SELECT `id`, `userId` FROM `tblUser` WHERE `id` != '1'");
					if(is_array($userInfo) && count($userInfo) > 0){
						foreach ($userInfo as $key => $value) {
				?>
				<li class="admin-chat-list">
					<img width="50" height="50" src="images/user2.png">
					<div class="info">
						<input type="hidden" class="__userId" value="<?php echo $value['id'];?>" />
						<input type="hidden" class="__class" value="___chatBoxBody_<?php echo User::loggedInUserId();?>_<?php echo $value['id'];?>" />
						<div class="user"><?php echo $value['userId'];?></div>
						<!--<div class="status on"></div>-->
					</div>
				</li>
				<?php
					}
				}
				?>
			</menu>
		</div>
		<div class="chat chatWindow">
			<div class="top">
				<div class="avatar" style="background-color:#ccc;">
					<img width="50" height="50" src="images/user2.png">
				</div>
				<div class="info">
					<div class="user"></div>
				</div>
				<!-- <i class="fa fa-star"></i> -->
			</div>
			<div class="chatBody" style="max-height:100%;">
			<ul class="messages ___chatBoxBody___ ___chatBoxBody_<?php echo User::loggedInUserId();?>_0" data-relclass="___chatBoxBody_<?php echo User::loggedInUserId();?>_0" data-scroll="1">
				<li class="i">
					<div class="head">
						<span class="time">10:13 AM, Today</span>
						<span class="name">dpi90</span>
					</div>
					<div class="message">Hiii</div>
				</li>
				<li class="friend-with-a-SVAGina">
					<div class="head">
						<span class="name">admin</span>
						<span class="time">10:15 AM, Today</span>
					</div>
					<div class="message">How can I help You?</div>
				</li>
			</ul>
			</div>
			<div class="write-form">
				<form action="" method="POST" class="myChatForm" enctype="multipart/form-data" id="myChatForm_1" name="myChatForm_1">
				<?php $logedInID = (int)User::loggedInUserId() > 0 ? User::loggedInUserId() : 0; ?>
				<input type="hidden" id="chatId" name="chatId" value="<?php echo $logedInID; ?>" />
				<input type="hidden" id="receiverId" name="receiverId" value="3" /> <!-- value Selected User Id -->
				<textarea placeholder="Type your message" name="chatText" id="chatText" class="chatText" rows="2"></textarea>
				<span class="send chatSend">Send</span>
				</form>
			</div>
		</div>
	</div>


<script src="../assets/js/jquery.min.js"></script>
<script src"js/chat.js"></script>
<script type="text/javascript">
	$.loadChat = function(cu){
		if(cu){
			$.getJSON('chat_hndlr.php?a=READ&u=' + cu, function(d){
				$.each(d.chats, function(i, v){
					var _O = $('.' + i + ':eq(0)');
					$(_O).find(v.chatid).remove();
					if(d.stage == '_G')
						$(v.chats).appendTo(_O);
					else
						$(v.chats).prepandTo(_O);
					$(_O).on('scroll', function() {
				        if($(this).scrollTop() + $(this).innerHeight() >= $(this)[0].scrollHeight) {
				            $(_O).data('scroll', 1);
				        } else {
				        	$(_O).data('scroll', 0);
				        }
				    });
				    if($(_O).data('scroll')){
				    	$(_O).animate({ scrollTop: $(_O).prop("scrollHeight")}, 0);
					}
					$('.chat-msg-unread').each(function(){
						if($(this).not(':visible')){
							//alert('Hi');
						}
					});
				});
				//$.loadChat(cu);
			});
		}
		return true;
	};
	$(document).ready(function(){
		// $('.list-friends > li').click(function(){
		// 	var __receiverId = $(this).find('.__userId').val();
		// 	$('#receiverId').val(__receiverId);
		// });
		// $(document).on('click', '.chatSend', function(){
		// 	var _FO = $(this).parents('.myChatForm:eq(0)');
		// 	$.post('chat_hndlr.php', $(_FO).serialize(), function(d){});
		// 	$(_FO).find('.chatText').val('');
		// 	var _O = $(this).parents('.chatBody:eq(0)').find('.___chatBoxBody___:eq(0)');
		// 	$(_O).data('scroll', 1);																																																																																																																																																																																																																				
		// 	return false;
		// });
		// $(document).on('keydown', '.chatText', function(event){
		// 	if(event.keyCode == 13){
		// 		$(this).parents('.myChatForm').find('.chatSend').click();
		// 		event.preventDefault();
		// 		return false;
		// 	}
		// 	return true;
		// });


		$('.chatSend').click(function(){
			var _FO = $(this).parents('.myChatForm:eq(0)');
			$.post('chat_hndlr.php', $(_FO).serialize(), function(d){});
			$(_FO).find('.chatText').val('');
			var _O = $(this).parents('.chatBody:eq(0)').find('.___chatBoxBody___:eq(0)');
			$(_O).data('scroll', 1);																																																																																																																																																																																																																				
			return false;
		});
		$('.chatText').keydown(function(event){
			if(event.keyCode == 13){
				$(this).parents('.myChatForm').find('.chatSend').click();
				event.preventDefault();
				return false;
			}
			return true;
		});

		$.loadChat('<?php echo 1;?>');

		$(document).on('click', '.admin-chat-list', function(){
			$(this).find()
		});

		$(document).on('click', '.admin-chat-list', function(){
			$('.chatWindow').find('.user:eq(0)').text($(this).find('.user:eq(0)').text());
			var __receiverId = $(this).find('.__userId:eq(0)').val();
			var _clss = $(this).find('.__class:eq(0)').val();
			var _CO = $('.chatBody').find('.___chatBoxBody___:eq(0)');
			var clss = $(_CO).data('relclass');
			$(_CO).removeClass(clss);
			$(_CO).addClass(_clss);
			$(_CO).data('relclass', _clss);
			$('.chatWindow').find('#receiverId').val(__receiverId);
			$(_CO).html('');
		});

		setInterval(function(){ $.loadChat('1'); }, 1000);
	});
</script>
</body>
</html>