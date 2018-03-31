<?php
require_once('post.php');
if (isset($_POST['new-username']) && isset($_POST['new-password']) && isset($_POST['name'])){
	$username = $_POST['new-username'];
	$name = $_POST['name'];
	$password = $_POST['new-password'];
	$data = array('user', $username, $name, $password);
	post($data);
}
?>