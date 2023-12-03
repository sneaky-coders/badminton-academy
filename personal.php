<?php
// Assuming you have a MySQL database connection in connection.php
include 'connection.php';
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Retrieve the ID from the URL
$id = $_POST['id'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve form data
    $name = $_POST['namee'];
    $email = $_POST['email'];
    $contact = $_POST['contact'];
    $address = $_POST['address'];

    // Use prepared statement to prevent SQL injection
    $sql = "UPDATE court
            SET name = ?, email = ?, contact = ?, address = ?
            WHERE id = ?";

    $stmt = $conn->prepare($sql);

    // Bind parameters
    $stmt->bind_param("ssssi", $name, $email, $contact, $address, $id);

    // Execute the statement
    if ($stmt->execute()) {
        // Redirect to the confirmation page
      
        exit();
    } else {
        echo "Error updating record: " . $stmt->error;
    }

    // Close the statement
    $stmt->close();
} else {
    // Handle the case when the form is not submitted
    echo "Invalid request. Form not submitted.";
}

// Close the database connection
$conn->close();
?>

<!-- HTML form -->

