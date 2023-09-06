<?php

include_once __DIR__.'/../vendor/db/database.php';

class Category{

    public function getCategoriesList()
    {
        //1. db connection
        $con=Database::connect();
        $con->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

        //2.write sql
        $sql = "select * from category";
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

    public function createCategory($name,$fileName)
    {

        $con=Database::connect();
        $con->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

        //2.write sql
        $sql = "insert into category(name,image) values(:name,:image)";
        $statement=$con->prepare($sql);
        $statement->bindParam(':name',$name);
        $statement->bindParam(':image',$fileName);
        //3.sql execute
        if($statement->execute())
        {
            return true;
        }
        else
        {
            return false;
        }
    }

    public function getCategoryInfo($id)
    {
        //1. db connection
        $con=Database::connect();
        $con->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION); 

        //2.write sql
        $sql = "select * from category where id=:id";
        $statement=$con->prepare($sql);
        $statement->bindParam(':id',$id);

        if($statement->execute())
        {
            $result=$statement->fetch(PDO::FETCH_ASSOC);
            return $result;
        }
    }  

    public function updateCategory($id,$name,$filename)
    {
        //1. db connection
        $con=Database::connect();
        $con->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION); 

        //2.write sql
        $sql = "update category set name=:name,image=:image where id=:id";
        $statement=$con->prepare($sql);
        $statement->bindParam(':id',$id);
        $statement->bindParam(':name',$name);
        $statement->bindParam(':image',$filename);
        if($statement->execute())
        {
            return true;
        }
        else{
            return false;
        }
    }
    
    public function deleteCategoryInfo($id)
    {
        //1. db connection
        $con=Database::connect();
        $con->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION); 

        //2.write sql
        $sql = "delete from category where id=:id";
        $statement=$con->prepare($sql);
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

    public function getCategoryPerProduct()
    {
        //1. db connection
        $con=Database::connect();
        $con->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

        //2.write sql
        $sql = "select category.name as catname , count(product.cat_id) as total 
                from category join product
                on category.id = product.cat_id
                group by product.cat_id";
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
}

?>