<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>UseItUp Login Page</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
    <link href="common.css" rel="stylesheet" type="text/css">
</head>
<?php include 'navbar-charity.php' ?>
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

                <p class="forgot"><a href="Forgot.php">Forgot Password?</a></p>

                <button class="button button-block" name="login">Log In</button>

            </form>

            <form action="Register.php" method="post" autocomplete="off">

                <button class="button button-block" name="register">Register</button>


            </form>

        </div>

    </div>

</div>


<?php
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
            $service = "r";
            $result = $result_rest;
        } else {
            $service = "c";
            $result = $result_char;
        }

        $user = $result->fetch_assoc();

        if (md5($_POST['password']) != $user['password']) {
            $login_check = false;
        } else { // Logged in
            $login_check = true;

            session_start();

            $_SESSION['service'] = $service;
            $_SESSION['email'] = $email;
            $_SESSION['logged_in'] = true;

            if ($service == 'r') {
                header("location: RestaurantProfileAcct.php");
            }
            else {
                header("location: CharityProfileAcct.php");
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