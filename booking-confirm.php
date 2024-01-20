<?php
// Assuming you have a MySQL database connection
include 'connection.php';
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Check if 'id' is set and is a valid integer
$id = $_GET['id'];
if ($id <= 0) {
    // Handle the case when 'id' is not valid
    echo "Invalid ID provided.";
    exit();
}

// Use prepared statement to prevent SQL injection
$sql = "SELECT name, email, contact, address, date, starttime, endtime, adults, children, young_children FROM court WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);



// Check if the statements were prepared successfully
if ($stmt ) {
    // Execute the first statement
    if ($stmt->execute()) {
        // Bind the result variables
        $stmt->bind_result($name, $email, $contact, $address, $appointmentDate, $startTime, $endTime, $adults, $children, $young);

        // Fetch the result
        $stmt->fetch();

        // Check if data was found
        if (!empty($name)) {
        
        } else {
            echo "No data found for the provided ID.";
        }
    } else {
        // Handle the case when the statement execution fails
        echo "Error executing SQL statement: " . $stmt->error;
    }

    // Close the first statement
    $stmt->close();

    // Execute the second statement
}

// Close the database connection
$conn->close();
?>








<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
	<title>Badminton Academy</title>

	<!-- Meta Tags -->
	<meta name="twitter:description" content="Elevate your badminton business with Dream Sports template. Empower coaches & players, optimize court performance and unlock industry-leading success for your brand.">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<meta name="description" content="Elevate your badminton business with Dream Sports template. Empower coaches & players, optimize court performance and unlock industry-leading success for your brand.">
	<meta name="keywords" content="badminton, coaching, event, players, training, courts, tournament, athletes, courts rent, lessons, court booking, stores, sports faqs, leagues, chat, wallet, invoice">
	<meta name="author" content="Dreamguys - Badminton Academy">

	<meta name="twitter:card" content="summary_large_image">
	<meta name="twitter:site" content="@dreamguystech">
	<meta name="twitter:title" content="Badminton Academy -  Booking Coaches, Venue for tournaments, Court Rental template">

	<meta name="twitter:image" content="assets/img/meta-image.jpg">
	<meta name="twitter:image:alt" content="Badminton Academy">

	<meta property="og:url" content="https://Badminton Academy.dreamguystech.com/">
	<meta property="og:title" content="Badminton Academy -  Booking Coaches, Venue for tournaments, Court Rental template">
	<meta property="og:description" content="Elevate your badminton business with Dream Sports template. Empower coaches & players, optimize court performance and unlock industry-leading success for your brand.">
	<meta property="og:image" content="/assets/img/meta-image.jpg">
	<meta property="og:image:secure_url" content="assets/img/meta-image.jpg">
	<meta property="og:image:type" content="image/png">
	<meta property="og:image:width" content="1200">
	<meta property="og:image:height" content="600">

	<link rel="shortcut icon" type="image/x-icon" href="assets/img/favicon.png">
	<link rel="apple-touch-icon" sizes="120x120" href="assets/img/apple-touch-icon-120x120.png">
	<link rel="apple-touch-icon" sizes="152x152" href="assets/img/apple-touch-icon-152x152.png">

	<!-- Bootstrap CSS -->
	<link rel="stylesheet" href="assets/css/bootstrap.min.css">

	<!-- Fontawesome CSS -->
	<link rel="stylesheet" href="assets/plugins/fontawesome/css/fontawesome.min.css">
	<link rel="stylesheet" href="assets/plugins/fontawesome/css/all.min.css">

	<!-- Select CSS -->
	<link rel="stylesheet" href="assets/plugins/select2/css/select2.min.css">

	<!-- Feathericon CSS -->
	<link rel="stylesheet" href="assets/css/feather.css">

	<!-- Main CSS -->
	<link rel="stylesheet" href="assets/css/style.css">

</head>

