<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet"
          integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
    <link rel="stylesheet" href="common.css">
    <title>charity order</title>
    <script
            src="https://code.jquery.com/jquery-3.3.1.min.js"
            integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
            crossorigin="anonymous"></script>
    <script src="../../../../Users/charles/Desktop/updated_files/nav.js"></script>
</head>
<body class="container-fluid">
<?php include 'navbarcharity.php' ?>
<h1>Orders</h1><br><br>
<h2>Upcoming orders</h2><br>

<?php
include 'connection.php';
include 'Orders.php';
include 'Restaurants.php';
include 'Listings.php';


$charity_session = 2;
$query = "SELECT id FROM orders WHERE charity_id = ". $charity_session." AND pickup_day = NOW()";
$results = $conn->query($query);

if (mysqli_num_rows($results) > 0) {
    echo "";
    // output data of each row
    while($row = $results->fetch_assoc()) {
        $id = $row['id'];
        $order = new Order();
        $order->setOrderFromId($id);
        $order->displayUpcomingorders();

    }
} else {
    echo "You have no upcoming order. You can look at listings available around you and place orders in any of the 
restaurants for free. :-)<br><br><br>";
}

echo "<h2>Past orders</h2><br>";

$query = "SELECT id FROM orders WHERE charity_id = ". $charity_session." AND pickup_day != NOW()";
$results = $conn->query($query);

if (mysqli_num_rows($results) > 0) {
    echo "";
    // output data of each row
    while($row = $results->fetch_assoc()) {
        $id = $row['id'];
        $order = new Order();
        $order->setOrderFromId($id);
        $order->displayPastOrders();

    }
} else {
    echo "<br>You have no past order.";
}


?>



</body>
</html>