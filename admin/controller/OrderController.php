<?php
include_once __DIR__.'/../model/Order.php';

class OrderController extends Order
{
    public function getOrders()
    {
        return $this->getOrderList();
    }

    public function getOrder($code)
    {
        return $this->getOrderInfo($code);
    }

    public function getUser($code)
    {
        return $this->getUserInfo($code);
    }

    public function orderPerMonth()
    {
        return $this->getOrderPerMonth();
    }
}