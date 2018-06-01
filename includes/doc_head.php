<?php
require_once('config.php');	

// Load Classes
C::loadClass('User');
C::loadClass('Card');
C::loadClass('CMS');
//Init User class
$User = new User();
$Card = new Card();


/*
*G+ log in start
*/

if(isset($_GET['code'])){
    $gClient->authenticate($_GET['code']);
    $_SESSION['token'] = $gClient->getAccessToken();
}

if (isset($_SESSION['token'])) {
    $gClient->setAccessToken($_SESSION['token']);
}

$authUrl = $gClient->createAuthUrl();
$output_signup = '<a href="'.filter_var($authUrl, FILTER_SANITIZE_URL).'" class="btn btn-google w-100"><i class="fa fa-google-plus-square fa-2x pull-left" aria-hidden="true"></i>구글로 가입 신청하기</a>';
$output_signin = '<a href="'.filter_var($authUrl, FILTER_SANITIZE_URL).'" class="btn btn-google w-100"><i class="fa fa-google-plus-square fa-2x pull-left" aria-hidden="true"></i>구글로 로그인하기</a>';

if ($gClient->getAccessToken()) {
	
	//Get user profile data from google
	$gpUserProfile = $google_oauthV2->userinfo->get();

	$email = $gpUserProfile['email'];
	$split_email = explode("@",$email);
	    	    
    $gpUserData = array(
        'oauth_provider'=> 'google',
        'oauth_uid'     => $gpUserProfile['id'],
        'email'         => $gpUserProfile['email'],
        'userId'		=> $split_email[0],
        'nickName'		=> $_POST['nickName']
    );
	$usercheck = $User->existUser($gpUserProfile['email']);

	if(isset($_GET['code']) && $usercheck ){
		$userData = $User->checkUser($gpUserData,'signin');	
		if($userData){
			C::redirect(HOST);	
		}
	}
	else if($_POST['nickName'] && !$usercheck)
	{
		$userData = $User->checkUser($gpUserData,'signup');	
    	if ($userData) {
    		C::redirect(HOST);		
    	}
	}
}
/*
G+ log in end
*/
if(isset($_GET['logout']) && trim($_GET['logout']) == 'logout'){
	$gClient->revokeToken();
	unset($_SESSION['token']);
	unset($_SESSION['userData']);
  	$User->logout();

   	C::redirect('home/');
}

if(isset($_POST) && is_array($_POST) && count($_POST) > 0 && isset($_POST['__FORM']) && $_POST['__FORM'] == '_LOGIN_'){
	if($User->login($_POST)){
		//$Common->redirect('index.php');
    //Message::addMessage("successfull.", SUCCS);
	}
} else if(C::isPostBack($_POST) && isset($_POST['__FORM']) && $_POST['__FORM'] == '_PASSWORD_'){
    if($User->forgetPassword($_POST)){
		C::redirect('home/');
	}
} else if(isset($_POST) && is_array($_POST) && count($_POST) > 0 && isset($_POST['__FORM']) && $_POST['__FORM'] == '_SIGNUP_'){
	if($User->userSignUp($_POST)){
    Message::addMessage("successfull.", SUCCS);
	}
}

if($page == ''){
	$page = array();
	$page[0]['metaTitle'] = $metaTitle;
	$page[0]['metaKeyword'] = $metaKeyword;
	$page[0]['metaDesc'] = $metaDesc;
}else{
	$page = $User->query("SELECT `metaTitle`, `metaDesc`, `metaKeyword` FROM `tblContent` WHERE `categoryPage` = '" . $page . "' LIMIT 0,1");
}

$sportsExtraText = array(
	'61' => '[ 라이브 소액유저 추천 ]', 
	'62' => '[ 라이브 고액유저 추천 ]', 
	'64' => '[ 스포츠 단폴고액 추천 ]', 
	'65' => '[ 미니게임 고액유저 추천 ]', 
	'66' => '[ 축구 승옵배팅 가능 ]' 
);


