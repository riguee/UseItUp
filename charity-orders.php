<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/css/bootstrap-select.css" />
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
    <link href="styles.css" rel="stylesheet" type="text/css">
    <title>My orders</title>
    <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
</head>
<body>
<?php session_start();
if (empty($_SESSION)) {
header( "location: index.php" );
}
elseif ($_SESSION['user_type'] == 'charity') {
include 'navbar-charity.php';
}
elseif ($_SESSION['user_type'] == 'restaurant') {
header( "location: new-listing.php" );
}
else {
header( "location: logout.php" );
}
?>

<div class="container">
<h1>Orders</h1>
<h2>Upcoming orders</h2><br>

<?php
include 'connection.php';
include 'Orders.php';
include 'Restaurants.php';
include 'Listings.php';


$charity_session = $_SESSION['id'];
$query = "SELECT id FROM orders WHERE charity_id = ". $charity_session. " AND CONCAT(pickup_day, \" \", pickup_time) > NOW() ORDER BY pickup_day, pickup_time";
$results = $conn->query($query);

if (mysqli_num_rows($results) > 0) {
    echo "";
    // output data of each row
    while($row = $results->fetch_assoc()) {
        $id = $row['id'];
        $order = new Order();
        $order->setOrderFromId($id);
        $order->displayCharityUpcoming();

    }
} else {
    echo "You have no upcoming orders. Orders will appear here before they are picked up.<br><br>";
}
echo "<hr>";
echo "<h2>Past orders</h2><br>";

$query = "SELECT id FROM orders WHERE charity_id = ". $charity_session." AND CONCAT(pickup_day,\" \", pickup_time) <= NOW()";
$results = $conn->query($query);

if (mysqli_num_rows($results) > 0) {
    echo "";
    // output data of each row
    while($row = $results->fetch_assoc()) {
        $id = $row['id'];
        $order = new Order();
        $order->setOrderFromId($id);
        $order->displayCharityPast();

    }
} else {
    echo "You have no past orders. Orders will appear here once they have been picked up.";
}


?>


</div>
</body>
</html>
