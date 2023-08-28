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
                <h1 class="h3"><strong>Profile Dashboard</strong></h1>
                
                    <div class="mt-5">
                        <p>Name : :  Test</p>
                        <p>Email Address : :  admin@gmail.com</p> 
                        <p>Gender : :  Male</p>
                        <p>Role : :  Admin</p>
                    </div>

                    <div class="mt-4">
                        <button class="btn btn-dark">Edit Profile</button>
                    </div>
                
            </div>
        </div>
    </div>
</main>

<?php
    include_once __DIR__.'/../../layouts/admin_footer.php';
?>