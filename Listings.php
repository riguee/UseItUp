<?php

class Listing
{
    public $id, $title, $description, $portions, $time_from, $time_until, $allergen, $diet, $restaurant_name, $restaurant_id, $image ;
    function setListingFromId($id) {
        include 'connection.php';
        $query = "SELECT id, title, description, portions, time_from, time_until, image FROM listings WHERE id = ". $id;
        if ($result = $conn->query($query)) {
            ($result = $result->fetch_assoc());
            $this->title = $result['title'];
            $this->description = $result['description'];
            $this->portions = $result['portions'];
            $this->time_from = $result['time_from'];
            $this->time_until = $result['time_until'];
            $this->image = $result['image'];

            $this->id = $id;

            $restaurantquery = "SELECT restaurants.name, restaurants.id FROM listings JOIN restaurants ON listings.restaurant_id = restaurants.id WHERE listings.id = ". $id;
            $this->restaurant_name = mysqli_fetch_assoc(mysqli_query($conn, $restaurantquery))['name'];
            $this->restaurant_id = mysqli_fetch_assoc(mysqli_query($conn, $restaurantquery))['id'];

            $stmt = $conn->prepare("SELECT allergens.allergen FROM allergens JOIN allergen_listings ON allergens.id=allergen_listings.allergen_id JOIN listings ON listings.id=allergen_listings.listing_id WHERE listings.id=".$id);
            $stmt->execute();
            $allergenresult = $stmt->get_result();
            if (mysqli_num_rows($allergenresult) > 0) {
                $allergenlist = array();
                // output data of each row
                while($row = $allergenresult->fetch_row()) {
                    array_push($allergenlist,$row[0]);
                    $this->allergen = $allergenlist;
                }
            }

            $dietstmt = $conn->prepare("SELECT diets.diet FROM diets JOIN diet_listings ON diets.id=diet_listings.diet_id JOIN listings ON listings.id=diet_listings.listing_id WHERE listings.id=".$id);
            $dietstmt->execute();
            $dietresult = $dietstmt->get_result();
            if (mysqli_num_rows($dietresult) > 0) {
                $dietlist = array();
                // output data of each row
                while($row = $dietresult->fetch_row()) {
                    array_push($dietlist,$row[0]);
                }
                $this->diet = $dietlist;
            }
        }
    }

    function displayCreated() {?>
        <div class="card">
            <h5 class="card-header">Listing number: <?php echo $this->id; ?></h5>
            <div class="row">
                <div class="col-4">
                    <div class="middle">
                        <img src="<?php echo $this->image ?>" width="150 px">
                    </div>
                </div>
                <div class="col-8">
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
                            echo "<li>".$this_diet."</li>";
                        }
                        echo "</ul>";
                    }
                    else {
                        echo "No diets";
                    }
                    ?>
                    <p>Pickup window:<br><?php echo $this->time_from; ?><br><?php echo $this->time_until; ?></p>
            </div>
        </div>
        </div>

        <?php
    }
    function displayAccount() {?>
        <div class="card container-fluid displ-card">
            <div class="card-body displ-card-body">
                <div class="row">
                    <div class="col-3">
                        <img src="<?php print($this->image) ?>" class="listing-img">
                    </div>
                    <div class="col-9">
                        <h4><?php echo $this->title ?></h4>

                        <p><?php echo $this->description ?></p>
                        <h6>Portions: <?php echo $this->portions ?></h6>
                        <?php if (!empty($this->allergen)) { ?>
                        <h6>Allergens: <?php
                            $count = count($this->allergen);
                            for ($i = 0; $i < $count - 1; $i++) {
                                echo $this->allergen[$i] . ", ";
                            }
                            echo $this->allergen[$count - 1];
                            }
                            ?></h6>
                        <?php if (isset($this->diet)) { ?>
                            <h6>Suitable for: <?php
                                $count = count($this->diet);
                                for ($i = 0; $i<$count-1; $i++) {
                                    echo $this->diet[$i].", ";
                                }
                                echo $this->diet[$count-1];
                                ?></h6>
                        <?php } ?>
                        <h6>Available pickup times: between
                            <span id="<?php print("timefrom" . $this->id) ?>"><?php echo date("H:i", strtotime($this->time_from)) ?>
                            </span> and
                            <span id="<?php print("timeuntil" . $this->id) ?>"><?php echo date("H:i", strtotime($this->time_until)) ?>
                            </span>
                        </h6>
                        <br>
                        <form class="form-inline row" method="post" action="confirm-order.php" onsubmit="return timeCheck(<?php print($this->id) ?>)">
                            <span class="displ-span">Choose pickup time</span>
                            <input type="time" class="form-control" id="<?php print($this->id) ?>" name="pickup-time">
                            <span class="displ-span-and"> and </span>
                            <button type="submit" class="btn btn-primary col-4" name="listing" value="<?php print($this->id) ?>" >Order</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    <?php
}
    function displayMyAccount() {?>
        <script>
            function cancelconfirm() {
                var r = confirm("Are you sure you want to cancel this listing?");
                return r;
            }
        </script>
        <div class="card container-fluid displ-card">
            <div class="card-body displ-card-body">
                <div class="row">
                    <div class="col-3">
                        <img src="<?php print($this->image) ?>" class="listing-img">
                    </div>
                    <div class="col-9">
                        <h4><?php echo $this->title ?></h4>
                        <p><?php echo $this->description ?></p>
                        <h6>Portions: <?php echo $this->portions ?></h6>
                        <?php if (!empty($this->allergen)) { ?>
                        <h6>Allergens: <?php
                            $count = count($this->allergen);
                            for ($i = 0; $i < $count - 1; $i++) {
                                echo $this->allergen[$i] . ", ";
                            }
                            echo $this->allergen[$count - 1];
                            }
                            ?></h6>
                        <?php if (isset($this->diet)) { ?>
                            <h6>Suitable for: <?php
                                $count = count($this->diet);
                                for ($i = 0; $i<$count-1; $i++) {
                                    echo $this->diet[$i].", ";
                                }
                                echo $this->diet[$count-1];
                                ?></h6>
                        <?php } ?>
                        <h6>Available pickup times: between
                            <span id="<?php print("timefrom" . $this->id) ?>"><?php echo date("H:i", strtotime($this->time_from)) ?>
                            </span> and
                            <span id="<?php print("timeuntil" . $this->id) ?>"><?php echo date("H:i", strtotime($this->time_until)) ?>
                            </span>
                        </h6>
                        <form action="cancel-listing.php" onsubmit="return cancelconfirm();" method="post"><button type="submit" class="btn btn-danger" value="<?php print($this->id) ?>" name="listing">Delete listing</button></form>
                    </div>
                </div>
            </div>
        </div>
        <?php
    }



}
