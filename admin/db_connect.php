<?php
// Start the session if it's not already started
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Include the constants file to get the database credentials
include('constants.php');

// Check if the database connection was successful
$conn = mysqli_connect(LOCALHOST, DB_USERNAME, DB_PASSWORD, DB_NAME);

// Check if the database connection was successful
if (!$conn) {
    die("Failed to connect to the database: " . mysqli_connect_error());
}

// Set the character set for the connection
mysqli_set_charset($conn, 'utf8');
?>
