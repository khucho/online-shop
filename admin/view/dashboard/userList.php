<?php

include_once __DIR__ . '/../../layouts/admin_navbar.php';
include_once __DIR__ . '/../../controller/UserController.php';




$user_controller = new UserController();
$users = $user_controller->getUser();


?>

<main class="content">
    <div class="container-fluid p-0">
        <h1 class="h3 mb-3"><strong>User List</strong></h1>


        <div class='row mt-3'>
            <div class='col-md-12'>
                <table class="table" id="catTable">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Action</th>

                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $count = 1;
                        foreach ($users as $user) {
                            echo "<tr>";
                            echo "<td>" . $count++ . "</td>";
                            echo "<td>" . $user['name'] . "</td>";
                            echo "<td>" . $user['email'] . "</td>";
                            echo "<td id='" . $user['id'] . "'> 
                                                    <button class='btn btn-danger mx-3 user_delete'>Delete</button>
                                                </td> ";
                            echo "</tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</main>

<?php

include_once __DIR__ . '/../../layouts/admin_footer.php';

?>