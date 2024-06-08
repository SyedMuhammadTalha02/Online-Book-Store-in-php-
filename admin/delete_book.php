<?php
include "config.php";

// Check if the book ID is provided in the URL parameter
if (isset($_GET['id'])) {
    $bookId = $_GET['id'];

    // Prepare and execute the delete query
    $deleteSql = "DELETE FROM add_book WHERE B_id = ?";
    $stmt = $con->prepare($deleteSql);
    $stmt->bind_param("i", $bookId);

    if ($stmt->execute()) {
        // Redirect to the book list page after successful deletion
        header("Location: book.php");
        exit();
    } else {
        echo "Error deleting book: " . $stmt->error;
    }

    $stmt->close();
} else {
    // Handle the case where the book ID is missing
    echo "Book ID is missing.";
    exit();
}
?>
