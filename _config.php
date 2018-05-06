<?php
// if (php_sapi_name() !== "cli"){
	// echo '// Not in cli-mode';
	// echo $output = shell_exec('php /var/www/html/warehouse/product.php');
	// die();
// }
set_time_limit(0);
error_reporting(E_ALL);
date_default_timezone_set("Europe/London");
ob_start();
session_start();
define('SESSION_ID', session_id());
define('TODAY', date('Ymd'));
define('SESSION_START_TIME', Date('Y-m-d H:i:s'));

# Host & Path Settings
// Local
define('HOST', 'http://localhost/bettingtime/');
define('ROOT', '/var/www/html/bettingtime/');
define('SEO', false);
// // Web
// define('HOST', 'http://test2live.com/bettingtime/');
// define('ROOT', '/home/weberyso/public_html/test2live.com/bettingtime/');

# Security & Encryption
define('SECURITY_SALT', '000102030405060708090a0b0c0d0e0f101112131415161718191a1b1c1d1e1f');

# DataBase Settings(local)
define('DB_MODE', 'PDO');
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', 'manager');
define('DB_NAME', 'db_test');

// # DataBase Settings(Web)
// define('DB_MODE', 'PDO');
// define('DB_HOST', 'localhost');
// define('DB_USER', 'weberyso_betting');
// define('DB_PASS', '}PnGd;Z}dX~=');
// define('DB_NAME', 'weberyso_bettingtime');

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
define('TEMP', 'temp/');

# Chat settings
define('CHAT_DB', '__CHAT_DB/');
define('CHAT_DATE_FORMAT', 'jS F, Y g:i a');
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
	1 => 'January',
	2 => 'February',
	3 => 'March',
	4 => 'April',
	5 => 'May',
	6 => 'June',
	7 => 'Jully',
	8 => 'August',
	9 => 'September',
	10 => 'October',
	11 => 'November',
	12 => 'December'
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

// C::loadClass('User');
// $User = new User();
// if(C::isPostBack($_POST)){
// 	$_POST = C::valueFilter($_POST);
// 	if(!$User->checkLoginStatus()){
// 		if(isset($_POST['needLogin']) && $_POST['needLogin'] == 'YES'){
// 			C::setLogBackUrl('sportsDetail.php', $_GET, true);
// 			$postLoginLogBackUrl = C::getLogBackUrl();
// 			$_SESSION['postBack']['postLogin'] = $_POST;
// 			$_SESSION['postBack']['url'] = $postLoginLogBackUrl;
// 	    	Message::addMessage("You are not logged in. Please login here to post your comment", ERR);
// 			//C::redirect('index.php');
// 		}
// 	}
// }

// if(isset($_SESSION['postBack']['postLogin']) && count($_SESSION['postBack']['postLogin']) > 0 && $User->checkLoginStatus() && !C::isCurrentPage($_SESSION['postBack']['url'])){
// 	C::redirect($_SESSION['postBack']['url']);
// } else if(isset($_SESSION['postBack']['postLogin']) && count($_SESSION['postBack']['postLogin']) > 0 && $User->checkLoginStatus() && C::isCurrentPage($_SESSION['postBack']['url'])){
// 	$_POST = $_SESSION['postBack']['postLogin'];
// 	unset($_SESSION['postBack']['postLogin']);
// 	unset($_SESSION['postBack']['url']);
// 	unset($_SESSION['postBack']);
// }