<?php
// Start the session if it's not already started
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// LOad environment variables from .env file
require_once __DIR__ . '/vendor/autoload.php';
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

// Access environment variables directly
$db_host = $_ENV['DB_HOST'];
$db_user = $_ENV['DB_USER'];
$db_pass = $_ENV['DB_PASS'];

//include the menu file which may have header, navigation, etc.
include('partials-front/menu.php');
include('config/constants.php');
include('partials-front/cart-functions.php');

// Function to process debit card payment (fake implementation)
function processDebitCardPayment($cardNumber, $cardHolder, $expiryDate, $cvv)
{
    // In a real payment gateway, you would validate the card details, process the payment,
    // and return a response from the payment gateway (success, error, etc.).
    // For this example, we'll assume the payment is always successful.

    // Simulate a payment gateway response (success)
    $response = array(
        'status' => 'success',
        'message' => 'Payment successful!',
        'transaction_id' => '1234567890', // You can generate a unique transaction ID here
    );

    return $response;
}

?>

<section class="cart" style="background-color: black;">
    <div class="container">
        <h2 class="text-center" style="color: white !important;">Your Cart</h2>

        <?php

        // Initialize the cart if it's not set
        if (!isset($_SESSION['cart'])) {
            $_SESSION['cart'] = array();
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_POST['submit'])) {
            $cake_ids = isset($_POST['cake_id']) ? $_POST['cake_id'] : array();
            $cake_titles = isset($_POST['cake_title']) ? $_POST['cake_title'] : array();
            $cake_sizes = isset($_POST['cake_size']) ? $_POST['cake_size'] : array();
            $cake_quantities = isset($_POST['cake_quantity']) ? $_POST['cake_quantity'] : array();

            // Add the selected items to the cart
            $count = count($cake_ids); // Get the count of items
            for ($i = 0; $i < $count; $i++) {
                $cake_id = $cake_ids[$i];
                $title = $cake_titles[$i];
                $size = $cake_sizes[$i];
                $quantity = $cake_quantities[$i];

                // Generate a unique identifier for the cake item
                $item_id = $cake_id . '_' . $size;

                // Check if the item already exists in the cart
                $item_exists = false;
                foreach ($_SESSION['cart'] as $key => $cartItem) {
                    if ($cartItem['item_id'] === $item_id) {
                        $item_exists = true;
                        break;
                    }
                }

                // If the item doesn't exist, add it to the cart
                if (!$item_exists) {
                    // Retrieve the price based on the cake ID and size
                    $price = 0;
                    $sql = "SELECT * FROM tbl_cake WHERE id = '$cake_id'";
                    $res = mysqli_query($conn, $sql);
                    if ($res && mysqli_num_rows($res) > 0) {
                        $row = mysqli_fetch_assoc($res);
                        if ($size === 'loaf') {
                            $price = $row['price_loaf'];
                        } elseif ($size === 'half') {
                            $price = $row['price_half'];
                        } elseif ($size === 'full') {
                            $price = $row['price_full'];
                        }
                    }

                    $cake = array(
                        'item_id' => $item_id,
                        'cake_id' => $cake_id,
                        'cake_title' => $title,
                        'cake_size' => $size,
                        'cake_price' => $price,
                        'cake_quantity' => $quantity
                    );

                    $_SESSION['cart'][] = $cake;
                }
            }
        }

        if (!empty($_SESSION['cart'])) {
            $totalPrice = 0; // Initialize the total price variable
            ?>
            <div class="cart-table">
                <table>
                    <thead>
                        <tr>
                            <th style="color: white;">Item</th>
                            <th style="color: white;">Size</th>
                            <th style="color: white;">Price</th>
                            <th style="color: white;">Quantity</th>
                            <th style="color: white;">Subtotal</th>
                            <th style="color: white;">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($_SESSION['cart'] as $key => $cartItem) {
                            $cake_id = isset($cartItem['cake_id']) ? $cartItem['cake_id'] : '';
                            $title = isset($cartItem['cake_title']) ? $cartItem['cake_title'] : '';
                            $size = isset($cartItem['cake_size']) ? $cartItem['cake_size'] : '';
                            $price = isset($cartItem['cake_price']) ? $cartItem['cake_price'] : 0;
                            $quantity = isset($cartItem['cake_quantity']) ? $cartItem['cake_quantity'] : 0;

                            // Calculate the subtotal for the current item
                            $subtotal = $price * $quantity;
                            $totalPrice += $subtotal; // Add the subtotal to the total price
                            ?>
                            <tr>
                                <td style="color: white;"><?php echo $title; ?></td>
                                <td style="color: white;">
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
                                    }
                                    ?>
                                </td>
                                <td style="color: white;">RM<?php echo $price; ?></td>
                                <td style="color: white;"><?php echo $quantity; ?></td>
                                <td style="color: white;">RM<?php echo $subtotal; ?></td>
                                <td>
                                    <form action="remove-item.php" method="POST">
                                        <input type="hidden" name="item_id" value="<?php echo $cartItem['item_id']; ?>">
                                        <input type="submit" name="submit" value="Delete" class="btn btn-delete btn-sm" style="color: white;">
                                    </form>
                                </td>
                            </tr>
                            <?php
                        }
                        ?>
                        <tr>
                            <td colspan="5" class="text-right">Total Price:</td>
                            <td style="color: white;">RM<?php echo $totalPrice; ?></td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <br><br>
            <div class="order-form">
                <h3 style="color: white;">Enter Your Details</h3>
                <br><br>
                <form action="place-order.php" method="POST">
                    <div class="form-group">
                        <label for="name" style="color: white;">Name:</label>
                        <input type="text" id="name" name="name" placeholder="Enter your name" required>
                    </div>
                    <div class="form-group">
                        <label for="phone" style="color: white;">Phone Number:</label>
                        <input type="tel" id="phone" name="phone" placeholder="Enter your phone number" required>
                    </div>
                    <div class="form-group">
                        <label for="email" style="color: white;">Email:</label>
                        <input type="email" id="email" name="email" placeholder="Enter your email" required>
                    </div>
                    <div class="form-group">
                        <label for="address" style="color: white;">Address:</label>
                        <textarea id="address" name="address" placeholder="Enter your address" required></textarea>
                    </div>
                    <div class="form-group">
                        <label for="delivery_method" style="color: white;">Delivery Method:</label>
                        <select id="delivery_method" name="delivery_method" required>
                            <option value="" selected disabled>Select delivery method</option>
                            <option value="pickup">Pickup</option>
                            <option value="delivery">Home Delivery</option>
                        </select>
                    </div>
                    <div id="pickup_address" style="display: none; color: white;">
                        <label style="color: white;">Pickup Address:</label>
                        <p>53A, Jalan Jasmin 3, Laman Jasmin, Nilai Impian, 71800, Nilai, Negeri Sembilan</p>
                    </div>
                    <br>
                    <div class="form-group">
                        <label for="payment" style="color: white;">Payment Method:</label>
                        <select id="payment" name="payment" required>
                            <option value="" selected disabled>Select payment method</option>
                            <option value="cash">Cash on Delivery</option>
                            <option value="debit_card">Debit Card</option>
                            <option value="online_transfer">Online Transfer</option>
                        </select>
                    </div>
                    <div id="bank-selection" style="display: none;">
                        <div class="form-group">
                            <label for="bank" style="color: white;">Select Bank:</label>
                            <select id="bank" name="bank">
                                <option value="" selected disabled>Select bank</option>
                                <option value="affin_bank">Affin Bank</option>
                                <option value="ambank">AmBank</option>
                                <option value="bank_rakyat">Bank Rakyat</option>
                                <option value="bank_islam">Bank Islam</option>
                                <option value="bank_muamalat">Bank Muamalat</option>
                                <option value="bank_simpanan_nasional">Bank Simpanan Nasional</option>
                                <option value="cimb_bank">CIMB Bank</option>
                                <option value="hong_leong_bank">Hong Leong Bank</option>
                                <option value="maybank">Maybank</option>
                                <option value="public_bank">Public Bank</option>
                                <option value="rhb_bank">RHB Bank</option>
                                <option value="standard_chartered">Standard Chartered</option>
                                <option value="uob_bank">UOB Bank</option>
                            </select>
                        </div>
                    </div>
                    <div id="debit_card_details" style="display: none;">
                        <div class="form-group">
                            <label for="card_number">Card Number:</label>
                            <input type="text" id="card_number" name="card_number" placeholder="Enter your card number">
                        </div>
                        <div class="form-group">
                            <label for="card_holder">Card Holder:</label>
                            <input type="text" id="card_holder" name="card_holder" placeholder="Enter the card holder's name">
                        </div>
                        <div class="form-group">
                            <label for="expiry_date">Expiry Date:</label>
                            <input type="text" id="expiry_date" name="expiry_date" placeholder="MM/YY">
                        </div>
                        <div class="form-group">
                            <label for="cvv">CVV:</label>
                            <input type="text" id="cvv" name="cvv" placeholder="CVV">
                        </div>
                    </div>

                    <br>

                    <input type="submit" name="submit" value="Place Order" class="btn btn-primary">
                </form>
            </div>
            <?php
        } else {
            echo "<div class='empty-cart'>Your cart is empty. <a href='".SITEURL."cakes.php'>Browse cakes</a></div>";
            $_SESSION['cart'] = array(); // Reset the cart to an empty array
        }
        ?>

    </div>
