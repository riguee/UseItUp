<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>created account</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
    <link rel="stylesheet" href="styles.css">
</head>
<body>
<div class="container">
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

include('connection.php');

if (isset($_POST["name"])) {

    //Setting POST variables
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = md5($_POST['password']);
    $address = $_POST['address'];
    $postcode = $_POST['postcode'];
    $phone = $_POST['phone'];
    $div_select = $_POST['selecttype'];
    if ($div_select == "charity") {
        $charitynumber = $_POST['charityid'];
    }
    if ($div_select == "restaurant") {
        $days = array('monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday', 'sunday');
        foreach ($days as $day){
            if (isset($_POST['closed_' . $day])) {
            ${$day . "_from"} = NULL;
            ${$day . "_until"} = NULL;
        }
            else {
                ${$day. "_from"} = $_POST[$day . '_from'];
                ${$day . "_until"} = $_POST[$day . '_until'];
            }
        }
    }


    if ($div_select == "charity") {
        $stmt = $conn->query("SELECT * FROM charities WHERE email = '" . $email . "'");
        if (mysqli_num_rows($stmt)>0) {
            echo "<script> alert('Sorry that email address is already used')</script>";
            header( "location: Login.php" );
            return;
        } else {
            $stmt = $conn->prepare("INSERT INTO charities (id, name, email, phone, address, postcode, charity_number, password)VALUES (NULL, ?, ?, ?, ?, ?, ?, ?)");
            $stmt->bind_param('sssssss', $name, $email, $phone, $address, $postcode, $charitynumber, $password);
            if ($stmt->execute()){
                echo "<script>alert('You have created an account')</script>";

                $_SESSION['name'] = $name;
                $_SESSION['user_type'] = $div_select;
                $_SESSION['email'] = $email;
                $_SESSION['logged_in'] = true;
                $_SESSION['id'] =  mysqli_insert_id($conn);
            } else {
                echo "Registration failed. Click <a href='register.php'>here</a> to try again.";
            }
        }
    } elseif ($div_select == "restaurant") {
        $stmt = $conn->query("SELECT * FROM restaurants WHERE email = '" . $email . "'");
        if (mysqli_num_rows($stmt)>0) {
            echo "<script> alert('Sorry that email address is already used')</script>";
            header( "location: Login.php" );
            return;
        } else {
                $stmt = $conn->prepare("INSERT INTO restaurants (`id`, `name`, `phone`, `email`, `address`, `postcode`, `password`, `monday_from`, `monday_until`, `tuesday_from`, `tuesday_until`, `wednesday_from`, `wednesday_until`, `thursday_from`, `thursday_until`, `friday_from`, `friday_until`, `saturday_from`, `saturday_until`, `sunday_from`, `sunday_until`, `active`)
 VALUES (NULL, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, 0)");
                $stmt->bind_param('ssssssssssssssssssss', $name, $phone, $email, $address, $postcode, $password, $monday_from, $monday_until, $tuesday_from,
                    $tuesday_until, $wednesday_from, $wednesday_until, $thursday_from, $thursday_until, $friday_from, $friday_until, $saturday_from, $saturday_until, $sunday_from, $sunday_until);
                if ($stmt->execute()) {
                    echo "<script>alert('You have created an account')</script>";
                    session_start();
                    $_SESSION['user_type'] = $div_select;
                    $_SESSION['email'] = $email;
                    $_SESSION['logged_in'] = true;
                    $_SESSION['id'] =  mysqli_insert_id($conn);
                    $_SESSION['name'] = $name;
                } else {
                    echo "Registration failed. Click <a href='register.php'>here</a> to try again.";
                }

        }
    } else {
        header("location: register.php" );
    }
}
else {
    header("location: register.php" );
}
header("location: my-account.php" );


?>
</div>
</body>
</html>
