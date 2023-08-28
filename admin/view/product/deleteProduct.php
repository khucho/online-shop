<?php
    include_once __DIR__.'/../../controller/AuthController.php';
    include_once __DIR__.'/../../controller/ProductController.php';

    $auth = new AuthController();
    $auth->authentication();



$id = $_POST['id'];

$pro_con = new ProductController();
$status = $pro_con->deleteProduct($id);

if($status)
{
    echo "success";
}
else
{
    echo "You can't delete as it has related child data";
}
?>