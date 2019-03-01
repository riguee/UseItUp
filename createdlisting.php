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

include 'connection.php';

$target_dir = "uploads/";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);

$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
// Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {
    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
    if($check !== false) {
        echo "File is an image - " . $check["mime"] . ".";
        $uploadOk = 1;
    } else {
        echo "File is not an image.";
        $uploadOk = 0;
    }
}
// Check if file already exists
if (file_exists($target_file)) {
    echo "Sorry, file already exists.";
    $uploadOk = 0;
}
// Check file size
if ($_FILES["fileToUpload"]["size"] > 500000) {
    echo "Sorry, your file is too large.";
    $uploadOk = 0;
}
// Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
    && $imageFileType != "gif" ) {
    echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
    $uploadOk = 0;
}
// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
} else {
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
    } else {
        echo "Sorry, there was an error uploading your file.";
    }
}


//include 'connection.php';
include 'Listings.php';
$restaurant = 1;

$createlisting = $conn->prepare("INSERT INTO listings (title, description, portions, time_from, time_until, day_posted, restaurant_id, image)
VALUES (?, ?, ?, ?, ?, NOW(),1, ?)");
$createlisting->bind_param("ssssss", $title, $description, $portion, $timefrom, $timeuntil, $target_file);
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

$createdlisting = new Listing();
$createdlisting->setListingFromId($new_id);

$createdlisting->displayCreated();


$conn->close();

?>
</body>
</html>