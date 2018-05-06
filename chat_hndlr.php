<?php
require_once('config.php');	

// Load Classes
C::loadClass('User');
C::loadClass('Card');
C::loadClass('CMS');
C::loadClass('File');

$userDetails = array();

function getReceiverChats($userId, $receiverId, $limit = 50, $offset = 0){
	$array = array();
	$receiverChats = CHAT_DB . $userId . '/' . $receiverId . '/';
	$receiverMessages = File::getDirContents($receiverChats);
	krsort($receiverMessages);
	if(is_array($receiverMessages) && count($receiverMessages) > 0){
		foreach($receiverMessages as $index => $messageFile){
			$receiverChatFile = CHAT_DB . $userId . '/' . $receiverId . '/' . $messageFile;
			$content = false;
			if(File::exists($receiverChatFile, true)){
				if($content = File::getContent(ROOT . $receiverChatFile)){
					$content = json_decode($content, true);
				}
			}
			if(is_array($content) && count($content) > 0){
				krsort($content);
				$weekTime = strtotime('-6 day');
				$todayTime = strtotime('-1 day');
				foreach($content as $messageIndex => $messageDetails){
					// $array['chat'][$messageIndex] = $messageDetails;
					// $array['chat'][$messageIndex]['offset'] = $limit;
					// $array['date'] = $messageFile;
					if($todayTime < $messageIndex)
						$messageTime = 'Today ' . date(CHAT_DATE_FORMAT_T, $messageIndex);
					else if($weekTime < $messageIndex)
						$messageTime = 'Last ' . date(CHAT_DATE_FORMAT_S, $messageIndex);
					else
						$messageTime = date(CHAT_DATE_FORMAT, $messageIndex);

					if(!isset($messageDetails['_read']))
						$messageDetails['_read'] = 'N';
					if($messageDetails['_sender'] == User::loggedInUserId()){
						$userName = 'Me';
						$class = '';
						$class1 = 'left';
						$class2 = 'right';
						$img = 'user_1.jpg';
						$read = 'read';
						if($messageDetails['_read'] == 'N')
							$read = 'unread';
					} else {
						$userName = 'Admin';
						$class = 'right';
						$class1 = 'right';
						$class2 = 'left';
						$img = 'avatar1.png';
						$read = 'read';
						if($messageDetails['_read'] == 'N')
							$read = 'unread';
					}

					$array['chatsId'][] = '__message_' . $userId . '_' . $receiverId . '_' . $messageIndex;
					// $array['chats'][] = '<li class="' . $class . ' __message_' . $userId . '_' . $receiverId . '_' . $messageIndex . '" data-limit="' . $limit . '" data-index="' . $messageIndex . '" data-file="' . $messageFile . '">
					// 	<div class="col-xs-12">
					// 		<p class="page-header" style="margin:0px;padding:0px;">' . $userName . '	<span class="pull-right">' . $messageTime . '</span></p>
					// 		<p class="' . $class1 . '">' . $messageDetails['_message'] . '</p>
					// 	</div>
					// </li>';
					$array['chats'][] = '<div class="direct-chat-msg chat-msg-' . $read . ' ' . $class . ' __message_' . $userId . '_' . $receiverId . '_' . $messageIndex . '" data-limit="' . $limit . '" data-index="' . $messageIndex . '" data-file="' . $messageFile . '">
                            <div class="direct-chat-info clearfix">
                                <span class="direct-chat-name pull-' . $class1 . '">' . $userName . '</span>
                                <span class="direct-chat-timestamp pull-' . $class2 . '">' . $messageTime . '</span>
                            </div>
                            <img class="direct-chat-img" src="images/' . $img . '" alt="Message User Image"><!-- /.direct-chat-img -->
                            <div class="direct-chat-text">' . $messageDetails['_message'] . '</div>
                        </div>';

					$limit--;
					if($limit <= 0)
						return $array;
				}
			}
		}
	}
	return $array;
}

if(C::isPostBack($_POST)){
	$chatUser = $_POST['chatId'];
	$receiverId = $_POST['receiverId'];
	if((int)$chatUser > 0){
		$time = time();
		
		// File Name
		$fileName = date('Ymd', $time);

		// Receiver Content Set
		$receiverFile = CHAT_DB . $receiverId . '/' . $chatUser . '/';
		$content = false;
		if(File::exists($receiverFile . $fileName, true)){
			if($content = File::getContent(ROOT . $receiverFile . $fileName)){
				$content = json_decode($content, true);
			}
		}
		if(!$content)
			$content = array();

		$content[$time]['_s_time'] = $time;
		$content[$time]['_h_date'] = date('Y-m-d H:i:s', $time);
		$content[$time]['_message'] = trim($_POST['chatText']);
		$content[$time]['_sender'] = $chatUser;
		$content[$time]['_receiver'] = $receiverId;
		$content[$time]['_read'] = 'N';
		File::createDir($receiverFile);
		File::create(ROOT . $receiverFile . $fileName, json_encode($content));

		// Receiver Content Set
		$senderFile = CHAT_DB . $chatUser . '/' . $receiverId . '/';
		$content = false;
		if(File::exists($senderFile . $fileName, true)){
			if($content = File::getContent(ROOT . $senderFile . $fileName)){
				$content = json_decode($content, true);
			}
		}
		if(!$content)
			$content = array();

		$content[$time]['_s_time'] = $time;
		$content[$time]['_h_date'] = date('Y-m-d H:i:s', $time);
		$content[$time]['_message'] = trim($_POST['chatText']);
		$content[$time]['_sender'] = $chatUser;
		$content[$time]['_receiver'] = $receiverId;
		$content[$time]['_read'] = 'Y';
		File::createDir($senderFile);
		File::create(ROOT . $senderFile . $fileName, json_encode($content));
	}
}

if(isset($_GET['a']) && $_GET['a'] == 'READ' && isset($_GET['u']) && (int)$_GET['u'] > 0){
	$chatMessages = array();
	$chatMessages['chats'] = array();
	$chatUser = (int)$_GET['u'];
	$senderChats = CHAT_DB . $chatUser . '/';
	$receiverDirs = File::getDirContents($senderChats);
	if(is_array($receiverDirs) && count($receiverDirs) > 0){
		foreach($receiverDirs as $index => $receiverId){
			$messages = getReceiverChats($chatUser, $receiverId, 20, 0);
			krsort($messages['chats']);
			$chatMessages['chats']['___chatBoxBody_' . $chatUser . '_1']['chats'] = implode(chr(13), $messages['chats']);
			$chatMessages['chats']['___chatBoxBody_' . $chatUser . '_1']['chatid'] = '.' . implode(',.', $messages['chatsId']);
		}
	}
	$chatMessages['stage'] = '_G';
	echo json_encode($chatMessages);
}

