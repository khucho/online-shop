<?php
   
    include_once __DIR__.'/../../layouts/admin_navbar.php';
    include_once __DIR__.'/../../controller/CategoryController.php';




$cat_controller = new CategoryController();

$categories = $cat_controller->getCategories();


?>

            <main class="content">
                <div class="container-fluid p-0">
                    <h1 class="h3 mb-3"><strong>Category</strong></h1>
                    <?php
                        if(isset($_GET['status']) && $_GET['status']==true)
                        {
                            echo "<span class='text-success'>New Category has been successfully added</span>";
                        }

                    ?>

                    <?php
                        if(isset($_GET['updateStatus']) && $_GET['updateStatus']==true)
                        {
                            echo "<span class='text-success'>Category has been successfully updated</span>";
                        }

                    ?>
                    <div class='row mt-3'>
                        <div class='col-md-3'>
                            <a href="addCategory.php" class='btn btn-primary'>Add New Category</a>
                        </div>
                    </div>
                    <div class='row mt-3'>
                        <div class='col-md-12'>
                            <table class="table" id="catTable">
                                <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Name</th>
                                    <th>Image</th>
                                    <th>Action</th>

                                </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $count=1;
                                        foreach($categories as $category)
                                        {
                                            echo "<tr>";
                                            echo "<td>".$count++."</td>";
                                            echo "<td>".$category['name']."</td>";
                                            echo "<td><img src = '../../../uploads/" . $category['image'] . "' width = '100px' height = '100px' ></td>";
                                            echo "<td id='".$category['id']."'> 
                                                    <a class='btn btn-warning mx-3' href='editCategory.php?id=".$category['id']."'>Edit</a>
                                                    <button class='btn btn-danger mx-3 category_delete'>Delete</button>
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

include_once __DIR__.'/../../layouts/admin_footer.php';

?>