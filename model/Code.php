<?php
include_once __DIR__ . '/../vendor/db/database.php';

class Code
{
    public function getCodes()
    {
        //1. db connection
        $con = Database::connect();
        $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        //2.write sql
        $sql = "SELECT * FROM voucher_code ";
        $statement = $con->prepare($sql);

        //3.sql excute
        if ($statement->execute()) {
            //4. result
            // data fetch() => one row, fetchAll() => multiple rows
            $result = $statement->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        }
    }

    public function updateVcCode($userId,$vcCode,$date)
    {
        //1. db connection
        $con = Database::connect();
        $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        //2.write sql
        $sql = "update voucher_code set used_by_user = :used_by ,used_at = :date where code = :code ";
        $statement = $con->prepare($sql);
        $statement->bindParam(':used_by',$userId);
        $statement->bindParam(':date',$date);
        $statement->bindParam(':code',$vcCode);

        //3.sql excute
        if ($statement->execute()) {
            
            return true;
        }
    }
}

?>