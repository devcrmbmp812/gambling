<?php
class Message {
	
	const ERROR = ERR;
	const WARNING = WARN;
	const INFORMATION = INFO;
	const SUCCESS = SUCCS;
	
	public static function addMessage($message, $type = ERR){
		$_SESSION['message'][$type][] = $message;
	}
	
	public static function getMessage(){
		if(isset($_SESSION['message']) && is_array($_SESSION['message']) && count($_SESSION['message']) > 0){
			$message = $_SESSION['message'];
			$_SESSION['message'] = array();
			return $message;
		}
		return false;
	}
}