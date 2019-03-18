<?php
/* Password reset process, updates database with new user password */
session_start();

// Make sure the form is being submitted with method="post"
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $mysqli = include "connection.php";

    // Make sure the two passwords match
    if ( $_POST['newpassword'] == $_POST['confirmpassword'] ) {
        $new_password = md5($_POST['newpassword']);

        $email = $_POST['email'];
        $password = $_POST['password'];
        $service = $_POST['service'];

        $sql = "UPDATE $service SET password='$new_password' WHERE email='$email'";

        if ( $mysqli->query($sql) ) {

            $_SESSION['message'] = "Your password has been reset successfully!";
//            header("location: success.php");

        }

    }
    else {
        $_SESSION['message'] = "Two passwords you entered don't match, try again!";
//        header("location: error.php");
    }

    include "error.php";

}
?>