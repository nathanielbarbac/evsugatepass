<?php
// Database connection
include "db_connection.php"; // Include the database connection file

// Form data
$name = $_POST['name'];
$date_time = $_POST['date'];
$destination = $_POST['destination'];
$purpose = $_POST['purpose'];
$duration_hours = $_POST['duration_hours'];
$duration_minutes = $_POST['duration_minutes'];
$employee_name = $_POST['employee_name'];
$email = $_POST['email'];
$department = $_POST['department'];
$phone = $_POST['phone'];

// SQL query to insert data into the table
$sql = "INSERT INTO gatepass_data (name, date_time, destination, purpose, duration_hours, duration_minutes, employee_name, email, department, phone)
        VALUES ('$name', '$date_time', '$destination', '$purpose', '$duration_hours', '$duration_minutes', '$employee_name', '$email', '$department', '$phone')";

if ($conn->query($sql) === TRUE) {
    // Display a success message using JavaScript
    echo "<script>alert('Record successfully submitted');</script>";
    // Add a button to redirect to employee.php
    echo "<button onclick=\"window.location.href='index.php';\">Add New Record</button>";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

// Close connection
$conn->close();
?>
