<?php
include_once __DIR__.'/../vendor/db/database.php';

class User
{
    public function createUserDetail($info)
    {
        $con=Database::connect();
        $con->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

        $sql = "insert into user_detail (user_id,phone,township_id,city_id) values (:user_id,:phone,:township_id,:city_id)";
        $statement=$con->prepare($sql);
        $statement->bindParam(':user_id',$info['user_id']);
        $statement->bindParam(':phone',$info['phone']);
        $statement->bindParam(':city_id',$info['city_id']);
        $statement->bindParam(':township_id',$info['township_id']);
       
    
        if($statement->execute())
        {
            return true;
        }
    }

    public function changeName($name)
    {
        $con=Database::connect();
        $con->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

        $sql = "select * from category";
        $statement=$con->prepare($sql);
       
    
        if($statement->execute())
        {
            $result = $statement->fetchAll(PDO::FETCH_ASSOC);
        }
        return $result;
    }
}

?>