<!DOCTYPE html>
<html>
<head>
    <title>Reset Your Password</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
    <link href="styles.css" rel="stylesheet" type="text/css">
</head>

<body>

<div class="form">

    <h1>Reset Your Password</h1>

    <form action="forgot.php" method="post">
        <div class="field-wrap">
            <label>
                Email Address<span class="req">*</span>
            </label>
            <input type="email"required autocomplete="off" name="email"/>
        </div>
        <button class="button button-block"/>Reset</button>
    </form>
</div>

<script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
<script src="js/index.js"></script>
</body>

</html>

<?php
if (isset($_POST['email'])) {
    session_start();
    $email = $_POST['email'];

    $mysqli = include "connection.php";

    $query_rest = "SELECT * FROM restaurants WHERE email='$email'";
    $query_char = "SELECT * FROM charities WHERE email ='$email'";

    $result_rest = $mysqli->query($query_rest);
    $result_char = $mysqli->query($query_char);

    $total_results = $result_rest->num_rows + $result_char->num_rows;

    // Not in restaurant or charities
    if ($total_results == 0) {
        $_SESSION['message'] = "Email does not exist.";
        include "error.php";
    }
    else {
        if ($result_rest->num_rows > 0) {
            $result = $result_rest;
            $service = 'r';
        }
        else {
            $result = $result_char;
            $service = 'c';
        }

        $user = $result->fetch_assoc();

        $name = $user['name'];
        $password = $user['password'];

        // Send registration confirmation link (reset.php)
        $to      = $email;
        $subject = 'Password Reset Link';
        $message_body = '
        Hello '.$name.',

        You have requested password reset!

        Please click this link to reset your password:

        http://localhost/login-system/Reset.php?email='.$email.'&hash='.$password.'&service='.$service;

        if (mail($to, $subject, $message_body)) {
            echo "Reset link: http://localhost:63342/COMP0034_GroupC-master%204/Reset.php?email=$email&hash=$password&service=$service";
        }
        else {
            echo "Failed!";
        }
    }
}

?>