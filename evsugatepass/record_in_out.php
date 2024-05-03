<?php
// Include database connection file
include "db_connection.php";

// Check if request ID and action are provided
if (isset($_GET['id']) && isset($_GET['action'])) {
    // Sanitize and validate input parameters
    $request_id = $_GET['id'];
    $action = $_GET['action'];

    // Ensure action is either "In" or "Out"
    if ($action !== 'In' && $action !== 'Out') {
        die("Invalid action.");
    }

    // Update the corresponding column in the database
    $column = ($action === 'In') ? 'in_action' : 'out_action';
    $timestamp = date('Y-m-d H:i:s'); // Current timestamp

    $sql = "UPDATE gatepass_data SET $column = '$timestamp' WHERE id = $request_id";

    
    
    



    if ($conn->query($sql) === TRUE) {
        // Action recorded successfully
        echo "Action recorded successfully!";
    } else {
        // Error recording action
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
    if ($conn->query($sql) === TRUE) {
    // Redirect back to the Department Head dashboard
    header("Location: index.php");
    exit();
} else {
    echo "Error updating record: " . $conn->error;
}
} else {
    // Missing parameters
    echo "Missing request ID or action.";
}


// Close database connection
$conn->close();
?>
