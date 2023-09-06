<?php
include_once __DIR__ . '/../vendor/db/database.php';


class Review
{
    public function getReviews()
    {
        $con = Database::connect();
        $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $sql = "select * from review";
        $statement = $con->prepare($sql);

        if ($statement->execute()) {
            $result = $statement->fetchAll(PDO::FETCH_ASSOC);
        }
        return $result;
    }

    public function deleteReviewInfo($id)
    {
        $con = Database::connect();
        $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $sql = "delete * from review where id=:id";
        $statement = $con->prepare($sql);
        $statement->bindParam(':id', $id);

        try {
            $statement->execute();
            return true;
        } catch (PDOException $e) {
            return false;
        }
    }

    public function updateReviews($id)
    {
        $con = Database::connect();
        $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $sql = "UPDATE review SET status='accept' where id=:id";
        $statement = $con->prepare($sql);
        $statement->bindParam(':id', $id);

        try {
            $statement->execute();
            return true;
        } catch (PDOException $e) {
            return false;
        }
    }

    public function rejectReviews($id)
    {
        $con = Database::connect();
        $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $sql = "UPDATE review SET status='reject' where id=:id";
        $statement = $con->prepare($sql);
        $statement->bindParam(':id', $id);

        try {
            $statement->execute();
            return true;
        } catch (PDOException $e) {
            return false;
        }
    }
}
