<?php

include_once __DIR__ . '/../../layouts/admin_navbar.php';

include_once  __DIR__ . '/../../controller/TownshipController.php';

include_once  __DIR__ . '/../../controller/DeliveryController.php';


$town_con = new TownshipController();
$deli_con = new DeliveryController();

$townships = $town_con->townshipList();


if (isset($_POST['submit'])) {

    if (empty($_POST['fee']))
        $deliveryError = 'Please enter delivery fee';

    if (empty($_POST['township']))
        $townshipError = "Please select township";


    if (isset($deliveryError) || isset($townshipError)) {
        $errorCondition = true;
    } else {

        $township = $_POST['township'];
        $fee = $_POST['fee'];

        $addStatus = $deli_con->addDelivery($township, $fee);

        if ($addStatus) {
            echo "<script>location.href = 'delivery.php?addStatus=" . $addStatus . "'</script>";
        }
    }
}
?>

<main>
    <div class="content">
        <div class="container-fluid">
            <h2><strong>Add New Township</strong></h2>

            <form action="" method="post">

                <div class="my-3">
                    <label for="" class="form-label">Fee</label>
                    <input type="number" name="fee" min="1" value="<?php if (isset($_POST['fee']))  echo $_POST['fee']; ?>" class="form-control">
                    <?php if (isset($deliveryError) && $errorCondition) echo '<span class="text-danger">' . $deliveryError . '</span>'; ?>
                </div>


                <div class="my-3">
                    <label for="" class="form-label">Township</label>
                    <select name="township" id="" class="form-select">
                        <option value="" selected disabled>Select township</option>
                        <?php
                        foreach ($townships as $township) {
                        ?>

                            <option value="<?php echo $township['township_id']; ?>" <?php if ((isset($_POST['township']) && $_POST['township']) == $township['township_id']) echo 'selected'; ?>>
                                <?php echo $township['township_name']; ?>
                            </option>

                        <?php
                        }
                        ?>
                    </select>
                    <?php if (isset($townshipError) && $errorCondition) echo '<span class="text-danger">' . $townshipError . '</span>'; ?>
                </div>

                <div class="mt-3">
                    <button class="btn btn-dark" type="submit" name="submit">Add</button>
                </div>
            </form>

        </div>
    </div>

</main>

<?php
include_once __DIR__ . '/../../layouts/admin_footer.php';
?>