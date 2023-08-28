<?php
include_once __DIR__ . '/../../layouts/admin_navbar.php';
include_once __DIR__ . '/../../controller/GroupController.php';

$id = $_GET['id'];

$groupCont = new GroupController();
$group = $groupCont->getGroupId($id);
if (isset($_POST['submit'])) {

    if (empty($_POST['name']))
        $nameError = 'Please enter group name';

    if (empty($_POST['description']))
        $descriptionError = 'Please fill about group';

        if(empty($_FILES['image'])){
            $imageError = 'Please Select Course Image';
        }

    if (isset($nameError) || isset($imageError)) {
        $errorCondition = true;
    } else {
        $name = $_POST['name'];
        $image = $_FILES['image'];

        $updateStatus = $groupCont->editGroup($id, $name,$image);
        //die(var_dump($updateStatus));
        if ($updateStatus == true) {
            echo '<script>location.href="group.php?updateStatus=' . $updateStatus . '" </script>';
        }
    }
}


?>
<main class="content">
    <div class="container-fluid p-0">

        <h1 class="h3 mb-3"><strong>Update Group</strong> Dashboard</h1>

        <div class="row">
            <div class="col-md-12">
                <form action="" method="post" enctype="multipart/form-data">

                    <div class="mb-3">
                        <label for="" class="form-label">Name</label>
                        <input type="text" name="name" class="form-control" value="<?php if (isset($_POST['name'])) echo $_POST['name'];
                                                                                    else echo $group['name']; ?>">
                        <?php if (isset($nameError) && $errorCondition) echo '<span class="text-danger">' . $nameError . '</span>'; ?>
                    </div>

                    <div><img src="../../../uploads/<?php echo $group['image']; ?>" alt="" height="80px" width="80px"></div>
                    <div class="mb-3">
                        <label for="" class="form-label">Group Featured Image</label>
                        <input type="file" name="image" class="form-control">
                        <?php if (isset($imageError) && $errorCondition) echo '<span class="text-danger">' . $imageError . '</span>'; ?>
                    </div>

                    <div class="mb-3">
                        <button class="btn btn-dark" name="submit">UPDATE</button>
                    </div>

                </form>

            </div>
        </div>





    </div>
</main>

<?php
include_once __DIR__ . '/../../layouts/admin_footer.php';
?>