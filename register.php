<?php
include 'connection.php';

error_reporting(E_ALL);
ini_set('display_errors', 1);

// Function to safely redirect to a URL
function redirect($url) {
    header("Location: $url");
    exit();
}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Include database connection details

    // Create connection

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Get user input from the form
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Check if the user already exists
    $checkUserQuery = "SELECT * FROM users WHERE username = ? OR email = ?";
    $checkUserStmt = $conn->prepare($checkUserQuery);
    $checkUserStmt->bind_param("ss", $username, $email);
    $checkUserStmt->execute();
    $checkUserResult = $checkUserStmt->get_result();

    if ($checkUserResult->num_rows > 0) {
        // User already exists, redirect to an error page
        redirect("user-exist.html");
    }

    // Insert user data into the database
    $insertUserQuery = "INSERT INTO users (username, email, password) VALUES (?, ?, ?)";
    $insertUserStmt = $conn->prepare($insertUserQuery);

    // Check if the statement was prepared successfully
    if ($insertUserStmt) {
        // Bind parameters to the statement
        $insertUserStmt->bind_param("sss", $username, $email, $password);

        // Execute the statement
        if ($insertUserStmt->execute()) {
            // Signup successful, redirect to a success page
            redirect("successs.html");
        } else {
            // Signup failed, redirect to an error page
            redirect("error-404.html");
        }

        // Close the statement
        $insertUserStmt->close();
    } else {
        // Error preparing statement, redirect to an error page
        redirect("error-404.html");
    }

    // Close the database connection
    $conn->close();
}
?>
