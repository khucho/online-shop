<?php

include_once __DIR__.'/../vendor/db/database.php';

class Product 
{
    public function getProducts () 
    {
        //db connect 
        $con = Database::connect();

        //sql 
        $sql = 'select * from product';
        $statement = $con->prepare($sql);

        //execute
        if ($statement->execute())
        {
            $result = $statement->fetchAll(PDO::FETCH_ASSOC);
        }

        return $result;
    }

    public function getProductDetail($id)
    {
       
        $con = Database::connect();
        $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $sql = "select product.name as name,product.id as id,product.price as price,product.description as description,product.image as image,team.name as TNAME
                from product join team
                on product.team_id = team.id
                where product.id = :id";
        $statement = $con->prepare($sql);
        $statement->bindParam(':id', $id);

        if ($statement->execute()) {
            $result = $statement->fetch(PDO::FETCH_ASSOC);
        }
        
        return $result;
    }

    public function getLatestProducts()
    {
        $con = Database::connect();
        $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $sql = "select id,name, price, description, version, image
                from product order by created_date DESC LIMIT 4";
        $statement = $con->prepare($sql);

        if ($statement->execute()) {
            $result = $statement->fetchAll(PDO::FETCH_ASSOC);
        }
        return $result;
    }

    public function getGroupProducts($id)
    {
        $con = Database::connect();
        $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $sql = "select product.name as name,product.id as id,product.price as price,product.image as image,team.name as TNAME
                from product join team
                on product.team_id = team.id
                where team_id = :team_id";
        $statement = $con->prepare($sql);
        $statement->bindParam(':team_id', $id);

        if ($statement->execute()) {
            $result = $statement->fetchAll(PDO::FETCH_ASSOC);
        }
        return $result;
    }

    public function getCategoryProducts($id)
    {
        $con = Database::connect();
        $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $sql = "select product.name as name,product.id as id,product.price as price,product.image as image,category.name as cat_name
                from product join category
                on product.cat_id = category.id
                where category.id = :cat_id";
        $statement = $con->prepare($sql);
        $statement->bindParam(':cat_id', $id);

        if ($statement->execute()) {
            $result = $statement->fetchAll(PDO::FETCH_ASSOC);
        }
        return $result;
    }

}

?>