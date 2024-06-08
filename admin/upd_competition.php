<?php
include 'header.php';
include 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['update_competition'])) {
        // Update Competition
        $competition_id = $_POST['competition_id'];
        $title = $_POST['title'];
        $description = $_POST['description'];
        $start_date = $_POST['start_date'];
        $end_date = $_POST['end_date'];
        $is_active = $_POST['is_active'];

        // Perform SQL UPDATE to update the competition in the database
        $sql = "UPDATE competitions
                SET title = ?, description = ?, start_date = ?, end_date = ?, is_active = ?
                WHERE competition_id = ?";
        $stmt = $con->prepare($sql);

        if ($stmt) {
            // Bind parameters and execute the statement
            $stmt->bind_param('ssssii', $title, $description, $start_date, $end_date, $is_active, $competition_id);

            if ($stmt->execute()) {
                echo '<script>window.location.href = "competition.php";</script>';
            } else {
                // Handle the error if the update fails
                echo "Error updating competition: " . $stmt->error;
            }

            // Close the statement
            $stmt->close();
        } else {
            // Handle the error if the statement preparation fails
            echo "Error preparing statement: " . $con->error;
        }
    } else {
        echo "Invalid request.";
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id'])) {
    $competition_id = $_GET['id'];

    // Fetch competition details from the database
    $sql = "SELECT * FROM competitions WHERE competition_id = ?";
    $stmt = $con->prepare($sql);

    if ($stmt) {
        $stmt->bind_param('i', $competition_id);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows === 1) {
            $row = $result->fetch_assoc();
        } else {
            echo "Competition not found.";
            exit; // Exit script if the competition is not found
        }

        $stmt->close();
    } else {
        echo "Error preparing statement: " . $con->error;
        exit; // Exit script on error
    }
} else {
    echo "Invalid request.";
    exit; // Exit script for invalid requests
}

?>

<div id="content-page" class="content-page">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="iq-card">
                    <div class="iq-card-header d-flex justify-content-between">
                        <div class="iq-header-title">
                            <h4 class="card-title">Edit Competition</h4>
                        </div>
                    </div>
                    <div class="iq-card-body">
                        <form method="post">
                            <input type="hidden" name="competition_id" value="<?php echo $row['competition_id']; ?>">
                            <div class="form-group">
                                <label>Title:</label>
                                <input type="text" class="form-control" name="title" value="<?php echo $row['title']; ?>">
                            </div>
                            <div class="form-group">
                                <label>Description:</label>
                                <textarea class="form-control" rows="4" name="description"><?php echo $row['description']; ?></textarea>
                            </div>
                            <div class="form-group">
                                <label>Start Date:</label>
                                <input type="date" class="form-control" name="start_date" value="<?php echo $row['start_date']; ?>">
                            </div>
                            <div class="form-group">
                                <label>End Date:</label>
                                <input type="date" class="form-control" name="end_date" value="<?php echo $row['end_date']; ?>">
                            </div>
                            <div class="form-group">
                                <label>Active:</label>
                                <input type="number" min="0" max="1" class="form-control" name="is_active" value="<?php echo $row['is_active']; ?>">
                            </div>
                            <button type="submit" class="btn btn-primary" name="update_competition">Update Competition</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
include 'footer.php';
?>