<body>
	<div id="global-loader" >
		<div class="loader-img">
			<img src="assets/img/loader.png" class="img-fluid" alt="Global">
		</div>
	</div>

	<!-- Main Wrapper -->
	<div class="main-wrapper">

		<!-- Header -->
				<header class="header header-trans">
			<div class="container-fluid">
				<nav class="navbar navbar-expand-lg header-nav">
					<div class="navbar-header">
						<a id="mobile_btn" href="javascript:void(0);">
							<span class="bar-icon">
								<span></span>
								<span></span>
								<span></span>
							</span>
						</a>
						<a href="index.html" class="navbar-brand logo">
							<img src="assets/img/logo.svg" class="img-fluid" alt="Logo">
						</a>
					</div>
					<div class="main-menu-wrapper">
						<div class="menu-header">
							<a href="index.html" class="menu-logo">
								<img src="assets/img/logo-black.svg" class="img-fluid" alt="Logo">
							</a>
							<a id="menu_close" class="menu-close" href="javascript:void(0);"> <i class="fas fa-times"></i></a>
						</div>
						<ul class="main-nav">
							<li class="active"><a href="index.html">Home</a></li>
							
							
							
						
							<li><a href="court-booking.html">Book A Court</a></li>
							<li><a href="#">About Us</a></li>
							<li><a href="#">Venues</a></li>
							<li><a href="contact-us.html">Contact Us</a></li>
							<li class="login-link">
								<a href="register.html">Sign Up</a>
							</li>
							<li class="login-link">
								<a href="login.html">Sign In</a>
							</li>
						</ul>
					</div>
					<ul class="nav header-navbar-rht">
						<li class="nav-item">
							<div class="nav-link btn btn-white log-register">
								<a href="backend/web"><span><i class="feather-users"></i></span>Login</a> / <a href="register.html">Register</a>
							</div>
						</li>
						
					</ul>
				</nav>
			</div>
		</header>
		<!-- /Header -->

		<!-- Breadcrumb -->
		<section class="breadcrumb mb-0">
			<span class="primary-right-round"></span>
			<div class="container">
				<h1 class="text-white">Book A Court</h1>
				<ul>
					<li><a href="index.html">Home</a></li>
					<li>Book A Court</li>
				</ul>
			</div>
		</section>
		<!-- /Breadcrumb -->
		<section class="booking-steps py-30">
			<div class="container">
				<ul class="d-lg-flex justify-content-center align-items-center">
					<li><h5><a href="cage-details.html"><span>1</span>Book a Court</a></h5></li>
					
					<li><h5><a href="cage-personalinfo.html"><span>2</span>Personal Information</a></h5></li>
					<li class="active"><h5><a href="cage-order-confirm.html"><span>3</span>Order Confirmation</a></h5></li>
					<li><h5><a href="cage-checkout.html"><span>4</span>Payment</a></h5></li>
				</ul>
			</div>
		</section>

		<!-- Page Content -->
		<div class="content book-cage">
			<div class="container">
				<section class="card mb-40">
				<div class="text-center mb-40">
					<h3 class="mb-1">Order Confirmation</h3>
					<p class="sub-title mb-0">Thank you for your order! We're excited to fulfill it with care and efficiency.</p>
				</div>
				<div class="master-academy dull-whitesmoke-bg card">
					<div class="row d-flex align-items-center justify-content-center">
						<div class="col-12 col-sm-12 col-md-12 col-lg-6">
							<div class="d-sm-flex justify-content-start align-items-center">
								<a href="javascript:void(0);"><img class="corner-radius-10" src="assets/img/master-academy.png" alt="Venue"></a>
								<div class="info">
									<div class="d-flex justify-content-start align-items-center mb-3">
										<span class="text-white dark-yellow-bg color-white me-2 d-flex justify-content-center align-items-center">4.5</span>
										<span>300 Reviews</span>
									</div>
									<h3 class="mb-2">Predential Academy Udyambag</h3>
									<p>Predential Academy : Where dreams meet excellence in sports education and training.</p>
								</div>
							</div>
						</div>
						<div class="col-12 col-sm-12 col-md-12 col-lg-6">
							<ul class="d-sm-flex align-items-center justify-content-evenly">
								<li>
									<h3 class="d-inline-block">₹200</h3><span>/hr</span>
									<p>up to 2 guests</p>
								</li>
								
							</ul>
						</div>
					</div>
				</div>
				</section>
				<section class="card booking-order-confirmation">
				<h5 class="mb-3">Booking Details</h5>
				<ul class="booking-info d-lg-flex justify-content-between align-items-center">
					<li>
						<h6>Court Name</h6>
						<p>Predential Academy Udyambag</p>
					</li>
					<li>
						<h6>Appointment Date</h6>
						<p><?php echo $appointmentDate?></p>
					</li>
					<li>
						<h6>Appointment Start time</h6>
						<p><?php  echo $startTime?></p>
					</li>
					<li>
						<h6>Appointment End time</h6>
						<p><?php  echo $endTime?></p>
					</li>
					<li>
						<h6> Guests</h6>
						<p><?php  echo $adults + $children + $young?></p>
					</li>
				</ul>
				<h5 class="mb-3">Contact  Information</h5>
				<ul class="contact-info d-lg-flex justify-content-start align-items-center">
					<li>
						<h6>Name</h6>
						<p><?php  echo $name?></p>
					</li>
					<li>
						<h6>Contact Email Address</h6>
						<p><?php  echo $email?></p>
					</li>
					<li>
						<h6>Phone Number</h6>
						<p><?php  echo $contact?></p>
					</li>
				</ul>
				<h5 class="mb-3">Payment Information</h5>
				<ul class="payment-info d-lg-flex justify-content-start align-items-center">
					<li>
						<h6>SubTotal</h6>
						<p class="primary-text">(₹200 * 1 hours)</p>
					</li>
					
				
				</ul>
				</section>
				<div class="text-center btn-row">
				<form method="POST" action="checkout.php?id=<?php echo urlencode($id) ?>&name=<?php echo urlencode($name) ?>&email=<?php echo urlencode($email); ?>&contact=<?php echo urlencode($contact)?>">
    <input type="hidden" name="id" value="<?php echo $id; ?>">
    <button type="submit" class="btn btn-secondary btn-icon mt-3">
        Next <i class="feather-arrow-right-circle ms-1"></i>
    </button>
