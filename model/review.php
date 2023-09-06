<?php
include_once __DIR__ . '/../vendor/db/database.php';
class Review
{
    public function addReviews($name, $review, $rating)
    {
        //1. db connection
        $con = Database::connect();
        $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        //2. write sql
        $sql = "INSERT INTO review(username,rating,review) VALUES (:username,:rating,:review)";
        $statement = $con->prepare($sql);
        try {
            $statement->execute([
                ':username' => $name,
                ':rating' => $rating,
                ':review' => $review
            ]);
            return true;
        } catch (PDOException $e) {
            return false;
        }
    }

    public function getReviews()
    {
        //1. db connection
        $con = Database::connect();
        $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        //2. write sql
        $sql = "SELECT * FROM review WHERE status='accept'";
        $statement = $con->prepare($sql);
        if ($statement->execute()) {
            $result = $statement->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        }
    }

    public function haveOrdered($userId)
    {
        // 1. Database connection
        $con = Database::connect();
        $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // 2. SQL query
        $sql = "SELECT COUNT(*) AS order_count FROM orders WHERE user_id = :userId";
        $statement = $con->prepare($sql);

        // 3. Bind parameters
        $statement->bindParam(':userId', $userId, PDO::PARAM_INT);

        // 4. Execute the query
        if ($statement->execute()) {
            // 5. Fetch and return the result
            $result = $statement->fetch(PDO::FETCH_ASSOC);
            return $result['order_count'] > 0;
        }

        // 6. Handle any errors or return false
        return false;
    }
}
