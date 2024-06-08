<?php
include "config.php";
include "header.php";

// Check if the book ID is provided in the URL parameter
if (isset($_GET['id'])) {
    $bookId = $_GET['id'];

    // Retrieve the current book details from the database
    $sql = "SELECT * FROM add_book WHERE B_id = ?";
    $stmt = $con->prepare($sql);
    $stmt->bind_param("i", $bookId);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        // Fetch the book details
        $row = $result->fetch_assoc();
        $bookName = $row['Book_Name'];
        $bookCategory = $row['Book_Category'];
        $bookAuthor = $row['Book_Author'];
        $bookPrice = $row['Book_Price'];
        $bookDescription = $row['Book_Description'];

        // Close the database connection
        $stmt->close();
    } else {
        // Handle the case where the book with the specified ID doesn't exist
        echo "Book not found.";
        exit();
    }
} else {
    // Handle the case where the ID is not provided in the URL
    echo "Book ID is missing.";
    exit();
}
?>
 <div id="content-page" class="content-page">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="iq-card">
                            <div class="iq-card-header d-flex justify-content-between">
                                <div class="iq-header-title">
                                    <h4 class="card-title">Edit Book</h4>
                                </div>
                            </div>
                            <div class="iq-card-body">
<form action="update_book.php" method="POST" enctype="multipart/form-data">
    <input type="hidden" name="book_id" value="<?php echo $bookId; ?>">
    <!-- Existing book data -->
    <div class="form-group">
        <label>Book Name:</label>
        <input type="text" name="book_name" class="form-control" value="<?php echo $bookName; ?>" required>
    </div>
    <!-- Modify the Book Category dropdown to select the current category -->
    <div class="form-group">
        <label>Book Category:</label>
        <select name="book_category" class="form-control" required>
            <option disabled>Select Category</option>
            <?php
            $categoryQuery = "SELECT * FROM category";
            $categoryResult = mysqli_query($con, $categoryQuery);

            if ($categoryResult) {
                while ($row = mysqli_fetch_assoc($categoryResult)) {
                    $categoryId = $row['C_id'];
                    $categoryName = $row['Category_Name'];
                    $selected = ($categoryId == $bookCategory) ? "selected" : "";
                    echo "<option value='$categoryId' $selected>$categoryName</option>";
                }
            } else {
                echo "No Category available ";
            }
            ?>
        </select>
    </div>
    <div class="form-group">
    <label>Book Author:</label>
    <input type="text" name="book_author" class="form-control" value="<?php echo $bookAuthor; ?>" required>
</div>

<!-- Book Image: Allow updating the image -->
<div class="form-group">
    <label>Book Image:</label>
    <div class="custom-file">
        <input type="file" name="book_image" class="custom-file-input" accept="image/png, image/jpeg">
        <label class="custom-file-label">Choose file</label>
    </div>
</div>

<!-- Book PDF: Allow updating the PDF -->
<div class="form-group">
    <label>Book PDF:</label>
    <div class="custom-file">
        <input type="file" name="book_pdf" class="custom-file-input" accept="application/pdf, application/vnd.ms-excel">
        <label class="custom-file-label">Choose file</label>
    </div>
</div>

<div class="form-group">
    <label>Book Price:</label>
    <input type="text" name="book_price" class="form-control" value="<?php echo $bookPrice; ?>" required>
</div>

<div class="form-group">
    <label>Book Description:</label>
    <textarea name="book_description" class="form-control" rows="4" required><?php echo $bookDescription; ?></textarea>
</div>

<button type="submit" class="btn btn-primary" name="submit">Update</button>
<button type="reset" class="btn btn-danger">Reset</button>
</form>
</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
<?php
include 'footer.php'
?>