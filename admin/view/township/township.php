

<?php

include_once __DIR__.'/../../layouts/admin_navbar.php';
include_once  __DIR__.'/../../controller/TownshipController.php';

$town_con = new TownshipController();
$townships = $town_con->townshipList();

?>

<main>
    <div class="content">
        <div class="container-fluid">
            <h2><strong>Township Dashboard</strong></h2>

            <?php
                if(isset($_GET['addStatus']) && $_GET['addStatus']==true)
                {
                    echo "<span class='text-success'>New Township has been successfully created.</span>";
                }

            ?>

            <?php
                if(isset($_GET['updateStatus']) && $_GET['updateStatus']==true)
                {
                    echo "<span class='text-success'>Township has been successfully updated.</span>";
                }

            ?>


            <div class="row mt-3">
                <div class="col-md-3">
                    <a href="addTownship.php" class="btn btn-primary">Add New Township</a>
                </div>
            </div>
            
            <div class="row mt-3">
                <div class="col-md-12">
                <table class= "table table-striped" id="mytable" >
                    <thead>
                    <th>No</th>
                    <th>Township Name</th>
                    <th>City Name</th>
                    <th>Action</th>
                </thead>
                <tbody>
                    <?php
                    $count = 1;
                    foreach($townships as $township)
                    {
                        echo "<tr>";
                        echo "<td>".$count++."</td>";

                        echo "<td>".$township['township_name']."</td>";
                       
                        echo "<td>".$township['city_name']."</td>";
                        
                        echo "<td id='".$township['township_id']."'>
                                <a class= 'btn btn-warning mx-3' href='editTownship.php?id=".$township['township_id']."'>Edit</a>
                                <button class = 'btn btn-danger mx-3 township_delete'>Delete</button>
                            </td>";
                        echo "</tr>";
                    }
                    ?>
                </tbody>
            </table>
                </div>
            </div>

        </div>
    </div>

</main>

<?php
include_once __DIR__.'/../../layouts/admin_footer.php';
?>