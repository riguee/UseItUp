<?php

class Order
{
    public $id, $charity_id, $restaurant_id, $pickup_time, $listings, $comments, $pickup_day;
    function setOrderFromId($id)
    {
        include 'connection.php';
        $query = "SELECT id, restaurant_id, charity_id, pickup_time, comments, pickup_day FROM orders WHERE id = " . $id;
        if ($result = $conn->query($query)) {
            ($result = $result->fetch_assoc());
            $this->id = $id;
            $this->pickup_time = $result['pickup_time'];
            $this->pickup_day = $result['pickup_day'];
            $this->comments = $result['comments'];
            $this->charity_id = $result['charity_id'];
            $this->restaurant_id = $result['restaurant_id'];

            $listings = $conn->prepare("SELECT listing_id from order_listings WHERE order_id =".$id);
            $listings->execute();
            $listingresult = $listings->get_result();
            if (mysqli_num_rows($listingresult) > 0) {
                $listinglist = array();
                while($row = $listingresult->fetch_row()) {
                    array_push($listinglist, $row[0]);
                    $this->listings = $listinglist;
                }
            }
        }
    }

    function display(){
        $restaurant = new Restaurant();
        $restaurant->setRestaurantFromId($this->restaurant_id);

        $listings = array();
        foreach ($this->listings as $value) {
            $listing = new Listing();
            $listing->setListingFromId($value);
            array_push($listings, $listing);
        }?>
        <div class="card">
        <h5 class="card-header">From <a href="#"><?php echo $restaurant->name ?></a></h5>
        <div class="card-body">
            <span class="h6">Pick up time: </span><span><?php echo $this->time ?></span><br>
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
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>


        </div>


        <?php
    }

    function displayUpcomingorders() {
        $this->display();?>
        <div class="row">
            <div class="col-md-5" style="margin: 15px auto">
                <form action="confirm-order.php"><button class="btn btn-block btn-primary" value="<?php $this->id ?>"  type="submit">Edit order</button></form>
            </div>
        </div>
        </div><br>

        <?php
    }

    function displayPastOrders() {
        $this->display();?>
        <div class="row">
            <div class="col-md-5" style="margin: 15px auto">
                <form action="Complaint.php"><button class="btn btn-block btn-warning" value="<?php $this->id ?>"  type="submit">Report a problem</button></form>
            </div>
        </div>
        </div><br>
        <?php
    }

}