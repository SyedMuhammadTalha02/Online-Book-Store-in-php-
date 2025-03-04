<?php
include 'confiq.php';
?>

<!DOCTYPE php>
<php lang="en">

    <head>
        <meta charset="utf-8">
        <title>E Book - Online Book Store Website</title>
        <meta content="width=device-width, initial-scale=1.0" name="viewport">
        <meta content="Free php Templates" name="keywords">
        <meta content="Free php Templates" name="description">

        <!-- Favicon -->
        <link href="img/favicon.ico" rel="icon">

        <!-- Google Web Fonts -->
        <link rel="preconnect" href="https://fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">

        <!-- Font Awesome -->
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">

        <!-- Libraries Stylesheet -->
        <link href="lib/animate/animate.min.css" rel="stylesheet">
        <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">

        <!-- Customized Bootstrap Stylesheet -->
        <link href="css/style.css" rel="stylesheet">
        <style>
            .profile {
                vertical-align: middle;
                width: 50px;
                height: 50px;
                border-radius: 50%;
            }
        </style>
    </head>

    <body>
        <!-- Topbar Start -->
        <div class="container-fluid">
            <div class="row bg-secondary py-1 px-xl-5">
                <div class="col-lg-6 d-none d-lg-block">
                    <div class="d-inline-flex align-items-center h-100">
                        <a class="text-body mr-3" href="status.php">Track Your Order</a>
                        <!-- <a class="text-body mr-3" href="">Contact</a> -->
                        <!-- <a class="text-body mr-3" href="">Help</a> -->
                        <!-- <a class="text-body mr-3" href="">FAQs</a> -->
                    </div>
                </div>
                <div class="col-lg-6 text-center text-lg-right">
                    <div class="d-inline-flex align-items-center">
                        <div class="btn-group">
                            <?php

                            if (isset($_SESSION['user_id'])) {
                                // Get the user's username from the session or your database
                                $username = $_SESSION['user_name']; // Change 'username' to the actual session variable name

                                echo '
    <button type="button" class="btn btn-sm btn-light dropdown-toggle" data-toggle="dropdown">' . $username . '</button>
    <div class="dropdown-menu dropdown-menu-right">
    <a class="dropdown-item" href="logout.php" type="button">Log out</a>
    <a class="dropdown-item" href="profile.php" type="button">Profile</a>
    ';
                            } else {
                                echo '
    <button type="button" class="btn btn-sm btn-light dropdown-toggle" data-toggle="dropdown">My Account</button>
    <div class="dropdown-menu dropdown-menu-right">
    <a class="dropdown-item" href="sign_in.php" type="button">Sign in</a>
    <a class="dropdown-item" href="sign_up.php" type="button">Sign up</a>
    ';
                            }
                            ?>



                        </div>
                    </div>

                </div>
                <div class="d-inline-flex align-items-center d-block d-lg-none">
                    <a href="" class="btn px-0 ml-2">
                        <i class="fas fa-heart text-dark"></i>
                        <span class="badge text-dark border border-dark rounded-circle" style="padding-bottom: 2px;">0</span>
                    </a>
                    <a href="" class="btn px-0 ml-2">
                        <i class="fas fa-shopping-cart text-dark"></i>
                        <span class="badge text-dark border border-dark rounded-circle" style="padding-bottom: 2px;">0</span>
                    </a>
                </div>
            </div>
        </div>
        <div class="row align-items-center bg-light py-3 px-xl-5 d-none d-lg-flex">
            <div class="col-lg-4">
                <a href="" class="text-decoration-none">
                    <span class="h1 text-uppercase text-primary bg-dark px-2">E </span>
                    <span class="h1 text-uppercase text-dark bg-primary px-2 ml-n1">BOOK</span>
                </a>
            </div>
            <div class="col-lg-4 col-6 text-left">
                <form action="">
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="Search for products">
                        <div class="input-group-append">
                            <span class="input-group-text bg-transparent text-primary">
                                <i class="fa fa-search"></i>
                            </span>
                        </div>
                    </div>
                </form>
            </div>
            <div class="col-lg-4 col-6 text-right">
                <p class="m-0">Customer Service</p>
                <h5 class="m-0">+92356676654</h5>
            </div>
        </div>
        </div>
        <!-- Topbar End -->


        <!-- Navbar Start -->
        <div class="container-fluid bg-dark mb-30">
            <div class="row px-xl-5">
                <div class="col-lg-3 d-none d-lg-block">
                    <a class="btn d-flex align-items-center justify-content-between bg-primary w-100" data-toggle="collapse" href="#navbar-vertical" style="height: 65px; padding: 0 30px;">
                        <h6 class="text-dark m-0"><i class="fa fa-bars mr-2"></i>Categories</h6>
                        <i class="fa fa-angle-down text-dark"></i>
                    </a>
                    <?php
                    include "confiq.php";

                    $selectQuery = "SELECT * FROM `category`";
                    $result = mysqli_query($con, $selectQuery) or die("Query Failed");
                    if (mysqli_num_rows($result)) {
                    ?>

                        <nav class="collapse position-absolute navbar navbar-vertical navbar-light align-items-start p-0 bg-light" id="navbar-vertical" style="width: calc(100% - 30px); z-index: 999;">
                            <div class="navbar-nav w-100">
                                <?php
                                while ($row = mysqli_fetch_assoc($result)) {

                                    echo " <a href='{$row['Category_Name']}.php?cid={$row['C_id']}' class='nav-item nav-link'>  {$row['Category_Name']}</a>";
                                }
                                ?>


                            </div>
                        </nav>
                    <?php
                    }
                    ?>
                </div>
                <div class="col-lg-9">
                    <nav class="navbar navbar-expand-lg bg-dark navbar-dark py-3 py-lg-0 px-0">
                        <a href="" class="text-decoration-none d-block d-lg-none">
                            <span class="h1 text-uppercase text-dark bg-light px-2">Multi</span>
                            <span class="h1 text-uppercase text-light bg-primary px-2 ml-n1">Shop</span>
                        </a>
                        <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
                            <span class="navbar-toggler-icon"></span>
                        </button>
                        <div class="collapse navbar-collapse justify-content-between" id="navbarCollapse">
                            <div class="navbar-nav mr-auto py-0">
                                <a href="index.php" class="nav-item nav-link active">Home</a>
                                <a href="shop.php" class="nav-item nav-link">Shop</a>
                                <a href="http://localhost/e-project/web/competition.php" class="nav-item nav-link">Competition</a>

                                <a href="contact.php" class="nav-item nav-link">Contact</a>
                            </div>
                            <div class="navbar-nav ml-auto py-0 d-none d-lg-block">
                                <!-- <a href="" class="btn px-0">
                                    <i class="fas fa-heart text-primary"></i>
                                    <span class="badge text-secondary border border-secondary rounded-circle" style="padding-bottom: 2px;">0</span>
                                </a> -->
                                <a href="cart.php" class="btn px-0 ml-3">
                                    <i class="fas fa-shopping-cart text-primary"></i>
                                    <span class="badge text-secondary border border-secondary rounded-circle" style="padding-bottom: 2px;">


                                        <?php
                                        if(isset($_SESSION['user_id'])) {
                                            $user_id = $_SESSION['user_id'];
                                            $show = "SELECT * FROM `cart` where user_id = $user_id";

                                        $stmt = mysqli_query($con, $show);
                                        if ($stmt) {
                                            $row = mysqli_num_rows($stmt);
                                            echo $row;
                                        }
                                        } else {
                                            echo "0" ;
                                        }

                                        
                                        

                                        ?>


                                    </span>
                                </a>
                            </div>
                            <?php
                            include 'confiq.php';

                            $query = "SELECT * FROM `users` where user_id = '" . $_SESSION['id'] . "'";
                            $result = mysqli_query($con, $query);
                            while ($data = mysqli_fetch_assoc($result)) {
                            ?>

                                <a href="../Web/user_profile.php"><img src="../admin/uploads/<?php echo $data["profile_pic"] ?>" alt="Profile" class="profile"></a>
                            <?php
                            }
                            ?>
                        </div>
                    </nav>
                </div>
            </div>
        </div>
        <!-- Navbar End -->