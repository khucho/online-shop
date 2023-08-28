<?php
    include_once __DIR__.'/../../controller/AuthController.php';
    include_once __DIR__.'/../../controller/UserController.php';

    $auth = new AuthController();
    $auth->authentication();



$id = $_POST['id'];

$user_controller = new UserController();
$status = $user_controller->deleteUser($id);


if($status)
{
    echo "Successfully deleted";
}
else
{
    echo "You can't delete as it has related data";
}
?>