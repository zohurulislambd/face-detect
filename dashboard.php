<?php
include("include\db\connection.php");
include("isLoggedIn.php");
$userId = $_SESSION["UID"];
$name = '';
$picture ='';
$userInfo = mysqli_query($conn, "SELECT * FROM hackathon_users WHERE id='".$userId."'");
if (mysqli_num_rows($userInfo) > 0){
    $rowSelected   = mysqli_num_rows($userInfo);
    if ($rowSelected ) {
        while($row = mysqli_fetch_array($userInfo)) {
            $name = $row["name"];
            $picture = $row["password_image"];
            $email = $row["email"];
        }
    }
}
?>

<!doctype html>
<html lang="en" dir="ltr">
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<link rel="icon" href="favicon.ico" type="image/x-icon"/>


		<!-- Title -->
		<title>Unique Face Detection</title>
		<link rel="stylesheet" href="assets/css/font-awesome.min.css">

		<!-- Font Family-->
		<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800" rel="stylesheet">

		<!-- Dashboard Css -->

		<link href="assets/css/dashboard.css" rel="stylesheet" />

		<!-- Custom scroll bar css-->
		<link href="assets/plugins/scroll-bar/jquery.mCustomScrollbar.css" rel="stylesheet" />

		<!-- Sidemenu Css -->
		<link href="assets/plugins/toggle-sidebar/css/sidemenu.css" rel="stylesheet">

		<!-- c3.js Charts Plugin -->
		<link href="assets/plugins/charts-c3/c3-chart.css" rel="stylesheet" />
		<link href="assets/plugins/morris/morris.css" rel="stylesheet" />

		<!---Font icons-->
		<link href="assets/plugins/iconfonts/plugin.css" rel="stylesheet" />
	</head>
	<body class="app sidebar-mini rtl">
		<div id="global-loader" ></div>
		<div class="page">
			<div class="page-main">
				<!-- Navbar-->
				<header class="app-header header">

					<!-- Sidebar toggle button-->
					<!-- Navbar Right Menu-->
					<div class="container-fluid">
						<div class="d-flex">
							<a class="header-brand" href="#">
								<img alt="vobilet logo" class="header-brand-img" src="assets/images/brand/logo.png">
							</a>
							<a aria-label="Hide Sidebar" class="app-sidebar__toggle" data-toggle="sidebar" href="#"></a>
							<div class="d-flex order-lg-2 ml-auto">
								<div class="">
									<form class="input-icon mt-2 mr-2">
										<input class="form-control header-search" placeholder="Search&hellip;" tabindex="1" type="search">
										<div class="input-icon-addon">
											<i class="fe fe-search"></i>
										</div>
									</form>
								</div>
								<!--<div class="dropdown d-none d-md-flex">
									<a class="nav-link icon" data-toggle="dropdown">
										<i class="fa fa-user-o"></i>
										<span class="nav-unread bg-green"></span>
									</a>
								</div>-->

								<div class="dropdown">
									<a class="nav-link pr-0 leading-none d-flex" data-toggle="dropdown" href="#">
