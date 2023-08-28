<?php
include_once __DIR__.'/../controller/AuthController.php';
session_start();


if (isset($_POST['otp_submit']))
{
    if ($_POST['otp'] == $_SESSION['otp'])
    {  
       header('location:chgPassword.php');
    }
    else 
    {
        $otpError = 'Invalid OTP';
    }
}

?>

<?php
 
 if ($_SESSION['role'] == 'admin') 
 {
    header('location:dashboard/index.php');
 }
 else
 {
 ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>OTP Page</title>
    <link rel="stylesheet" href="../public/css/myApp.css">

    <!-- bootstrap css cdn link  -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">


</head>
<body class="bg-primary">
    
    <div class="wrapper">
        <header> OTP Validation </header>
        <form action="" method="post" class="my-4">

            <div class="field mb-3">
                <div class="input-area">
                    <label class="form-label">OTP</label>
                    <input type="number" placeholder="Enter OTP Code here" name="otp" value="<?php if (isset($_POST['otp'])) echo $_POST['otp'];?>" class="form-control">
                    <?php if (isset($otpError))  echo '<span class="text-danger">'.$otpError.'</span>'; ?>
                </div>
            </div>

            <div class="d-flex justify-content-center mt-4">
                <input type="submit" value="Continue" name="otp_submit" class="btn btn-success w-100">
            </div>

        </form>
    </div>

  <!-- bootstrap js cdn link  -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>

<script src="../public/js/myscript.js"></script>
</body>
</html>

<?php
 }
?>