<?php 
    // Include Constants Page
    include('../config/constants.php');

    if(isset($_GET['id']))
    {
        // Process to Delete
        $id = $_GET['id'];

        // Delete Order from Database
        $sql = "DELETE FROM tbl_order_items WHERE order_id=$id";
        $res = mysqli_query($conn, $sql);

        $sql = "DELETE FROM tbl_order WHERE id=$id";
        $res = mysqli_query($conn, $sql);

       
        if($res == true)
        {
            // Order Deleted
            $_SESSION['delete'] = "<div class='success'>Order Deleted Successfully.</div>";
            header('location: manage-order.php');
        }
        else
        {
            // Failed to Delete Order
            $_SESSION['delete'] = "<div class='error'>Failed to Delete Order.</div>";
            header('location: manage-order.php');
        }
    }
    else
    {
        // Redirect to Manage Order Page
        $_SESSION['unauthorize'] = "<div class='error'>Unauthorized Access.</div>";
        header('location: manage-order.php');
    }
?>