</section>

<?php include('partials-front/footer.php'); ?>

<style>

    .empty-cart{
        color: white;
    }

    .btn-delete {
        background-color: #ff4d4d;
        color: #fff;
        border: none;
        padding: 5px 10px;
        font-size: 14px;
        cursor: pointer;
    }

    .btn-delete:hover {
        background-color: #ff3333;
    }

    .order-form {
        margin-top: 20px;
        padding: 20px;
        background-color: #0000;
        border-radius: 5px;
    }

    .form-group {
        margin-bottom: 15px;
    }

    .form-group label {
        display: block;
        margin-bottom: 5px;
        font-weight: bold;
    }

    .form-group input,
    .form-group textarea,
    .form-group select {
        width: 100%;
        padding: 10px;
        border: 1px solid #ccc;
        border-radius: 4px;
    }

    .btn-primary {
        background-color: #d94076;
        color: #fff;
        border: none;
        padding: 10px 20px;
        font-size: 16px;
        cursor: pointer;
    }

    .btn-primary:hover {
        background-color: #d94076;
    }

</style>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        const paymentMethodSelect = document.getElementById("payment");
        const bankSelection = document.getElementById("bank-selection");
        const debitCardDetails = document.getElementById("debit_card_details");

        paymentMethodSelect.addEventListener("change", function() {
            const selectedPaymentMethod = paymentMethodSelect.value;
            if (selectedPaymentMethod === "online_transfer") {
                bankSelection.style.display = "block";
                debitCardDetails.style.display = "none";
            } else if (selectedPaymentMethod === "debit_card") {
                bankSelection.style.display = "none";
                debitCardDetails.style.display = "block";
            } else {
                bankSelection.style.display = "none";
                debitCardDetails.style.display = "none";
            }
        });
    });
</script>