?>
<!DOCTYPE html>
<html lang="ko">
<head>
<meta name="google-site-verification" content="-m0E-E1_LXoRB39XrC_tq36BfxhG6DVNn464_kIBqK0" />
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta http-equiv='Content-Type' content='text/html; charset=utf-8'>
<meta name="viewport" content="width=device-width, initial-scale=1">
<title><?php echo $page[0]['metaTitle']; ?></title>
<meta name="keywords" content="<?php echo $page[0]['metaKeyword']; ?>">
<meta name="description" content="<?php echo $page[0]['metaDesc']; ?>">
<!-- Bootstrap & Fontawesome -->
<link rel="icon" href="<?php echo HOST;?>images/favicon.png" />
<link href="<?php echo HOST;?>assets/css/bootstrap.css" rel="stylesheet">
<link href="<?php echo HOST;?>assets/css/font-awesome.min.css" rel="stylesheet">
<link href="<?php echo HOST;?>assets/css/owl.carousel.css" rel="stylesheet">
<link href="<?php echo HOST;?>assets/css/owl.theme.css" rel="stylesheet">

<!-- Start custom CSS (Your own theme, overrides all of the above styles) -->
<link href="<?php echo HOST;?>assets/css/style.css" rel="stylesheet">
<link href="<?php echo HOST;?>assets/css/custom.css" rel="stylesheet">
<link href="<?php echo HOST;?>assets/css/forum.css" rel="stylesheet">
<link href="<?php echo HOST;?>assets/css/chosen.css" rel="stylesheet">
<link href="<?php echo HOST;?>assets/css/hover.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.3.5/jquery.fancybox.min.css">
<link href="<?php echo HOST;?>assets/css/notosanskr.css" rel="stylesheet">
<link href="<?php echo HOST;?>assets/css/ripple.css" rel="stylesheet">
<link href="<?php echo HOST;?>assets/css/responsive.css" rel="stylesheet">
<link href="<?php echo HOST;?>assets/css/animate.css" rel="stylesheet">
<link href="<?php echo HOST;?>assets/css/editor-text.css" rel="stylesheet">
<!-- <link href="<?php echo HOST;?>lib/fancybox/jquery.fancybox.css" rel="stylesheet"> -->
<link rel="stylesheet" href="<?php echo HOST;?>assets/css/jquery.rateyo.min.css"/>
<link rel="stylesheet" href="<?php echo HOST;?>assets/css/lightbox.min.css">
<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i,800,800i" rel="stylesheet">
<!--<link href="https://fonts.googleapis.com/css?family=Roboto:300,300i,400,400i,500,500i,700,700i,900" rel="stylesheet">-->
<!-- End Custom CSS -->

<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

