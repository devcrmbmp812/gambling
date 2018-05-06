<?php
require_once('config.php');	

// Load Classes
C::loadClass('User');
C::loadClass('Card');
C::loadClass('CMS');
//Init User class
$User = new User();
$Card = new Card();



?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Sample Page - Easy BootStrap</title>
<!-- Bootstrap & Fontawesome -->
<link href="assets/css/bootstrap.css" rel="stylesheet">
<link href="assets/css/font-awesome.min.css" rel="stylesheet">
<link href="assets/css/owl.carousel.css" rel="stylesheet">

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
			<div class="ask-notice hidden-sm hidden-xs">
				<div class="col-md-8">
					<div class="col-md-1 col-sm-1 col-xs-2 ask-notice-icon">
						<span class="glyphicon glyphicon-bullhorn"></span>
					</div>
					<div class="col-md-11 col-sm-11 col-xs-10 ask-notice-text">
						<div id="myCarousel1" class="carousel slide" data-ride="carousel">
						  	<!-- Wrapper for slides -->
							<div class="carousel-inner" role="listbox">
							<?php
							$result = $User->query("SELECT `noticeTitle` FROM `tblNotice` WHERE `isPined` = 'Y'");
							$counter = 1;
							if(is_array($result) && count($result) > 0){
							foreach ($result as $key => $value) {
							?>
								<div class="item <?php if($counter <= 1){echo " active"; } ?> text-yellow" style="font-size:12px;"><?php echo $value['noticeTitle']; ?></div>
								<?php
								$counter++;
									}
								}
								?>
							</div>
						</div>
					</div>
				</div>
				<div class="col-md-4">
					<ul class="nav navbar-nav navbar-right ask-social" style="margin-right:0px;">
						<li class=""><a href="#" class="hvr-shutter-in-vertical-chat"><b><i class="fa fa-comments-o"></i></b></a></li>
						<li class=""><a href="#" class="hvr-shutter-in-vertical-twitter"><b><i class="fa fa-twitter"></i></b></a></li>
						<li class=""><a href="#" class="hvr-shutter-in-vertical-facebook"><b><i class="fa fa-facebook"></i></b></a></li>
						<li class=""><a href="#" class="hvr-shutter-in-vertical-google"><b><i class="fa fa-youtube"></i></b></a></li>

					</ul>		
				</div>
			</div><!-- ask-notice -->
			<div class="container pl0"><?php require_once(INCLUDES . "message.php");?></div>
			<div class="clearfix"></div>
			<div class="first-nav" id="first-nav">
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
						  <a class="navbar-brand" href="#"><img src="images/logo-(fixed).png" class=""  style="margin-top: -25px;" /></a>
						</div>

						<!-- Collect the nav links, forms, and other content for toggling -->
						<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-2">
							<ul class="nav navbar-nav navbar-left">
								<li class=""><p class="text-white"  style="padding-top: 8px;"> Welcome Back vip123</p></li>
							</ul>
							<ul class="nav navbar-nav navbar-right">
								<?php
								if(User::loggedInUserId() > 0){
								?>
								<li class=""><a href="index.php?logout=logout" class="btn btn-ask-black hvr-shadows">SIGN OUT</a></li>
								<?php
								}else{
								?>
								<li class=""><a href="#" class="btn btn-ask-black hvr-shadows" data-toggle="modal" data-target="#myModal">SIGN IN</a></li>
								<li class=""><a href="#" class="btn btn-ask-black hvr-shadows" data-toggle="modal" data-target="#myModalTwo">SIGN UP</a></li>
								<?php
								}
								?>
								<li class=""><!-- <div id="google_translate_element"></div> --></li>
							</ul>
							<ul class="nav navbar-nav navbar-right">
								<form class="navbar-form navbar-left" id="custom-form" role="search" action="notice.php" method="get">
									<div class="form-group">
									  <input type="text" class="form-control" placeholder="Search">
									</div>
								</form>
								<li><a href="#" class="btn btn-ask-black searchOn hvr-shadows"><span class="glyphicon glyphicon-search"></span></a></li>
							</ul>
						</div><!-- /.navbar-collapse -->
					</div><!-- /.container -->
				</nav>
			</div><!-- first-nav -->
			<div class="second-nav" id="second-nav">
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
								<li class=""><a href="index.php" class="text-uppercase" style="color:#fff;">HOME <span class="sr-only">(current)</span></a></li><!-- nav-active -->
								<li class="dropdown">
								  <a href="sports.php" class="dropdown-toggle text-white disabled" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">SPORTS</a>
									<ul class="dropdown-menu ask-list">
										<li><a href="<?php echo C::link('sports.php', array('cat' => str_replace(' ', '-', 'Online Sport/OS') ), true);?>">Online Sport</a></li>
										<li><a href="<?php echo C::link('sports.php', array('cat' => str_replace(' ', '-', 'Newest Sport/NS') ), true);?>">Newest Sport</a></li>
										<li><a href="<?php echo C::link('sports.php', array('cat' => str_replace(' ', '-', 'Verified Sport/VS') ), true);?>">Verified Sport</a></li>
										<li><a href="<?php echo C::link('sports.php', array('cat' => str_replace(' ', '-', 'Bitcoin Sport/BS') ), true);?>">Bitcoin Sport</a></li>
										<li><a href="<?php echo C::link('sports.php', array('cat' => str_replace(' ', '-', 'Mobile Sport/MS') ), true);?>">Mobile Sport</a></li>
										<li><a href="<?php echo C::link('sports.php', array('cat' => str_replace(' ', '-', 'Sadari Sport/SS') ), true);?>">Sadari Sport</a></li>
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
										<li><a href="#">Open</a></li>
										<li><a href="#">Resolved</a></li>
										<li><a href="#">Unresolved</a></li>
									</ul>
								</li>
								<li class="dropdown">
								  <a href="news.php" class="dropdown-toggle text-uppercase text-white disabled" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">News</a>
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
								</li>
								<!-- <li class=""><a href="admin/" class="text-uppercase" style="color:#fff;">Admin</a></li> -->
								<?php
								if(User::loggedInUserId() > 0){
								?>
								<li class=""><a href="" class="text-uppercase" style="color:#fff;">my account</a></li>
								<?php
								}
								?>
							</ul>
						</div><!-- /.navbar-collapse -->
					</div><!-- /.container-fluid -->
				</nav>
			</div><!-- second-nav -->