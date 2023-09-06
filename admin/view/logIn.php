<?php
session_start();

include_once __DIR__.'/../controller/AuthController.php';

$auth_controller = new AuthController();
$admins = $auth_controller->adminList();

    if (isset($_POST['submit']))
    {
        foreach ($admins as $admin)
        {
            if ($_POST['email'] == $admin['email'] && password_verify($_POST['password'],$admin['password']))
            {
                session_start();
                $_SESSION['id'] = $admin['id'];
                $_SESSION['role'] = 'admin';
                header('location:dashboard/index.php');
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

 <?php
 
 if (isset($_SESSION['role']) && $_SESSION['role'] == 'admin') 
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
    <title>Admin Login Page</title>
    <link rel="stylesheet" href="../public/css/myApp.css">

    <!-- bootstrap css cdn link  -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">


</head>
<body>
    
    <div class="wrapper">
        <header>Log In</header>

        <?php
        if (isset($_GET['status']))
        {
            echo '<div class="alert alert-success alert-dismissible fade show d-flex justify-content-center my-3" role="alert">
                    <strong>Password changed successfully</strong>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>';
        }
        ?>

        <form action="" method="post" class="my-4">
            <div class="field mb-3">
                <div class="input-area">
                    <label class="form-label">Email Address</label>
                    <input type="email" name="email" placeholder="Email Address" value="<?php if (isset($_POST['email'])) echo $_POST['email'];?>" class="form-control">
                    <?php if (isset($emailError) && $errorCondition)  echo '<span class="text-danger">'.$emailError.'</span>'; ?>
                </div>
            </div>

            <div class="field mb-4">
                <div class="input-area">
                    <label class="form-label">Password</label>
                    <input type="password" name="password" placeholder="Password" class="form-control">
                    <?php if (isset($passwordError) && $errorCondition )  echo '<span class="text-danger">'.$passwordError.'</span>'; ?>
                </div>
            </div>

            <div class="d-flex justify-content-center">
                <input type="submit" name="submit" value="LogIn" class="btn btn-danger w-100">
            </div>

            <div class="pass-txt d-flex justify-content-center mt-2">
                <a href="forgetPassword.php" class="text-decoration-none">Forgot Password?</a>
            </div>

            <hr>


            <div class="d-flex justify-content-center mt-3">
                <a href="register.php" class="btn btn-success w-75">Create new account</a>
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