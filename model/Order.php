<?php 

include_once __DIR__.'/../vendor/db/database.php';

class Order 
{
    public function createOrder($userId,$order,$orderCode)
    {
        $conn = Database::connect();

        $sql = 'insert into orders
                (user_id,product_id,quantity,total_price,order_code)
                values (:user_id,:product_id,:quantity,:total_price,:order_code)';

        $statement = $conn->prepare($sql);


        $statement->bindParam(':user_id',$userId);
        $statement->bindParam(':product_id',$order['product_id']);
        $statement->bindParam(':quantity',$order['quantity']);
        $statement->bindParam(':total_price',$order['total_price']);
        $statement->bindParam(':order_code',$orderCode);


        if ($statement->execute())
        {
            return true;
        }
    }

    public function createOrderDetail($userId,$orderCode,$townshipId)
    {
        
        $conn = Database::connect();

        $sql = 'insert into order_detail
                (user_id,order_code,township_id)
                values (:user_id,:order_code,:township_id)';

        $statement = $conn->prepare($sql);

        $statement->bindParam(':user_id',$userId);
        $statement->bindParam(':order_code',$orderCode);
        $statement->bindParam(':township_id',$townshipId);


        if ($statement->execute())
        {
            return true;
        }
    }

    public function getOrderCode()
    {
        $conn = Database::connect();

        $sql = 'select order_code from order_detail';

        $statement = $conn->prepare($sql);



        if ($statement->execute())
        {
            $result = $statement->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        }
    }
}

?>