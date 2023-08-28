<?php

include_once __DIR__.'/controller/AuthController.php';

$auth_controller = new AuthController();
$userLists = $auth_controller->userLists();

if (isset($_POST['submit']))
{
    if (empty($_POST['name']))
        $nameError = 'Please Enter Your Name';

    

    foreach($userLists as $userList)
    {
        if($_POST['email'] == $userList['email'])
        {
            $emailError = 'This email is already registered';
        }
    }

    if (empty($_POST['email']))
    $emailError = 'Please Enter Your Email';

    if (strlen($_POST['password']) < 6)
        $passwordError = 'Password must be greater than six characters';

    if (empty($_POST['password']))
        $passwordError = 'Please Enter Password';

    if ($_POST['password'] != $_POST['confirm_password'])
        $confirmPasswordError = 'Passwords must be same';


    if (isset($nameError) || isset($emailError) ||isset($passwordError) ||isset($confirmPasswordError))
    {
        $errorCondition = true;
    }
    else 
    {
        $data = [
            'name' => $_POST['name'],
            'email' => $_POST['email'],
            'password' => password_hash($_POST['password'],PASSWORD_DEFAULT),
            'confirm_password' => password_hash($_POST['confirm_password'],PASSWORD_DEFAULT),
        ];

        $otpCode = $auth_controller->sendMail($_POST['email']);

        if (!empty($otpCode))
        {
            session_start();
            $_SESSION['otp'] = $otpCode;
            $_SESSION['data'] = $data;
           

            header('location:otp.php');
        }

        // $status = $auth_controller->addAdmin($data);

        // if ($status)
        // {
        //     die(var_dump($status));
        // }


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
                <h2>Signup</h2>

                <div class="input_box">
                  <input type="text" name="name" value="<?php if (isset($_POST['name'])) echo $_POST['name'];?>" placeholder="Enter your name"  />
                  <i class="uil uil-user user"></i>
                  <?php if (isset($nameError) && $errorCondition)  echo '<span class="errorMsg">'.$nameError.'</span>'; ?>
                </div>

                <div class="input_box">
                  <input type="email" name="email" value="<?php if (isset($_POST['email'])) echo $_POST['email'];?>" placeholder="Enter your email"  />
                  <i class="uil uil-envelope-alt email"></i>
                  <?php if (isset($emailError) && $errorCondition)  echo '<span class="errorMsg">'.$emailError.'</span>'; ?>
                </div>
                <div class="input_box">
                  <input type="password" name="password" placeholder="Create password"  />
                  <i class="uil uil-lock password"></i>
                  <i class="uil uil-eye-slash pw_hide"></i>
                  <?php if (isset($passwordError) && $errorCondition)  echo '<span class="errorMsg">'.$passwordError.'</span>'; ?>
                </div>
                <div class="input_box">
                  <input type="password" name="confirm_password" placeholder="Confirm password"  />
                  <i class="uil uil-lock password"></i>
                  <i class="uil uil-eye-slash pw_hide"></i>
                  <?php if (isset($confirmPasswordError) && $errorCondition)  echo '<span class="errorMsg">'.$confirmPasswordError.'</span>'; ?>
                </div>

                <button class="button" type="submit" name="submit">Signup</button>

                <div class="login_signup">Already have an account? <a href="logIn.php" id="login">Login</a></div>
              </form>
            </div>

        </div>
    </section>

  <script src="public/js/custom.js"></script>
</body>
</html>