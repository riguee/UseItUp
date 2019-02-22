<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
    <link rel="stylesheet" href="common.css">
    <title>created listing</title>
    <script
        src="https://code.jquery.com/jquery-3.3.1.min.js"
        integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
        crossorigin="anonymous"></script>
    <script src="nav.js"></script>
</head>
<body class="container-fluid">
<div id="topnav"></div>
<?php

if (empty($_POST['title']) || empty($_POST['description'])) {
    echo '<script> alert("All the fields marked * need to be filled!")</script> ';
    return;
}
$title = $_POST["title"];
$description = $_POST["description"];
$portion = $_POST['portions'];
$timefrom = $_POST["from"];
$timeuntil = $_POST["until"];

$servername = "localhost";
$username = "root";
$password = "";
$db = "test";
$createdlisting;
$conn = new mysqli($servername, $username, $password, $db);
$recconn = new mysqli($servername, $username, $password, $db);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

class Listing{
    public $listingID, $Title, $Description, $portions, $timefrom, $timeuntil, $avocat  ;
    function display() {?>
        <div class="card">
            <h5 class="card-header">Listing number: <?php echo $this->listingID; ?></h5>
            <div class="row">
                <div class="col-2">
                    <div class="middle">
                        <p>Pickup window:<br><?php echo $this->timefrom; ?><br><?php echo $this->timeuntil; ?></p>
                    </div>
                </div>
                <div class="col-10">
                    <?php echo $this->Title; ?><br>
                    <?php echo $this->Description; ?><br>
                    Number of portions: <?php echo $this->portions; ?><br>
                    <?php echo $this->avocat; ?>

                </div>
            </div>
        </div>

        <?php
    }

}

$createlisting = $conn->prepare("INSERT INTO listings (Title, Description, portions, timefrom, timeuntil, dayposted)
VALUES (?, ?, ?, ?, ?, NOW())");
$createlisting->bind_param("sssss", $title, $description, $portion, $timefrom, $timeuntil);
$createlisting->execute();
$addallergens = $conn->prepare("INSERT INTO ");


$query = "SELECT listingID, Title, Description, portions, timefrom, timeuntil FROM listings 
WHERE listingID = ". mysqli_insert_id($conn);
$result = mysqli_query($conn,$query);
$createdlisting = $result->fetch_object("Listing");

$otherquery = "SELECT allergens.allergenname,FROM allergens JOIN allergen_litings ON allergens.allergenID=allergen_litings.allergenID 
JOIN listings ON listings.listingID=allergen_litings.listingID WHERE listings.listingID=".mysqli_insert_id($conn);
$createdlisting->avocat = "avocado";
$createdlisting->display();


$conn->close();

?>
</body>
</html>
