<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/css/bootstrap-select.css" />
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="styles.css">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta charset="UTF-8">
    <title>Restaurant account</title>
</head>
<body>
<script>
    function toDate(dStr,format) {
        var now = new Date();
        if (format == "h:m") {
            now.setHours(dStr.substr(0,dStr.indexOf(":")));
            now.setMinutes(dStr.substr(dStr.indexOf(":")+1));
            now.setSeconds(0);
            return now;
        }
        else {
            return "Invalid Format";
        }
    }

    function timeCheck(id) {
        var now = new Date();
        var time = toDate(document.getElementById(id).value, "h:m");
        var timefrom = toDate(document.getElementById("timefrom".concat(id)).innerHTML, "h:m");
        var timeuntil = toDate(document.getElementById("timeuntil".concat(id)).innerHTML, "h:m");
        if (document.getElementById(id).value.length > 0) {
            if (time >= timefrom && time < timeuntil) {
                if (time > now) {
                    return true;
                }
                else {
                    alert("The time you selected is in the past.");
                    return false;
                }
            }
            else {
                alert("The time you selected is not in the available range.");
                return false;
            }
        }
        else {
            alert("You have to input a pickup time.");
            return false;
        }
    }

    function displayopening() {
        if (document.getElementById('hours').classList.contains('hours')){
            document.getElementById('hours').classList.remove('hours');
            document.getElementById('display_hours').innerHTML = 'Hide pickup hours'
        }
        else {
            document.getElementById('hours').classList.add('hours');
            document.getElementById('display_hours').innerHTML = 'Show pickup hours'
        }
    }

</script>
<?php
session_start();
if (!isset($_POST['restaurant']) && $_SESSION['user_type'] == 'charity') {
    header( "location: main-listing.php" );
} elseif (empty($_SESSION)) {
    header( "location: index.php" );
} elseif ($_SESSION['user_type'] == 'charity') {
    include 'navbar-charity.php';
} elseif ($_SESSION['user_type'] == 'restaurant' && $_SESSION['id'] != $_POST['restaurant']) {
    header( "location: new-listing.php" );
} elseif ($_SESSION['user_type'] == 'restaurant' && $_SESSION['id'] == $_POST['restaurant']) {
    include 'navbar-restaurant.php';
} else {
    header( "location: logout.php" );
}
?>
<div class="container">
<?php
include 'Restaurants.php';
include 'Listings.php';
include 'connection.php';
$rest_id = $_POST['restaurant'];
$restaurant = new Restaurant();
$restaurant->setRestaurantFromId($rest_id);
?>
    <h1><?php echo $restaurant->name ?></h1>
    <div class="col-6 mx-auto">
        <div class="form-group row">
            <label for="email" class="col-4 col-form-label">Email</label>
            <div class="col-8">
                <input type="text" readonly class="form-control-plaintext" id="email" value="<?php echo $restaurant->email ?>">
            </div>
        </div>
        <div class="form-group row">
            <label for="phone" class="col-4 col-form-label">Phone</label>
            <div class="col-8">
                <input type="text" readonly class="form-control-plaintext" id="phone" value="<?php echo $restaurant->phone ?>">
            </div>
        </div>
        <div class="form-group row">
            <label for="address" class="col-4 col-form-label">Address</label>
            <div class="col-8">
                <input type="text" readonly class="form-control-plaintext" id="address" value="<?php echo $restaurant->address ?>">
            </div>
        </div>
        <div class="form-group row">
            <label for="postcode" class="col-4 col-form-label">Postcode</label>
            <div class="col-8">
                <input type="text" readonly class="form-control-plaintext" id="postcode" value="<?php echo $restaurant->postcode ?>">
            </div>
        </div>

<?php
echo "<button class='btn btn-block btn-primary' id='display_hours' onclick='displayopening();'>Show pickup hours</button><br> ";
echo "<div id='hours' class='hours'>";
$days = array('monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday', 'sunday');
foreach ($days as $day) {
    if ($restaurant->{$day . "_from"} != NULL) {
        ?>
        <label for="<?php echo $day ?>"><?php echo ucfirst($day) ?></label>
        <div class="input-group" id="<?php echo $day ?>">
            <div class="input-group-prepend">
                <div class="input-group-text">From</div>
            </div>
            <input type="time" class="form-control" value="<?php echo $restaurant->{$day . "_until"} ?>" readonly>
            <div class="input-group-append">
                <div class="input-group-text">From</div>
            </div>
            <input type="time" class="form-control" value="<?php echo $restaurant->{$day . "_from"} ?>" readonly>
        </div>
        <br>
        <?php
    }  else {
        ?>
        <label for="<?php echo $day ?>"><?php echo ucfirst($day) ?></label>
        <input type="button" class="btn btn-secondary btn-check" id="<?php echo $day ?>" value="The restaurant doesn't accept pickups on <?php echo ucfirst($day) . "s" ?>" disabled>
        <input type="checkbox" name="<?php echo "closed_" . $day ?>" id="<?php echo $day ?>" value="1" style="display: none;">
        <br><br>

    <?php }
}
echo "</div>";
?>


</div>

<?php
$query = "SELECT id FROM listings WHERE restaurant_id =  " . $restaurant->id . "  AND listings.id NOT IN (SELECT listing_id FROM order_listings) AND CONCAT(listings.day_posted, \" \", listings.time_until) > NOW()";
$result = mysqli_query($conn, $query);
if (mysqli_num_rows($result) > 0) {
    echo "<hr><h1>Available listings from this restaurant:</h1><div style='margin: 20px'";

     while($row = $result->fetch_assoc()) {
           $listing = new Listing();
           $listing->setListingFromId($row['id']);
           $listing->displayAccount();
           echo "<br><br>";
     }
     echo "</div>";
} else {
    echo "<h1> There are currently no available listings from this restaurant.</h1>";
}
?>
</div>

</body>