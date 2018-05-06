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
	if(isset($_GET['logout']) && trim($_GET['logout']) == 'logout'){
	    UNSET($_SESSION['admin']);
	    header("LOCATION:index.php");
	}
?>
<!DOCTYPE html>
<html lang="">
<head>
	<meta charset="utf-8">
	<title>Admin Area</title>
	<meta name="description" content="" />
	<meta name="keywords" content="" />
	<meta name="robots" content="" />
	<meta name="viewport" content="width=device-width, minimum-scale=1.0, maximum-scale=1.0">
	<link rel="stylesheet" href="css/style.css" media="all" />
	<link rel="stylesheet" href="css/custom.css" media="all" />
	<link rel="stylesheet" href="css/chosen.css" media="all" />
	<link rel="stylesheet" href="../assets/css/jquery.rateyo.min.css"/>
	<!-- <link rel="stylesheet" href="../assets/css/bootstrap.min.css" media="all" /> -->
	<!--[if IE]><link rel="stylesheet" href="css/ie.css" media="all" /><![endif]-->
	<!--[if lt IE 9]><link rel="stylesheet" href="css/lt-ie-9.css" media="all" /><![endif]-->
</head>
<body>
<div class="testing">
<?php
$id = (int)User::loggedInUserId() > 0 ? User::loggedInUserId() : 0;
$findGroupId = $User->query("SELECT `userId`,`groupId` FROM `tblUser` WHERE `id` = '" . $id . "' LIMIT 1");
if( $findGroupId[0]['groupId'] == 0 ){
?>
<header class="main">
	<h1><strong>Betting</strong> Time</h1>
</header>
<section class="user">
	<div class="profile-img">
		<p><img src="images/user2.png" alt="" height="40" width="40" /> Welcome back <?php echo $findGroupId[0]['userId']; ?></p>
	</div>
	<div class="buttons">
		<button class="ico-font">&#9206;</button>
		<span class="button dropdown">
			<a href="#">Notifications <span class="pip">4</span></a>
			<ul class="notice">
				<li>
					<hgroup>
						<h1>You have a new task</h1>
						<h2>Report web statistics week by week.</h2> 
					</hgroup>
					<p><span>14:24</span></p>
				</li>
				<li>
					<hgroup>
						<h1>New comment</h1>
						<h2>Comment on <em>About page</em> by Darren.</h2> 
					</hgroup>
					<p><span>11:04</span></p>
				</li>
				<li>
					<hgroup>
						<h1>Broken link</h1>
						<h2>We've spotted a broken link on the <em>Blog page</em>.</h2> 
					</hgroup>
					<p><span>10:46</span></p>
				</li>
				<li>
					<hgroup>
						<h1>User report</h1>
						<h2><em>Lee Grant</em> has been promoted to admin.</h2> 
					</hgroup>
					<p><span>09:57</span></p>
				</li>
			</ul>
		</span> 
		<!-- <span class="button dropdown">
			<a href="#">Inbox <span class="pip">6</span></a>
			<ul class="notice">
				<li>
					<hgroup>
						<h1>Hi, I need a favour</h1>
						<h2>John Doe</h2>
						<h3>Lorem ipsum dolor sit amet, consectetuer sed aidping putamus delo de sit felume...</h3>
					</hgroup>
					<p><span>11:24</span></p>
				</li>
				<li>
					<hgroup>
						<h1><span class="icon">&#59154;</span>Hi, I need a favour</h1>
						<h2>John Doe</h2>
						<h3>Lorem ipsum dolor sit amet, consectetuer sed aidping putamus delo de sit felume...</h3>
					</hgroup>
					<p><span>11:24</span></p>
				</li>
				<li>
					<hgroup>
						<h1><span class="icon">&#59154;</span>Hi, I need a favour</h1>
						<h2>John Doe</h2>
						<h3>Lorem ipsum dolor sit amet, consectetuer sed aidping putamus delo de sit felume...</h3>
					</hgroup>
					<p><span>11:24</span></p>
				</li>
			</ul>
		</span>  -->
		<a href="chatResponse.php" target="_blank"><span class="button">Chat</span></a>
		<a href="../index.php"><span class="button">Live</span></a>
		 <span class="button blue"><a href="index.php?logout=logout">Logout</a></span>
	</div>
</section>
</div>
<nav>
	<ul>
		<li class="section"><a href="index.php"><span class="icon">&#128711;</span> Dashboard</a></li>
		<li>
			<a href="category.php"><span class="icon">&#128196;</span> Category</a>	
		</li>
		<li>
			<a href="bonus-card.php"><span class="icon">&#128196;</span> Bonus Card</a>	
		</li>
		<li>
			<a href="web-card.php"><span class="icon">&#128196;</span> Web Card</a>	
		</li>
		<li>
			<a href="sadari.php"><span class="icon">&#127748;</span> sadari </a>
		</li>
		<li>
			<a href="files.php"><span class="icon">&#127748;</span> Slider</a>
		</li>
		<li>
			<a href="notice.php"><span class="icon">&#127748;</span> Notice </a>
		</li>
		<li>
			<a href="blog-new.php"><span class="icon">&#59160;</span> Blog</a>
		</li>
		<li>
			<a href="complaint.php"><span class="icon">&#59157;</span> Complaints </a>
		</li>
		<li>
			<a href=""><span class="icon">&#59160;</span> Comment Section</a>
			<ul class="submenu">
				<li><a href="comments-timeline-sport.php">Sports Comments</a></li>
				<li><a href="comments-timeline-sadari.php">Sadari Comments</a></li>
				<li><a href="comments-timeline-bonus.php">Bonus Comments</a></li>
				<li><a href="comments-timeline-news.php">News & Blog Comments</a></li>
			</ul>
		</li>
		<!-- <li><a href="statistics.html"><span class="icon">&#128202;</span> Statistics</a></li> -->
		<li><a href="users.php"><span class="icon">&#128101;</span> Users </a></li>
	</ul>
</nav>

<?php
}else{
	$Common->redirect('index.php');
}
?>