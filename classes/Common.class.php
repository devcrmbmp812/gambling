<?php
class Common {

	public static $MODE = false;
	public static $DISPLAY = false;

	public static function init(){
		self::loadLib('FileSystemCache/FileSystemCache');
		self::loadLib('Encryption/Encryption');
		self::loadLib('Pagination/Pagination');
		self::loadLib('Minify/Minify');

		FSC::$cacheDir = CACHE;
		FSC::$useCacheAfter = USE_CACHE_AFTER;
		FSC::$useCache = USE_CACHE;

		if(isset($_GET['a']) && strtoupper(trim($_GET['a'])) == 'REMOTE')
			self::$MODE = 'REMOTE';

		register_shutdown_function(function(){
			C::executionComplete();
		});
	}

	public static function sanitizeOutput($buffer){
		return self::minify($buffer);
	}

	public static function minify($buffer){
		return Minify::now($buffer);
	}

	public static function isCurrentPage($url){
		$nowPage = basename($_SERVER['SCRIPT_FILENAME']);
		$url = explode('?', $url);
		$requiredPage = basename($url[0]);
		if($requiredPage == $nowPage){
			return true;
		}
		return false;
	}

	public static function valueFilter($value){
		$convertCode = array(
			'\'' => '&#039;'
		);
		$array = array();
		if(is_array($value) && count($value) > 0){
			foreach($value as $key1 => $value1){
				$array[$key1] = self::valueFilter($value1);
			}
		} else if(is_string($value) && trim($value) != ''){
			return str_replace(array_keys($convertCode), array_values($convertCode), $value);
		}
		return $array;
	}

	public static function executionComplete(){
		// Take Action
		if(defined('SANITIZE') && SANITIZE && (!defined('NOT_SANITIZE') || !NOT_SANITIZE) && self::$MODE == 'VIEW' && self::$DISPLAY == 'VIEW')
			echo self::sanitizeOutput(ob_get_clean());
	}

	public static function getCurrentLanguage($returnType = false){
		if(!$returnType)
			return LANGUAGE_DEFAULT;
	}

	public static function setLogBackUrl($fileName = false, $callValue = false, $force = true){
		if(!self::getLogBackUrl() || $force){
			$fileName = ($fileName ? $fileName : basename($_SERVER['SCRIPT_FILENAME']));
			if($fileName != 'log_in.php' && self::$MODE != 'REMOTE'){
				$_SESSION['logBack'] = C::link($fileName, $callValue);
			} else if(self::$MODE == 'REMOTE' && (!isset($_GET['p']) || $_GET['p'] != 'delNoteData')){
				echo 'REQ_LOGIN'; die();
			}
			return true;
		}
		return false;
	}

	public static function getLogBackUrl(){
		if(isset($_SESSION['logBack'])){
			$logBackUrl = $_SESSION['logBack'];
			unset($_SESSION['logBack']);
			return $logBackUrl;
		}
		return false;
	}

	public static function isPostBack($array){
		if(isset($array) && is_array($array) && count($array) > 0){
			return true;
		}
		return false;
	}

	public function redirect($url){
		header("LOCATION: " . $url);
		die();
	}

    public static function checkAndGetValue($array, $key){
        if(isset($array[$key]) && trim($array[$key]) != ''){
            return trim($array[$key]);
        }
        return NULL;
    }

    public static function setFieldValue($valueSet, $ref){
        $value = false;
        if(isset($valueSet) && is_array($valueSet) && count($valueSet) > 0){
            $value = $valueSet;
            if(isset($ref) && trim($ref) != ''){
                $ref = explode('.', $ref);
                if(is_array($ref) && count($ref) > 0){
                    foreach($ref as $index => $set){
                        if(isset($value[$set])){
                            $value = $value[$set];
                        } else {
                            $value = false;
                        }
                    }
                }
            }
        }
        return $value;
    }

