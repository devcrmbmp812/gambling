<?php

set_time_limit(0);
//error_reporting(E_ALL);
error_reporting(0);
ini_set('display_errors',TRUE);
date_default_timezone_set("Europe/London");
ob_start();
session_start();
/*g+ log in start*/
//Include Google client library 
include_once 'src/Google_Client.php';
include_once 'src/contrib/Google_Oauth2Service.php';

/*
 * Configuration and setup Google API
 */
$clientId = '848320628824-oh3tueju5dagsgcsb0gnnumb4s7keooa.apps.googleusercontent.com';
$clientSecret = '3vzqS2xiwKNclcj-d28pe1oZ';
$redirectUrl = 'http://dev.betting.com/googlesignup/';

//Call Google API
$gClient = new Google_Client();
//$gClient->setApplicationName('Login to CodexWorld.com');
$gClient->setClientId($clientId);
$gClient->setClientSecret($clientSecret);
$gClient->setRedirectUri($redirectUrl);

$google_oauthV2 = new Google_Oauth2Service($gClient);
/*g+ log in end*/
define('SESSION_ID', session_id());
define('TODAY', date('Ymd'));
define('SESSION_START_TIME', Date('Y-m-d H:i:s'));

# Host & Path Settings
// Local
//define('HOST', 'localhost');
//define('ROOT', '/var/www/html//your-project/');
//define('HOST', 'http://localhost/_gambling/your-project/');
//define('ROOT', 'E:/xampp/htdocs/_gambling/your-project/');
define('SEO', false);
// Web
// define('HOST', 'https://www.thebettingtime.com/');
// define('ROOT', '/home/thebettingtime/public_html/');

define('HOST', 'http://dev.betting.com/');
define('ROOT', 'E:/Client/Gambling/');

# Security & Encryption
define('SECURITY_SALT', '000102030405060708090a0b0c0d0e0f101112131415161718191a1b1c1d1e1f');

# DataBase Settings(local)
define('DB_MODE', 'MYSQLI');
define('DB_HOST', 'localhost');
// define('DB_USER', 'thebetti_new');
// define('DB_PASS', 'FSNp1%Fx^m75');
// define('DB_NAME', 'thebetti_new');

define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', 'thebetti_new');
//define('DB_NAME', 'newWareHouse');
//define('DB_NAME', 'dbManageBusiness_migration_test');//testing  packinglist

# Database Date format
define('DB_DATE_FORMAT', 'Y-m-d');
define('DB_TIME_FORMAT', 'H:i:s');
define('DB_DATE_TIME_FORMAT', DB_DATE_FORMAT . ' ' . DB_TIME_FORMAT);
define('DB_MONTH_FORMAT', 'm');
define('DB_PREFIX', '');

# User Display Date format
define('USER_DATE_FORMAT', 'd/m/Y');
define('USER_TIME_FORMAT', 'H:i:s');
define('USER_DATE_TIME_FORMAT', USER_DATE_FORMAT . ' ' . USER_TIME_FORMAT);

# Message Settings
define('ERR', 1);
define('WARN', 2);
define('INFO', 3);
define('SUCCS', 4);

# Templates Settings
define('TEMPLATES_PATH', 'templates/');
define('TEMPLATE', TEMPLATES_PATH . 'default/');
define('TEMPLATE_COMMON', TEMPLATE . 'common/');
define('USER_ASSET', 'user_asset/');

# Email Settings
define('FROM_EMAIL', 'ranjit@isuf.co.uk');
define('CC_EMAIL', 'ranjitdas@hotmail.com');
define('BCC_EMAIL', 'ranjitdas@hotmail.com');
define('REPLY_TO', FROM_EMAIL);
define('REPLY_TO_NO_REPLY', 'no-reply@isuf.co.uk');
define('SEND_APPROVAL_TO_USER', 'ranjitdas@hotmail.com');

# Email Templates Settings
define('EMAIL_TEMPLATES_PATH', TEMPLATES_PATH . 'emails/');

# Temp Path Settings
define('TEMP', '/tmp');

# Chat settings
define('CHAT_DB', '__CHAT_DB/');
define('CHAT_DATE_FORMAT', 'l, jS F Y - g:i a');
define('CHAT_DATE_FORMAT_S', 'l, g:i a');
define('CHAT_DATE_FORMAT_T', 'g:i a');

