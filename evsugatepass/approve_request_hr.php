<?php
// Database connection
include "db_connection.php";

// Get the ID of the request to be approved
$id = $_GET['id'];

// Update the status of the request to "Approved"
$sql = "UPDATE gatepass_data SET status = 'Approved' WHERE id = $id";

if ($conn->query($sql) === TRUE) {
    // Redirect back to the HR dashboard
    header("Location: dashboard.php");
    exit();
} else {
    echo "Error updating record: " . $conn->error;
}

// Close connection
$conn->close();
?>
