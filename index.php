<?php
include_once __DIR__ . '/layouts/user_navbar.php';
include_once __DIR__ . '/controller/ProductController.php';
include_once __DIR__. '/controller/CategoryController.php';
include_once __DIR__.'/controller/reviewController.php';
include_once __DIR__.'/controller/contactController.php';

$product_cont = new ProductController();
$products = $product_cont->getLatestProduct();

$cat_con = new CategoryController();
$categories = $cat_con->allCategories();

$review_cont = new ReviewController();
$reviews = $review_cont->getReview();

$contact_cont = new ContactController();
if (isset($_POST['submit'])) {
  $name = $_POST['name'];
  $email = $_POST['email'];
  $phone = $_POST['phone'];
  $message = $_POST['message'];
  $status = $contact_cont->addMessage($name, $email, $phone, $message);
}
?>
<style>

</style>
<!-- slider section  -->

<section class="slider_section">
  <div class="slider_container">

    <div class="container-fluid">
      <div class="row">
        <div class="col-md-6">
          <div class="detail-box">
            <h1>
              Welcome To Our <br>
              Kpop Merch Online Shop
            </h1>
            <p>
              Sequi perspiciatis nulla reiciendis, rem, tenetur impedit, eveniet non necessitatibus error distinctio mollitia suscipit. Nostrum fugit doloribus consequatur distinctio esse, possimus maiores aliquid repellat beatae cum, perspiciatis enim, accusantium perferendis.
            </p>
            <a href="contact.php">
              Contact Us
            </a>
          </div>
        </div>

        <div class="col-md-6 text-center slider_img">
          <img src="public/images/hhh.jpg" class="img-fluid w-75 h-75 m-5" alt="">
        </div>

      </div>
    </div>

  </div>
</section>

<!-- end slider section -->

<!-- category section -->

<section class="category_section layout_padding ">
  <div class="container">
    <div class="heading_container heading_center">
      <h2>
        Category
      </h2>
    </div>
    <div class="row pb-5 d-flex justify-content-center animate__animated animate__lightSpeedInLeft" style="animation-duration: 4s;">
    <?php
    foreach($categories as $category)
    {
    ?>
    <div class="category d-flex justify-content-center align-items-center col-md-3 p-3">
        <div class="animated-div" style="background-image: url('uploads/<?php echo $category['image']; ?>');">
          <a href="categoryProduct.php?id=<?php echo $category['id']; ?>" class="w-100"><?php echo $category['name']; ?></a>
        </div>
      </div>
    <?php
    }
    ?>
  </div>
</section>

<!-- end category section -->

<!-- latest product Section -->
<section class="shop_section">
  <div class="container">
    <div class="heading_container heading_center">
      <h2>
        Latest Products
      </h2>
    </div>
    <div class="row d-flex flex-wrap justify-content-center" id="productContainer">


      <?php foreach ($products as $product) : ?>

        <div class="col-10 col-sm-6 col-lg-3 col-md-4 py-3 d-flex justify-content-center" >

            <div class="card shop_card" style="width: 230px; height:330px;">
              
              <img src="uploads/<?php echo $product['image']; ?>"class="card-img-top img-fluid p-3" alt="Image" style="width:230px; height:180px;">
            
              <div class="card-body text-center">

                <h6 class="card-title"  ><?= $product['name'] ?></h6>
                <p class="card-text"><strong ><?= $product['price'] ?></strong> MMK</p>
              </div>
            
                <div class="d-flex justify-content-center">
                

                <?php if (isset($cartLists) && in_array($product['id'],$cartLists)) : ?>
                  <div class="mb-3 px-1 " id='<?php echo $product['id']; ?>'>
                      <span class="btn btn-dark p-2">Already added</span>
                  </div>

                  <div class="mb-3 px-1 ">
                    <a href="productDetail.php?productId=<?php echo $product['id'];?>">
                      <button class="btn btn-dark">Detail</button>
                    </a>
                  </div>  

                <?php else : ?>

                  <div class="mb-3 px-1 " id='<?php echo $product['id']; ?>'>
                    <button class="add_to_cart btn btn-dark">Add To Cart</button>
                  </div>

                  <div class="mb-3 px-1 ">
                    <a href="productDetail.php?productId=<?php echo $product['id'];?>">
                      <button class="btn btn-dark">Detail</button>
                    </a>
                  </div>

                <?php endif;?>

                </div>
              
            </div>

        </div>

      <?php endforeach; ?>

    </div>
    <!-- <div class="d-flex justify-content-center">
      <button class="btn btn-primary mt-3" id="viewMoreBtn">View More</button>
    </div> -->
  </div>
</section>

<!-- end latest product Section -->

<!-- why section -->

