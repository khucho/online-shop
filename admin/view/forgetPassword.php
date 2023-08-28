<?php
include_once __DIR__.'/../controller/AuthController.php';

$auth_controller = new AuthController();
$admins = $auth_controller->adminList();

if (isset($_POST['submit']))
{
    foreach ($admins as $admin)
    {
        if ($admin['email'] == $_POST['email'])
        {
            $registerError = false;

            $otpCode = $auth_controller->sendMail($_POST['email']);

            if (!empty($otpCode))
            {
                session_start();
                $_SESSION['otp'] = $otpCode;
                $_SESSION['email'] = $_POST['email'];

                header('location:pwResetOtp.php');
            }
        }
        else 
        {
            $registerError = true;
        }
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login Page</title>
    <link rel="stylesheet" href="../public/css/myApp.css">

    <!-- bootstrap css cdn link  -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">


</head>
<body class="bg-primary">
    
    <div class="wrapper">
        <header>Password Reset</header>
        <form action="" method="post" class="my-4">
            <div class="field mb-3">
                <div class="input-area">
                    <label class="form-label mb-2">Email Address</label>
                    <input type="email" name="email" placeholder="Email Address" class="form-control">
                    <?php if (isset($registerError) && $registerError) echo '<span class="text-danger">This email is not registered</span>';?>
                </div>
            </div>

            <div class="d-flex justify-content-center mt-4">
                <input type="submit" name="submit" value="Continue" class="btn btn-primary w-50">
            </div>

            <div class="signup-link d-flex justify-content-center mt-4">
                Already a member?<a href="logIn.php" class="text-decoration-none ms-2">LogIn Now</a>
            </div>

        </form>
    </div>

  <!-- bootstrap js cdn link  -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>

<script src="../public/js/myscript.js"></script>
</body>
</html>