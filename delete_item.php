<?php

session_start();
if (isset($_SESSION['username'])) {
    require_once 'library.php';
    date_default_timezone_set('UTC');
    $connection = new mysqli($hostname, $username, $password, $database);
    if ($connection->connect_error) {
        die($connection->connect_error);
    }
    $username = $_SESSION['username'];
    $id = $_POST['item_id'];
    $query = "DELETE FROM Items WHERE item_id = '$id' AND list_user = '$username'";
    if ($connection->query($query)) {
        echo 'success';
    } else {
        echo 'failed';
    }
    mysqli_close($connection);
} else {
    echo 'not_logged_in';
}
