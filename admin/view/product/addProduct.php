<?php

include_once __DIR__ . '/../../layouts/admin_navbar.php';
include_once  __DIR__ . '/../../controller/CategoryController.php';

include_once  __DIR__ . '/../../controller/ProductController.php';

include_once  __DIR__ . '/../../controller/GroupController.php';

$pro_con = new ProductController();
$products = $pro_con->getProducts();

$cat_con = new CategoryController();
$categories = $cat_con->getCategories();
// die(var_dump($categories));

$gp_con = new GroupController();
$groups = $gp_con->getGroup();

if (isset($_POST['submit'])) {
    $image = $_FILES['image'];
    die(var_dump($image));
    if (empty($_POST['name']))
        $nameError = 'Please enter product name';

    if (empty($_POST['description']))
        $descriptionError = 'Please enter product description';

    if (empty($_POST['price']))
        $priceError = 'Please enter product price';

    if (empty($_POST['date']))
        $dateError = "Please choose product's manufactured date";

    if (empty($_POST['category']))
        $categoryError = "Please select category";

    if (empty($_POST['group']))
        $groupError = "Please select group";

    if (!empty($_FILES['image']['name'])) {
        $fileName = $_FILES['image']['name'];
        $extension = explode('.', $fileName);
        $fileType = end($extension);
        $allowedTypes = ['jpg', 'jpeg', 'png', 'svg'];
        $fileSize = $_FILES['image']['size'];

        if (in_array($fileType, $allowedTypes)) {
            if ($fileSize > 5000000) {
                $imageError = 'File size must be less than 5 MB';
            } else {
                $image = $_FILES['image'];
            }
        } else {
            $imageError = 'Only Allow File Types such as JPG,JPEG,PNG,SVG';
        }
    } else {
        $imageError = 'Please Select Course Image';
    }



    if (isset($nameError) || isset($descriptionError) || isset($priceError) || isset($dateError) || isset($imageError) || isset($categoryError) || isset($groupError)) {
        $errorCondition = true;
    } else {
        $name = $_POST['name'];
        $description = $_POST['description'];
        $price = $_POST['price'];
        $date = $_POST['date'];
        $category = $_POST['category'];
        $group = $_POST['group'];

        $addStatus = $pro_con->addProduct($name, $description, $price, $date, $image, $category, $group);

        if ($addStatus) {
            echo "<script>location.href = 'product.php?addStatus=" . $addStatus . "'</script>";
        }
    }
}
?>

<main>
    <div class="content">
        <div class="container-fluid">
            <h2><strong>Add New Product</strong></h2>

            <form action="" method="post" enctype="multipart/form-data">

                <div class="my-3">
                    <label for="" class="form-label">Product Name</label>
                    <input type="text" name="name" value="<?php if (isset($_POST['name']))  echo $_POST['name']; ?>" class="form-control">
                    <?php if (isset($nameError) && $errorCondition) echo '<span class="text-danger">' . $nameError . '</span>'; ?>
                </div>

                <div class="my-3">
                    <label for="" class="form-label">Description</label>
                    <input type="textarea" name="description" value="<?php if (isset($_POST['description']))  echo $_POST['description']; ?>" class="form-control">
                    <?php if (isset($descriptionError) && $errorCondition) echo '<span class="text-danger">' . $descriptionError . '</span>'; ?>
                </div>

                <div class="my-3">
                    <label for="" class="form-label">Price</label>
                    <input type="number" name="price" value="<?php if (isset($_POST['price']))  echo $_POST['price']; ?>" class="form-control">
                    <?php if (isset($priceError) && $errorCondition) echo '<span class="text-danger">' . $priceError . '</span>'; ?>
                </div>

                <div class="my-3">
                    <label for="" class="form-label">Manufactured Date</label>
                    <input type="date" name="date" value="<?php if (isset($_POST['date']))  echo $_POST['date']; ?>" class="form-control">
                    <?php if (isset($dateError) && $errorCondition) echo '<span class="text-danger">' . $dateError . '</span>'; ?>
                </div>

                <div class="my-3">
                    <label for="" class="form-label">Category</label>
                    <select name="category" id="" class="form-select">
                        <option value="" selected disabled>Select category</option>
                        <?php
                        foreach ($categories as $category) {
                        ?>
                            <option value="<?php echo $category['id']; ?>" <?php if ((isset($_POST['category']) && $_POST['category']) == $category['id']) echo 'selected'; ?>>
                                <?php echo $category['name']; ?>
                            </option>
                        <?php
                        }
                        ?>
                    </select>
                    <?php if (isset($categoryError) && $errorCondition) echo '<span class="text-danger">' . $categoryError . '</span>'; ?>
                </div>

                <div class="my-3">
                    <label for="" class="form-label">K pop Group</label>
                    <select name="group" id="" class="form-select">
                        <option value="" selected disabled>Select group</option>
                        <?php
                        foreach ($groups as $group) {
                        ?>

                            <option value="<?php echo $group['id']; ?>" <?php if ((isset($_POST['group']) && $_POST['group']) == $group['id']) echo 'selected'; ?>>
                                <?php echo $group['name']; ?>
                            </option>

                        <?php
                        }
                        ?>
                    </select>
                    <?php if (isset($groupError) && $errorCondition) echo '<span class="text-danger">' . $groupError . '</span>'; ?>
                </div>

                <div class="my-3">
                    <label for="" class="form-label">Featured Image</label>
                    <input type="file" name="image" class="form-control">
                    <?php if (isset($imageError) && $errorCondition) echo '<span class="text-danger">' . $imageError . '</span>'; ?>
                </div>

                <div class="mt-3">
                    <button class="btn btn-dark" type="submit" name="submit">Add</button>
                </div>
            </form>

        </div>
    </div>

</main>

<?php
include_once __DIR__ . '/../../layouts/admin_footer.php';
?>