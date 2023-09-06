<?php
include_once __DIR__ . '/../../controller/AuthController.php';
include_once __DIR__ . '/../../controller/ReviewController.php';

$id = $_GET['id'];
$reviewCont = new ReviewController();
$review = $reviewCont->rejectReview($id);

if ($review == true) {
    echo "<script>location.href='review.php'</script>";
}
