<?php
session_start();
include 'connection.php';
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Check if 'id' is set and is a valid integer
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;
if ($id <= 0) {
    // Handle the case when 'id' is not valid
    echo "Invalid ID provided.";
    exit();
}

// Use prepared statement to prevent SQL injection
$sql = "SELECT name, email, contact, address, date, starttime, endtime, adults, children, young_children FROM court WHERE id = ?";
$stmt = $conn->prepare($sql);

// Check if the statement was prepared successfully
if (!$stmt) {
    // Handle the case when the statement preparation fails
    echo "Error preparing SQL statement: " . $conn->error;
    exit();
}

// Bind the 'id' parameter
$stmt->bind_param("i", $id);

// Execute the statement
if ($stmt->execute()) {
    // Bind the result variables
    $stmt->bind_result($name, $email, $contact, $address, $appointmentDate, $startTime, $endTime, $adults, $children, $young);

    // Fetch the result
    $stmt->fetch();

    // Check if data was found
    if (!empty($name)) {
        // Data found, set session variables
        $_SESSION['booking_success'] = true;
        $_SESSION['booking_id'] = $id;

        // Set a session variable to indicate that the user is allowed to go back
        $_SESSION['allow_go_back'] = true;
    } else {
        echo "No data found for the provided ID.";
    }
} else {
    // Handle the case when the statement execution fails
    echo "Error executing SQL statement: " . $stmt->error;
}

