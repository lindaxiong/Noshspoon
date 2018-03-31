<?php
session_start();
session_unset(); //Gets rid of current session variable data - so username and password is resetted
session_destroy(); //Destroys the current session, so it kills all session information
header("Location: "); //Redirect after logout back to login page or wherever; just insert url after :
?>