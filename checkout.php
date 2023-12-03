
<?php
// Enable error reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);

include 'connection.php'; // Include your database connection file
require_once './vendor/razorpay/razorpay/Razorpay.php';

use Razorpay\Api\Api;

$api_key = 'rzp_test_ljQFy5R7q8KG5h';
$api_secret = '5OZSqcbNiJWimO9p6hWpjUxd';

$razorpay = new Api($api_key, $api_secret);

// The amount is now set directly in rupees without multiplying by 100
$baseAmount = 200; // Your dynamic base amount in rupees (e.g., $1000.00)

// Calculate the platform fee and GST
$platformFeePercentage = 2; // 2% platform fee
$gstPercentage = 18; // 18% GST on the platform fee

$platformFee = ($baseAmount * $platformFeePercentage) / 100;
$gstOnPlatformFee = ($platformFee * $gstPercentage) / 100;

// Calculate the total amount including the platform fee and GST
$totalAmount = $baseAmount + $platformFee + $gstOnPlatformFee;

$orderData = [
    'amount' => $totalAmount * 100, // Convert total amount to paisa
    'currency' => 'INR',
    'receipt' => 'order_receipt_' . time(),
    'payment_capture' => 1,
];

try {
    $order = $razorpay->order->create($orderData);

    // Use the dynamically generated order ID
    $orderId = $order['id'];
    $courtId = $_POST['id'];

    // Check if $courtId is empty before proceeding with the insert
    if ($courtId === null || $courtId === '') {
        echo "Error: Court ID is empty.";
        exit;
    }

    // Generate a unique transaction ID
    $transactionId = uniqid('transaction_');

    // Build the SQL query
    $sql = "INSERT INTO booking (court_id, orderid, amount, status, transactionid) VALUES ('$courtId', '$orderId', '$totalAmount', 'pending', '$transactionId')";

    // Check connection and execute the SQL query
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    if ($conn->query($sql) === TRUE) {
        // Close the connection
        $conn->close();

        // Render the payment form
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

	<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

	<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

	<style>
		.razorpay-payment-button
		{
			display:none;
		}
		</style>

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
														<img class="avatar-img" src="assets/img/profiles/avatar-01.jpg" alt="User">
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
														<img class="avatar-img" src="assets/img/profiles/avatar-02.jpg" alt="User">
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
														<img class="avatar-img" src="assets/img/profiles/avatar-03.jpg" alt="User">
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
														<img class="avatar-img" src="assets/img/profiles/avatar-04.jpg" alt="User">
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
		<div class="breadcrumb mb-0">
			<span class="primary-right-round"></span>
			<div class="container">
				<h1 class="text-white">Book A Court</h1>
				<ul class="list-unstyled">
					<li><a href="index.html">Home</a></li>
					<li>Book A Court</li>
				</ul>
			</div>
		</div>
		<!-- /Breadcrumb -->
		<section class="booking-steps py-30">
			<div class="container">
				<ul class="d-lg-flex justify-content-center align-items-center list-unstyled">
					<li><h5><a href="cage-details.html"><span>1</span>Book a Cage</a></h5></li>
					<li><h5><a href="cage-order-confirm.html"><span>2</span>Order Confirmation</a></h5></li>
					<li><h5><a href="cage-personalinfo.html"><span>3</span>Personal Information</a></h5></li>
					<li class="active"><h5><a href="cage-checkout.html"><span>4</span>Payment</a></h5></li>
				</ul>
			</div>
		</section>

		<!-- Page Content -->
		<div class="content">
			<div class="container">
				<section class="">
				<div class="text-center mb-40">
					<h3 class="mb-1">Payment</h3>
					<p class="sub-title mb-0">Secure your booking, complete payment, and enjoy our sophisticated facilities</p>
				</div>
				<div class="master-academy dull-whitesmoke-bg card mb-40">
					<div class="row d-flex align-items-center justify-content-center">
						<div class="d-sm-flex justify-content-start align-items-center">
							<a href="javascript:void(0);"><img class="corner-radius-10" src="assets/img/master-academy.png" alt="Venue"></a>
							<div class="info">
								<h3 class="mb-2">Manchester Academy</h3>
								<p>Manchester Academy: Where dreams meet excellence in sports education and training.</p>
							</div>
						</div>
					</div>
				</div>
				<div class="row checkout">
					<div class="col-12 col-sm-12 col-md-12 col-lg-7">
					<?php
					// Assuming you have a MySQL database connection
					include 'connection.php';
					error_reporting(E_ALL);
					ini_set('display_errors', 1);

					// Output buffering
					ob_start();

					// Check if 'id' is set and is a valid integer
					$id = $_GET['id'];
					if (!is_numeric($id) || $id <= 0) {
						// Handle the case when 'id' is not valid
						echo 'Invalid ID provided.';
						exit ();
					}

					// Use prepared statement to prevent SQL injection
					$sql = 'SELECT name, email, contact, address, date, starttime, endtime, adults, children, young_children FROM court WHERE id = ?';
					$stmt = $conn->prepare($sql);
					$stmt->bind_param('i', $id);

					// Check if the statement preparation was successful
					if (!$stmt) {
						// Handle the case when the statement preparation fails
						echo 'Error preparing SQL statement: ' . $conn->error;
						exit ();
					}

					// Execute the statement
					if ($stmt->execute()) {
						// Bind the result variables
						$stmt->bind_result($name, $email, $contact, $address, $appointmentDate, $startTime, $endTime, $adults, $children, $young);

						// Fetch the result
						$stmt->fetch();

						// Check if data was found
						if (!empty($name)) {
							// Display the order summary
							echo '<div class="col-12 col-sm-12 col-md-12 col-lg-7">';
							echo '    <div class="card booking-details">';
							echo '        <h3 class="border-bottom">Order Summary</h3>';
							echo '        <ul class="list-unstyled">';
							echo "            <li><i class='fa-regular fa-building me-2'></i>$name<span class='x-circle'></span></li>";
							echo "            <li><i class='feather-calendar me-2'></i>$appointmentDate</li>";
							echo "            <li><i class='feather-clock me-2'></i>$startTime to $endTime</li>";
							echo "            <li><i class='feather-users me-2'></i>$adults Adults, $children Children, $young Young Children</li>";
							echo '        </ul>';
							echo '    </div>';
							echo '</div>';
						} else {
							echo 'No data found for the provided ID.';
						}
					} else {
						// Handle the case when the statement execution fails
						echo 'Error executing SQL statement: ' . $stmt->error;
					}

					// Close the statement
					$stmt->close();

					// Close the database connection
					$conn->close();

					// Output buffer end
					ob_end_flush();
					?>
					</div>
					<div class="col-12 col-sm-12 col-md-12 col-lg-5">
						<aside class="card payment-modes">
							<h3 class="border-bottom">Checkout</h3>
							<h6 class="mb-3">Select Payment Gateway</h6>
							<div class="radio">
									<div class="form-check form-check-inline mb-3">
								  	<input class="form-check-input default-check me-2" type="radio" name="inlineRadioOptions" id="inlineRadio2" value="Paypal">
								  	<label class="form-check-label" for="inlineRadio2">Razorpay</label>
								</div>
							
							
							</div>
							<hr>
						<ul class="order-sub-total">
								<li>
									<p>Sub total</p>
									<h6>₹200</h6>
								</li>
								<li>
									<p>Platform Fee</p>
									<h6>
									<?php
									$price = 200;
									$fee = ($price * 2) / 100;
									$gst = ($fee * 18) / 100;
									$platform = $fee + $gst;
									$total = $fee + $gst + $price;

									echo '₹' . $platform;
									?></h6>
								</li>
							
							</ul>
							<div class="order-total d-flex justify-content-between align-items-center">
								<h5>Order Total</h5>
								<h5>₹<?php echo $total; ?></h5>
							</div>
							<div class="form-check d-flex justify-content-start align-items-center policy">
								<div class="d-inline-block">
									<input class="form-check-input" type="checkbox" value="" id="policy">
								</div>
								<label class="form-check-label" for="policy">By clicking 'Send Request', I agree to Dreamsport <a href="privacy-policy.html">Privacy Policy</a> and <a href="terms-condition.html">Terms of Use</a></label>
							</div>
							<form action="success.php?id=<?php echo urlencode($id) ?>&name=<?php echo urlencode($name) ?>&email=<?php echo urlencode($email); ?>&contact=<?php echo urlencode($contact)?>&starttime=<?php echo urlencode($startTime)?>&endtime=<?php echo urlencode($endTime)?>&amount=<?php echo urlencode($total)?>" method="POST" id="razorpayForm">
    <!-- Other form fields -->

    <input type="hidden" id="court_id" name="court_id" value="<?php echo $courtId ?>">
    <input type="hidden" id="aptdate" name="aptdate" value="<?php echo $appointmentDate?>">
    <input type="hidden" id="namee" name="namee" value="<?php echo $name ?>">
    <input type="hidden" id="email" name="email" value="<?php echo $email ?>">
    <input type="hidden" id="contact" name="contact" value="<?php echo $contact ?>">
    <input type="hidden" id="starttime" name="starttime" value="<?php echo $startTime ?>">
    <input type="hidden" id="endtime" name="endtime" value="<?php echo $endTime ?>">
    <input type="hidden" id="amount" name="amount" value="<?php echo $total ?>">

    <br>

    <script
        src="https://checkout.razorpay.com/v1/checkout.js"
        data-key="<?= $api_key ?>"
        data-amount="<?= $totalAmount * 100 ?>"
        data-name="Badminton Booking"
        data-description="Payment Description"
        data-prefill.name="<?= $courtId ?>"
        data-order_id="<?= $orderId ?>"
        data-buttontext="Proceed <?php echo '₹' . $total ?>"
        data-theme.color="#00FEF7"
    ></script>
    <input type="hidden" value="<?= $orderId ?>" name="razorpay_order_id">
    <input type="hidden" value="<?= $totalAmount ?>" name="amt">
    <input type="hidden" value="<?= $transactionId ?>" name="transaction_id">
    <input type="hidden" id="razorpay_payment_id" name="razorpay_payment_id">

    <!-- Add Bootstrap button class -->
	<div class="d-grid btn-block">

    <button type="submit" class="btn btn-primary">Proceed ₹<?php echo $total; ?></button>
				</div>
</form>

						
						</aside>
					</div>
				</div>
				</section>
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

	<!-- Booking Confirmed Modal -->
	<div class="modal fade" id="bookingconfirmModal" tabindex="-1" aria-labelledby="bookingconfirmModal" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered">
		    <div class="modal-content">
		      	<div class="modal-header text-center d-inline-block">
		        	<img src="assets/img/icons/booking-confirmed.svg" alt="User">
		      	</div>
				<div class="modal-body text-center">
				<h3 class="mb-3">Booking has been Confirmed</h3>
				<p>Check your email on the booking confirmation</p>
				</div>
		      	<div class="modal-footer text-center d-inline-block">
		        	<a href="user-dashboard.html" class="btn btn-primary btn-icon"><i class="feather-arrow-left-circle me-1"></i>Back to Dashboard</a>
		      </div>
		    </div>
		</div>
	</div>
	<!-- /Booking Confirmed Modal -->

	<!-- jQuery -->
	
<!-- Include the Razorpay JS library -->
<script>
            var razorpay_payment_id;
            var formSubmitted = false;

            function onPaymentSuccess(response) {
                razorpay_payment_id = response.razorpay_payment_id;
                document.getElementById('razorpay_payment_id').value = razorpay_payment_id;

                // Submit the form after handling the payment success
                formSubmitted = true;
                document.getElementById('razorpayForm').submit();
            }

            function onPaymentError(error) {
                alert("Payment failed: " + error.description);
            }

            $(document).ready(function () {
                var options = {
                    key: '<?= $api_key ?>',
                    amount: <?= $totalAmount * 100 ?>,
                    name: 'Badminton Booking',
                    description: 'Payment Description',
                    prefill: {
                        name: '<?= $courtId ?>'
                    },
                    handler: function (response) {
                        onPaymentSuccess(response);
                    },
                    modal: {
                        ondismiss: function () {
                            onPaymentError({ description: 'Payment cancelled' });
                        }
                    }
                };

                var rzp = new Razorpay(options);

                $('#submitBtn').on('click', function (e) {
                    // Open the Razorpay checkout form when the button is clicked
                    e.preventDefault();
                    if (!formSubmitted) {
                        rzp.open();
                    }
                });
            });
        </script>

        </body>
        </html>
        <?php
    } else {
        echo "Error executing SQL query: " . $conn->error;
        $conn->close();
    }
} catch (\Razorpay\Api\Errors\Error $e) {
    // Handle payment failure
    echo "Payment failed. Error: " . $e->getMessage();
}
?>
	<script src="assets/js/jquery-3.7.0.min.js"></script>

	<!-- Bootstrap Core JS -->
	<script src="assets/js/bootstrap.bundle.min.js"></script>

	<!-- Select JS -->
	<script src="assets/plugins/select2/js/select2.min.js"></script>

	<!-- Custom JS -->
	<script src="assets/js/script.js"></script>

</body>
</html>
