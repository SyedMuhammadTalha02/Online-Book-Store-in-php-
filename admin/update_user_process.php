<?php
include 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $userId = $_POST['user_id'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $pass = $_POST['pass'];
    $role = $_POST['role'];
    $address = $_POST['address'];

    // Implement an UPDATE query to update user information based on the provided user ID
    $sql = "UPDATE users SET user_name = '$name', user_email = '$email', user_password = '$pass', user_role = '$role', user_address = '$address' WHERE user_id = $userId";

    if ($con->query($sql) === TRUE) {
        echo "User updated successfully!";
    } else {
        echo "Error updating user: " . $con->error;
    }
    // Handle profile picture upload
if (!empty($_FILES["profile_pic"]["name"])) {
    $newFileName = basename($_FILES["profile_pic"]["name"]);
    $targetDir = "profile_pics/";
    $targetFilePath = $targetDir . $newFileName;

    if (move_uploaded_file($_FILES["profile_pic"]["tmp_name"], $targetFilePath)) {
        // Update the profile_pic column in the database with the new file path
        $updateProfileSql = "UPDATE users SET profile_pic = '$targetFilePath' WHERE user_id = $userId";

        if ($con->query($updateProfileSql) === TRUE) {
            // Profile picture updated successfully
            echo "Profile picture updated successfully!";
        } else {
            // Error updating profile picture in the database
            echo "Error updating profile picture: " . $con->error;
        }
    } else {
        // Error uploading the new profile picture
        echo "Error uploading the new profile picture.";
    }
}


    // Redirect back to the user list or another appropriate page
    header("Location: user_list.php");
    exit();
}

// Close the database connection
$con->close();
?>
