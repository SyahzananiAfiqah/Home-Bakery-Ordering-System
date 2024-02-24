<?php
// Start the session if it's not already started
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Include the constants file
require_once('constants.php');

// Check if the user is not logged in
if (!isset($_SESSION['user_id'])) {
    // User is not logged in, redirect to the login page
    header('Location: ' . SITEURL . 'index.php');
    exit();
}

// Display user information or other dashboard content
// ...
?>

<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <div class="container">
        <h2>Welcome, <?php echo $_SESSION['username']; ?>!</h2>
        <!-- Display dashboard content here -->
    </div>
</body>
</html>
