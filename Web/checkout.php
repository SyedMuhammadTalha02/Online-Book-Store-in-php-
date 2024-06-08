<?php
include 'confiq.php';
include "Layout/header.php";

if (isset($_POST['submit'])) {
    // Get user ID from session
    $user_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : null;

    if (!$user_id) {
        // Handle the case where user_id is not set
        echo "User ID is missing.";
    } else {
        // Get other form inputs
        $name = $_POST['name'];
        $email = $_POST['email'];
        $mobile = $_POST['number'];
        $address = $_POST['address'];
        $city = $_POST['city'];
        $zip_code = $_POST['zip_code'];
        $total_amount = $_POST['total'];
        $status = 'Pending';
        $created_at = date('Y-m-d H:i:s');

        // Create an order in the 'orders' table
        $order_sql = "INSERT INTO `orders`(`user_id`, `name`, `email`, `mobile`, `address`, `city`, `zip_code`, `total_amount`, `status`, `created_at`) 
                      VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $order_stmt = mysqli_prepare($con, $order_sql);

        if ($order_stmt) {
            mysqli_stmt_bind_param($order_stmt, "issssssdss", $user_id, $name, $email, $mobile, $address, $city, $zip_code, $total_amount, $status, $created_at);

            if (mysqli_stmt_execute($order_stmt)) {
                // Get the last inserted order ID
                $order_id = mysqli_insert_id($con);

                // Retrieve cart items for the logged-in user
                $sql = "SELECT * FROM cart WHERE user_id = ?";
                $stmt = mysqli_prepare($con, $sql);

                if ($stmt) {
                    mysqli_stmt_bind_param($stmt, "i", $user_id);

                    if (mysqli_stmt_execute($stmt)) {
                        $result = mysqli_stmt_get_result($stmt);

                        while ($cartItem = mysqli_fetch_assoc($result)) {
                            $product_id = $cartItem['id'];
                            $quantity = $cartItem['quantity'];
                            $subtotal = $cartItem['price'] * $quantity;

                            // Insert data into the 'order_details' table for each cart item
                            $order_detail_sql = "INSERT INTO `order_details`(`order_id`, `product_id`, `quantity`, `subtotal`) 
                                                VALUES (?, ?, ?, ?)";
                            $order_detail_stmt = mysqli_prepare($con, $order_detail_sql);

                            if ($order_detail_stmt) {
                                mysqli_stmt_bind_param($order_detail_stmt, "iiid", $order_id, $product_id, $quantity, $subtotal);

                                if (mysqli_stmt_execute($order_detail_stmt)) {
                                    // Successfully inserted into order_details, so remove the item from the cart
                                    $delete_cart_item_sql = "DELETE FROM cart WHERE id = ?";
                                    $delete_cart_item_stmt = mysqli_prepare($con, $delete_cart_item_sql);

                                    if ($delete_cart_item_stmt) {
                                        mysqli_stmt_bind_param($delete_cart_item_stmt, "i", $product_id);

                                        if (mysqli_stmt_execute($delete_cart_item_stmt)) {
                                            // Item removed from cart
                                        } else {
                                            echo "Failed to remove item from cart: " . mysqli_error($con);
                                        }
                                    } else {
                                        echo "Error preparing delete_cart_item_stmt: " . mysqli_error($con);
                                    }
                                } else {
                                    echo "Failed to insert into order_details: " . mysqli_error($con);
                                }
                            } else {
                                echo "Error preparing order_detail_stmt: " . mysqli_error($con);
                            }
                        }
                    }
                }

                mysqli_stmt_close($stmt);
                
                // Order placed successfully, you can redirect to a confirmation page
                echo "<script>window.location.href='status.php'</script>";
            } else {
                echo "Failed to insert into orders: " . mysqli_error($con);
            }

            mysqli_stmt_close($order_stmt);
        } else {
            echo "Error preparing order_stmt: " . mysqli_error($con);
        }

        // Close the database connection
        mysqli_close($con);
    }
}
?>
<!-- Your HTML for the checkout page remains unchanged -->

<!-- Your HTML for the checkout page remains unchanged -->

<!-- Breadcrumb Start -->
<div class="container-fluid">
    <div class="row px-xl-5">
        <div class="col-12">
            <nav class="breadcrumb bg-light mb-30">
                <a class="breadcrumb-item text-dark" href="#">Home</a>
                <a class="breadcrumb-item text-dark" href="#">Shop</a>
                <span class="breadcrumb-item active">Checkout</span>
            </nav>
        </div>
    </div>
</div>
<!-- Breadcrumb End -->

