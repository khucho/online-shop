<?php

include_once __DIR__.'/../model/Product.php';

class ProductController extends Product 
{
    public function productList()
    {
        return $this->getProducts();
    }

    public function productDetail($id)
    {

        return $this->getProductDetail($id);
    }
    public function getLatestProduct()
    {
        return $this->getLatestProducts();
    }

    public function getGproducts($id)
    {
        return $this->getGroupProducts($id);
    }

    public function categoryProducts($id)
    {
        return $this->getCategoryProducts($id);
    }
}

?>