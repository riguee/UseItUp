<!DOCTYPE html>
<html lang="en">
<head>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
    <link href="styles.css" rel="stylesheet" type="text/css">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta charset="UTF-8">
    <title>Upcoming pickups</title>
</head>
<body class="container-fluid">
<h1>Upcoming pickups</h1>

<?php

$servername = "localhost";
$username = "root";
$password = "root";
$db = "test";

$conn = new mysqli($servername, $username, $password, $db);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

class Order {
    public $ID, $charityName, $timefrom, $timeuntil, $listings;
    function display() {?>
        <div class="card" style="margin:20px 0 20px 0">
            <h5 class="card-header">Order #<?php echo $this->ID; ?></h5>
            <div class="row">
                <div class="col-2">
                    <div class="middle">
                        <p>Pickup window:<br><?php echo $this->timefrom; ?><br><?php echo $this->timeuntil; ?></p>
                    </div>
                </div>
                <div class="col-10">
                    <h6 style="margin-top: 15px; margin-bottom: 15px">From: <a href="#"><?php echo $this->charityName; ?></a>.</h6>
                    <table class="table">
                        <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Dish</th>
                            <th scope="col">Quantity</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        $i = 0;
                        while ($listing = mysqli_fetch_assoc($this->listings)) {
                            $i += 1;
                            ?>
                        <tr>
                            <th scope="row"><?php echo $i; ?></th>
                            <td><?php echo $listing['title']; ?></td>
                            <td><?php echo $listing['portions']; ?></td>
                        </tr>
                        <?php
                        }
                        ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <button style="margin: 30px 400px 30px 400px" class="btn btn-danger">Cancel pickup</button>
        </div>
        <?php
    }
}

$query = "SELECT ID, timefrom, timeuntil FROM orders WHERE ID = 2";
$result = mysqli_query($conn, $query);
$data1 = mysqli_fetch_array($result);

$query = "SELECT charities.charityName FROM orders JOIN charities ON orders.charityID = charities.ID WHERE orders.ID = 2";
$result = mysqli_query($conn, $query);
$data2 = mysqli_fetch_array($result);

$query = "SELECT title, portions FROM orders JOIN orders_listings ON orders.ID = orders_listings.orderID JOIN listings ON listingID = listings.ID WHERE orders.ID = 2";
$data3 = mysqli_query($conn, $query);

$order = new Order();

$order -> ID = $data1["ID"];
$order -> timefrom = $data1["timefrom"];
$order -> timeuntil = $data1["timeuntil"];
$order -> charityName = $data2["charityName"];
$order -> listings = $data3;
$order->display();

?>



<!--
<div class="card" style="margin:20px 0 20px 0">
    <h5 class="card-header">Order #1234567890</h5>
    <div class="row">
        <div class="col-2">
            <div class="middle">
                <p>Pickup window:<br>19:34<br>19:35</p>
            </div>
        </div>
        <div class="col-10">
            <h6 style="margin-top: 15px; margin-bottom: 15px">From: <a href="#">Charity</a>.</h6>
            <table class="table">
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Dish</th>
                    <th scope="col">Quantity</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <th scope="row">1</th>
                    <td>Banana</td>
                    <td>500</td>
                </tr>
                <tr>
                    <th scope="row">2</th>
                    <td>Pineapple</td>
                    <td>3</td>
                </tr>
                <tr>
                    <th scope="row">3</th>
                    <td>Strawberry</td>
                    <td>1</td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
    <button style="margin: 30px 400px 30px 400px" class="btn btn-danger">Cancel pickup</button>
</div>
-->

<!--
<div class="card" style="margin:20px 0 20px 0">
    <h5 class="card-header">Order #1234567891</h5>
    <div class="row">
        <div class="col-2">
            <div class="middle">
                <p>Pickup window:<br>19:48<br>19:49</p>
            </div>
        </div>
        <div class="col-10">
            <h6 style="margin-top: 15px; margin-bottom: 15px">From: <a href="#">Charity</a>.</h6>
            <table class="table">
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Dish</th>
                    <th scope="col">Quantity</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <th scope="row">1</th>
                    <td>Cake</td>
                    <td>34</td>
                </tr>
                <tr>
                    <th scope="row">2</th>
                    <td>Curry</td>
                    <td>1</td>
                </tr>
                <tr>
                    <th scope="row">3</th>
                    <td>Banana</td>
                    <td>7800</td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
    <button style="margin: 30px 400px 30px 400px" class="btn btn-danger">Cancel pickup</button>
</div>
-->
<br>
<h1>Available listings</h1>
<div class="card">
    <div class="card-body row">
        <img class="col-3 listing-img" src="https://d2gg9evh47fn9z.cloudfront.net/800px_COLOURBOX2744003.jpg">
        <div class="col-9">
            <h4>Listing title</h4>
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque sed rhoncus lacus, tristique maximus neque. Nunc at risus aliquam, lacinia mauris at, tempor ante.</p>
            <h6>Portions: 40.</h6>
            <h6>Allergens: allergen 1, allergen 2, allergen 3.</h6>
            <h6>Available pickup times: between 00/00/00 00:00:00 and 00/00/00 00:00:00.</h6>
            <br>
            <button class="btn btn-secondary" style="margin-right: 10px">Edit listing</button><button class="btn btn-danger">Remove listing</button>
        </div>
    </div>
</div>
<br>
<div class="card">
    <div class="card-body row">
        <img class="col-3 listing-img" src="https://d2gg9evh47fn9z.cloudfront.net/800px_COLOURBOX2744003.jpg">
        <div class="col-9">
            <h4>Listing title</h4>
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque sed rhoncus lacus, tristique maximus neque. Nunc at risus aliquam, lacinia mauris at, tempor ante.</p>
            <h6>Portions: 40.</h6>
            <h6>Allergens: allergen 1, allergen 2, allergen 3.</h6>
            <h6>Available pickup times: between 00/00/00 00:00:00 and 00/00/00 00:00:00.</h6>
            <br>
            <button class="btn btn-secondary" style="margin-right: 10px">Edit listing</button><button class="btn btn-danger">Remove listing</button>
        </div>
    </div>
</div>
<br>
<button style="margin: 10px; position: absolute; right:40%; left: 40%" class="btn btn-primary">+ Add new listing</button>
</body>
</html>