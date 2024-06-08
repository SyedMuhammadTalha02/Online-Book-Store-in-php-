<?php
include 'header.php';
include 'config.php';
// Check if the 'id' parameter is present in the URL
if (isset($_GET['id'])) {
    $categoryId = $_GET['id'];

    // Fetch the category details based on the 'id'
    $sql = "SELECT * FROM category WHERE C_id = ?";
    $stmt = $con->prepare($sql);
    $stmt->bind_param("i", $categoryId);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $row = $result->fetch_assoc();

        // Display the edit form with category details
        ?>

        <div id="content-page" class="content-page">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="iq-card">
                            <div class="iq-card-header d-flex justify-content-between">
                                <div class="iq-header-title">
                                    <h4 class="card-title">Edit Category</h4>
                                </div>
                            </div>
                            <div class="iq-card-body">
                                <form  action="update_category.php" method="POST">
                                    <input type="hidden" name="category_id" value="<?php echo $row['C_id']; ?>">
                                    <div class="form-group">
                                        <label>Category Name:</label>
                                        <input type="text" name="category_name" class="form-control" value="<?php echo $row['Category_Name']; ?>">
                                    </div>
                                    <div class="form-group">
                                        <label>Category Description:</label>
                                        <textarea class="form-control" name="category_description" rows="4"><?php echo $row['Category_Des']; ?></textarea>
                                    </div>
                                    <button type="submit" name='submit' class="btn btn-primary">Update</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
  
        <?php
    } else {
        echo "Category not found.";
    }

    $stmt->close();
} else {
    echo "Invalid request.";
}


include 'footer.php';
?>
 