<!-- Checkout Start -->
<div class="container-fluid">
    <div class="row px-xl-5">
        <div class="col-lg-8">
            <h5 class="section-title position-relative text-uppercase mb-3"><span class="bg-secondary pr-3">Billing Address</span></h5>
            <div class="bg-light p-30 mb-5">
                <form action="" method="POST">
                    <input type="hidden" name="subtotal" value="<?php echo isset($_SESSION['subtotal']) ? $_SESSION['subtotal'] : ''; ?>">
                    <input type="hidden" name="shipping" value="<?php echo isset($_SESSION['shipping']) ? $_SESSION['shipping'] : ''; ?>">
                    <input type="hidden" name="total" value="<?php echo isset($_SESSION['total']) ? $_SESSION['total'] : ''; ?>">
                    <input type="hidden" name="user_id" value="<?php echo isset($_SESSION['user_id']) ? $_SESSION['user_id'] : ''; ?>">
                    <div class="row">
                        <div class="col-md-6 form-group">
                            <label>Name</label>
                            <input class="form-control" type="text" name="name">
                        </div>
                        <div class="col-md-6 form-group">
                            <label>E-mail</label>
                            <input class="form-control" type="text" placeholder="example@email.com" name="email">
                        </div>
                        <div class="col-md-6 form-group">
                            <label>Mobile No</label>
                            <input class="form-control" type="text" placeholder="+123 456 789" name="number">
                        </div>
                        <div class="col-md-6 form-group">
                            <label>Address</label>
                            <input class="form-control" type="text" placeholder="123 Street" name="address">
                        </div>
                        <div class="col-md-6 form-group">
                            <label>City</label>
                            <input class="form-control" type="text" placeholder="New York" name="city">
                        </div>
                        <div class="col-md-6 form-group">
                            <label>ZIP Code</label>
                            <input class="form-control" type="text" placeholder="123" name="zip_code">
                        </div>
                    </div>
                    <div class="mb-5">
                        <h5><span class="pr-3">Payment</span></h5>
                        <div class="bg-light p-30">
                            <div class="form-group">
                            </div>
                            <div class="form-group">
                                <div class="custom-control custom-radio">
                                    <input type="radio" class="custom-control-input" name="payment" id="directcheck">
                                    <label class="custom-control-label" for="directcheck">Cash on delivery</label>
                                </div>
                            </div>
                        </div>
                        <button name="submit" class="btn btn-block btn-primary font-weight-bold py-3">Place Order</button>
                    </div>
                </form>
            </div>
        </div>

        <div class="col-lg-4">
            <h5 class="section-title position-relative text-uppercase mb-3"><span class="bg-secondary pr-3">Order Total</span></h5>
            <div class="bg-light p-30 mb-5">
                <div class="border-bottom">
                    <?php
                    if (!isset($_SESSION["user_id"])) {
                        echo "<script>window.location.href='sign_in.php'</script>"; // Redirect to the sign-in page if the user is not logged in
                        exit();
                    }

                    $userId = $_SESSION["user_id"];

                    // Retrieve cart items for the logged-in user
                    $sql = "SELECT * FROM cart WHERE user_id = ?";
                    $stmt = mysqli_prepare($con, $sql);

                    if ($stmt) {
                        mysqli_stmt_bind_param($stmt, "i", $userId);

                        if (mysqli_stmt_execute($stmt)) {
                            $result = mysqli_stmt_get_result($stmt);
                            $cartItems = mysqli_fetch_all($result, MYSQLI_ASSOC);
                        }
                    }
                    ?>
                    <h6 class="mb-3">Products</h6>
                    <?php foreach ($cartItems as $item) : ?>
                        <div class="d-flex justify-content-between" style="border-bottom: 1px solid gray; padding-top: 5px;">
                            <p><?= $item['name']; ?></p>
                            <p>
                                $<?= $item['price']; ?>
                                <br>
                                <small>Quantity <span style="color: red;"><?= $item['quantity']; ?></span></small>
                            </p>
                        </div>
                    <?php endforeach; ?>
                </div>
                <div class="border-bottom pt-3 pb-2">
                    <div class="d-flex justify-content-between mb-3">
                        <h6>Subtotal</h6>
                        <h6><?php echo "$" . $_SESSION['subtotal'] . ".00"; ?></h6>
                    </div>
                    <div class="d-flex justify-content-between">
                        <h6 class="font-weight-medium">Shipping</h6>
                        <h6 class="font-weight-medium"><?php echo "$" . $_SESSION['shipping'] . ".00"; ?></h6>
                    </div>
                </div>
                <div class="pt-2">
                    <div class="d-flex justify-content-between mt-2">
                        <h5>Total</h5>
                        <h5><?php echo "$" .  $_SESSION['total'] . ".00"; ?></h5>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
<!-- Checkout End -->

<?php
include "Layout/footer.php";
?>