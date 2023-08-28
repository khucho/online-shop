<?php
include_once __DIR__.'/../controller/AuthController.php';
session_start();

$auth_controller = new AuthController();

if (isset($_POST['update']))
{
    if (strlen($_POST['newPassword']) < 6)
        $passwordError = 'Password must be greater than six characters';

    if (empty($_POST['newPassword']))
        $passwordError = 'Please Enter Password';

    if ($_POST['newPassword'] != $_POST['confirmPassword'])
        $confirmPasswordError = 'Passwords must be same';

    if (empty($_POST['confirmPassword']))
        $confirmPasswordError = 'Please Enter Password';

    if (isset($passwordError) ||isset($confirmPasswordError))
    {
        $errorCondition = true;
    }
    else 
    {
        $data = [
            'password' => password_hash($_POST['newPassword'],PASSWORD_DEFAULT),
            'confirm_password' => password_hash($_POST['confirmPassword'],PASSWORD_DEFAULT),
        ];

        $email = $_SESSION['email'];

        $updateStatus = $auth_controller->editPassword($email,$data);

        if ($updateStatus)
        {
            header('location:logIn.php?status='.$updateStatus.'');
        }
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
        <header>Change Password</header>
        <form action="" method="post" class="my-4">

            <div class="field mb-3">
                <div class="input-area">
                    <label class="form-label">New Password</label>
                    <input type="password" placeholder="Enter new password" name="newPassword" class="form-control">
                    <?php if (isset($passwordError))  echo '<span class="text-danger">'.$passwordError.'</span>'; ?>
                </div>
            </div>

            <div class="field mb-3">
                <div class="input-area">
                    <label class="form-label">Confirm Password</label>
                    <input type="password" placeholder="Confirm password" name="confirmPassword" class="form-control">
                    <?php if (isset($confirmPasswordError))  echo '<span class="text-danger">'.$confirmPasswordError.'</span>'; ?>
                </div>
            </div>

            <div class="d-flex justify-content-center mt-4">
                <input type="submit" value="Update" name="update" class="btn btn-success w-100">
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