<?php
include_once __DIR__ . '/../vendor/db/database.php';

class Group
{
    public function getGroupList()
    {
        //1. db connection
        $con = Database::connect();
        $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        //2.write sql
        $sql = "SELECT * FROM team";
        $statement = $con->prepare($sql);

        //3.sql excute
        if ($statement->execute()) {
            //4. result
            // data fetch() => one row, fetchAll() => multiple rows
            $result = $statement->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        }
    }

    public function createGroup($name, $fileName)
    {
        //1. db connection
        $con = Database::connect();
        $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        //2.write sql
        $sql = "insert into team(name,image) values (:name,:image)";
        $statement = $con->prepare($sql);
        $statement->bindParam(':name',$name);
        $statement->bindParam(':image',$fileName);

        if($statement->execute())
        {
            return true;
        }
        else
        {
            return false;
        }
        // try 
        // {
        //     $statement->execute();
        //     return true;
        // } 
        // catch (PDOException $e) 
        // {
        //     return false;
        // }
    }

    public function getGroupInfo($id)
    {
        //1. db connection
        $con = Database::connect();
        $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        //2.write sql
        $sql = "SELECT * FROM team where id=:id";
        $statement = $con->prepare($sql);
        $statement->bindParam(':id', $id);

        //3.sql excute
        if ($statement->execute()) {
            //4. result
            // data fetch() => one row, fetchAll() => multiple rows
            $result = $statement->fetch(PDO::FETCH_ASSOC);
            return $result;
        }
    }

    public function updateGroup($id, $name, $filename)
    {
        //1. db connection
        $con = Database::connect();
        $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        //2.write sql
        
            $sql = "update team set name=:name,image=:image where id=:id";
      

        $statement = $con->prepare($sql);
        $statement->bindParam(':id',$id);
        $statement->bindParam(':name',$name);
        $statement->bindParam(':image',$filename);

        if($statement->execute())
        {
            return true;
        }
        else
        {
            return false;
        }

    }

    public function deleteGroupInfo($id)
    {
        //1. db connection
        $con = Database::connect();
        $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        //2.write sql
        $sql = "DELETE FROM `team` WHERE id=:id";
        $statement = $con->prepare($sql);
        $statement->bindParam(':id', $id);

        //3.sql excute
        try {
            $statement->execute();
            return true;
        } catch (PDOException $e) {
            return false;
        }
    }
}
