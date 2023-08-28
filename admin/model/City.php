<?php

include_once __DIR__.'/../vendor/db/database.php';


class City  
{
    public function getCityList()
    {
        //db connect 
        $con = Database::connect();

        //sql
        $sql = 'select * from city';
        $statement = $con->prepare($sql);

        //fetch
        if ($statement->execute())
        {
            $result = $statement->fetchAll(PDO::FETCH_ASSOC);
        }

        return $result;
    }
    public function createCity($name)
    {
        //db connect 
        $con = Database::connect();

        //sql
        $sql = 'insert into city (name) values (:name)';
        $statement = $con->prepare($sql);
        $statement->bindParam(':name',$name);

        //fetch
        if ($statement->execute())
        {
           return true;
        }
        
    }

    public function getCityById($id)
    {
        //db connect 
        $con = Database::connect();

        //sql
        $sql = 'select * from city where id = :id';
        $statement = $con->prepare($sql);
        $statement->bindParam(':id',$id);

        //fetch
        if ($statement->execute())
        {
           $result = $statement->fetch(PDO::FETCH_ASSOC);
        }
        return $result;
        
    }

    public function updateCity($id,$name)
    {
        //db connect 
        $con = Database::connect();

        //sql
        $sql = 'update city set name = :name where id = :id';
        $statement = $con->prepare($sql);
        $statement->bindParam(':id',$id);
        $statement->bindParam(':name',$name);

        //fetch
        if ($statement->execute())
        {
           return true;
        }
        
    }

    public function removeCity($id)
    {
        //db connect 
        $con = Database::connect();

        //sql
        $sql = 'delete from city where id = :id';
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