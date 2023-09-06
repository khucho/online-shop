<?php 

include_once __DIR__.'/layouts/user_navbar.php';
include_once __DIR__.'/controller/AuthController.php';

$auth_controller = new AuthController();

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

        $userId = $_SESSION['id'];

        $update_status = $auth_controller->editPassword($data,$userId);

    }
}

?>

<div class="container my-3">
    
    <?php
        if(isset($update_status) && $update_status)
        {
            echo '<div class="row justify-content-center align-items-center mb-5">
                    <span class="text-success">Changed Password successfully.</span>
                </div>';    
        }
    ?>

    <form action="" method="post">
        <div class="row d-flex mb-3">
            <div class="col-md-4 offset-1">
                <label for="" class="form-label">Current Password</label>
                <input type="password" class="form-control" name="current_password" placeholder="Enter your current password here...">
                <?php if (isset($current_pass_error) && $errorCondition)  echo '<span class="text-danger">'.$current_pass_error.'</span>'; ?>
            </div>
            <div class="col-md-4 offset-2">

                <div class="mb-3">
                    <label for="" class="form-label">New Password</label>
                    <input type="password" class="form-control" name="new_password" placeholder="Enter your new password here...">
                    <?php if (isset($new_pass_error) && $errorCondition)  echo '<span class="text-danger">'.$new_pass_error.'</span>'; ?>
                </div>

                <div class="mb-3">
                    <label for="" class="form-label">Confirm New Password</label>
                    <input type="password" class="form-control" name="confirm_password" placeholder="Confirm new password here...">
                    <?php if (isset($confirm_pass_error) && $errorCondition)  echo '<span class="text-danger">'.$confirm_pass_error.'</span>'; ?>
                </div>
            </div>  
        </div>
        <div class="row mb-3">
            <div class="col-md-2 offset-1">
                <button type="submit" name="submit" class="btn btn-primary">Save</button>
            </div>
        </div>
    </form>
</div>

<?php 

include_once __DIR__.'/layouts/user_footer.php';

?>