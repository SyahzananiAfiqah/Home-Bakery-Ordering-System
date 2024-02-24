<?php
// Start the session if it's not already started
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Check if the constants are not defined before defining them
if (!defined('SITEURL')) {
    define('SITEURL', 'http://localhost/');
}

if (!defined('LOCALHOST')) {
    define('LOCALHOST', 'localhost');
}

if (!defined('DB_USERNAME')) {
    define('DB_USERNAME', 'root');
}

if (!defined('DB_PASSWORD')) {
    define('DB_PASSWORD', '');
}

if (!defined('DB_NAME')) {
    define('DB_NAME', 'mia-jasmine');
}

// Database Connection
$conn = mysqli_connect(LOCALHOST, DB_USERNAME, DB_PASSWORD, DB_NAME);

// Check if the database connection was successful
if (!$conn) {
    die("Failed to connect to the database: " . mysqli_connect_error());
}

// Set the character set for the connection
mysqli_set_charset($conn, 'utf8');
?>