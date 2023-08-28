<?php

include_once __DIR__ . '/../../layouts/admin_navbar.php';

include_once  __DIR__ . '/../../controller/CityController.php';

include_once  __DIR__ . '/../../controller/TownshipController.php';

$id = $_GET['id'];

$city_con = new CityController();
$town_con = new TownshipController();

$township = $town_con->getTownship($id);

$cities = $city_con->cityList();


if (isset($_POST['submit'])) {

    if (empty($_POST['township_name']))
        $townshipError = 'Please enter township name';


    if (isset($townshipError)) {
        $errorCondition = true;
    } else {

        $township = $_POST['township_name'];
        $city = $_POST['city'];

        $updateStatus = $town_con->editTownship($id, $township, $city);

        if ($updateStatus) {
            echo "<script>location.href = 'township.php?updateStatus=" . $updateStatus . "'</script>";
        }
    }
}
?>

<main>
    <div class="content">
        <div class="container-fluid">
            <h2><strong>Edit Township</strong></h2>

            <form action="" method="post">

                <div class="my-3">
                    <label for="" class="form-label">Township Name</label>
                    <input type="text" name="township_name" value="<?php if (isset($_POST['township_name']))  echo $_POST['township_name'];
                                                                    else echo $township['name']; ?>" class="form-control">
                    <?php if (isset($townshipError) && $errorCondition) echo '<span class="text-danger">' . $townshipError . '</span>'; ?>
                </div>


                <div class="my-3">
                    <label for="" class="form-label">City</label>
                    <select name="city" id="" class="form-select">
                        <option value="" disabled>Select city</option>
                        <?php
                        foreach ($cities as $city) {
                        ?>

                            <option value="<?php echo $city['id']; ?>" <?php if (isset($_POST['city'])) {
                                                                            if ($_POST['city'] == $city['id'])  echo 'selected';
                                                                        } else {
                                                                            if (($township['city_id'] == $city['id'])) echo 'selected';
                                                                        } ?>>
                                <?php echo $city['name']; ?>
                            </option>

                        <?php
                        }
                        ?>
                    </select>
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