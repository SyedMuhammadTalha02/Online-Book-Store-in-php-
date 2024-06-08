<?php
session_start();
include "confiq.php";

if (isset($_POST['submit'])) {
    // Retrieve user input
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Perform validation on user input (you can add more validation)
    if (empty($name) || empty($email) || empty($password)) {
        // Handle validation errors, e.g., redirect back to the signup page with an error message
        header("Location: sign_up.php?error=emptyfields");
        exit();
    } else {
        // Handle profile picture upload
        $uploadDir = "../admin/profile_pics/"; // Specify the correct path to your "profile_pics" folder

        if (isset($_FILES['profile_pic'])) {
            $uploadFile = $uploadDir . basename($_FILES['profile_pic']['name']);
            if (move_uploaded_file($_FILES['profile_pic']['tmp_name'], $uploadFile)) {
                // Profile picture uploaded successfully
            } else {
                // Handle file upload error
                header("Location: sign_up.php?error=uploaderror");
                exit();
            }
        } else {
            // Handle file upload error (no file selected)
            header("Location: sign_up.php?error=nofile");
            exit();
        }

        // Insert user data (name, email, password, profile pic) into the database
        $sql = "INSERT INTO users (user_name, user_email, user_password, profile_pic) VALUES (?, ?, ?, ?)";
        $stmt = mysqli_prepare($con, $sql);
        mysqli_stmt_bind_param($stmt, "ssss", $name, $email, $password, $uploadFile);

        if (mysqli_stmt_execute($stmt)) {
            // Registration successful, redirect to sign-in page
            header("Location: sign_in.php?signup=success");
            exit();
        } else {
            // Handle database insertion error
            header("Location: sign_up.php?error=databaseerror");
            exit();
        }
    }
} else {
    // Redirect to the signup page if the form is not submitted
    header("Location: sign_up.php");
    exit();
}
?>
