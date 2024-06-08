<?php
include 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id'])) {
    $competition_id = $_GET['id'];

    // Delete the competition from the database
    $sql = "DELETE FROM competitions WHERE competition_id = ?";
    $stmt = $con->prepare($sql);

    if ($stmt) {
        $stmt->bind_param('i', $competition_id);

        if ($stmt->execute()) {
            echo '<script>window.location.href = "competition.php";</script>';
        } else {
            echo "Error deleting competition: " . $stmt->error;
        }

        $stmt->close();
    } else {
        echo "Error preparing statement: " . $con->error;
    }
} else {
    echo "Invalid request.";
}
?>
