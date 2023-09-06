<?php
include_once __DIR__ . '/../model/Review.php';

class ReviewController extends Review
{
    public function getReview()
    {
        return $this->getReviews();
    }

    public function deleteReview($id)
    {
        return $this->deleteReviewInfo($id);
    }

    public function acceptReview($id)
    {
        return $this->updateReviews($id);
    }

    public function rejectReview($id)
    {
        return $this->rejectReviews($id);
    }
}
