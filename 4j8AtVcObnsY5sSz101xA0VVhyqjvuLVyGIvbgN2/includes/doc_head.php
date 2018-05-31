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
$updatecount = $User->query("SELECT COUNT(`id`) AS `CNT` FROM `tblLevelUp` WHERE `isVerified` = 'P'");
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
	<link rel="stylesheet" href="css/new-style.css" media="all" />

	<link rel="stylesheet" href="css/chosen.css" media="all" />

	<link rel="stylesheet" href="../assets/css/jquery.rateyo.min.css"/>
	<link rel="stylesheet" href="../assets/css/editor-text.css"/>
	
	<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
	<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css">
	<link href="../libs/fancybox/jquery.fancybox.css">

	<!-- <link rel="stylesheet" href="../assets/css/bootstrap.min.css" media="all" /> -->

	<!--[if IE]><link rel="stylesheet" href="css/ie.css" media="all" /><![endif]-->

	<!--[if lt IE 9]><link rel="stylesheet" href="css/lt-ie-9.css" media="all" /><![endif]-->


	<style type="text/css">
		span.icon {
		    font-family: "entypo";
		    color: white;
		    font-size: 40px;
		    display: inline-block;
		    width: 65px;
		    height: 40px;
		    line-height: 13px;
		    text-align: center;
		}
		nav ul li a{
			padding: 0px;
		}
	</style>

</head>

<body>

<div class="">

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

			<a href="#">Notifications <span class="pip notificationCount">4</span></a>

			<ul class="notice">

				

			</ul>

		</span> 

		<a href="lib/filemanager/dialog.php?type=1" data-fancybox-type="iframe" target="_blank"><span class="button">Files</span></a>
		<a href="chatResponse.php" target="_blank"><span class="button">Chat</span></a>

		<a href="../index.php"><span class="button">Live</span></a>

		 <span class="button blue"><a href="index.php?logout=logout">Logout</a></span>

	</div>

</section>

</div>

<nav style="overflow-y:scroll;overflow-x:hidden;">

	<ul>

		<li class="<?php if($activeNavigation == "dashboard"){ echo "section"; }?>"><a href="index.php"><span class="icon">&#128711;</span> Dashboard</a></li>

		<li class=" <?php if( $activeNavigation == "category"){ echo "section"; }?>">

			<a href="category.php"><span class="icon">&#59273;</span> Category</a>	

		</li>

		<li class="<?php if($activeNavigation == "bonus"){ echo "section"; }?>">

			<a href="bonus-card.php"><span class="icon">&#59190;</span> Bonus Card</a>	

		</li>

		<li class="<?php if($activeNavigation == "sports"){ echo "section"; }?>">

			<a href="web-card.php"><span class="icon">&#128196;</span> Web Card</a>	

		</li>

		<li class="<?php if($activeNavigation == "sadari"){ echo "section"; }?>">

			<a href="sadari.php"><span class="icon">&#127748;</span> sadari </a>

		</li>

		<li class="<?php if($activeNavigation == "slider"){ echo "section"; }?>">

			<a href="files.php"><span class="icon">&#127916;</span> Slider</a>

		</li>

		<li class="<?php if($activeNavigation == "ads"){ echo "section"; }?>">

			<a href="addadvert.php"><span class="icon">&#127748;</span> Ads</a>

		</li>

		<li class="<?php if($activeNavigation == "notice"){ echo "section"; }?>">

			<a href="notice.php"><span class="icon">&#128266;</span> Notice </a>

		</li>

		<li class="<?php if($activeNavigation == "blog"){ echo "section"; }?>">

			<a href="blog-new.php"><span class="icon">&#59392;</span> Blog</a>

		</li>

		<li class="<?php if($activeNavigation == "complaint"){ echo "section"; }?>">

			<a href="complaint.php"><span class="icon">&#128214;</span> Complaints </a>

		</li>

		<li class="<?php if($activeNavigation == "complaint-text"){ echo "section"; }?>">

			<a href="complaint-text.php"><span class="icon">&#9000;</span> Complaints Text </a>

		</li>

		<!--<li class="<?php if($activeNavigation == "comment"){ echo "section"; }?>">

			<a href=""><span class="icon">&#59160;</span> Comment Section</a>

			<ul class="submenu">

				<li><a href="comments-timeline-sport.php">Sports Comments</a></li>

				<li><a href="comments-timeline-sadari.php">Sadari Comments</a></li>

				<li><a href="comments-timeline-bonus.php">Bonus Comments</a></li>

				<li><a href="comments-timeline-news.php">News & Blog Comments</a></li>

			</ul>

		</li>-->
		<li class="">
			<a href="comments-timeline-sport.php"><span class="icon">&#9998;</span>Sports Comments</a>
		</li>
		<li class="">
			<a href="comments-timeline-bonus.php"><span class="icon">&#9998;</span>Bonus Comments</a>
		</li>
		<li class="">
			<a href="comments-timeline-news.php"><span class="icon">&#9998;</span>News & Blog Comments</a>
		</li>


		<!-- <li><a href="statistics.html"><span class="icon">&#128202;</span> Statistics</a></li> -->
		<li class="<?php if($activeNavigation == "tags"){ echo "section"; }?>">
			<a href="tag.php"><span class="icon">&#59148;</span> Tags </a>
		</li>
		<li class="<?php if($activeNavigation == "users"){ echo "section"; }?>"><a href="users.php"><span class="icon">&#128100;</span> Users </a></li>
		<li class="<?php if($activeNavigation == "userslevel"){ echo "section"; }?>"><a href="user-levelup.php"><span class="icon">&#128100;</span> Users level up <span class="pip custom-pip"><?php echo $updatecount[0]['CNT']; ?></span></a></li>

	</ul>

</nav>
<?php require_once('message.php'); ?>


<?php

}else{

	$Common->redirect('index.php');

}

?>