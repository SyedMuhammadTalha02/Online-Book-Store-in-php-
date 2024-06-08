<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User List</title>
</head>
<body>
    <?php 
        include 'header.php';
        include 'config.php';
    ?>

    <div id="content-page" class="content-page">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12">
                    <div class="iq-card">
                        <div class="iq-card-header d-flex justify-content-between">
                            <div class="iq-header-title">
                                <h4 class="card-title">User List</h4>
                            </div>
                        </div>
                        <div class="iq-card-body">
                            <div class="table-responsive">
                                <div class="row justify-content-between">
                                    <div class="col-sm-12 col-md-6">
                                        <div id="user_list_datatable_info" class="dataTables_filter">
                                            <form class="mr-3 position-relative">
                                                <div class="form-group mb-0">
                                                    <input type="search" class="form-control" id="exampleInputSearch" placeholder="Search" aria-controls="user-list-table">
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-6">
                                        <div class="user-list-files d-flex float-right">
                                            <a class="iq-bg-primary" href="add_user.php">ADD USER</a>
                                        </div>
                                    </div>
                                </div>
                                <table id="user-list-table" class="table table-striped table-bordered mt-4" role="grid" aria-describedby="user-list-page-info">
                                    <thead>
                                        <tr>
                                            <th>Profile</th>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Password</th>
                                            <th>Role</th>
                                            <th>Address</th>
                                            <th>Join Date</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        // Perform a SELECT query to fetch user data from the database
                                        $sql = "SELECT * FROM users";
                                        $result = $con->query($sql);

                                        if ($result->num_rows > 0) {
                                            while ($row = $result->fetch_assoc()) {
                                                // Extract user data
                                                $profilePic = $row['profile_pic'];
                                                $name = $row['user_name'];
                                                $email = $row['user_email'];
                                                $password = $row['user_password'];
                                                $role = $row['user_role'];
                                                $address = $row['user_address'];
                                                $joinDate = $row['created_at'];

                                                // Output the user data in the table row
                                                echo '<tr>
                                                        <td class="text-center"><img class="rounded img-fluid avatar-40" src="' . $profilePic . '" alt="Profile"></td>
                                                        <td>' . $name . '</td>
                                                        <td>' . $email . '</td>
                                                        <td>' . $password . '</td>
                                                        <td>' . $role . '</td>
                                                        <td>' . $address . '</td>
                                                        <td>' . $joinDate . '</td>
                                                        
                                                        <td>
                                                           <div class="flex align-items-center list-user-action">
                                                              
                                                           <a href="update_user.php?id=' . $row['user_id'] . '" class="iq-bg-primary" data-toggle="tooltip" data-placement="top" title="Edit"><i class="ri-pencil-line"></i></a>
                                                              <a href="delete_user.php?id=' . $row['user_id'] . '"data-toggle="tooltip" data-placement="top" title="Delete" ><i class="ri-delete-bin-line"></i></a>
                                                           </div>
                                                        </td>
                                                     </tr>';
                                            }
                                        } else {
                                            // Handle the case when there are no users in the database
                                            echo '<tr><td colspan="7">No users found.</td></tr>';
                                        }

                                        // Close the database connection
                                        $con->close();
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                            <div class="row justify-content-between mt-3">
                                <div id="user-list-page-info" class="col-md-6">
                                    <!-- You can show pagination or additional information here if needed -->
                                </div>
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
