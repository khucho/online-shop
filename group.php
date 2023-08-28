<?php
include_once __DIR__.'/layouts/user_navbar.php';
include_once __DIR__.'/controller/GroupController.php';

$group_controller = new GroupController();
$groups = $group_controller->getGroup();


?>

<!-- group section -->
<section class="group_section layout_padding">
  <div class="container">
    <div class="heading_container heading_center">
      <h2>
        Your Favorite Idols
      </h2>

      <img src="public/images/kkk.png" width="40px" height="40px">

    </div>
  </div>

  <div class="container px-0" style="background-color: #ffe5f1;">
    <div id="customCarousel2" class="carousel col-md-12 carousel-fade" data-ride="carousel">
      <div class="carousel-inner">
        <?php $totalGroups = count($groups); ?>
        <?php for ($i = 0; $i < $totalGroups; $i += 4) { ?>
          <div class="carousel-item <?php echo ($i === 0) ? 'active' : ''; ?>">
            <div class="row d-flex justify-content-around border py-3 px-5">
              <?php for ($j = $i; $j < min($i + 4, $totalGroups); $j++) { ?>
                <div class="card rounded-circle" style="height: 14rem; width: 14rem; position: relative; border: 2px solid #131313;">
                  <img src="uploads/<?php echo $groups[$j]['image']; ?>" style="height:14rem;width:14rem;" class="card-img-top img-fluid rounded-circle p-1" alt="...">
                  <div style="position: absolute; bottom: 0; left: 0; right: 0; text-align: center; background-color: transparent; color: #ffffff; font-weight: 600; text-shadow: 0 5px 3px #0d7377, 0 3px 5px #14ffec; font-size: 25px;">
                    <p><a href="groupProduct.php?id=<?php echo $groups[$j]['id']; ?>"> <?php echo $groups[$j]['name']; ?></a></p>
                  </div>
                </div>
              <?php } ?>
            </div>
          </div>
        <?php } ?>

      </div>
      <div class=" carousel_btn-box">
        <a class="carousel-control-prev" href="#customCarousel2" role="button" data-slide="prev">
          <i class="fa fa-angle-left" aria-hidden="true"></i>
          <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#customCarousel2" role="button" data-slide="next">
          <i class="fa fa-angle-right" aria-hidden="true"></i>
          <span class="sr-only">Next</span>
        </a>
      </div>
    </div>
  </div>






</section>
<!-- end client section -->


<?php
include_once 'layouts/user_footer.php';
?>