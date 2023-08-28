<?php

include_once __DIR__.'/layouts/user_navbar.php';
include_once __DIR__.'/controller/AuthController.php';
include_once __DIR__.'/controller/CityController.php';
include_once __DIR__.'/controller/TownshipController.php';
include_once __DIR__.'/controller/UserController.php';


$id = $_SESSION['id'];

$auth_controller = new AuthController();
$city_controller = new CityController();
$township_controller = new TownshipController();
$user_controller = new UserController();

$userInfo = $auth_controller->userById($id);

$cities = $city_controller->cityList();

$townships = $township_controller->townshipList();

if (isset($_POST['submit']))
{
    if (empty($_POST['name']))
        $nameError = 'Please Enter Name';

    if (empty($_POST['phone']))
        $phoneError = 'Please Enter Phone Number';

    if (empty($_POST['city']))
        $cityError = 'Please select City';

    if (empty($_POST['township']))
        $townshipError = 'Please select Township';

    if (isset($nameError) || isset($phoneError) || isset($cityError) || isset($townshipError) )
    {
        $errorCondition = true ;
    }
    else 
    {
        if ($_POST['name'] == $userInfo['name'])
        {
            $info = [
                'user_id' => $id,
                'phone' => $_POST['phone'],
                'city_id' => $_POST['city'],
                'township_id' => $_POST['township'],
            ];
        }
        else 
        {
            $info = [
                'user_id' => $id,
                'name' => $_POST['name'],
                'phone' => $_POST['phone'],
                'city_id' => $_POST['city'],
                'township_id' => $_POST['township'],
            ];
        }

        $userDetail = $user_controller->addUserDetail($info);
        die(var_dump($userDetail));
    }
}

?>
 <main>
    <div class="container">
        <div class="row my-4">
            <div class="col-md-8 offset-2 mt-3">
                <form action="" method="post">
                    <div class="mb-4">
                        <label for="" class="form-label">Name</label>
                        <input type="text" name="name" class="form-control" value="<?php if (isset($_POST['name'])) echo $_POST['name']; else echo $userInfo['name'];?>">
                        <?php if (isset($nameError) && $errorCondition) echo '<span class="text-danger">'.$nameError.'</span>';?>
                    </div>

                    <div class="mb-4">
                        <label for="" class="form-label">Email</label>
                        <input type="email" name="name" class="form-control" value="<?php echo $userInfo['email'];?>" disabled>
                    </div>

                    <div class="mb-4">
                        <label for="" class="form-label">Phone</label>
                        <input type="text" name="phone" class="form-control" value="<?php if (isset($_POST['phone'])) echo $_POST['phone']; else echo $userInfo['phone'];?>">
                        <?php if (isset($phoneError) && $errorCondition) echo '<span class="text-danger">'.$phoneError.'</span>';?>
                    </div>

                    <div class="mb-4">
                        <label for="" class="form-label">City</label>
                        <select name="city" class="form-control" id="city">
                            <option value="" selected disabled>Choose City</option>
                            <?php foreach($cities as $city):?>
                                <option value="<?php echo $city['id']?>" <?php if (isset($_POST['city'])) {if ($_POST['city'] == $city['id'])  echo 'selected';} ?>>
                                    <?php echo $city['name'] ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                        <?php if (isset($cityError) && $errorCondition) echo '<span class="text-danger">'.$cityError.'</span>';?>
                    </div>

                    <div class="mb-4">
                        <label for="" class="form-label">Township</label>
                        <select name="township" class="form-control" id="township">
                            <option value="" selected disabled>Choose Township</option>
                            <?php foreach($townships as $township) : ?>
                                    <option value="<?php echo $township["id"]?>" <?php if (isset($_POST['township'])) {if ($_POST['township'] == $township['id'])  echo 'selected';} ?>>
                                    <?php echo $township["name"] ?>
                                    </option>
                            <?php endforeach; ?>
                        </select>
                        <?php if (isset($townshipError) && $errorCondition) echo '<span class="text-danger">'.$townshipError.'</span>';?>
                    </div>

                    <div class="mb-4">
                        <button type="submit" name="submit" class="btn btn-primary">Save</button>
                    </div>

                </form>
            </div>
        </div>
    </div>
 </main>
<?php
include_once __DIR__.'/layouts/user_footer.php';
?>