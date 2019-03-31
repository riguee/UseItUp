
<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/css/bootstrap-select.css" />
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="styles.css">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta charset="UTF-8">
    <title>My account</title>
</head>
<body>

<?php
include 'Restaurants.php';
include 'Charities.php';
include 'Listings.php';
include 'connection.php';
session_start();
if (empty($_SESSION)) {
    header( "location: Login.php" );
} elseif ($_SESSION['user_type'] == 'charity') {
    header("location: my-account-charity.php");
} elseif ($_SESSION['user_type'] == 'restaurant') {
    include 'navbar-restaurant.php';
} else {
    header( "location: Logout.php" );
}
$id = $_SESSION['id'];
$restaurant = new Restaurant();
$user = new Restaurant();
$user->setRestaurantFromId($id);

?>
<script>
    function editrest() {
        if (document.getElementById('email').hasAttribute('readonly')){
            document.getElementById('name').removeAttribute("readonly");
            document.getElementById('email').removeAttribute("readonly");
            document.getElementById('phone').removeAttribute("readonly");
            document.getElementById('address').removeAttribute("readonly");
            document.getElementById('postcode').removeAttribute("readonly");
            document.getElementById('confirm').hidden = false;
            document.getElementById('confirm').disabled = false;
            document.getElementById('editrest').classList.remove("btn-primary");
            document.getElementById('editrest').classList.add("btn-danger");
            document.getElementById('editrest').innerHTML = "Cancel changes";
            document.getElementById('hours').classList.add('hours');
            document.getElementById('edit-hours').classList.remove('hours');
        }
        else {
            document.getElementById('name').readOnly = true;
            document.getElementById('name').value = "<?php echo $user->name ?>";
            document.getElementById('email').readOnly = true;
            document.getElementById('email').value = "<?php echo $user->email ?>";
            document.getElementById('phone').readOnly = true;
            document.getElementById('phone').value = "<?php echo $user->phone ?>";
            document.getElementById('address').readOnly = true;
            document.getElementById('address').value = "<?php echo $user->address ?>";
            document.getElementById('postcode').readOnly = true;
            document.getElementById('postcode').value = "<?php echo $user->postcode ?>";
            document.getElementById('confirm').hidden = true;
            document.getElementById('confirm').disabled = true;
            document.getElementById('editrest').classList.remove("btn-secondary");
            document.getElementById('editrest').classList.add("btn-primary");
            document.getElementById('editrest').innerHTML = "Edit details";
            document.getElementById('hours').classList.remove('hours');
            document.getElementById('edit-hours').classList.add('hours');
        }
    }
    function disable(day) {
        $element_from = day + "_from";
        $element_until = day + "_until";
        $element_btn = "closed_" + day;
        $day = day;
        if (!document.getElementById($element_from).hasAttribute('disabled')){
            document.getElementById($element_from).value = "";
            document.getElementById($element_until).value = "";
            document.getElementById($element_from).disabled = true;
            document.getElementById($element_until).disabled = true;
            document.getElementById($element_btn).value = "Enable pick-up on " + day.charAt(0).toUpperCase() + day.slice(1) + "s";
            document.getElementById($element_btn).classList.remove("btn-secondary");
            document.getElementById($element_btn).classList.add("btn-primary");
            document.getElementById($day).checked = true;
        }
        else {
            document.getElementById($element_from).removeAttribute("disabled");
            document.getElementById($element_until).removeAttribute("disabled");
            if (document.getElementById($element_from + "_display") === null) {
                document.getElementById($element_from).value = "00:00:00";
                document.getElementById($element_until).value = "00:00:00";
            } else {
                document.getElementById($element_from).value = document.getElementById($element_from + "_display").value;
                document.getElementById($element_until).value = document.getElementById($element_until + "_display").value;
            }

            document.getElementById($element_btn).value = "Disable pick-up on " + day.charAt(0).toUpperCase() + day.slice(1) + "s";
            document.getElementById($element_btn).classList.remove("btn-primary");
            document.getElementById($element_btn).classList.add("btn-secondary");
            document.getElementById($day).checked = false;
        }
    }
</script>

