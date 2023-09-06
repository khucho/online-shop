<?php
include_once __DIR__.'/../vendor/db/database.php';


class Product
{
    public function getProductInfo()
    {
        $con = Database:: connect();
        $con->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

        $sql = "select product.name as proname,product.id as id,team.name as tname,category.name as cname,product.image as image
                from product join team join category
                where product.team_id = team.id
                and product.cat_id = category.id";
        $statement = $con->prepare($sql);

        if($statement->execute())
        {
            $result = $statement->fetchAll(PDO::FETCH_ASSOC);
        }
        return $result;
    }


    public function createProduct($name,$description,$price,$date,$fileName,$category,$group)
    {
        $con = Database:: connect();
        $con->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

        $sql = "insert into product(created_date,name,description,cat_id,team_id,image,price) values (:date,:name,:description,:cat,:team,:image,:price)";
        $statement = $con->prepare($sql);

        $statement->bindParam(':name',$name);
        $statement->bindParam(':description',$description);
        $statement->bindParam(':price',$price);
        $statement->bindParam(':date',$date);
        $statement->bindParam(':image',$fileName);
        $statement->bindParam(':cat',$category);
        $statement->bindParam(':team',$group);

        if($statement->execute())
        {
           return true;
        }
        else
        {
            return false;
        }

    }

    public function editProductInfo($id)
    {
        $con = Database::connect();
        $con->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

        $sql = "select * from product where id = :id";
        $statement = $con->prepare($sql);
        $statement->bindParam(":id",$id);

        if($statement->execute())
        {
            $result = $statement->fetch(PDO::FETCH_ASSOC);
        }
        return $result; 
    }

    public function updateProduct($id,$info)
    {
        $con = Database:: connect();
        $con->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

        if (isset($info['fileName']))
        {
            $sql = "update product 
                    set name=:name ,description=:description,price = :price , created_date=:date,image=:image,cat_id=:cat,team_id = :team 
                    where id=:id";
        }
        else 
        {
            $sql = "update product set name=:name ,description=:description,price = :price , created_date=:date,cat_id=:cat,team_id = :team where id=:id";
        }
        
        $statement = $con->prepare($sql);

        $statement->bindParam(':id',$id);
        $statement->bindParam(':name',$info['name']);
        $statement->bindParam(':description',$info['description']);
        $statement->bindParam(':price',$info['price']);
        $statement->bindParam(':date',$info['date']);
        $statement->bindParam(':cat',$info['category']);
        $statement->bindParam(':team',$info['group']);

        if (isset($info['fileName']))
        {
            $statement->bindParam(':image',$info['fileName']);
        }

        if($statement->execute())
        {
           return true;
        }
        else
        {
            return false;
        }
    }

    public function getDeleteProduct($id)
    {
        $con = Database:: connect();
        $con->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

        $sql = "delete from product where id = :id";
        $statement = $con->prepare($sql);
        $statement->bindParam(":id",$id);

        try{
            $statement->execute();
            return true;
        }
        catch(PDOException $e)
        {
            return false;
        } 
    }
}
?>