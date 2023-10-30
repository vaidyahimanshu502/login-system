<?php
if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        $servername = 'localhost';
        $username = 'root';
        $password = '';
        $dbname = 'login-system';

        //connection
        $connection = new mysqli($servername, $username, $password, $dbname);

        if ($connection->connect_error) {
            die("Connection failed: " . $connection->connect_error);
        }

        $query = "DELETE FROM users WHERE id = $id";
        if ($connection->query($query) === TRUE) {
            echo 'User deleted successfully!';
            header("location: ./index.php");
            exit;
        } else {
            echo "Error deleting record: " . $connection->error;
        }
    } else {
        echo "No user ID provided.";
    }
}
?>
