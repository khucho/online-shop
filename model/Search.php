<?php
include_once __DIR__ . '/../vendor/db/database.php';

class SearchModel
{

    public function searchProducts($searchQuery)
    {
        $conn = Database::connect();
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $sql = "SELECT product.*
        FROM product
        INNER JOIN team ON product.team_id = team.id
        WHERE team.name LIKE :team_name
        OR product.name LIKE :product_name ";

        $statement = $conn->prepare($sql);
        $searchPattern = '%' . $searchQuery . '%';
        $statement->bindValue(':team_name', '%' . $searchQuery . '%');
        $statement->bindValue(':product_name', $searchPattern); // Bind a value for product_name

        if ($statement->execute()) {
            $result = $statement->fetchAll(PDO::FETCH_ASSOC);
        }
        return $result;
    }
}
