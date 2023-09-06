<?php
    include_once __DIR__.'/../../layouts/admin_navbar.php';
    include_once __DIR__.'/../../controller/AuthController.php';

    $auth = new AuthController();

    $userId = $_SESSION['id'];

    $userData = $auth_controller->adminById($userId);


    if (isset($_POST['submit']))
    {

        if (!password_verify($_POST['current_password'],$userData['password']))
            $current_pass_error = 'Incorrect password';

        if(empty($_POST['current_password']))
            $current_pass_error = 'Please enter your current password';
    
        if (strlen($_POST['new_password']) < 6)
            $new_pass_error = 'Password must be greater than six characters';
    
        if(empty($_POST['new_password']))
            $new_pass_error = 'Please enter your new password';
    
        if(empty($_POST['confirm_password']))
            $confirm_pass_error = 'Please confirm your new password';
    
        if ($_POST['new_password'] != $_POST['confirm_password'])
            $confirm_pass_error = 'Password must be same';
    
    
        if (isset($current_pass_error) || isset($new_pass_error) ||isset($confirm_pass_error))
        {
            $errorCondition = true;
        }
        else 
        {
            
            $data = [
                'password' => password_hash($_POST['new_password'],PASSWORD_DEFAULT),
                'confirm_password' => password_hash($_POST['confirm_password'],PASSWORD_DEFAULT),
            ];
    
            $update_status = $auth_controller->passChange($data,$userId);
        
        }
    }
?>


<main class="content">
    <div class="container">
        
        <?php
            if(isset($update_status) && $update_status)
            {
                echo '<div class="row justify-content-center align-items-center mb-5">
                        <span class="text-success">Changed Password successfully.</span>
                    </div>';    
            }
        ?>

        <div class="row mt-3">
            <div class="col-md-10 offset-1">
                <h1 class="h3"><strong>Change Password</strong></h1>

                <div class="mt-5">
                    <form action="" method="post">
                        <div class="row">
                            <div class="col-md-5">
                                <div class="">
                                    <h4><label for="" class="form-label">Current Password</label></h4>
                                    <input type="password" name="current_password" class="form-control" placeholder="Enter Your Current Password">
                                    <?php if (isset($current_pass_error) && $errorCondition)  echo '<span class="text-danger">'.$current_pass_error.'</span>'; ?>
                                </div>
                            </div>

                            <div class="col-md-5 offset-2">
                                <div class="mb-5">
                                    <h4><label for="" class="form-label">New Password</label></h4>
                                    <input type="password" name="new_password" class="form-control" placeholder="Enter Your New Password">
                                    <?php if (isset($new_pass_error) && $errorCondition)  echo '<span class="text-danger">'.$new_pass_error.'</span>'; ?>
                                </div>

                                <div class="">
                                    <h4><label for="" class="form-label">Confirm Password</label></h4>
                                    <input type="password" name="confirm_password" class="form-control" placeholder="Confirm new password">
                                    <?php if (isset($confirm_pass_error) && $errorCondition)  echo '<span class="text-danger">'.$confirm_pass_error.'</span>'; ?>
                                </div>

                            </div>
                        </div>
                        <div class=" mt-5">
                            <button class="btn btn-lg btn-dark" type="submit" name="submit">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</main>


<?php
    include_once __DIR__.'/../../layouts/admin_footer.php';
?>