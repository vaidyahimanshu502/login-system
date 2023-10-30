<?php
   session_start();
   if(isset($_SESSION['user'])) {
      header('location: index.php.php');
   }
   $error_message ='';
   if($_POST) {
     $servernam = 'localhost';
     $username = 'root';
     $password = '';
     $dbname = 'login-system';

     $connection = new mysqli($servernam, $username, $password, $dbname);

      $username = $_POST["username"];
      $password = $_POST["password"];
      

        $query = "SELECT password FROM users WHERE email=?";
        $stmt = $connection->prepare($query);
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        $hashed_pass = $row['password'];
      
      $query = 'SELECT * FROM users WHERE users.email="'. $username .'" AND users.password="'. password_verify($password, $hashed_pass) .'" LIMIT 1';
      $result = $connection->query($query);

     if($result) {
          $user = $result->fetch_assoc();
          $_SESSION['user'] = $user;
          header('location: index.php');
     } else $error_message = "Invalid Username/password!";
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | Page</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
</head>
<body>
<div class="container my-5">
            <h1 class="text-center text-success">LogIn-User</h1>
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
                            <label for="email" class="form-label">Email:</label>
                            <input type="text" name='username' class="form-control" id="email">
                    </div>
                    <div class="mb-3">
                            <label for="password" class="form-label">Password:</label>
                            <input type="password" name='password' class="form-control" id="password">
                    </div>
                    <button type="submit" class="btn btn-primary">Log-In</button>
            </form>
        </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>