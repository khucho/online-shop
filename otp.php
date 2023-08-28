<?php
include_once __DIR__.'/controller/AuthController.php';

session_start();


if (isset($_POST['otp_submit']))
{
    if ($_POST['otp'] == $_SESSION['otp'])
    {
        $auth_controller = new AuthController();
        $status = $auth_controller->addUser($_SESSION['data']);


        if (!empty($status))
        {
            session_destroy();

            $registeredId = $auth_controller->userByEmail($status);

            session_start();
            $_SESSION['id'] = $registeredId;
            $_SESSION['role'] = 'user';
            header("location:index.php?");
        }
       
    }
    else 
    {
        $otpError = 'Invalid OTP';
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Log In</title>
    <link rel="stylesheet" href="public/css/style1.css">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">

    <!-- Unicons -->
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.8/css/line.css">
</head>
<body>
     <!-- Login From -->
    <section class="home">
        <div class="form_container">
        <i class="uil uil-times form_close"></i>
            <div class="form signup_form">
              <form action="#" method="post">
                <h2>OTP Code</h2>

                <div class="input_box">
                  <input type="text" name="otp" value="<?php if (isset($_POST['otp'])) echo $_POST['otp'];?>" placeholder="Enter your otp code here"  />
                  <!-- <i class="uil uil-user user"></i> -->
                  <?php if (isset($otpError))  echo '<span class="errorMsg">'.$otpError.'</span>'; ?>
                </div>

                <button class="button" type="submit" name="otp_submit">Continue</button>

                <div class="login_signup">Have not received otp code? <a href="logIn.php" id="login">Resend</a></div>
              </form>
            </div>

        </div>
    </section>

  <script src="public/js/custom.js"></script>
</body>
</html>