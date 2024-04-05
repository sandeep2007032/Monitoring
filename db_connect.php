<?php
// Database configuration
$db_host = 'localhost'; // Your database host
$db_username = 'root'; // Your database username
$db_password = ''; // Your database password
$db_name = 'mon'; // Your database name

// Attempt to establish a connection
$conn = new mysqli($db_host, $db_username, $db_password, $db_name);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Optional: Set character set to utf8
$conn->set_charset("utf8");

// Optional: You may also want to return $conn or store it in a global variable for reuse in other files.
?>
