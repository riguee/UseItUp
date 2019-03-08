<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>UseItUp SignUp page</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
    <style>
        .inv {
            display : none
        }

        .vis {
            display : block
        }
    </style>
</head>

<body bgcolor="#fcfff5">
<div id="signup">
    <h1>Sign Up for Free</h1>

<!--    <div>-->
<!--        -->
<!--    </div>-->
    <form action="Register.php" method="post" autocomplete="off">
        <label>Type of Account: </label>
        <select id="div_select" name="div_select" onchange="change(this.value)">
            <option value="restaurant">Restaurant</option>
            <option value="charity">Charity</option>
        </select>

        <br>
        <br>

        <script>
            function change(value) {
                if (value == "restaurant") {
                    document
                        .getElementById("char_div")
                        .className = 'inv';
                    document
                        .getElementsByName("charity_id")[0]
                        .required = false;
                }
                else if (value == "charity") {
                    document
                        .getElementById("char_div")
                        .className = 'vis';
                    document
                        .getElementsByName("charity_id")[0]
                        .required = true;
                }
            }
        </script>

        <label>
            Name: <span class="req">*</span>
        </label>
        <input type="text" name="name" autocomplete="off" required/>
        <br>

        <label>
            Email: <span class="req">*</span>
        </label>
        <input type="email" name="email" autocomplete="off" required/>
        <br>

        <label>
            Password: <span class="req">*</span>
        </label>
        <input type="password" name="password" autocomplete="off" required/>
        <br>

        <label>
            Street name:
        </label>
        <input type="text" name="street_name" autocomplete="off"/>
        <br>

        <label>
            Building name:
        </label>
        <input type="text" name="building_name" autocomplete="off"/>
        <br>

        <label>
            Postcode: <span class="req">*</span>
        </label>
        <input type="text" name="postcode" autocomplete="off" required/>
        <br>

        <label>
            City:
        </label>
        <input type="text" name="city" autocomplete="off"/>
        <br>

        <label>
            Phone:
        </label>
        <input type="number" name="phone" autocomplate="off"/>
        <br>

        <div id = "char_div" class = "inv">
            <label>
                ID: <span class="req">*</span>
            </label>
            <input type="text" name="charity_id" autocomplete="off"/>
            <br>
        </div>

        <br>
        <div>
            <button type="submit" class="button button-block">Sign Up</button>
        </div>
    </form>

    <form action="Login.php" autocomplete="off">
        <div>
            <button type="submit" class="button button-block">Cancel</button>
        </div>
    </form>

</div>

<?php

