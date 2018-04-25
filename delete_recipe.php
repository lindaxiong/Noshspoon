<?php

session_start();
if (isset($_SESSION['username'])) {
    require_once 'library.php';
    date_default_timezone_set('UTC');
    $connection = new mysqli($hostname, $username, $password, $database);
    if ($connection->connect_error) {
        die($connection->connect_error);
    }
    if (!empty($_POST['recipe'])) {
        $id = $_POST['recipe'];
        //Delete any recipe ingredients that pointed to the recipe
        $query = "DELETE FROM Ingredients WHERE r_id='$id'";
        $result = $connection->query($query);
        if (!$result) {
            die($connection->error);
        }
        //Delete the actual recipe
        $query = "DELETE FROM Recipe WHERE r_id = '$id'";
        $result = $connection->query($query);
        if (!$result) {
            die($connection->error);
        }
        header("Location: drop_recipe.php");
    } else {
        echo 'failed';
    }
    mysqli_close($connection);
} else {
    echo 'not_logged_in';
}
?>