<?php

include_once __DIR__ . '/../../layouts/admin_navbar.php';

include_once  __DIR__ . '/../../controller/CityController.php';

include_once  __DIR__ . '/../../controller/TownshipController.php';


$city_con = new CityController();
$town_con = new TownshipController();

$cities = $city_con->cityList();


if (isset($_POST['submit'])) {

    if (empty($_POST['township_name']))
        $townshipError = 'Please enter township name';

    if (empty($_POST['city']))
        $cityError = "Please select city";


    if (isset($townshipError) || isset($cityError)) {
        $errorCondition = true;
    } else {

        $township = $_POST['township_name'];
        $city = $_POST['city'];

        $addStatus = $town_con->addTownship($township, $city);

        if ($addStatus) {
            echo "<script>location.href = 'township.php?addStatus=" . $addStatus . "'</script>";
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
                    <label for="" class="form-label">Township Name</label>
                    <input type="text" name="township_name" value="<?php if (isset($_POST['township_name']))  echo $_POST['township_name']; ?>" class="form-control">
                    <?php if (isset($townshipError) && $errorCondition) echo '<span class="text-danger">' . $townshipError . '</span>'; ?>
                </div>


                <div class="my-3">
                    <label for="" class="form-label">City</label>
                    <select name="city" id="" class="form-select">
                        <option value="" selected disabled>Select city</option>
                        <?php
                        foreach ($cities as $city) {
                        ?>

                            <option value="<?php echo $city['id']; ?>" <?php if ((isset($_POST['city']) && $_POST['city']) == $city['id']) echo 'selected'; ?>>
                                <?php echo $city['name']; ?>
                            </option>

                        <?php
                        }
                        ?>
                    </select>
                    <?php if (isset($cityError) && $errorCondition) echo '<span class="text-danger">' . $cityError . '</span>'; ?>
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