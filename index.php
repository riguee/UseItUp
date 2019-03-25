<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
    <link href="styles.css" rel="stylesheet" type="text/css">
    <title>Login</title>
</head>

<body>
<h1>Welcome To UseItUp</h1>
<div class="container">
    <form action="index.php" method="post" autocomplete="off">
        <div class="form-group">
            <label for="email">Email address</label>
            <input type="email" class="form-control" id="email" name="email" placeholder="Enter email" required>
        </div>
        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" class="form-control" aria-describedby="forgot" id="password" name="password" placeholder="Password" required>
        </div>
        <p class="forgot"><a href="Forgot.php">Forgot password?</a></p>
        <button type="submit" class="btn btn-primary btn-block">Log in</button>
    </form>
    <br>
    <a href="register.php" class="btn btn-secondary btn-block" name="register">Don't have an account? Register</a>

</div>



<?php
session_start();

if (!empty($_SESSION)) {
    if ($_SESSION['user_type'] == 'charity') {
        header("location: main-listing.php");
    } elseif ($_SESSION['user_type'] == 'restaurant') {
        header("location: new-listing.php");
    } else {
        header("location: logout.php");
    }
}


if (isset($_POST['email'])) {
    $login_check = false; // Check for login success

    $mysqli = include 'connection.php';
    /* User login process, checks if user exists and password is correct */

    $email = $_POST['email'];

    //$email = $mysqli->real_escape_string($email);

    //echo $email;
    $query_rest = "SELECT * FROM restaurants WHERE email='$email'";
    $query_char = "SELECT * FROM charities WHERE email ='$email'";

    $result_rest = $mysqli->query($query_rest);
    $result_char = $mysqli->query($query_char);

    $total_results = $result_rest->num_rows + $result_char->num_rows;

    if ($total_results == 0) { // User doesn't exist
        $login_check = false;
    } else { // User exists, check password
        $found = true; // check if the user is found

        if ($result_rest->num_rows > 0) {
            $service = "restaurant";
            $result = $result_rest;
        } else {
            $service = "charity";
            $result = $result_char;
        }

        $user = $result->fetch_assoc();

        if (md5($_POST['password']) != $user['password']) {
            $login_check = false;
        } else { // Logged in
            $login_check = true;

            session_start();

            $_SESSION['user_type'] = $service;
            $_SESSION['email'] = $email;
            $_SESSION['logged_in'] = true;
            $_SESSION['id'] = $user['id'];
            $_SESSION['name'] = $user['name'];

            if ($service == 'restaurant') {
                header("location: new-listing.php");
            }
            else {
                header("location: main-listing.php");
            }
        }
    }

    if ($login_check == false) {
        $_SESSION['message'] = "Wrong email or password. Please try again.";
//        header("location: error.php");
        include "error.php";
    } else {
        $_SESSION['message'] = null;
    }
}
?>

</body>
</html>