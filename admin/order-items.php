<?php
// Start the session if it's not already started
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

include('../config/constants.php'); // Include the constants.php file to establish the database connection
include('partials/menu.php');
?>

<div class="main-content">
    <div class="wrapper">
        <?php
        if (isset($_GET['id'])) {
            $order_id = $_GET['id'];

            // Retrieve order details from the database based on the order ID
            $sql = "SELECT * FROM tbl_order WHERE id = $order_id";
            $res = mysqli_query($conn, $sql);

            if ($res) {
                if (mysqli_num_rows($res) > 0) {
                    $row = mysqli_fetch_assoc($res);
                    $totalPrice = $row['total_price'];

                    ?>

                    <h1>Order Items</h1>

                    <br><br>

                    <table class="cart-table bigger-table">
                        <thead>
                            <tr>
                                <th>Item</th>
                                <th>Size</th>
                                <th>Price</th>
                                <th>Quantity</th>
                                <th>Subtotal</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            // Retrieve cake items for this order from order_items table
                            $sql_items = "SELECT * FROM tbl_order_items WHERE order_id = $order_id";
                            $res_items = mysqli_query($conn, $sql_items);
                            if ($res_items && mysqli_num_rows($res_items) > 0) {
                                $totalSubtotal = 0; // Initialize the total subtotal variable

                                while ($row_item = mysqli_fetch_assoc($res_items)) {
                                    $cake_id = $row_item['cake_id'];
                                    $size = $row_item['size'];
                                    $quantity = $row_item['quantity'];

                                    // Retrieve the cake details from the tbl_cake table
                                    $sql_cake = "SELECT * FROM tbl_cake WHERE id = $cake_id";
                                    $res_cake = mysqli_query($conn, $sql_cake);
                                    if ($res_cake && mysqli_num_rows($res_cake) > 0) {
                                        $row_cake = mysqli_fetch_assoc($res_cake);
                                        $cake_title = $row_cake['title'];

                                        // Determine the price based on the selected size
                                        $price = 0;
                                        switch ($size) {
                                            case 'loaf':
                                                $price = $row_cake['price_loaf'];
                                                break;
                                            case 'half':
                                                $price = $row_cake['price_half'];
                                                break;
                                            case 'full':
                                                $price = $row_cake['price_full'];
                                                break;
                                        }

                                        // Calculate the subtotal for this cake item
                                        $subtotal = $price * $quantity;
                                        $totalSubtotal += $subtotal;
                                        ?>

                                        <tr>
                                            <td><?php echo $cake_title; ?></td>
                                            <td>
                                                <?php
                                                switch ($size) {
                                                    case 'loaf':
                                                        echo 'Loaf Size';
                                                        break;
                                                    case 'half':
                                                        echo 'Half Size';
                                                        break;
                                                    case 'full':
                                                        echo 'Full Size';
                                                        break;
                                                    default:
                                                        echo '';
                                                }
                                                ?>
                                            </td>
                                            <td>RM<?php echo $price; ?></td>
                                            <td><?php echo $quantity; ?></td>
                                            <td>RM<?php echo $subtotal; ?></td>
                                        </tr>
                                    <?php
                                    } else {
                                        echo "<tr><td colspan='5'>Cake details not found</td></tr>";
                                    }
                                }

                                ?>
                                <tr>
                                    <td colspan="4" class="text-right">Total:</td>
                                    <td>RM<?php echo $totalSubtotal; ?></td>
                                </tr>
                            <?php
                            } else {
                                // No cake items found for the given order ID
                                echo "<tr><td colspan='5'>No cake items found for this order.</td></tr>";
                            }
                            ?>
                        </tbody>
                    </table>

                    <?php
                } else {
                    // No order details found for the given order ID
                    echo "<div class='error'>Order items not found.</div>";
                }
            } else {
                // Error executing the query
                echo "Error executing query: " . mysqli_error($conn);
                exit;
            }
        } else {
            // Order ID is not set in the URL
            echo "<div class='error'>Invalid request.</div>";
        }
        ?>
    </div>
</div>

<?php
include('partials/footer.php');
?>

<style>
    .cart-table.bigger-table {
        width: 100%;
        font-size: 16px;
    }
</style>
