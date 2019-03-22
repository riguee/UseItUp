<?php
session_start();
if (!empty($_SESSION)) {
    if ($_SESSION['user_type'] == 'charity') {
        include 'navbar-charity.php';
    } elseif ($_SESSION['user_type'] == 'restaurant') {
        include 'navbar-restaurant.php';
    } else {
        header("location: Logout.php");
    }
}

include('connection.php');

if (isset($_POST["user_type"])) {

    //Setting POST variables
    $email = $_POST['email'];
    $address = $_POST['address'];
    $postcode = $_POST['postcode'];
    $phone = $_POST['phone'];
    $div_select = $_POST['user_type'];
    if ($div_select == "charity") {
        $charitynumber = $_POST['charity_id'];
        $stmt = $conn->prepare("UPDATE charities SET email = ?, phone = ?, address = ?, postcode = ?, charity_number = ? WHERE id = " . $_SESSION['id']);
        $stmt->bind_param(sssss, $email, $phone, $address, $postcode, $charitynumber);
        $stmt->execute();
    }
    if ($div_select == "restaurant") {
        $days = array('monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday', 'sunday');
        foreach ($days as $day) {
            if (isset($_POST[$day . '_from'])) {
                ${$day . "_from"} = $_POST[$day . '_from'];
                ${$day . "_until"} = $_POST[$day . '_until'];
            } else {
                ${$day . "_from"} = "";
                ${$day . "_until"} = "";
            }

        }
        $stmt = $conn->prepare("UPDATE restaurants SET `name` = ?, `phone` = ?, `email` = ?, `address` = ?, `postcode` = ?, `monday_from` = ?, `monday_until` = ?, `tuesday_from` = ?, `tuesday_until` = ?, `wednesday_from` = ?, `wednesday_until` = ?, `thursday_from` = ?, `thursday_until` = ?, `friday_from` = ?, `friday_until` = ?, `saturday_from` = ?, `saturday_until` = ?, `sunday_from` = ?, `sunday_until` = ? WHERE id =" . $_SESSION['id']);
        $stmt->bind_param('sssssssssssssssssss', $name, $phone, $email, $address, $postcode, $monday_from, $monday_until, $tuesday_from,
            $tuesday_until, $wednesday_from, $wednesday_until, $thursday_from, $thursday_until, $friday_from, $friday_until, $saturday_from, $saturday_until, $sunday_from, $sunday_until);
        $stmt->execute();
    }
    header("location: my-account.php");

}
