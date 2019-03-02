<?php
include 'Orders.php';
$listings = unserialize(base64_decode($_POST['order']));
$order = new Order();
$order->charity_id = 1;
$order->restaurant_id = $_POST['restaurant'];
$order->pickup_time = $_POST['pickup-time'];
$order->listings = $listings;
