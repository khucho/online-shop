<?php 
include_once __DIR__.'/../../controller/ReportController.php';
include_once __DIR__.'/../../controller/ProductController.php';

$rep_con = new ReportController();
$pro_con = new ProductController();
        $month = $_POST['month'];
        // die(var_dump($month));
        $year = $_POST['year'];
        $result = $rep_con->getStockReport($month,$year);
        $result1 = $rep_con->getOrderReport($month,$year);
        $status = $rep_con->totalPrice($month,$year);
        $orders = $rep_con->totalOrderPrice($month,$year);
        $html = "";
        $html .= "<div class='container mt-3'><div class='col-md-10'><div class= 'card text-center'><div class='card-header'><h2>လအလိုက် ဝင်ငွေ/ထွက်ငွေ စာရင်း</h2>";
        $html.="</div><div class='card-body'><div class='row mt-3'>";
        $html.= "<table class = 'table table-dark'><tr><th>ထွက်ငွေ</th><th>ဝင်ငွေ</th></tr>";
        $html .= "";  
        $count = 1;    
        foreach($result as $report)
        { 
        $html .= "<tr><td>".$report['buyingPrice']."</td>";        
        foreach ($result1 as $report1)
        {      
           $html .= "<td>".$report1['sellingPrice']."</td>";       
        } 
        $html .= "</tr>";         
        }
        $html .= "</table>";
        $html .= "</div>";
         $html .= "<div class='row mt-3'><div class='col-md-6'>";
        $html.= "<table class = 'table table-warning table-striped'><tr><th>စဉ်</th><th>ပစ္စည်း</th><th>ထွက်ငွေ</th></tr>";
        $html .= "";  
        $count = 1;    
        foreach ($status as $total)
        {
                $html .= "<tr><td>".$count++."</td>";
                $html .= "<td>".$total['name']."</td>";
                $html .= "<td>".$total['totalPrice']."</td>";
                $html .= "</tr>";       
        }                 
        $html .= "</table>";
        $html .= "</div>";
        $html .= "<div class='col-md-6'>";
        $html.= "<table class = 'table table-danger table-striped'><tr><th>စဉ်</th><th>ပစ္စည်း</th><th>ဝင်ငွေ</th></tr>";
        $html .= "";  
        $count = 1;    
        foreach ($orders as $order)
        {
                $html .= "<tr><td>".$count++."</td>";
                $html .= "<td>".$order['name']."</td>";
                $html .= "<td>".$order['sellingPrice']."</td>";
                $html .= "</tr>";       
        }                 
        $html .= "</table>";
        $html .= "</div>";
        $html .= "</div></div></div></div>";
        echo $html; 
    

?>