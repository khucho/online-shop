<?php

include_once __DIR__ . '/../../layouts/admin_navbar.php';
include_once __DIR__ . '/../../controller/CategoryController.php';

$id = $_GET['id'];

$cat_con = new CategoryController();
$category = $cat_con->getCategory($id);


if (isset($_POST['submit'])) {
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
        $updateStatus = $cat_con->editCategory($id, $name,$image);

        if ($updateStatus) {
            echo "<script>location.href='category.php?updateStatus=" . $updateStatus . "'</script>";
        }
    }
}


?>
<main class="content">
    <div class="container-fluid p-0">
        <h1 class="h3 mb-3"><strong>Category</strong></h1>

        <div class='row'>
            <div class='col-md-3'>
                <form action="" method="POST" enctype="multipart/form-data">
                    <div>
                        <label for="" class="form-label">Category Name</label>
                        <input type="text" name="name" id="" value="<?php echo $category['name'] ?>" class="form-control">
                        <?php if (isset($nameError) && $errorCondition) echo '<span class="text-danger">' . $nameError . '</span>' ?>
                    </div>
                    <div class = "my-3">
                        <label for="" class="form-label">Featured Image</label>
                        <div>
                            <img src="../../../uploads/<?php echo $category['image'];?>" width="70px" height="70px" alt="">
                        </div>
                        <input type="file" name= "image" class="form-control mt-3">
                        <?php if (isset($imageError) && $errorCondition) echo '<span class="text-danger">'.$imageError.'</span>';?>
                    </div>
                    <div class="mt-3">
                        <button class="btn btn-dark" name="submit">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</main>
<?php

include_once __DIR__ . '/../../layouts/admin_footer.php';
