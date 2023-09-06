<?php

include_once __DIR__.'/../vendor/db/database.php';

class Authentication 
{
    public function getUserList()
    {
        //db connect 
        $con = Database::connect();

        //sql 
        $sql = 'select * from user';
        $statement = $con->prepare($sql);

        //fetch 
        if ($statement->execute())
        {
            $result = $statement->fetchAll(PDO::FETCH_ASSOC);
        }

        return $result;
    }

    public function createUser($data)
    {
        //db connect 
        $con = Database::connect();

        //sql 
        $sql = 'insert into user 
                (name,email,password,confirm_password) 
                values (:name , :email , :password , :confirm_password)';

        $statement = $con->prepare($sql);

        $statement->bindParam(':name',$data['name']);
        $statement->bindParam(':email',$data['email']);
        $statement->bindParam(':password',$data['password']);
        $statement->bindParam(':confirm_password',$data['confirm_password']);

        //execute 
        if ($statement->execute())
        {
            return $data['email'];
        }
    }

    public function getUserByEmail($email)
    {
        //db connect 
        $con = Database::connect();

        //sql 
        $sql = 'select id from user where email = :email';
        $statement = $con->prepare($sql);

        $statement->bindParam(':email',$email);

        //fetch 
        if ($statement->execute())
        {
            $result = $statement->fetch(PDO::FETCH_ASSOC);
        }
        return $result;
    }

    public function getUserById($id)
    {
        //db connect 
        $con = Database::connect();

        //sql 
        $sql = 'select * from user where id = :id';
        $statement = $con->prepare($sql);

        $statement->bindParam(':id',$id);

        //fetch 
        if ($statement->execute())
        {
            $result = $statement->fetch(PDO::FETCH_ASSOC);
        }
        return $result;
    }




public function updatePassword($data,$userId)
    {
        //db connect 
        $con = Database::connect();

        //sql 
        $sql = 'update user set password = :password , confirm_password = :confirm_password where id = :id';
        $statement = $con->prepare($sql);

        $statement->bindParam(':id',$userId);
        $statement->bindParam(':password',$data['password']);
        $statement->bindParam(':confirm_password',$data['confirm_password']);

        //fetch 
        if ($statement->execute())
        {
            return true;
        }
        
    }
}

?>