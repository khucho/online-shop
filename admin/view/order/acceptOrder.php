<?php 

include_once __DIR__.'/../../controller/OrderController.php';

$orderCode = $_POST['orderCode'];

$order_con = new OrderController();
$status = $order_con->orderAccept($orderCode);

if($status)
{
    echo 'You accepted this order and sent mail to customer successfully';
}


?>