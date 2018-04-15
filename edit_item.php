<?php

session_start();
if (isset($_SESSION['username'])) {
    require_once 'library.php';
    date_default_timezone_set('UTC');
    $connection = new mysqli($hostname, $username, $password, $database);
    if ($connection->connect_error) {
        die($connection->connect_error);
    }
    $name = $connection->real_escape_string($_POST['itemName']);
    $price = $_POST['itemPrice'];
    $picture = $connection->real_escape_string($_POST['itemPicture']);
    $quantity = $_POST['itemQuantity'];
    $type = $connection->real_escape_string($_POST['itemType']);
    $description = $connection->real_escape_string($_POST['itemDescription']);
    $username = $_SESSION['username'];
    $item_id = $_POST['itemId'];
    $query = "UPDATE Items SET item_name = '$name', price = '$price', picture = '$picture', quantity = '$quantity', type = '$type', description = '$description' WHERE item_id = '$item_id' AND list_user = '$username'";
    if ($connection->query($query)) {
        echo 'success';
    } else {
        echo 'failed';
    }
    mysqli_close($connection);
} else {
    echo 'not_logged_in';
}
