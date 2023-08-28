<?php 
include_once __DIR__.'/../../controller/StockController.php';
// include_once __DIR__.'/../../controller/ProductController.php';
$rep_con = new StockController();
        $start_date = $_POST['start'];
        // die(var_dump($start_date));
        $end_date = $_POST['end'];
        $result = $rep_con->getStockDetail($start_date,$end_date);
        $orders = $rep_con->getOrderDetail($start_date,$end_date);
        $products = $rep_con->getStockProduct();
        // die(var_dump($result));
        $html = "";
        $html .= "<div class='container mt-3'><div class='col-md-12'><div class= 'card text-center'><div class='card-header'>";
        $html.= "<table class = 'table table-striped'><tr><th>Product Name</th><th>Total Stock In</th><th> Total Stock Out</th></tr>";
        $html.="</div><div class='card-body'>";      

        foreach($result as $report)
        {
        foreach($products as $product)
        {
            if($report['product_id'] == $product['id'])
            {
                $html .= "<tr><td>".$product['proname']."</td>"; 
            }
        }
        $html .= "<td>".$report['stock_in']."</td>";

        $stock = 0;
        foreach($orders as $order)
        {
            if($report['product_id'] == $order['product_id'])
            {
                if(isset($order))
                {
                    $html .= "<td>". $stock = $order['stock_out'] ."</td></tr>"; 
                }
                else{
                    $html .= "<td>0</td></tr>";
                }
                
            }
            // else{
            //     $html .= "<td>".$stock."</td>";
            // }
        }
       
        }
        $html .= "</table></div></div></div></div>";
        echo $html;
