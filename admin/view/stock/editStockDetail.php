<?php
include_once __DIR__ . '/../../layouts/admin_navbar.php';
include_once __DIR__ . '/../../controller/stockController.php';
include_once __DIR__ . '/../../controller/ProductController.php';

$id = $_GET['id'];
$stock_con = new StockController();
$stocks = $stock_con->getEditStockDetail($id);
$pro_con = new ProductController();
$products = $pro_con->getProducts();

if (isset($_POST['submit'])) {
    $product = $_POST['product'];
    $quantity = $_POST['quantity'];
    $date = $_POST['date'];
    $buy_price = $_POST['buy_price'];
    $status = $stock_con->editStockDetail($id, $product, $quantity, $date, $buy_price);
    // die(var_dump($status));

    if ($status) {
        echo "<script>location.href='stock_details.php?updatestatus=" . $status . "'</script>";
    }
}
?>
<main>
    <div class="content">
        <div class="container-fluid">
            <h2><strong class="text-info"> Add New Stock</strong></h2>

            <div class="row">

                <div class="col-md-8">
                    <div class="row mt-3">
                        <div class="card">

                            <div class="card-body">
                                <form action="" method="post">
                                    <div>
                                        <label for="" class="form-label">Product Name</label>
                                        <select name="product" id="" class="form-select">
                                            <option value="" selected disabled>Select product</option>
                                            <?php
                                            foreach ($products as $product) {
                                            ?>

                                                <option value="<?php echo $product['id']; ?>" class="text-primary" <?php if (isset($_POST['product'])) {
                                                                                                                        if ($_POST['product'] == $product['id']) echo 'selected';
                                                                                                                    } else {
                                                                                                                        if ($product['id'] == $stocks['product_id']) echo 'selected';
                                                                                                                    } ?>><?php echo $product['proname']; ?></option>

                                            <?php
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <div>
                                        <label for="" class="form-label">Quantity</label>
                                        <input type="text" class="form-control" name="quantity" value="<?php echo $stocks['qty']; ?>">
                                    </div>
                                    <div>
                                        <label for="" class="form-label">Buying Price</label>
                                        <input type="text" class="form-control" name="buy_price" value="<?php echo $stocks['buy_priceEach']; ?>">
                                    </div>
                                    <div>
                                        <label for="" class="form-label">Date</label>
                                        <input type="date" class="form-control" name="date" value="<?php echo $stocks['date']; ?>">
                                    </div>
                                    <div class="mt-3">
                                        <button name="submit" class="btn btn-warning">Add</button>
                                    </div>
                                </form>
                            </div>

                        </div>
                    </div>



                </div>
            </div>

        </div>
    </div>

</main>
<?php
include_once __DIR__ . '/../../layouts/admin_footer.php';
?>