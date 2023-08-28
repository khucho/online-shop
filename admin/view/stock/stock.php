<?php
include_once __DIR__ . '/../../layouts/admin_navbar.php';
?>
<main>
    <div class="container mt-4">
        <div class="rows">
            <div class="row">
                <div class="col-md-12">
                    <form id="reportForm" method="post">
                        <div class="d-flex justify-content-evenly">
                            <div class="col-auto">
                                <input type="text" style="background-color:darkslategrey; color:floralwhite;" value="Stock" disabled>
                            </div>
                            <div class="col-auto">
                                <label for="" class="form-label">Start Date</label>
                                <input type="date" id="start_date" name="start_date" placeholder="Start date" class="form-control" value="<?php echo isset($_POST['start_date']) ? $_POST['start_date'] : ''; ?>">
                            </div>
                            <div class="col-auto">
                                <i class="align-middle" data-feather="repeat"></i>
                            </div>
                            <div class="col-auto">
                                <label for="" class="form-label">End Date</label>
                                <input type="date" id="end_date" name="end_date" placeholder="End date" class="form-control" value="<?php echo isset($_POST['end_date']) ? $_POST['end_date'] : ''; ?>">
                            </div>

                            <div class="col-auto">
                                <button type="submit" name="submit" class="submit_btn" style="background-color:dimgrey; color:floralwhite;">load</button>
                            </div>



                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div id="reportData"></div>
            </div>
        </div>
    </div>


</main>

<?php
include_once __DIR__ . '/../../layouts/admin_footer.php';
?>