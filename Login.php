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


<!--            </form>-->
<!---->
<!--            <ul class="tab-group">-->
<!--                <li class="tab"><a href="signup.php">Sign Up</a></li>-->
<!--            </ul>-->

            </form>

        </div>

    </div>

</div><!-- tab-content -->

<!--</div> -->
<!-- /form -->
</body>
<?php
if (isset($_POST["email"])) {
    $conn = include("connection.php");

    $sql = "SELECT * FROM charities"; // NEED TO ADD EQUALITY TO EMAILS
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
//            echo $row["id"];
        }
    }
    else {
        echo loginError();
    }
    // Repeat for restaurants
}
?>

<?php
function loginError() {
    return "User does not exist or password is incorrect.";
}
?>


<?php
//if ($_SERVER['REQUEST_METHOD'] == 'POST')
//{
//    if (isset($_POST['login'])) { //user logging in
//        require 'Login.php';
//    }
////    elseif (isset($_POST['register'])) { //user registering
//////        require 'Register.php';
////    }
//}
//?>
<!---->
<?php
/////* User login process, checks if user exists and password is correct */
/////* The query will perform a search query in the charities and restaurant in the search query*/
////// Escape email to protect against SQL injections//
////$email = $mysqli->escape_string($_POST['email']);
////$result = $mysqli->query("SELECT * FROM charities WHERE email='$email'");
////
////if ($result->num_rows == 0 ){ // User doesn't exist
////    $_SESSION['message'] = "User with that email doesn't exist!, Try again";
////    require 'Login.php';
////
////}
////else { // User exists
////    $user = $result->fetch_assoc();
////
////    if ( password_verify($_POST['password'], $user['password']) ) {
////
////        $_SESSION['email'] = $user['email'];
////        $_SESSION['name'] = $user['name'];
////        $_SESSION['address'] = $user['address'];
////        $_SESSION['postcode'] = $user['postcode'];
////
////        // This is how ww will know the user is logged in
////        $_SESSION['logged_in'] = true;
////
////        header("location: CharityProfileAcct.php");
////    }
////    else {
////        $_SESSION['message'] = "You have entered wrong password, try again!";
////        header("location: error.php");
////    }
////} header("CharityProfileAcct.php");
////?>
<!---->
<html>