<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order List</title>
</head>

<body>
    <?php
    include 'header.php';
    include 'config.php';

    // Handle status toggling
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['status'])) {
        $orderIDToUpdate = $_POST['order_id'];
        $newStatus = $_POST['status'];

        // Perform an UPDATE query to update the status in the database
        $updateSql = "UPDATE `orders` SET `status` = ? WHERE `order_id` = ?";
        $updateStmt = $con->prepare($updateSql);

        if ($updateStmt) {
            // Bind parameters and execute the update statement
            $updateStmt->bind_param('ii', $newStatus, $orderIDToUpdate);

            if ($updateStmt->execute()) {
                // Status updated successfully
                // You can redirect or display a success message here
            } else {
                // Handle the error if the update fails
                echo "Error updating status: " . $updateStmt->error;
            }

            // Close the update statement
            $updateStmt->close();
        } else {
            // Handle the error if the statement preparation fails
            echo "Error preparing update statement: " . $con->error;
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
                                <h4 class="card-title">Order List</h4>
                            </div>
                        </div>
                        <div class="iq-card-body">
                            <div class="table-responsive">
                                <table id="order-list-table" class="table table-striped table-bordered mt-4" role="grid" aria-describedby="order-list-page-info">
                                    <thead>
                                        <tr>
                                            <th>Order ID</th>
                                            <th>User ID</th>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Mobile</th>
                                            <th>Address</th>
                                            <th>City</th>
                                            <th>ZIP Code</th>
                                            <th>Total Amount</th>
                                            <th>Status</th> <!-- Updated Status column with dropdown -->
                                            <th>Action</th> <!-- Updated Action column -->
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        // Perform a SELECT query to fetch order data from the database
                                        $sql = "SELECT * FROM `order_details` o JOIN orders od ON o.order_id = od.order_id JOIN cart p ON p.id = o.product_id;";
                                        $result = $con->query($sql);

                                        if ($result !== false && $result->num_rows > 0) {
                                            while ($row = $result->fetch_assoc()) {
                                                // Extract order data
                                                $orderID = $row['order_id'];
                                                $userID = $row['user_id'];
                                                $name = $row['name'];
                                                $email = $row['email'];
                                                $mobile = $row['mobile'];
                                                $address = $row['address'];
                                                $city = $row['city'];
                                                $zipCode = $row['zip_code'];
                                                $totalAmount = $row['total_amount'];
                                                $status = $row['status'];

                                                // Define possible status values
                                                $statusOptions = ['Pending', 'Confirmed', 'Delivered'];

                                                // Output the order data in the table row, including the buttons
                                                echo '<tr>
                <td>' . $orderID . '</td>
                <td>' . $userID . '</td>
                <td>' . $name . '</td>
                <td>' . $email . '</td>
                <td>' . $mobile . '</td>
                <td>' . $address . '</td>
                <td>' . $city . '</td>
                <td>' . $zipCode . '</td>
                <td>' . $totalAmount . '</td>
                <td>
                    <form method="post">
                        <input type="hidden" name="order_id" value="' . $orderID . '">
                        <select name="status" onchange="this.form.submit()">
                            <option value="0" ' . ($status == 0 ? 'selected' : '') . '>Pending</option>
                            <option value="1" ' . ($status == 1 ? 'selected' : '') . '>Confirmed</option>
                            <option value="2" ' . ($status == 2 ? 'selected' : '') . '>Delivered</option>
                        </select>
                    </form>
                </td>
                <td>
                    <form method="post">
                        <input type="hidden" name="order_id" value="' . $orderID . '">
                        <button class="btn btn-primary" type="submit" name="view_order">View Order</button>
                    </form>
                </td>
             </tr>';
                                            }
                                        } else {
                                            // Handle the case when there are no orders in the database
                                            echo '<tr><td colspan="11">No orders found.</td></tr>';
                                        }

                                        // Close the database connection
                                        $con->close();

                                        ?>
                                    </tbody>
                                </table>
                            </div>
                            <div class="row justify-content-between mt-3">
                                <div id="order-list-page-info" class="col-md-6">
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