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
<?php
session_start();
if (empty($_SESSION)) {
    header( "location: index.php" );
} elseif (!isset($_POST['charity'])) {
    header("location: main-listing.php");
} elseif ($_SESSION['user_type'] == 'charity') {
    if ($_SESSION['id'] == $_POST['charity']) {
        header( "location: my-account-charity.php" );
    } else {include "navbar-charity.php";}
} elseif ($_SESSION['user_type'] == 'restaurant') {
    include "navbar-restaurant.php";
} else {
    header( "location: Logout.php" );
}
?>
<div class="container">
    <?php
    include 'Charities.php';
    include 'connection.php';
    $char_id = $_POST['charity'];
    $charity = new Charity();
    $charity->setCharityFromId($char_id);
    ?>
    <h1><?php echo $charity->name ?></h1>
    <div class="col-6 mx-auto">
        <div class="form-group row">
            <label for="email" class="col-4 col-form-label">Email</label>
            <div class="col-8">
                <input type="text" readonly class="form-control-plaintext" id="email" value="<?php echo $charity->email ?>">
            </div>
        </div>
        <div class="form-group row">
            <label for="phone" class="col-4 col-form-label">Phone</label>
            <div class="col-8">
                <input type="text" readonly class="form-control-plaintext" id="phone" value="<?php echo $charity->phone ?>">
            </div>
        </div>
        <div class="form-group row">
            <label for="address" class="col-4 col-form-label">Address</label>
            <div class="col-8">
                <input type="text" readonly class="form-control-plaintext" id="address" value="<?php echo $charity->address ?>">
            </div>
        </div>
        <div class="form-group row">
            <label for="postcode" class="col-4 col-form-label">Postcode</label>
            <div class="col-8">
                <input type="text" readonly class="form-control-plaintext" id="postcode" value="<?php echo $charity->postcode ?>">
            </div>
        </div>
        <div class="form-group row">
            <label for="charity_number" class="col-4 col-form-label">Charity number</label>
            <div class="col-8">
                <input type="text" readonly class="form-control-plaintext" id="charity_number" value="<?php echo $charity->charity_number ?>">
            </div>
        </div>
    </div>
</div>
</body>
</html>

