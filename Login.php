<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>UseItUp Login</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <style>

    </style>
</head>
<body bgcolor="#fcfff5">

<h1>USEITUP</h1>
<h2>Welcome to UseItUp</h2>

<div>
    <table style="text-align: center">
<form name="form1" method="post" action="Login2.php">
    <input type="hidden" name="action" value="login">
    <input type="hidden" name="hide" value="">
    <table class='center'>
        <tr><td>Username/Email</td><td><input type="text" name="username" placeholder="Username/Email"></td></tr>
        <tr><td>Password</td><td><input type="password" name="password" placeholder="Password"></td></tr>
        <tr><td></td><td><input type="submit" value="Login"></td></tr>
        <tr><td colspan=2></td></tr>

    </table>
</form>

        <?php
        if(isset($_POST['email'])) {
            $email = $_POST['email'];

            echo "<br>";

            if($email == "" or $fname == "" or $lname == "") {
                print("* All fields are required");
            }
            else {
                $mysqli = new mysqli("localhost","root","root","");

                $results = $mysqli->query("SELECT email FROM customer WHERE email='" . $email . "'");

                if($results->num_rows > 0) {
                    $row = $results->fetch_assoc();

                    if (strtoupper($fname) != strtoupper($row['first_name']) or strtoupper($lname) != strtoupper($row['last_name'])) {
                        print("Your details are wrong. Please try again.");
                    } else {
                        print("You've successfully logged in.");
                    }
                }
                else {
                    print("Your details were not found. Creating an account...");
                    echo "<br>";

                    $email_array = explode("@", $email);

                    if(count($email_array) != 2) {
                        print("The format for your email is wrong.");
                    }
                    else {
                        $email = strtoupper($email_array[0]) . "@" . strtolower($email_array[1]);
                        $fname = strtoupper($fname);
                        $lname = strtoupper($lname);

                        $total = $mysqli->query("SELECT MAX(address_id) AS max_add FROM customer");

                        $row = $total->fetch_assoc();

                        $query = "INSERT INTO customer (customer_id, store_id, first_name, last_name, email, address_id, active, create_date, last_update) VALUES (NULL, 2, '" . $fname . "', '" . $lname . "', '" . $email . "', " . $row['max_add'] . ", 0, '" . date("Y-m-d h:m:s") . "', NULL)";

                        if ($mysqli->query($query) === true) {
                            print("Your account has been created.");
                        }
                        else {
                            print("Error: " . $query);
                            echo "<br>";
                            print($mysqli->error);
                        }
                    }
                }
            }
        }
        ?>


</div>


<div class="bottom-container">
<div class="row">
    <div class="col">
        <a href="Register.php" style="color:red" class="btn">Sign up</a>
    </div>
</div>
<p> </p>
<div>
    <div class="col">
        <a href="Forgotpassword.php" style="color:red" class="btn">Forgot password?</a>
    </div>
</div>


<?php

// Connect to server and select database//
$server = 'localhost';
$username = 'root';
$password = '';
$database = 'project';
$mysqli_connect($server,$username,$password) or die(mysql_error());
$mysqli_select_db($database) or die(mysqli:_error());

// username and password sent from form
$myusername=$_POST['myusername'];
$mypassword=$_POST['mypassword'];

$sql="SELECT * FROM 'register' WHERE username='$myusername' and    
password='$mypassword'";
echo $sql;
$result=$mysqli_query($sql,$con);

// Mysql_num_row is counting table row
$count=mysql_num_rows($result);

if($count==1){

    session_register("myusername");
    session_register("mypassword");
    header("location:login_success.php");
}
else {
    echo "Wrong Username or Password";
}
?>

Login Successful
</body>
</html>



