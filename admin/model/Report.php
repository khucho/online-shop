<?php
include_once __DIR__.'/../vendor/db/database.php';
class Report{
    public function getStockReportList($month,$year){
        $con = Database:: connect();
        $con -> setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
        

            $sql = "select sum(stock_details.qty*stock_details.buy_priceEach) as buyingPrice
            from  stock_details
            where month(stock_details.date) = :month
            and year(stock_details.date) = :year ";
       

        $statement = $con->prepare($sql);
        $statement->bindParam(':month',$month);
        $statement->bindParam(':year',$year);

        if($statement->execute())
        {
            $result = $statement->fetchAll(PDO::FETCH_ASSOC);
        }
        return $result;
    }
    public function getOrderReportList($month,$year){
        $con = Database:: connect();
        $con -> setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
        

            $sql = "select sum(product.price*orders.quantity) as sellingPrice
            from  orders join product
            
            on orders.product_id = product.id
            
            where month(orders.order_date) = :month
            and year(orders.order_date) = :year ";
       

        $statement = $con->prepare($sql);
        $statement->bindParam(':month',$month);
        $statement->bindParam(':year',$year);

        if($statement->execute())
        {
            $result = $statement->fetchAll(PDO::FETCH_ASSOC);
        }
        return $result;
    }

    #--------------------Product Report -----------------------------#

    public function getTotalPrice($month,$year){
        $con = Database:: connect();
        $con -> setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
        $sql = "select sum(stock_details.buy_priceEach*stock_details.qty) as totalPrice,product.name as name,product.id as id,stock_details.id as sid
        from stock_details join product 
        on stock_details.product_id=product.id
       
        where month(stock_details.date) = :month
        and year(stock_details.date) = :year
        GROUP by stock_details.product_id ";
        $statement = $con->prepare($sql);
        $statement->bindParam(':month',$month);
        $statement->bindParam(':year',$year);


        if($statement->execute())
        {
            $result = $statement->fetchAll(PDO::FETCH_ASSOC);
        }
        return $result;
    }
    public function getTotalOrderPrice($month,$year){
        $con = Database:: connect();
        $con -> setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
        $sql = "select sum(product.price*orders.quantity) as sellingPrice,product.id as id
        from orders join product
        on orders.product_id = product.id
        where month(orders.order_date) = :month
        and year(orders.order_date) = :year
        GROUP by orders.product_id ";
        $statement = $con->prepare($sql);
        $statement->bindParam(':month',$month);
        $statement->bindParam(':year',$year);


        if($statement->execute())
        {
            $result = $statement->fetchAll(PDO::FETCH_ASSOC);
        }
        return $result;
    }

    public function getTotalPerMonth($year){
        $con = Database:: connect();
        $con -> setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
        $sql = " select sum(product.price*orders.quantity) as sellingPrice,month(orders.order_date) as month
        from  orders join product join order_detail
        on orders.product_id = product.id
        and orders.order_code = order_detail.order_code
        where order_detail.status = 'accept'
        and year(orders.order_date) = :year
        group by month(orders.order_date)
        order by month(orders.order_date)";
        $statement = $con->prepare($sql);
        $statement->bindParam(':year',$year);

        if($statement->execute())
        {
            $result = $statement->fetchAll(PDO::FETCH_ASSOC);
        }
        return $result;
    }
}
?>