if (isset($_POST["name"])) {
    $conn = include('connection.php');

    $type = $_POST["div_select"];
    $name = $_POST["name"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $street_name = $_POST["street_name"];
    $building_name = $_POST["building_name"];
    $postcode = $_POST["postcode"];
    $city = $_POST["city"];
    $phone = $_POST["phone"];

    if ($type == "charity") {
        $charity_id = $_POST["charity_id"];
        $table = "charities";

        // Table headers
        $id_head = "id";
        $name_head = "name";
        $charity_number_head = "charity_number";
        $street_name_head = "street_name";
        $building_name_head = "building_details";
        $postcode_head = "postcode";
        $city_head = "city";
        $phone_head = "phone_number";
        $email_head = "email";
        $password_head = "password";
    }
    elseif ($type == "restaurant") {
        $table = "restaurants";

        // Table headers
        $id_head = "ID";
        $name_head = "Name";
        $street_name_head = "Street_name";
        $building_name_head = "Building_details";
        $postcode_head = "Postcode";
        $city_head = "City";
        $phone_head = "Phone_number";
        $email_head = "Email";
        $password_head = "password";
    }

    $sql = "SELECT *  FROM " . $table . " WHERE email='" . $email . "'";
    $results = $conn->query($sql);

    if ($results->num_rows == 0) {
        $sql = "SELECT " . $id_head . " FROM " . $table;
        $results = $conn->query($sql);
        $id = $results->num_rows + 1;

        $sql = "INSERT INTO " . $table . " (";
        $sql = $sql . $id_head . "," . $name_head;
        $sql_val = $id . ",'" . $name . "'";

        if ($type == "charity") {
            $sql = $sql . "," . $charity_number_head;
            $sql_val = $sql_val . "," . $charity_id;
        }

        $sql = $sql . "," . $street_name_head . "," . $building_name_head . ",";
        $sql_val = $sql_val . ",'" . $street_name . "','" . $building_name . "','";

        if ($type == "charity") {
            $sql = $sql . $city_head . "," . $postcode_head;
            $sql_val = $sql_val . $city . "','" . $postcode;
        }
        elseif ($type == "restaurant") {
            $sql = $sql . $postcode_head . "," . $city_head;
            $sql_val = $sql_val . $postcode . "','" . $city;
        }

        $sql = $sql . "," . $phone_head . "," . $email_head . "," . $password_head;
        $sql_val = $sql_val . "'," . $phone . ",'" . $email . "','" . $password;

        $sql = $sql . ") VALUES (" . $sql_val . "')";

        if ($conn->query($sql) == true) {
            echo("Account created.");
        }
        else {
            echo $conn->error;
        }
    }
    else {
        print("This account already exists.");
    }

//
//    echo $sql;

    // INSERT INTO `restaurants` (`ID`, `Name`, `Street name`, `Building details`, `Postcode`, `City`, `Phone number`, `Email`, `password`) VALUES ('1', 'KFC', 'Tottenham Court Road', '29', 'W1CT B5H', 'London', '91829381', 'kfc@kfc.com', 'kfc');

    //    echo "Done200";

//    $sql = "INSERT INTO " . $type . " VAULES (" . $name .

//    $sql = "INSERT INTO " . $type . " VALUES (" . $name . "," . $email . "," . $password . "," . $address . "," ;


//    " () VALUES ()";
//
//    $sql = "INSERT INTO ";
//    $sql = $sql . "HI";
//
//    echo $sql;
}

//if ($_POST['div_select'] == "restaurant") {
//    echo "Hi";
//}
//elseif ($_POST['div_select'] == "charity") {
//    echo "Bye";
//}

///* Registration process, inserts user info into the database
//   and sends account confirmation email message
// */
//// Set session variables to be used on profile.php page
//$_SESSION['name'] = $_POST['name'];
//$_SESSION['email'] = $_POST['email'];
//
//
//// Escape all $_POST variables to protect against SQL injections
//$name = $mysqli->escape_string($_POST['name']);
//$email = $mysqli->escape_string($_POST['email']);
//$password = $mysqli->escape_string(password_hash($_POST['password'));
//$hash = $mysqli->escape_string( md5( rand(0,1000) ) );
//
//// Check if user with that email already exists
//$result = $mysqli->query("SELECT * FROM charities WHERE email='$email'") or die($mysqli->error());
//
//// We know user email exists if the rows returned are more than 0
//if ( $result->num_rows > 0 ) {
//
//    $_SESSION['message'] = 'User with this email already exists!';
//    header("location: error.php");
//
//}
//else { // Email doesn't already exist in a database, proceed...
//
//// active is 0 by DEFAULT (no need to include it here)
//$sql = "INSERT INTO charities (name, address, postcode, email, password, hash) "
//    . "VALUES ('$name','$address','$email','$password','$postcode','$hash')";
//
//// Add user to the database
//if ( $mysqli->query($sql) ){
//
//    $_SESSION['active'] = 0; //0 until user activates their account with verify.php
//    $_SESSION['logged_in'] = true; // So we know the user has logged in
//    $_SESSION['message'] =
//
//        "Confirmation link has been sentx` to $email, please verify
//                 your account by clicking on the link in the message!";
//
//    // Send registration confirmation link (verify.php)
//    $to      = $email;
//    $subject = 'Account Verification';
//    $message_body = '
//        Hello '.$name.',
//
//        Thank you for signing up!
//
//        Please click this link to activate your account:
//
//        http://localhost/login-system/verify.php?email='.$email.'&hash='.$hash;
//
//    mail( $to, $subject, $message_body );
//
//    header("location: profile.php");
//
//}
//
//else {
//    $_SESSION['message'] = 'Registration failed!';
//    header("location: error.php");
//}
//?>
<!---->
<?php
///* Verifies registered user email, the link to this page
//   is included in the register.php email message
//*/
//require 'connection.php';
//session_start();
//
//// Make sure email and hash variables aren't empty
//if(isset($_GET['email']) && !empty($_GET['email']) AND isset($_GET['hash']) && !empty($_GET['hash']))
//{
//    $email = $mysqli->escape_string($_GET['email']);
//    $hash = $mysqli->escape_string($_GET['hash']);
//
//    // Select user with matching email and hash, who hasn't verified their account yet (active = 0)
//    $result = $mysqli->query("SELECT * FROM users WHERE email='$email' AND hash='$hash' AND active='0'");
//
//    if ( $result->num_rows == 0 )
//    {
//        $_SESSION['message'] = "Account has already been activated or the URL is invalid!";
//
//        header("location: error.php");
//    }
//    else {
//        $_SESSION['message'] = "Your account has been activated!";
//
//        // Set the user status to active (active = 1)
//        $mysqli->query("UPDATE users SET active='1' WHERE email='$email'") or die($mysqli->error);
//        $_SESSION['active'] = 1;
//
//        header("location: success.php");
//    }
//}
//else {
//    $_SESSION['message'] = "Invalid parameters provided for account verification!";
//    header("location: error.php");
//}
//?>


</body>
</html>