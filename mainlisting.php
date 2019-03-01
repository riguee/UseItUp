<!DOCTYPE html>
<div lang="en">
<head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/css/bootstrap-select.css" />
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
    <link href="styles.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta charset="UTF-8">
    <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/js/bootstrap-select.min.js"></script>
    <title>All listings</title>
</head>
    <body class="container-fluid">
    <?php include 'connection.php' ?>
        <h1>Welcome back, <span class="accent">charity_name</span>.</h1>
        <form class="form-inline d-flex justify-content-center" method="post" action="">
            <input type="text" class="form-control col-4" name="search" placeholder="Search for food">
            <button type="submit" class="btn btn-primary search-btn"><i class="fa fa-search"></i></button>
        </form>
        <br>
        <!-- ASK DAN IF THIS IS THE RIGHT THING TO DO (the action="" above is empty instead of linking to another page) -->
        <div class="d-flex justify-content-center">
            <div class="col-md-5">
                <div class="card">
                    <div class="card-header" id="heading">Advanced search</div>
                    <div class="card-body">
                        <form method="post" action="">
                        <span style="margin-right: 10px">Sort by:</span>
                        <div class="form-check form-check-inline" style="margin: 0 0 10px 0">
                            <input class="form-check-input" type="radio" name="distance" id="distance">
                            <label style="margin-right: 5px" class="form-check-label" for="distance">distance</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="pickup-time" id="pickup-time">
                            <label class="form-check-label" for="pickup-time">pick-up time</label>
                        </div>
                        <div class="form-inline" style="margin: 20px 0 10px 0">
                            <span style="margin-right: 10px">Portions:</span>
                            <select class="form-control" name="portions">
                                <option>Show all</option>
                                <option>0-10</option>
                                <option>10-30</option>
                                <option>30-50</option>
                                <option>50-100</option>
                                <option>100-300</option>
                                <option>300+</option>
                            </select>
                        </div>
                        <br>
                        <p>Refine your search by excluding specific allergens:</p>
                            <div class="form-check" style="padding-left: 0px">
                            <select name="allergen[]" class="selectpicker" multiple data-live-search="true">
                                <?php
                                $stmt = $conn->prepare("SELECT * FROM allergens");
                                $stmt->execute();
                                $result = $stmt->get_result();
                                if (mysqli_num_rows($result) > 0) {
                                    // output data of each row
                                    while($row = $result->fetch_assoc()) {
                                        echo "<option value='".$row["id"]."'>".$row["allergen"]."</option>";
                                    }
                                }
                                ?>
                            </select>
                            </div>
                        <br>
                        <span>Only show specific diets:</span>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="diet1">
                            <label class="form-check-label" for="diet1">
                                Vegetarian
                            </label>
                        </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="diet1">
                                <label class="form-check-label" for="diet1">
                                    Vegan
                                </label>
                            </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="diet2">
                            <label class="form-check-label" for="diet2">
                                Halal
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="diet3">
                            <label class="form-check-label" for="diet3">
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
        $search = $_POST['search'];
        include 'connection.php';
        include 'Listings.php';
        $query = "SELECT id FROM listings WHERE title LIKE \"%".$search."%\";";
        $result = mysqli_query($conn, $query);
        while ($row = mysqli_fetch_assoc($result)) {
            $listing = new Listing();
            $listing->setListingFromId($row['id']);?>
        <div class="card container-fluid" style="margin:10px 0 10px 0">
            <div class="card-body row" style="height: 300px">
                <img class="col-3" src="https://thumbs.dreamstime.com/z/chef-showing-pasta-11270828.jpg" style="height: 250px">
                <div class="col-9">
                    <h4><?php echo $listing->title ?></h4>
                    <h6>by <a href="#"><?php echo $listing->restaurant_name ?></a>.</h6>
                    <p><?php echo $listing->description ?></p>
                    <h6>Portions: <?php echo $listing->portions ?></h6>
                    <?php if (!empty($listing->allergen)) { ?>
                    <h6>Allergens: <?php
                        $count = count($listing->allergen);
                        for ($i = 0; $i<$count-1; $i++) {
                            echo $listing->allergen[$i].", ";
                        }
                        echo $listing->allergen[$count-1];
                        ?></h6>
                    <?php } ?>
                    <h6>Available pickup times: between <?php echo date("H:i", strtotime($listing->time_from)) ?> and <?php echo date("H:i", strtotime($listing->time_until)) ?></h6>
                    <br>
                    <form class="form-inline" method="post" action="confirm-order.php">
                        <span style="margin-right: 10px">Select pickup time</span>
                        <select class="form-control col-4" name="pickup-time">
                            <?php $time = date("H:i", strtotime($listing->time_from));
                            while ($time < date("H:i", strtotime($listing->time_until))) { ?>
                            <option><?php echo $time ?></option>
                            <?php $time = date("H:i", strtotime('+30 minutes', strtotime($time)));
                            } ?>
                        </select>
                        <span style="margin: 0 10px 0 10px"> and </span>
                        <button type="submit" class="btn btn-primary col-4" name="listing" value="<?php print($listing->id) ?>" >Order</button>
                    </form>
                </div>
            </div>
        </div>
        <?php }; ?>

        </div>
    </body>
</html>