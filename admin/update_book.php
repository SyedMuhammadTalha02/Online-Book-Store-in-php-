<?php
include "config.php";

if (isset($_POST['submit'])) {
    // Get data from the form
    $bookId = $_POST['book_id'];
    $bookName = $_POST['book_name'];
    $bookCategory = $_POST['book_category'];
    $bookAuthor = $_POST['book_author'];
    $bookPrice = $_POST['book_price'];
    $bookDescription = $_POST['book_description'];

    // Handle file uploads (if new image or PDF is selected)
    if ($_FILES['book_image']['name']) {
        // Handle updating the book image
        $bookImage = $_FILES['book_image']['name'];
        $imageTargetPath = 'uploads/' . $bookImage;
        move_uploaded_file($_FILES['book_image']['tmp_name'], $imageTargetPath);

        // Update the book image in the database
        $updateImageSql = "UPDATE add_book SET Book_img=? WHERE B_id=?";
        $stmtImage = $con->prepare($updateImageSql);
        $stmtImage->bind_param("si", $bookImage, $bookId);
        $stmtImage->execute();
        $stmtImage->close();
    }

    if ($_FILES['book_pdf']['name']) {
        // Handle updating the book PDF
        $bookPdf = $_FILES['book_pdf']['name'];
        $pdfTargetPath = 'uploads/' . $bookPdf;
        move_uploaded_file($_FILES['book_pdf']['tmp_name'], $pdfTargetPath);

        // Update the book PDF in the database
        $updatePdfSql = "UPDATE add_book SET Book_PDF=? WHERE B_id=?";
        $stmtPdf = $con->prepare($updatePdfSql);
        $stmtPdf->bind_param("si", $bookPdf, $bookId);
        $stmtPdf->execute();
        $stmtPdf->close();
    }

    // Prepare and execute the update query for other fields
    $updateSql = "UPDATE add_book SET Book_Name=?, Book_Category=?, Book_Author=?, Book_Price=?, Book_Description=? WHERE B_id=?";
    $stmt = $con->prepare($updateSql);
    $stmt->bind_param("sssssi", $bookName, $bookCategory, $bookAuthor, $bookPrice, $bookDescription, $bookId);

    if ($stmt->execute()) {
        // Redirect to the book list page after a successful update
        header("Location: book.php");
        exit();
    } else {
        echo "Error: " . $stmt->error;
    }
    
    $stmt->close();
}
?>
