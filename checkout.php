<?php
include 'connection.php';
session_start();

if (isset($_SESSION['loggedin']) && $_SESSION['loggedin']) {
	if ($_SESSION['type'] == 'trader') {
		header('location:trader.php');
	}
	$cart = $_SESSION['cartId'];
	$query = oci_parse($conn, "BEGIN :count := num_products('{$cart}'); END;");
	oci_bind_by_name($query, ":count", $count);
	oci_execute($query);

	if ($count == 0)
		header('location:shop.php');
	$query = oci_parse($conn, "BEGIN get_slots(); END;");
	oci_execute($query);

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
	<div class="alert alert-success p-4 hidden" style="position:absolute;top:40%;left:50%;transform: translate(-50%, -50%);z-index:1000" role="alert">
		<h4 class="alert-heading">Congratulation!</h4>
		<p style="font-size: large;"> Your order has been placed. Please be sure to pick it up on your chosen collection time.<br>Click <a href="dashboard.php">here</a> to view your orders or return to the <a href="shop.php">Shop.</a></p>
		<hr>
		<p style="font-size: large;">A receipt of the transaction has been emailed to you.</p>
	</div>

	<body class="goto-here">
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
				<a class="navbar-brand" href="index.php">Vegefoods</a>
				<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#ftco-nav" aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
					<span class="oi oi-menu"></span> Menu
				</button>

				<div class="collapse navbar-collapse" id="ftco-nav">
					<ul class="navbar-nav ml-auto">
						<li class="nav-item"><a href="index.php" class="nav-link">Home</a></li>
						<li class="nav-item"><a class="nav-link" href="shop.php">Shop</a></li>
						<li class="nav-item"><a href="about.php" class="nav-link">About</a></li>
						<li class="nav-item"><a href="contact.php" class="nav-link">Contact</a></li>
						<li class="nav-item"><a href="dashboard.php" class="nav-link">Profile</a></li>
						<li class="nav-item active cta cta-colored"><a href="cart.php" class="nav-link"><span class="icon-shopping_cart"></span>[0]</a></li>
						<li class="nav-item btn-nav"><a href="logout.php" class="nav-link">LOGOUT</a></li>
					</ul>
				</div>
			</div>
		</nav>
		<!-- END nav -->

		<div class="hero-wrap hero-bread" style="background-image: url('images/bg_1.jpg');">
			<div class="container">
				<div class="row no-gutters slider-text align-items-center justify-content-center">
					<div class="col-md-9 ftco-animate text-center">
						<p class="breadcrumbs"><span class="mr-2"><a href="index.php">Home</a></span> <span>Checkout</span>
						</p>
						<h1 class="mb-0 bread">Checkout</h1>
					</div>
				</div>
			</div>
		</div>

		<section class="ftco-section">
			<div class="container">
				<form action="#" id="formBill" class="billing-form">
					<div class="row justify-content-center">
						<div class="col-xl-7 ftco-animate">

							<h3 class="mb-4 billing-heading">Billing Details</h3>
							<div class="row align-items-end">
								<div class="w-100"></div>
								<div class="col-md-6">
									<div class="form-group">
										<label for="inputAddress">Address</label>
										<input type="text" class="form-control validate" id="inputAddress" name="add1" value="<?php echo $_SESSION["add1"]; ?>" placeholder="1234 Main St" required>
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<input type="text" class="form-control" id="inputAddress2" value="<?php echo $_SESSION["add2"]; ?>" placeholder="Apartment, studio, or floor(Optional)">
									</div>
								</div>
								<div class="w-100"></div>
								<div class="col-md-6">
									<div class="form-group">
										<label for="phone">Phone Number</label>
										<input id="phone" maxlength="12" type="tel" disabled pattern="[0-9]{3}-[0-9]{3}-[0-9]{4}" class="form-control" value="<?php echo $_SESSION["phone"] ?>" name="phoneNo">
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label for="updateEmail">Email</label>
										<input type="email" disabled="disabled" value="<?php echo $_SESSION["email"] ?>" class="form-control" id="updateEmail">

									</div>
								</div>
								<div class="w-100"></div>
								<div class="col-md">
									<div class="form-group">
										<label>Collection Time</label>
										<?php
										$query = oci_parse($conn, "SELECT * FROM AVAILABLE_SLOTS");
										oci_execute($query);
										?>
										<select id="slot-day" required class="custom-select validate">
											<?php $x = 0;
											while ($result = oci_fetch_assoc($query)) {
												if ($x = 0)
													echo "<option selected ";
												else
													echo "<option ";
												echo "value='" . $result['SLOT_ID'] . "'>" . $result['START_TIME'] . ":00-" . $result['END_TIME'] . ":00 " . $result['DAY'] . " - " . $result['FULL_DATE'] . "</option>";
											} ?>
										</select>
									</div>
								</div>
								<div class="w-100"></div>
								<div class="col-md-12">
									<div class="form-group mt-4">
										<a href="dashboard.php">Change Phone Number or Email?</a>
									</div>
								</div>

							</div>
							<!-- END -->
						</div>
						<div class="col-xl-5">
							<div class="row mt-5 pt-3">
								<div class="col-md-12 d-flex mb-5">
									<div class="cart-detail cart-total p-3 p-md-4">
										<h3 class="billing-heading mb-4">Cart Total</h3>
										<?php
										$cart = $_SESSION['cartId'];
										$query = oci_parse($conn, "SELECT * FROM CART WHERE CART_ID = '${cart}'");
										oci_execute($query);
										$result = oci_fetch_assoc($query);
										$discount = $result['AMOUNT'] * $result['DISCOUNT'] / 100;
										?>
										<p class="d-flex">
											<span>Subtotal</span>
											<span>$<?= number_format($result['AMOUNT'], 2); ?></span>
										</p>
										<p class="d-flex">
											<span>Discount</span>
											<span>$<?= number_format($discount, 2) ?></span>
										</p>
										<hr>
										<p class="d-flex total-price">
											<span>Total</span>
											<span class="total-price" id="<?= $result['NET_AMOUNT'] ?>">$<?= number_format($result['NET_AMOUNT'], 2) ?></span>
										</p>
									</div>
								</div>

								<div class="col-md-12">
									<div class="cart-detail p-3 p-md-4">
										<h3 class="billing-heading mb-4">Payment Method</h3>
										<div class="form-group">
											<div class="col-md-12">
												<div class="radio">
													<label><input type="radio" disabled name="optradio" class="mr-2"> Cash On Pickup</label>
												</div>
											</div>
										</div>
										<div class="form-group">
											<div class="col-md-12">
												<div class="radio">
													<label><input type="radio" disabled name="optradio" class="mr-2"> Check
														Payment</label>
												</div>
											</div>
										</div>
										<div class="form-group">
											<div class="col-md-12">
												<div class="radio">
													<label><input type="radio" required name="optradio" class="mr-2"> Paypal</label>
												</div>
											</div>
										</div>
										<div class="form-group">
											<div class="col-md-12">
												<div class="checkbox">
													<label><input type="checkbox" value="" class="mr-2 validate" required> I have read and accept
														the terms and conditions</label>
												</div>
											</div>
										</div>
										<p>
											<div id="msg" class="mt-2 mb-4">

											</div>
											<div class="Checksubmit"><input type='submit' class="btn btn-block btn-dark" value="Proceed to Payment">
											</div>
										</p>

									</div>
								</div>
							</div>

						</div> <!-- .col-md-8 -->
					</div>
				</form>
			</div>
		</section> <!-- .section -->

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
		<script src="https://www.paypal.com/sdk/js?client-id=ATzZLdq_nMR3SCYKscJAPQGqasL4TQi6p0i_nQjb-eeWCumq1_kyC3lhkDKozdaxDpZTUCXrh7oXa6TV&currency=USD"></script>
		<script src="js/google-map.js"></script>
		<script src="js/main.js"></script>

		<script>
			var $ = jQuery;

			$('#formBill').submit(function(e) {
				e.preventDefault();
				var add1 = $('#inputAddress').val();
				var add2 = ($('#inputAddress2').val() != "") ? $('#inputaddress2').val() : "";
				$.ajax({
					url: 'verify.php',
					method: 'get',
					data: {
						add1: add1,
						add2: add2,
						payment: 'save'

					},
					success: function(response) {

						$('#msg').html('<div class="toast" data-autohide="false" id="wrong_email"><div class="toast-header"><strong style="color:#82aef6"> Success!</strong><button type="button" class="close" data-dismiss="toast">&times;</button></div><div class="toast-body" style="text-align:left" id="aerror">Information Updated. Checkout Now!</div></div>');
						$('#wrong_email').toast('show');
						$('.Checksubmit').html("<div id='paypal-button-container'></div>");

						paypal.Buttons({
							style: {
								shape: 'rect',
								color: 'black',
								layout: 'horizontal',
								label: 'checkout',

							},
							createOrder: function(data, actions) {
								return actions.order.create({
									purchase_units: [{
										amount: {
											value: total
										}
									}]
								});
							},
							onApprove: function(data, actions) {
								return actions.order.capture().then(function(details) {
									$('body').append('<div class="parentDisable">');
									$('body').css('overflow', 'hidden');
									$("html, body").animate({
										scrollTop: 0
									}, "slow");
									$('.alert').removeClass('hidden');
									sendReceipt();
								});
							}
						}).render('#paypal-button-container');

						$('html, body').animate({
							scrollTop: $(".Checksubmit").offset().top - 500
						}, 2000);
					}
				})
			});

			var total = parseFloat($('span.total-price').attr('id'));

			function sendReceipt() {
				var payment = "done";
				var slot = $('#slot-day option:selected').val();
				$.ajax({
					url: 'reciept.php',
					method: 'post',
					data: {
						payment: payment,
						slot: slot
					},
					success: function(data) {
						if (data != 'OK')
							alert('There was a problem processing the order.');
					}
				});
			}
		</script>


	</body>

	</html>

<?php

} else echo 'You are not allowed to access this page'; ?>