// # Cache Path Settings
// define('CACHE', 'cache/');
// define('USE_CACHE', false);
// define('USE_CACHE_AFTER', '2020-01-01 00:00:01');
// define('BOOSTER_CACHE', CACHE . 'boosterCache/');

# Class Path Settings
define('CLASSES', ROOT . 'classes/');

require_once(CLASSES . 'Base.class.php');
require_once(CLASSES . 'Common.class.php');

# Default File class load
require_once(CLASSES . 'File.class.php');

# Default Message class load
require_once(CLASSES . 'Message.class.php');


# Incudes Path Settings
define('INCLUDES', 'includes/');

# Libraries Path Settings
define('LIBS', 'libs/');

# Language Settings
define('LANGUAGE_PATH', 'language/');
define('LANGUAGE', LANGUAGE_PATH . 'main/');
define('LANGUAGE_COMMON', LANGUAGE_PATH . 'common/');
define('LANGUAGE_DEFAULT', 'en');

# Pagination Settings
define('PAGINATION_LIMIT', 10);

# User Settings
define('USERS_ASSETS', 'user_assets/');
define('REPORT_PATH', USERS_ASSETS . 'reports/');
define('PACKING_LIST_PATH', USERS_ASSETS . 'packing/');
define('PACKING_LIST_SETTINGS_PATH', PACKING_LIST_PATH . '.ht.settings/');
define('PACKING_GENERATED_PATH', PACKING_LIST_PATH . '.ht.packinglists/');

define('LABEL_LIST_PATH', USERS_ASSETS . 'packing/');
define('LABEL_LIST_SETTINGS_PATH', LABEL_LIST_PATH . '.ht.settings/');
define('LABEL_GENERATED_PATH', LABEL_LIST_PATH . '.ht.labels/');

// Output Minify controller
define('SANITIZE', false);

// Month Names
$__preSetMonthName = array(
	1 => '01,',
	2 => '02,',
	3 => '3월,',
	4 => '04,',
	5 => '05,',
	6 => '06,',
	7 => '07,',
	8 => '08,',
	9 => '09,',
	10 => '10,',
	11 => '11,',
	12 => '12,'
);

$__preSetWeekdayName = array(
	'MON' => 'Mon',
	'TUE' => 'Tue',
	'WED' => 'Wed',
	'THU' => 'Thu',
	'FRI' => 'Fri',
	'SAT' => 'Sat',
	'SUN' => 'Sun'
);

$__preSetShipping = array(
	'1' => 'Sea',
	'2' => 'Land/Road',
	'3' => 'Air'
);

$__preSetDateType = array(
	'D' => 'Day',
	'W' => 'Week',
	'M' => 'Month'
);

$__preSetShippingDLL = array(
	array('1', 'Sea'),
	array('2', 'Land/Road'),
	array('3', 'Air')
);


C::loadClass('User');
$User = new User();
if(C::isPostBack($_POST)){
	$_POST = C::valueFilter($_POST);
	if(!$User->checkLoginStatus()){
		if(isset($_POST['needLogin']) && $_POST['needLogin'] == 'YES'){
			C::setLogBackUrl('sportsDetail.php', $_GET, true);
			$postLoginLogBackUrl = C::getLogBackUrl();
			$_SESSION['postBack']['postLogin'] = $_POST;
			$_SESSION['postBack']['url'] = $postLoginLogBackUrl;
	    	Message::addMessage("To procedd you have to login first.", SUCCS);
			C::redirect('index.php');
		}
	}
}

if(isset($_SESSION['postBack']['postLogin']) && count($_SESSION['postBack']['postLogin']) > 0 && $User->checkLoginStatus() && !C::isCurrentPage($_SESSION['postBack']['url'])){
	C::redirect($_SESSION['postBack']['url']);
} else if(isset($_SESSION['postBack']['postLogin']) && count($_SESSION['postBack']['postLogin']) > 0 && $User->checkLoginStatus() && C::isCurrentPage($_SESSION['postBack']['url'])){
	$_POST = $_SESSION['postBack']['postLogin'];
	unset($_SESSION['postBack']['postLogin']);
	unset($_SESSION['postBack']['url']);
	unset($_SESSION['postBack']);
}