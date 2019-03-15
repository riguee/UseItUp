<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>UseItUp Login Page</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
    <link href="common.css" rel="stylesheet" type="text/css">
</head>

<body>

<h1>Welcome To UseItUp</h1>

<div class="form">

    <div class="tab-content">

        <div id="login">

            <form action="Login.php" method="post" autocomplete="off">

                <div class="field-wrap">
                    <label>
                        Email Address<span class="req">*</span>
                    </label>
                    <input type="email" required autocomplete="off" name="email"/>
                </div>

                <div class="field-wrap">
                    <label>
                        Password<span class="req">*</span>
                    </label>
                    <input type="password" required autocomplete="off" name="password"/>
                </div>

                <p class="forgot"><a href="forgot.php">Forgot Password?</a></p>

                <button class="button button-block" name="login">Log In</button>

            </form>

            <form action="Register.php" method="post" autocomplete="off">

                <button class="button button-block" name="register">Register</button>


            </form>

        </div>

    </div>

</div>


<?php

$mysqli = include 'connection.php';
/* User login process, checks if user exists and password is correct */

// Escape email to protect against SQL injections

$email = $_POST['email'];
//echo $email;

//$email = $mysqli->real_escape_string($email);

//echo $email;

$query = "SELECT * FROM charities WHERE email='" . $email . "'";

$result = $mysqli->query($query);

if ( $result->num_rows == 0 ){ // User doesn't exist
//    $_SESSION['message'] = "User with that email doesn't exist!";

    $query = "SELECT * FROM restuarants WHERE email='" . $email . "'";

    if($_POST['password'] == $user['password']) {

        $_SESSION['email'] = $user['email'];
        $_SESSION['name'] = $user['name'];
        $_SESSION ['phone_number'] = $user['phone_number'];
        $_SESSION['address'] = $user['address'];
        $_SESSION['active'] = $user['active'];

        // This is how we'll know the user is logged in
        $_SESSION['logged_in'] = true;

        header("location: RestaurantProfileAcct.php");
    }
    else {
        $_SESSION['message'] = "You have entered wrong password, try again!";
        header("location: error.php");
        }


else { // User exists
    $user = $result->fetch_assoc();

    if($_POST['password'] == $user['password']) {

        $_SESSION['email'] = $user['email'];
        $_SESSION['name'] = $user['name'];
        $_SESSION ['phone_number'] = $user['phone_number'];
        $_SESSION['address'] = $user['address'];
        $_SESSION['active'] = $user['active'];

        // This is how we'll know the user is logged in
        $_SESSION['logged_in'] = true;

        header("location: CharityProfileAcct.php");
    }
    else {
        $_SESSION['message'] = "You have entered wrong password, try again!";
        header("location: error.php");
    }
}
?>

</body>
</html>