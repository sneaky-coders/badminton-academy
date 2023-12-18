<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
include 'connection.php'; // Include your database connection script

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve and sanitize the booking ID
    $bookingId = sanitize_input($_POST['booking_id']);

    // Validate the booking ID (add additional validation if needed)
    if (!empty($bookingId)) {
        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Perform the cancellation (update the status, delete the record, etc.)
        $sql = "UPDATE booking SET status = 'canceled' WHERE orderid = ?";
        $stmt = $conn->prepare($sql);

        if ($stmt) {
            // Bind parameters to the statement
            $stmt->bind_param("s", $bookingId);

            // Execute the statement
            if ($stmt->execute()) {
                // Close the statement
                $stmt->close();

                // Close the database connection
                $conn->close();

                // Display alert and redirect
                echo "<script>
                        alert('Booking with Order ID $bookingId canceled successfully.');
                        window.location.href = 'index.html';
                      </script>";
                exit(); // Ensure that no further content is sent to the browser
            } else {
                echo "Error updating status: " . $stmt->error;
            }

            // Close the statement
            $stmt->close();
        } else {
            echo "Error preparing statement: " . $conn->error;
        }

        // Close the database connection
        $conn->close();
    } else {
        echo "Please provide a valid booking ID.";
    }
}

// Function to sanitize user input
function sanitize_input($data)
{
    return htmlspecialchars($data, ENT_QUOTES, 'UTF-8');
}
?>
