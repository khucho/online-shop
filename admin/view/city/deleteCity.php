<?php
    include_once __DIR__.'/../../controller/AuthController.php';
    include_once __DIR__.'/../../controller/CityController.php';

    $auth = new AuthController();
    $auth->authentication();



$id = $_POST['id'];

$city_controller = new CityController();
$status = $city_controller->deleteCity($id);

if($status)
{
    echo "Successfully deleted";
}
else
{
    echo "You can't delete as it has related data";
}
?>