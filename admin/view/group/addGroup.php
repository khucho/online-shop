<?php
include_once __DIR__ . '/../../layouts/admin_navbar.php';
include_once __DIR__ . '/../../controller/GroupController.php';

$groupCont = new GroupController();
// ini_set('disable_functions', 'var_dump');

if (isset($_POST['submit'])) {
    if (empty($_POST['name']))
        {$nameError = 'Please enter group name';}
        
    if(empty($_FILES['image'])){
        $imageError = 'Please Select Course Image';
    }

    if (isset($nameError) || isset($imageError) || isset($descriptionError)) {
        $errorCondition = true;
    } 
    else {
        $name = $_POST['name'];
        $image = $_FILES['image'];
        // die(var_dump($image));

        $addStatus = $groupCont->addGroup($name, $image);
        // die(var_dump($addStatus));
        if ($addStatus == true) {
            echo '<script>location.href="group.php?addStatus=' . $addStatus . '" </script>';
        }
    }
}


?>
<main class="content">
    <div class="container-fluid p-0">

        <h1 class="h3 mb-3"><strong>Add New Group</strong> Dashboard</h1>

        <div class="row">
            <div class="col-md-12">
                <form action="" method="post" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label for="" class="form-label">Name</label>
                        <input type="text" name="name" value="<?php if (isset($_POST['name']))  echo $_POST['name']; ?>" class="form-control">
                        <?php if (isset($nameError) && $errorCondition) echo '<span class="text-danger">' . $nameError . '</span>'; ?>
                    </div>

                    <div class="mb-3">
                        <label for="" class="form-label">Group Featured Image</label>
                        <input type="file" name="image" class="form-control">
                        <?php if (isset($imageError) && $errorCondition) echo '<span class="text-danger">' . $imageError . '</span>'; ?>
                    </div>

                    <div class="mb-3">
                        <button class="btn btn-dark" name="submit">ADD</button>
                    </div>

                </form>

            </div>
        </div>





    </div>
</main>

<?php
include_once __DIR__ . '/../../layouts/admin_footer.php';
?>