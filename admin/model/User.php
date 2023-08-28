<?php 
include_once __DIR__.'/../vendor/db/database.php';

class User {

    public function userLists()
    {
        //db connect 
        $con = Database::connect();

        //sql 
        $sql = 'select * from user';
        $statement = $con->prepare($sql);

        if ($statement->execute())
        {
            $result = $statement->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        }
    }

    public function removeUser($id)
    {
        //db connect 
        $con = Database::connect();
        $con->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION); 

        //sql 
        $sql = 'delete from user where id=:id';
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