<?php
/*
Sms Integration
error_reporting(E_ALL);
ini_set('display_errors', 1);
require __DIR__ . '/vendor/autoload.php';

use Twilio\Rest\Client;

// Function to sanitize user input
function sanitize_input($data)
{
    return htmlspecialchars($data ?? '', ENT_QUOTES, 'UTF-8');
}

try {
    // Retrieve parameters from the URL
    $orderID = $_GET['razorpay_order_id'] ?? '';
    $transactionID = $_GET['razorpay_payment_id'] ?? '';
    $courtId = $_GET['court_id'] ?? '';
    $name = $_GET['name'] ?? '';
    $email = $_GET['email'] ?? '';
    $contact = $_GET['contact'] ?? '';
    $starttime = $_GET['starttime'] ?? '';
    $endtime = $_GET['endtime'] ?? '';
    $amount = $_GET['amount'] ?? '';

    // Twilio credentials
    $twilioSid = 'ACe9ce2ee5ba95c1a83dfda1af25849818';
    $twilioToken = 'a1b55469d62ec2c1749822fcf6665aa1';
    $twilioPhoneNumber = '+19513303669';
    $adminPhoneNumber = '+91'. $contact;

    // Create a Twilio client
    $twilio = new Client($twilioSid, $twilioToken);

    // Customize the SMS body for a successful booking
    $message = "Thank you, $name, for booking your slot with us!\n\n";
    $message .= "Booking Summary\n";
    $message .= "Email: $email\n";
    $message .= "Contact: $contact\n";
    $message .= "Booking ID: $orderID\n";
    $message .= "Transaction ID: $transactionID\n";
    $message .= "Booking Date: $courtId\n";
    $message .= "Booking Start Time: $starttime\n";
    $message .= "Booking End Time: $endtime\n";
    $message .= "Amount: ₹$amount\n";

    // Send SMS to admin
    $twilio->messages->create(
        $adminPhoneNumber,
        [
            'from' => $twilioPhoneNumber,
            'body' => $message
        ]
    );

    echo 'SMS sent successfully';
} catch (Exception $e) {
    echo 'An error occurred: ' . sanitize_input($e->getMessage());
}*/

//Whatsapp Integration



error_reporting(E_ALL);
ini_set('display_errors', 1);
require __DIR__ . '/vendor/autoload.php';

use Twilio\Rest\Client;

// Function to sanitize user input
function sanitize_input($data)
{
    return htmlspecialchars($data ?? '', ENT_QUOTES, 'UTF-8');
}

try {
    // Retrieve parameters from the URL
    $orderID = $_GET['razorpay_order_id'] ?? '';
    $transactionID = $_GET['razorpay_payment_id'] ?? '';
    $courtId = $_GET['court_id'] ?? '';
    $name = $_GET['name'] ?? '';
    $email = $_GET['email'] ?? '';
    $contact = $_GET['contact'] ?? '';
    $starttime = $_GET['starttime'] ?? '';
    $endtime = $_GET['endtime'] ?? '';
    $amount = $_GET['amount'] ?? '';

    // Check for missing or invalid parameters
    if (empty($orderID) || empty($transactionID) || empty($courtId) || empty($name) || empty($email) || empty($contact) || empty($starttime) || empty($endtime) || empty($amount)) {
        echo 'Invalid or missing parameters.';
        exit;
    }

    // Twilio credentials
    $twilioSid = 'AC6edabc0ce9e4f985429c376f81a678d3';
    $twilioToken = 'c29c78c2338959d8bc0a37387628af67';
    $twilioPhoneNumber = 'whatsapp:+14155238886'; // Twilio's WhatsApp number
    $adminPhoneNumber = 'whatsapp:+91'. $contact;

    // Create a Twilio client
    $twilio = new Client($twilioSid, $twilioToken);

    // Customize the WhatsApp message for a successful booking
    $message = "Thank you, $name, for booking your slot with us!\n\n";
    $message .= "Booking Summary\n";
    $message .= "Email: $email\n";
    $message .= "Contact: $contact\n";
    $message .= "Booking ID: $orderID\n";
    $message .= "Transaction ID: $transactionID\n";
    $message .= "Booking Date: $courtId\n";
    $message .= "Booking Start Time: $starttime\n";
    $message .= "Booking End Time: $endtime\n";
    $message .= "Amount: ₹$amount\n";

    // Send WhatsApp message to admin
    /*$twilio->messages->create(
        $adminPhoneNumber,
        [
            'from' => $twilioPhoneNumber,
            'body' => $message
        ]
    );*/

    echo 'Booking information received. Processing...';
    header("Location: index.html");
} catch (Exception $e) {
    $errorMessage = 'An error occurred: ' . sanitize_input($e->getMessage());
    error_log($errorMessage);
    echo $errorMessage;
}

