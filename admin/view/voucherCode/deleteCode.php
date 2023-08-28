<?php
    include_once __DIR__.'/../../controller/AuthController.php';
    include_once __DIR__.'/../../controller/CodeController.php';

    $auth = new AuthController();
    $auth->authentication();



$id = $_POST['id'];

$code_controller = new CodeController();
$status = $code_controller->deleteCode($id);

if($status)
{
    echo "Successfully deleted";
}
else
{
    echo "You can't delete as it has related data";
}
?>