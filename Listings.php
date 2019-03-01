<?php

class Listing
{
    public $id, $title, $description, $portions, $time_from, $time_until, $allergen, $diet, $restaurant_name, $restaurant_id ;
    function setListingFromId($id) {
        include 'connection.php';
        $query = "SELECT id, title, description, portions, time_from, time_until FROM listings WHERE id = ". $id;
        if ($result = $conn->query($query)) {
            ($result = $result->fetch_assoc());
            $this->title = $result['title'];
            $this->description = $result['description'];
            $this->portions = $result['portions'];
            $this->time_from = $result['time_from'];
            $this->time_until = $result['time_until'];
            $this->id = $id;

            $restaurantquery = "SELECT restaurants.id, restaurants.name FROM listings JOIN restaurants ON listings.restaurant_id = restaurants.id WHERE listings.id = ". $id;
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
                $this->diet = $dietlist;
            }
        }
        }
    }

    function displayCreated() {?>
        <div class="card">
            <h5 class="card-header">Listing number: <?php echo $this->id; ?></h5>
            <div class="row">
                <div class="col-2">
                    <div class="middle">
                        <p>Pickup window:<br><?php echo $this->time_from; ?><br><?php echo $this->time_until; ?></p>
                    </div>
                </div>
                <class="col-10">
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
                            echo "<li>".$this_diet. "</li>";
                        }
                    }
                    ?></ul>
            </div>
        </div>

        <?php
    }

}