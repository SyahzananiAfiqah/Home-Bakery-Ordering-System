<?php
// update-order-status.php

include('../config/constants.php'); // Include the database connection script

if (isset($_POST['id']) && isset($_POST['status'])) {
    $orderId = $_POST['id'];
    $status = $_POST['status'];

    // Update the order status in the database
    $sql = "UPDATE tbl_order SET status = '$status' WHERE id = $orderId";
    $res = mysqli_query($conn, $sql);

    if ($res) {
        echo "success";
    } else {
        echo "error";
    }
} else {
    // Invalid request
    echo "invalid";
}

//mysqli_close($conn); // Close the database connection
?>
