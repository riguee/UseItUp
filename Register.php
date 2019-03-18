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
            Address: <span class="req">*</span>
        </label>
        <input type="text" name="address" autocomplete="off"/>
        <br>

        <label>
            Phone:
        </label>
        <input type="number" name="phone" autocomplate="off"/>
        <br>

        <div id = "char_div" class = "inv">
            <label>
                Charity ID: <span class="req">*</span>
            </label>
            <input type="number" name="charity_id" autocomplete="off"/>
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
    $mysqli = include('connection.php');

    //Setting POST variables
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = md5($_POST['password']);
    $address = $_POST['address'];
    $phone = $_POST['phone'];
    $id = $_POST['charity_id'];
    $div_select = $_POST['div_select'];

    if ($div_select == 'restaurant') {
        $service = 'restaurants';
    } else {
        $service = 'charities';
    }

    // Check if user with that email already exists
    // Each email can only be used for EITHER restaurant or charity
    $query_rest = "SELECT * FROM restaurants WHERE email='" . $email . "'";
    $query_char = "SELECT * FROM charities WHERE email='" . $email . "'";

    $result_rest = $mysqli->query($query_rest);
    $result_char = $mysqli->query($query_char);

    $total_results = $result_rest->num_rows + $result_char->num_rows;

    if ($total_results > 0) {
        $_SESSION['message'] = 'User with this email already exists! Please try again';
        include "error.php";
//        header("location: error.php");
    } else {
        // Email doesn't match
        // Insert into service

        $sql = "INSERT INTO $service (id, name, phone_number, email, password, address, active";
        if ($service == 'charities') {
            $sql = $sql . ", charity_id";
        }
        $sql = $sql . ") VALUES (";
        if ($service == 'charities') {
            $num = $mysqli->query("SELECT * FROM $service");
            $num = $num->num_rows + 1;
            $sql = $sql . $num;
        }
        else {
            $sql = $sql . "NULL";
        }
        $sql = $sql . ", '$name', $phone, '$email', '$password', '$address', FALSE";
        if ($service == 'charities') {
            $sql = $sql . ", $id";
        }
        $sql = $sql . ")";

//        echo $sql;

        if ($mysqli->query($sql)) {
            // Successful
            $service = $service[0];

            session_start();

            $_SESSION['service'] = $service;
            $_SESSION['email'] = $email;
            $_SESSION['logged_in'] = true;

            $_SESSION['message'] = "Confirmation link has been sent to $email, please your account by clicking on the link in the message!";

            // Send registration confirmation link (verify.php)
            $to = $email;
            $subject = 'Account Verification';
            $message_body = '
                Hello ' . $first_name . ',
        
                Thank you for signing up!
        
                Please click this link to activate your account:
        
                http://localhost/login-system/Verify.php?email=' . $email . '&hash=' . $password . '&service=' . $service;

            mail($to, $subject, $message_body);

//            header("location: RestaurantProfileAcct.php");
            echo "Verification link: http://localhost:63342/COMP0034_GroupC-master%204/Verify.php?email=$email&hash=$password&service=$service";

        } else {
            // Failed
            $_SESSION['message'] = 'Registration failed!';
//            header("location: error.php");
            include "error.php";
        }
    }
}
?>
</body>

</html>