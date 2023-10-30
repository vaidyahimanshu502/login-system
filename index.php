<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | System</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container my-5">
        <h1 class="text-center text-info">Login | System</h1>
        <a href="./create.php" class="btn btn-primary">Sign-Up</a>
       <table class="table caption-top">
          <caption><h2 class="text-success">List of users</h2></caption>
            <thead>
                 <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Name</th>
                    <th scope="col">Email</th>
                    <th scope="col">Phone</th>
                    <th scope="col">Address</th>
                    <th scope="col">Actions</th>
                </tr>
             </thead>
             <tbody>
                 <?php 
                     $servername = 'localhost';
                     $username = 'root';
                     $password = '';
                     $dbname = 'login-system';

                     // Making connection
                     $connection = new mysqli($servername, $username, $password, $dbname);

                     // Checking for connection 
                     if($connection->connect_error) {
                        die("Connection failed: " . $connection->connect_error);
                     }
                     $sql_query = "SELECT * FROM users";
                     $resul = $connection->query($sql_query);

                     if(!$resul) {
                        die("Invalid query: " . $connection->error);
                     }

                    while( $row = $resul->fetch_assoc()) {
                        echo '
                        <tr>
                            <td>'. $row['id'] .'</td>
                            <td>'. $row['name'] .'</td>
                            <td>'. $row['email'] .'</td>
                            <td>'. $row['phone'] .'</td>
                            <td>'. $row['address'] .'</td>
                            <td>
                               <a href="edit.php?id='. $row['id'] .'" class="btn btn-primary btn-sm">Edit</a>
                               <a href="delete.php?id='. $row['id'] .'" class="btn btn-danger btn-sm">Delete</a>
                            </td>
                        </tr>
                    ';
                    }
                 ?>
             </tbody>
        </table>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>