<?php
session_start();

// Check if the item_id is provided
if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_POST['item_id'])) {
    $item_id = $_POST['item_id'];

    // Find the item in the cart and remove it
    if (!empty($_SESSION['cart'])) {
        foreach ($_SESSION['cart'] as $key => $cartItem) {
            if ($cartItem['item_id'] === $item_id) {
                unset($_SESSION['cart'][$key]); // Remove the item from the cart
                break;
            }
        }
    }
}

header("Location: cart.php"); // Redirect back to the cart page
?>