<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

include_once __DIR__.'/../model/Authentication.php';
include_once __DIR__.'/../vendor/PhpMailer/src/Exception.php';
include_once __DIR__.'/../vendor/PhpMailer/src/PHPMailer.php';
include_once __DIR__.'/../vendor/PhpMailer/src/SMTP.php';

class AuthController extends Authentication 
{
    public function authentication()
    {
        session_start();

        if (!isset($_SESSION['id']))
        {
            header('location:../logIn.php');
        }
        else 
        {
            if ($_SESSION['role'] == 'user')
            {
                header('location:../logIn.php');
            }
        }
    }

    public function adminList () 
    {
        return $this->getAdminList();
    }

    public function addAdmin($data)
    {
        return $this->createAdmin($data);
    }

    public function editPassword($email,$data)
    {
        return $this->updatePassword($email,$data);
    }

    public function adminByEmail($email)
    {
        return $this->getAdminByEmail($email);
    }

    public function sendMail($email)
    {
        $otp = rand(1000,9999);
   
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
        $mailer->addAddress($email);

        $mailer->IsHTML(true);
        $mailer->Subject = "Your account registration is in progress.";
        $mailer->Body = 'Your OTP code is ::  '.$otp.'';

        if ($mailer->send())
        {
            return $otp;
        }


    }

    public function adminById($id)
    {
        return $this->getAdminById($id);
    }
}

?>