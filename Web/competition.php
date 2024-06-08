<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Compitition</title>
</head>

<body>

    <?php
    include "Layout/header.php";
    ?>

<?php
    include 'config.php';
    $sql = "SELECT * FROM competitions";
    $result = $con->query($sql);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            
            echo '
            <div class="container pb-3">
                <div class="card text-center">
                    <div class="card-body">
                        <h5 class="card-title">' . $row['title'] . '</h5>
                        <p class="card-text">' . $row['description'] . '</p>';
            
            $sql = "SELECT * FROM competitions WHERE is_active = 1";
            if ($row['is_active'] == 1) {
                echo '<a href="competition_submit.php?_competition_id=' . $row['competition_id'] . '" class="btn btn-primary">Registration Here..</a>';
            } else {
                echo '<a href="result_page.php?id=' . $row['competition_id'] . '" class="btn btn-secondary">Result</a>';
            }

            echo '</div>
                    <div class="card-footer text-muted">
                       Last Date Of Competition ' . $row['end_date'] . '
                    </div>
                </div>
            </div>
            ';
        }
    }
?>






    


    <?php
    include "Layout/footer.php";
    ?>

</body>

</html>