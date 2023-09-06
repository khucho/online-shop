<?php
include_once __DIR__ . '/../vendor/db/database.php';
class Contact
{
    public function addMessages($name, $email, $phone, $message)
    {
        //1. db connection
        $con = Database::connect();
        $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        //2. write sql
        $sql = "INSERT INTO contact(name,email,phone,message) VALUES (:name,:email,:phone,:message)";
        $statement = $con->prepare($sql);
        try {
            $statement->execute([
                ':name' => $name,
                ':email' => $email,
                ':phone' => $phone,
                ':message' => $message
            ]);
            return true;
        } catch (PDOException $e) {
            return false;
        }
    }
}
