<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<?php
include 'header.php';
include 'config.php';

// Check if the form is submitted
if (isset($_POST['submit'])) {
    // Get data from the form
    $categoryName = $_POST['categories'];
    $categoryDescription = $_POST['description'];

    // Insert data into the 'categories' table
    $sql = "INSERT INTO category (Category_Name, Category_Des) VALUES (?, ?)";
    
    $stmt = $con->prepare($sql);
    $stmt->bind_param("ss", $categoryName, $categoryDescription);

    if ($stmt->execute()) {
        echo "Category added successfully.";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}
?>

<!-- HTML form for adding categories -->
<div id="content-page" class="content-page">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="iq-card">
                    <div class="iq-card-header d-flex justify-content-between">
                        <div class="iq-header-title">
                            <h4 class="card-title">Add Categories</h4>
                        </div>
                    </div>
                    <div class="iq-card-body">
                        <form action="#" method="post">
                            <div class="form-group">
                                <label>Category Name:</label>
                                <input type="text" name="categories" class="form-control">
                            </div>
                            <div class="form-group">
                                <label>Category Description:</label>
                                <textarea class="form-control" name="description" rows="4"></textarea>
                            </div>
                            <button type="submit" name='submit' class="btn btn-primary">Submit</button>
                            <button type="reset" class="btn btn-danger">Reset</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<?php


// Fetch data from the 'categories' table
$sql = "SELECT * FROM category";
$result = $con->query($sql);

?>

<div id="content-page" class="content-page">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="iq-card">
                    <div class="iq-card-header d-flex justify-content-between">
                        <div class="iq-header-title">
                            <h4 class="card-title">Category Lists</h4>
                        </div>
                    </div>
                    <div class="iq-card-body">
                        <div class="table-responsive">
                            <table class="data-tables table table-striped table-bordered" style="width:100%">
                                <thead>
                                    <tr>
                                        <th width="5%">No</th>
                                        <th width="20%">Category Name</th>
                                        <th width="65%">Category Description</th>
                                        <th width="10%">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $count = 1;
                                    while ($row = $result->fetch_assoc()) {
                                        echo "<tr>";
                                        echo "<td>" . $count . "</td>";
                                        echo "<td>" . $row['Category_Name'] . "</td>";
                                        echo "<td>" . $row['Category_Des'] . "</td>";
                                        echo "<td>";
                                        echo '<div class="flex align-items-center list-user-action">';
                                        echo '<a class="bg-primary" data-toggle="tooltip" data-placement="top" title="Edit" href="edit-category.php?id=' . $row['C_id'] . '"><i class="ri-pencil-line"></i></a>';
                                        echo '<a class="bg-danger" data-toggle="tooltip" data-placement="top" title="Delete" href="delete-category.php?id=' . $row['C_id'] . '"><i class="ri-delete-bin-line"></i></a>';
                                        echo '</div>';
                                        echo "</td>";
                                        echo "</tr>";
                                        $count++;
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
include 'footer.php';
?>


</body>
</html>