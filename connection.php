<?php
$servername = "localhost";
$username = "root";
$password = "root";
$db = "useitup";

$conn = new mysqli($servername, $username, $password, $db);
if ($conn->connect_error) {
    echo "something went wrong";
    die("Connection failed: " . $conn->connect_error);} ?>
