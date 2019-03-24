<!DOCTYPE html>
<div lang="en"></div>
<head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/css/bootstrap-select.css" />
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
    <link href="styles.css" rel="stylesheet" type="text/css">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta charset="UTF-8">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/js/bootstrap-select.min.js"></script>
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
                alert("You have to input a pickup time.")
                return false;
            }
        }

        function transferSearch() {
            var search = document.getElementById("search").value;
            document.getElementById("advancedsearchbar").value = search;
        }
    </script>
    <title>All listings</title>
</head>
    <body>
    <?php
    include 'connection.php';
    session_start();
    if (empty($_SESSION)) {
        header( "location: login.php" );
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
        <h1>Welcome back, <span class="accent"><?php echo $_SESSION['name']?></span>.</h1>
        <form class="form-inline d-flex justify-content-center" method="post" action="">
            <input id="search" type="search" class="form-control col-4" name="search" placeholder="Search for food" value="<?php if (isset($_POST['search'])) {print($_POST['search']);} elseif (isset($_POST['advanced-search'])) {print($_POST['advanced-search']);} ?>">
            <button type="submit" class="btn btn-primary search-btn"><i class="fa fa-search"></i></button>
        </form>
        <br>
        <div class="d-flex justify-content-center">
            <div class="col-md-5">
                <div class="card">
                    <div class="card-header" id="heading"><button type="button" style="padding: 0" class="btn btn-link" data-toggle="collapse" data-target="#advanced-search">Advanced search<i style="margin-left: 10px" class="fas fa-chevron-down"></i></button></div>
                    <div id="advanced-search" class="collapse card-body">
                        <form method="post" action="" onsubmit="return transferSearch()">
                            <input type="search" name="advanced-search" id="advancedsearchbar" value="" hidden>
                            <span style="margin-right: 10px">Sort by pick-up time:</span>
                            <div class="form-check form-check-inline" style="margin: 0 0 10px 0">
                                <input class="form-check-input" type="radio" name="sort-by" id="earliest" value="earliest" <?php if (isset($_POST['sort-by'])) {if ($_POST['sort-by'] == 'earliest') {print('checked');}} else {print('checked');} ?>>
                                <label style="margin-right: 5px; font-weight: unset" class="form-check-label" for="earliest">earliest first</label>
                                <input class="form-check-input" type="radio" name="sort-by" id="latest" value="latest" <?php if (isset($_POST['sort-by']) && $_POST['sort-by'] == 'latest') {print('checked');} ?>>
                                <label style="font-weight: unset" class="form-check-label" for="latest">latest first</label>
                            </div>
                            <div class="form-inline" style="margin: 20px 0 10px 0">
                                <label style="margin-right: 10px; font-weight: unset" for="portions">Portions:</label>
                                <select class="form-control" name="portions" id="portions">
                                    <option <?php if (isset($_POST['portions'])) {if ($_POST['portions'] == 'all') {print('selected="selected"');}} else {print('selected="selected"');} ?> value="all">Show all</option>
                                    <option value="low" <?php if (isset($_POST['portions']) && $_POST['portions'] == 'low') {print('selected="selected"');} ?>>0-49</option>
                                    <option value="medium" <?php if (isset($_POST['portions']) && $_POST['portions'] == 'medium') {print('selected="selected"');} ?>>50-99</option>
                                    <option value="high" <?php if (isset($_POST['portions']) && $_POST['portions'] == 'high') {print('selected="selected"');} ?>>100+</option>
                                </select>
                            </div>
                            <br>
                            <label for="allergens" style="font-weight: unset">Refine your search by excluding specific allergens:</label>
                                <div class="form-check" style="padding-left: 0px">
                                <select name="allergen[]" class="selectpicker" multiple data-live-search="true" id="allergens">
                                    <?php
                                    $stmt = $conn->prepare("SELECT * FROM allergens");
                                    $stmt->execute();
                                    $result = $stmt->get_result();
                                    if (mysqli_num_rows($result) > 0) {
                                        // output data of each row
                                        while($row = $result->fetch_assoc()) { ?>
                                            <option <?php if(isset($_POST['allergen'])&&  in_array($row["id"], $_POST['allergen'])) {print('selected="selected"');} ?> value="<?php print($row["id"])?>"><?php echo $row["allergen"] ?></option>
                                        <?php }
                                    }
                                    ?>
                                </select>
                                </div>
                            <br>
                            <span>Only show specific diets:</span>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="3" id="vegetarian" name="diet[]" <?php if (isset($_POST['diet']) && in_array("3", $_POST['diet'])) {print("checked");} ?>>
                                <label style="font-weight: unset" class="form-check-label" for="vegetarian">
                                    Vegetarian
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="4" id="vegan" name="diet[]" <?php if (isset($_POST['diet']) && in_array("4", $_POST['diet'])) {print("checked");} ?>>
                                <label style="font-weight: unset" class="form-check-label" for="vegan">
                                    Vegan
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="1" id="halal" name="diet[]" <?php if (isset($_POST['diet']) && in_array("1", $_POST['diet'])) {print("checked");} ?>>
                                <label style="font-weight: unset" class="form-check-label" for="halal">
                                    Halal
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="2" id="kosher" name="diet[]" <?php if (isset($_POST['diet']) && in_array("2", $_POST['diet'])) {print("checked");} ?>>
                                <label style="font-weight: unset" class="form-check-label" for="kosher">
                                    Kosher
                                </label>
                            </div>
                            <br>
                            <button type="submit" class="btn btn-primary btn-block">Apply</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
            <br>
        <?php
        include 'connection.php';
        include 'Listings.php';
        if (isset($_POST['advanced-search'])) {
            include 'advanced-search.php';
        }
        else {
            if (isset($_POST['search'])) {
                $search = $_POST['search'];
            }
            else {
                $search = "";
            }
            $search_funct = $conn->prepare("SELECT id FROM listings WHERE (listings.title LIKE CONCAT('%',?,'%') OR listings.description LIKE CONCAT('%',?,'%')) AND listings.id NOT IN (SELECT listing_id FROM order_listings) AND CONCAT(listings.day_posted, \" \", listings.time_until) > NOW() ");
            $search_funct->bind_param("ss", $search, $search);
            $search_funct->execute();
            $result = $search_funct->get_result();
        }
        while ($row = $result->fetch_assoc()) {
            $listing = new Listing();
            $listing->setListingFromId($row['id']);?>
        <div class="card container-fluid" style="margin:10px 0 10px 0">
            <div class="card-body" style="min-height: 300px">
                <div class="row">
                    <div class="col-3">
                        <img src="<?php print($listing->image) ?>" style="max-height: 250px; max-width: 100%; border-radius: 5px">
                    </div>
                    <div class="col-9">
                        <h4><?php echo $listing->title ?></h4>
                        <form action="restaurant-account.php" method="post"> <h6>by
                                <button type="submit" name="restaurant" value="<?php echo $listing->restaurant_id ?>" class="btn-link"><?php echo $listing->restaurant_name ?></button>
                            .</h6></form>
                        <p><?php echo $listing->description ?></p>
                        <h6>Portions: <?php echo $listing->portions ?></h6>
                        <?php if (!empty($listing->allergen)) { ?>
                        <h6>Allergens: <?php
                            $count = count($listing->allergen);
                            for ($i = 0; $i < $count - 1; $i++) {
                                echo $listing->allergen[$i] . ", ";
                            }
                            echo $listing->allergen[$count - 1];
                            }
                            ?></h6>
                        <?php if (isset($listing->diet)) { ?>
                            <h6>Suitable for: <?php
                                $count = count($listing->diet);
                                for ($i = 0; $i<$count-1; $i++) {
                                    echo $listing->diet[$i].", ";
                                }
                        echo $listing->diet[$count-1];
                        ?></h6>
                        <?php } ?>
                        <h6>Available pickup times: between
                            <span id="<?php print("timefrom" . $listing->id) ?>"><?php echo date("H:i", strtotime($listing->time_from)) ?>
                            </span> and
                            <span id="<?php print("timeuntil" . $listing->id) ?>"><?php echo date("H:i", strtotime($listing->time_until)) ?>
                            </span>
                        </h6>
                        <br>
                        <form class="form-inline row" method="post" action="confirm-order.php" onsubmit="return timeCheck(<?php print($listing->id) ?>)">
                            <span style="margin-right: 10px">Choose pickup time</span>
                            <input type="time" class="form-control" id="<?php print($listing->id) ?>" name="pickup-time">
                            <span style="margin: 0 10px 0 10px"> and </span>
                            <button type="submit" class="btn btn-primary col-4" name="listing" value="<?php print($listing->id) ?>" >Order</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <?php }; ?>

        </div>
</div>
    </body>
</html>
