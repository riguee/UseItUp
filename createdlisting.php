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
$db = "useitup2";
$conn = new mysqli($servername, $username, $password, $db);
$recconn = new mysqli($servername, $username, $password, $db);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
//include 'connection.php';
class Listing{
    public $id, $title, $description, $portions, $time_from, $time_until, $allergen, $diet  ;
    /*function setlisting($id) {
        include 'connection.php';
        $query = "SELECT id, title, description, portions, time_from, time_until FROM listings
WHERE id = ". $id;
        $result = mysqli_query($conn,$query);
        $this->Title =
    }*/
    function display() {?>
        <div class="card">
            <h5 class="card-header">Listing number: <?php echo $this->id; ?></h5>
            <div class="row">
                <div class="col-2">
                    <div class="middle">
                        <p>Pickup window:<br><?php echo $this->time_from; ?><br><?php echo $this->time_until; ?></p>
                    </div>
                </div>
                <class="col-10">
                Dish name: <?php echo $this->title; ?><br>
                Dish description: <?php echo $this->description; ?><br>
                Number of portions: <?php echo $this->portions; ?><br>
                Allergens <ul> <?php
                    if(isset($this->allergen)) {
                        foreach ($this->allergen as $this_allergen) {
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

$createlisting = $conn->prepare("INSERT INTO listings (title, description, portions, time_from, time_until, day_posted)
VALUES (?, ?, ?, ?, ?, NOW())");
$createlisting->bind_param("sssss", $title, $description, $portion, $timefrom, $timeuntil);
$createlisting->execute();

$new_id = mysqli_insert_id($conn);
if (isset($_POST["allergen"])) {
    foreach ($_POST["allergen"] as $curr_allergen_id) {
        $setallergens = $conn->prepare("INSERT INTO allergen_listings (listing_id, allergen_id) VALUES (?, ?)");
        $setallergens->bind_param("ii", $new_id, $curr_allergen_id);
        $setallergens->execute();
    }
}

if (isset($_POST["diet"])) {
    foreach ($_POST["diet"] as $curr_diet_id) {
        $setdiet = $conn->prepare("INSERT INTO diet_listings (listing_id, diet_id) VALUES (?, ?)");
        $setdiet->bind_param("ii", $new_id, $curr_diet_id);
        $setdiet->execute();
    }
}

$query = "SELECT id, title, description, portions, time_from, time_until FROM listings
WHERE id = ". $new_id;
$result = mysqli_query($conn,$query);
$createdlisting = $result->fetch_object("Listing");


$allergenquery = "SELECT allergens.allergen FROM allergens JOIN allergen_listings ON allergens.id=allergen_listings.allergen_id
JOIN listings ON listings.id=allergen_lidtings.listing_id WHERE listings.id=".$new_id;

$stmt = $conn->prepare("SELECT allergens.allergen FROM allergens JOIN allergen_listings ON allergens.id=allergen_listings.allergen_id
JOIN listings ON listings.id=allergen_listings.listing_id WHERE listings.id=".$new_id);
$stmt->execute();
$allergenresult = $stmt->get_result();
if (mysqli_num_rows($allergenresult) > 0) {
    $allergenlist = array();
    // output data of each row
    while($row = $allergenresult->fetch_row()) {
        array_push($allergenlist,$row[0]);
        $createdlisting->allergen = $allergenlist;
    }
}

$dietstmt = $conn->prepare("SELECT diets.diet FROM diets JOIN diet_listings
ON diets.id=diet_listings.diet_id
JOIN listings ON listings.id=diet_listings.listing_id WHERE listings.id=".$new_id);
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