<section class="why_section layout_padding">
  <div class="container">
    <div class="heading_container heading_center">
      <h2>
        Why Shop With Us
      </h2>
    </div>
    <div class="row">
      <div class="col-md-4 animate__animated animate__fadeInTopLeft" style="animation-duration: 5s;">
        <div class="box ">
          <div class="img-box">
            <img src="public/images/delivery.png" width="55px" alt="">

          </div>
          <div class="detail-box">
            <h5>
              Fast Delivery
            </h5>
            <p>
              variations of passages of Lorem Ipsum available
            </p>
          </div>
        </div>

      </div>
      <div class="col-md-4 animate__animated animate__fadeInUp" style="animation-duration: 5s;">
        <div class="box ">
          <div class="img-box">
            <img src="public/images/boy.png" width="55px" alt="">

          </div>
          <div class="detail-box">
            <h5>
              Reliable Reseller
            </h5>
            <p>
              variations of passages of Lorem Ipsum available
            </p>
          </div>
        </div>

      </div>
      <div class="col-md-4 animate__animated animate__fadeInTopRight" style="animation-duration: 5s;">
        <div class="box ">
          <div class="img-box">
            <img src="public/images/quality.png" width="55px" alt="">

          </div>
          <div class="detail-box">
            <h5>
              Fair Price
            </h5>
            <p>
              variations of passages of Lorem Ipsum available
            </p>
          </div>
        </div>

      </div>
    </div>
</section>

<!-- end why section -->

<!-- gift section -->

<section class="gift_section layout_padding-bottom">
  <div class="box ">
    <div class="container-fluid">
      <div class="row p-5">
        <div class="col-md-5 d-flex justify-content-center">
          <div class="img_container">
            <div class="img-box h-100 w-100">
              <img src="public/images/gift.png" class="img-fluid w-100 h-100 " alt="">
            </div>
          </div>
        </div>
        <div class="col-md-7">
          <div class="detail-box">
            <div class="heading_container">
              <h2>
                Surprise Gifts for your <br>
                loved ones
              </h2>
            </div>
            <p>
              Omnis ex nam laudantium odit illum harum, excepturi accusamus at corrupti, velit blanditiis unde perspiciatis, vitae minus culpa? Beatae at aut consequuntur porro adipisci aliquam eaque iste ducimus expedita accusantium?
            </p>
            <div class="btn-box">
              <a href="shop.php" class="btn1">
                Buy Now
              </a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>


<!-- end gift section -->

<!--  review section -->
<section class="review_section">

<div class="backG content-container px-2 pt-2 mt-5 rounded-4">

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
                  <p class="p-2"><span><img src="public/images/quote1.jpg" width="25px" height="30px" class="mx-1" alt=""></span><?= $review['review'] ?><span><img src="public/images/quote.jpg" width="25px" height="30px" class="mx-1" alt=""></span></p>
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
if (isset($_SESSION['id'])) {
  $userId = $_SESSION['id'];
  $hasOrder = $review_cont->hasOrdered($userId);

  if (!isset($hasOrder)) {
    echo '<div class="text-center">
              <a href="review_form.php" class="btn btn-info">Write a review</a>
          </div>';
  } else {
    echo '  <div class="d-flex justify-content-center" >
    <div class="alert alert-info w-50">
              <p class="mb-0 text-center">You need to have at least one order to write a review!!</p>
            </div>
            </div>';
  }
}
?>

</section>
<!-- end review section -->
<!-- contact section -->

<!-- contact section -->

<section class="contact_section ">
  <div class="container px-0">
    <div class="heading_container ">
      <h2 class="">
        Contact Us
      </h2>
    </div>
  </div>
  <div class="container container-bg">
    <div class="row">
      <div class="col-lg-7 col-md-6 px-0">
        <div class="map_container">
          <div class="map-responsive">
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3701.8000907609185!2d96.08659727289253!3d21.903772557155882!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x30cb72c20a8617b7%3A0x78c93d4aa4c2b3ac!2sGarden%20City%20Apartment%20Complex!5e0!3m2!1sen!2smm!4v1690187779545!5m2!1sen!2smm" width="600" height="300" frameborder="0" style="border:0; width: 100%; height:100%" allowfullscreen></iframe>
          </div>
        </div>
      </div>
      <div class="col-md-6 col-lg-5 px-0">
        <form action="#" method="post">
          <div>
            <input type="text" name="name" placeholder="Name" />
          </div>
          <div>
            <input type="email" name="email" placeholder="Email" />
          </div>
          <div>
            <input type="text" name="phone" placeholder="Phone" />
          </div>
          <div>
            <input type="text" name="message" class="message-box" placeholder="Message" />
          </div>
          <div class="d-flex ">
            <button name="submit">
              SEND
            </button>
          </div>
        </form>
      </div>
    </div>
  </div>
</section>

<!-- end contact section -->

<!-- end contact section -->

<!-- client section -->
<section class="client_section layout_padding">
  <div class="container">

  </div>
</section>
<!-- end client section  -->

<?php
include_once __DIR__ . '/layouts/user_footer.php';
?>