<base href="<?php echo HOST;?>" />
<style type="text/css">
.card-tag-private{
	position: absolute;
	top: 0;
	left: 0;
	padding: 7px 50px 5px 10px;
	font-weight: 900;
	color:#fff;
	background: -moz-linear-gradient(left, rgba(104,224,44,1) 0%, rgba(255,255,255,0) 100%); /* FF3.6-15 */
	background: -webkit-linear-gradient(left, rgba(104,224,44,1) 0%,rgba(255,255,255,0) 100%); /* Chrome10-25,Safari5.1-6 */
	background: linear-gradient(to right, rgba(104,224,44,1) 0%,rgba(255,255,255,0) 100%); /* W3C, IE10+, FF16+, Chrome26+, Opera12+, Safari7+ */
	filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#68e02c', endColorstr='#00ffffff',GradientType=0 ); /* IE6-9 */
}
</style>
</head>
<body>
	<div class="main" id="main">
		<div class="container parent-container">
			<div class="ask-notice visible-lg visible-md">
				<div class="col-md-8">
					<div class="col-md-1 col-sm-1 col-xs-2 ask-notice-icon">
						<span class="glyphicon glyphicon-bullhorn"></span>
					</div>
					<div class="col-md-11 col-sm-12 col-xs-10 ask-notice-text">
						<div id="myCarousel1" class="carousel slide" data-ride="carousel">
						  	<!-- Wrapper for slides -->
							<div class="carousel-inner" role="listbox">
							<?php
							$result = $User->query("SELECT `id`, `noticeTitle` FROM `tblNotice` WHERE `isPined` = 'Y'");
							$counter = 1;
							if(is_array($result) && count($result) > 0){
							foreach ($result as $key => $value) {
								$notice = str_replace(' ', '_', $value['noticeTitle']);
							?>	
								<div class="item <?php if($counter <= 1){echo " active"; } ?> text-yellow" style="font-size:12px;"><a href="notice-details/<?php echo $value['id'];?>/" class="text-yellow"><?php echo $value['noticeTitle']; ?></a></div>
								<?php
								$counter++;
									}
								}
								?>
							</div>
						</div>
					</div>
				</div>
				<div class="col-md-4 col">
					<ul class="nav navbar-nav navbar-right ask-social" style="margin-right:0px;">
						<li class=""><a href="#" class="hvr-shutter-in-vertical-chat nav-chat" data-backdrop="false" data-toggle="modal" data-target="#modalSocial" data-header="chat" data-content="카카오톡 : gggyyy12"><b><i class="fa fa-comments-o"></i></b></a></li>
						<li class=""><a href="#" class="hvr-shutter-in-vertical-twitter" data-backdrop="false" data-toggle="modal" data-target="#modalSocial" data-header="twitter" data-content="twit"><b><i class="fa fa-twitter"></i></b></a></li>
						<li class=""><a href="#" class="hvr-shutter-in-vertical-facebook" data-backdrop="false" data-toggle="modal" data-target="#modalSocial" data-header="facebook" data-content="facebook"><b><i class="fa fa-facebook"></i></b></a></li>
						<li class=""><a href="#" class="hvr-shutter-in-vertical-google" data-backdrop="false" data-toggle="modal" data-target="#modalSocial" data-header="google" data-content="google"><b><i class="fa fa-google-plus"></i></b></a></li>

					</ul>		
				</div>
			</div><!-- ask-notice -->




			 <div class="container pl0" style="padding-left: 0px;"><?php require_once(INCLUDES . "message.php");?></div>




			<div class="clearfix"></div>
			<div class="first-nav visible-lg visible-md" id="first-nav">
				<nav class="navbar navbar-default ask-nav-one">
					<div class="">
						<!-- Brand and toggle get grouped for better mobile display -->
						<div class="navbar-header">
						  <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-2" aria-expanded="false">
							<span class="sr-only">Toggle navigation</span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
						  </button>
						  <a class="navbar-brand" href="home/"><img src="images/logo-logo.png" class=""  style="margin-top: -25px;" /></a>
						 <!--  <a class="navbar-brand" href="#"><img src="images/betting_logo.png" class="" /></a> -->
						</div>

						<!-- Collect the nav links, forms, and other content for toggling -->
						<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-2">
							<ul class="nav navbar-nav navbar-right">
								<?php
								if(User::loggedInUserId() > 0){
								?>
								<li class="" style="position:relative;"><a href="site-admin-notification.php" class="text-white font24 dropdown-toggle"><i class="fa fa-bell shadow_1 text-white" aria-hidden="true"></i></a>
								<span class="notificationCount"></span></li>
								<li class="dropdown pull-right">
									<?php
									$logedInID = (int)User::loggedInUserId() > 0 ? User::loggedInUserId() : 0;
									$userid = $User->query("SELECT `userId`, `groupId`, `siteName` FROM `tblUser` WHERE `id` = '" . $logedInID . "' LIMIT 0,1");
									if(isset($userid)){
								 	?>
								  <a href="#" class="text-white font24 dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><span class="glyphicon glyphicon-user m-r-10 shadow_1"></span><span class="caret"></span></a>
								  <input type="hidden" id="notification-login-id" value="<?php echo $logedInID;?>" />
								  <input type="hidden" id="" value="<?php echo $userid[0]['groupId'];?>" />
								  <input type="hidden" id="notification-site-name" value="<?php echo $userid[0]['siteName'];?>" />
									<?php	} ?>
									<ul class="dropdown-menu ask-list ask-list-caret">
										<?php 
										if($userid[0]['groupId'] == 2){
											$siteAdminLogin = $_SESSION['siteAdminLogin'] = true;
										?>
										<li><a href="site-comments.php">사이트 후기</a></li>
										<li><a href="siteComplaints.php">사이트 분쟁</a></li>
										<?php
										}else if($userid[0]['groupId'] == 3){
											$siteUserLogin = $_SESSION['siteUserLogin'] = true;	
										}
										?>
										<li><a href="editProfile.php">마이 페이지</a></li>
										<li><a href="index.php?logout=logout">로그아웃</a></li>
									</ul>
								</li>
								<?php
								}else{
								?>
								<li class=""><a href="#" class="btn btn-ask-black hvr-shadows" data-backdrop="true" data-toggle="modal" data-target="#myModal" id="signIn">로그인</a></li>
								<li class=""><a href="#" class="btn btn-ask-black hvr-shadows" data-backdrop="true" data-toggle="modal" data-target="#myModalTwo" id="signUp">회원가입</a></li>
								<?php
								}
								?>
								<li class=""><!-- <div id="google_translate_element"></div> --></li>
							</ul>
						</div><!-- /.navbar-collapse -->
					</div><!-- /.container -->
				</nav>
			</div><!-- first-nav -->
			<div class="second-nav visible-lg visible-md" id="second-nav">
				<nav class="navbar navbar-default ask-nav-two">
					<div class="">
						<!-- Brand and toggle get grouped for better mobile display -->
						<div class="navbar-header">
						  <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
							<span class="sr-only">Toggle navigation</span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
						  </button>
						</div>

						<!-- Collect the nav links, forms, and other content for toggling -->
						<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
							<ul class="nav navbar-nav ask-custom-nav">
								<!-- <li class=""><a href="index.php" class="text-uppercase" style="color:#fff;">HOME <span class="sr-only">(current)</span></a></li> --><!-- nav-active -->
								<li class=""><a href="sports/" class="text-uppercase" style="color:#fff;">스포츠</a></li>
								<!-- <li class="dropdown nav-dropdown">
								  <a href="sports/" class="dropdown-toggle text-white disabled" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">스포츠</a>
									<ul class="dropdown-menu ask-list">
										<li><a href="online-sports/" >일반 배팅사이트</a></li>
										<li><a href="newest-sports/" >신규 배팅사이트</a></li>
										<li><a href="verified-sports/" >검증된 배팅사이트</a></li>
										<li><a href="bitcoin-sports/" >비트코인 배팅사이트</a></li>
										<li><a href="livebetting-sports/">라이브 배팅사이트</a></li>
									</ul>
								</li> -->
							<!--	<li class=""><a href="mini-game/" class="text-uppercase" style="color:#fff;"> 	미니게임</a></li> -->
								<li class="dropdown nav-dropdown">
								  <a href="bonus/" class="dropdown-toggle text-white disabled" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">보너스</a>
									<ul class="dropdown-menu ask-list">
										<!-- <li><a href="welcome-bonus/" >신규 첫충 보너스</a></li> -->
										<li><a href="first-deposit-bonus/">첫충전 보너스</a></li>
										<li><a href="every-time-bonus/" >매번 충전 보너스</a>
										<li><a href="rolling-bonus/" >롤링 보너스</a>
										<li><a href="free-money/" >꽁머니 보너스</a>
										<li><a href="combo-bonus/" >다폴더 보너스</a>
										<li><a href="rebate-bonus/" >낙첨금 보너스</a>
										<li><a href="other-bonus/" >기타 보너스</a>
									</ul>
								</li>
								<li class="dropdown nav-dropdown">
								  <a href="complaints/" class="dropdown-toggle text-uppercase text-white disabled" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">사이트 분쟁</a>
									<ul class="dropdown-menu ask-list">
										<li><a href="submit-complaint/" >분쟁해결 신청하기</a></li>
										<li><a href="complaint-open/" >진행중인 분쟁</a></li>
										<li><a href="complaint-resolve/" >해결된 분쟁</a></li>
										<li><a href="complaint-unsolved/" >미해결된 분쟁</a></li>
										<li><a href="complaint-payment-issues/" >입출금 분쟁</a></li>
										<li><a href="complaint-bonus-issues/" >보너스 분쟁</a></li>
										<li><a href="complaint-other-issues/" >기타 분쟁</a></li>
									</ul>
								</li>
								<li class=""><a href="site-news/" class="text-uppercase" style="color:#fff;">배팅사이트소식</a></li>
								<li class=""><a href="blog/" class="text-uppercase" style="color:#fff;">블로그</a></li>
								<li class=""><a href="notice/" class="text-uppercase" style="color:#fff;">공지사항</a></li>
							</ul>
							<ul class="nav navbar-nav navbar-right ask-custom-nav-one">
								
								<form class="navbar-form navbar-left" id="custom-form" role="search" action="search.php" method="GET" enctype="multipart/form-data">
									<div class="form-group">
									  <input type="text" class="form-control" name="searchQuery" placeholder="Search">
									   <input type="submit" class="form-control" name="" value="Enter">
									</div>
								</form>
								<li><button type="submit" class="btn btn-ask-black searchOn hvr-shadows"><span class="glyphicon glyphicon-search"></span></button></li>
							</ul>
						</div><!-- /.navbar-collapse -->
					</div><!-- /.container-fluid -->
				</nav>
			</div><!-- second-nav -->


		<!-- Mobile and tablet Menu -->
			<div class="second-nav visible-sm visible-xs" id="second-nav" style="">
				<nav class="navbar navbar-default ask-nav-two ask-nav-two-resp">
					<div class="">
						<!-- Brand and toggle get grouped for better mobile display -->
						<div class="navbar-header" style="height: 66px;">
						  <button type="button" class="navbar-toggle collapsed custom-menu-icon" data-toggle="collapse" data-target="#bs-example-navbar-collapse-3" aria-expanded="false" style="margin-top: 14px;">
							<span class="sr-only">Toggle navigation</span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
						  </button>
						  <button type="button" class="navbar-toggle custom-menu-icon formCome" style="margin-top: 14px;color:#fff;">
								<span class="glyphicon glyphicon-search"></span>
						  </button>
						  <div class="resp-search-form">
						  	<form action="search.php" method="" action="GET">
						  		<div class="form-group row">
						  			<div class="col-sm-10 col-xs-10">
						  				<input type="text" class="form-control" name="searchQuery"  placeholder="Search..." />
						  			</div>
						  			<div class="col-sm-2 col-xs-2 text-center">
						  				<span class="glyphicon glyphicon-remove text-white search-box-close"></span>
						  			</div>
						  		</div>
						  	</form>
						  </div>
						  <a class="navbar-brand" href="home/" style="padding: 0px 10px; margin-top: 38px; height: 21px;"><img src="images/logo-logo.png" style=" width: 150px;margin-top: -25px;" /></a>
						</div>

						<!-- Collect the nav links, forms, and other content for toggling -->
						<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-3">
							<ul class="nav navbar-nav ask-custom-nav">
								<!-- <li class=""><a href="index.php" class="text-uppercase" style="color:#fff;">HOME <span class="sr-only">(current)</span></a></li> --><!-- nav-active -->
								<!--<li><a href="javascript:void(0)"> &nbsp; </a></li>-->
								<li class=""><a href="sports/" class="text-uppercase" style="color:#fff;">스포츠</a></li>
								<!-- <li class="dropdown child-drop">
								  <a href="javascript:void(0)" onclick="redirect_sport();" class="dropdown-toggle text-white disabled" id="mobile_more_sport" role="button" aria-haspopup="true" aria-expanded="false"><span class="sport_span">스포츠</span></a>
								  <button class="more_span" style="width:72px;">펼쳐보기</button>
									<ul class="dropdown-menu">
										<li><a href="online-sports/">일반 배팅사이트</a></li>
										<li><a href="newest-sports/">신규 배팅사이트</a></li>
										<li><a href="verified-sports/">검증된 배팅사이트</a></li>
										<li><a href="bitcoin-sports/">비트코인 배팅사이트</a></li>
										<li><a href="livebetting-sports/">라이브 배팅사이트</a></li>
									</ul>
								</li> -->
