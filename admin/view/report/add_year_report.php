<?php 
include_once __DIR__.'/../../controller/ReportController.php';

$rep_con = new ReportController();
        $year = $_POST['year'];
        //  die(var_dump($year));
        $result = $rep_con->getStockYearlyReport($year);
        $result1 = $rep_con->getOrderYearlyReport($year);
        $status = $rep_con->yearlyTotalPrice($year);
        $orders = $rep_con->yearlyTotalOrderPrice($year);
        $sales = $rep_con->monthlySale($year);
        // die(var_dump($result));
        // $users = $rep_con->getUser();
        // die(var_dump($users));
        $html = "";
        $html .= "<div class='container mt-3'><div class='col-md-12'><div class= 'card text-center'><div class='card-header'><h2>နှစ်အလိုက် ဝင်ငွေ/ထွက်ငွေ စာရင်း</h2>";
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
        $html.= "<table class = 'table table-warning table-striped'><tr><th>ပစ္စည်း</th><th>ထွက်ငွေ</th><th>ဝင်ငွေ</th></tr>";
        $html .= "";  
        $count = 1;    
        foreach($status as $total)
        { 
        $html .= "<tr><td>".$total['name']."</td>";
        $html .= "<td>".$total['totalPrice']."</td>";  
        $rep = 0 ;
        foreach ($orders as $order)
        {
                if($order['id'] == $total['id'] )
                {
                        if(isset($order['sellingPrice']))
                        $html .= "<td>". $rep = $order['sellingPrice'] ."</td>";
                        else
                        $html .= "<td>". $rep ."</td>";
                }
                // else
                // {
                //         $html .= "<td>".$rep."</td>";     
                // }   
                
                
        }     
        
        $html .= "</tr>";         
        }
        $html .= "</table>";
        $html .= "</div>";
        $html .= "<div class='col-md-6'>";
        $html.= "<table class = 'table table-danger table-striped'><tr><th>စဉ်</th><th>လအမည်</th><th>ဝင်ငွေ</th></tr>";
        $html .= "";  
        $count = 1;    
        foreach($sales as $sale)
        { 
        $html .= "<tr>";
        $html .= "<td>".$count++."</td>";
        $html .= "<td>".date("F", mktime(0, 0, 0, $sale['month'], 1))."</td>";
        $html .= "<td>".$sale['total']."</td>";
        $html .= "</tr>";         
        }
        $html .= "</table>";
        $html .= "</div>";
        $html .= "</div></div></div></div>";
        echo $html; 
    

?>