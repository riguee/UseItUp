<?php
include "connection.php";
$query = "DELETE FROM listings WHERE id = " . $_POST['listing'];
$result = mysqli_query($conn, $query);
header("Location: my-account-charity.php");
exit;