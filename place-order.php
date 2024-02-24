<?php
// Start the session if it's not already started
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

include('config/constants.php'); // Include the constants.php file to establish the database connection
include('partials-front/menu.php');

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

// Check if the form was submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_POST['submit'])) {
    // Retrieve form data
    $name = $_POST['name'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $address = $_POST['address'];
    $deliveryMethod = $_POST['delivery_method'];
    $paymentMethod = $_POST['payment'];

    // Process the order based on the selected payment method and bank
    // var_dump($_POST);
    // die();
    if ($paymentMethod === 'cash') {
        // Handle cash on delivery payment method
        // ...

        // Get the cart items from the session
        $cartItems = isset($_SESSION['cart']) ? $_SESSION['cart'] : array();

        // Calculate the total price
        $totalPrice = 0;
        foreach ($cartItems as $cartItem) {
            $price = $cartItem['cake_price'];
            $quantity = $cartItem['cake_quantity'];
            $subtotal = $price * $quantity;
            $totalPrice += $subtotal;
        }

        // Insert order details into the database
        $sql = "INSERT INTO tbl_order (customer_name, customer_contact, customer_email, customer_address, delivery_method, payment_method, total_price)
                VALUES ('$name', '$phone', '$email', '$address', '$deliveryMethod', 'cash', '$totalPrice')";

      
        // Execute the query
        $res = mysqli_query($conn, $sql);



        if ($res) {
            // Order details inserted successfully
            $orderId = mysqli_insert_id($conn);

            // Insert the cake items into the order_items table
            foreach ($cartItems as $cartItem) {
                $cake_id = $cartItem['cake_id'];
                $size = $cartItem['cake_size'];
                $quantity = $cartItem['cake_quantity'];

                $sql_items = "INSERT INTO tbl_order_items (order_id, cake_id, size, quantity)
                              VALUES ('$orderId', '$cake_id', '$size', '$quantity')";
                mysqli_query($conn, $sql_items);
            }

            // Update the order status to "Ordered"
            $updateStatusSql = "UPDATE tbl_order SET status = 'Ordered' WHERE id = '$orderId'";
            mysqli_query($conn, $updateStatusSql);

            // Clear the cart after placing the order
            $_SESSION['cart'] = array();

            // Redirect or display a thank you message
            header('Location: thank-you.php');
            exit();
        } else {
            // Failed to insert order details
            // Handle the error or redirect to an error page
            echo "Failed to insert order details: " . mysqli_error($conn); // Debugging statement
        }
    } elseif ($paymentMethod === 'online_transfer') {
        // Handle online transfer payment method
        // ...

        // Get the cart items from the session
        $cartItems = isset($_SESSION['cart']) ? $_SESSION['cart'] : array();

        // Insert order details into the database
        $sql = "INSERT INTO tbl_order (customer_name, customer_contact, customer_email, customer_address, delivery_method, payment_method, total_price)
                VALUES ('$name', '$phone', '$email', '$address', '$deliveryMethod', 'online_transfer', 0)";

        // Execute the query
        $res = mysqli_query($conn, $sql);

        if ($res) {
            // Order details inserted successfully
            $orderId = mysqli_insert_id($conn);

            // Update the total price for the order
            $totalPrice = 0;
            foreach ($cartItems as $cartItem) {
                $cake_id = $cartItem['cake_id'];
                $size = $cartItem['cake_size'];
                $quantity = $cartItem['cake_quantity'];

                // Retrieve the price based on the cake ID and size
                $price = 0;
                $sql_price = "SELECT * FROM tbl_cake WHERE id = '$cake_id'";
                $res_price = mysqli_query($conn, $sql_price);
                if ($res_price && mysqli_num_rows($res_price) > 0) {
                    $row_price = mysqli_fetch_assoc($res_price);
                    if ($size === 'loaf') {
                        $price = $row_price['price_loaf'];
                    } elseif ($size === 'half') {
                        $price = $row_price['price_half'];
                    } elseif ($size === 'full') {
                        $price = $row_price['price_full'];
                    }
                }

                $subtotal = $price * $quantity;
                $totalPrice += $subtotal;

                // Insert the cake items into the order_items table
                $sql_items = "INSERT INTO tbl_order_items (order_id, cake_id, size, quantity)
                              VALUES ('$orderId', '$cake_id', '$size', '$quantity')";
                mysqli_query($conn, $sql_items);
            }

            // Update the total price for the order
            $updateSql = "UPDATE tbl_order SET total_price = '$totalPrice' WHERE id = '$orderId'";
            mysqli_query($conn, $updateSql);

            // Clear the cart after placing the order
            $_SESSION['cart'] = array();

            // Prepare the total price to be included in the bank transfer URL
            $formattedTotalPrice = number_format($totalPrice, 2);

            // Redirect the customer to the respective bank's website for online transfer
            $bankTransferUrl = '';
            if (isset($_POST['bank'])) {
                switch ($_POST['bank']) {
                    case 'affin_bank':
                        $bankTransferUrl = 'https://www.affinbank.com.my?amount=' . $formattedTotalPrice;
                        break;
                    case 'ambank':
                        $bankTransferUrl = 'https://www.ambank.com.my?total=' . $formattedTotalPrice;
                        break;
                    case 'bank_rakyat':
                        $bankTransferUrl = 'https://www.bankrakyat.com.my?total_amount=' . $formattedTotalPrice;
                        break;
                    case 'bank_islam':
                        $bankTransferUrl = 'https://www.bankislam.com?amount=' . $formattedTotalPrice;
                        break;
                    case 'bank_muamalat':
                        $bankTransferUrl = 'https://www.muamalat.com.my?amount=' . $formattedTotalPrice;
                        break;
                    case 'bank_simpanan_nasional':
                        $bankTransferUrl = 'https://www.mybsn.com.my?amount=' . $formattedTotalPrice;
                        break;
                    case 'cimb_bank':
                        $bankTransferUrl = 'https://www.cimbclicks.com.my?total=' . $formattedTotalPrice;
                        break;
                    case 'hong_leong_bank':
                        $bankTransferUrl = 'https://www.hlb.com.my?total_amount=' . $formattedTotalPrice;
                        break;
                    case 'maybank':
                        $bankTransferUrl = 'https://www.maybank2u.com.my?amount=' . $formattedTotalPrice;
                        break;
                    case 'public_bank':
                        $bankTransferUrl = 'https://www.pbebank.com?total=' . $formattedTotalPrice;
                        break;
                    case 'rhb_bank':
                        $bankTransferUrl = 'https://logon.rhb.com.my?amount=' . $formattedTotalPrice;
                        break;
                    case 'standard_chartered':
                        $bankTransferUrl = 'https://www.sc.com/my?total_amount=' . $formattedTotalPrice;
                        break;
                    case 'uob_bank':
                        $bankTransferUrl = 'https://www.uob.com.my?amount=' . $formattedTotalPrice;
                        break;
                    default:
                        // Handle invalid bank selection
                        break;
                }

                // Redirect the customer to the respective bank's website for online transfer
                if (!empty($bankTransferUrl)) {
                    header('Location: ' . $bankTransferUrl);
                    exit();
                } 
            }
        }
        } elseif ($paymentMethod === 'debit_card') {
            // Handle debit card payment method
            $cardNumber = $_POST['card_number'];
            $cardHolder = $_POST['card_holder'];
            $expiryDate = $_POST['expiry_date'];
            $cvv = $_POST['cvv'];
    
            // Process the debit card payment
            $debitCardPaymentResult = processDebitCardPayment($cardNumber, $cardHolder, $expiryDate, $cvv);
    
            if ($debitCardPaymentResult['status'] === 'success') {
                // Get the cart items from the session
                $cartItems = isset($_SESSION['cart']) ? $_SESSION['cart'] : array();
    
                // Calculate the total price
                $totalPrice = 0;
                foreach ($cartItems as $cartItem) {
                    $price = $cartItem['cake_price'];
                    $quantity = $cartItem['cake_quantity'];
                    $subtotal = $price * $quantity;
                    $totalPrice += $subtotal;
                }
    
                // Insert order details into the database
                $sql = "INSERT INTO tbl_order (customer_name, customer_contact, customer_email, customer_address, delivery_method, payment_method, total_price)
                        VALUES ('$name', '$phone', '$email', '$address', '$deliveryMethod', 'online_transfer', '$totalPrice')";
    
                // Execute the query
                $res = mysqli_query($conn, $sql);
    
                if ($res) {
                    // Order details inserted successfully
                    $orderId = mysqli_insert_id($conn);
    
                    // Insert the cake items into the order_items table
                    foreach ($cartItems as $cartItem) {
                        $cake_id = $cartItem['cake_id'];
                        $size = $cartItem['cake_size'];
                        $quantity = $cartItem['cake_quantity'];
    
                        $sql_items = "INSERT INTO tbl_order_items (order_id, cake_id, size, quantity)
                                      VALUES ('$orderId', '$cake_id', '$size', '$quantity')";
                        mysqli_query($conn, $sql_items);
                    }
    
                    // Update the order status to "Ordered"
                    $updateStatusSql = "UPDATE tbl_order SET status = 'Ordered' WHERE id = '$orderId'";
                    mysqli_query($conn, $updateStatusSql);
    
                    // Clear the cart after placing the order
                    $_SESSION['cart'] = array();
    
                    // Redirect or display a thank you message
                    header('Location: thank-you.php');
                    exit();
                } else {
                    // Failed to insert order details
                    // Handle the error or redirect to an error page
                    echo "Failed to insert order details: " . mysqli_error($conn); // Debugging statement
                }
            } else {
                // Debit card payment failed
                // Handle the error or redirect to an error page
                echo "Payment Failed: " . $debitCardPaymentResult['message']; // Debugging statement
            }
        }
    }
    ?>