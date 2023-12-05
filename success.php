<?php
include 'connection.php';
require __DIR__ . '/vendor/autoload.php';

use Twilio\Rest\Client;

error_reporting(E_ALL);
ini_set('display_errors', 1);

try {
    // Retrieve the Razorpay order ID, payment ID, and court ID from the form submission
    $razorpayOrderId = $_POST['razorpay_order_id'] ?? null;
    $razorpayPaymentId = $_POST['razorpay_payment_id'] ?? null;
    $name = $_POST['namee'] ?? null;
    $email = $_POST['email'] ?? null;
    $contact = $_POST['contact'] ?? null;
    $starttime = $_POST['starttime'] ?? null;
    $endtime = $_POST['endtime'] ?? null;
    $amount = $_POST['amount'] ?? null;
    $courtId = $_POST['aptdate'] ?? null;

    // Validate and sanitize user input
    $razorpayOrderId = sanitize_input($razorpayOrderId);
    $razorpayPaymentId = sanitize_input($razorpayPaymentId);
    $courtId = sanitize_input($courtId);

    // Check if the payment was successful
    if ($razorpayPaymentId) {
        // Check connection
        if ($conn->connect_error) {
            throw new Exception("Connection failed: " . $conn->connect_error);
        }

        // Prepare the SQL statement
        $sql = "UPDATE booking SET status = 'paid', transactionid = ? WHERE orderid = ?";
        $stmt = $conn->prepare($sql);

        // Check if the statement was prepared successfully
        if (!$stmt) {
            throw new Exception("Error preparing statement: " . $conn->error);
        }

        // Bind parameters to the statement
        $stmt->bind_param("ss", $razorpayPaymentId, $razorpayOrderId);

        // Execute the statement
        if ($stmt->execute()) {
            // Send WhatsApp message to admin
            sendWhatsAppToAdmin($razorpayOrderId, $razorpayPaymentId, $courtId, $name, $email, $contact, $starttime, $endtime, $amount);

            // Redirect the user to the receipt page
            header("Location:index.html");
            exit;
        } else {
            throw new Exception("Error updating status: " . $stmt->error);
        }
    } else {
        // The payment was not successful
        echo "Payment was not successful. Please contact support.";
    }
} catch (Exception $e) {
    // Log the exception to a secure location
    error_log("Exception: " . $e->getMessage());

    // Display a generic error message to the user
    echo "An error occurred. Please try again or contact support.";
} finally {
    // Close the database connection
    if (isset($conn)) {
        $conn->close();
    }
}

// Function to send WhatsApp message to admin using Twilio
function sendWhatsAppToAdmin($orderID, $transactionID, $courtId, $name, $email, $contact, $starttime, $endtime, $amount)
{
    // Use environment variables for Twilio credentials
    $twilioSid = 'ACe9ce2ee5ba95c1a83dfda1af25849818';
    $twilioToken = 'a1b55469d62ec2c1749822fcf6665aa1';
    $twilioPhoneNumber = 'whatsapp:+14155238886';
    $adminPhoneNumber = 'whatsapp:+919096245373'; // Replace with the admin's actual WhatsApp number

    if (!$twilioSid || !$twilioToken || !$twilioPhoneNumber || !$adminPhoneNumber) {
        throw new Exception("Twilio credentials or admin phone number not set.");
    }

    // Create a Twilio client
    $twilio = new Client($twilioSid, $twilioToken);

    // Customize the WhatsApp message for a successful booking
    $message = "New booking alert!\n\n";
    $message .= "Customer Name: $name\n";
    $message .= "Customer Email: $email\n";
    $message .= "Customer Contact: $contact\n";
    $message .= "Order ID: $orderID\n";
    $message .= "Transaction ID: $transactionID\n";
    $message .= "Booking Date: $courtId\n";
    $message .= "Start Time: $starttime\n";
    $message .= "End Time: $endtime\n";
    $message .= "Amount: ₹$amount\n";

    try {
        // Send WhatsApp message to admin
        $message = $twilio->messages
            ->create("whatsapp:+919096245373", // Replace with the admin's actual WhatsApp number
                [
                    "from" => "whatsapp:+14155238886",
                    "body" => $message
                ]
            );

        // Log success
        error_log("WhatsApp message sent successfully. SID: " . $message->sid);
    } catch (Exception $e) {
        // Log Twilio error
        error_log("Twilio Error: " . $e->getMessage());
        // You can handle this error as needed
    }
}

// Function to sanitize user input
function sanitize_input($data)
{
    // Check if $data is not null before applying htmlspecialchars
    return $data !== null ? htmlspecialchars($data, ENT_QUOTES, 'UTF-8') : null;
}
