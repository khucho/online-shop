<?php

include_once __DIR__ . '/layouts/user_navbar.php';
include_once __DIR__ . '/controller/ProductController.php';
include_once __DIR__ . '/controller/CartController.php';

$productId = $_GET['productId'];
$userId = $_SESSION['id'];

$product_cont = new ProductController();
$product = $product_cont->productDetail($productId);

$cart_controller = new CartController();
$carts = $cart_controller->getCart($userId);


if (!empty($carts)) {
    foreach ($carts as $cart) {
        $cartLists[] = $cart['product_id'];
    }
}


?>

<section class="productDetailSection">
    <div class="container my-5">

        <div class="row justify-content-center">

            <div class="col-md-9">
                <div class="row detail_section p-5">
                    <div class="col-md-5">
                        <img src="uploads/<?= $product['image']; ?>" alt="img" class="img-fluid rounded-5">
                    </div>
                    <div class="col-md-7 mt-4 mt-md-0">
                        <h2 class="text-center text-md-left"><?= $product['name'] ?></h2>
                        <div class="mt-4">
                            <h3 class="text-center text-md-left mb-3"><strong><?= $product['price'] ?></strong> MMK</h3>

                            <p class="text-md-left mb-3"><strong>Version :</strong> 9</p>
                            <p class="text-md-left mb-4"><strong>Description :</strong><?= $product['description'] ?></p>


                            <div class="row">
                                <div class="col-auto pt-2">
                                    <p>Quantity :</p>
                                </div>
                                <div class="col-md">
                                    <div class="input-group">
                                        <button type="button" class="btn btn-primary btn-decrease">-</button>
                                        <input type="number" id="qty" class="form-control text-center" name="qty" value="1">
                                        <button type="button" class="btn btn-primary btn-increase">+</button>
                                    </div>
                                </div>

                                <?php if (isset($cartLists) && in_array($productId, $cartLists)) : ?>

                                    <div class="col-auto mt-2 mt-md-0">
                                        <span class="btn btn-success">Already added</span>
                                    </div>
                                <?php elseif (isset($_SESSION['id']) && $_SESSION['role'] == 'user') : ?>

                                    <div class="col-auto mt-2 mt-md-0" id="<?php echo $productId ?>">
                                        <input type="submit" class="btn btn-success add_cart" name="submit" value="Add to Cart">
                                    </div>

                                <?php else : ?>

                                    <div class="col-auto mt-2 mt-md-0" id="<?php echo $productId ?>">
                                        <a href="logIn.php">
                                            <input type="submit" class="btn btn-success" name="submit" value="Add to Cart">
                                        </a>
                                    </div>

                                <?php endif; ?>
                            </div>


                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

</section>

<?php
include_once __DIR__ . '/layouts/user_footer.php';
?>