<?php

include_once __DIR__.'/controller/AuthController.php';


$auth_controller = new AuthController();
$userLists = $auth_controller->userLists();


if (isset($_POST['submit']))
{
    foreach ($userLists as $userList)
    {
        if ($_POST['email'] == $userList['email'] && password_verify($_POST['password'],$userList['password']))
        {
          session_start();
          $_SESSION['id'] = $userList['id'];
          $_SESSION['role'] = 'user';

          header('location:index.php');
        }
        else
        {
            $passwordError = 'Invalid email or password';
        }
    }
        
    if (empty($_POST['email']))
        $emailError = 'Please Enter Your Email Address';

    if (empty($_POST['password']))
        $passwordError = 'Please Enter Your Password';

        

    if (isset($emailError) || isset($passwordError) || isset($invalid))
    {
        $errorCondition = true;
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
            <div class="form">
              <form action="#" method="post">
                <h2>Login</h2>

                <div class="input_box">
                  <input type="email" name="email" placeholder="Enter your email" value="<?php if (isset($_POST['email'])) echo $_POST['email'];?>"/>
                  <i class="uil uil-envelope-alt email"></i>
                  <?php if (isset($emailError) && $errorCondition)  echo '<span class="errorMsg">'.$emailError.'</span>'; ?>
                </div>
                
                <div class="input_box">
                  <input type="password" name="password" placeholder="Enter your password" />
                  <i class="uil uil-lock password"></i>
                  <i class="uil uil-eye-slash pw_hide"></i>
                  <?php if (isset($passwordError) && $errorCondition )  echo '<span class="errorMsg">'.$passwordError.'</span>'; ?>
                </div>

                <div class="option_field">
                  <a href="#" class="forgot_pw">Forgot password?</a>
                </div>

                <button class="button" type="submit" name="submit">Login</button>

                <div class="login_signup">Don't have an account? <a href="signUp.php" id="signup">Signup</a></div>
              </form>
            </div>
        </div>
    </section>

  <script src="public/js/custom.js"></script>
</body>
</html>