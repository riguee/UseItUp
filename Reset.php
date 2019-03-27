<?php
session_start();

// Make sure email and hash variables aren't empty

if( isset($_GET['email']) && !empty($_GET['email']) AND isset($_GET['hash']) && !empty($_GET['hash']) ) {
    $mysqli = include "connection.php";
    $email = $_GET['email'];
    $password = $_GET['hash'];

    // Make sure user email with matching hash exist
    if ($_GET['service'] == 'r') {
        $service = 'restaurants';
    }
    else {
        $service = 'charities';
    }

    $result = $mysqli->query("SELECT * FROM $service WHERE email='$email' AND password ='$password'");
//    echo $email;
//    echo $password;
//    echo $service;

    if ($result->num_rows == 0) {
        $_SESSION['message'] = "You have entered invalid URL for password reset!";
        include "error.php";
    }
}
else {
    $_SESSION['message'] = "Sorry, verification failed, try again!";
//    include "error.php";
    echo $_GET['email'];
    echo $_GET['hash'];
}

?>

<!DOCTYPE html>
<html >
<head>
    <meta charset="UTF-8">
    <title>Reset Your Password</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
    <link href="styles.css" rel="stylesheet" type="text/css">
</head>

<body>
<div class="form">

    <h1>Choose Your New Password</h1>

    <form action="ResetPW.php" method="post">

        <div class="field-wrap">
            <label>
                New Password<span class="req">*</span>
            </label>
            <input type="password"required name="newpassword" autocomplete="off"/>
        </div>

        <div class="field-wrap">
            <label>
                Confirm New Password<span class="req">*</span>
            </label>
            <input type="password"required name="confirmpassword" autocomplete="off"/>
        </div>

        <!-- This input field is needed, to get the email of the user -->
        <input type="hidden" name="email" value="<?= $email ?>">
        <input type="hidden" name="password" value="<?= $hash ?>">
        <input type="hidden" name="service" value="<?= $service ?>">

        <button class="button button-block"/>Apply</button>

    </form>

</div>
<script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
<script src="js/index.js"></script>

</body>
</html>
