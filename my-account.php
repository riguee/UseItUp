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
        header( "location: login.php" );
    } elseif ($_SESSION['user_type'] == 'charity') {
        include 'navbar-charity.php';
    } elseif ($_SESSION['user_type'] == 'restaurant') {
        include 'navbar-restaurant.php';
    } else {
        header( "location: logout.php" );
    }
    $id = $_SESSION['id'];
    $restaurant = new Restaurant();
    if ($_SESSION['user_type'] == 'restaurant'){
        $user = new Restaurant();
        $user->setRestaurantFromId($id);
    } else {
        $user = new Charity();
        $user->setCharityFromId($id);
    }
    ?>
    <script>

        function edit() {
            if (document.getElementById('email').hasAttribute('readonly')){
                document.getElementById('email').removeAttribute("readonly");
                document.getElementById('phone').removeAttribute("readonly");
                document.getElementById('address').removeAttribute("readonly");
                document.getElementById('postcode').removeAttribute("readonly");
                // if (typeof(document.getElementById('charityid'))!='undefined') {document.getElementById('charityid').removeAttribute("readonly")}
                document.getElementById('confirm').hidden = false;
                document.getElementById('confirm').disabled = false;
                document.getElementById('edit').classList.remove("btn-primary");
                document.getElementById('edit').classList.add("btn-danger");
                document.getElementById('edit').innerHTML = "Cancel changes";
                document.getElementById('hours').classList.add('hours');
                document.getElementById('edit_hours').classList.remove('hours');
            }
            else {
                document.getElementById('email').readOnly = true;
                document.getElementById('email').value = "<?php echo $user->email ?>";
                document.getElementById('phone').readOnly = true;
                document.getElementById('phone').value = "<?php echo $user->phone ?>";
                document.getElementById('address').readOnly = true;
                document.getElementById('address').value = "<?php echo $user->address ?>";
                document.getElementById('postcode').readOnly = true;
                document.getElementById('postcode').value = "<?php echo $user->postcode ?>";
                if (typeof(document.getElementById('charityid'))!='undefined') {
                    document.getElementById('charityid').readOnly = true;
                    document.getElementById('charityid').value = "<?php echo $user->charity_number ?>";
                }
                document.getElementById('confirm').hidden = true;
                document.getElementById('confirm').disabled = true;
                document.getElementById('edit').classList.remove("btn-danger");
                document.getElementById('edit').classList.add("btn-secondary");
                document.getElementById('edit').innerHTML = "Edit details";
                document.getElementById('hours').classList.remove('hours');
                document.getElementById('edit_hours').classList.add('hours');
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
                document.getElementById($element_btn).value = "The restaurant is open on " + day + "s.";
                document.getElementById($element_btn).classList.remove("btn-secondary");
                document.getElementById($element_btn).classList.add("btn-primary");
                document.getElementById($day).checked = true;
            }
            else {
                document.getElementById($element_from).removeAttribute("disabled");
                document.getElementById($element_until).removeAttribute("disabled");
                document.getElementById($element_from).value = document.getElementById($element_from + "_display").value;
                document.getElementById($element_until).value = document.getElementById($element_until + "_display").value;
                document.getElementById($element_btn).value = "The restaurant is closed on " + day + "s.";
                document.getElementById($element_btn).classList.remove("btn-primary");
                document.getElementById($element_btn).classList.add("btn-secondary");
                document.getElementById($day).checked = false;
            }

        }
    </script>

    <h1>My account</h1>
    <div class="container">
        <form>
            <div class="col-sm-10 col-md-6 my-1 mx-auto">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <div class="input-group-text">Name</div>
                    </div>
                    <input type="text" class="form-control" placeholder="Name" value="<?php echo $user->name ?>" readonly>
                </div>
            </div>
            <div class="col-sm-10 col-md-6 my-1 mx-auto">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <div class="input-group-text">Email</div>
                    </div>
                    <input type="email" name="email" class="form-control" placeholder="Email" id="email" value="<?php echo $user->email ?>" readonly>
                </div>
            </div>
            <div class="col-sm-10 col-md-6 my-1 mx-auto">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <div class="input-group-text">Phone</div>
                    </div>
                    <input type="text" name="phone" class="form-control" placeholder="Phone" id="phone" value="<?php echo $user->phone ?>" readonly>
                </div>
            </div>
            <div class="col-sm-10 col-md-6 my-1 mx-auto">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <div class="input-group-text">Address</div>
                    </div>
                    <input type="text" name="address" class="form-control" placeholder="Address" id="address" value="<?php echo $user->address ?>" readonly>
                </div>
            </div>
            <div class="col-sm-10 col-md-6 my-1 mx-auto">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <div class="input-group-text">Postcode</div>
                    </div>
                    <input type="text" name="postcode" class="form-control" placeholder="Postcode" id="postcode" value="<?php echo $user->postcode ?>" readonly>
                </div>
            </div>
            <?php
            if ($_SESSION['user_type'] == 'charity') { ?>
                <div class="col-sm-10 col-md-6 my-1 mx-auto">
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <div class="input-group-text">Charity number</div>
                        </div>
                        <input type="text" name="charityid" class="form-control" placeholder="Charity number" id="charityid" value="<?php echo $user->charity_number ?>" readonly>
                    </div>
                </div>
            <?php
            } elseif ($_SESSION['user_type'] == "restaurant") { ?>
                <div id='hours'>
                    <hr>
                    <h3 style="text-align: center">Available times for pick-up</h3>
                <?php
                $days = array('monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday', 'sunday');
                foreach ($days as $day) {
                    if ($user->{$day . "_from"} != NULL) {
                        ?>
                        <div class="col-sm-10 col-md-6 my-1 mx-auto">
                            <label for="<?php echo $day . "_from_display" ?>"><?php echo ucfirst($day) ?></label>
                            <div class="input-group" style="margin-bottom: 10px">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">From</div>
                                </div>
                                <input type="time" id="<?php echo $day . "_from_display" ?>" class="form-control" value="<?php echo $user->{$day . "_from"} ?>" name="<?php echo $day . "_from_display" ?>" readonly>
                                <div class="input-group-prepend">
                                    <div class="input-group-text">Until</div>
                                </div>
                                <input type="time" class="form-control" id="<?php echo $day . "_until_display" ?>" value="<?php echo $user->{$day . "_until"} ?>" name="<?php echo $day . "_until_display" ?>" readonly>
                            </div>
                        </div>
                        <?php
                    }  else {
                        ?>
                        <div class="col-sm-10 col-md-6 my-1 mx-auto">
                            <label for="<?php echo $day . "_from_display" ?>"><?php echo ucfirst($day) ?></label>
                            <input id="<?php echo $day . "_from_display" ?>" type="button" class="btn btn-secondary btn-check" style="margin-bottom: 10px" id="<?php echo "display_closed_" . $day ?>"
                                   value="Food cannot be picked up on <?php echo ucfirst($day) . "s" ?>" disabled>
                        </div>
                    <?php }
                } ?>
                </div>
                <div class='hours' id='edit_hours'>
                    <?php
                foreach ($days as $day) {
                    if ($user->{$day . "_from"} != NULL) {?>
                        <div class="col-sm-10 col-md-6 my-1 mx-auto">
                            <label for="<?php echo $day . "_from" ?>"><?php echo ucfirst($day) ?></label>
                            <div class="input-group" style="margin-bottom: 10px">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">From</div>
                                </div>
                                <input type="time" id="<?php echo $day . "_from" ?>" class="form-control" value="<?php echo $user->{$day . "_from"} ?>" name="<?php echo $day . "_from" ?>">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">Until</div>
                                </div>
                                <input type="time" class="form-control" id="<?php echo $day . "_until" ?>" value="<?php echo $user->{$day . "_until"} ?>" name="<?php echo $day . "_until" ?>" >
                            </div>
                        </div>
                        <input type="button" class="btn btn-secondary btn-check" id="<?php echo "closed_" . $day ?>" value="The restaurant is closed on <?php echo $day . "s" ?>" onclick="disable('<?php echo $day ?>');">
                        <input type="checkbox" name="<?php echo "closed_" . $day ?>" id="<?php echo  $day ?>" value="1" style="display: none;">
                        <br>
                        <?php
                    } else { ?>
                        <div class="col-sm-10 col-md-6 my-1 mx-auto">
                            <label for="<?php echo $day . "_from" ?>"><?php echo ucfirst($day) ?></label>
                            <div class="input-group" style="margin-bottom: 10px">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">From</div>
                                </div>
                                <input type="time" id="<?php echo $day . "_from" ?>" class="form-control" value="<?php echo $user->{$day . "_from"} ?>" name="<?php echo $day . "_from" ?>" disabled>
                                <div class="input-group-prepend">
                                    <div class="input-group-text">Until</div>
                                </div>
                                <input type="time" class="form-control" id="<?php echo $day . "_until" ?>" value="<?php echo $user->{$day . "_until"} ?>" name="<?php echo $day . "_until" ?>" disabled>
                            </div>
                        </div>
                        <input type="button" class="btn btn-secondary btn-check" id="<?php echo "closed_" . $day ?>" value="The restaurant is open on <?php echo $day . "s" ?>" onclick="disable('<?php echo $day ?>');">
                        <input type="checkbox" name="<?php echo "closed_" . $day ?>" id="<?php echo  $day ?>" value="1" style="display: none;">
                        <br>
                        <?php
                    }
                } ?>
                </div>
            <?php
            }
            ?>
            <button type='submit' class='btn btn-primary btn-block' id='confirm' hidden disabled>Confirm changes</button>
        </form>
        <button style="margin-top:10px" type='button' class='btn btn-secondary btn-block' onclick='edit();' id='edit'>Edit details</button>


        <?php
        if  ($_SESSION['user_type'] == 'restaurant') { ?>
        <hr>
        <h1>Your available upcoming listings</h1>
        <?php
            $result = $conn->query("SELECT id FROM listings WHERE listings.id NOT IN (SELECT listing_id FROM order_listings) AND CONCAT(listings.day_posted, \" \", listings.time_until) > NOW() AND restaurant_id = " . $_SESSION['id']);
            if (mysqli_num_rows($result) > 0) {
                while ($row = $result->fetch_assoc()) {
                $listing = new Listing();
                $listing->setListingFromId($row['id']);
                $listing->displayMyAccount();
                }
            }
        }
        ?>

    </div>
</body>