<?php
include 'connection.php';
session_start();
if (isset($_SESSION['loggedin']) && $_SESSION['type'] == 'trader') {
	header('location:trader.php');
} else if (isset($_SESSION['loggedin']) && $_SESSION['type'] == 'admin') {
	header('location:admin.php');
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
	<title>CFX eShop</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<link href="https://fonts.googleapis.com/css?family=Poppins:200,300,400,500,600,700,800&display=swap" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Lora:400,400i,700,700i&display=swap" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Amatic+SC:400,700&display=swap" rel="stylesheet">

	<link rel="stylesheet" href="css/open-iconic-bootstrap.min.css">
	<link rel="stylesheet" href="css/animate.css">

	<link rel="stylesheet" href="css/owl.carousel.min.css">
	<link rel="stylesheet" href="css/owl.theme.default.min.css">
	<link rel="stylesheet" href="css/magnific-popup.css">

	<link rel="stylesheet" href="css/aos.css">

	<link rel="stylesheet" href="css/ionicons.min.css">

	<link rel="stylesheet" href="css/bootstrap-datepicker.css">
	<link rel="stylesheet" href="css/jquery.timepicker.css">


	<link rel="stylesheet" href="css/flaticon.css">
	<link rel="stylesheet" href="css/icomoon.css">
	<link rel="stylesheet" href="css/style.css">
</head>

<body class="goto-here">

	<div id="myModal" class="modal fade" role="dialog">
		<div class="modal-dialog">
			<!-- Modal content-->
			<div class="modal-content modal-dialog">
				<div class="modal-header">
					<h5 class="modal-title">
						<div class="nav nav-tabs" id="nav-tab" role="tablist">
							<a class="nav-item nav-link active" id="nav-login-tab" data-toggle="tab" href="#nav-login" role="tab" aria-controls="nav-login" aria-selected="true">Login</a>

							<a class="nav-item nav-link" id="nav-register-tab" data-toggle="tab" href="#nav-register" role="tab" aria-controls="nav-register" aria-selected="false">Register</a>

						</div>
					</h5><button type="button" class="close" data-dismiss="modal">&times;</button>
				</div>
				<div class="modal-body">
					<div class="tab-content" id="nav-tabContent">
						<div class="tab-pane fade show active" id="nav-login" role="tabpanel" aria-labelledby="nav-login-tab">
							<form class="bg-white p-3 login-form" id="loginForm">
								<div class="form-group">
									<label for="emailId">Email address</label>
									<input id="emailId" name="emailId" type="text" class="form-control validate" placeholder="Enter email" required>
								</div>
								<div class="form-group">
									<label for="password">Password</label>
									<input id="password" name="password" type="password" class="form-control validate" placeholder="Password" required>
								</div>
								<div class="form-group">
									<input type="submit" id="loginBtn" value="Login" class="btn btn-primary py-2 px-5">
									<label class="offset-2"><a href="#">Forgot password?</a></label>
								</div>

							</form>
						</div>

						<div class="tab-pane fade" id="nav-register" role="tabpanel" aria-labelledby="nav-register-tab">
							<form class="bg-white p-3 register-form" id="registerForm" action="" method="post">
								<div class="form-row mb-3">
									<div class="col-md-6 col-sm-12">
										<label for="first_name">First Name</label>
										<input id="first_name" type="text" class="form-control validate" maxlength="25" name="first_name" required>
									</div>
									<div class="col-md-6 col-sm-12">
										<label for="last_name">Last Name</label>
										<input id="last_name" type="text" class="form-control validate" maxlength="25" name="last_name" required>
									</div>
								</div>
								<div class="form-row mb-3">
									<div class="col-12">
										<label for="registerEmail">Email</label>
										<input id="registerEmail" type="text" class="form-control validate" maxlength="40" name="registerEmail" required>
									</div>
								</div>
								<div class="form-row mb-3">
									<div class="col-6">
										<label for="username">Username</label>
										<input id="username" type="text" class="form-control validate" maxlength="25" minlength="6" name="username" required>
									</div>
									<div class="col-6">
										<label for="registerPassword">Password</label>
										<input id="registerPassword" type="password" class="form-control validate" maxlength="20" minlength="6" name="registerPassword" required>
									</div>
								</div>
								<div class="form-row mb-3">
									<div class="col-6">
										<label for="phone">Phone Number</label>
										<input id="phone" maxlength="12" type="tel" pattern="[0-9]{3}-[0-9]{3}-[0-9]{4}" placeholder="123-456-7890" class="form-control validate" data-length="20" name="phone" required>
									</div>
									<div class="col-6">
										<label for="age" class="ml-2">Age</label>
										<input type="range" class="custom-range col-10 ml-2" value="20" name="age" id="age" min="16" max="100" onchange="updateAge(this.value)" />
										<span id="ageValue" class="offset-10">20</span>
									</div>
								</div>
								<div class="form-row mb-3">
									<div class="col-12 custom-control custom-checkbox">
										<input type="checkbox" class="form-control custom-control-input" id="conditions" required name="terms" />
										<label class="custom-control-label" for="conditions">I agree to the terms and
											conditions.</label>
									</div>
								</div>
								<div class="form-row mb-3">
									<button class="btn btn-primary col s12 z-depth-0" id="registerBtn" type="submit">Register
									</button>
								</div>
							</form>
						</div>
					</div>
					<div id="registering">

					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
				</div>
			</div>
		</div>
	</div>


	<div class="py-1 bg-primary">
		<div class="container">
			<div class="row no-gutters d-flex align-items-start align-items-center px-md-0">
				<div class="col-lg-12 d-block">
					<div class="row d-flex">
						<div class="col-md pr-4 d-flex topper align-items-center">
							<div class="icon mr-2 d-flex justify-content-center align-items-center"><span class="icon-phone2"></span></div>
							<span class="text">+ 1235 2355 98</span>
						</div>
						<div class="col-md pr-4 d-flex topper align-items-center">
							<div class="icon mr-2 d-flex justify-content-center align-items-center"><span class="icon-paper-plane"></span></div>
							<span class="text">eshop@cfx.com</span>
						</div>
						<div class="col-md-5 pr-4 d-flex topper align-items-center text-lg-right">
							<span class="text">3-5 Business days &amp; Free Returns</span>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<nav class="navbar navbar-expand-lg navbar-dark ftco_navbar bg-dark ftco-navbar-light" id="ftco-navbar">
		<div class="container">
			<a class="navbar-brand" href="index.php">CFX eShop</a>
			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#ftco-nav" aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
				<span class="oi oi-menu"></span> Menu
			</button>

			<div class="collapse navbar-collapse" id="ftco-nav">
				<ul class="navbar-nav ml-auto">
					<li class="nav-item"><a href="index.php" class="nav-link">Home</a></li>
					<li class="nav-item active"><a class="nav-link" href="shop.php">Shop</a></li>
					<li class="nav-item"><a href="about.php" class="nav-link">About</a></li>
					<li class="nav-item"><a href="contact.php" class="nav-link">Contact</a></li>
					<?php
					if (isset($_SESSION['loggedin']) && $_SESSION['loggedin']) {
						echo '<li class="nav-item"><a href="dashboard.php" class="nav-link">Profile</a></li><li class="nav-item cta cta-colored"><a href="cart.php" class="nav-link">
						<span class="icon-shopping_cart" id="products-cart"></span>[0]</a></li>
						<li class="nav-item btn-nav"><a class="nav-link" href="logout.php">LOGOUT</a></li>';
					} else {
						echo '<li class="nav-item btn-nav"><a class="nav-link" data-toggle="modal" data-target="#myModal">LOGIN</a></li>';
					} ?>
				</ul>
			</div>
		</div>
	</nav>
	<!-- END nav -->

	<div class="hero-wrap hero-bread" style="background-image: url('images/bg_1.jpg');">
		<div class="container">
			<div class="row no-gutters slider-text align-items-center justify-content-center">
				<div class="col-md-9 ftco-animate text-center">
					<p class="breadcrumbs"><span class="mr-2"><a href="index.php">Home</a></span> <span>Shop</span>
					</p>
					<h1 class="mb-0 bread">Products</h1>
				</div>
			</div>
		</div>
	</div>

	<section class="ftco-section">
		<div class="container">
			<div class="row justify-content-center align-items-center mb-5">
				<div class="col-md-10 text-center">
					<ul class="product-category">
						<li><a href="" id="0" class="filter-cat">All</a></li>
						<?php
						$query = oci_parse($conn, "SELECT * FROM CATEGORY");
						oci_execute($query);
						while ($result = oci_fetch_assoc($query)) {
							echo '<li><a href="" class="filter-cat" id="' . $result["CATEGORY_NO"] . '">' . $result["FILTER_NAME"] . '</a></li>';
						}
						if (isset($_SESSION['loggedin'])) { ?>
							<li><a href="" class="filter-cat" id="6">Favorites</a></li>
						<?php } ?>
					</ul>

				</div>
				<div class="col-md-2">
					<select id="sort" name="category" class="form-control validate" required>
						<option value="0" selected>Sort By</option>
						<option value="1">Name A-Z</option>
						<option value="2">Name Z-A</option>
						<option value="3">Price Higher</option>
						<option value="4">Price Lower</option>
					</select>
				</div>
			</div>
			<div id="products"></div>
		</div>
	</section>

	<section class="ftco-section ftco-no-pt ftco-no-pb py-5 bg-light">
		<div class="container py-4">
			<div class="row d-flex justify-content-center py-5">
				<div class="col-md-6">
					<h2 style="font-size: 22px;" class="mb-0">Subcribe to our Newsletter</h2>
					<span>Get e-mail updates about our latest shops and special offers</span>
				</div>
				<div class="col-md-6 d-flex align-items-center">
					<form action="#" class="subscribe-form">
						<div class="form-group d-flex">
							<input type="text" class="form-control" placeholder="Enter email address">
							<input type="submit" value="Subscribe" class="submit px-3">
						</div>
					</form>
				</div>
			</div>
		</div>
	</section>
	<footer class="ftco-footer ftco-section">
		<div class="container">
			<div class="row">
				<div class="mouse">
					<a href="#" class="mouse-icon">
						<div class="mouse-wheel"><span class="ion-ios-arrow-up"></span></div>
					</a>
				</div>
			</div>
			<div class="row mb-5">
				<div class="col-md">
					<div class="ftco-footer-widget mb-4">
						<h2 class="ftco-heading-2">Vegefoods</h2>
						<p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia.</p>
						<ul class="ftco-footer-social list-unstyled float-md-left float-lft mt-5">
							<li class="ftco-animate"><a href="#"><span class="icon-twitter"></span></a></li>
							<li class="ftco-animate"><a href="#"><span class="icon-facebook"></span></a></li>
							<li class="ftco-animate"><a href="#"><span class="icon-instagram"></span></a></li>
						</ul>
					</div>
				</div>
				<div class="col-md">
					<div class="ftco-footer-widget mb-4 ml-md-5">
						<h2 class="ftco-heading-2">Menu</h2>
						<ul class="list-unstyled">
							<li><a href="#" class="py-2 d-block">Shop</a></li>
							<li><a href="#" class="py-2 d-block">About</a></li>
							<li><a href="#" class="py-2 d-block">Journal</a></li>
							<li><a href="#" class="py-2 d-block">Contact Us</a></li>
						</ul>
					</div>
				</div>
				<div class="col-md-4">
					<div class="ftco-footer-widget mb-4">
						<h2 class="ftco-heading-2">Help</h2>
						<div class="d-flex">
							<ul class="list-unstyled mr-l-5 pr-l-3 mr-4">
								<li><a href="#" class="py-2 d-block">Shipping Information</a></li>
								<li><a href="#" class="py-2 d-block">Returns &amp; Exchange</a></li>
								<li><a href="#" class="py-2 d-block">Terms &amp; Conditions</a></li>
								<li><a href="#" class="py-2 d-block">Privacy Policy</a></li>
							</ul>
							<ul class="list-unstyled">
								<li><a href="#" class="py-2 d-block">FAQs</a></li>
								<li><a href="#" class="py-2 d-block">Contact</a></li>
							</ul>
						</div>
					</div>
				</div>
				<div class="col-md">
					<div class="ftco-footer-widget mb-4">
						<h2 class="ftco-heading-2">Have a Questions?</h2>
						<div class="block-23 mb-3">
							<ul>
								<li><span class="icon icon-map-marker"></span><span class="text">11 Avenue Street,
										Cleckshudderfax, UK</span></li>
								<li><a href="#"><span class="icon icon-phone"></span><span class="text">+2 392 3929
											210</span></a></li>
								<li><a href="#"><span class="icon icon-envelope"></span><span class="text">info@cfx.com</span></a></li>
							</ul>
						</div>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12 text-center">

					<p> Copyright &copy;2020 All rights reserved
					</p>
				</div>
			</div>
		</div>
	</footer>



	<!-- loader -->
	<div id="ftco-loader" class="show fullscreen"><svg class="circular" width="48px" height="48px">
			<circle class="path-bg" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke="#eeeeee" />
			<circle class="path" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke-miterlimit="10" stroke="#F96D00" /></svg></div>


	<script src="js/jquery.min.js"></script>
	<script src="js/jquery-migrate-3.0.1.min.js"></script>
	<script src="js/popper.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/jquery.easing.1.3.js"></script>
	<script src="js/jquery.waypoints.min.js"></script>
	<script src="js/jquery.stellar.min.js"></script>
	<script src="js/owl.carousel.min.js"></script>
	<script src="js/jquery.magnific-popup.min.js"></script>
	<script src="js/aos.js"></script>
	<script src="js/jquery.animateNumber.min.js"></script>
	<script src="js/bootstrap-datepicker.js"></script>
	<script src="js/scrollax.min.js"></script>
	<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBVWaKrjvy3MaE7SQ74_uJiULgl1JY0H2s&sensor=false"></script>
	<script src="js/google-map.js"></script>
	<script src="js/main.js"></script>

</body>

</html>