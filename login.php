<?php
session_start();

include_once("./library.php");

//Connect to database
$db = new mysqli($SERVER, $USERNAME, $PASSWORD, $DATABASE);
if ($db->connect_error):
	die ("Could not connect to db: " . $db->connect_error);
endif;

//Read POST/whatever array here to get login info
//Set username and password in $user and $pass or whatever the form submission form passes
$user = $_POST['username'];
$pass = $_POST['password'];
$name = "unset - ERROR";

//Form the input to compare if login success
$input = $user . " " . $pass;
$success = false;

//Run a query of all the data in the Users table as a way to prevent SQL injection
//This method prevents SQL injection because you're not using $user or $pass in the DB query
$query = "SELECT * FROM Users ";
$result = mysqli_query($db, $query);
if (!$result) {
	printf("Error: %s\n", mysqli_error($db));
	exit();
}

//Loop through the $result of all usernames and checks of username and password set matches
foreach($result as $row) {
	$loginSet = $row['username'] . " " . $row['password'];
	if(strcmp($input, $loginSet) == 0) {
		$success = true;
		$name = $row["name"];
	}
}

if ($success) {
	$_SESSION['name'] = $name;
	$_SESSION['username'] = $user;
	echo "Login Success" . " |||||| $name";
	header("Location: login.html"); //Either redirect to success page or make this page be success
}
else {
	echo "Login Fail";
	header("Location: login.html"); //Redirect to fail page
}

/*
To make a page redirect to the login page if a user isn't logged in copy and paste this at the top:
session_start();
if(!isset($_SESSION['name'])) {
	header("Location: login.html");
}
*/
?>