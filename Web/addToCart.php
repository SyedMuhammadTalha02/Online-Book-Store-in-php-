<?php

include 'confiq.php'; // Include your database configuration

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $productId = $_POST["productId"];
    $_SESSION["prodid"]=$productId;
    $productName = $_POST["productName"];
    $productPrice = $_POST["productPrice"];
    $quantity = $_POST["quantity"];

    // Check if the user is logged in or has a session, you might want to replace this with your actual authentication logic
    if (!isset($_SESSION["user_id"])) {
        echo "User not logged in";
        exit();
    }

    $userId = $_SESSION["user_id"];

    // Check if the product is already in the cart for this user
    $sqlCheck = "SELECT id FROM cart WHERE user_id = ? AND name = ?";
    $stmtCheck = mysqli_prepare($con, $sqlCheck);

    if ($stmtCheck) {
        mysqli_stmt_bind_param($stmtCheck, "is", $userId, $productName);
        mysqli_stmt_execute($stmtCheck);
        mysqli_stmt_store_result($stmtCheck);

        // If the product is already in the cart, do not add it again
        if (mysqli_stmt_num_rows($stmtCheck) > 0) {
            echo "Product is already in the cart.";
            exit();
        }

        mysqli_stmt_close($stmtCheck);
    } else {
        echo "Database error: " . mysqli_error($con);
        exit();
    }

    // Insert the product into the cart table
    $sqlInsert = "INSERT INTO cart (user_id, name, price, quantity, image, created_at) VALUES (?, ?, ?, ?, ?, NOW())";
    $stmtInsert = mysqli_prepare($con, $sqlInsert);

    if ($stmtInsert) {
        mysqli_stmt_bind_param($stmtInsert, "issis", $userId, $productName, $productPrice, $quantity, $productId);

        if (mysqli_stmt_execute($stmtInsert)) {
            echo "Product added to cart!";
        } else {
            echo "Failed to add product to cart: " . mysqli_error($con);
        }

        mysqli_stmt_close($stmtInsert);
    } else {
        echo "Database error: " . mysqli_error($con);
    }

    mysqli_close($con);
} else {
    // Handle other HTTP request methods if needed
    http_response_code(405); // Method Not Allowed
}

?>
