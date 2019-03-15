<?php
include "connection.php";
$query = "DELETE FROM orders WHERE id = " . $_POST['order'];
$result = mysqli_query($conn, $query);
header("Location: charity-orders.php");
exit;