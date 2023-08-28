<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['product_id'])) {
    $productId = $_POST['product_id'];
    $quantity = (int)$_POST['quantity'];

    if (isset($_SESSION['cart'][$productId]) && $quantity > 0) {
        $_SESSION['cart'][$productId] = $quantity;
    }
}

header('Location: cart.php');
exit();
