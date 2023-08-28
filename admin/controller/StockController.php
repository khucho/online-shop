<?php
include_once __DIR__.'/../model/stock.php';
class StockController extends Stock{
    public function getStock()
    {
        return $this->getStockInfo();
    }


    #........................Stock Details.........................#

    public function getStockDetail($start_date,$end_date)
    {
        return $this->getStockDetailInfo($start_date,$end_date);
    }
    public function getOrderDetail($start_date,$end_date)
    {
        return $this->getOrderDetailInfo($start_date,$end_date);
    }
    public function addStockDetail($product,$quantity,$date,$buy_price)
    {
        return $this->createStockDetail($product,$quantity,$date,$buy_price);
    }
    public function editStockDetail($id,$product,$quantity,$date,$buy_price)
    {
        return $this->updateStockDetail($id,$product,$quantity,$date,$buy_price);
    }
    public function getEditStockDetail($id)
    {
        return $this->getEditStockDetailInfo($id);
    }
    public function deleteStockDetail($id)
    {
        return $this->destroyStockDetail($id);
    }

    #.....................Product Stock.................................#
    public function getStockProductDetail($product,$start_date,$end_date)
    {
        return $this->stockDetailProductInfo($product,$start_date,$end_date);
    }
    public function getOrderProductDetail($product,$start_date,$end_date)
    {
        return $this->orderDetailProductInfo($product,$start_date,$end_date);
    }
    public function getStockProduct()
    {
        return $this->stockProduct();
    }
    public function getStockDetailProduct($product)
    {
        return $this->stockDetailProduct($product);
    }

    #----------------------------Stock List----------------------------#
    public function getStocks()
    {
        return $this->getStocksInfo();
    }
    public function getStockList()
    {
        return $this->getStockListInfo();
    }
    public function getOrderList()
    {
        return $this->getOrderListInfo();
    }
}
