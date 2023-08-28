<?php
include_once __DIR__.'/../vendor/db/database.php';

class Category
{
    public function getallCategories()
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