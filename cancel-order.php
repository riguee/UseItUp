<?php
include "connection.php";
session_start();
$query = "DELETE FROM orders WHERE id = " . $_POST['order'];
$result = mysqli_query($conn, $query);
if ($_SESSION['user_type'] == 'restaurant') {
    header("Location: restaurant-orders.php");
}
else {
    header("Location: charity-orders.php");
}
exit;