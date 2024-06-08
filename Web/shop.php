<?php
    include "Layout\header.php";
?>


    <!-- Breadcrumb Start -->
    <div class="container-fluid">
        <div class="row px-xl-5">
            <div class="col-12">
                <nav class="breadcrumb bg-light mb-30">
                    <a class="breadcrumb-item text-dark" href="index.php">Home</a>
                    <a class="breadcrumb-item text-dark" href="shop.php">Shop</a>
                    <span class="breadcrumb-item active">Shop List</span>
                </nav>
            </div>
        </div>
    </div>
    <!-- Breadcrumb End -->


    <!-- Shop Start -->
    <div class="container">
        <div class="row px-xl-5">
            <!-- Shop Sidebar Start -->
        
            <!-- Shop Sidebar End -->


            <!-- Shop Product Start -->
            <!-- <div class="col-lg-9 col-md-8">
                <div class="row pb-3"> -->
                    
                   

                    <?php
                        include 'confiq.php';
                        $query = "SELECT * FROM `add_book`";
                        $result = mysqli_query($con, $query);
                        while($data = mysqli_fetch_assoc($result))
                        {
                    ?>
                    <div class="col-lg-3 col-md-4 col-sm-6 pb-1">
                <div class="product-item bg-light mb-4">
                    <div class="product-img position-relative overflow-hidden">
                        <img class="img-fluid w-100" src="../admin/uploads/<?php echo $data["Book_img"]?>" alt="" style="height:400px;">
                        <div class="product-action">
                            <a class="btn btn-outline-dark btn-square" href="cart.php"><i class="fa fa-shopping-cart"></i></a>
                            <a class="btn btn-outline-dark btn-square" href="book_detail.php?id=<?php echo $data['B_id']; ?>"><i class="far fa-eye"></i></a>
                            <a class="btn btn-outline-dark btn-square" href=""><i class="fa fa-sync-alt"></i></a>
                            <a class="btn btn-outline-dark btn-square" href=""><i class="fa fa-search"></i></a>
                        </div>
                    </div>
                    <div class="text-center py-4">
                        <a class="h6 text-decoration-none text-truncate" href=""><?php echo $data["Book_Name"]?></a>
                        <div class="d-flex align-items-center justify-content-center mt-2">
                            <h5><?php echo $data["Book_Price"]?></h5><h6 class="text-muted ml-2"><del>$40.00</del></h6>
                        </div>
                        <div class="d-flex align-items-center justify-content-center mb-1">
                            <small class="fa fa-star text-primary mr-1"></small>
                            <small class="fa fa-star text-primary mr-1"></small>
                            <small class="fa fa-star text-primary mr-1"></small>
                            <small class="far fa-star text-primary mr-1"></small>
                            <small class="far fa-star text-primary mr-1"></small>
                            <small>(10)</small>
                        </div>
                    </div>
                </div>
            </div>
                    <?php
                        }
                    ?>
                   
                    <div class="col-12">
                        <nav>
                          <ul class="pagination justify-content-center">
                            <li class="page-item disabled"><a class="page-link" href="#">Previous</span></a></li>
                            <li class="page-item active"><a class="page-link" href="#">1</a></li>
                            <li class="page-item"><a class="page-link" href="#">2</a></li>
                            <li class="page-item"><a class="page-link" href="#">3</a></li>
                            <li class="page-item"><a class="page-link" href="#">Next</a></li>
                          </ul>
                        </nav>
                    </div>
                </div>
            </div>
            <!-- Shop Product End -->
        </div>
    </div>
    <!-- Shop End -->

    <?php

include "Layout/footer.php";
?>
