<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/css/bootstrap-select.css" />
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="styles.css">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta charset="UTF-8">
    <title>Confirm order</title>
</head>
<body>
<?php session_start();
if (empty($_SESSION)) {
    header( "location: index.php" );
}
elseif ($_SESSION['user_type'] == 'charity') {
    include 'navbar-charity.php';
}
elseif ($_SESSION['user_type'] == 'restaurant') {
    header( "location: new-listing.php" );
}
else {
    header( "location: logout.php" );
}
?>
<div class="container">
<h1>Your order</h1>
<?php
include 'connection.php';
include 'Listings.php';
if (isset($_POST['deleted'])) {
    $listing_IDs = unserialize(base64_decode($_POST['listings']));
    unset($listing_IDs[array_search($_POST['deleted'], $listing_IDs)]);
}
elseif (isset($_POST['listing'])) {
    $listing_IDs = array($_POST['listing']);
}
else {
    $listing_IDs = unserialize(base64_decode($_POST['listings']));
    array_push($listing_IDs, $_POST['added-listing']);

}
$listings = array();
foreach ($listing_IDs as $listing_id) {
    $listing = new Listing();
    $listing->setListingFromId($listing_id);
    array_push($listings, $listing);
}
include 'Restaurants.php';
$restaurant = new Restaurant();
$restaurant->setRestaurantFromId($listing->restaurant_id);
?>
<div class="card">
    <h5 class="card-header"><form action="restaurant-account.php" method="post"> From
                <button type="submit" name="restaurant" value="<?php echo $restaurant->id ?>" class="btn-link"><?php echo $listing->restaurant_name ?></button>.</form></h5>
    <div class="card-body">
        <span class="h6">Pick up time: </span><span><?php echo $_POST['pickup-time'] ?></span><br>
        <span class="h6">Pick up address: </span><span><?php echo $restaurant->address ?>, <?php echo $restaurant->postcode ?></span><br>
        <span class="h6">Email: </span><span><a href="mailto:<?php print $restaurant->email ?>"><?php echo $restaurant->email ?></a></span><br>
        <span class="h6">Telephone: </span><span><?php echo $restaurant->phone ?></span><br>
        <br>
        <table class="table" style="right: unset;">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Dish</th>
                <th scope="col">Quantity</th>
                <th scope="col"></th>
            </tr>
            </thead>
            <tbody>
            <?php $i = 1 ?>
            <?php foreach ($listings as $listing): ?>
            <tr>
                <th scope="row"><?php echo $i++ ?></th>
                <td><?php echo $listing->title ?></td>
                <td><?php echo $listing->portions ?></td>
                <?php if (count($listing_IDs)>1): ?>
                <td style="text-align: right">
                    <form method="post" action="confirm-order.php">
                        <select hidden class="form-control col-4" name="pickup-time">
                            <option selected><?php echo $_POST['pickup-time'] ?></option>
                        </select>
                        <select hidden class="form-control col-4" name="listings">
                            <option selected><?php print base64_encode(serialize($listing_IDs)) ?></option>
                        </select>
                        <button class="btn btn-danger" name="deleted" value="<?php print($listing->id) ?>"><i class="fa fa-trash"></i></button>
                    </form>
                </td>
                <?php endif ?>
            </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    <form action="place-order.php" method="post">
        <div class="col-12">
            <textarea type="text" class="form-control" rows="5" placeholder="Enter comments here" name="comments" style="margin-right:40px"></textarea>
        </div>
        <div class="row">
            <div class="col-md-5" style="margin: 15px auto">
                <a href="main-listing.php" class="btn btn-block btn-danger" >Cancel order</a>
            </div>
            <div class="col-md-5" style="margin: 15px auto">
                <select hidden name="restaurant">
                    <option selected><?php print $restaurant->id ?></option>
                </select>
                <select hidden name="pickup-time">
                    <option selected><?php echo $_POST['pickup-time'] ?></option>
                </select>
                <button type="submit" class="btn btn-primary btn-block" name="order" value="<?php print base64_encode(serialize($listing_IDs)) ?>">Place order</button>
            </div>
        </div>
    </form>
    </div>
</div>
<br>
<br>
<br>
<?php
$query = "SELECT id FROM listings WHERE restaurant_id = " . $restaurant->id . " AND listings.id NOT IN (SELECT listing_id FROM order_listings) AND CONCAT(listings.day_posted, \" \", listings.time_until) > NOW()";
$result = mysqli_query($conn, $query);
$available_listings = array();
for ($i = 1; $i <= mysqli_num_rows($result); $i++) {
    array_push($available_listings, mysqli_fetch_assoc($result)['id']);
}

$count = 0;
    foreach ($available_listings as $restaurant_listing) {
        if (!in_array($restaurant_listing, $listing_IDs)) {
            $count++;
        }
    }
if($count > 0): ?>
<hr>
        <h1>Other listings from the same restaurant</h1>
    <?php endif ?>
<?php foreach ($available_listings as $restaurant_listing) {
    if (!in_array($restaurant_listing, $listing_IDs)) {
        $available_listing = new Listing();
        $available_listing->setListingFromId($restaurant_listing); ?>
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-3">
                        <img src="<?php print($available_listing->image) ?>" style="max-height: 250px; max-width: 100%; border-radius: 5px">
                    </div>
                    <div class="col-9">
                        <h4><?php echo $available_listing->title ?></h4>
                        <form action="restaurant-account.php" method="post"> <h6>by
                                <button type="submit" name="restaurant" value="<?php echo $available_listing->restaurant_id ?>" class="btn-link"><?php echo $listing->restaurant_name ?></button>
                                .</h6></form>
                        <p><?php echo $available_listing->description ?></p>
                        <h6>Portions: <?php echo $available_listing->portions ?>.</h6>
                        <?php if (!empty($available_listing->allergen)) { ?>
                            <h6>Allergens: <?php
                                $count = count($available_listing->allergen);
                                for ($i = 0; $i<$count-1; $i++) {
                                echo $available_listing->allergen[$i].", ";
                                }
                                echo $available_listing->allergen[$count-1];
                                ?></h6>
                        <?php }     ?>
                        <br>
                        <form method="post" action="confirm-order.php">
                            <select hidden class="form-control col-4" name="pickup-time">
                                <option selected><?php echo $_POST['pickup-time'] ?></option>
                            </select>
                            <select hidden class="form-control col-4" name="added-listing">
                                <option selected><?php echo $available_listing->id ?></option>
                            </select>
                            <button type="submit" name="listings" class="btn btn-primary" value="<?php print base64_encode(serialize($listing_IDs)) ?>">Add to order</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <br>
<?php
    }
} ?>
</div>
</body>
</html>