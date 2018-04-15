<?php

require_once 'post.php';
if (isset($_POST['item_id'])) {
    session_start();
    $username = $_SESSION['username'];
    $id = $_POST['item_id'];
    $data = array('remove_cart', $username, $id);
    post($data);
}
