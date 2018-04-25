<?php

session_start();
if (isset($_SESSION['username'])) {
    require_once 'library.php';
    date_default_timezone_set('UTC');
    $connection = new mysqli($hostname, $username, $password, $database);
    if ($connection->connect_error) {
        die($connection->connect_error);
    }
    if (!empty($_POST['item'])) {
        $id = $_POST['item'];
        //First delete reviews of the item
        $query = "DELETE FROM Reviews WHERE item_id='$id'";
        $result = $connection->query($query);
        if (!$result) {
            die($connection->error);
        }
        //Delete any recipe ingredients that pointed to the item
        $query = "DELETE FROM Ingredients WHERE item_id='$id'";
        $result = $connection->query($query);
        if (!$result) {
            die($connection->error);
        }
        //Delete any carts that held any of the item
        $query = "DELETE FROM Cart WHERE item_id='$id'";
        $result = $connection->query($query);
        if (!$result) {
            die($connection->error);
        }
        //Delete the actual item
        $query = "DELETE FROM Items WHERE item_id = '$id'";
        $result = $connection->query($query);
        if (!$result) {
            die($connection->error);
        }
        header("Location: drop_item.php");
    } else {
        echo 'failed';
    }
    mysqli_close($connection);
} else {
    echo 'not_logged_in';
}
?>