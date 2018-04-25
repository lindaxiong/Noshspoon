<?php

function post($array)
{

    require_once 'library.php';
    require 'PHPMailerAutoload.php';
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
                $query = "INSERT INTO Users VALUES ('$array[1]', '$array[2]', '$hash', 'user')";
                $connection->query($query);


                // PHPMailer
                $mail = new PHPMailer;

                $mail->isSMTP();                                      // Set mailer to use SMTP
                $mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
                $mail->SMTPAuth = true;                               // Enable SMTP authentication
                $mail->Username = 'uva.noshspoon@gmail.com';                 // SMTP username
                $mail->Password = 'cs4750noshspoon';                           // SMTP password
                $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
                $mail->Port = 587;                                    // TCP port to connect to



                $mail->setFrom('uva.noshspoon@gmail.com', 'Noshspoon');
                $mail->addAddress($array[1], $array[3]);     // Add a recipient        
                $mail->isHTML(true);                                  // Set email format to HTML
                $mail->Subject = 'Welcome to Noshspoon!';
                $mail->Body    = 'Congratulations, ' . $array[3] . '! You have successfully registered on Noshspoon!';
                $mail->AltBody = 'Congratulations, ' . $array[3] . '! You have successfully registered on Noshspoon! ';
                $mail->send();

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