<div class="container">
    <h1>My account</h1>
    <button type='button' class='btn-edit btn btn-primary btn-block col-sm-10 col-md-6 mx-auto' onclick='editrest();' id='editrest'>Edit details</button>
    <form method="post" action="edit-account.php">
        <input type="hidden" name="user_type" value="<?php echo $_SESSION['user_type'] ?>">
        <div class="col-sm-10 col-md-6 my-1 mx-auto">
            <div class="input-group">
                <div class="input-group-prepend">
                    <div class="input-group-text">Name</div>
                </div>
                <input type="text" class="form-control" placeholder="Name" name="name" id="name" value="<?php echo $user->name ?>" readonly>
            </div>
        </div>
        <div class="col-sm-10 col-md-6 my-1 mx-auto">
            <div class="input-group">
                <div class="input-group-prepend">
                    <div class="input-group-text">Email</div>
                </div>
                <input type="email" class="form-control" placeholder="Email" name="email" id="email" value="<?php echo $user->email ?>" readonly>
            </div>
        </div>
        <div class="col-sm-10 col-md-6 my-1 mx-auto">
            <div class="input-group">
                <div class="input-group-prepend">
                    <div class="input-group-text">Phone</div>
                </div>
                <input type="text" class="form-control" placeholder="Phone Number" name="phone" id="phone" value="<?php echo $user->phone ?>" readonly>
            </div>
        </div>
        <div class="col-sm-10 col-md-6 my-1 mx-auto">
            <div class="input-group">
                <div class="input-group-prepend">
                    <div class="input-group-text">Address</div>
                </div>
                <input type="text" class="form-control" placeholder="Address" name="address" id="address" value="<?php echo $user->address ?>" readonly>
            </div>
        </div>
        <div class="col-sm-10 col-md-6 my-1 mx-auto">
            <div class="input-group">
                <div class="input-group-prepend">
                    <div class="input-group-text">Postcode</div>
                </div>
                <input type="text" class="form-control" placeholder="Postcode" name="postcode" id="postcode" value="<?php echo $user->postcode ?>" readonly>
            </div>
        </div>
        <hr>
        <h3 class="details">Available times for pick-up</h3>
        <div id="hours">
            <?php
            $days = array('monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday', 'sunday');
            foreach ($days as $day) {
                if ($user->{$day . "_from"} != NULL) { ?>
                    <div class="col-sm-10 col-md-6 my-1 mx-auto">
                        <label for="<?php echo $day . "_from_display" ?>"><?php echo ucfirst($day) ?></label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <div class="input-group-text">From</div>
                            </div>
                            <input type="time" class="form-control" id="<?php echo $day . "_from_display" ?>" name="<?php echo $day . "_from_display" ?>" value="<?php echo $user->{$day . "_from"} ?>" readonly >
                            <div class="input-group-append">
                                <div class="input-group-text">Until</div>
                            </div>
                            <input type="time" class="form-control" id="<?php echo $day . "_until_display" ?>" name="<?php echo $day . "_until_display" ?>" value="<?php echo $user->{$day . "_until"} ?>" readonly>
                        </div>
                    </div>
                <?php }
                else { ?>
                    <div class="col-sm-10 col-md-6 my-1 mx-auto">
                        <label for="<?php echo "display_closed_" . $day ?>"><?php echo ucfirst($day) ?></label>
                        <input type="button" class="btn btn-secondary btn-check" id="<?php echo "display_closed_" . $day ?>" value="Pickup is disabled on <?php echo ucfirst($day) . "s" ?>" disabled>
                    </div>
                <?php }
            }
            ?>
        </div>
        <div class="hours" id="edit-hours">
            <?php
            foreach ($days as $day) {
                if ($user->{$day . "_from"} != NULL) { ?>
                    <div class="col-sm-10 col-md-6 my-1 mx-auto">
                        <label for="<?php echo $day . "_from" ?>"><?php echo ucfirst($day) ?></label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <div class="input-group-text">From</div>
                            </div>
                            <input type="time" class="form-control" id="<?php echo $day . "_from" ?>" name="<?php echo $day . "_from" ?>" id="phone" value="<?php echo $user->{$day . "_from"} ?>" >
                            <div class="input-group-append">
                                <div class="input-group-text">Until</div>
                            </div>
                            <input type="time" class="form-control" id="<?php echo $day . "_until" ?>" name="<?php echo $day . "_until" ?>" value="<?php echo $user->{$day . "_until"} ?>" >
                        </div>
                        <input type="button" class="btn btn-secondary btn-check btn-hours" id="<?php echo "closed_" . $day ?>" value="Disable pick-up on <?php echo ucfirst($day) . "s" ?>" onclick="disable('<?php echo $day ?>');">
                        <input type="checkbox" name="<?php echo "closed_" . $day ?>" id="<?php echo  $day ?>" value="1" style="display: none;">
                    </div>
                <?php }
                else { ?>
                    <div class="col-sm-10 col-md-6 my-1 mx-auto">
                        <label for="<?php echo $day . "_from" ?>"><?php echo ucfirst($day) ?></label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <div class="input-group-text">From</div>
                            </div>
                            <input type="time" class="form-control" id="<?php echo $day . "_from" ?>" name="<?php echo $day . "_from" ?>" id="phone" value="<?php echo $user->{$day . "_from"} ?>" disabled>
                            <div class="input-group-append">
                                <div class="input-group-text">Until</div>
                            </div>
                            <input type="time" class="form-control" id="<?php echo $day . "_until" ?>" name="<?php echo $day . "_until" ?>" value="<?php echo $user->{$day . "_until"} ?>" disabled>
                        </div>
                        <input type="button" class="btn btn-primary btn-check btn-hours" id="<?php echo "closed_" . $day ?>" value="Enable pick-up on <?php echo ucfirst($day) . "s" ?>" onclick="disable('<?php echo $day ?>');">
                        <input type="checkbox" name="<?php echo "closed_" . $day ?>" id="<?php echo  $day ?>" value="1" style="display: none;">
                    </div>
                <?php }
            }
            ?>
        </div>
        <button type='submit' class='btn btn-primary btn-block col-sm-10 col-md-6 my-1 mx-auto' id='confirm' hidden disabled>Confirm changes</button>
    </form>
    <br>
    <?php
        $result = $conn->query("SELECT id FROM listings WHERE listings.id NOT IN (SELECT listing_id FROM order_listings) AND CONCAT(listings.day_posted, \" \", listings.time_until) > NOW() AND restaurant_id = " . $_SESSION['id']);
        if (mysqli_num_rows($result) > 0) { ?>
    <hr>
    <h1>Your available listings</h1>
    <?php
            while ($row = $result->fetch_assoc()) {
                $listing = new Listing();
                $listing->setListingFromId($row['id']);
                $listing->displayMyAccount();
            }
        }
    ?>


</body>
</html>
