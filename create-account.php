<?php
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
        $charitynumber = $_POST['charity_id'];
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
            $stmt->execute();
            echo "<script>alert('You have created an account')</script>";
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
                $stmt->execute();
                echo "<script>alert('You have created an account')</script>";
        }

    }
}


?>