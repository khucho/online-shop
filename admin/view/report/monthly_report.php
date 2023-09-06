<?php
   
    include_once __DIR__.'/../../layouts/admin_navbar.php';

?>

<main>
    <div class="container mt-4">
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
                                                <div class="col-3 form-group">
                                                    <label for="selectedValue">Month:</label>
                                                    <select id="month" name="month">
                                                        <?php
                                                        $months = array("January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December");
                                                        for ($month = 1; $month <= 12; $month++) {
                                                            if(isset($_POST['month']) && $_POST['month'] == $result['month'])
                                                            {
                                                                echo "<option value='$month' selected>".$months[$month - 1]."</option>";
                                                            }
                                                            else
                                                            {
                                                                echo "<option value='$month' >".$months[$month - 1]."</option>";
                                                            }
                                                            
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                            
                                                <div class="col-3 form-group">
                                                    <button type="submit" name = "submit" class="report" style="background-color:darkslategrey; color:floralwhite;">Generate Report</button>
                                                </div>        
                                    </div>  
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                        <div class="col-md-12">
                            <div id="reportData" style="margin-left:30px;"></div>
                        </div>
            </div>
        </div>
        
       
    </div>
    
    
</main>

<?php

include_once __DIR__.'/../../layouts/admin_footer.php';

?>