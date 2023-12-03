<!-- Include SweetAlert CSS and JS -->
<html>
<head>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@10">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
</head>
<body>
</body>
</html>

<?php
// Assuming you have a MySQL database connection
include 'connection.php';
error_reporting(E_ALL);
ini_set('display_errors', 1);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $dateString = $_POST['date'];
    $startTime = $_POST['start-time'];
    $endTime = $_POST['end-time'];

    $adults = $_POST['adults'];
    $children = $_POST['children'];
    $youngChildren = $_POST['young-children'];

    // Convert date to the correct format (assuming date is in 'DD-MM-YYYY' format)
    $date = DateTime::createFromFormat('d-m-Y', $dateString);
    $dateFormatted = $date ? $date->format('Y-m-d') : null;

    // Check for overlapping bookings
    if (!isBookingConflict($conn, $dateFormatted, $startTime, $endTime)) {
        // Perform any other necessary validation or processing here

        // Insert data into the "court" table using prepared statement
        $stmt = $conn->prepare("INSERT INTO court (date, starttime, endtime, adults, children, young_children) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("ssssss", $dateFormatted, $startTime, $endTime, $adults, $children, $youngChildren);

        if ($stmt->execute()) {
            $id = $conn->insert_id;

            // Close the prepared statement
            $stmt->close();

            // Use SweetAlert to display a success message and redirect
            echo "<script>
                Swal.fire({
                    icon: 'success',
                    title: 'Success',
                    text: 'Time Slot Available',
                }).then(() => {
                    window.location.href = 'bookings.php?id=$id';
                });
            </script>";
            exit();
        } else {
            echo "Error: " . $stmt->error;
        }
    } else {
        // Use SweetAlert to display an error message and redirect to the booking form
        echo "<script>
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'Overlapping booking detected. Please choose a different date or time.',
            }).then(() => {
                window.location.href = 'court-booking.html';
            });
        </script>";
        exit();
    }
} 

$conn->close();

function isBookingConflict($conn, $date, $startTime, $endTime) {
    $stmt = $conn->prepare("SELECT COUNT(*) FROM court WHERE date = ? AND ((starttime = ? AND endtime = ?) OR (starttime = ? AND endtime = ?))");
    $stmt->bind_param("sssss", $date, $endTime, $startTime, $endTime, $startTime);

    if (!$stmt) {
        die("Error preparing statement: " . $conn->error);
    }

    $stmt->execute();

    $stmt->bind_result($count);

    $stmt->fetch();

    $stmt->close();

    return $count > 0;
}
?>
