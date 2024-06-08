<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>

<body>
    <?php
    include "header.php";
    include "config.php";
   

    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
    
    // Check if the form is submitted
    
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get data from the form
    $bookName = $_POST['book_name'];
    $bookCategory = $_POST['book_category'];
    $bookAuthor = $_POST['book_author'];
    $bookPrice = $_POST['book_price'];
    $bookDescription = $_POST['book_description'];

    // Handle file uploads (you may need to customize this part)
    $bookImage = $_FILES['book_image']['name'];
    $bookPdf = $_FILES['book_pdf']['name'];
    // $bookPdfTmp = $_FILES['book_pdf']['tmp_name'];
    // Check if a book with the same name already exists
    $checkDuplicateQuery = "SELECT * FROM add_book WHERE Book_Name = ?";
    $stmt = $con->prepare($checkDuplicateQuery);
    $stmt->bind_param("s", $bookName);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows > 0) {
        $msg= "Error: A book with the same name already exists.";
    } else {
        // Move uploaded files to a designated folder
        $uploadDir = 'uploads/';
        // $uploadpdf = 'uploads/pdf';
        $imageTargetPath = $uploadDir . $bookImage;
        $pdfTargetPath = $uploadDir . $bookPdf;
        if ($_FILES['book_pdf']['error'] !== UPLOAD_ERR_OK) {
            die('File upload failed with error code ' . $_FILES['book_pdf']['error']);
        }
        
        if (move_uploaded_file($_FILES['book_image']['tmp_name'], $imageTargetPath) &&
        move_uploaded_file($_FILES['book_pdf']['tmp_name'], $pdfTargetPath)) {
            // Insert data into the 'add_book' table
            $sql = "INSERT INTO `add_book`(`Book_Name`, `Book_Category`, `Book_img`, `Book_Author`, `Book_PDF`, `Book_Price`, `Book_Description`)
                    VALUES (?, ?, ?, ?, ?, ?, ?)";
            echo $sql;
            $stmt = $con->prepare($sql);
            // print_r($stmt);die();
            $stmt->bind_param("ssssdss", $bookName, $bookCategory, $bookImage, $bookAuthor, $bookPdf, $bookPrice, $bookDescription);
            // print_r($stmt);die();
            
            if ($stmt->execute()) {
                echo "Book added successfully.";
            } else {
                echo "Error: " . $stmt->error;
            }

            $stmt->close();
        } else {
            echo "Error uploading files.";
        }
    }

}

 ?>

    <div id="content-page" class="content-page">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12">
                    <div class="iq-card">
                        <div class="iq-card-header d-flex justify-content-between">
                            <div class="iq-header-title">
                                <h4 class="card-title">Add Books</h4>
                                <span>
                                    <?php
                                    if(isset($msg))
                                    {
                                        echo $msg;
                                    }
                                    ?>
                                </span>
                            </div>
                        </div>
                        <div class="iq-card-body">
                            <form method="POST" enctype="multipart/form-data">
                                <div class="form-group">
                                    <label>Book Name:</label>
                                    <input type="text" name="book_name" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label>Book Category:</label>
                                    <select name="book_category" class="form-control" required>
                                        <option selected disabled>Select Category</option>
                                        <?php
                                        // Retrieve category options from the 'category' table
                                        $categoryQuery = "SELECT * FROM category";
                                        $categoryResult = mysqli_query($con, $categoryQuery);

                                        if ($categoryResult) {
                                            while ($row = mysqli_fetch_assoc($categoryResult)) {
                                                $categoryId = $row['C_id'];
                                                $categoryName = $row['Category_Name'];
                                                echo "<option value='$categoryId'>$categoryName</option>";
                                            }
                                        } else {
                                            echo "No Category available ";
                                        }
                                        ?>
                                    </select>

                                </div>
                                <div class="form-group">
                                    <label>Book Author:</label>
                                    <input type="text" name="book_author" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label>Book Image:</label>
                                    <div class="custom-file">
                                        <input type="file" name="book_image" class="form-control" accept="image/png, image/jpeg" required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Book PDF:</label>
                                    <div class="custom-file">
                                        <input type="file" name="book_pdf" class="form-control" accept="application/pdf" required>
                                       
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Book Price:</label>
                                    <input type="text" name="book_price" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label>Book Description:</label>
                                    <textarea name="book_description" class="form-control" rows="4" required></textarea>
                                </div>
                                <button type="submit" class="btn btn-primary" name="submit">Submit</button>
                                <button type="reset" class="btn btn-danger">Reset</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    
  <div id="content-page" class="content-page">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="iq-card">
                    <div class="iq-card-header d-flex justify-content-between">
                        <div class="iq-header-title">
                            <h4 class="card-title">Book Lists</h4>
                        </div>
                    </div>
                    <div class="iq-card-body">
                        <div class="table-responsive">
                            <table class="data-tables table table-striped table-bordered" style="width:100%">
                                <thead>
                                    <tr>
                                        <th style="width: 3%;">No</th>
                                        <th style="width: 12%;">Book Image</th>
                                        <th style="width: 15%;">Book Name</th>
                                        <th style="width: 15%;">Book Category</th>
                                        <th style="width: 15%;">Book Author</th>
                                        <th style="width: 18%;">Book Description</th>
                                        <th style="width: 7%;">Book Price</th>
                                        <th style="width: 7%;">Book PDF</th>
                                        <th style="width: 15%;">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    // Fetch book data from the 'add_book' table
                                    $bookQuery = "SELECT * FROM add_book";
                                    $bookResult = mysqli_query($con, $bookQuery);
                                    $counter = 1;

                                    while ($row = mysqli_fetch_assoc($bookResult)) {
                                        $bookId = $row['B_id'];
                                        $bookImage = $row['Book_img'];
                                        $bookName = $row['Book_Name'];
                                        $bookCategory = $row['Book_Category'];
                                        $bookAuthor = $row['Book_Author'];
                                        $bookDescription = $row['Book_Description'];
                                        $bookPrice = $row['Book_Price'];
                                        $bookPdf = $row['Book_PDF'];

                                        echo "<tr>";
                                        echo "<td>" . $counter . "</td>";
                                        echo "<td><img class='img-fluid rounded' src='uploads/$bookImage' alt='$bookName'></td>";
                                        echo "<td>$bookName</td>";
                                        echo "<td>$bookCategory</td>";
                                        echo "<td>$bookAuthor</td>";
                                        echo "<td><p class='mb-0'>$bookDescription</p></td>";
                                        echo "<td>$bookPrice</td>";
                                        echo "<td><a href='uploads/$bookPdf'><i class='ri-file-fill text-secondary font-size-18'></i></a></td>";
                                        echo "<td>";
                                        echo "<div class='flex align-items-center list-user-action'>";
                                        echo "<a class='bg-primary' data-toggle='tooltip' data-placement='top' title='Edit' href='edit-book.php?id=$bookId'><i class='ri-pencil-line'></i></a>";
                                        echo "<a class='bg-primary' data-toggle='tooltip' data-placement='top' title='Delete' href='delete_book.php?id=$bookId'><i class='ri-delete-bin-line'></i></a>";
                                        echo "</div>";
                                        echo "</td>";
                                        echo "</tr>";
                                        $counter++;
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
include "footer.php";
?>
</body>

</html>