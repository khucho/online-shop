<?php
include_once __DIR__ . '/../vendor/db/database.php';

class Code {
    public function getCodeList()
    {
        //1. db connection
        $con=Database::connect();
        $con->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

        //2.write sql
        $sql = "select * from voucher_code";
        $statement=$con->prepare($sql);
        
        //3.sql execute
        if($statement->execute())
        {
            //4. result
            //data fetch()=> one row, fetchAll()=> multiple rows
            $result = $statement->fetchAll(PDO::FETCH_ASSOC);
        }
        return $result;
    }

    public function createCode($code)
    {
        //1. db connection
        $con=Database::connect();
        $con->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

        //2.write sql
        $sql = "insert into voucher_code (code) values (:code)";
        $statement=$con->prepare($sql);
        $statement->bindParam(':code',$code);
        
        //3.sql execute
        if($statement->execute())
        {
           return true;
        }
        
    }

    public function removeCode($id)
    {
        //1. db connection
        $con=Database::connect();
        $con->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

        //2.write sql
        $sql = "delete from voucher_code where id = :id";
        $statement=$con->prepare($sql);
        $statement->bindParam(':id',$id);
        
        //3.sql execute
        if($statement->execute())
        {
           return true;
        }
        
    }
}

?>