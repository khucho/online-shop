<?php
include_once __DIR__ . '/../../layouts/admin_navbar.php';
include_once __DIR__ . '/../../controller/OrderController.php';
include_once __DIR__ . '/../../controller/CategoryController.php';
include_once __DIR__ . '/../../controller/ProductController.php';
include_once __DIR__ . '/../../controller/UserController.php';

$order_con = new OrderController();
$orders = $order_con->getOrders();
$orderPerMonth = $order_con->orderPerMonth();

$cat_con = new CategoryController();
$categories = $cat_con->getCategories();
$catPerProduct = $cat_con->categoryPerProduct();

$pro_con = new ProductController();
$products = $pro_con->getProducts();

$user_con = new UserController();
$users = $user_con->getUser();
?>

<main class="content">
	<div class="container-fluid p-0">

		<h1 class="h3 mb-3"><strong>Analytics</strong> Dashboard</h1>

		<div class="row">
			<div class="col-xl-6 col-xxl-5 d-flex">
				<div class="w-100">
					<div class="row">
						<div class="col-sm-6">
							<div class="card">
								<div class="card-body">
									<div class="row">
										<div class="col mt-0">
											<h5 class="card-title"> Orders</h5>
										</div>

										<div class="col-auto">
											<div class="stat text-primary">
												<i class="align-middle" data-feather="shopping-bag"></i>
											</div>
										</div>
									</div>
									<h1 class="mt-1 mb-3"><?php echo sizeof($orders); ?></h1>

								</div>
							</div>
						</div>
						<div class="col-sm-6">
							<div class="card">
								<div class="card-body">
									<div class="row">
										<div class="col mt-0">
											<h5 class="card-title">Users</h5>
										</div>

										<div class="col-auto">
											<div class="stat text-primary">
												<i class="align-middle" data-feather="heart"></i>
											</div>
										</div>
									</div>
									<h1 class="mt-1 mb-3"><?php echo sizeof($users); ?></h1>

								</div>
							</div>
						</div>


					</div>
				</div>
			</div>
			<div class="col-xl-6 col-xxl-5">
				<div class="w-100">
					<div class="row">
						<div class="col-sm-6">
							<div class="card">
								<div class="card-body">
									<div class="row">
										<div class="col mt-0">
											<h5 class="card-title">Category</h5>
										</div>

										<div class="col-auto">
											<div class="stat text-primary">
												<i class="align-middle" data-feather="database"></i>
											</div>
										</div>
									</div>
									<h1 class="mt-1 mb-3"><?php echo sizeof($categories); ?></h1>

								</div>
							</div>
						</div>
						<div class="col-sm-6">
							<div class="card">
								<div class="card-body">
									<div class="row">
										<div class="col mt-0">
											<h5 class="card-title">Products</h5>
										</div>

										<div class="col-auto">
											<div class="stat text-primary">
												<i class="align-middle" data-feather="file-text"></i>
											</div>
										</div>
									</div>
									<h1 class="mt-1 mb-3"><?php echo sizeof($products); ?></h1>

								</div>
							</div>
						</div>


					</div>
				</div>
			</div>

			<div class="row">
				<div class="col-xl-6 col-xxl-5 d-flex order-2 order-xxl-3">
					<div class="card flex-fill w-100">
						<div class="card-header">

							<h5 class="card-title mb-0">Browser Usage</h5>
						</div>
						<div class="card-body d-flex">
							<div class="align-self-center w-100">
								<div class="py-3">
									<div class="chart chart-xs">
										<canvas id="chartjs-dashboard-pie"></canvas>
									</div>
								</div>

								<table class="table mb-0">
									<thead>
										<th>Category</th>
										<th>Total Products</th>
									</thead>
									<tbody>
										<?php
										foreach ($catPerProduct as $cpt) {
											echo "<tr>";
											echo "<td>" . $cpt['catname'] . "</td>";
											echo "<td>" . $cpt['total'] . "</td>";
											echo "</tr>";
										}
										?>

									</tbody>
								</table>
							</div>
						</div>
					</div>
				</div>
				<div class="col-6 col-lg-6 col-xxl-6 d-flex">
					<div class="card flex-fill">
						<div class="card-header">

							<h5 class="card-title mb-0">Order Information</h5>
						</div>
						<table class="table table-hover my-0">
							<thead>
								<tr>
									<th>No</th>
									<th class="d-none d-xl-table-cell">Month</th>
									<th class="d-none d-xl-table-cell">Total orders</th>
								</tr>
							</thead>
							<tbody>
								<?php
								$count = 1;
								foreach ($orderPerMonth as $opm) {
									echo "<tr>";
									echo "<td>" . $count++ . "</td>";
									echo "<td>" . date("F", mktime(0, 0, 0, $opm['month'], 1)) . "</td>";
									echo "<td>" . $opm['total'] . "</td>";
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
include_once __DIR__ . '/../../layouts/admin_footer.php';
?>