<?php

include_once __DIR__ . '/../../layouts/admin_navbar.php';
include_once __DIR__ . '/../../controller/CityController.php';



if (isset($_POST['submit'])) {
    if (empty($_POST['name'])) {
        $nameError = 'Please Enter City Name';
    } else {
        $name = $_POST['name'];

        $city_controller = new CityController();
        $status = $city_controller->addCity($name);

        if ($status) {
            echo '<script>location.href="city.php?status=' . $status . '"</script>';
        }
    };
}

?>
<main class="content">
    <div class="container-fluid p-0">
        <h1 class="h3 mb-3"><strong>Add New City</strong></h1>

        <div class='row'>
            <div class='col-md-12'>
                <form action='' method='POST'>
                    <div>
                        <label class='form-label'>City Name</label>
                        <input type='text' name='name' class='form-control'>
                        <?php if (isset($nameError)) echo '<span class="text-danger">' . $nameError . '</span>' ?>
                    </div>
                    <div class='mt-3'>
                        <button class='btn btn-dark' name='submit'>Add</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</main>

<?php

include_once __DIR__ . '/../../layouts/admin_footer.php';

?>