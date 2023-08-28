<?php
include_once __DIR__ . '/../controller/AuthController.php';

$auth = new AuthController();
$auth->authentication();

?>

<?php
include_once __DIR__ . '/../controller/AuthController.php';


$id = $_SESSION['id'];

$auth_controller = new AuthController();
$userInfo = $auth_controller->adminById($id);

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Responsive Admin &amp; Dashboard Template based on Bootstrap 5">
    <meta name="author" content="AdminKit">
    <meta name="keywords" content="adminkit, bootstrap, bootstrap 5, admin, dashboard, template, responsive, css, sass, html, theme, front-end, ui kit, web">

    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link rel="shortcut icon" href="img/icons/icon-48x48.png" />

    <link rel="canonical" href="https://demo-basic.adminkit.io/" />

    <title>AdminKit Demo - Bootstrap 5 Admin Template</title>

    <link href="../../public/css/app.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">

    <!-- datable cdn link -->
    <link href="https://cdn.datatables.net/v/dt/dt-1.13.5/b-2.4.1/datatables.min.css" rel="stylesheet" />
</head>

<body>
    <div class="wrapper">
        <nav id="sidebar" class="sidebar js-sidebar">
            <div class="sidebar-content js-simplebar">
                <a class="sidebar-brand" href="index.html">
                    <span class="align-middle">AdminKit</span>
                </a>

                <ul class="sidebar-nav">
                    <li class="sidebar-header">
                        Pages
                    </li>

                    <li class="sidebar-item active">
                        <a class="sidebar-link" href="../dashboard/index.php">
                            <i class="align-middle" data-feather="sliders"></i> <span class="align-middle">Dashboard</span>
                        </a>
                    </li>

                    <li class="sidebar-item">
                        <a class="sidebar-link" href="../dashboard/userList.php">
                            <i class="align-middle" data-feather="user"></i> <span class="align-middle">User</span>
                        </a>
                    </li>

                    <li class="sidebar-item">
                        <a class="sidebar-link" href="../category/category.php">
                            <i class="align-middle" data-feather="user"></i> <span class="align-middle">Category</span>
                        </a>
                    </li>

                    <li class="sidebar-item">
                        <a class="sidebar-link" href="../product/product.php">
                            <i class="align-middle" data-feather="log-in"></i> <span class="align-middle">Product</span>
                        </a>
                    </li>

                    <li class="sidebar-item">
                        <a class="sidebar-link" href="../group/group.php">
                            <i class="align-middle" data-feather="user-plus"></i> <span class="align-middle">Team</span>
                        </a>
                    </li>

                    <li class="sidebar-item">
                        <a class="sidebar-link" href="../order/order.php">
                            <i class="align-middle" data-feather="book"></i> <span class="align-middle">Order</span>
                        </a>
                    </li>

                    <li class="sidebar-item">
                        <a class="sidebar-link" href="../voucherCode/code.php">
                            <i class="align-middle" data-feather="book"></i> <span class="align-middle">Voucher Code</span>
                        </a>
                    </li>

                    <li class=" sidebar-item nav-item dropdown">
                        <a href="#" class="btn btn-dark dropdown-toggle sidebar-link" data-bs-toggle="dropdown">
                            <i class="align-middle" data-feather="database"></i> <span class="align-middle">Stock Management</span>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-dark">
                            <li><a class="dropdown-item" href="../stock/stock.php"> <i class="align-middle" data-feather="shopping-bag"></i><span class="align-middle">Stock</span></a></li>
                            <li><a class="dropdown-item" href="../stock/stock_details.php"><i class="align-middle" data-feather="database"></i> <span class="align-middle">Stock Details</span></a></li>
                            <!-- <li><a class="dropdown-item" href="../stock/product_stock.php"><i class="align-middle" data-feather="database"></i> <span class="align-middle">Stock Product Details</span></a></li> -->
                            <li><a class="dropdown-item" href="../stock/stock_list.php"><i class="align-middle" data-feather="database"></i> <span class="align-middle">Stock List</span></a></li>
                        </ul>
                    </li>


                    <li class="sidebar-item nav-item dropdown">
                        <a href="#" class="btn btn-dark dropdown-toggle sidebar-link" data-bs-toggle="dropdown">
                            <i class="align-middle" data-feather="flag"></i> <span class="align-middle">Report</span>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-dark">
                            <li><a class="dropdown-item" href="../dashboard/monthly_report.php"> <i class="align-middle" data-feather="shopping-bag"></i><span class="align-middle">Monthly Report</span></a></li>
                            <li><a class="dropdown-item" href="../dashboard/yearly_report_line.php"><i class="align-middle" data-feather="database"></i> <span class="align-middle">Yearly Report</span></a></li>
                        </ul>
                    </li>

                    <li class="sidebar-item">
                        <a class="sidebar-link" href="../city/city.php">
                            <i class="align-middle" data-feather="book"></i> <span class="align-middle">City</span>
                        </a>
                    </li>

                    <li class="sidebar-item">
                        <a class="sidebar-link" href="../township/township.php">
                            <i class="align-middle" data-feather="book"></i> <span class="align-middle">Township</span>
                        </a>
                    </li>

                    <li class="sidebar-item">
                        <a class="sidebar-link" href="../delivery/delivery.php">
                            <i class="align-middle" data-feather="book"></i> <span class="align-middle">Delivery</span>
                        </a>
                    </li>


                 


            </div>
        </nav>

        <div class="main">
            <nav class="navbar navbar-expand navbar-light navbar-bg">

                <div class="navbar-collapse collapse">
                    <ul class="navbar-nav navbar-align">

                        <li class="nav-item dropdown">
                            <a class="nav-icon dropdown-toggle d-inline-block d-sm-none" href="#" data-bs-toggle="dropdown">
                                <i class="align-middle" data-feather="settings"></i>
                            </a>

                            <a class="nav-link dropdown-toggle d-none d-sm-inline-block" href="#" data-bs-toggle="dropdown">
                                <span class="text-dark">
                                    <i class="align-middle me-1" data-feather="user"></i> <?php echo $userInfo['name']; ?>
                                </span>
                            </a>

                            <div class="dropdown-menu dropdown-menu-end">
                                <a class="dropdown-item mt-2" href="../dashboard/profile.php"><i class="align-middle me-1" data-feather="user"></i> Profile</a>

                                <a class="dropdown-item mt-2" href="../dashboard/changePassword.php"><i class="align-middle me-1" data-feather="key"></i> Change Password </a>


                                <a class="dropdown-item mt-2" href="../logOut.php"><i class="align-middle me-1" data-feather="log-out"></i>Log out</a>
                            </div>
                        </li>
                    </ul>
                </div>
            </nav>