<?php
include_once __DIR__ . '/../../layouts/admin_navbar.php';
include_once __DIR__ . '/../../controller/ReviewController.php';

$reviewCont = new ReviewController();
$reviews = $reviewCont->getReview();
?>
<main class="content">
    <div class="container-fluid p-0">

        <h1 class="h3"><strong>Review</strong> Dashboard</h1>

        <?php
        if (isset($_GET['deleteStatus']) && $_GET['deleteStatus'] == true) {
            echo "<span class='text-success'>Group has been successfully deleted.</span>";
        }

        ?>

        <div class="row mt-3">
            <div class="col-md-12">
                <table class="table table-striped" id="mytable">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Username</th>
                            <th>Review</th>
                            <th>Rating</th>
                            <th>Actions</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php $count = 1;
                        foreach ($reviews as $review) : ?>
                            <tr>
                                <td><?= $count++ ?></td>
                                <td><?= $review['username'] ?></td>
                                <td><?= $review['review'] ?></td>
                                <td><?= $review['rating'] ?></td>
                                <?php if ($review['status'] == "accept") : ?>
                                    <td>Accepted</td>
                                <?php elseif ($review['status'] == "reject") : ?>
                                    <td>Rejected</td>
                                <?php else : ?>
                                    <td id="<?= $review['id'] ?>"> <a class="btn btn-primary mx-3" href="actionReview.php?id=<?= $review['id'] ?>">Accept</a> <a class="btn btn-danger mx-3" href="rejectReview.php?id=<?= $review['id'] ?>">Reject</a></td>
                                <?php endif; ?>
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