// Close the statement
$stmt->close();

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

	<script>
        // Check if the session variable allows going back
        <?php if(isset($_SESSION['allow_go_back']) && $_SESSION['allow_go_back']) : ?>
            history.pushState(null, null, location.href);
            window.onpopstate = function () {
                history.go(1);
            };
        <?php endif; ?>

        // Clear the session variable to prevent going back on subsequent visits
        <?php unset($_SESSION['allow_go_back']); ?>
    </script>

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
		<header class="header header-sticky">
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
							<img src="assets/img/logo-black.svg" class="img-fluid" alt="Logo">
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
							<li><a href="index.html">Home</a></li>
							<li class="has-submenu active">
								<a href="#">Coaches <i class="fas fa-chevron-down"></i></a>
								<ul class="submenu">
									<li class="has-submenu">
										<a href="#">Coaches Map</a>
										<ul class="submenu inner-submenu">
											<li><a href="coaches-map.html">Coaches Map</a></li>
											<li><a href="coaches-map-sidebar.html">Coaches Map Sidebar</a></li>
										</ul>
									</li>
									<li><a href="coaches-grid.html">Coaches Grid</a></li>
									<li><a href="coaches-list.html">Coaches List</a></li>
									<li><a href="coaches-grid-sidebar.html">Coaches Grid Sidebar</a></li>
									<li><a href="coaches-list-sidebar.html">Coaches List Sidebar</a></li>
									<li class="has-submenu active">
										<a href="javascript:void(0);">Booking</a>
										<ul class="submenu">
											<li class="active"><a href="cage-details.html">Book a Court</a></li>
											<li><a href="coach-details.html">Book a Coach</a></li>
										</ul>
									</li>
									<li><a href="coach-detail.html">Coach Details</a></li>
									<li class="has-submenu">
										<a href="#">Venue</a>
										<ul class="submenu inner-submenu">
											<li><a href="listing-list.html">Venue List</a></li>
											<li><a href="venue-details.html">Venue Details</a></li>
										</ul>
									</li>
									<li><a href="coach-dashboard.html">Coach Dashboard</a></li>
									<li><a href="all-court.html">Coach Courts</a></li>
									<li><a href="add-court.html">List Your Court</a></li>
									<li><a href="coach-chat.html">Chat</a></li>
									<li><a href="coach-earning.html">Earnings</a></li>
									<li><a href="coach-wallet.html">Wallet</a></li>
									<li><a href="coach-profile.html">Profile Settings</a></li>
									<li><a href="invoice.html">Invoice</a></li>
								</ul>
								
							</li>
							<li class="has-submenu">
								<a href="#">User <i class="fas fa-chevron-down"></i></a>
								<ul class="submenu">
									<li><a href="user-dashboard.html">User Dashboard</a></li>
									<li><a href="user-bookings.html">Bookings</a></li>
									<li><a href="user-chat.html">Chat</a></li>
									<li><a href="user-invoice.html">Invoice</a></li>
									<li><a href="user-wallet.html">Wallet</a></li>
									<li><a href="user-profile.html">Profile Edit</a></li>
									<li><a href="user-setting-password.html">Change Password</a></li>
									<li><a href="user-profile-othersetting.html">Other Settings</a></li>
								</ul>
								
							</li>
							<li class="has-submenu">
								<a href="#">Pages <i class="fas fa-chevron-down"></i></a>
								<ul class="submenu">
								    <li><a href="about-us.html">About Us</a></li>
								    <li><a href="our-teams.html">Our Team</a></li>
								    <li><a href="services.html">Services</a></li>
								    <li><a href="events.html">Events</a></li>
									<li class="has-submenu">
										<a href="javascript:void(0);">Authentication</a>
										<ul class="submenu">
											<li><a href="register.html">Signup</a></li>
											<li><a href="login.html">Signin</a></li>
											<li><a href="forgot-password.html">Forgot Password</a></li>
											<li><a href="change-password.html">Reset Password</a></li>
										</ul>
									</li>
									
									<li class="has-submenu">
										<a href="javascript:void(0);">Error Page</a>
										<ul class="submenu">
											<li><a href="error-404.html">404 Error</a></li>
										</ul>
									</li>
									<li><a href="pricing.html">Pricing</a></li>
									<li><a href="faq.html">FAQ</a></li>
									<li><a href="gallery.html">Gallery</a></li>
									<li><a href="our-teams.html">Our Team</a></li>
									<li class="has-submenu">
										<a href="javascript:void(0);">Testimonials</a>
										<ul class="submenu">
											<li><a href="testimonials.html">Testimonials</a></li>
											<li><a href="testimonials-carousel.html">Testimonials Carousel</a></li>
										</ul>
									</li>
									<li><a href="terms-condition.html">Terms & Conditions</a></li>
									<li><a href="privacy-policy.html">Privacy Policy</a></li>			
									<li><a href="maintenance.html">Maintenance</a></li>
									<li><a href="coming-soon.html">Coming Soon</a></li>
								</ul>
							</li>
							<li class="has-submenu">
								<a href="#">Blog <i class="fas fa-chevron-down"></i></a>
								<ul class="submenu">
								    <li><a href="blog-list.html">Blog List</a></li>
								    <li class="has-submenu">
										<a href="javascript:void(0);">Blog List Sidebar</a>
										<ul class="submenu">
											<li><a href="blog-list-sidebar-left.html">Blog List Sidebar Left</a></li>
											<li><a href="blog-list-sidebar-right.html">Blog List Sidebar Right</a></li>
										</ul>
									</li>
									<li><a href="blog-grid.html">Blog Grid</a></li>
									<li class="has-submenu">
										<a href="javascript:void(0);">Blog Grid Sidebar</a>
										<ul class="submenu">
											<li><a href="blog-grid-sidebar-left.html">Blog Grid Sidebar Left</a></li>
											<li><a href="blog-grid-sidebar-right.html">Blog Grid Sidebar Right</a></li>
										</ul>
									</li>
									<li><a href="blog-details.html">Blog Details</a></li>
									<li class="has-submenu">
										<a href="javascript:void(0);">Blog Details Sidebar</a>
										<ul class="submenu">
											<li><a href="blog-details-sidebar-left.html">Blog Detail Sidebar Left</a></li>
											<li><a href="blog-details-sidebar-right.html">Blog Detail Sidebar Right</a></li>
										</ul>
									</li>
									<li><a href="blog-carousel.html">Blog Carousel</a></li>
								</ul>
							</li>
							<li><a href="contact-us.html">Contact Us</a></li>
							<li class="login-link">
								<a href="register.html">Sign Up</a>
							</li>
							<li class="login-link">
								<a href="login.html">Sign In</a>
							</li>
						</ul>
					</div>
					<ul class="nav header-navbar-rht logged-in">
						<li class="nav-item">
							<form class="header-search">
								<a class="nav-link" href="coaches-grid.html"><i class="feather-search"></i></a>
							</form>
						</li>
						<!-- Notifications -->
						<li class="nav-item dropdown noti-nav">
							<a href="listing-grid.html" class="dropdown-toggle nav-link position-relative" data-bs-toggle="dropdown">
								<i class="feather-bell"></i> <span class="alert-bg"></span>
							</a>
							<div class="dropdown-menu notifications dropdown-menu-end ">
								<div class="topnav-dropdown-header">
									<span class="notification-title">Notifications</span>
								</div>
								<div class="noti-content">
									<ul class="notification-list">
										<li class="notification-message">
											<a href="#">
												<div class="media d-flex">
													<span class="avatar">
														<img class="avatar-img" alt="User" src="assets/img/profiles/avatar-01.jpg">
													</span>
													<div class="media-body">
														<h6>Sarah Sports Academy<span class="notification-time">18.30 PM</span></h6>
														<p class="noti-details">Sent a amount of $210 for his Appointment  <span class="noti-title">Mr.Ruby perin </span></p>
													</div>
												</div>
											</a>
										</li>
										<li class="notification-message">
											<a href="#">
												<div class="media d-flex">
													<span class="avatar">
														<img class="avatar-img" alt="User" src="assets/img/profiles/avatar-02.jpg">
													</span>
													<div class="media-body">
														<h6>Badminton Academy<span class="notification-time">12 Min Ago</span></h6>
														<p class="noti-details"> has booked her appointment to  <span class="noti-title">Mr. Hendry Watt</span></p>
													</div>
												</div>
											</a>
										</li>
										<li class="notification-message">
											<a href="#">
												<div class="media d-flex">
													<div class="avatar">
														<img class="avatar-img" alt="User" src="assets/img/profiles/avatar-03.jpg">
													</div>
													<div class="media-body">
														<h6>Manchester Academy<span class="notification-time">6 Min Ago</span></h6>
														<p class="noti-details"> Sent a amount  $710 for his Appointment   <span class="noti-title">Mr.Maria Dyen</span></p>
													</div>
												</div>
											</a>
										</li>
										<li class="notification-message">
											<a href="#">
												<div class="media d-flex">
													<div class="avatar avatar-sm">
														<img class="avatar-img" alt="User" src="assets/img/profiles/avatar-04.jpg">
													</div>
													<div class="media-body">
														<h6>ABC Sports Academy<span class="notification-time">8.30 AM</span></h6>
														<p class="noti-details"> Send a message to the Coach</p>
													</div>
												</div>
											</a>
										</li>
									</ul>
								</div>
							</div>
						</li>
						<!-- /Notifications -->

						<!-- User Menu -->
						<li class="nav-item dropdown has-arrow logged-item">
							<a href="#" class="dropdown-toggle nav-link" data-bs-toggle="dropdown">
								<span class="user-img">
									<img class="rounded-circle" src="assets/img/profiles/avatar-05.jpg" width="31" alt="Darren Elder">
								</span>
							</a>
							<div class="dropdown-menu dropdown-menu-end">
								<div class="user-header">
									<div class="avatar avatar-sm">
										<img src="assets/img/profiles/avatar-05.jpg" alt="User" class="avatar-img rounded-circle">
									</div>
									<div class="user-text">
										<h6>Henriques</h6>
										<a href="user-profile.html" class="text-profile mb-0">Go to Profile</a>
									</div>
								</div>
								<p><a class="dropdown-item" href="coach-profile.html">Settings</a></p>
								<p><a class="dropdown-item" href="login.html">Logout</a></p>
							</div>
						</li>
						<!-- /User Menu -->
						<li class="nav-item">
							<a class="nav-link btn btn-secondary" href="add-court.html"><span><i class="feather-check-circle"></i></span>List Your Court</a>
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
				<div class="footer-join">
					<h2>We Welcome Your Passion And Expertise</h2>
					<p class="sub-title">Join our empowering sports community today and grow with us.</p>
					<a href="register.html" class="btn btn-primary"><i class="feather-user-plus"></i> Join With Us</a>
				</div>
				<!-- /Footer Join -->
			
				<!-- Footer Top -->
				<div class="footer-top">
					<div class="row">
						<div class="col-lg-2 col-md-6">
							<!-- Footer Widget -->
							<div class="footer-widget footer-menu">
								<h4 class="footer-title">Contact us</h4>
								<div class="footer-address-blk">
									<div class="footer-call">
										<span>Toll free Customer Care</span>
										<p>+017 123 456 78</p>
									</div>
									<div class="footer-call">
										<span>Need Live Suppot</span>
										<p>Badminton Academy@example.com</p>
									</div>
								</div>
								<div class="social-icon">
									<ul>
										<li>
											<a href="javascript:void(0);" class="facebook" ><i class="fab fa-facebook-f"></i> </a>
										</li>
										<li>
											<a href="javascript:void(0);" class="twitter" ><i class="fab fa-twitter"></i> </a>
										</li>
										<li>
											<a href="javascript:void(0);" class="instagram" ><i class="fab fa-instagram"></i></a>
										</li>
										<li>
											<a href="javascript:void(0);" class="linked-in" ><i class="fab fa-linkedin-in"></i></a>
										</li>
									</ul>
								</div>
							</div>
							<!-- /Footer Widget -->
						</div>
						<div class="col-lg-2 col-md-6">
							<!-- Footer Widget -->
							<div class="footer-widget footer-menu">
								<h4 class="footer-title">Quick Links</h4>
								<ul>
									<li>
										<a href="about-us.html">About us</a>
									</li>
									<li>
										<a href="services.html">Services</a>
									</li>
									<li>
										<a href="events.html">Events</a>
									</li>
									<li>
										<a href="blog-grid.html">Blogs</a>
									</li>
									<li>
										<a href="contact-us.html">Contact us</a>
									</li>
								</ul>
							</div>
							<!-- /Footer Widget -->
						</div>
						<div class="col-lg-2 col-md-6">
							<!-- Footer Widget -->
							<div class="footer-widget footer-menu">
								<h4 class="footer-title">Support</h4>
								<ul>
									<li>
										<a href="contact-us.html">Contact Us</a>
									</li>
									<li>
										<a href="faq.html">Faq</a>
									</li>
									<li>
										<a href="privacy-policy.html">Privacy Policy</a>
									</li>
									<li>
										<a href="terms-condition.html">Terms & Conditions</a>
									</li>
									<li>
										<a href="pricing.html">Pricing</a>
									</li>
								</ul>
							</div>
							<!-- /Footer Widget -->
						</div>
						<div class="col-lg-2 col-md-6">
							<!-- Footer Widget -->
							<div class="footer-widget footer-menu">
								<h4 class="footer-title">Other Links</h4>
								<ul>
									<li>
										<a href="coaches-grid.html">Coaches</a>
									</li>
									<li>
										<a href="listing-grid.html">Sports Venue</a>
									</li>
									<li>
										<a href="coach-details.html">Join As Coach</a>
									</li>
									<li>
										<a href="coaches-map.html">Add Venue</a>
									</li>
									<li>
										<a href="my-profile.html">My Account</a>
									</li>
								</ul>
							</div>
							<!-- /Footer Widget -->
						</div>
						<div class="col-lg-2 col-md-6">
							<!-- Footer Widget -->
							<div class="footer-widget footer-menu">
								<h4 class="footer-title">Our Locations</h4>
								<ul>
									<li>
										<a href="javascript:void(0);">Germany</a>
									</li>
									<li>
										<a href="javascript:void(0);">Russia</a>
									</li>
									<li>
										<a href="javascript:void(0);">France</a>
									</li>
									<li>
										<a href="javascript:void(0);">UK</a>
									</li>
									<li>
										<a href="javascript:void(0);">Colombia</a>
									</li>
								</ul>
							</div>
							<!-- /Footer Widget -->
						</div>
						<div class="col-lg-2 col-md-6">
							<!-- Footer Widget -->
							<div class="footer-widget footer-menu">
								<h4 class="footer-title">Download</h4>
								<ul>
									<li>
										<a href="#"><img src="assets/img/icons/icon-apple.svg" alt="Icon"></a>
									</li>
									<li>
										<a href="#"><img src="assets/img/icons/google-icon.svg" alt="Icon"></a>
									</li>
								</ul>
							</div>
							<!-- /Footer Widget -->
						</div>
					</div>
				</div>
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
									<p class="mb-0">&copy; 2023 Badminton Academy  - All rights reserved.</p>
								</div>
							</div>
							<div class="col-md-6">
								<!-- Copyright Menu -->
								<div class="dropdown-blk">
									<ul class="navbar-nav selection-list">
										<li class="nav-item dropdown">
											<div class="lang-select">
												<span class="select-icon"><i class="feather-globe"></i></span>
												<select class="select">
													<option>English (US)</option>
													<option>UK</option>
													<option>Japan</option>
												</select>
											</div>
										</li>
										<li class="nav-item dropdown">
											<div class="lang-select">
												<span class="select-icon"></span>
												<select class="select">
													<option>$ USD</option>
													<option>$ Euro</option>
												</select>				
											</div>	
										</li>
									</ul>
								</div>
								<!-- /Copyright Menu -->
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
