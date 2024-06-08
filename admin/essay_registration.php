<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Competition Management</title>
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
                                <h4 class="card-title">Essay Registration List</h4>
                            </div>
                        </div>
                        <div class="iq-card-body">
                            <div class="table-responsive">
                                <table class="data-tables table table-striped table-bordered" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Competition ID</th>
                                            <th>Result ID</th>
                                            <th>User Name</th>
                                            <th>User Email</th>
                                            <th>Essay Content</th>
                                            
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        // Fetch the list of competition registrations from the database
                                        $sql = "SELECT `competition_registration_id`, `competition_id`, `result_id`, `user_name`, `user_email`, `essay_content` FROM `competition_registrations` WHERE 1";
                                        $result = $con->query($sql);

                                        if ($result !== false) {
                                            if ($result->num_rows > 0) {
                                                $count = 1;
                                                while ($row = $result->fetch_assoc()) {
                                                    echo '<tr>
                                        <td>' . $count++ . '</td>
                                        <td>' . $row['competition_id'] . '</td>
                                        <td>' . $row['result_id'] . '</td>
                                        <td>' . $row['user_name'] . '</td>
                                        <td>' . $row['user_email'] . '</td>
                                        <td>' . $row['essay_content'] . '</td>

                                    </tr>';
                                                }
                                            } else {
                                                echo '<tr><td colspan="7">No competition registrations found.</td></tr>';
                                            }
                                        } else {
                                            // Handle the error
                                            die("Error executing query: " . $con->error);
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
    </div>
    <?php
    include 'footer.php';
    ?>
</body>

</html>