<!--										<span class="avatar avatar-md brround" style="background-image: url(assets/images/faces/female/25.jpg)"></span>-->
										<span><img src="<?php echo $picture; ?>" alt="Photo" style="width:50px; height: 50px; border-radius: 50%"></span>
                                        <span class="ml-2 d-none d-lg-block">
											<span class="text-white"><?php echo $name ?></span>
										</span>
									</a>
									<div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
										<div class="dropdown-divider"></div>
										<a class="dropdown-item" href="#"><i class="dropdown-icon mdi mdi-compass-outline"></i> Need help?</a>
										<a class="dropdown-item" href="logout.php"><i class="dropdown-icon mdi mdi-logout-variant"></i> Sign out</a>
									</div>
								</div>
							</div>
						</div>
					</div>
				</header>

				<!-- Sidebar menu-->
				<div class="app-sidebar__overlay" data-toggle="sidebar"></div>
				<aside class="app-sidebar">
					<div class="app-sidebar__user">
						<div class="dropdown">
							<a class="nav-link p-0 leading-none d-flex" data-toggle="dropdown" href="#">
                                <span><img src="<?php echo $picture; ?>" alt="Photo"></span>
								<span class="ml-2 "><span class="text-white app-sidebar__user-name font-weight-semibold"><?php echo $name ?></span><br>
									<span class="text-muted app-sidebar__user-name text-sm">Web Developer</span>
								</span>
							</a>
							<div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
								<a class="dropdown-item" href="#"><i class="dropdown-icon mdi mdi-account-outline"></i> Profile</a>
								<a class="dropdown-item" href="logout.php"><i class="dropdown-icon mdi mdi-logout-variant"></i> Sign out</a>
							</div>
						</div>
					</div>
					<ul class="side-menu">
						<li class="slide">
							<a class="side-menu__item active" data-toggle="slide" href="#"><i class="side-menu__icon fa fa-home"></i><span class="side-menu__label">DASHBOARD</span><i class="angle fa fa-angle-right"></i></a>
							<ul class="slide-menu">
								<li><a class="slide-item" href="#">Home 1</a></li>
								<li><a class="slide-item" href="#">Home 2</a></li>
								<li><a class="slide-item" href="#">Home 3</a></li>
								<li><a class="slide-item" href="#">Home 4</a></li>
								<li><a class="slide-item" href="#">Home 5</a></li>
						</li>
						<li>
							<a class="side-menu__item" href="#"><i class="side-menu__icon fa fa-window-restore"></i><span class="side-menu__label">Widgets</span></a>
						</li>
					
					</ul>
				</aside>
				<div class="app-content my-3 my-md-5">
					<div class="side-app">
						<div class="page-header">
							<h4 class="page-title">Dashboard</h4>
							<ol class="breadcrumb">
								<li class="breadcrumb-item"><a href="#">Home</a></li>
								<li class="breadcrumb-item active" aria-current="page">Dashboard</li>
							</ol>
						</div>
                        <hr>

<!--                        main section-->
                        <div class = "content">
                            <h3><?php echo "Welcome <span style='color: #0b7ec4'>$name</span> to the wonderful world of <em>UFO</em>. With advanced features of activating account and new login widgets, you will definitely have a great experience of using <em>UFO</em>."; ?></h3>
                            <!--<div> <a id="wer" href="similar.php" class="similar-dashboard">Similar Faces</a></div>-->
