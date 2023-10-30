<?php

   $id = $name = $email = $phone = $address = '';

   $successMsg = '';
   $errorMsg = '';

   $servername = 'localhost';
   $username = 'root';
   $password = '';
   $dbname = 'login-system';

   $connection = new mysqli($servername, $username, $password, $dbname);

   if ($connection->connect_error) {
        $errorMsg =  $connection->connect_error;
   }

   if ($_SERVER['REQUEST_METHOD'] == 'GET') {
        if (!isset($_GET['id'])) {
            header("location: ./index.php");
            exit;
        }
        $id = $_GET['id'];
       
        $query = "SELECT * FROM users WHERE id = $id ";
        $result = $connection->query($query);
        $row = $result->fetch_assoc();

        if (!$result) {
            $errorMsg =  $connection->error;
        }

        $name = $row['name'];
        $email = $row['email'];
        $phone = $row['phone'];
        $address = $row['address'];

   } else if ($_SERVER['REQUEST_METHOD'] == "POST") {
       if (isset($_POST['id'])) $id = $_POST['id'];
       $name = $_POST['name'];
       $email = $_POST['email'];
       $phone = $_POST['phone'];
       $address = $_POST['address'];

       $query = "UPDATE users SET name='$name', email='$email', phone='$phone', address='$address' WHERE id=$id";
       $result = $connection->query($query);

       if ($result) {
           $successMsg = "User updated successfully!";
       } else {
           $errorMsg = "Error updating user: " . $connection->error;
       }
       header("location: ./index.php");
       exit;
   }
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Edit | Page </title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
</head>
<body>
<div class="container my-5">
            <h1 class="text-center text-success">Update-User</h1>
            <?php
               if(!empty($errorMsg)) {
                echo '
                  <h3 class="text-center text-danger"> '. $errorMsg .'</h3>
                ';
               }
               if(!empty($successMsg)) {
                echo '
                  <h3 class="text-center text-success"> '. $successMsg .'</h3>
                ';
               }
            ?>
            <form action="" method="POST">
                <input type="hidden" name="id" value="<?php echo $id ?>">
                    <div class="mb-3">
                            <label for="name" class="form-label">Name:</label>
                            <input type="text" name='name' value="<?php echo $name ?>" class="form-control" id="name">
                    </div>
                    <div class="mb-3">
                            <label for="email" class="form-label">Email:</label>
                            <input type="text" name='email' value="<?php echo $email ?>" class="form-control" id="email">
                    </div>
                    <div class="mb-3">
                            <label for="phone" class="form-label">Phone:</label>
                            <input type="text" name='phone' value="<?php echo $phone ?>" class="form-control" id="phone">
                    </div>
                    <div class="mb-3">
                            <label for="address" class="form-label">Address:</label>
                            <input type="text" name='address' value="<?php echo $address ?>" class="form-control" id="address">
                    </div>
                    <button type="submit" class="btn btn-primary">Update-User</button>
            </form>
        </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>