<?php
    include_once __DIR__.'/../../controller/AuthController.php';

    $auth = new AuthController();
    $auth->authentication();
?>

<?php
    include_once __DIR__.'/../../layouts/admin_navbar.php';
	
?>

<main class="content">
    <div class="container">
        <div class="row mt-3">
            <div class="col-md-10 offset-1">
                <h1 class="h3"><strong>Change Password</strong></h1>

                <div class="mt-5">
                    <form action="">
                        <div class="row">
                            <div class="col-md-5">
                                <div class="">
                                    <h4><label for="" class="form-label">Current Password</label></h4>
                                    <input type="password" name="currentPassword" class="form-control" placeholder="Enter Your Current Password">
                                </div>
                            </div>

                            <div class="col-md-5 offset-2">
                                <div class="mb-5">
                                    <h4><label for="" class="form-label">New Password</label></h4>
                                    <input type="password" name="newPassword" class="form-control" placeholder="Enter Your New Password">
                                </div>

                                <div class="">
                                    <h4><label for="" class="form-label">Confirm Password</label></h4>
                                    <input type="password" name="confirmPassword" class="form-control" placeholder="Confirm Password">
                                </div>

                            </div>
                        </div>

                        <div class=" mt-5">
                            <button class="btn btn-lg btn-dark">Update</button>
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