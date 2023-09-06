<?php
include_once __DIR__ . '/../model/review.php';

class ReviewController extends Review
{
    public function addReview($name, $review, $rating)
    {
        return $this->addReviews($name, $review, $rating);
    }

    public function getReview()
    {
        return $this->getReviews();
    }

    public function hasOrdered($userId)
    {
        return $this->haveOrdered($userId);
    }
}
