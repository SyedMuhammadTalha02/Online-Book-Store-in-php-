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
                        <h5 class="card-title text-center mb-4">Registration</h5>
                        <script>
                            function validateForm() {
                                var name = document.getElementById("exampleInputName").value;
                                var email = document.getElementById("exampleInputEmail").value;

                                if (name == "" || email == "") {
                                    alert("Both name and email are required fields");
                                    return false;
                                }

                                return true;
                            }
                        </script>
                        <form method="post" onsubmit="return validateForm()">
                            <input type="hidden">
                            <div class="form-group">
                                <label for="exampleInputName">Name</label>
                                <input name="name" type="text" class="form-control" id="exampleInputName" placeholder="Enter Your Name" required>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail">Email</label>
                                <input name="email" type="email" class="form-control" id="exampleInputEmail" placeholder="example@gmail.com" required>
                            </div>
                            <div class="form-group">
                                <label for="essayContent">Essay Content</label>
                                <textarea name="essay_content" class="form-control" id="essayContent" placeholder="Enter your essay content" required></textarea>
                            </div>
                            <button type="submit" name="submit" class="btn btn-primary btn-block">Submit</button>
                        </form>

                        <?php
                        include 'config.php';

                        if (isset($_POST['submit'])) {
                            $competition_id = $_GET['_competition_id'];
                            $result_id = rand(1000, 99999);
                            $name = $_POST['name'];
                            $email = $_POST['email'];
                            $essay_content = $_POST['essay_content'];
                        
                            // Check if the email already exists
                            $check_email_query = "SELECT * FROM competition_registrations WHERE user_email = '$email'";
                            $check_result = $con->query($check_email_query);
                        
                            if ($check_result->num_rows > 0) {
                                // Email already exists, show an error message
                                echo "Error: Email already exists.";
                            } else {
                                // Insert data into the database
                                $sql = "INSERT INTO `competition_registrations`(`competition_id`, `result_id`, `user_name`, `user_email`, `essay_content`) VALUES ('$competition_id','$result_id','$name','$email','$essay_content')";
                                $result = $con->query($sql);
                        
                                if ($result) {
                                    echo '<script>
                                        alert("Your ID is ' . $result_id . '");
                                    </script>';
                                } else {
                                    echo "Error: " . $sql . "<br>" . $con->error;
                                }
                            }
                        }
                        
                        ?>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php
    include "Layout/footer.php";
    ?>
</body>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.0.3/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</html>