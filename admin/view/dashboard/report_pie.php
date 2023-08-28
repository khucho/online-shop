<?php
include_once __DIR__.'/../../controller/CategoryController.php';

$cat_con = new CategoryController();
$categories = $cat_con->categoryPerProduct();

echo json_encode($categories);

?>