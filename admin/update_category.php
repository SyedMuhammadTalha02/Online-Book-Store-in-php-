<?php
include 'config.php';
if (isset($_POST['submit'])) {
    $categoryId = $_POST['category_id'];
    $categoryName = $_POST['category_name'];
    $categoryDescription = $_POST['category_description'];

    $sql = "UPDATE category SET Category_Name = ?, Category_Des = ? WHERE C_id = ?";
    $stmt = $con->prepare($sql);
    $stmt->bind_param("ssi", $categoryName, $categoryDescription, $categoryId);

    if ($stmt->execute()) {
       
      
    } else {
        echo "Error updating category: " . $stmt->error;
    }
    
    header("Location: category.php");
    exit();
   
    $stmt->close();
   
}

?>