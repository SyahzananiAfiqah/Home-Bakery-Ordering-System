<?php
include('partials/menu.php');

if (isset($_GET['id'])) {
    $order_id = $_GET['id'];

    // Retrieve customer details from the database based on the order ID
    $sql = "SELECT * FROM tbl_order WHERE id = $order_id";
    $res = mysqli_query($conn, $sql);

    if ($res && mysqli_num_rows($res) > 0) {
        $row = mysqli_fetch_assoc($res);
        $customer_name = $row['customer_name'];
        $customer_contact = $row['customer_contact'];
        $customer_email = $row['customer_email'];
        $customer_address = $row['customer_address'];
        $delivery_method = $row['delivery_method'];
        $payment_method = $row['payment_method'];
        ?>

        <div class="main-content">
            <div class="wrapper">
                <h1>Customer Details</h1>

                <br><br>

                <table class="tbl-full">
                    <tr>
                        <td><strong>Name:</strong></td>
                        <td><?php echo $customer_name; ?></td>
                    </tr>
                    <tr>
                        <td><strong>Phone Number:</strong></td>
                        <td><?php echo $customer_contact; ?></td>
                    </tr>
                    <tr>
                        <td><strong>Email Address:</strong></td>
                        <td><?php echo $customer_email; ?></td>
                    </tr>
                    <tr>
                        <td><strong>Address:</strong></td>
                        <td><?php echo $customer_address; ?></td>
                    </tr>
                    <tr>
                        <td><strong>Delivery Method:</strong></td>
                        <td><?php echo $delivery_method; ?></td>
                    </tr>
                    <tr>
                        <td><strong>Payment Method:</strong></td>
                        <td><?php echo $payment_method; ?></td>
                    </tr>
                </table>
            </div>
        </div>

        <?php
    } else {
        // No customer details found for the given order ID
        echo "<div class='error'>Customer details not found.</div>";
    }
} else {
    // Order ID is not set in the URL
    echo "<div class='error'>Invalid request.</div>";
}

include('partials/footer.php');
?>
