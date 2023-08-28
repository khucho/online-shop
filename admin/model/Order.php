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
        $sql = "SELECT  order_detail.order_code as code, user.name as name,  order_detail.order_date as date , order_detail.status as status
                FROM order_detail
                JOIN user ON order_detail.user_id = user.id 
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
        $sql = "SELECT user.name as uname,
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
        $sql = "SELECT product.name as pname,product.price as price,orders.quantity as quantity,orders.order_date as date,user.name as user_name,user.email as user_email
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
        $sql = "select month(order_date) as month , count(order_code) as total
        from order_detail
        group by month(order_date) ";
        $statement = $con->prepare($sql);
       

        //3.sql excute
        if ($statement->execute()) {
            //4. result
            // data fetch() => one row, fetchAll() => multiple rows
            $result = $statement->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        }
    }
}
