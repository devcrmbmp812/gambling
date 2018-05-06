<?php
class Language extends Location {
	
	const LANGUAGE_PATH = LANGUAGE_PATH;
	const LANGUAGE = LANGUAGE;
	const LANGUAGE_COMMON = LANGUAGE_COMMON;
	const LANGUAGE_DEFAULT = LANGUAGE_DEFAULT;
	const LANGUAGE_DEAGULT_EXT = '.lang.ini';
	public static $language = self::LANGUAGE_DEFAULT;
	public static $fileName = false;
	public static $langCommonFile = false;
	public static $langMainFile = false;
	public static $_langCommonFile = false;
	public static $_langMainFile = false;
	public static $langCommonCache = false;
	public static $langMainCache = false;
	public static $_langCommonCache = false;
	public static $_langMainCache = false;
	
	public function __contruct(){
		parent::__contruct();
	}
	
	public static function setLanguage($lang){
		if($lang)
			self::$language = $lang;
	}
	
	public static function init(){
		self::$fileName = str_replace(array(ROOT, '.php'), array('', self::LANGUAGE_DEAGULT_EXT), $_SERVER['SCRIPT_FILENAME']);
		self::$langCommonFile = TEMPLATE . LANGUAGE_COMMON . self::$language . '/';
		self::$langMainFile = TEMPLATE . LANGUAGE . self::$language . '/';
		self::$_langCommonFile = LANGUAGE_COMMON . self::$language . '/';
		self::$_langMainFile = LANGUAGE . self::$language . '/';
		
		// Template Common Language Set
		if(file_exists(self::$langCommonFile . self::$language . self::LANGUAGE_DEAGULT_EXT) && is_file(self::$langCommonFile . self::$language . self::LANGUAGE_DEAGULT_EXT)){
			$file = self::$langCommonFile . self::$language . self::LANGUAGE_DEAGULT_EXT;
			self::$langCommonCache = parse_ini_file($file, false, INI_SCANNER_RAW);
		}
		
		// Template Page Language Set
		if(file_exists(self::$langMainFile . self::$fileName) && is_file(self::$langMainFile . self::$fileName)){
			$file = self::$langMainFile . self::$fileName;
			self::$langMainCache = parse_ini_file($file, false, INI_SCANNER_RAW);
		}
		
		// Default Common Language Set
		if(file_exists(self::$_langCommonFile . self::$language . self::LANGUAGE_DEAGULT_EXT) && is_file(self::$_langCommonFile . self::$language . self::LANGUAGE_DEAGULT_EXT)){
			$file = self::$_langCommonFile . self::$language . self::LANGUAGE_DEAGULT_EXT;
			self::$_langCommonCache = parse_ini_file($file, false, INI_SCANNER_RAW);
		}
		
		// Default Page Language Set
		if(file_exists(self::$_langMainFile . self::$fileName) && is_file(self::$_langMainFile . self::$fileName)){
			$file = self::$_langMainFile . self::$fileName;
			self::$_langMainCache = parse_ini_file($file, false, INI_SCANNER_RAW);
		}
	}
	
	// Direct Language Text Print
	public static function ___($text, $languageFileName = false, $languageFilePath = false){
		echo self::__($text, $languageFileName, $languageFilePath);
	}
	
	// Return Language Text
	public static function __($text, $languageFileName = false, $languageFilePath = false){
		// Check Custom Language ref settings
		$langCustomCache = false;
		if($languageFileName || $languageFilePath){
			if(!$languageFileName && $languageFilePath)
				$languageFileName = self::$fileName;
				
			if(file_exists($languageFilePath . $languageFileName) && is_file($languageFilePath . $languageFileName)){
				$langCustomCache = parse_ini_file($languageFilePath . $languageFileName, false, INI_SCANNER_RAW);
			} else if(file_exists(self::$langMainCache . $languageFileName) && is_file(self::$langMainCache . $languageFileName)){
				$langCustomCache = parse_ini_file($languageFilePath . $languageFileName, false, INI_SCANNER_RAW);
			} else if(file_exists(self::$langCommonCache . $languageFileName) && is_file(self::$langCommonCache . $languageFileName)){
				$langCustomCache = parse_ini_file(self::$langCommonCache . $languageFileName, false, INI_SCANNER_RAW);
			} else if(file_exists(self::$_langMainCache . $languageFileName) && is_file(self::$_langMainCache . $languageFileName)){
				$langCustomCache = parse_ini_file(self::$_langMainCache . $languageFileName, false, INI_SCANNER_RAW);
			} else if(file_exists(self::$_langCommonCache . $languageFileName) && is_file(self::$_langCommonCache . $languageFileName)){
				$langCustomCache = parse_ini_file(self::$_langCommonCache . $languageFileName, false, INI_SCANNER_RAW);
			}
			
			if(isset($langCustomCache) && is_array($langCustomCache) && count($langCustomCache) > 0 && isset($langCustomCache[$text]) && trim($langCustomCache[$text]) != ''){
				return trim($langCustomCache[$text]);
			}
		}
		
		//self::addToLanguage($text);
		
		// Check and Return If text Language found from Template Main Page File
		if(isset(self::$langMainCache) && is_array(self::$langMainCache) && count(self::$langMainCache) > 0 && isset(self::$langMainCache[$text]) && trim(self::$langMainCache[$text]) != ''){
			return trim(self::$langMainCache[$text]);
		}
		
		// Check and Return If text Language found from Template Common Page File
		if(isset(self::$langCommonCache) && is_array(self::$langCommonCache) && count(self::$langCommonCache) > 0 && isset(self::$langCommonCache[$text]) && trim(self::$langCommonCache[$text]) != ''){
			return trim(self::$langCommonCache[$text]);
		}
		
		// Check and Return If text Language found from Default Main Page File
		if(isset(self::$_langMainCache) && is_array(self::$_langMainCache) && count(self::$_langMainCache) > 0 && isset(self::$_langMainCache[$text]) && trim(self::$_langMainCache[$text]) != ''){
			return trim(self::$_langMainCache[$text]);
		}
		
		// Check and Return If text Language found from Default Common Page File
		if(isset(self::$_langCommonCache) && is_array(self::$_langCommonCache) && count(self::$_langCommonCache) > 0 && isset(self::$_langCommonCache[$text]) && trim(self::$_langCommonCache[$text]) != ''){
			return trim(self::$_langCommonCache[$text]);
		}
		
		// If any Language settings is not found then return the string
		return $text;
	}
	
	public static function addToLanguage($text){
		$LANG = 'en';
		$TOLANG = 'en';
		
		C::loadLib('INIParser/INIParser');
		
		$langFile = CACHE . 'language/' . $TOLANG . '/' . self::$fileName;
		$INIParser = new INIParser($langFile);
		
		$languageList = array();
		$languageList = $INIParser->readFile($langFile);
		
		if(!isset($languageList[$text])){
			$INIParser->set($text, $text);
		}
		$INIParser->save($langFile);
	}
	
	public function __destruct(){
		parent::__destruct();
	}
}

class L extends Language{
	public function __contruct(){
		parent::__contruct();
	}
	
	public function __destruct(){
		parent::__destruct();
	}
}