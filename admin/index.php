<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
   
   if ($_SESSION['user_role'] !== "Admin") {
    header('Location: ../web/sign_in.php');
    exit(); // Make sure to exit after a header redirect
} else {
    echo '<script>window.location.href = "/e-project/admin/dashboard.php";</script>';
    exit(); // Also exit after the JavaScript redirect
}

    
    include 'config.php' ;
    include 'header.php' ;
    ?>
    <div class='mt-5'>
        
    </div>
    

<?php
        include "footer.php";
    ?>
</body>
</html>