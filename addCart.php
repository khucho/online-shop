<?php
session_start();
include_once __DIR__.'/controller/CartController.php';

$productId = $_POST['id'];
//
if(isset($_SESSION['id'])){
    $userId = $_SESSION['id'];
}

if (isset($_POST['qty']))
{
    $qty = $_POST['qty'];
}
else 
{
    $qty = 1;
}

if(!isset($_SESSION['id'])){
    echo "You must need to login to add product to cart";
}
else{
    $cart_controller = new CartController();
    $result = $cart_controller->addToCart($userId,$productId,$qty);


    if ($result)
    {
        echo 'Added to cart successfully';
    }
}



?>