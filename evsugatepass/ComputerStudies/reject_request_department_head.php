<?php
// Database connection
include "../db_connection.php";

// Get the ID of the request to be rejected
$id = $_GET['id'];

// Update the status of the request to "Rejected"
$sql = "UPDATE gatepass_data SET dh_status = 'Rejected' WHERE id = $id";

if ($conn->query($sql) === TRUE) {
    // Redirect back to the Department Head dashboard
    header("Location: index.php");
    exit();
} else {
    echo "Error updating record: " . $conn->error;
}

// Close connection
$conn->close();
?>
