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
        
        

        // Handle form submission to add a new competition
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_competition'])) {
            $title = $_POST['title'];
            $description = $_POST['description'];
            $start_date = $_POST['start_date'];
            $end_date = $_POST['end_date'];
            $is_active = isset($_POST['is_active']) ? 1 : 0;

            // Insert the new competition into the database
            $sql = "INSERT INTO competitions (title, description, start_date, end_date, is_active) 
                    VALUES (?, ?, ?, ?, ?)";
            $stmt = $con->prepare($sql);

            if ($stmt) {
                // Bind parameters and execute the statement
                $stmt->bind_param('sssii', $title, $description, $start_date, $end_date, $is_active);

                if ($stmt->execute()) {
                    // Competition added successfully
                    // You can redirect or display a success message here
                } else {
                    // Handle the error if the insertion fails
                    echo "Error adding competition: " . $stmt->error;
                }

                // Close the statement
                $stmt->close();
            } else {
                // Handle the error if the statement preparation fails
                echo "Error preparing statement: " . $con->error;
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
                                <h4 class="card-title">Add Competition</h4>
                            </div>
                        </div>
                        <div class="iq-card-body">
                            <form method="post">
                                <div class="form-group">
                                    <label>Title:</label>
                                    <input type="text" class="form-control" name="title" required>
                                </div>
                                <div class="form-group">
                                    <label>Description:</label>
                                    <textarea class="form-control" rows="4" name="description" required></textarea>
                                </div>
                                <div class="form-group">
                                    <label>Start Date:</label>
                                    <input type="date" class="form-control" name="start_date" required>
                                </div>
                                <div class="form-group">
                                    <label>End Date:</label>
                                    <input type="date" class="form-control" name="end_date" required>
                                </div>
                                <div class="form-group">
                                    <label>Active:</label>
                                    <input type="checkbox" class="form-check-input" name="is_active" value="1">
                                </div>
                                <button type="submit" class="btn btn-primary" name="add_competition">Add Competition</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- List of Competitions -->
    <div id="content-page" class="content-page">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12">
                    <div class="iq-card">
                        <div class="iq-card-header d-flex justify-content-between">
                            <div class="iq-header-title">
                                <h4 class="card-title">Competition List</h4>
                            </div>
                        </div>
                        <div class="iq-card-body">
                            <div class="table-responsive">
                                <table class="data-tables table table-striped table-bordered" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Title</th>
                                            <th>Description</th>
                                            <th>Start Date</th>
                                            <th>End Date</th>
                                            <th>Active</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                            // Fetch the list of competitions from the database
                                            $sql = "SELECT * FROM competitions";
                                            $result = $con->query($sql);
                                            if ($result !== false) {
                                              
                                            if ($result->num_rows > 0) {
                                                $count = 1;
                                                while ($row = $result->fetch_assoc()) {
                                                    echo '<tr>
                                                            <td>' . $count++ . '</td>
                                                            <td>' . $row['title'] . '</td>
                                                            <td>' . $row['description'] . '</td>
                                                            <td>' . $row['start_date'] . '</td>
                                                            <td>' . $row['end_date'] . '</td>
                                                            <td>' . ($row['is_active'] ? 'Yes' : 'No') . '</td>
                                                            <td>
                                                            <a href="upd_competition.php?id=' . $row['competition_id'] . '" data-toggle="tooltip" data-placement="top" title="Edit"><i class="ri-pencil-line"></i></a>
                                                                <a href="del_competition.php?id=' . $row['competition_id'] . '" data-toggle="tooltip" data-placement="top" title="Delete"><i class="ri-delete-bin-line"></i></a>
                                                            </td>
                                                        </tr>';
                                                }
                                            } else {
                                                echo '<tr><td colspan="7">No competitions found.</td></tr>';
                                            }
                                        }else {
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

    <?php
        include 'footer.php';
    ?>
</body>
</html>
