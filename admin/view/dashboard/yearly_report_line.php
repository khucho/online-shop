<?php
   
    include_once __DIR__.'/../../layouts/admin_navbar.php';

?>

<main>
    <div class="container mt-4">
        <div>
            <h2>Reports</h2>
        </div>
        <div class="rows">
            
            <div class="row">
                <div class="col-md-6">
                    <div class="row">
                        <div class="card" style="margin-left:40px;">
                            <div class="card-header">Monthly Report</div>
                            <div class="card-body">
                                <form id="reportForm" method="post">
                                    <div class="row">
                                            <div class="col-3 form-group">
                                                    <label for="selectedValue">Year:</label>
                                                    <select name="year" id="year">
                                                        <?php
                                                        $current_year = date("Y");
                                                        for ($year = $current_year; $year >= $current_year - 10; $year--) {
                                                            echo "<option value='$year'>$year</option>";
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                            
                                                <div class="col-3 form-group mx-3">
                                                    <button type="submit" name = "submit" class="report_line" style="background-color:darkslategrey; color:floralwhite;">Generate Report</button>
                                                </div>        
                                    </div>  
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-8">
                        <div class="card style="margin-left:80px;">
                            <div class="card-header">

                                <h5 class="card-title mb-0">Monthly Sales</h5>
                            </div>
                            <div class="card-body d-flex">
                                <div class="align-self-center chart chart-lg">
                                    <canvas id="chartjs-dashboard-bar"></canvas>
                                </div>
                            </div>
                        </div>
                </div>
            </div>
        </div>
        
       
    </div>
    
    
</main>

<?php

include_once __DIR__.'/../../layouts/admin_footer.php';

?>