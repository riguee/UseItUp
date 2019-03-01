<?php
$servername = "localhost";
$username = "root";
$password = "";
$db = "useitup2";
$conn = new mysqli($servername, $username, $password, $db);
if ($conn->connect_error) {
    echo "something went wrong";
    die("Connection failed: " . $conn->connect_error);

}

?>