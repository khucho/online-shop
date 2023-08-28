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
}

?>