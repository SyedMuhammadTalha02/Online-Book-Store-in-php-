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
                              <h4 class="card-title">User Messages</h4>
                           </div>
                        </div>
                        <div class="iq-card-body">
                           <div id="table" class="table-editable">
                              
                              <table class="table table-bordered table-responsive-md table-striped text-center">
                                 <thead>
                                    <tr>
                                       <th>Name</th>
                                       <th>Email</th>
                                       <th>Subject</th>
                                       <th>Message</th>
                                    </tr>
                                 </thead>
                                 
                                    <tbody>
                                     <?php
                                     
                                     $sql = "SELECT * FROM contact_us_messages";
                                     $result = $con->query($sql);
                                    
                                     if ($result->num_rows > 0) {
                                         while ($row = $result->fetch_assoc()) {
                                             echo '<tr>';
                                             echo '<td contenteditable="true">' . $row['sender_name'] . '</td>';
                                             echo '<td contenteditable="true">' . $row['sender_email'] . '</td>';
                                             echo '<td contenteditable="true">' . $row['subject'] . '</td>';
                                             echo '<td contenteditable="true">' . $row['message'] . '</td>';
                                             echo '<td>';
                                             echo '<span class="table-remove"><button type="button" class="btn iq-bg-danger btn-rounded btn-sm my-0">Remove</button></span>';
                                             echo '</td>';
                                             echo '</tr>';
                                         }
                                     } else {
                                         echo '<tr><td colspan="4">No messages found.</td></tr>';
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