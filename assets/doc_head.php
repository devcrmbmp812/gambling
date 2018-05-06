<?php
require_once('config.php');	

// Load Classes
C::loadClass('User');
C::loadClass('Card');
C::loadClass('CMS');
//Init User class
$User = new User();
$Card = new Card();

if(isset($_POST) && is_array($_POST) && count($_POST) > 0 && isset($_POST['__FORM']) && $_POST['__FORM'] == '_LOGIN_'){
	if($User->login($_POST)){
		//$Common->redirect('index.php');
    //Message::addMessage("successfull.", SUCCS);
	}
} else if(C::isPostBack($_POST) && isset($_POST['__FORM']) && $_POST['__FORM'] == '_PASSWORD_'){
    if($User->forgetPassword($_POST)){
		C::redirect('index.php');
	}
} else if(isset($_POST) && is_array($_POST) && count($_POST) > 0 && isset($_POST['__FORM']) && $_POST['__FORM'] == '_SIGNUP_'){
	if($User->userSignUp($_POST)){
    Message::addMessage("successfull.", SUCCS);
	}
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Betting Time</title>
<!-- Bootstrap & Fontawesome -->
<link href="assets/css/bootstrap.css" rel="stylesheet">
<link href="assets/css/font-awesome.min.css" rel="stylesheet">
<link href="assets/css/owl.carousel.css" rel="stylesheet">
<link href="assets/css/owl.theme.css" rel="stylesheet">

<!-- Start custom CSS (Your own theme, overrides all of the above styles) -->
<link href="assets/css/style.css" rel="stylesheet">
<link href="assets/css/custom.css" rel="stylesheet">
<link href="assets/css/hover.css" rel="stylesheet">
<link href="assets/css/notosanskr.css" rel="stylesheet">
<link href="assets/css/ripple.css" rel="stylesheet">
<link href="assets/css/responsive.css" rel="stylesheet">
<link href="assets/css/animate.css" rel="stylesheet">
<link rel="stylesheet" href="assets/css/jquery.rateyo.min.css"/>
<link rel="stylesheet" href="assets/css/lightbox.min.css">
<!-- End Custom CSS -->

<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->


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
								<div class="item <?php if($counter <= 1){echo " active"; } ?> text-yellow" style="font-size:12px;"><a href="notice.php?notice=<?php echo $value['id'];?>" class="text-yellow"><?php echo $value['noticeTitle']; ?></a></div>
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
						<li class=""><a href="#" class="hvr-shutter-in-vertical-chat nav-chat" data-backdrop="false" data-toggle="modal" data-target="#modalSocial" data-header="chat" data-content="chat"><b><i class="fa fa-comments-o"></i></b></a></li>
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
						  <a class="navbar-brand" href="index.php"><img src="images/logo-logo.png" class=""  style="margin-top: -25px;" /></a>
						 <!--  <a class="navbar-brand" href="#"><img src="images/betting_logo.png" class="" /></a> -->
						</div>

						<!-- Collect the nav links, forms, and other content for toggling -->
						<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-2">
							<ul class="nav navbar-nav navbar-right">
								<?php
								if(User::loggedInUserId() > 0){
								?>
								<li class="dropdown"><a href="#" class="text-white font24 dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class="fa fa-bell shadow_1 text-white" aria-hidden="true"></i></a>
									<?php	 ?>
									<ul class="dropdown-menu ask-list ask-list-caret">
										<li><a href="#">1 new notification</a></li>
										<li><a href="#">1 new notification</a></li>
										<li><a href="#">1 new notification</a></li>
									</ul>
								</li>
								<li class="dropdown pull-right">
									<?php
									$logedInID = (int)User::loggedInUserId() > 0 ? User::loggedInUserId() : 0;
									$userid = $User->query("SELECT `userId`, `groupId`, `siteName` FROM `tblUser` WHERE `id` = '" . $logedInID . "' LIMIT 0,1");
									if(isset($userid)){
								 	?>
								  <a href="#" class="text-white font24 dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><span class="glyphicon glyphicon-user m-r-10 shadow_1"></span><span class="caret"></span></a>
									<?php	} ?>
									<ul class="dropdown-menu ask-list ask-list-caret">
										<?php 
										if($userid[0]['groupId'] == 2){
										?>
										<li><a href="siteComplaints.php">Site Complaints</a></li>
										<?php
										}
										?>
										<li><a href="editProfile.php">Edit Profile</a></li>
										<li><a href="index.php?logout=logout">Sign Out</a></li>
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
								<li class="dropdown">
								  <a href="sports.php" class="dropdown-toggle text-white disabled" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">SPORTS</a>
									<ul class="dropdown-menu ask-list">
										<li><a href="<?php echo C::link('sports.php', array('cat' => str_replace(' ', '-', 'Online Sport/OS') ), true);?>">Online Sport</a></li>
										<li><a href="<?php echo C::link('sports.php', array('cat' => str_replace(' ', '-', 'Newest Sport/NS') ), true);?>">Newest Sport</a></li>
										<li><a href="<?php echo C::link('sports.php', array('cat' => str_replace(' ', '-', 'Verified Sport/VS') ), true);?>">Verified Sport</a></li>
										<li><a href="<?php echo C::link('sports.php', array('cat' => str_replace(' ', '-', 'Bitcoin Sport/BS') ), true);?>">Bitcoin Sport</a></li>
										<li><a href="<?php echo C::link('sports.php', array('cat' => str_replace(' ', '-', 'Mobile Sport/MS') ), true);?>">Mobile Sport</a></li>
										<li><a href="sadari.php">Sadari Sport</a></li>
									</ul>
								</li>
								<li class="dropdown">
								  <a href="bonus.php" class="dropdown-toggle text-white disabled" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">BONUS</a>
									<ul class="dropdown-menu ask-list">
										<li><a href="<?php echo C::link('bonus.php', array('cat' => str_replace(' ', '-', 'Welcome Bonus/WB') ), true);?>">Welcome Bonus</a></li>
										<li><a href="<?php echo C::link('bonus.php', array('cat' => str_replace(' ', '-', 'First Deposite Bonus/FSD') ), true);?>">First Deposite Bonus</a></li>
										<li><a href="<?php echo C::link('bonus.php', array('cat' => str_replace(' ', '-', 'Every Time Bonus/ETB') ), true);?>">Every Time Bonus</a>
										<li><a href="<?php echo C::link('bonus.php', array('cat' => str_replace(' ', '-', 'Rolling Bonus/RB') ), true);?>">Rolling Bonus</a>
										<li><a href="<?php echo C::link('bonus.php', array('cat' => str_replace(' ', '-', 'Free Money/FM') ), true);?>">Free Money</a>
										<li><a href="<?php echo C::link('bonus.php', array('cat' => str_replace(' ', '-', 'Combo Bonus/CB') ), true);?>">Combo Bonus</a>
										<li><a href="<?php echo C::link('bonus.php', array('cat' => str_replace(' ', '-', 'Rebate Bonus/REB') ), true);?>">Rebate Bonus</a>
										<li><a href="<?php echo C::link('bonus.php', array('cat' => str_replace(' ', '-', 'Other Bonus/OB') ), true);?>">Other Bonus</a>
									</ul>
								</li>
								<li class="dropdown">
								  <a href="complaint.php" class="dropdown-toggle text-uppercase text-white disabled" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Complaints</a>
									<ul class="dropdown-menu ask-list">
										<li><a href="submitComplaint.php">Submit Complains</a></li>
										<li><a href="<?php echo C::link('complaint.php', array('catComp' => 'OP' ), true);?>">Open</a></li>
										<li><a href="<?php echo C::link('complaint.php', array('catComp' => 'RE' ), true);?>">Resolved</a></li>
										<li><a href="<?php echo C::link('complaint.php', array('catComp' => 'UN' ), true);?>">Unresolved</a></li>
										<li><a href="<?php echo C::link('complaint.php', array('catComp' => 'PI' ), true);?>">Payment Issues</a></li>
										<li><a href="<?php echo C::link('complaint.php', array('catComp' => 'BI' ), true);?>">Bonus Issues</a></li>
										<li><a href="<?php echo C::link('complaint.php', array('catComp' => 'OI' ), true);?>">Other Issues</a></li>
									</ul>
								</li>
								<li class=""><a href="<?php echo C::link('news.php', array('cat' => str_replace(' ', '-', 'Site News/SN') ), true);?>" class="text-uppercase" style="color:#fff;">Site News</a></li>
								<li class=""><a href="<?php echo C::link('news.php', array('cat' => str_replace(' ', '-', 'Blog/B') ), true);?>" class="text-uppercase" style="color:#fff;">Blog</a></li>
								<!-- <li class="dropdown">
								  <a href="news.php" class="dropdown-toggle text-uppercase text-white" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">News</a>
									<ul class="dropdown-menu ask-list">
										<li><a href="<?php echo C::link('news.php', array('cat' => str_replace(' ', '-', 'Site News/SN') ), true);?>">Site News</a></li>
										<li><a href="<?php echo C::link('news.php', array('cat' => str_replace(' ', '-', 'Blog/B') ), true);?>">Blog</a></li>
									</ul>
								</li>
								<li class="dropdown">
								  <a href="support.php" class="dropdown-toggle text-uppercase text-white disabled" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Support</a>
									<ul class="dropdown-menu ask-list">
										<li><a href="notice.php">Notice</a></li>
										<li><a href="contact.php">Contact</a></li>
										<li><a href="privacyPolicy.php">Privacy Policy</a></li>
										<li><a href="#">Posting Guidlines</a></li>
									</ul>
								</li> -->
								<!-- <li class=""><a href="admin/" class="text-uppercase" style="color:#fff;">Admin</a></li> -->
							</ul>
							<ul class="nav navbar-nav navbar-right ask-custom-nav-one">
								
								<form class="navbar-form navbar-left" id="custom-form" role="search" action="search.php" method="GET" enctype="multipart/form-data">
									<div class="form-group">
									  <input type="text" class="form-control" name="searchQuery" placeholder="Search">
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
						  <div class="resp-search-form animated slideInRight">
						  	<form action="" method="" action="GET">
						  		<div class="form-group row">
						  			<div class="col-sm-10 col-xs-10">
						  				<input type="text" class="form-control" placeholder="Search..." />
						  			</div>
						  			<div class="col-sm-1 col-xs-1" style="padding-left:0;">
						  				<button class="btn btn-transparent" type="submit"><span class="glyphicon glyphicon-search"></span></button>
						  			</div>
						  			<div class="col-sm-1 col-xs-1" style="padding-left: 19px; margin-top: -18px;">
						  				<span class="glyphicon glyphicon-remove text-white"></span>
						  			</div>
						  		</div>
						  	</form>
						  </div>
						  <!-- <a class="navbar-brand" href="#"><img src="images/logo-(fixed).png" class="img-responsive"  style="margin-top: -15px;" /></a> -->
						  <a class="navbar-brand" href="#" style="margin-top: -15px;"><h3 class="text-white"><b>Betting Time</b></h3></a>
						</div>

						<!-- Collect the nav links, forms, and other content for toggling -->
						<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-3">
							<ul class="nav navbar-nav ask-custom-nav">
								<!-- <li class=""><a href="index.php" class="text-uppercase" style="color:#fff;">HOME <span class="sr-only">(current)</span></a></li> --><!-- nav-active -->
								<li class="dropdown child-drop">
								  <a href="sports.php" class="dropdown-toggle text-white" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">SPORTS</a>
									<ul class="dropdown-menu">
										<li><a href="<?php echo C::link('sports.php', array('cat' => str_replace(' ', '-', 'Online Sport/OS') ), true);?>">Online Sport</a></li>
										<li><a href="<?php echo C::link('sports.php', array('cat' => str_replace(' ', '-', 'Newest Sport/NS') ), true);?>">Newest Sport</a></li>
										<li><a href="<?php echo C::link('sports.php', array('cat' => str_replace(' ', '-', 'Verified Sport/VS') ), true);?>">Verified Sport</a></li>
										<li><a href="<?php echo C::link('sports.php', array('cat' => str_replace(' ', '-', 'Bitcoin Sport/BS') ), true);?>">Bitcoin Sport</a></li>
										<li><a href="<?php echo C::link('sports.php', array('cat' => str_replace(' ', '-', 'Mobile Sport/MS') ), true);?>">Mobile Sport</a></li>
										<li><a href="sadari.php">Sadari Sport</a></li>
									</ul>
								</li>
								<li class="dropdown child-drop">
								  <a href="bonus.php" class="dropdown-toggle text-white" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">BONUS</a>
									<ul class="dropdown-menu">
										<li><a href="<?php echo C::link('bonus.php', array('cat' => str_replace(' ', '-', 'Welcome Bonus/WB') ), true);?>">Welcome Bonus</a></li>
										<li><a href="<?php echo C::link('bonus.php', array('cat' => str_replace(' ', '-', 'First Deposite Bonus/FSD') ), true);?>">First Deposite Bonus</a></li>
										<li><a href="<?php echo C::link('bonus.php', array('cat' => str_replace(' ', '-', 'Every Time Bonus/ETB') ), true);?>">Every Time Bonus</a>
										<li><a href="<?php echo C::link('bonus.php', array('cat' => str_replace(' ', '-', 'Rolling Bonus/RB') ), true);?>">Rolling Bonus</a>
										<li><a href="<?php echo C::link('bonus.php', array('cat' => str_replace(' ', '-', 'Free Money/FM') ), true);?>">Free Money</a>
										<li><a href="<?php echo C::link('bonus.php', array('cat' => str_replace(' ', '-', 'Combo Bonus/CB') ), true);?>">Combo Bonus</a>
										<li><a href="<?php echo C::link('bonus.php', array('cat' => str_replace(' ', '-', 'Rebate Bonus/REB') ), true);?>">Rebate Bonus</a>
										<li><a href="<?php echo C::link('bonus.php', array('cat' => str_replace(' ', '-', 'Other Bonus/OB') ), true);?>">Other Bonus</a>
									</ul>
								</li>
								<li class="dropdown child-drop">
								  <a href="complaint.php" class="dropdown-toggle text-uppercase text-white" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Complaints</a>
									<ul class="dropdown-menu">
										<li><a href="submitComplaint.php">Submit Complains</a></li>
										<li><a href="<?php echo C::link('complaint.php', array('catComp' => 'OP' ), true);?>">Open</a></li>
										<li><a href="<?php echo C::link('complaint.php', array('catComp' => 'RE' ), true);?>">Resolved</a></li>
										<li><a href="<?php echo C::link('complaint.php', array('catComp' => 'UN' ), true);?>">Unresolved</a></li>
										<li><a href="<?php echo C::link('complaint.php', array('catComp' => 'PI' ), true);?>">Payment Issues</a></li>
										<li><a href="<?php echo C::link('complaint.php', array('catComp' => 'BI' ), true);?>">Bonus Issues</a></li>
										<li><a href="<?php echo C::link('complaint.php', array('catComp' => 'OI' ), true);?>">Other Issues</a></li>
									</ul>
								</li>
								<li class=""><a href="<?php echo C::link('news.php', array('cat' => str_replace(' ', '-', 'Site News/SN') ), true);?>" class="text-uppercase" style="color:#fff;">Site News</a></li>
								<li class=""><a href="<?php echo C::link('news.php', array('cat' => str_replace(' ', '-', 'Blog/B') ), true);?>" class="text-uppercase" style="color:#fff;">Blog</a></li>
								<!-- <li class=""><a href="#" class="text-uppercase" style="color:#fff;" data-backdrop="false" data-toggle="modal" data-target="#myModal" id="signIn">로그인</a></li>
								<li class=""><a href="#" class="text-uppercase" style="color:#fff;" data-backdrop="false" data-toggle="modal" data-target="#myModalTwo" id="signUp">회원가입</a></li> -->
								<?php
								if(User::loggedInUserId() > 0){
								?>
								<li class="dropdown"><a href="#" class="text-white dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">NOTIFICATION</a>
									<?php	 ?>
									<ul class="dropdown-menu ask-list">
										<li><a href="#" class="text-white">1 new notification</a></li>
										<li><a href="#" class="text-white">1 new notification</a></li>
										<li><a href="#" class="text-white">1 new notification</a></li>
									</ul>
								</li>
								<li class="dropdown">
									<?php
									$logedInID = (int)User::loggedInUserId() > 0 ? User::loggedInUserId() : 0;
									$userid = $User->query("SELECT `userId`, `groupId`, `siteName` FROM `tblUser` WHERE `id` = '" . $logedInID . "' LIMIT 0,1");
									if(isset($userid)){
								 	?>
								  <a href="#" class="text-white dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">MY ACCOUNT<span class="caret"></span></a>
									<?php	} ?>
									<ul class="dropdown-menu ask-list">
										<?php 
										if($userid[0]['groupId'] == 2){
										?>
										<li><a href="siteComplaints.php" class="text-white">Site Complaints</a></li>
										<?php
										}
										?>
										<li><a href="editProfile.php" class="text-white">Edit Profile</a></li>
										<li><a href="index.php?logout=logout" class="text-white">Sign Out</a></li>
									</ul>
								</li>
								<?php
								}else{
								?>
								<li class=""><a href="#" class="text-uppercase" style="color:#fff;" data-backdrop="false" data-toggle="modal" data-target="#myModal" id="signIn">로그인</a></li>
								<li class=""><a href="#" class="text-uppercase" style="color:#fff;" data-backdrop="false" data-toggle="modal" data-target="#myModalTwo" id="signUp">회원가입</a></li>
								<?php
								}
								?>
							</ul>
						</div><!-- /.navbar-collapse -->
					</div><!-- /.container-fluid -->
				</nav>
			</div><!-- second-nav -->

	<!-- Mobile and tablet Menu End -->