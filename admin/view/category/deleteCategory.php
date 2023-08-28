<?php
    include_once __DIR__.'/../../controller/AuthController.php';
    include_once __DIR__.'/../../controller/categoryController.php';

    $auth = new AuthController();
    $auth->authentication();



$id = $_POST['id'];

$cat_controller = new CategoryController();
$status = $cat_controller->deleteCategory($id);

if($status)
{
    echo "Successfully deleted";
}
else
{
    echo "You can't delete as it has related data";
}
?>