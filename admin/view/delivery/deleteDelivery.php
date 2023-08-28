<?php
    include_once __DIR__.'/../../controller/AuthController.php';
    include_once __DIR__.'/../../controller/DeliveryController.php';

    $auth = new AuthController();
    $auth->authentication();



$id = $_POST['id'];

$deli_con = new DeliveryController();
$status = $deli_con->deleteDelivery($id);

if($status)
{
    echo "Successfully deleted";
}
else
{
    echo "You can't delete as it has related child data";
}
?>