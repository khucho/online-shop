<?php
session_start();
include_once __DIR__.'/controller/OrderController.php';
include_once __DIR__.'/controller/CartController.php';
include_once __DIR__.'/controller/CodeController.php';

$userId = $_SESSION['id'];
$orders = $_POST['data'];
$vcCode = $_POST['vcCode'];

$code_controller = new CodeController();
$order_controller = new OrderController();
$cart_controller = new CartController();


$voucherCodes = $code_controller->codes();

if (!empty($voucherCodes))
{
  foreach ($voucherCodes as $voucherCode )
  {
    if ($voucherCode['used_by_user'] != null)
    {
        $usedCodeList[] += $voucherCode['code'];
    }
    else 
    {
        $freeCodeList[] += $voucherCode['code'];
    }
  }
}

if (in_array($vcCode,$usedCodeList))
{
    echo 'This voucher code is already used';
}
else 
{
   
    if (in_array($vcCode,$freeCodeList))
    {
        
        $date = date('Y-m-d');

        $usedVcCode = $code_controller->editVcCode($userId,$vcCode,$date);

        $orderCodes = $order_controller->orderCode();

        if (!empty($orderCodes))
        {
          foreach ($orderCodes as $orderCode )
          {
            $orderCodeList[] += $orderCode['order_code'];
          }
        }

        $orderCode = rand(00001,99999);

        if ($orderCodeList != null )
        {
            while (in_array($orderCode,$orderCodeList))
            {
                $orderCode++;
            }   
        }





        foreach ($orders as $order)
        {
   

            $addOrderStatus = $order_controller->addOrder($userId,$order,$orderCode);

            if ($addOrderStatus)
            {
                $addOrderDetail = $order_controller->addOrderDetail($userId,$orderCode);

                if ($addOrderDetail)
                {
                    foreach ($orders as $order)
                    {
                        $removeCart = $cart_controller->removeCart($order['product_id']);
                    }
                }
            }

        }



        if ($removeCart)
        {
            echo 'Your Order is success';
        }
        else 
        {
            echo 'Something went wrong';
        }
    }
    else 
    {
        echo 'Invalid Voucher Code';
    }
}





?>