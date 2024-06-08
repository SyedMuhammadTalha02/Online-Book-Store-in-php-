<?php
include 'confiq.php'; // Include your database configuration file
include 'Layout/header.php'; // Include your header file

if (!isset($_SESSION['user_id'])) {
    // Redirect the user to the sign-in page if they are not logged in
    header('Location: sign_in.php');
    exit();
}

// Retrieve the user's order details from the database
$user_id = $_SESSION['user_id'];

$sql = "SELECT a.Book_Name as Book_Name, od.quantity as Quantity, o.status,od.order_id as OrderID
FROM `order_details` od
JOIN `add_book` a
on od.product_id = a.B_id
JOIN orders o 
ON od.order_id =o.order_id WHERE `user_id` = ?";
$stmt = mysqli_prepare($con, $sql);

if ($stmt) {
    mysqli_stmt_bind_param($stmt, "i", $user_id);

    if (mysqli_stmt_execute($stmt)) {
        $result = mysqli_stmt_get_result($stmt);
        $orders = mysqli_fetch_all($result, MYSQLI_ASSOC);
        echo "<div class='container order-details mt-5'>";
        echo "<h4 class='text-center'>Order Details</h4>";
        echo "<table class='table'>";
        echo "<thead><tr><th>Order ID</th><th>Book Name</th><th>Quantity</th><th>Status</th></tr></thead>";
        // Display order details for each order
        foreach ($orders as $order) {
          
            echo '<tbody><tr><td> ' . $order['OrderID'] . '</td><td> ' . $order['Book_Name'] . '</td><td> ' . $order['Quantity'] . '</td>';
            // Display the status as "Pending," "Confirmed," or "Delivered"
            if ($order['status'] == 0) {
                echo '<td>Pending</td>';
            } elseif ($order['status'] == 1) {
                echo '<td>Confirmed</td>';
            } elseif ($order['status'] == 2) {
                echo '<td>Delivered</td>';
            } else {
                echo '<td>Unknown</td>'; // Handle other status values if needed
            }
            echo "</tr></tbody>";
        }
        
        echo "</table>";
        echo "</div>";
    } else {
        echo "Failed to execute SQL query: " . mysqli_error($con);
    }

    mysqli_stmt_close($stmt);
} else {
    echo "Error preparing SQL statement: " . mysqli_error($con);
}

// Close the database connection
mysqli_close($con);

include 'Layout/footer.php'; // Include your footer file
?>
