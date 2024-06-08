<?php
include 'config.php';

if (isset($_GET['id'])) {
    $userId = $_GET['id'];

    // Implement a DELETE query to delete the user based on the provided user ID
    $sql = "DELETE FROM users WHERE user_id = $userId";

    if ($con->query($sql) === TRUE) {
        echo "User deleted successfully!";
    } else {
        echo "Error deleting user: " . $con->error;
    }

    // Redirect back to the user list or another appropriate page
    header("Location: user_list.php");
    exit();
} else {
    echo "Invalid request.";
}

// Close the database connection
$con->close();
?>
