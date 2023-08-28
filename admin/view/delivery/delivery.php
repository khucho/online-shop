<?php

include_once __DIR__ . '/../../layouts/admin_navbar.php';
include_once  __DIR__ . '/../../controller/DeliveryController.php';

$deli_con = new DeliveryController();
$deliveries = $deli_con->deliveryList();

?>

<main>
    <div class="content">
        <div class="container-fluid">
            <h2><strong>Delivery Dashboard</strong></h2>

            <?php
            if (isset($_GET['addStatus']) && $_GET['addStatus'] == true) {
                echo "<span class='text-success'>New Delivery has been successfully created.</span>";
            }

            ?>

            <?php
            if (isset($_GET['updateStatus']) && $_GET['updateStatus'] == true) {
                echo "<span class='text-success'>Delivery has been successfully updated.</span>";
            }

            ?>


            <div class="row mt-3">
                <div class="col-md-3">
                    <a href="addDelivery.php" class="btn btn-primary">Add New Delivery</a>
                </div>
            </div>

            <div class="row mt-3">
                <div class="col-md-12">
                    <table class="table table-striped" id="mytable">
                        <thead>
                            <th>No</th>
                            <th>Township Name</th>
                            <th>Fee</th>
                            <th>Action</th>
                        </thead>
                        <tbody>
                            <?php
                            $count = 1;
                            foreach ($deliveries as $delivery) {
                                echo "<tr>";
                                echo "<td>" . $count++ . "</td>";

                                echo "<td>" . $delivery['township_name'] . "</td>";

                                echo "<td>" . $delivery['fee'] . "</td>";

                                echo "<td id='" . $delivery['id'] . "'>
                                <a class= 'btn btn-warning mx-3' href='editDelivery.php?id=" . $delivery['id'] . "'>Edit</a>
                                <button class = 'btn btn-danger mx-3 delivery_delete'>Delete</button>
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