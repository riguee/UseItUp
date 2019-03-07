<?php
include 'Orders.php';
include 'connection.php';
$listings = unserialize(base64_decode($_POST['order']));
$order = new Order();
$order->charity_id = 4;
$order->restaurant_id = $_POST['restaurant'];
$order->pickup_time = $_POST['pickup-time'];
$order->listings = $listings;
$order->comments = $_POST['comments'];

$placeorder = $conn->prepare("INSERT INTO orders (charity_id, restaurant_id, pickup_time, comments, pickup_day) VALUES (?, ?, ?, ?, NOW())");
$placeorder->bind_param("ssss", $order->charity_id, $order->restaurant_id, $order->pickup_time, $order->comments);
$placeorder->execute();

$order->id = mysqli_insert_id($conn);

foreach ($listings as $listing) {
    $query = "INSERT INTO order_listings VALUES (". $order->id . ", ". $listing . ");";
    $result = mysqli_query($conn, $query);
}

header("Location: charityorder.php");
exit;