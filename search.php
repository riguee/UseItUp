<?php
$search = $_POST['search'];
include 'connection.php';
$query = "SELECT * FROM listings WHERE title LIKE \"%".$search."%\";";
$result = mysqli_query($conn, $query);
while ($finding = mysqli_fetch_assoc($result)) {
    echo $finding['title'];
}; ?>