<!-- 								<li class=""><a href="mini-game/" class="text-uppercase" style="color:#fff;">미니게임</a></li> -->
								<li class="dropdown child-drop">
								  <a href="javascript:void(0)" onclick="redirect_bonus();" class="dropdown-toggle text-white disabled" role="button" aria-haspopup="true" aria-expanded="false"><span class="bonus_span" onclick="window.location.href = 'bonus/';">보너스</span></a>
								  <button class="more_span" style="width:72px;">펼쳐보기</button>
								  
									<ul class="dropdown-menu">
										<li><a href="welcome-bonus/">신규가입 보너스</a></li>
										<li><a href="first-deposit-bonus/">첫충전 보너스</a></li>
										<li><a href="every-time-bonus/">매번 충전 보너스</a>
										<li><a href="rolling-bonus/">롤링 보너스</a>
										<li><a href="free-money/">꽁머니 보너스</a>
										<li><a href="combo-bonus/">다폴더 보너스</a>
										<li><a href="rebate-bonus/">낙첨금 보너스</a>
										<li><a href="other-bonus/">기타 보너스</a>
									</ul>
								</li>
								<li class="dropdown child-drop">
								  <a href="complaints/" class="dropdown-toggle text-uppercase text-white tablet-complaint" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">사이트 분쟁</a>
									<ul class="dropdown-menu">
										<li><a href="submit-complaint/">분쟁해결 신청하기</a></li>
										<li><a href="complaint-open/">진행중인 분쟁</a></li>
										<li><a href="complaint-resolve/">해결된 분쟁</a></li>
										<li><a href="complaint-unsolved/">미해결된 분쟁</a></li>
										<li><a href="complaint-payment-issues/">입출금 분쟁</a></li>
										<li><a href="complaint-bonus-issues/">보너스 분쟁</a></li>
										<li><a href="complaint-other-issues/">기타 분쟁</a></li>
									</ul>
								</li>
								<li class=""><a href="site-news/" class="text-uppercase" style="color:#fff;">배팅 사이트 소식</a></li>
								<li class=""><a href="blog/" class="text-uppercase" style="color:#fff;">블로그</a></li>
								<li class=""><a href="notice/" class="text-uppercase" style="color:#fff;">공지사항</a></li>
								<!-- <li class=""><a href="#" class="text-uppercase" style="color:#fff;" data-backdrop="false" data-toggle="modal" data-target="#myModal" id="signIn">로그인</a></li>
								<li class=""><a href="#" class="text-uppercase" style="color:#fff;" data-backdrop="false" data-toggle="modal" data-target="#myModalTwo" id="signUp">회원가입</a></li> -->
								<?php
								if(User::loggedInUserId() > 0){
								?>
								<!-- <li class="dropdown"><a href="#" class="text-white dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">NOTIFICATION</a>
									<?php	 ?>
									<ul class="dropdown-menu ask-list">
										<li><a href="#" class="text-white">1 new notification</a></li>
										<li><a href="#" class="text-white">1 new notification</a></li>
										<li><a href="#" class="text-white">1 new notification</a></li>
									</ul>
								</li> -->
								<li class="" style="position:relative;"><a href="site-admin-notification.php" class="text-white dropdown-toggle">알람</a>
								<span class="notificationCount"></span></li>
								<li class="dropdown">
									<?php
									$logedInID = (int)User::loggedInUserId() > 0 ? User::loggedInUserId() : 0;
									$userid = $User->query("SELECT `userId`, `groupId`, `siteName` FROM `tblUser` WHERE `id` = '" . $logedInID . "' LIMIT 0,1");
									if(isset($userid)){
								 	?>
								  <a href="#" class="text-white dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">내 계정<span class="caret"></span></a>
									<?php	} ?>
									<ul class="dropdown-menu ask-list">
										<?php 
										if($userid[0]['groupId'] == 2){
										?>
										<li><a href="site-comments.php" class="text-white">사이트 댓글</a></li>
										<li><a href="siteComplaints.php" class="text-white">사이트 분쟁해결</a></li>
										<?php
										}
										?>
										<li><a href="editProfile.php" class="text-white">마이페이지</a></li>
										<li><a href="index.php?logout=logout" class="text-white">로그아웃</a></li>
									</ul>
								</li>
								<?php
								}else{
								?>
								<li class="floating-menu">
									<a href="#" class="text-uppercase resp-login" style="color:#fff;" data-backdrop="false" data-toggle="modal" data-target="#myModal" id="signIn">로그인</a>
									<a href="#" class="text-uppercase resp-signIn" style="color:#fff;" data-backdrop="false" data-toggle="modal" data-target="#myModalTwo" id="signUp">회원가입</a>
								</li>
								<?php
								}
								?>
							</ul>
						</div><!-- /.navbar-collapse -->
					</div><!-- /.container-fluid -->
				</nav>
			</div><!-- second-nav -->

	<!-- Mobile and tablet Menu End -->
	<div class="paste-notification" style="display:none;"></div>