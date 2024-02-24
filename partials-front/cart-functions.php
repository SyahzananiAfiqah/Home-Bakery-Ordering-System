<?php

// Check if the addToCart() function is already defined
if (!function_exists('addToCart')) {

    // Function to add an item to the cart
    function addToCart($cake_id, $title, $size, $price, $quantity)
    {
        // Initialize the cart if it's not set
        if (!isset($_SESSION['cart'])) {
            $_SESSION['cart'] = array();
        }

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
            $cake = array(
                'item_id' => $item_id,
                'cake_id' => $cake_id,
                'cake_title' => $title,
                'cake_size' => $size,
                'cake_price' => $price,
                'cake_quantity' => $quantity
            );

            $_SESSION['cart'][] = $cake;

            return true; // Item added successfully
        }

        return false; // Item already exists in the cart
    }
}

// Check if the removeFromCart() function is already defined
if (!function_exists('removeFromCart')) {

    // Function to remove an item from the cart
    function removeFromCart($item_id)
    {
        foreach ($_SESSION['cart'] as $key => $cartItem) {
            if ($cartItem['item_id'] === $item_id) {
                unset($_SESSION['cart'][$key]);
                return true; // Item removed successfully
            }
        }

        return false; // Item not found in the cart
    }
}

// Check if the updateCartItemQuantity() function is already defined
if (!function_exists('updateCartItemQuantity')) {

    // Function to update the quantity of an item in the cart
    function updateCartItemQuantity($item_id, $quantity)
    {
        foreach ($_SESSION['cart'] as $key => $cartItem) {
            if ($cartItem['item_id'] === $item_id) {
                $_SESSION['cart'][$key]['cake_quantity'] = $quantity;
                return true; // Quantity updated successfully
            }
        }

        return false; // Item not found in the cart
    }
}

// Check if the clearCart() function is already defined
if (!function_exists('clearCart')) {

    // Function to clear the cart
    function clearCart()
    {
        $_SESSION['cart'] = array();
    }
}

?>