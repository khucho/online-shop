<?php 
include_once __DIR__.'/../vendor/db/database.php';
class Stock{
    public function getStockInfo()
    {
        $con = Database::connect();
        $con->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

        $sql = "select product.name as pname,stock_details.qty as qty,stock_details.buy_priceEach as price,stock_details.date as date,stock_details.id as id,stock_details.product_id as product_id
                from stock_details join product
                on stock_details.product_id = product.id";
        $statement = $con->prepare($sql);

        if($statement->execute())
        {
            return $statement->fetchAll(PDO::FETCH_ASSOC);
        }
    }
   
    #.........................Stock Detail.......................#

    public function getStockDetailInfo($start_date,$end_date)
    {
        $con = Database::connect();
        $con->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

            $sql = "select id,sum(qty) as stock_in ,product_id 
            from stock_details 
            where date >= :start_date and date <= :end_date 
            group by product_id";
        $statement = $con->prepare($sql);
        $statement->bindParam(':start_date',$start_date);
        $statement->bindParam(':end_date',$end_date);

        if($statement->execute())
        {
            return $statement->fetchAll(PDO::FETCH_ASSOC);
        }
    }
    public function getOrderDetailInfo($start_date,$end_date)
    {
        $con = Database::connect();
        $con->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

        $sql = "select  sum(quantity) as stock_out, product_id 
        from orders
         where order_date >= :start_date and order_date <= :end_date 
         group by product_id";
        $statement = $con->prepare($sql);
        $statement->bindParam(':start_date',$start_date);
        $statement->bindParam(':end_date',$end_date);

        if($statement->execute())
        {
            return $statement->fetchAll(PDO::FETCH_ASSOC);
        }
    }
    public function createStockDetail($product,$quantity,$date,$buy_price)
    {
        $con = Database::connect();
        $con->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

        $sql = "insert into stock_details(product_id,qty,date,buy_priceEach) values(:product,:quantity,:date,:price)";
        $statement = $con->prepare($sql);
        $statement->bindParam(':product',$product);
        $statement->bindParam(':quantity',$quantity);
        $statement->bindParam(':date',$date);
        $statement->bindParam(':price',$buy_price);
       
        if($statement->execute())
        {
            return true;
        }
        else
        {
            return false;
        }
    }
    public function updateStockDetail($id,$product,$quantity,$date,$buy_price)
    {
        $con = Database::connect();
        $con->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

        $sql = "update stock_details set qty =:quantity,product_id = :product,date = :date, buy_priceEach = :buy_price where id = :id";
        $statement = $con->prepare($sql);
        $statement->bindParam(':id',$id);
        $statement->bindParam(':quantity',$quantity);
        $statement->bindParam(':product',$product);
        $statement->bindParam(':date',$date);
        $statement->bindParam(':buy_price',$buy_price);
       
        if($statement->execute())
        {
            return true;
        }
        else
        {
            return false;
        }
    }
    public function getEditStockDetailInfo($id)
    {
        $con = Database::connect();
        $con->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

        $sql = "select * from stock_details where id = :id";
        $statement = $con->prepare($sql);
        $statement->bindParam(':id',$id);
        
        if($statement->execute())
        {
            $result = $statement->fetch(PDO::FETCH_ASSOC);
        }
        return $result;
    }
    public function destroyStockDetail($id)
    {
        $con = Database::connect();
        $con->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

        $sql = "delete from stock_details where id = :id";
        $statement = $con->prepare($sql);
        $statement->bindParam(':id',$id);
        
        if($statement->execute())
        {
            return true;
        }
        else
        {
        return false;
        }
    }

    #......................Stock Product.............................#
    public function stockDetailProductInfo($product,$start_date,$end_date)
    {
        $con = Database::connect();
        $con->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

       
        $sql = "select id,qty as stock_in ,product_id ,date
        from stock_details 
        where date >= :start_date and date <= :end_date and product_id = :product ";
        $statement = $con->prepare($sql);
        $statement->bindParam(':product',$product);
        $statement->bindParam(':start_date',$start_date);
        $statement->bindParam(':end_date',$end_date);

        if($statement->execute())
        {
            return $statement->fetchAll(PDO::FETCH_ASSOC);
        }

      
    }
    public function orderDetailProductInfo($product,$start_date,$end_date)
    {
        $con = Database::connect();
        $con->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

        
        $sql = "select  quantity as stock_out,product_id,order_date 
        from orders
        where orders.order_date >= :start_date and orders.order_date <= :end_date 
        and product_id = :product
        group by product_id";
        $statement = $con->prepare($sql);
        $statement->bindParam(':product',$product);
        $statement->bindParam(':start_date',$start_date);
        $statement->bindParam(':end_date',$end_date);

        if($statement->execute())
        {
            return $statement->fetchAll(PDO::FETCH_ASSOC);
        }
    }
    
    // public function stockDetailProduct($product)
    // {
    //     $con = Database::connect();
    //     $con->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

    //     $sql = "select * from product where id=:product";
    //     $statement = $con->prepare($sql);
    //     $statement->bindParam(':product',$product);

    //     if($statement->execute())
    //     {
    //         return $statement->fetch(PDO::FETCH_ASSOC);
    //     }
    // }

    public function stockProduct()
    {
        $con = Database::connect();
        $con->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

        $sql = "select product.name as proname,product.id as id from product join stock_details on product.id = stock_details.product_id group by stock_details.product_id";
        $statement = $con->prepare($sql);

        if($statement->execute())
        {
            return $statement->fetchAll(PDO::FETCH_ASSOC);
        }
    }

    public function stockDetailProduct($product)
    {
        $con = Database::connect();
        $con->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

        $sql = "select product.name as proname,product.id as id 
        from product join stock_details on product.id = stock_details.product_id 
        where product.id = :id
        group by stock_details.product_id";
        $statement = $con->prepare($sql);
        $statement->bindParam(':id',$product);
        if($statement->execute())
        {
            return $statement->fetch(PDO::FETCH_ASSOC);
        }
    }

    #------------------------Stock List-----------------------------#
    public function getStocksInfo()
    {
        $con = Database::connect();
        $con->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

        $sql = "select product.name as pname,stock_details.qty as qty,stock_details.buy_priceEach as price,stock_details.date as date,stock_details.id as id,stock_details.product_id as product_id
                from stock_details join product
                on stock_details.product_id = product.id
                group by product_id";
        $statement = $con->prepare($sql);

        if($statement->execute())
        {
            return $statement->fetchAll(PDO::FETCH_ASSOC);
        }
    }
    public function getStockListInfo()
    {
        $con = Database::connect();
        $con->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

            $sql = "select id,sum(qty) as stock_in ,product_id 
            from stock_details 
            group by product_id";
        $statement = $con->prepare($sql);

        if($statement->execute())
        {
            return $statement->fetchAll(PDO::FETCH_ASSOC);
        }
    }
    public function getOrderListInfo()
    {
        $con = Database::connect();
        $con->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

        $sql = "select  sum(orders.quantity) as stock_out, orders.product_id 
        from orders join order_detail
        on orders.order_code = order_detail.order_code
        where order_detail.status = 'accept'
         group by orders.product_id";
        $statement = $con->prepare($sql);

        if($statement->execute())
        {
            return $statement->fetchAll(PDO::FETCH_ASSOC);
        }
    }
}
