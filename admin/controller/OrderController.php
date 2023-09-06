<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

include_once __DIR__.'/../model/Order.php';
include_once __DIR__.'/../vendor/PhpMailer/src/Exception.php';
include_once __DIR__.'/../vendor/PhpMailer/src/PHPMailer.php';
include_once __DIR__.'/../vendor/PhpMailer/src/SMTP.php';

class OrderController extends Order
{
    public function getOrders()
    {
        return $this->getOrderList();
    }

    public function getOrder($code)
    {
        return $this->getOrderInfo($code);
    }

    public function getUser($code)
    {
        return $this->getUserInfo($code);
    }

    public function orderPerMonth()
    {
        return $this->getOrderPerMonth();
    }

    public function orderAccept($orderCode)
    {
        // 
        // $orderStatus = true;

         
            
            // getting user email , township name ,delivery fee and order_date
            $mailInfo = $this->mailInfoByOrderCode($orderCode);
            // die(var_dump($mailInfo));
            // getting products for order
            $productInfo = $this->productsByOrderCode($orderCode);

            $mailer = new PHPMailer(true);

            // Server settings

            // $mailer->SMTPDebug = SMTP::DEBUG_SERVER; // for detailed debug
            $mailer->isSMTP();
            $mailer->Host = 'smtp.gmail.com';
            $mailer->SMTPAuth = true;
            $mailer->SMTPSecure = 'tls';
            $mailer->Port = 587;

            $mailer->Username = "thansoeaung1213@gmail.com";
            $mailer->Password = "muvckxmywumszeda";

            $mailer->setFrom("thansoeaung1213@gmail.com","KPOP Merch Mandalay");
            $mailer->addAddress($mailInfo['email']);

            $mailer->IsHTML(true);
            $mailer->Subject = "Your Order is accepted";
            $mailer->Body = 'Dear Customer  '.$mailInfo['user_name'].'<br><br><br>'.
                            'Your Order is already accepted.'.'<br>'.
                            'Your township for delivery is '.$mailInfo['township_name'].'.'.'<br>'.
                            'Delivery Fee is '.$mailInfo['delivery_fee'].'.'.'<br><br>';
             

            $totalPrice = 0;

                foreach($productInfo as $product)
                 {
                    
                    $totalPrice += $product['total_price'];

                    $mailer->Body .= 'Produc Name : '.$product['product_name'].'<br>'.
                                      'Quantity : '.$product['quantity'].'<br>'. 
                                      'Total Price for '.$product['product_name'].' is '.$product['total_price'].'<br><br>';
                
                 }


            $totalPrice += $mailInfo['delivery_fee'];

            $mailer->Body .= 'Total Price for your order is '.$totalPrice.'<br><br><br>'. 
                                'We will deliver your products as soon as possible within the short period of time.'.'<br><br>'.
                                'Thanks for shopping with us.';

            if ($mailer->send())
            {
                $orderStatus = $this->orderStatusAccept($orderCode);
                return true;
            }

        
    }

    public function orderDecline($orderCode)
    {
        $orderStatus = $this->orderStatusDecline($orderCode);

         if ($orderStatus)
         {
            
            // getting user email , township name ,delivery fee and order_date
            $mailInfo = $this->mailInfoByOrderCode($orderCode);

            // getting products for order
            $productInfo = $this->productsByOrderCode($orderCode);

            $mailer = new PHPMailer(true);

            // Server settings

            // $mailer->SMTPDebug = SMTP::DEBUG_SERVER; // for detailed debug
            $mailer->isSMTP();
            $mailer->Host = 'smtp.gmail.com';
            $mailer->SMTPAuth = true;
            $mailer->SMTPSecure = 'tls';
            $mailer->Port = 587;

            $mailer->Username = "thansoeaung1213@gmail.com";
            $mailer->Password = "muvckxmywumszeda";
            $mailer->setFrom("thansoeaung1213@gmail.com","KPOP Merch Mandalay");
            $mailer->addAddress($mailInfo['email']);

            $mailer->IsHTML(true);
            $mailer->Subject = "Your Order is declined";
            $mailer->Body = 'Dear Customer  '.$mailInfo['user_name'].'<br><br><br>'.
                            'We are sorry to inform you that your order is declined.'.'<br>'.
                            'Here is your order : '.'<br><br>';
             

            $totalPrice = 0;

                foreach($productInfo as $product)
                 {
                    
                    $totalPrice += $product['total_price'];

                    $mailer->Body .= 'Produc Name : '.$product['product_name'].'<br>'.
                                      'Quantity : '.$product['quantity'].'<br><br>';
                        
                
                 }

            $mailer->Body .= 'We hope to see your next orders in future.'.'<br><br>'.
                                'Thanks for shopping with us.';

            if ($mailer->send())
            {
                return true;
            }

         }
    }
}