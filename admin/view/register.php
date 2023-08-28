<?php
session_start();

include_once __DIR__.'/../controller/AuthController.php';


$auth_controller = new AuthController();
$admins = $auth_controller->adminList();

if (isset($_POST['submit']))
{
    if (empty($_POST['name']))
        $nameError = 'Please Enter Your Name';

    foreach($admins as $admin)
    {
        if($_POST['email'] == $admin['email'])
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

    if (empty($_POST['confirm_password']))
        $confirmPasswordError = 'Please Enter Password';

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
    <title>Admin Register Page</title>
    <link rel="stylesheet" href="../public/css/myApp.css">

    <!-- bootstrap css cdn link  -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">


</head>
<body class="bg-primary">
    
    <div class="wrapper">
        <header>Registeration Form</header>
        <form action="" method="post" class="my-4">

            <div class="field mb-3">
                <div class="input-area">
                    <label class="form-label">Name</label>
                    <input type="text" placeholder="User Name" name="name" value="<?php if (isset($_POST['name'])) echo $_POST['name'];?>" class="form-control">
                    <?php if (isset($nameError) && $errorCondition)  echo '<span class="text-danger">'.$nameError.'</span>'; ?>
                </div>
            </div>

            <div class="field mb-3">
                <div class="input-area">
                    <label class="form-label">Email Address</label>
                    <input type="email" placeholder="Email Address" name="email" value="<?php if (isset($_POST['email'])) echo $_POST['email'];?>" class="form-control">
                    <?php if (isset($emailError) && $errorCondition)  echo '<span class="text-danger">'.$emailError.'</span>'; ?>
                </div>
            </div>

            <div class="field mb-3">
                <div class="input-area">
                    <label class="form-label">Password</label>
                    <input type="password" placeholder="Password" name="password" class="form-control">
                    <?php if (isset($passwordError) && $errorCondition)  echo '<span class="text-danger">'.$passwordError.'</span>'; ?>
                </div>
            </div>

            <div class="field mb-3">
                <div class="input-area">
                    <label class="form-label">Confirm Password</label>
                    <input type="password" placeholder="Confirm Password" name="confirm_password" class="form-control">
                    <?php if (isset($confirmPasswordError) && $errorCondition)  echo '<span class="text-danger">'.$confirmPasswordError.'</span>'; ?>
                </div>
            </div>

            <div class="d-flex justify-content-center mt-4">
                <input type="submit" value="Sign Up" name="submit" class="btn btn-success w-100">
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

 <?php
 }
 ?>