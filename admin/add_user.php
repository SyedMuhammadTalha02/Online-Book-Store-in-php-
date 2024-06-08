<?php
// Include your database connection configuration here (config.php)
include 'config.php';

$errors = [];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve data from the form
    $name = $_POST['name'];
    $email = $_POST['email'];
    $pass = $_POST['pass'];
    $role = $_POST['role'];
    $address = $_POST['address'];

    // Check if any of the fields are empty
    if (empty($name)) {
        $errors[] = "User Name is required";
    }

    if (empty($email)) {
        $errors[] = "User Email is required";
    }

    if (empty($pass)) {
        $errors[] = "User Password is required";
    }
    if (empty($address)) {
        $errors[] = "Address is required";
    }

    // Check if the username or email already exists
    $checkQuery = "SELECT * FROM users WHERE user_name = '$name' OR user_email = '$email'";
    $result = $con->query($checkQuery);

    if ($result->num_rows > 0) {
        $errors[] = "User with the same User Name or Email already exists";
    }

    // File format validation
    $allowedFormats = ["pdf"]; // Only allow PDF files
    $fileExtension = strtolower(pathinfo($_FILES["profile_pdf"]["name"], PATHINFO_EXTENSION));

    if (!in_array($fileExtension, $allowedFormats)) {
        $errors[] = "Invalid file format. Only PDF files are allowed.";
    }

    // If there are no errors, perform the INSERT query
    if (empty($errors)) {
        // Handle PDF file upload
        $targetDir = "pdf_files/"; // Create a directory for PDF files
        $fileName = $_FILES["profile_pdf"]["name"];
        $fileName = str_replace(' ', '_', $fileName); // Remove spaces in the file name
        $targetFilePath = $targetDir . $fileName;

        if (move_uploaded_file($_FILES["profile_pdf"]["tmp_name"], $targetFilePath)) {
            // Perform the SQL INSERT query with the file path
            $sql = "INSERT INTO users (user_name, user_email, user_password, user_role, profile_pdf, user_address) VALUES ('$name', '$email', '$pass', '$role', '$targetFilePath', '$address')";

            if ($con->query($sql) === TRUE) {
                echo "Record inserted successfully!";
            } else {
                echo "Error: " . $sql . "<br>" . $con->error;
            }
        } else {
            $errors[] = "Error uploading the PDF file.";
        }
    }
}

// Close the database connection
$con->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <?php include 'header.php'; ?>

    <form action="" method="POST" enctype="multipart/form-data">
        <div id="content-page" class="content-page">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="iq-edit-list-data">
                            <div class="tab-content">
                                <div class="tab-pane fade active show" id="personal-information" role="tabpanel">
                                    <div class="iq-card">
                                        <div class="iq-card-header d-flex justify-content-between">
                                            <div class="iq-header-title">
                                                <h4 class="card-title">Add User</h4>
                                            </div>
                                        </div>
                                        <div class="iq-card-body">
                                            <div class="form-group row align-items-center">
                                                <div class="form-group col-sm-6">
                                                    <label for="uname">User Name:</label>
                                                    <input type="text" class="form-control" id="uname" name="name">
                                                </div>
                                                <div class="form-group col-sm-6">
                                                    <label for="uemail">User Email:</label>
                                                    <input type="email" class="form-control" id="uemail" name="email">
                                                </div>
                                                <div class="form-group col-sm-6">
                                                    <label for="upassword">User Password:</label>
                                                    <input type="password" class="form-control" id="upassword" name="pass">
                                                </div>
                                                <div class="form-group col-sm-6">
                                                    <label for="urole">User Role:</label>
                                                    <select class="form-control" id="urole" name="role">
                                                        <option selected="">Admin</option>
                                                        <option>User</option>
                                                    </select>
                                                </div>
                                                <div class="col-md-12">
                                                    <label for="profile_pdf">Profile PDF:</label>
                                                    <input type="file" class="form-control-file" id="profile_pdf" name="profile_pdf">
                                                </div>
                                                <div class="form-group col-sm-12">
                                                    <label for="uaddress">Address:</label>
                                                    <textarea class="form-control" id="uaddress" name="address" rows="4"></textarea>
                                                </div>
                                            </div>
                                            <?php
                                            if (!empty($errors)) {
                                                echo '<div style="color: red;">';
                                                foreach ($errors as $error) {
                                                    echo $error . "<br>";
                                                }
                                                echo '</div>';
                                            }
                                            ?>
                                            <button type="submit" class="btn btn-primary mr-2">Submit</button>
                                            <button type="reset" class="btn iq-bg-danger">Cancel</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>

    <?php include 'footer.php'; ?>
</body>

</html>
