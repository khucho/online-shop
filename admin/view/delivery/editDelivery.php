
<?php

include_once __DIR__.'/../../layouts/admin_navbar.php';

include_once  __DIR__.'/../../controller/TownshipController.php';

include_once  __DIR__.'/../../controller/DeliveryController.php';

$id = $_GET['id'];

$town_con = new TownshipController();
$deli_con = new DeliveryController();

$delivery = $deli_con->getDelivery($id);

$townships = $town_con->townshipList();


if(isset($_POST['submit']))
{

    if (empty($_POST['fee']))
        $feeError = 'Please enter delivery fee';


    if (isset($feeError))
    {
        $errorCondition = true ;
    }
    else 
    {

        $township = $_POST['township'];
        $fee = $_POST['fee'];

        $updateStatus = $deli_con->editDelivery($id,$township,$fee);
        
        if($updateStatus)
        {
            echo "<script>location.href = 'delivery.php?updateStatus=".$updateStatus."'</script>";
        }
    }

    
}
?>

<main>
    <div class="content">
        <div class="container-fluid">
            <h2><strong>Edit Township</strong></h2>

            <form action="" method="post" >

                <div class = "my-3">
                    <label for="" class="form-label">Fee</label>
                    <input type="number" name= "fee" min="1" value="<?php if(isset($_POST['fee']))  echo $_POST['fee']; else echo $delivery['fee'] ?>" class="form-control">
                    <?php if (isset($feeError) && $errorCondition) echo '<span class="text-danger">'.$feeError.'</span>';?>
                </div>


                <div class = "my-3">
                    <label for="" class="form-label">Township</label>
                    <select name="township" id="" class="form-select">
                    <option value="" selected disabled>Select township</option>
                        <?php
                            foreach($townships as $township)
                            {
                        ?>

                        <option value="<?php echo $township['township_id'];?>" <?php if (isset($_POST['township'])) {if ($_POST['township'] == $township['township_id'])  echo 'selected';} else {if(($delivery['township_id'] == $township['township_id'])) echo 'selected';}?> >
                        <?php echo $township['township_name'];?>
                        </option>

                        <?php
                            }
                        ?>
                    </select>
                    <?php if (isset($townshipError) && $errorCondition) echo '<span class="text-danger">'.$townshipError.'</span>';?>
                </div>

                <div class = "mt-3">
                    <button class = "btn btn-dark" type = "submit" name = "submit">Add</button>
                </div>
            </form>

        </div>
    </div>

</main>

<?php
include_once __DIR__.'/../../layouts/admin_footer.php';
?>