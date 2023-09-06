<?php
include_once __DIR__ . '/../../controller/AuthController.php';

$auth = new AuthController();
$auth->authentication();
?>

<?php
include_once __DIR__ . '/../../layouts/admin_navbar.php';
include_once __DIR__ . '/../../controller/ContactController.php';
$contact_cont = new ContactController();
$messages = $contact_cont->getMessage();

?>
<main class="content">
    <div class="container-fluid p-0">

        <h1 class="h3"><strong>Contact Messages</strong> Dashboard</h1>

        <div class="row mt-3">
            <div class="col-md-12">
                <table class="table table-striped" id="mytable">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Date</th>
                            <th>Message</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php $count = 1;
                        foreach ($messages as $message) : ?>
                            <tr>
                                <td><?= $count++ ?></td>
                                <td><?= $message['name'] ?></td>
                                <td><?= $message['email'] ?></td>
                                <td><?= $message['phone'] ?></td>
                                <td><?= $message['date2'] ?></td>
                                <td><?= $message['message'] ?></td>
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