<?php
include_once __DIR__.'/../../controller/ReportController.php';

$year = $_POST['year'];
// die(var_dump($year));
$rep_con = new ReportController();
$report = $rep_con->totalPerMonth($year);

echo json_encode($report);

?>