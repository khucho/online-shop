<?php
include_once __DIR__ . '/../../layouts/admin_navbar.php';
include_once __DIR__ . '/../../controller/GroupController.php';

$groupCont = new GroupController();
$groups = $groupCont->getGroup();
?>
<main class="content">
    <div class="container-fluid p-0">

        <h1 class="h3"><strong>Group</strong> Dashboard</h1>
        <?php
        if (isset($_GET['addStatus']) && $_GET['addStatus']) {
            echo "<span class='text-success'> New group has successfully created.</span>";
        }

        if (isset($_GET['updateStatus']) && $_GET['updateStatus']) {
            echo "<span class='text-success'>Group has successfully updated.</span>";
        }
        ?>

        <?php
        if (isset($_GET['deleteStatus']) && $_GET['deleteStatus'] == true) {
            echo "<span class='text-success'>Group has been successfully deleted.</span>";
        }

        ?>

        <div class="row mt-3">
            <div class="col-md-3">
                <a href="addGroup.php" class="btn btn-primary">Add New Group</a>
            </div>
        </div>

        <div class="row mt-3">
            <div class="col-md-12">
                <table class="table table-striped" id="mytable">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Name</th>
                            <th>Group Image</th>
                            <th>Actions</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php
                        $count = 1;
                        foreach ($groups as $group) {
                            echo "<tr>";
                            echo "<td>" . $count++ . "</td>";
                            echo "<td>" . $group['name'] . "</td>";
                            echo "<td><img src='../../../uploads/" . $group['image'] . "' width='80px' height='80px'></td>";
                            echo "<td id='" . $group['id'] . "'>
                                    <a class='btn btn-warning mx-3' href='editGroup.php?id=" . $group['id'] . "'>Edit</a>
                                    <a class='btn btn-danger mx-3 group_delete'>Delete</a>
                                </td>";
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