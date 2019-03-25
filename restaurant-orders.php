<!DOCTYPE html>
<div lang="en"></div>
<head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/css/bootstrap-select.css" />
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
    <link href="styles.css" rel="stylesheet" type="text/css">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta charset="UTF-8">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/js/bootstrap-select.min.js"></script>
    <title>Orders</title>
</head>
<body>
<?php
include 'connection.php';
include 'Orders.php';
include 'Listings.php';
include 'Charities.php';
session_start();
if (empty($_SESSION)) {
    header( "location: index.php" );
}
elseif ($_SESSION['user_type'] == 'charity') {
    header( "location: main-listing.php" );
}
elseif ($_SESSION['user_type'] == 'restaurant') {
    include 'navbar-restaurant.php';
}
else {
    header( "location: logout.php" );
}

$restaurant_session = $_SESSION['id'];

?>
<div class="container">
    <h1>Orders</h1>
    <h2>Upcoming orders</h2>
    <?php
    $query = "SELECT id FROM orders WHERE restaurant_id = " . $restaurant_session . " AND CONCAT(pickup_day, \" \", pickup_time) > NOW() ORDER BY pickup_day, pickup_time";
    $result = mysqli_query($conn, $query);
    if (mysqli_num_rows($result)>0) {
        for ($i = 1; $i <= mysqli_num_rows($result); $i++) {
            $order = new Order();
            $order->setOrderFromId(mysqli_fetch_assoc($result)['id']);
            $order->displayRestaurantUpcoming();
        }
    }
    else {
        echo "There are no upcoming orders.";
    }
    ?>
    <hr>
    <h2>Past orders</h2><br>
    <?php
    $query = "SELECT id FROM orders WHERE restaurant_id = " . $restaurant_session . " AND CONCAT(pickup_day, \" \", pickup_time) <= NOW() ORDER BY pickup_day, pickup_time";
    $result = mysqli_query($conn, $query);
    if (mysqli_num_rows($result)>0) {
        for ($i = 1; $i <= mysqli_num_rows($result); $i++) {
            $order = new Order();
            $order->setOrderFromId(mysqli_fetch_assoc($result)['id']);
            $order->displayRestaurantPast();
        }
    }
    else {
        echo "Past orders will appear here once they have been picked up.";
    }
    ?>
</div>
</body>
</html>
