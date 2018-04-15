<?php

session_start();
if (isset($_SESSION['username'])) {
    require_once 'library.php';
    date_default_timezone_set('UTC');
    $connection = new mysqli($hostname, $username, $password, $database);
    if ($connection->connect_error) {
        die($connection->connect_error);
    }
    $title = $connection->real_escape_string($_POST['title']);
    $score = $_POST['score'];
    $content = $connection->real_escape_string($_POST['content']);
    $item_id = $_POST['item_id'];
    $username = $_SESSION['username'];
    $query = "INSERT INTO Reviews (title, score, content, item_id, username) VALUES ('$title', '$score', '$content', '$item_id', '$username')";
    if ($connection->query($query)) {
        echo 'success';
    } else {
        echo 'failed';
    }
    mysqli_close($connection);
} else {
    echo 'not_logged_in';
}
