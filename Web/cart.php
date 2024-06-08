<?php
session_start();
include 'confiq.php'; // Include your database configuration

if (!isset($_SESSION["user_id"])) {
    header("Location: sign_in.php"); // Redirect to the sign-in page if the user is not logged in
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

include "Layout/header.php";

// Handle quantity updates
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    foreach ($_POST["quantity"] as $itemId => $newQuantity) {
        // Ensure the quantity is a positive integer
        $newQuantity = intval($newQuantity);
        if ($newQuantity < 1) {
            $newQuantity = 1;
        }

        // Update the database with the new quantity
        $updateSql = "UPDATE cart SET quantity = ? WHERE id = ? AND user_id = ?";
        $updateStmt = mysqli_prepare($con, $updateSql);
        if ($updateStmt) {
            mysqli_stmt_bind_param($updateStmt, "iii", $newQuantity, $itemId, $userId);
            mysqli_stmt_execute($updateStmt);
        }
    }

    // Redirect to refresh the page after updating quantities
    // header("Location: http://localhost/e-project/Web/cart.php");
}
?>

<!-- Cart Start -->
<div class="container">
    <div class="row">
        <div class="col-lg-8">
            <h1>Shopping Cart</h1>
            <form method="POST" action="http://localhost/e-project/Web/cart.php">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Product</th>
                            <th>Price</th>
                            <th>Quantity</th>
                            <th>Total</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($cartItems as $item) : ?>
                            <tr>
                                <td><?= $item['name']; ?></td>
                                <td>$<?= $item['price']; ?></td>
                                <td>

                                    <input type="number" name="quantity[<?= $item['id']; ?>]" value="<?= $item['quantity']; ?>" min="1" class="quantity-input">
                                    <!-- <input type="hidden" name="prodid" value="<?= $item['id']; ?>" > -->
                                </td>
                                <td class="item-total">$<?= ($item['price'] * $item['quantity']); ?></td>
                                <td>
                                    <a href="removeFromCart.php?item_id=<?= $item['id']; ?>" class="btn btn-danger">Remove</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
                <button type="submit" class="btn btn-primary">Update Cart</button>
            </form>
        </div>
        <!-- Rest of your cart page content -->
        <div class="col-lg-4">
            <h5 class="section-title position-relative text-uppercase mb-3"><span class="bg-secondary pr-3">Cart Summary</span></h5>
            <div class="bg-light p-30 mb-5">
                <?php
                $subtotal = 0;
                foreach ($cartItems as $item) {
                    $_SESSION['subtotal'] = $subtotal += ($item['price'] * $item['quantity']);
                }
                $_SESSION['shipping'] = $shipping = 10;
                $_SESSION['total'] = $total = $subtotal + $shipping;
                ?>
                <div class="border-bottom pb-2">
                    <div class="d-flex justify-content-between mb-3">
                        <h6>Subtotal</h6>
                        <h6>$<?= number_format($subtotal, 2); ?></h6>
                    </div>
                    <div class="d-flex justify-content-between">
                        <h6 class="font-weight-medium">Shipping</h6>
                        <h6 class="font-weight-medium">$<?= number_format($shipping, 2); ?></h6>
                    </div>
                </div>
                <div class="pt-2">
                    <div class="d-flex justify-content-between mt-2">
                        <h5>Total</h5>
                        <h5>$<?= number_format($total, 2); ?></h5>
                    </div>
                    <a href="checkout.php">
                        <button class="btn btn-block add-to-cart-btn btn-primary font-weight-bold my-3 py-3">Proceed To Checkout</button>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Cart End -->

<?php
include "Layout/footer.php";
?>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).load(function() {
        $(".add-to-cart-btn").click(function() {
            $.ajax({
                type: "POST",
                url: "cart.php",
                data: {},
                success: function(response) {
                    // Reload the page after the AJAX request is successful
                    location.reload();
                }
            });
        });
    });
</script>
