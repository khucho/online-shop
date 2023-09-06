<?php
include_once __DIR__.'/../vendor/db/database.php';

class Order
{
    public function getOrderList()
    {
        //1. db connection
        $con = Database::connect();
        $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        //2.write sql
        $sql = "select  order_detail.order_code as code, user.name as name, township.name as township_name,  order_detail.order_date as date , order_detail.status as status
                FROM order_detail
                JOIN user ON order_detail.user_id = user.id 
                JOIN township ON order_detail.township_id = township.id
                GROUP BY order_detail.order_code";


        $statement = $con->prepare($sql);
        //3.sql excute
        if ($statement->execute()) {
            //4. result
            // data fetch() => one row, fetchAll() => multiple rows
            $result = $statement->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        }
    }

    public function getUserInfo($code)
    {
        //1. db connection
        $con = Database::connect();
        $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        //2.write sql
        $sql = "select user.name as uname,
                orders.address as address,
                orders.order_date as date,
                orders.order_code as code, user_detail.phone as phone 
                from orders 
                join user_detail on orders.user_id = user_detail.user_id
                where orders.order_code=:code";


        $statement = $con->prepare($sql);
        $statement->bindParam(':code', $code);

        //3.sql excute
        if ($statement->execute()) {
            //4. result
            // data fetch() => one row, fetchAll() => multiple rows
            $result = $statement->fetch(PDO::FETCH_ASSOC);
            return $result;
        }
    }

    public function getOrderInfo($code)
    {
        //1. db connection
        $con = Database::connect();
        $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        //2.write sql
        $sql = "select product.name as pname,product.price as price,orders.quantity as quantity,orders.order_date as date,user.name as user_name,user.email as user_email
                FROM orders 
                join product on product.id = orders.product_id 
                join user on orders.user_id = user.id
                where orders.order_code = :code";

        $statement = $con->prepare($sql);
        $statement->bindParam(':code', $code);

        //3.sql excute
        if ($statement->execute()) {
            //4. result
            // data fetch() => one row, fetchAll() => multiple rows
            $result = $statement->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        }
    }

    public function getOrderPerMonth()
    {
        //1. db connection
        $con = Database::connect();
        $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        //2.write sql
        $sql = "select year(order_date) AS year, month(order_date) as month , count(order_code) as total
        from order_detail
        GROUP BY year(order_date),month(order_date)
        ORDER BY year ASC,month ASC; ";
        $statement = $con->prepare($sql);
       

        //3.sql excute
        if ($statement->execute()) {
            //4. result
            // data fetch() => one row, fetchAll() => multiple rows
            $result = $statement->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        }
    }

    public function orderStatusAccept($orderCode)
    {
        //1. db connection
        $con = Database::connect();
        $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        //2.write sql
        $sql = "update order_detail set status = 'accept' where order_code = :orderCode";
        $statement = $con->prepare($sql);
        $statement->bindParam(':orderCode',$orderCode);;

        //3.sql excute
        if ($statement->execute()) {
            return true;
        }
    }
    public function orderStatusDecline($orderCode)
    {
        //1. db connection
        $con = Database::connect();
        $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        //2.write sql
        $sql = "update order_detail set status = 'decline' where order_code = :orderCode";
        $statement = $con->prepare($sql);
        $statement->bindParam(':orderCode',$orderCode);;

        //3.sql excute
        if ($statement->execute()) {
            return true;
        }
    }

    public function mailInfoByOrderCode($orderCode)
    {
        //1. db connection
        $con = Database::connect();
        $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        //2.write sql
        $sql = "select user.name as user_name , user.email , township.name as township_name , order_detail.order_date as order_date ,  delivery.fee as delivery_fee
                from order_detail
                join user on user.id = order_detail.user_id
                join township on township.id = order_detail.township_id
                join delivery on delivery.township_id = order_detail.township_id
                where order_detail.order_code = :orderCode";
        $statement = $con->prepare($sql);
        $statement->bindParam(':orderCode',$orderCode);
        //3.sql excute
        if ($statement->execute()) {
            $result = $statement->fetch(PDO::FETCH_ASSOC);
            return $result;
        }
    }

    public function productsByOrderCode($orderCode)
    {
        //1. db connection
        $con = Database::connect();
        $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        //2.write sql
        $sql = "select product.name as product_name , orders.quantity , orders.total_price
                from orders
                join product on product.id = orders.product_id
                where orders.order_code = :orderCode";
        $statement = $con->prepare($sql);
        $statement->bindParam(':orderCode',$orderCode);

        //3.sql excute
        if ($statement->execute()) {
            $result = $statement->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        }
    }
}