

<?php
   
    include_once __DIR__.'/../../layouts/admin_navbar.php';
    include_once __DIR__.'/../../controller/CodeController.php';




$code_controller = new CodeController();
$codes = $code_controller->codeList();

?>

            <main class="content">
                <div class="container-fluid p-0">
                    <h1 class="h3 mb-3"><strong>Code List</strong></h1>
                    
                    <?php
                        if(isset($_GET['status']) && $_GET['status']==true)
                        {
                            echo "<span class='text-success'>New Code has been successfully added</span>";
                        }

                    ?>

                    <div class='row mt-3'>
                        <div class='col-md-3'>
                            <a href="addCode.php" class='btn btn-primary'>Add New Code</a>
                        </div>
                    </div>
                    
                    <div class='row mt-3'>
                        <div class='col-md-12'>
                            <table class="table" id="catTable">
                                <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Code</th>
                                    <th>Status</th>
                                    <th>Used at</th>

                                </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        $count=1;
                                        foreach($codes as $code)
                                        {
                                    ?>
                                        <tr>
                                            <td><?php echo $count++; ?></td>
                                            <td><?php echo $code['code'] ?></td>
                                            <td>
                                                <?php if ($code['used_by_user'] == null) :?>
                                                    <span class="text-success">Avaiable</span>
                                                <?php else : ?>
                                                    <span class="text-danger">Used</span>
                                                <?php endif; ?>
                                            </td>

                                            <td>
                                                <?php if ($code['used_at'] == null) :?>
                                                    <span class="text-success">-</span>
                                                <?php else : ?>
                                                    <span class="text-dark"><?php echo $code['used_at'] ?></span>
                                                <?php endif; ?>
                                            </td>
                                            
                                        </tr>
                                    <?php 
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