<?php

include_once __DIR__.'/../model/Order.php';

class OrderController extends Order 
{
    public function addOrder($userId,$order,$orderCode)
    {
        
        return $this->createOrder($userId,$order,$orderCode);
    }

    public function addOrderDetail($userId,$orderCode,$townshipId)
    {
        return $this->createOrderDetail($userId,$orderCode,$townshipId);
    }

    public function orderCode()
    {
        return $this->getOrderCode();
    }
}

?>