<?php
require __DIR__.'/../vendor/db/database.php';

class Authentication 
{
    // show admin list
    public function getAdminList () 
    {
        //db connect 
        $con = Database::connect();

        //sql statement 
        $sql = 'select * from admin';
        $statement = $con->prepare($sql);

        //sql execute 
        if ($statement->execute())
        {
            $result = $statement->fetchAll(PDO::FETCH_ASSOC);
        }

        return $result;
    }

    //create admin 
    public function createAdmin($data)
    {
        //db connect 
        $con = Database::connect();

        //sql statement 
        $sql = 'insert into admin(name,email,password,confirm_password) 
                values (:name,:email,:password,:confirm_password)';
        $statement = $con->prepare($sql);
        $statement->bindParam(':name',$data['name']);
        $statement->bindParam(':email',$data['email']);
        $statement->bindParam(':password',$data['password']);
        $statement->bindParam(':confirm_password',$data['confirm_password']);


        //sql execute 
        if ($statement->execute())
        {
            return $data['email'];
        }
    }

    public function getAdminByEmail($email)
    {
        //db connect 
        $con = Database::connect();

        //sql statement 
        $sql = 'select id from admin where email = :email';
        $statement = $con->prepare($sql);
        $statement->bindParam(':email',$email);

        //sql execute 
        if ($statement->execute())
        {
            $result = $statement->fetch(PDO::FETCH_ASSOC);
        }

        return $result;
    }

    public function updatePassword($email,$data)
    {
        //db connect 
        $con = Database::connect();

        //sql statement 
        $sql = 'update admin 
                set password=:password , confirm_password = :confirm_password
                where email = :email';

        $statement = $con->prepare($sql);
        $statement->bindParam(':email',$email);
        $statement->bindParam(':password',$data['password']);
        $statement->bindParam(':confirm_password',$data['confirm_password']);


        //sql execute 
        if ($statement->execute())
        {
            return true;
        }
    }

    public function getAdminById($id)
    {
        //db connect 
        $con = Database::connect();

        //sql statement 
        $sql = 'select * from admin where id = :id';
        $statement = $con->prepare($sql);
        $statement->bindParam(':id',$id);

        //sql execute 
        if ($statement->execute())
        {
            $result = $statement->fetch(PDO::FETCH_ASSOC);
        }

        return $result;
    }
    public function changePassword($data,$userId)
    {
        //db connect 
        $con = Database::connect();

        //sql 
        $sql = 'update admin set password = :password , confirm_password = :confirm_password where id = :id';
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