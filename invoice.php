<?php
include_once __DIR__.'/../../controller/AuthController.php';

$auth = new AuthController();
$auth->authentication();
?>

<?php
include_once __DIR__ . '/../../layouts/admin_navbar.php';
include_once __DIR__ . '/../../controller/OrderController.php';

$code = $_GET['code'];
$order_cont = new OrderController();
$orders = $order_cont->getOrder($code);
$customer = $order_cont->getUser($code);

?>
<style>
    @media print {

        .navbar,
        #printButton,
        .footer {
            display: none;
        }

        .invoice_design {
            background-color: #ff55bb;
        }
    }
</style>
<main class="content">
    <div class="container mt-5">
        <div class="row">
            <div class="invoice_design col-md-8 offset-md-2">
                <div class="text-center mb-4">
                    <h2><strong>INVOICE</strong></h2>
                </div>

                <!-- Customer Information -->
                <div class="row pb-3">
                    <div class="col-md-6">
                        <p><strong>Order Code: </strong><?= $customer['code'] ?></p>
                        <p><strong>Date: </strong><?= $customer['phone'] ?></p>
                    </div>
                    <div class="col-md-6">
                        <p><strong>Customer Name: </strong><?= $customer['uname'] ?></p>
                        <p><strong>Address: </strong><?= $customer['address'] ?></p>
                        <p><strong>Phone: </strong><?= $customer['phone'] ?></p>
                    </div>
                </div>

                <!-- Products Table -->
                <table class="table table-bordered table-success table-striped">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Product Name</th>
                            <th>Quantity</th>
                            <th>Price</th>
                            <th>Subtotal</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $count = 1;
                        $total = 0;
                        foreach ($orders as $order) : ?>
                            <tr>
                                <td><?= $count++ ?></td>
                                <td><?= $order['pname'] ?></td>
                                <td><?= $order['quantity'] ?></td>
                                <td><?= $order['price'] ?></td>
                                <td><?= $subtotal = $order['quantity'] * $order['price']; ?></td>
                            </tr>
                        <?php $total += $subtotal;
                        endforeach; ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="4" class="text-right"><strong>Total Price:</strong></td>
                            <td colspan="1"><strong>$ <?= $total ?></strong></td>
                        </tr>
                    </tfoot>
                </table>
                <h2 class="text-center">Thank You</h2>
            </div>
            <button id="printButton" class="text-center w-25 my-3 btn btn-dark" onclick="window.print()">Print Invoice</button>
        </div>
    </div>
</main>

<?php
include_once __DIR__ . '/../../layouts/admin_footer.php';
?>