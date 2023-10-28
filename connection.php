<?php
// Set the timezone to Asia/Manila
date_default_timezone_set("Asia/Manila");

// Get the current date and time in a specific format
$date = date('F j, Y g:i:a');

// Database connection parameters
$host = "127.0.0.1";
$username = "root";
$password = "";
$database = "rentalytics";

// Establish a database connection
$conn = mysqli_connect($host, $username, $password, $database);

// Check if the connection was successful
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
?>
