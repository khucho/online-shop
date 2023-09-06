<?php
include_once 'layouts/user_navbar.php';
include_once __DIR__ . '/controller/ContactController.php';

$product_cont = new ProductController();
$products = $product_cont->getLatestProduct();

$contact_cont = new ContactController();
if (isset($_POST['submit'])) {
  $name = $_POST['name'];
  $email = $_POST['email'];
  $phone = $_POST['phone'];
  $message = $_POST['message'];
  $status = $contact_cont->addMessage($name, $email, $phone, $message);
}
?>
<!-- contact section -->

<section class="contact_section layout_padding">
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
        <form action="#">
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
            <button type="submit">
              SEND
            </button>
          </div>
          <?php if ($status) : ?>
            <p>Your message has been sent</p>
          <?php endif; ?>
        </form>
      </div>
    </div>
  </div>
</section>

<!-- end contact section -->

<!-- info section -->

<?php
include_once 'layouts/user_footer.php';
?>