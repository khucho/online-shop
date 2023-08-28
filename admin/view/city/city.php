<?php
   
    include_once __DIR__.'/../../layouts/admin_navbar.php';
    include_once __DIR__.'/../../controller/CityController.php';




$city_controller = new CityController();

$cities = $city_controller->cityList();

?>

            <main class="content">
                <div class="container-fluid p-0">
                    <h1 class="h3 mb-3"><strong>City</strong></h1>
                    <?php
                        if(isset($_GET['status']) && $_GET['status']==true)
                        {
                            echo "<span class='text-success'>New City has been successfully added</span>";
                        }

                    ?>

                    <?php
                        if(isset($_GET['updateStatus']) && $_GET['updateStatus']==true)
                        {
                            echo "<span class='text-success'>City has been successfully updated</span>";
                        }

                    ?>
                    <div class='row mt-3'>
                        <div class='col-md-3'>
                            <a href="addCity.php" class='btn btn-primary'>Add New City</a>
                        </div>
                    </div>
                    <div class='row mt-3'>
                        <div class='col-md-12'>
                            <table class="table" id="catTable">
                                <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Name</th>
                                    <th>Action</th>

                                </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $count=1;
                                        foreach($cities as $city)
                                        {
                                            echo "<tr>";
                                            echo "<td>".$count++."</td>";
                                            echo "<td>".$city['name']."</td>";
                                            echo "<td id='".$city['id']."'> 
                                                    <a class='btn btn-warning mx-3' href='editCity.php?id=".$city['id']."'>Edit</a>
                                                    <button class='btn btn-danger mx-3 city_delete'>Delete</button>
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