<?php
include_once __DIR__ . '/../../layouts/admin_navbar.php';
include_once __DIR__ . '/../../controller/stockController.php';
include_once __DIR__ . '/../../controller/ProductController.php';

$stock_con = new StockController();
$stocks = $stock_con->getStocks();
$stockIn = $stock_con->getStockList();
// die(var_dump($stockIn));
$stockOut = $stock_con->getOrderList();
// die(var_dump($stockOut));
?>
<main>
    <div class="content">
        <div class="container-fluid">
            <h2><strong class="text-info">Stock Detail Dashboard</strong></h2>
            <div class="row">
                <div class="col-md-12 mt-3">
                    <table class="table table-striped" id="mytable">
                        <thead>
                            <th>No</th>
                            <th>Product Name</th>
                            <th>Avaliable stock</th>
                        </thead>
                        <tbody>
                            <?php
                            $count = 1;
                            $stock_out = 0;
                            foreach ($stocks as $stock) {
                                echo "<tr>";
                                echo "<td>" . $count++ . "</td>";
                                echo "<td class='text-info'>" . $stock['pname'] . "</td>";
                                foreach ($stockIn as $stIn) {
                                    if ($stIn['product_id'] == $stock['product_id']) {
                                        $stock_in = $stIn['stock_in'];
                                    }
                                }
                                foreach ($stockOut as $stOut) {
                                    if ($stOut['product_id'] == $stock['product_id']) {
                                        if (isset($stOut)) {
                                            $stock_out = $stOut['stock_out'];
                                        } else {
                                            $stock_out = 0;
                                        }
                                    }
                                }
                                // die(var_dump($stock_out));

                                $avaliable_stock = $stock_in - $stock_out;
                                echo "<td>" . $avaliable_stock . "</td>";
                                // die(var_dump($avaliable_stock));
                                // echo "<td>".$stock['price']."</td>";
                                // echo "<td>".$stock['date']."</td>";
                                echo "</tr>";
                            }
                            ?>
                        </tbody>
                    </table>
                </div>

            </div>

        </div>
    </div>

</main>
<?php
include_once __DIR__ . '/../../layouts/admin_footer.php';
?>