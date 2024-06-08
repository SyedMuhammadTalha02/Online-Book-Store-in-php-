<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Competition</title>
</head>

<body>

    <?php
    include "Layout/header.php";
    ?>

    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title text-center mb-4">Competition Result</h5>
                        <form method="post">
                            <div class="form-group">
                                <input name="id" type="text" class="form-control" id="exampleInputName" placeholder="Please Enter Your Id" required>
                            </div>
                            <button type="submit" name="submit" class="btn btn-primary btn-block">Enter</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php
    // Include your database connection code here
    include 'config.php';

    if (isset($_POST['submit'])) {
        $id = $_POST['id'];

        // Query to retrieve the winner's name based on the provided ID
        $query = "SELECT * FROM winners";

        // Execute the query using prepared statements
        $stmt = $con->prepare($query);
        $stmt->execute();

        // Fetch the result
        $result = $stmt->get_result();

        // Check if a winner was found
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $winnerName = $row['Winner_Name'];
            echo "<div class='container mt-5'>";
            echo "<h4 class='text-center'>Competition Result</h4>";
            echo "<table class='table'>";
            echo "<thead><tr><th>Winner's Name</th></tr></thead>";
            echo "<tbody><tr><td>$winnerName</td></tr></tbody>";
            echo "</table>";
            echo "</div>";
        } else {
            echo "<div class='container mt-5'>";
            echo "<h4 class='text-center'>No winner found for the provided ID.</h4>";
            echo "</div>";
        }
    }
    ?>

    <?php
    include "Layout/footer.php";
    ?>
</body>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.0.3/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</html>
