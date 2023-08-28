<?php
    include_once __DIR__.'/../../controller/AuthController.php';
    include_once __DIR__.'/../../controller/TownshipController.php';

    $auth = new AuthController();
    $auth->authentication();



$id = $_POST['id'];

$town_con = new TownshipController();
$status = $town_con->deleteTownship($id);

if($status)
{
    echo "Successfully deleted";
}
else
{
    echo "You can't delete as it has related child data";
}
?>