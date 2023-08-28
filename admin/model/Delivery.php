<?php

include_once __DIR__.'/../vendor/db/database.php';


class Delivery  
{
    public function getDeliveryList()
    {
        //db connect 
        $con = Database::connect();

        //sql
        $sql = 'select delivery.id , township.name as township_name , delivery.fee
                from delivery
                join township on delivery.township_id = township.id';
        $statement = $con->prepare($sql);

        //fetch
        if ($statement->execute())
        {
            $result = $statement->fetchAll(PDO::FETCH_ASSOC);
        }

        return $result;
    }

    public function createDelivery($township,$fee)
    {
        //db connect 
        $con = Database::connect();

        //sql
        $sql = 'insert into delivery (fee,township_id) values (:fee,:township)';
        $statement = $con->prepare($sql);
        $statement->bindParam(':township',$township);
        $statement->bindParam(':fee',$fee);

        //fetch
        if ($statement->execute())
        {
           return true;
        }
        
    }

    public function getDeliveryById($id)
    {
        //db connect 
        $con = Database::connect();

        //sql
        $sql = 'select * from delivery where id = :id';
        $statement = $con->prepare($sql);
        $statement->bindParam(':id',$id);

        //fetch
        if ($statement->execute())
        {
           $result = $statement->fetch(PDO::FETCH_ASSOC);
        }
        return $result;
        
    }

    public function updateDelivery($id,$township,$fee)
    {
        //db connect 
        $con = Database::connect();

        //sql
        $sql = 'update delivery set fee = :fee , township_id = :township where id = :id';
        $statement = $con->prepare($sql);
        $statement->bindParam(':id',$id);
        $statement->bindParam(':fee',$fee);
        $statement->bindParam(':township',$township);

        //fetch
        if ($statement->execute())
        {
           return true;
        }
        
    }

    public function removeDelivery($id)
    {
        //db connect 
        $con = Database::connect();

        //sql
        $sql = 'delete from delivery where id = :id';
        $statement = $con->prepare($sql);
        $statement->bindParam(':id',$id);

        try{
            $statement->execute();
            return true;
        }
        catch(Exception $e)
        {
            return false;
        }
        
    }
}

?>