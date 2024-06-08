<?php
include 'config.php'; // Include your database connection code

// Check if a category ID is provided via GET request
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $categoryId = $_GET['id'];

    // Perform the deletion query (Assuming your table is called 'category' and the primary key is 'C_id')
    $sql = "DELETE FROM category WHERE C_id = ?";
    $stmt = $con->prepare($sql);
    $stmt->bind_param("i", $categoryId);

    if ($stmt->execute()) {
        // Deletion successful, you can redirect to the category page or display a success message
        header("Location: category.php"); // Redirect to your category page
        exit;
    } else {
        // Error handling for deletion failure
        echo "Error deleting category: " . $stmt->error;
    }

    $stmt->close();
} else {
    // Handle the case when no category ID is provided or it's not numeric
    echo "Invalid category ID provided.";
}

// Close the database connection
$con->close();
?>
