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
        // $token = md5($password); // tested with md5 hash but did not work. later on, should use sha256 instead of md5 anyways
        if ($password == $row[2]) {  // change this back to $token after get that work
            session_start();
            $_SESSION['username'] = $username;
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
