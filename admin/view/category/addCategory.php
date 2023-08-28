<?php

include_once __DIR__ . '/../../layouts/admin_navbar.php';
include_once __DIR__ . '/../../controller/CategoryController.php';



if (isset($_POST['submit'])) {
    // die(var_dump($image));
    if (empty($_POST['name'])) {
        $nameError = 'Please Enter Category Name';
    } 
    if(empty($_FILES['image'])){
        $imageError = 'Please Select Course Image';
    }
    if (isset($nameError) || isset($imageError)) {
        $errorCondition = true;
    }
    else {
        $name = $_POST['name'];
        $image = $_FILES['image'];
        // die(var_dump($image));
        $cat_controller = new CategoryController();
        $status = $cat_controller->addCategory($name,$image);
        // die(var_dump($status));
        if ($status) {
            echo '<script>location.href="category.php?status=' . $status . '"</script>';
        }
    };
}

?>
<main class="content">
    <div class="container-fluid p-0">
        <h1 class="h3 mb-3"><strong>Add New Category</strong></h1>

        <div class='row'>
            <div class='col-md-12'>
                <form action='' method='POST' enctype="multipart/form-data">
                    <div>
                        <label class='form-label'>Category Name</label>
                        <input type='text' name='name' class='form-control'>
                        <?php if (isset($nameError) && $errorCondition) echo '<span class="text-danger">' . $nameError . '</span>' ?>
                    </div>
                    <div class="my-3">
                        <label for="" class="form-label">Featured Image</label>
                        <input type="file" name="image" class="form-control">
                        <?php if (isset($imageError) && $errorCondition) echo '<span class="text-danger">' . $imageError . '</span>'; ?>
                    </div>
                    <div class='mt-3'>
                        <button class='btn btn-dark' name='submit'>Add</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</main>

<?php

include_once __DIR__ . '/../../layouts/admin_footer.php';

?>