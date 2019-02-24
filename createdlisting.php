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
<body>
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
$conn = new mysqli($servername, $username, $password, $db);
$recconn = new mysqli($servername, $username, $password, $db);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

class Listing{
    public $listingID, $Title, $Description, $portions, $timefrom, $timeuntil, $allergenname, $diet  ;
    function display() {?>
        <div class="card">
            <h5 class="card-header">Listing number: <?php echo $this->listingID; ?></h5>
            <div class="row">
                <div class="col-2">
                    <div class="middle">
                        <p>Pickup window:<br><?php echo $this->timefrom; ?><br><?php echo $this->timeuntil; ?></p>
                    </div>
                </div>
                <class="col-10">
                Dish name: <?php echo $this->Title; ?><br>
                Dish description: <?php echo $this->Description; ?><br>
                Number of portions: <?php echo $this->portions; ?><br>
                Allergens <ul> <?php
                    if(isset($this->allergenname)) {
                        foreach ($this->allergenname as $this_allergen) {
                            echo "<li>".$this_allergen. "</li>";
                        }
                    }
                    else {
                        echo "No allergen. ";
                    }
                    echo "</ul>";


                    if(isset($this->diet)) {
                        echo "Suitable for : <ul>";
                        foreach ($this->diet as $this_diet) {
                            echo "<li>".$this_diet. "</li>";
                        }
                    }
                    ?></ul>
            </div>
        </div>

        <?php
    }

}

$createlisting = $conn->prepare("INSERT INTO listings (Title, Description, portions, timefrom, timeuntil, dayposted)
VALUES (?, ?, ?, ?, ?, NOW())");
$createlisting->bind_param("sssss", $title, $description, $portion, $timefrom, $timeuntil);
$createlisting->execute();

$new_id = mysqli_insert_id($conn);
if (isset($_POST["allergen"])) {
    foreach ($_POST["allergen"] as $curr_allergen_id) {
        $setallergens = $conn->prepare("INSERT INTO allergen_litings (listingID, allergenID) VALUES (?, ?)");
        $setallergens->bind_param("ii", $new_id, $curr_allergen_id);
        $setallergens->execute();
    }
}

if (isset($_POST["diet"])) {
    foreach ($_POST["diet"] as $curr_diet_id) {
        $setdiet = $conn->prepare("INSERT INTO diet_listing (listingID, dietID) VALUES (?, ?)");
        $setdiet->bind_param("ii", $new_id, $curr_diet_id);
        $setdiet->execute();
    }
}

$query = "SELECT listingID, Title, Description, portions, timefrom, timeuntil FROM listings
WHERE listingID = ". $new_id;
$result = mysqli_query($conn,$query);
$createdlisting = $result->fetch_object("Listing");


$allergenquery = "SELECT allergens.allergenname FROM allergens JOIN allergen_litings ON allergens.allergenID=allergen_litings.allergenID
JOIN listings ON listings.listingID=allergen_litings.listingID WHERE listings.listingID=".$new_id;

$stmt = $conn->prepare("SELECT allergens.allergenname FROM allergens JOIN allergen_litings ON allergens.allergenID=allergen_litings.allergenID
JOIN listings ON listings.listingID=allergen_litings.listingID WHERE listings.listingID=".$new_id);
$stmt->execute();
$allergenresult = $stmt->get_result();
if (mysqli_num_rows($allergenresult) > 0) {
    $allergenlist = array();
    // output data of each row
    while($row = $allergenresult->fetch_row()) {
        array_push($allergenlist,$row[0]);
        $createdlisting->allergenname = $allergenlist;
    }
}

$dietstmt = $conn->prepare("SELECT diet_requirements.dietname FROM diet_requirements JOIN diet_listing 
ON diet_requirements.dietID=diet_listing.dietID
JOIN listings ON listings.listingID=diet_listing.listingID WHERE listings.listingID=".$new_id);
$dietstmt->execute();
$dietresult = $dietstmt->get_result();
if (mysqli_num_rows($dietresult) > 0) {
    $dietlist = array();
    // output data of each row
    while($row = $dietresult->fetch_row()) {
        array_push($dietlist,$row[0]);
        $createdlisting->diet = $dietlist;
    }
}


$createdlisting->display();


$conn->close();

?>
</body>
</html>