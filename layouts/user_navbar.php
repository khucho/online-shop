<?php
session_start();

include_once __DIR__ . '/../controller/AuthController.php';
include_once __DIR__ . '/../controller/CategoryController.php';

$auth_controller = new AuthController();

if (isset($_SESSION['id'])) {
    $userData = $auth_controller->userById($_SESSION['id']);
}

$cart_controller = new CategoryController();
$categories = $cart_controller->allCategories();

if (isset($_POST['team'])) {
    $_SESSION['team'] = $_POST['team'];

    // Redirect to the target page
    header('Location: SearchDisplay.php');
    exit;
}
?>

<!DOCTYPE html>
<html>

<head>
    <!-- Basic -->
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <!-- Mobile Metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <!-- Site Metas -->
    <meta name="keywords" content="" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <link rel="shortcut icon" href="images/favicon.png" type="image/x-icon">

    <title>
        Giftos
    </title>

    <!-- slider stylesheet -->
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css" />

    <!-- bootstrap core css -->
    <link rel="stylesheet" type="text/css" href="public/css/bootstrap.css" />


    <!-- Custom styles for this template -->
    <link href="public/css/style.css" rel="stylesheet" />
    <link href="public/css/style1.css" rel="stylesheet" />

    <!-- responsive style -->
    <link href="public/css/responsive.css" rel="stylesheet" />

    <!-- cart css -->
    <link rel="stylesheet" href="public/css/cart.css">

    <!-- review css -->
    <link rel="stylesheet" href="public/css/review.css">

    <!-- css animation -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />

    <!-- bootstrap link -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
</head>

<body>
    <div class="hero_area">
        <!-- header section strats -->
        <header class="header_section">
            <nav class="navbar navbar-expand-lg custom_nav-container ">
                <a class="navbar-brand" href="index.php" style="text-decoration: none;">
                    <span>
                        <h2>K_Merch MDY</h2>
                    </span>
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class=""></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav  ">
                        <li class="nav-item <?php echo ($_SERVER['PHP_SELF'] == '/k_Merch_Mdy/index.php' ? 'active' : ''); ?>">
                            <a class="nav-link" href="index.php">Home <span class="sr-only">(current)</span></a>
                        </li>

                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="categoriesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Categories
                            </a>
                            <div class="dropdown-menu" aria-labelledby="categoriesDropdown">

                                <?php foreach ($categories as $category) : ?>
                                    <a class="dropdown-item" href="categoryProduct.php?id=<?php echo $category['id']; ?>"><?php echo $category['name']; ?></a>
                                <?php endforeach; ?>

                            </div>
                        </li>

                        <li class="nav-item <?php echo ($_SERVER['PHP_SELF'] == '/k_Merch_Mdy/shop.php' ? 'active' : ''); ?>">
                            <a class="nav-link" href="shop.php">
                                Products
                            </a>
                        </li>
                        <li class="nav-item <?php echo ($_SERVER['PHP_SELF'] == '/k_Merch_Mdy/group.php' ? 'active' : ''); ?>">
                            <a class="nav-link" href="group.php">
                                Your <br>Fav Artists <br>
                            </a>
                        </li>
                        <li class="nav-item <?php echo ($_SERVER['PHP_SELF'] == '/k_Merch_Mdy/aboutus.php' ? 'active' : ''); ?>">
                            <a class="nav-link" href="aboutus.php">
                                About us
                            </a>
                        </li>
                        <li class="nav-item <?php echo ($_SERVER['PHP_SELF'] == '/k_Merch_Mdy/contact.php' ? 'active' : ''); ?>">
                            <a class="nav-link" href="contact.php">Contact Us</a>
                        </li>
                    </ul>
                    <div class="user_option" style="margin-bottom: 25px;">
                        <?php

                        if (isset($_SESSION['role']) && $_SESSION['role'] == 'user') {

                        ?>
                            <ul class="navbar-nav">

                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle" href="#" id="categoriesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="fa fa-user" aria-hidden="true"></i>
                                        <span>
                                            <?php
                                            echo $userData['name'];
                                            ?>
                                        </span>
                                    </a>
                                    <div class="dropdown-menu" aria-labelledby="categoriesDropdown">

                                        <a class="dropdown-item" href="changePassword.php">Change Password</a>

                                        <a class="dropdown-item" href="logOut.php">Log Out</a>

                                    </div>
                                </li>
                            </ul>
                        <?php
                        } else {
                        ?>
                            <a href="logIn.php">
                                <i class="fa fa-user" aria-hidden="true"></i>
                                <span>
                                    Login
                                </span>
                            </a>
                        <?php
                        }
                        ?>
                        <a href="<?php if (isset($_SESSION['id']) && $_SESSION['role'] == 'user') echo 'cart.php';
                                    else echo 'logIn.php'; ?>">
                            <i class="fa fa-shopping-bag" aria-hidden="true"></i>
                        </a>
                        <button class="btn nav_search-btn" type="button" id="toggleSearchBar">
                            <i class="fa fa-search" aria-hidden="true"></i>
                        </button>
                        <form class="form-inline" method="POST" id="searchForm" style="display: none;">
                            <input type="text" name="team" style="width: 7rem">
                            <button type="submit" class="btn btn-primary" style="width: 4rem; height: 2rem; font-size: 0.8rem; padding: 0.5rem;">Search</button>
                        </form>
                    </div>
                </div>
            </nav>
        </header>
        <!-- end header section -->

        <script>
            document.getElementById('toggleSearchBar').addEventListener('click', function() {
                var searchBar = document.getElementById('searchForm');

                if (searchBar.style.display === 'none') {
                    searchBar.style.display = 'inline';
                } else {
                    searchBar.style.display = 'none';
                }
            });
        </script>