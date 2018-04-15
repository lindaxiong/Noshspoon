<?php
require_once 'library.php';
$connection = new mysqli($hostname, $username, $password, $database);
if ($connection->connect_error) {
    die($connection->connect_error);
}

if (isset($_POST['username']) && isset($_POST['password'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $query = "SELECT * FROM Users WHERE username='$username'";
    $result = $connection->query($query);
    // 0 is username, 1 is full name, 2 is password hash
    if (!$result) {
        die($connection->error);
    } elseif ($result->num_rows) {
        $row = $result->fetch_array(MYSQLI_NUM);
        $result->close();
        $token = hash('sha256', $password);
        if ($token == $row[2]) { 
            session_start();
            $_SESSION['username'] = $username;
            $_SESSION['usertype'] = $row[3]; //grab whether admin or not
            $_SESSION['token'] = $token;
            header('Location:index.php'); // Right password, go to dashbroad
        } else {
            header('Location:index.php'); // Wrong password, go back to index page
        }
    } else {
        header('Location:index.php'); // invalid input, go back to index page
    }
} else {
    header('Location:index.php'); // invalid input, go back to index page
}
mysqli_close($connection);
