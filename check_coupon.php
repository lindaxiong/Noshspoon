<?php

require_once 'library.php';
date_default_timezone_set('UTC');
$connection = new mysqli($hostname, $username, $password, $database);
if ($connection->connect_error) {
  die($connection->connect_error);
}
$code = $_POST['coupon_code'];
$query = "SELECT * FROM Coupons WHERE coupon_code = '$code'";
$result = $connection->query($query);
if (!$result) {
  die($connection->error);
} elseif ($result->num_rows) {
  $row = $result->fetch_assoc();
  if ($row['valid']) {
    echo $row['coupon_value'];
  } else {
    echo 'invalid';
  }
} else {
  echo 'invalid';
}
mysqli_close($connection);
