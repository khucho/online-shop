<?php
    include_once __DIR__.'/../../controller/AuthController.php';
    include_once __DIR__ . '/../../controller/GroupController.php';


    $auth = new AuthController();
    $auth->authentication();

$id = $_POST['id'];

$group_con = new groupController();
$result = $group_con->deleteGroup($id);
if ($result) 
{
    echo "success";
} 
else 
{
    echo "You can't delete it as it has related child data";
}
