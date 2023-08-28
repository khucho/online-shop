<?php

include_once __DIR__ . '/../../layouts/admin_navbar.php';
include_once  __DIR__ . '/../../controller/ProductController.php';

$pro_con = new ProductController();
$products = $pro_con->getProducts();

?>

<main>
    <div class="content">
        <div class="container-fluid">
            <h2><strong>Product Dashboard</strong></h2>

            <?php
            if (isset($_GET['addStatus']) && $_GET['addStatus'] == true) {
                echo "<span class='text-success'>New Product has been successfully created.</span>";
            }

            ?>

            <?php
            if (isset($_GET['updateStatus']) && $_GET['updateStatus'] == true) {
                echo "<span class='text-success'>Product has been successfully updated.</span>";
            }

            ?>

            <?php
            if (isset($_GET['deleteStatus']) && $_GET['deleteStatus'] == true) {
                echo "<span class='text-success'>Product has been successfully deleted.</span>";
            }

            ?>


            <div class="row mt-3">
                <div class="col-md-3">
                    <a href="addProduct.php" class="btn btn-primary">Add New Product</a>
                </div>
            </div>

            <div class="row mt-3">
                <div class="col-md-12">
                    <table class="table table-striped" id="mytable">
                        <thead>
                            <th>No</th>
                            <th>Product Name</th>
                            <th>Image</th>
                            <th>Category Name</th>
                            <th>Team Name</th>
                            <th>Action</th>
                        </thead>
                        <tbody>
                            <?php
                            $count = 1;
                            foreach ($products as $product) {
                                echo "<tr>";
                                echo "<td>" . $count++ . "</td>";
                                echo "<td>" . $product['proname'] . "</td>";
                                echo "<td><img src = '../../../uploads/" . $product['image'] . "' width = '100px' height = '100px' ></td>";
                                echo "<td>" . $product['cname'] . "</td>";
                                echo "<td>" . $product['tname'] . "</td>";
                                echo "<td id='" . $product['id'] . "'>
                                <a class= 'btn btn-warning mx-3' href='editProduct.php?id=" . $product['id'] . "'>Edit</a>
                                <button class = 'btn btn-danger mx-3 product_delete'>Delete</button>
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