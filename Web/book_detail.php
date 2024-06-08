
<?php
include "Layout/header.php";
include 'confiq.php';




// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    // User is not logged in, redirect them to the login page or display a message
    echo '<script>window.location.href = "sign_in.php";</script>';// Redirect to the login page
    exit(); // Stop executing the rest of the code
}
// Check if the 'id' parameter exists in the URL
if (isset($_GET['id'])) {
    $book_id = $_GET['id'];
    
    // Sanitize and validate $book_id here (e.g., using intval())
    // ...
    
    // Query the database to retrieve book details based on $book_id
    $query = "SELECT * FROM `add_book` WHERE B_id = $book_id";
    $result = mysqli_query($con, $query);
    
    if ($result && mysqli_num_rows($result) > 0) {
        $book_data = mysqli_fetch_assoc($result);

        // Now, you can access book details using $book_data
        $book_image = $book_data["Book_img"];
        $book_name = $book_data["Book_Name"];
        $book_price = $book_data["Book_Price"];
        $book_quantity = $book_data["Book_Quantity"];
        $book_pdf_link = $book_data["Book_PDF"];
        $author_name = $book_data["Book_Author"];
        $book_description = $book_data["Book_Description"];
        // ...
    } else {
        // Handle the case where the book with the specified ID was not found
        // You can show an error message or redirect the user, as per your requirements
    }
} else {
    // Handle the case where the 'id' parameter is not present in the URL
    // You can show an error message or redirect the user, as per your requirements
}

?>




    <!-- Breadcrumb Start -->
    <div class="container-fluid">
        <div class="row px-xl-5">
            <div class="col-12">
                <nav class="breadcrumb bg-light mb-30">
                    <a class="breadcrumb-item text-dark" href="#">Home</a>
                    <a class="breadcrumb-item text-dark" href="#">Shop</a>
                    <span class="breadcrumb-item active">Book Detail</span>
                </nav>
            </div>
        </div>
    </div>
    <!-- Breadcrumb End -->


    <!-- Shop Detail Start -->
    <div class="container-fluid pb-5">
        <div class="row px-xl-5">
            <div class="col-lg-5 mb-30">
                <div id="product-carousel" class="carousel slide" data-ride="carousel">
                    <div class="carousel-inner bg-light">
                        <div class="carousel-item active">
                        <img class="w-100 h-100" src="../admin/uploads/<?php echo $book_image; ?>" alt="Book Image">
                        </div>
                        
                    </div>
                     
                </div>
            </div>

            <div class="col-lg-7 h-auto mb-30">
                <div class="h-100 bg-light p-30">
                <h3><?php echo $book_name; ?></h3>
                    <div class="d-flex mb-3">
                        <div class="text-primary mr-2">
                            <small class="fas fa-star"></small>
                            <small class="fas fa-star"></small>
                            <small class="fas fa-star"></small>
                            <small class="fas fa-star-half-alt"></small>
                            <small class="far fa-star"></small>
                        </div>
                        <small class="pt-1">(99 Reviews)</small>
                    </div>
                    <h3 class="font-weight-semi-bold mb-4">$<?php echo $book_price; ?></h3>
                    <h5 class="mb-4"><?php echo $author_name; ?></h5>
                   
                    <a class="btn btn-primary px-3 mb-3" href="../admin/uploads/<?php echo $book_pdf_link; ?>" target="_blank"><i class="fa fa-file-pdf mr-1"></i>View PDF</a>


                    <div class="d-flex align-items-center mb-4 pt-2">
    <div class="input-group quantity mr-3" style="width: 130px;">
        <div class="input-group-btn">
        <!-- <button class="btn btn-primary btn-minus">
                                    <i class="fa fa-minus"></i>
                                </button> -->
                            </div>
                            <input type="text" class="form-control bg-secondary border-0 text-center" value="1" readonly
                            disabled>
                            <div class="input-group-btn">
                                <!-- <button class="btn btn-primary btn-plus">
                                    <i class="fa fa-plus"></i>
                                </button> -->
        </div>
    </div>
    </div>
