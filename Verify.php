<?php
session_start();

// Make sure email and hash variables aren't empty
if(isset($_GET['email']) && !empty($_GET['email']) AND isset($_GET['hash']) && !empty($_GET['hash']))
{
    $mysqli = include "connection.php";

    $email = $_GET['email'];
    $password = $_GET['hash'];
    $service = $_GET['service'];

    if ($service == 'c') {
        $service = 'charities';
    }
    else {
        $service = 'restaurants';
    }

    $query = "SELECT * FROM $service WHERE email='$email' AND password='$password' AND active='0'";

//    echo $query;

    // Select user with matching email and hash, who hasn't verified their account yet (active = 0)
    $result = $mysqli->query($query);

//    echo $result->num_rows;

    if ( $result->num_rows == 0 )
    {
        $_SESSION['message'] = "Account has already been activated or the URL is invalid!";
        include "error.php";

    }
    else {
        $_SESSION['message'] = "Your account has been activated!";

        $mysqli->query("UPDATE $service SET active='1' WHERE email='$email'");

        include "error.php";
    }
}
else {
    $_SESSION['message'] = "Invalid parameters provided for account verification!";
    include "error.php";
}