<!--                            <div><a id="logout_btn" href="logout.php">LogOut</a></div>-->
                            <table class="table table-responsive table-bordered">
                                <tr>
                                    <td>NAME</td><td><?php echo $name ?></td>
                                </tr>
                                <tr>
                                    <td>EMAIL</td><td><?php echo $email ?></td>
                                </tr>
                                <tr>
                                    <td>PICTURE</td><td><img src="<?php echo $picture; ?>" width="150px"/> </td>
                                </tr>
                                <table>
                        </div>


                        <br>
                        <br>
                        <br>
						<div class="row row-cards">
							<div class="col-sm-12 col-md-6 col-lg-3">
								<div class="card ">
									<div class="card-body">
										<div class="row">
											<div class="col">
												<div class="text-muted">App Views</div>
												<div class="h3 m-0"><b>897</b></div>
											</div>
											<div class="col-auto align-self-center ">
												<div class="chart-circle chart-circle-xs" data-value="0.65" data-thickness="6" data-color="#c21a1a"></div>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="col-sm-12 col-md-6 col-lg-3">
								<div class="card ">
									<div class="card-body">
										<div class="row">
											<div class="col">
												<div class="text-muted">Our Customers</div>
												<div class="h3 m-0"><b>125</b></div>
											</div>
											<div class="col-auto align-self-center">
												<div class="chart-circle chart-circle-xs" data-value="0.68" data-thickness="6" data-color="#867efc"></div>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="col-sm-12 col-md-6 col-lg-3">
								<div class="card ">
									<div class="card-body">
										<div class="row">
											<div class="col">
												<div class="text-muted">Company Profit</div>
												<div class="h3 m-0"><b>2056</b></div>
											</div>
											<div class="col-auto align-self-center">
												<div class="chart-circle chart-circle-xs" data-value="0.80" data-thickness="6" data-color="#ffcc29"></div>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="col-sm-12 col-md-6 col-lg-3">
								<div class="card ">
									<div class="card-body">
										<div class="row">
											<div class="col">
												<div class="text-muted">Business Sales</div>
												<div class="h3 m-0"><b>567</b></div>
											</div>
											<div class="col-auto align-self-center">
												<div class="chart-circle chart-circle-xs" data-value="0.42" data-thickness="6" data-color="#4ecc48"></div>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="col-sm-12">
								<div class="card ">
									<div class="card-body">
										<div id="chart-area-spline2" class="chart-visitors"></div>
									</div>
								</div>
							</div>
						</div>

						<div class="row">
							<div class="col-sm-6 col-lg-3">
								<div class="card p-3">
									<div class="d-flex align-items-center">
										<span class="stamp stamp-md bg-cyan mr-3">
											<i class="fa fa-users"></i>
										</span>
										<div>
											<h4 class="m-0"><a href="javascript:void(0)"><strong>765</strong> <small>Customers</small></a></h4>
											<small class="text-muted">13 new customers </small>
										</div>
									</div>
								</div>
							</div>
							<div class="col-sm-6 col-lg-3">
								<div class="card p-3">
									<div class="d-flex align-items-center">
										<span class="stamp stamp-md bg-orange mr-3">
											<i class="fa fa-cart-arrow-down"></i>
										</span>
										<div>
											<h4 class="m-0"><a href="javascript:void(0)"><strong>92</strong> <small>Selling</small></a></h4>
											<small class="text-muted">67 deliverd</small>
										</div>
									</div>
								</div>
							</div>
							<div class="col-sm-6 col-lg-3">
								<div class="card p-3">
									<div class="d-flex align-items-center">
										<span class="stamp stamp-md bg-teal mr-3">
											<i class="fa fa-eye"></i>
										</span>
										<div>
											<h4 class="m-0"><a href="javascript:void(0)"><strong>2,456 </strong><small>Visitors</small></a></h4>
											<small class="text-muted">281 sign in</small>
										</div>
									</div>
								</div>
							</div>
							<div class="col-sm-6 col-lg-3">
								<div class="card p-3">
									<div class="d-flex align-items-center">
										<span class="stamp stamp-md bg-indigo mr-3">
											<i class="fa fa-file-text"></i>
										</span>
										<div>
											<h4 class="m-0"><a href="javascript:void(0)"><strong>125 </strong><small>FeedBack</small></a></h4>
											<small class="text-muted">32 Pending</small>
										</div>
									</div>
								</div>
							</div>
							<div class="col-lg-6 col-md-12">
								<div class="card">
									<div class="card-header">
										<h3 class="card-title">Facebook Source </h3>
									</div>
									<div class="card-body">
										<div class="current-progress">
											<div class="progress-content">
												<div class="row">
													<div class="col-lg-4 mt-2">
														<div class="progress-text">Page Profile</div>
													</div>
													<div class="col-lg-8">
														<div class="current-progressbar">
															<div class="progress progress-md">
																<div class="progress-bar bg-success" style="width: 25%">25%</div>
															</div>
														</div>
													</div>
												</div>
											</div>
											<div class="progress-content">
												<div class="row">
													<div class="col-lg-4 mt-2">
														<div class="progress-text">Favorite</div>
													</div>
													<div class="col-lg-8">
														<div class="current-progressbar">
															<div class="progress progress-md">
																<div class="progress-bar bg-primary" style="width: 47%">47%</div>
															</div>
														</div>
													</div>
												</div>
											</div>
											<div class="progress-content">
												<div class="row">
													<div class="col-lg-4 mt-2">
														<div class="progress-text">Like Story</div>
													</div>
													<div class="col-lg-8">
														<div class="current-progressbar">
															<div class="progress progress-md">
																<div class="progress-bar bg-danger" style="width: 55%"> 55%</div>
															</div>
														</div>
													</div>
												</div>
											</div>
											<div class="progress-content">
												<div class="row">
													<div class="col-lg-4 mt-2">
														<div class="progress-text">Mobile</div>
													</div>
													<div class="col-lg-8">
														<div class="current-progressbar">
															<div class="progress progress-md">
																<div class="progress-bar bg-secondary" style="width: 67%">67%</div>
															</div>
														</div>
													</div>
												</div>
											</div>
											<div class="progress-content">
												<div class="row">
													<div class="col-lg-4 mt-2">
														<div class="progress-text">Videos</div>
													</div>
													<div class="col-lg-8">
														<div class="current-progressbar">
															<div class="progress progress-md">
																<div class="progress-bar bg-info" style="width: 33%">33%</div>
															</div>
														</div>
													</div>
												</div>
											</div>
											<div class="progress-content">
												<div class="row">
													<div class="col-lg-4 mt-2">
														<div class="progress-text">Photos</div>
													</div>
													<div class="col-lg-8">
														<div class="current-progressbar">
															<div class="progress progress-md">
																<div class="progress-bar bg-pink" style="width: 78%">78%</div>
															</div>
														</div>
													</div>
												</div>
											</div>
											<div class="progress-content">
												<div class="row">
													<div class="col-lg-4 mt-2">
														<div class="progress-text">Games</div>
													</div>
													<div class="col-lg-8">
														<div class="current-progressbar">
															<div class="progress progress-md">
																<div class="progress-bar bg-teal" style="width: 98%">98%</div>
															</div>
														</div>
													</div>
												</div>
											</div>
											<div class="progress-content">
												<div class="row">
													<div class="col-lg-4 mt-2">
														<div class="progress-text">Shares</div>
													</div>
													<div class="col-lg-8">
														<div class="current-progressbar">
															<div class="progress progress-md">
																<div class="progress-bar bg-cyan" style="width: 55%">55%</div>
															</div>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="col-lg-6 col-md-12">
								<div class="card">
									<div class="card-header">
										<h3 class="card-title">Templates List</h3>
									</div>

								</div>
							</div>
						</div>
						
					</div>
					<footer class="footer">
						<div class="container">
							<div class="row align-items-center flex-row-reverse">
								<div class="col-md-12 col-sm-12 mt-3 mt-lg-0 text-center">
									Copyright © 2019 <a href="#">BU-CSE</a>. Designed & Develop by <a href="#">Zohurul & Naeem</a> All rights reserved.
								</div>
							</div>
						</div>
					</footer>
				</div>
			</div>
		</div>

		<!-- Back to top -->
		<a href="index.html#top" id="back-to-top" style="display: inline;"><i class="fa fa-angle-up"></i></a>

		<!-- Dashboard Core -->
		<script src="assets/js/vendors/jquery-3.2.1.min.js"></script>
		<script src="assets/js/vendors/bootstrap.bundle.min.js"></script>
		<script src="assets/js/vendors/jquery.sparkline.min.js"></script>
		<script src="assets/js/vendors/selectize.min.js"></script>
		<script src="assets/js/vendors/jquery.tablesorter.min.js"></script>
		<script src="assets/js/vendors/circle-progress.min.js"></script>
		<script src="assets/plugins/rating/jquery.rating-stars.js"></script>
		<!-- Side menu js -->
		<script src="assets/plugins/toggle-sidebar/js/sidemenu.js"></script>

		<!-- Custom scroll bar Js-->
		<script src="assets/plugins/scroll-bar/jquery.mCustomScrollbar.concat.min.js"></script>

		<!-- c3.js Charts Plugin -->
		<script src="assets/plugins/charts-c3/d3.v5.min.js"></script>
		<script src="assets/plugins/charts-c3/c3-chart.js"></script>

		<!-- Input Mask Plugin -->
		<script src="assets/plugins/input-mask/jquery.mask.min.js"></script>

        <!-- Index Scripts -->
		<script src="assets/js/index.js"></script>
		<script src="assets/js/charts.js"></script>

		<!-- custom js -->
		<script src="assets/js/custom.js"></script>

	</body>
</html>