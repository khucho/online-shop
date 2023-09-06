<?php
include_once 'layouts/user_navbar.php';
include_once __DIR__ . '/controller/SearchController.php';
$search_cont = new SearchController();
$products = [];
if (isset($_SESSION['team'])) {
    $searchQuery = $_SESSION['team'];

    $products = $search_cont->searchProduct($searchQuery);
}
?>

<div class="row" id="productsContainer">
    <?php
    foreach ($products as $product) {
    ?>
        <div class="col-10 col-sm-6 col-lg-3 col-md-4 py-3 d-flex justify-content-center">
            <div class="card shop_card" style="width: 230px; height:330px;">
                <img src="uploads/<?php echo $product['image']; ?>" class="card-img-top img-fluid" name="image" alt="Image" style="width:230px; height:180px;">
                <div class="card-body text-center">
                    <h6 class="card-title" name="name"><?= $product['name'] ?></h6>
                    <p class="card-text"><strong name="price"><?= $product['price'] ?></strong> MMK</p>
                </div>
                <div class="d-flex justify-content-center">
                    <input type="hidden" name="product_id" value="<?php echo $product['id']; ?>">
                    <div class="mb-3 px-1 " id='<?php echo $product['id']; ?>'>
                        <input type="submit" class="add_to_cart" name="addtocart" value="Add to Cart" style="background-color: #400d51;color:white; border:none; border-radius:5px;">
                    </div>
                </div>
            </div>
        </div>
    <?php
    }
    ?>
</div>

<?php
include_once 'layouts/user_footer.php';
?>