<?php

include_once __DIR__.'/../vendor/db/database.php';


class Township  
{
    public function getTownshipList()
    {
        //db connect 
        $con = Database::connect();

        //sql
        $sql = 'select township.id as township_id , township.name as township_name , city.name as city_name
                from township
                join city on township.city_id = city.id';
        $statement = $con->prepare($sql);

        //fetch
        if ($statement->execute())
        {
            $result = $statement->fetchAll(PDO::FETCH_ASSOC);
        }

        return $result;
    }

    public function createTownship($township,$city)
    {
        //db connect 
        $con = Database::connect();

        //sql
        $sql = 'insert into township (name,city_id) values (:township_name,:city)';
        $statement = $con->prepare($sql);
        $statement->bindParam(':township_name',$township);
        $statement->bindParam(':city',$city);

        //fetch
        if ($statement->execute())
        {
           return true;
        }
        
    }

    public function getTownshipById($id)
    {
        //db connect 
        $con = Database::connect();

        //sql
        $sql = 'select * from township where id = :id';
        $statement = $con->prepare($sql);
        $statement->bindParam(':id',$id);

        //fetch
        if ($statement->execute())
        {
           $result = $statement->fetch(PDO::FETCH_ASSOC);
        }
        return $result;
        
    }

    public function updateTownship($id,$township,$city)
    {
        //db connect 
        $con = Database::connect();

        //sql
        $sql = 'update township set name = :name , city_id = :city where id = :id';
        $statement = $con->prepare($sql);
        $statement->bindParam(':id',$id);
        $statement->bindParam(':name',$township);
        $statement->bindParam(':city',$city);

        //fetch
        if ($statement->execute())
        {
           return true;
        }
        
    }

    public function removeTownship($id)
    {
        //db connect 
        $con = Database::connect();

        //sql
        $sql = 'delete from township where id = :id';
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