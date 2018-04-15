<?php

require_once 'post.php';
if (isset($_POST['item_id'])) {
    session_start();
		if(isset($_SESSION['username'])) {
			$username = $_SESSION['username'];
			$id = $_POST['item_id'];
			$data = array('cart', $username, $id);
			post($data);
		} else {
			echo 'not_logged_in';
		}
}
