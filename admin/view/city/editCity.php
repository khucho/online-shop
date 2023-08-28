<?php

include_once __DIR__ . '/../../layouts/admin_navbar.php';
include_once __DIR__ . '/../../controller/CityController.php';

$id = $_GET['id'];

$city_controller = new CityController();
$city = $city_controller->getCity($id);


if (isset($_POST['submit'])) {
    if (empty($_POST['name'])) {
        $nameError = 'Please Enter Category Name';
    } else {

        $name = $_POST['name'];
        $updateStatus = $city_controller->editCity($id, $name);

        if ($updateStatus) {
            echo "<script>location.href='city.php?updateStatus=" . $updateStatus . "'</script>";
        }
    }
}


?>
<main class="content">
    <div class="container-fluid p-0">
        <h1 class="h3 mb-3"><strong>City</strong></h1>

        <div class='row'>
            <div class='col-md-3'>
                <form action="" method="POST">
                    <div>
                        <label for="" class="form-label">City Name</label>
                        <input type="text" name="name" value="<?php echo $city['name'] ?>" class="form-control">
                        <?php if (isset($nameError)) echo '<span class="text-danger">' . $nameError . '</span>' ?>
                    </div>
                    <div class="mt-3">
                        <button class="btn btn-dark" name="submit">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</main>
<?php

include_once __DIR__ . '/../../layouts/admin_footer.php';
