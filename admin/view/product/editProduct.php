

<?php


include_once __DIR__.'/../../layouts/admin_navbar.php';
include_once __DIR__.'/../../controller/CategoryController.php';
include_once  __DIR__.'/../../controller/ProductController.php';
include_once  __DIR__.'/../../controller/GroupController.php';


$id = $_GET['id'];


$pro_con = new ProductController();
$product = $pro_con->getEditProduct($id);
// die(var_dump($products));

$cat_con = new CategoryController();
$categories = $cat_con->getCategories();

$gp_con = new GroupController();
$groups = $gp_con->getGroup();

if(isset($_POST['submit']))
{

    if (empty($_POST['name']))
        $nameError = 'Please enter product name';

    if (empty($_POST['price']))
        $priceError = 'Please enter product price';

    if (empty($_POST['date']))
        $dateError = "Please choose product's manufactured date";


    if(!empty($_FILES['image']['name']))
    {
        $fileName = $_FILES['image']['name'];
        $extension = explode('.',$fileName);
        $fileType = end($extension);
        $allowedTypes = ['jpg','jpeg','png','svg'];
        $fileSize = $_FILES['image']['size'];
    
        if (in_array($fileType,$allowedTypes))
        {
            if ($fileSize > 5000000)
            {
                $imageError = 'File size must be less than 5 MB';
            }
            else
            {
                $image = $_FILES['image'];
            }
        }
        else 
        {
            $imageError = 'Only Allow File Types such as JPG,JPEG,PNG,SVG';
        }
    }

    if (isset($nameError) || isset($descriptionError) || isset($priceError) || isset($dateError) || isset($imageError))
    {
        $errorCondition = true ;
    }
    else 
    {
        $info = [
            'name' => $_POST['name'],
            'description' => $_POST['description'],
            'price' => $_POST['price'],
            'date' => $_POST['date'],
            'category' => $_POST['category'],
            'group' => $_POST['group'],
        ];
        

        if (isset($image))
        {
            $info['image'] = $image;
        }


        $updateStatus = $pro_con->editProduct($id,$info);
        // die(var_dump($updateStatus));

        if($updateStatus)
        {
            echo "<script>location.href = 'product.php?updateStatus=".$updateStatus."'</script>";
        }
    }

    
}
?>

<main>
    <div class="content">
        <div class="container-fluid">
            <h2><strong>Add New Product</strong></h2>
            <form action="" method="post" enctype = "multipart/form-data">
                <div class = "my-3">
                    <label for="" class="form-label">Product Name</label>
                    <input type="text" name= "name" class="form-control"  value="<?php if (isset($_POST['name'])) echo $_POST['name']; else echo $product['name'];?>">
                    <?php if (isset($nameError) && $errorCondition) echo '<span class="text-danger">'.$nameError.'</span>';?>
                </div>

                <div class = "my-3">
                    <label for="" class="form-label">Description</label>
                    <input type="textarea" name= "description" class="form-control"  value="<?php if (isset($_POST['description'])) echo $_POST['description']; else echo $product['description'];?>">
                    <?php if (isset($descriptionError) && $errorCondition) echo '<span class="text-danger">'.$descriptionError.'</span>';?>
                </div>

                <div class = "my-3">
                    <label for="" class="form-label">Price</label>
                    <input type="number" name= "price" class="form-control"  value="<?php if (isset($_POST['price'])) echo $_POST['price']; else echo $product['price'];?>">
                    <?php if (isset($priceError) && $errorCondition) echo '<span class="text-danger">'.$priceError.'</span>';?>
                </div>

                <div class = "my-3">
                    <label for="" class="form-label">Created Date</label>
                    <input type="date" name= "date" class="form-control"  value="<?php if (isset($_POST['date'])) echo $_POST['date']; else echo $product['created_date'];?>">
                    <?php if (isset($dateError) && $errorCondition) echo '<span class="text-danger">'.$dateError.'</span>';?>
                </div>

                <div class = "my-3">
                    <label for="" class="form-label">Category</label>
                    <select name="category" id="" class="form-select">
                        <option value="" disabled>Select Category</option>
                        <?php
                        foreach($categories as $category)
                        {
                            
                        ?>

                        <option value="<?php echo $category['id']?>" <?php if (isset($_POST['category'])) {if ($_POST['category'] == $category['id'])  echo 'selected';} else {if(($product['cat_id'] == $category['id'])) echo 'selected';}?>>
                            <?php echo $category['name'];?>
                        </option>

                        <?php
                        }
                        ?>
                    </select>
                </div>

                <div class = "my-3">
                    <label for="" class="form-label">K pop Group</label>
                    <select name="group" id="" class="form-select">
                        <?php
                        foreach($groups as $group)
                        {
                            
                        ?>

                        <option value="<?php echo $group['id'];?>" <?php if (isset($_POST['group'])) {if ($_POST['group'] == $group['id'])  echo 'selected';} else {if(($product['team_id'] == $group['id'])) echo 'selected';}?>>
                            <?php echo $group['name'];?>
                        </option>

                        <?php
                        }
                        ?>
                    </select>
                </div>

                <div class = "my-3">
                    <label for="" class="form-label">Featured Image</label>
                    <div>
                        <img src="../../../uploads/<?php echo $product['image'];?>" width="70px" height="70px" alt="">
                    </div>
                    <input type="file" name= "image" class="form-control mt-3">
                    <?php if (isset($imageError) && $errorCondition) echo '<span class="text-danger">'.$imageError.'</span>';?>
                </div>

                <div class = "mt-3">
                    <button class = "btn btn-dark" name = "submit">Add</button>
                </div>
            </form>

        </div>
    </div>

</main>

<?php
include_once __DIR__.'/../../layouts/admin_footer.php';
?>