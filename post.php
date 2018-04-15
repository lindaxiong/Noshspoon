<?php

function post($array)
{
    require_once 'library.php';
    date_default_timezone_set('UTC');
    $connection = new mysqli($hostname, $username, $password, $database);
    if ($connection->connect_error) {
        die($connection->connect_error);
    }
    $size = count($array);
    switch ($array[0]) {
        case 'user': //register a user (username, name, password hash)
        if (isset($array[1]) && isset($array[2]) && isset($array[3])) {
            $select = "SELECT * FROM Users WHERE username = '$array[1]'";
            $exists = $connection->query($select);
            $rows = $exists->num_rows;
            if ($rows == 0) {
                $hash = hash('sha256', $array[3]);
                echo $hash;
                $query = "INSERT INTO Users VALUES ('$array[1]', '$array[2]', '$hash')";
                $connection->query($query);
                header('Location:index.php'); //register successfully
            } else {
                header('Location:index.php');
            // add "user exists" on the page
            }
            break;
        }
        case 'cart':
        if (isset($array[1]) && isset($array[2])) {
            $select = "SELECT * FROM Cart WHERE in_cart = '$array[2]' AND username = '$array[1]'";
            $exists = $connection->query($select);
            $rows = $exists->num_rows;
            if ($rows == 0) {
                $query = "INSERT INTO Cart VALUES ('$array[1]', '$array[2]')";
                $connection->query($query);
									echo 'success';
            } else {
                echo 'failed';
            }
            break;
        }
		case 'remove_cart':
	    if (isset($array[1]) && isset($array[2])) {
			$remove = "DELETE FROM Cart WHERE in_cart = '$array[2]' AND username = '$array[1]'";
			if($connection->query($remove) == TRUE) {
				echo 'success';
			} else {
				echo 'failed';
			}
	        break;
	    }
    }
    mysqli_close($connection);
}