<br>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
    $(".add-to-cart-btn").click(function() {
        // Get product details from the button's data attributes
        var productId = $(this).data("product-id");
        var productName = $(this).data("product-name");
        var productPrice = $(this).data("product-price");
        var quantity = $(this).data("quantity");

        // Send an AJAX request to add the product to the cart
        $.ajax({
            type: "POST",
            url: "addToCart.php",
            data: {
                productId: productId,
                productName: productName,
                productPrice: productPrice,
                quantity: quantity
            },
            success: function(response) {
                // Handle the response (e.g., update the UI)
                alert(response); 
                location.reload();// Debugging purposes
            }
        });
    });
});

</script>

<button class="btn btn-primary px-3 add-to-cart-btn"
        data-product-id="<?php echo $product_id; ?>"
        data-product-name="<?php echo $book_name; ?>"
        data-product-price="<?php echo $book_price; ?>"
        data-quantity="1">
    <i class="fa fa-shopping-cart mr-1"></i> Add To Cart
    <input type="hidden" name="product_id" value="<?php echo $product_id; ?>">
</button>




                    <div class="d-flex pt-2">
                        <strong class="text-dark mr-2">Share on:</strong>
                        <div class="d-inline-flex">
                            <a class="text-dark px-2" href="">
                                <i class="fab fa-facebook-f"></i>
                            </a>
                            <a class="text-dark px-2" href="">
                                <i class="fab fa-twitter"></i>
                            </a>
                            <a class="text-dark px-2" href="">
                                <i class="fab fa-linkedin-in"></i>
                            </a>
                            <a class="text-dark px-2" href="">
                                <i class="fab fa-pinterest"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row px-xl-5">
            <div class="col">
                <div class="bg-light p-30">
                    <div class="nav nav-tabs mb-4">
                        <a class="nav-item nav-link text-dark active" data-toggle="tab" href="#tab-pane-1">Description</a>
                        
                        <a class="nav-item nav-link text-dark" data-toggle="tab" href="#tab-pane-3">Reviews (0)</a>
                    </div>
                    <div class="tab-content">
                        <div class="tab-pane fade show active" id="tab-pane-1">
                            <h4 class="mb-3">Product Description</h4>
                            <p><?php echo  $book_description; ?></p>
                            
                        </div>
                        
                        <div class="tab-pane fade" id="tab-pane-3">
                            <div class="row">
                                <div class="col-md-6" >
                                    <h4 class="mb-4">1 review for <?php echo $book_name; ?></h4>
                                    <div class="media mb-4">
                                        <img src="img/user.jpg" alt="Image" class="img-fluid mr-3 mt-1" style="width: 45px;">
                                        <div class="media-body">
                                            <h6>John Doe<small> - <i>01 Jan 2045</i></small></h6>
                                            <div class="text-primary mb-2">
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star-half-alt"></i>
                                                <i class="far fa-star"></i>
                                            </div>
                                            <p>Diam amet duo labore stet elitr ea clita ipsum, tempor labore accusam ipsum et no at. Kasd diam tempor rebum magna dolores sed sed eirmod ipsum.</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <h4 class="mb-4">Leave a review</h4>
                                    <small>Your email address will not be published. Required fields are marked *</small>
                                    <div class="d-flex my-3">
                                        <p class="mb-0 mr-2">Your Rating * :</p>
                                        <div class="text-primary">
                                            <i class="far fa-star"></i>
                                            <i class="far fa-star"></i>
                                            <i class="far fa-star"></i>
                                            <i class="far fa-star"></i>
                                            <i class="far fa-star"></i>
                                        </div>
                                    </div>
                                    <form >
                                        <div class="form-group">
                                            <label for="message">Your Review *</label>
                                            <textarea id="message" cols="30" rows="5" class="form-control"></textarea>
                                        </div>
                                        <div class="form-group">
                                            <label for="name">Your Name *</label>
                                            <input type="text" class="form-control" id="name">
                                        </div>
                                        <div class="form-group">
                                            <label for="email">Your Email *</label>
                                            <input type="email" class="form-control" id="email">
                                        </div>
                                        <div class="form-group mb-0">
                                            <input type="submit" value="Leave Your Review" class="btn btn-primary px-3">
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    


    <!-- Shop Detail End -->




    <?php

include "Layout/footer.php";
?>