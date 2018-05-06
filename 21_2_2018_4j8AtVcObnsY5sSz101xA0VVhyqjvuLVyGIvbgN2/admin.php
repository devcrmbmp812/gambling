<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Admin</title>

    <!-- Bootstrap Core CSS -->
    <link href="../assets/css/bootstrap.css" rel="stylesheet">
	<link href="../assets/css/bootstrap.min.css" rel="stylesheet">
	<link href="../assets/css/font-awesome.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="../assets/css/admin-style.css" rel="stylesheet">
	<link href="../assets/css/custom.css" rel="stylesheet">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>
	<div class=""><!-- main -->
		<div id="wrapper">

			<!-- Sidebar -->
			<div id="sidebar-wrapper">
				<ul class="sidebar-nav">
					<li class="sidebar-brand">
						<a href="#">
							Start Bootstrap
						</a>
					</li>
					<li>
						<a href="#">Dashboard</a>
					</li>
					<li>
						<a href="#">Account</a>
					</li>
				</ul>
			</div><!-- /#sidebar-wrapper -->

			<!-- Page Content -->
			<div id="page-content-wrapper">
				<div class="container-fluid">
					<div class="row">
						<div class="col-lg-12">
							<a href="#menu-toggle" class="btn btn-default" id="menu-toggle">Toggle Menu</a>
						</div>
					</div>
				</div><!-- container-fluid -->
				<div class="container-fluid ask-admin-content-container">
					<h3 class="text-uppercase">recommanded</h3>
					<div class="ask-admin-content">
						<div class="row">
							<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
								<form action="" method="" enctype="multipart/form-data" class="form-horizontal" role="form">
									<div class="form-group">
										<label class="control-label col-sm-3" for="webName">Website Name:</label>
										<div class="col-sm-9">
											<input type="text" class="form-control" id="webName" placeholder="Website Name">
										</div>
									</div>
									<div class="form-group">
										<label class="control-label col-sm-3" for="link">Link:</label>
										<div class="col-sm-9">
										  <input type="text" class="form-control" id="link" placeholder="Link">
										</div>
									</div>
									<div class="form-group">
										<div class="col-sm-offset-3 col-sm-10">
										  <button type="submit" class="btn btn-ask">Submit</button>
										</div>
									</div>
								</form>
							</div>
							<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
								<h2>Striped Rows</h2>
								<div class="ask-table-container">
									<table class="table table-striped ask-table">
										<thead>
											<tr>
												<th>Image</th>
												<th>Name</th>
												<th>Url</th>
												<th>Jo-Code</th>
												<th>Action</th>
											</tr>
										</thead>
										<tbody>
											<tr>
												<td>John</td>
												<td>Doe</td>
												<td>john@example.com</td>
												<td>Doe</td>
												<td>
													<a href=""></a>
													<a href=""></a>
												</td>
											</tr>
											<tr>
												<td>Mary</td>
												<td>Moe</td>
												<td>mary@example.com</td>
												<td>Doe</td>
												<td>
													<a href=""></a>
													<a href=""></a>
												</td>
											</tr>
											<tr>
												<td>July</td>
												<td>Dooley</td>
												<td>july@example.com</td>
												<td>Doe</td>
												<td>
													<a href=""></a>
													<a href=""></a>
												</td>
											</tr>
										</tbody>
									</table><!-- ask-table -->
								</div><!-- ask-table-container -->
							</div>
						</div>
					</div><!-- ask-admin-content -->
				</div>
			</div><!-- /#page-content-wrapper -->

		</div><!-- /#wrapper -->
	</div><!--main-->
	<!-- <form action="" method="" enctype="multipart/form-data" class="form-horizontal" role="form">
		<div class="form-group">
			<label class="control-label col-sm-2" for="email">Email:</label>
			<div class="col-sm-10">
				<input type="email" class="form-control" id="email" placeholder="Enter email">
			</div>
		</div>
		<div class="form-group">
			<label class="control-label col-sm-2" for="pwd">Password:</label>
			<div class="col-sm-10">
			  <input type="password" class="form-control" id="pwd" placeholder="Enter password">
			</div>
		</div>
		<div class="form-group">
			<div class="col-sm-offset-2 col-sm-10">
			  <button type="submit" class="btn btn-default">Submit</button>
			</div>
		</div>
	</form> -->

    <!-- jQuery -->
	<script src="../assets/js/jquery.min.js"></script>
	<script src="../assets/js/bootstrap.min.js"></script>

    <!-- Menu Toggle Script -->
    <script>
    $("#menu-toggle").click(function(e) {
        e.preventDefault();
        $("#wrapper").toggleClass("toggled");
    });
    </script>

</body>

</html>
