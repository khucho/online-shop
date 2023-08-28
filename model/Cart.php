<?php
include_once __DIR__.'/../vendor/db/database.php';

class Cart
{
    public function getAllCart()
    {
        $con=Database::connect();
        $con->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

        $sql = "select * from cart";
        $statement=$con->prepare($sql);
       
    
        if($statement->execute())
        {
            $result = $statement->fetchAll(PDO::FETCH_ASSOC);
        }
        return $result;
    }

    public function getCartInfo($id)
    {
        $con=Database::connect();
        $con->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

        $sql = "select * from cart where user_id = :id";
        $statement=$con->prepare($sql);
        $statement->bindParam(':id',$id);
    
        if($statement->execute())
        {
            $result = $statement->fetchAll(PDO::FETCH_ASSOC);
        }
        return $result;
    }

    public function addDataToCart($userId,$productId,$qty)
    {
        $con=Database::connect();
        $con->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

         $sql = "insert into cart (user_id,product_id,qty) values(:user_id,:product_id,:qty)";
        
        $statement=$con->prepare($sql);
        $statement->bindParam(':user_id',$userId);
        $statement->bindParam(':product_id',$productId);

        $statement->bindParam(':qty',$qty);
        

        if($statement->execute())
        {
            return true;
        }
        else
        {
            return false;
        }
    }

    public function getCartDetail($id)
    {
        $con=Database::connect();
        $con->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

        $sql = "select cart.qty as qty , cart.product_id as product_id , product.name as product_name , product.price as product_price , product.image 
                from cart 
                join product on cart.product_id = product.id
                where user_id = :id";
        $statement=$con->prepare($sql);
        $statement->bindParam('id',$id);
    
        if($statement->execute())
        {
            $result = $statement->fetchAll(PDO::FETCH_ASSOC);
        }
        return $result;
    }

    public function deleteCart($id)
    {
        $con = Database::connect();

        $sql = 'delete from cart where product_id = :id ';
        $statement = $con->prepare($sql);
        $statement->bindParam(':id',$id);

        if ($statement->execute())
        {
            return true;
        }
        else 
        {
            return false;
        }
    }
}
?>