</form>

				</div>
			</div>
			<!-- /Container -->
		</div>
		<!-- /Page Content -->

		<!-- Footer -->
	<footer class="footer">
			<div class="container">
				<!-- Footer Join -->
				<div class="footer-join aos" data-aos="fade-up">
					<h2>We Welcome Your Passion And Expertise</h2>
					<p class="sub-title">Join our empowering sports community today and grow with us.</p>
					<a href="register.html" class="btn btn-primary"><i class="feather-user-plus"></i> Join With Us</a>
				</div>
				<!-- /Footer Join -->
			
				<!-- Footer Top -->
				
				<!-- /Footer Top -->
			</div>
			
			<!-- Footer Bottom -->
			<div class="footer-bottom">
				<div class="container">
					<!-- Copyright -->
					<div class="copyright">
						<div class="row align-items-center">
							<div class="col-md-6">
								<div class="copyright-text">
									<p class="mb-0">&copy; 2023 Badminton Academy  - All rights reserved. Designed With ❤️ By <a href="https://createmysite.co.in" target="_blank">Create My Site</a></p>
								</div>
							</div>
							
						</div>
					</div>
					<!-- /Copyright -->
				</div>
			</div>
			<!-- /Footer Bottom -->
			
		</footer>
		<!-- /Footer -->

	</div>
	<!-- /Main Wrapper -->

	<!-- jQuery -->
	<script src="assets/js/jquery-3.7.0.min.js"></script>

	<!-- Bootstrap Core JS -->
	<script src="assets/js/bootstrap.bundle.min.js"></script>

	<!-- Select JS -->
	<script src="assets/plugins/select2/js/select2.min.js"></script>

	<!-- Custom JS -->
	<script src="assets/js/script.js"></script>

</body>
</html>
