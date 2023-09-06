<?php
include_once __DIR__ . '/../../layouts/admin_navbar.php';
include_once __DIR__ . '/../../controller/OrderController.php';


$order_cont = new OrderController();
$orders = $order_cont->getOrders();



?>
<main class="content">
    <div class="container-fluid p-0">

        <h1 class="h3"><strong>Orders</strong> Dashboard</h1>

        <div class="row mt-3">
            <div class="col-md-12">
                <table class="table table-striped" id="mytable">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Name</th>
                            <th>Order Code</th>
                            <th>Date</th>
                            <th>Details</th>
                            <th>Actions</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php $count = 1;
                        foreach ($orders as $order) : ?>
                            <tr>
                                <th><?= $count++ ?></th>
                                <th><?= $order['name'] ?></th>
                                <th><?= $order['code'] ?></th>
                                <th><?= $order['date'] ?></th>
                                <th><a href='invoice.php?code=<?= $order['code']; ?>' class="btn btn-info">View Details</a></th>
                                <th id="<?php echo $order['code']; ?>">
                                    <?php if ($order['status'] == 'pending') : ?>
                                        <button class='btn btn-success btn_accept mx-3'>Accept</button>
                                        <button class='btn btn-danger btn_decline mx-3'>Decline</button>

                                    <?php elseif ($order['status'] == 'accept') : ?>
                                        <span class="text-success">Already accepted</span>

                                    <?php elseif ($order['status'] == 'decline') : ?>
                                        <span class="text-danger">Already declined</span>

                                    <?php endif; ?>
                                </th>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>





    </div>
</main>

<?php
include_once __DIR__ . '/../../layouts/admin_footer.php';
?>