<?php

include_once __DIR__.'/../vendor/db/database.php';


class Township  
{
    public function getTownshipList()
    {
        //db connect 
        $con = Database::connect();

        //sql
        $sql = 'select * from township';
        $statement = $con->prepare($sql);

        //fetch
        if ($statement->execute())
        {
            $result = $statement->fetchAll(PDO::FETCH_ASSOC);
        }

        return $result;
    }
}

?>