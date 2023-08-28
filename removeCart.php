<?php 
include_once __DIR__.'/controller/CartController.php';

$id = $_POST['id'];

$cart_controller = new CartController();
$removeStatus = $cart_controller->removeCart($id);

if ($removeStatus)
{
    echo 'Removed item successfully';
}

?>