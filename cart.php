<?php

include_once __DIR__ . '/layouts/user_navbar.php';
include_once __DIR__ . '/controller/CartController.php';

$id = $_SESSION['id'];

$cart_controller = new CartController();
$carts = $cart_controller->cartDetail($id);


$total = 0;
foreach ($carts as $cart) {
    $total += ($cart['qty'] * $cart['product_price']);
}


// if (isset($_POST['checkOut']))
// {
//     die(var_dump($_POST['price']));

//     $userId = $id;
//    $product = $_POST['product_id'];
//    die(var_dump(count($product)));
// }


?>
<div class="container  product-data mt-4">
    <!-- <form action="" method="post"> -->

    <div class="row my-5">

        <div class="col-md-7 table-responsive mb-5">
            <table class="table table-striped table-light table-borderless table-hover text-center mb-0" id="itemTable">
                <thead class="thead-dark">
                    <tr>
                        <th></th>
                        <th>Products</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Total</th>
                        <th>Remove</th>
                    </tr>
                </thead>
                <tbody class="align-middle">
                    <?php
                    foreach ($carts as $cart) {


                    ?>
                        <tr id="itemData">
                            <td>
                                <div class="form-check">
                                    <input id="checkBox" class="form-check-input" name="product_id[]" type="checkbox" value="<?php echo $cart['product_id']; ?>">
                                </div>
                            </td>

                            <td class="align-middle"><img src="uploads/<?php echo $cart['image']; ?>" alt="" style="width: 50px;"><?php echo $cart['product_name']; ?></td>

                            <input type="hidden" id="price" name="price[]" value="<?php echo $cart['product_price']; ?>">
                            <td class="align-middle">
                                <?php echo $cart['product_price']; ?> Kyats
                            </td>

                            <td class="align-middle">
                                <div class="input-group quantity mx-auto" style="width: 100px;">
                                    <div class="input-group-btn">
                                        <button class="btn btn-sm btn-primary btn-minus">
                                            <i class="fa fa-minus"></i>
                                        </button>
                                    </div>
                                    <input type="number" min="1" class="form-control form-control-sm border-0 text-center" id="qty" value="<?php echo $cart['qty'] ?>" style="width: 40px ;">
                                    <div class="input-group-btn">
                                        <button class="btn btn-sm btn-primary btn-plus">
                                            <i class="fa fa-plus"></i>
                                        </button>
                                    </div>
                                </div>
                            </td>
                            <td class="align-middle" id="totalPrice"><?php echo ($cart['qty'] * $cart['product_price']) ?></td>
                            <td class="align-middle">
                                <button class="btn btn-sm btn-remove btn-danger" id="<?php echo $cart['product_id']; ?>">
                                    <i class="fa fa-times"></i>
                                </button>
                            </td>
                        </tr>

                    <?php } ?>

                </tbody>
            </table>
        </div>

        <div class="col-md-4 offset-1">
            <h2 class="section-title text-center bg-dark text-white text-uppercase mb-3"><span class="pr-3">Cart Summary</span></h2>

            <div class="bg-light p-30 my-3">
                <div class="border-bottom pb-2">
                    <div class="d-flex justify-content-between mb-3 p-2">
                        <h6>Subtotal</h6>
                        <h6 id="subTotal"><?php echo $total; ?></h6>
                    </div>
                    <div class="d-flex justify-content-between p-2">
                        <h6 class="font-weight-medium">Shipping</h6>
                        <h6 class="font-weight-medium">$10</h6>
                    </div>
                </div>
                <div class="pt-2">
                    <div class="d-flex justify-content-between mt-2 p-2">
                        <h5>Total</h5>
                        <h5 id="total"><?php echo ($total + 10); ?></h5>
                    </div>
                    <div class="d-flex justify-content-between mt-2 p-2">
                        <h5>Voucher Code</h5>
                        <input type="text" name="code" id="voucher_code" value="">
                    </div>
                    <button name="checkOut" id="orderBtn" class="btn btn-block btn-primary font-weight-bold my-3 py-3">Proceed To Checkout</button>
                </div>
            </div>
        </div>
        <!-- </form> -->
    </div>



    <?php
    include_once __DIR__ . '/layouts/user_footer.php';
    ?>