<?php
include_once __DIR__ . '/../../layouts/admin_navbar.php';
include_once __DIR__ . '/../../controller/stockController.php';
include_once __DIR__ . '/../../controller/ProductController.php';

$stock_con = new StockController();
$stocks = $stock_con->getStock();


?>
<main>
    <div class="content">
        <div class="container-fluid">
            <h2><strong class="text-info">Stock Detail Dashboard</strong></h2>

            <?php
            if (isset($_GET['addstatus']) && $_GET['addstatus'] == true) {
                echo "<span class='text-success'>New stock has been successfully created.</span>";
            }

            ?>

            <?php
            if (isset($_GET['updatestatus']) && $_GET['updatestatus'] == true) {
                echo "<span class='text-success'>stock has been successfully updated.</span>";
            }

            ?>

            <?php
            if (isset($_GET['deleteStatus']) && $_GET['deleteStatus'] == true) {
                echo "<span class='text-success'>Product has been successfully deleted.</span>";
            }

            ?>




            <div class="row">
                <div class="mt-3">
                    <a href="addStockDetail.php" class="btn btn-dark">Add New Stock</a>
                </div>
                <div class="col-md-12 mt-3">
                    <table class="table table-striped" id="mytable">
                        <thead>
                            <th>No</th>
                            <th>Product Name</th>
                            <th>Quantity</th>
                            <th>Buying Price</th>
                            <th>Date</th>
                            <th>Action</th>
                        </thead>
                        <tbody>
                            <?php
                            $count = 1;
                            foreach ($stocks as $stock) {
                                echo "<tr>";
                                echo "<td>" . $count++ . "</td>";
                                echo "<td class='text-info'>" . $stock['pname'] . "</td>";
                                echo "<td>" . $stock['qty'] . "</td>";
                                echo "<td>" . $stock['price'] . "</td>";
                                echo "<td>" . $stock['date'] . "</td>";

                                echo "<td id='" . $stock['id'] . "'>
                                        <a class= 'btn btn-warning mx-1' href='editStockDetail.php?id=" . $stock['id'] . "'>Edit</a>
                                        <button class = 'btn btn-danger mx-1 stockDetail_delete'>Delete</button>
                                    </td>";
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