<?php

include 'confiq.php'; // Include your database configuration

if (!isset($_SESSION["user_id"])) {
    header("Location: sign_in.php"); // Redirect to the sign-in page if the user is not logged in
    exit();
}

$userId = $_SESSION["user_id"];

if (isset($_GET["item_id"])) {
    $itemId = $_GET["item_id"];

    // Delete the item from the cart table
    $sql = "DELETE FROM cart WHERE user_id = ? AND id = ?";
    $stmt = mysqli_prepare($con, $sql);

    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "ii", $userId, $itemId);

        if (mysqli_stmt_execute($stmt)) {
            header("Location: cart.php"); // Redirect to the cart page after removing the item
            exit();
        } else {
            echo "Failed to remove product from cart";
        }
    } else {
        echo "Database error";
    }
}

mysqli_stmt_close($stmt);
mysqli_close($con);
?>
