<?php
include_once __DIR__.'/../model/Cart.php';

class CartController extends Cart
{
    public function getCart($id)
    {
        return $this->getCartInfo($id);
    }

    public function addToCart($userId,$productId,$qty)
    {
        return $this->addDataToCart($userId,$productId,$qty);
    }

    public function cartDetail($id)
    {
        return $this->getCartDetail($id);
    }

    public function removeCart($id)
    {
        return $this->deleteCart($id);
    }

    public function allCart()
    {
        return $this->getAllCart();
    }
}
?>