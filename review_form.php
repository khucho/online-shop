<?php
ob_start();

include_once 'layouts/user_navbar.php';
include_once 'controller/reviewController.php';

$review_cont = new ReviewController();
$reviews = $review_cont->getReview();

if (isset($_POST['submit'])) {
    $name = $_POST['username'];
    $review = $_POST['review'];
    $rating = $_POST['rating'];
    //die(var_dump($name, $review, $rating));
    $status = $review_cont->addReview($name, $review, $rating);
    //die(var_dump($status));
}
?>
<div class="container d-flex justify-content-center">

    <div class="review col-md-8 m-5">
        <form method="post">
            <div class="form">
                <label for="">Name</label>
                <input type="text" name="username" placeholder="Enter your name">
            </div>
            <div class="form">
                <label for="">Review</label>
                <textarea id="review" name="review" placeholder="Write your review here"></textarea>
                <small id="word-count">Word count: 0</small>
            </div>
            <div class="rating">
                <input type="radio" id="star5" name="rating" value="5">
                <label for="star5"></label>
                <input type="radio" id="star4" name="rating" value="4">
                <label for="star4"></label>
                <input type="radio" id="star3" name="rating" value="3">
                <label for="star3"></label>
                <input type="radio" id="star2" name="rating" value="2">
                <label for="star2"></label>
                <input type="radio" id="star1" name="rating" value="1">
                <label for="star1"></label>
            </div>
            <br>
            <button name="submit">Submit</button>
            <?php if (isset($status)) : ?>
                <p>Your review has submitted!!!</p>
            <?php endif; ?>
        </form>
    </div>



</div>

<div class="backG content-container px-2 pt-2 rounded-4">
    <div id="reviewCarousel" class="my-5 carousel slide" data-ride="carousel">
        <div class="carousel-inner">
            <?php $carouselItemIndex = 0; ?>
            <?php foreach ($reviews as $reviewIndex => $review) : ?>
                <?php if ($reviewIndex % 3 === 0) : ?>
                    <div class="carousel-item<?= $reviewIndex === 0 ? ' active' : '' ?>">
                        <div class="row">
                        <?php endif; ?>
                        <div class="col-md-4 mb-5">
                            <div class="box1 rounded-4">
                                <div class="h-75 reviewText ">
                                    <p class="p-2"><span><img src="public/images/quote.jpg" width="25px" height="30px" class="mx-1" alt=""></span><?= $review['review'] ?><span><img src="public/images/quote1.png" width="25px" height="30px" class="mx-1" alt=""></span></p>
                                </div>
                                <div class="first">
                                    <div class="rating">
                                        <?php
                                        $ratingValue = $review['rating'];

                                        for ($j = 1; $j <= 5; $j++) {
                                            $starClass = $j <= $ratingValue ? 'filled' : 'empty';

                                            if ($starClass === 'filled') {
                                                echo '<img src="public/images/star1.jpg" class="mx-1" width="20px" height="20px" alt="Filled star" />';
                                            } else {
                                                echo '<img src="public/images/star2.jpg" class="mx-1" width="20px" height="20px" alt="Empty star" />';
                                            }
                                        }
                                        ?>
                                    </div>
                                </div>
                                <p class="username rounded-4"><?= $review['username'] ?></p>
                            </div>
                        </div>

                        <?php if (($reviewIndex + 1) % 3 === 0 || $reviewIndex === count($reviews) - 1) : ?>
                        </div>
                    </div>
                <?php endif; ?>
            <?php endforeach; ?>
        </div>
        <a class="prevBtn" href="#reviewCarousel" role="button" data-slide="prev"></a>
        <a class="nextBtn" href="#reviewCarousel" role="button" data-slide="next"></a>
    </div>

</div>









<?php
include_once 'layouts/user_footer.php';

?>