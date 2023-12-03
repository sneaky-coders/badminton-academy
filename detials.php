<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Razorpay Payment</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>

<?php
include 'connection.php';
require_once './vendor/razorpay/razorpay/Razorpay.php';

use Razorpay\Api\Api;

error_reporting(E_ALL);
ini_set('display_errors', 1);

$api_key = 'rzp_test_ljQFy5R7q8KG5h';
$api_secret = '5OZSqcbNiJWimO9p6hWpjUxd';

$razorpay = new Api($api_key, $api_secret);

// The amount is now set directly in rupees
$baseAmount = $_POST['amt']; // Your dynamic base amount in rupees (e.g., $1000.00)

// Calculate the platform fee and GST
$platformFeePercentage = 2; // 2% platform fee
$gstPercentage = 18; // 18% GST on the platform fee

$platformFee = ($baseAmount * $platformFeePercentage) / 100;
$gstOnPlatformFee = ($platformFee * $gstPercentage) / 100;

// Calculate the total amount including the platform fee and GST
$totalAmount = $baseAmount + $platformFee + $gstOnPlatformFee;

// Ensure that the total amount is numeric and at least 1.00
$totalAmount = max(floatval($totalAmount), 1.00);

// Initialize $orderId variable
$orderId = null;

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

    // Insert order details into the database

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Assuming you pass customer name and email from details.php
    $customerName = $_POST['customer_name'];
    $customerEmail = $_POST['customer_email'];

    // Prepare and bind the SQL statement
    $stmt = $conn->prepare("INSERT INTO booking (`orderid`, `amount`, `status`, `customername`, `customeremail`) VALUES (?, ?, 'pending', ?, ?)");

    // Check if the statement was prepared successfully
    if (!$stmt) {
        die("Error preparing statement: " . $conn->error);
    }

    // Bind parameters to the statement
    $stmt->bind_param("sdss", $orderId, $totalAmount, $customerName, $customerEmail);

    // Execute the statement
    if ($stmt->execute()) {
        // Close the statement and connection
        $stmt->close();
        $conn->close();

        // Render the payment form
        ?>
        <form action="pay.php" method="POST">
            <!-- Include other relevant form fields -->

            <script
                src="https://checkout.razorpay.com/v1/checkout.js"
                data-key="<?= $api_key ?>"
                data-amount="<?= $totalAmount * 100 ?>"
                data-name="Badminton Booking"
                data-description="Payment Description"
                data-prefill.name="<?= $customerName ?>"
                data-prefill.email="<?= $customerEmail ?>"
                data-order_id="<?= $orderId ?>"
                data-buttontext="Pay with Razorpay"
                data-theme.color="#00FEF7"
            ></script>
            <input type="hidden" value="<?= $orderId ?>" name="razorpay_order_id">
            <input type="hidden" value="<?= $totalAmount ?>" name="amt">
            <input type="hidden" id="razorpay_payment_id" name="razorpay_payment_id">

            <input type="submit" value="Submit">
        </form>

        <script>
            var razorpay_payment_id;

            function onPaymentSuccess(response) {
                razorpay_payment_id = response.razorpay_payment_id;
                document.getElementById('razorpay_payment_id').value = razorpay_payment_id;

                // Optionally, you can submit the form here or take any other actions on payment success
                // document.forms['your-form-name'].submit();
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
                        name: '<?= $customerName ?>',
                        email: '<?= $customerEmail ?>'
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

                $('form').submit(function (e) {
                    // Open the Razorpay checkout form when the form is submitted
                    e.preventDefault();
                    rzp.open();
                });
            });
        </script>

        <?php

    } else {
        echo "Error executing statement: " . $stmt->error;
        $stmt->close();
        $conn->close();
    }

} catch (\Razorpay\Api\Errors\Error $e) {
    // Handle payment failure
    echo "Payment failed. Error: " . $e->getMessage();

    // You can log the error or take any additional actions as needed
}
?>
</body>
</html>
