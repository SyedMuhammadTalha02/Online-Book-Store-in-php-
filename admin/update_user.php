<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update User</title>
</head>
<body>
    <?php 
        include 'header.php';
        include 'config.php';
         
        if (isset($_GET['id'])) {
            $userId = $_GET['id'];
            $sql = "SELECT * FROM users WHERE user_id = $userId";
            $result = $con->query($sql);
            print_r($result);
            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                // Extract user data
                $name = $row['user_name'];
                $email = $row['user_email'];
                $password = $row['user_password'];
                $role = $row['user_role'];
                $address = $row['user_address'];
                $profilePic  = $row['profile_pic '];
                // Add other fields as needed
            } else {
                echo "User not found.";
                // Redirect or handle the case where the user ID is invalid
            }
        } else {
            echo "User ID not provided.";
            // Redirect or handle the case where the user ID is missing
        }
    //     header("Location: user_list.php");
    // exit();
    ?>
    
    <div id="content-page" class="content-page">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12">
                    <div class="iq-card">
                        <div class="iq-card-header">
                            <h4 class="card-title">Update User</h4>
                        </div>
                        <div class="iq-card-body">
                        <form action="update_user_process.php" method="POST" enctype="multipart/form-data">
                                <input type="hidden" name="user_id" value="<?php echo $userId; ?>">
                                <div class="form-group">
                                    <label for="uname">User Name:</label>
                                    <input type="text" class="form-control" id="uname" name="name" value="<?php echo $name; ?>">
                                </div>
                                <div class="form-group">
                                    <label for="uemail">User Email:</label>
                                    <input type="email" class="form-control" id="uemail" name="email" value="<?php echo $email; ?>">
                                </div>
                                <div class="form-group">
                                    <label for="upassword">User Password:</label>
                                    <input type="password" class="form-control" id="upassword" name="pass" value="<?php echo $password; ?>">
                                </div>
                                <div class="form-group">
                                    <label for="urole">User Role:</label>
                                    <select class="form-control" id="urole" name="role">
                                        <option <?php if ($role == 'Admin') echo 'selected'; ?>>Admin</option>
                                        <option <?php if ($role == 'User') echo 'selected'; ?>>User</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                 <label for="uprofile">Profile Picture:</label>
                                 <br>
                                 <?php echo $profilePic; ?>
                                    <img src="<?php echo $profilePic; ?>" alt="Current Profile Picture" class="img-fluid rounded" width="150">
                                </div>

                                <div class="form-group">
                                    <label for="uprofile">Profile Picture:</label>
                                    <input type="file" class="form-control-file" id="uprofile" name="profile_pic" >
                                </div>
                                <div class="form-group col-sm-12">
                                     <label for="uaddress">Address:</label>
                                      <textarea class="form-control" id="uaddress" name="address" rows="4" ><?php echo $address; ?></textarea>
                                </div>

                                <!-- Add other fields as needed -->
                                <button type="submit" class="btn btn-primary">Update</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php

?>

    <?php 
        include 'footer.php';
    ?>
</body>
</html>
