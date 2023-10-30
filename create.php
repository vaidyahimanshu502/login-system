<?php

$errorMsg = '';
$successMsg = '';

$servername = 'localhost';
$username = 'root';
$password = '';
$dbname = 'login-system';

$connection = new mysqli($servername, $username, $password, $dbname);

if (!$connection) {
    die("Connection failed: " . $connection->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];

    if (empty($name) || empty($email) || empty($password) || empty($phone) || empty($address)) {
        $errorMsg = "All fields are required!";
    } else {
        $query = "INSERT INTO users (name, email, password, phone, address) VALUES ('$name', '$email', '$password', '$phone', '$address')";
        $result = $connection->query($query);

        if (!$result) {
            $errorMsg = $connection->error;
        } else {
            $successMsg = 'User added successfully!';
            header("Location: /login_system/index.php");
            exit;
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign-Up | User</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
</head>
    <body>
        <div class="container my-5">
            <h1 class="text-center text-success">Register-User</h1>
            <?php
               if(!empty($errorMsg)) {
                echo '
                  <h3 class="text-center text-danger"> '. $errorMsg .'</h3>
                ';
               }
               if(!empty($successMsg)) {
                echo '
                  <h3 class="text-center text-danger"> '. $successMsg .'</h3>
                ';
               }
            ?>
            <form action="" method="POST">
                    <div class="mb-3">
                            <label for="name" class="form-label">Name:</label>
                            <input type="text" name='name' class="form-control" id="name">
                    </div>
                    <div class="mb-3">
                            <label for="email" class="form-label">Email:</label>
                            <input type="text" name='email' class="form-control" id="email">
                    </div>
                    <div class="mb-3">
                            <label for="password" class="form-label">Password:</label>
                            <input type="password" name='password' class="form-control" id="password">
                    </div>
                    <div class="mb-3">
                            <label for="phone" class="form-label">Phone:</label>
                            <input type="text" name='phone' class="form-control" id="phone">
                    </div>
                    <div class="mb-3">
                            <label for="address" class="form-label">Address:</label>
                            <input type="text" name='address' class="form-control" id="address">
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    </body>
</html>