	public static function prepearDDL($array,$select, $options = array()){
		$return = array();
        $return[] = '<select ' . implode(' ', $options) . '>';
        $return[] = '<option value="">Please Select</option>';
		if(is_array($array) && count($array) > 0){
			foreach($array as $idx => $values){
				$return[] = '<option value="' . $values[0] . '"' . ($values[0] == $select ? ' selected="selected"' : '') . '>' . $values[1] . '</option>';
			}
		}
        $return[] = '</select>';
        return implode('', $return);
	}

    public static function prepearRadioGroup($array, $template, $replacer, $select, $attribute = array()){
        if(is_array($array) && count($array) > 0){
            foreach($array as $idx => $value){
                $radio = '<input type="radio" ' . (implode(' ', $attribute)) . ' value="' . $idx . '" ' . ($select == $idx ? ' checked="checked"' : '') . ' /> ' . L::__($value);
                $return[] = str_replace($replacer, $radio, $template);
            }
        }
        return implode(' ' . chr(13), $return);
    }

	public static function hexToStr($hex) {
		$str = '';
		for ($i = 0; $i < strlen($hex)-1; $i+= 2) {
			$str .= chr(hexdec($hex[$i].$hex[$i + 1]));
		}
		return $str;
	}

	public static function sendSMS($message, $no){
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, "http://bulksms.2way.co.za:5567/eapi/submission/send_sms/2/2.0?username=" . SMS_USER . "&password=" . SMS_PASS . "&message=" . urlencode($message) . "&msisdn=" . urlencode($no));
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_POST, true);
		curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 0);
		curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($smses));
		$output = curl_exec($ch);
		$info = curl_getinfo($ch);
		curl_close($ch);
	}

	public static function CURLget($url){
		$ch = curl_init($url);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $output = curl_exec($ch);
        curl_close($ch);
        return $output;
	}

	public static function prepareTemplate($templateUrl, $data){
		$return = false;
		if(file_exists($templateUrl) && is_file($templateUrl) && is_array($data) && count($data) > 0){
			$return = str_replace(array_keys($data), array_values($data), @file_get_contents($templateUrl));
		}
		if(($return == '' || !$return) && is_array($data) && count($data) > 0){
			$return = array();
			foreach($data as $key => $value){
				$return[] = $key . ': ' . $value;
			}
			$return = implode(chr(13), $return);
		}
		return $return;
	}

	public static function sendEmail($to, $subject, $message, $content = false, $fileName = false){
		self::loadLib('PHPMailer/PHPMailer');
		$PHPMailer = new PHPMailer;
		$PHPMailer->isHTML(true);
		$PHPMailer->addAddress($to, '');

		if(defined('REPLY_TO_NO_REPLY')){
			$PHPMailer->setFrom(REPLY_TO_NO_REPLY, 'WareHouse Application');
			$PHPMailer->addReplyTo(FROM_EMAIL, 'WareHouse Application');
		} else if(defined('REPLY_TO')) {
			$PHPMailer->setFrom(FROM_EMAIL, 'WareHouse Application');
			$PHPMailer->addReplyTo(REPLY_TO, 'WareHouse Application');
		}

		if(defined('CC_EMAIL'))
			$PHPMailer->addCC(CC_EMAIL, '');

		if(defined('BCC_EMAIL'))
			$PHPMailer->addBCC(BCC_EMAIL, '');

		$PHPMailer->Subject = $subject;
		$PHPMailer->Body = $message;
		if($content && $fileName){
			$PHPMailer->addStringAttachment($content, $fileName);
			$status = $PHPMailer->send();
		} else {
			$status = $PHPMailer->send();
		}
		if ($status) {
			Message::addMessage("Mail has been sent.", SUCCS);
		} else {
			Message::addMessage("Mail has not been sent!");
		}
		return $status;
	}

	public static function display($values = array(), $templateFile = false, $return = false, $block = false, $cache = true){
		if(!self::$MODE)
			self::$MODE = 'VIEW';
		self::$DISPLAY = 'VIEW';

		//if($block)
			//@ob_clean();
		// Init Savant template engine.
		$tpl = new Savant3();

		// Assign values to the Savant instance.
		if(is_array($values) && count($values) > 0){
			foreach($values as $index => $value){
				$tpl->{$index} = $value;
			}
		}

		if(!isset($tpl->message))
			$tpl->message = Message::getMessage();

		$showDebug = false;
		if(!$templateFile){
			$showDebug = true;
		}

		if(!$templateFile)
			$templateFile = TEMPLATE . str_replace(array(ROOT, '.php'), array('', '.tpl.php'), $_SERVER['SCRIPT_FILENAME']);
		else
			$templateFile = str_replace('.php', '.tpl.php', $templateFile);

		# Implement with Cache control
		$fscKey = FileSystemCache::generateCacheKey(array('session' => session_id(), 'values' => $values, 'get' => $_GET, 'post' => $_POST, 'templateFile' => $templateFile), 'temp/' . TODAY . '/view/html/' . C::getCurrentLanguage() . '/pages/template/' . SESSION_ID);	// Generate Cache Key
		$output = FileSystemCache::retrieve($fscKey);	// Retrieve Cached Data
		if(!$output || !$cache){
			$output = trim($tpl->getOutput($templateFile));
			FSC::store($fscKey, $output, 30);	// Cache (with TTL 30)
		}

		if($showDebug && DEBUG){
			D::addData(DEBUG_START_TIME, D::stop(), 'Total Program Execution Time', 'PROGRAM');
			$output.= '<pre>' . (DEBUG ? D::result() : '') . '</pre>';
		}


		// Display a template using the assigned values.
		if(!$return || $block){
            echo $output;
        } else {
            return $output;
        }

		if($block)
			exit();
	}

	public static function link($page, $array = false, $ignore = false, $host = false){
		if(isset($_GET) && is_array($_GET) && count($_GET) > 0 && is_array($array) && count($array) > 0 && !$ignore)
			$array = array_merge($_GET, $array);
		if($ignore && is_array($ignore) && count($ignore) > 0 && is_array($array) && count($array) > 0)
			$array = array_diff($array, $ignore);
		if(isset($_GET) && is_array($_GET) && count($_GET) > 0 && (!is_array($array) || count($array) <= 0) && !$ignore)
			$array = $_GET;
		if($ignore && is_bool($ignore) && is_array($array) && count($array) > 0)
			$array = $array;
		if($ignore && is_bool($ignore) && (!is_array($array) || count($array) <= 0))
			$array = array();
		if(SEO)
			return ($host ? HOST : '') . str_replace('.php', '', $page) . (is_array($array) && count($array) > 0 ? '/' . http_build_query($array, '', '/') : '');
		else
			return ($host ? HOST : '') . $page . (is_array($array) && count($array) > 0 ? '?' . http_build_query($array) : '');
	}

	public static function linkCallCheck($array){
		if(is_array($array) && count($array) > 0 && isset($_GET) && is_array($_GET) && count($_GET) > 0){
			foreach($array as $key => $value){
				if(!isset($_GET[$key]) || trim($_GET[$key]) != $value){
					return false;
				}
			}
			return true;
		}
		return false;
	}

    public static function gcd($a, $b) {
        $_a = abs($a);
        $_b = abs($b);

        while ($_b != 0) {

            $remainder = $_a % $_b;
            $_a = $_b;
            $_b = $remainder;
        }
        return $a;
    }

    public static function ratio($arg){
        $input = $arg;
        $c = count($arg);
		$var = array();
        if($c < 1){	 //no input
			$keys = array_keys($input);
			$var[] = 0;
		} else if($c == 1){	//only 1 input
			$keys = array_keys($input);
			$var[$keys[0]] = 1;
		} else {
			$keys = array_keys($input);
			$gcd = self::gcd($input[$keys[0]], $input[$keys[1]]); //find gcd of inputs
			for($i = 2; $i < $c; $i++)
				$gcd = self::gcd($gcd, $input[$keys[$i]]);
			$var[$keys[0]] = 0;
			if($gcd > 0)
				$var[$keys[0]] = $input[$keys[0]] / $gcd; //init output

			for($i = 1; $i < $c; $i++){
				$var[$keys[$i]] = 0;
				if($gcd > 0)
					$var[$keys[$i]] = ($input[$keys[$i]] / $gcd); //calc ratio
			}
		}
		return $var;
    }

    public static function dateFormat($format, $dateTime = false){
        if($dateTime)
            $dateTime = $dateTime;
        else
            $dateTime = date('Y-m-d H:i:s');
        return date($format, $dateTime);
    }

	private static function load($path, $data = false){
		if(File::exists(ROOT . $path, false)){
			require_once(ROOT . $path);
		} else {
			require_once($path);
		}
	}

	public static function loadClass($class){
		self::load(CLASSES . $class . '.class.php');
	}

	public static function loadLib($lib){
		self::load(LIBS . $lib . '.php');
	}

	public static function loadTemplate($template, $data = false){
		self::load($template . '.tpl.php', $data);
	}

	public static function uniqid(){
		return uniqid(time());
	}

	public static function UUID(){
		return self::uniqid();
	}

	public static function getTosterMessageSet($message){
		$array = false;
		if(is_array($message) && count($message) > 0){
			foreach($message as $messageType => $messages){
				switch((int)$messageType){
					case ERR:
						$array['toster']['error']['title'] = L::__('Error');
						$array['toster']['error']['message'] = implode(chr(13) . '<br />', $messages);
					break;
					case WARN:
						$array['toster']['warning']['title'] = L::__('Warning');
						$array['toster']['warning']['message'] = implode(chr(13) . '<br />', $messages);
					break;
					case INFO:
						$array['toster']['info']['title'] = L::__('Information');
						$array['toster']['info']['message'] = implode(chr(13) . '<br />', $messages);
					break;
					case SUCCS:
						$array['toster']['success']['title'] = L::__('Success');
						$array['toster']['success']['message'] = implode(chr(13) . '<br />', $messages);
					break;
				}
			}
		}
		return $array;
	}

	public static function printTosterMessage($message, $data = false){
        self::$MODE == 'TOSTER';
		$tosterMessage = self::getTosterMessageSet($message);
        if($data){
            $tosterMessage['data'] = $data;
        }
        @ob_clean();
        echo json_encode($tosterMessage);
		die();
	}

	public static function array_diff($array1, $array2) {
	    $ret = array();
	    foreach ($array1 as $k => $v) {
	        if (!isset($array2[$k])) $ret[$k] = $v;
	        else if (is_array($v) && is_array($array2[$k])) $ret[$k] = array_diff($v, $array2[$k]);
	        else if ((string)$v != (string)$array2[$k]) $ret[$k] = $v;
	    }
	    return $ret;
	}

	public static function contentMore($content, $maxLength, $moreLink, $html = false){
		if($html){

		} else {
			$content = strip_tags($content);
			$content = explode(' ', $content);
			$newContent = array();
			if(is_array($content) && count($content) > 0){
				$newContentLength = 0;
				foreach($content as $idx => $word){
					if($newContentLength < $maxLength){
						$newContentLength+= strlen($word) + 1;
						$newContent[] = $word;
					}
				}
				$newContent[] = chr(13) . '<br/><br/><br/><a href="' . $moreLink . '" class="readMore text-center">Read More</a>';
			}
			return implode(' ', $newContent);
		}
	}
	public static function contentMorewithoutlink($content, $maxLength, $html = false){
		if($html){

		} else {
			$content = strip_tags($content);
			$content = explode(' ', $content);
			$newContent = array();
			if(is_array($content) && count($content) > 0){
				$newContentLength = 0;
				foreach($content as $idx => $word){
					if($newContentLength < $maxLength){
						$newContentLength+= strlen($word) + 1;
						$newContent[] = $word;
					}
				}
				// $newContent[] = chr(13) . '<br/><br/><br/><a href="' . $moreLink . '" class="readMore">Read More</a>';
			}
			return implode(' ', $newContent);
		}
	}
}

class C extends Common{
	public function __contruct(){
		parent::__contruct();
	}

	public function __destruct(){
		parent::__destruct();
	}
}
