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

    function displayCharityUpcoming() {
        $restaurant = new Restaurant();
        $restaurant->setRestaurantFromId($this->restaurant_id);
        $listings = array();
        foreach ($this->listings as $value) {
            $listing = new Listing();
            $listing->setListingFromId($value);
            array_push($listings, $listing);
        }?>
        <script>
            function cancelconfirm() {
                var r = confirm("Are you sure you want to cancel this order?");
                return r;
            }
        </script>
        <div class="card">
            <div class="card-header card-order">
                <h5 class="order-title"><form action="restaurant-account.php" method="post"> From
                            <button type="submit" name="restaurant" value="<?php echo $restaurant->id ?>" class="btn btn-link"><?php echo $listing->restaurant_name ?></button>.</form></h5>
                <h5 class="text-muted order-id">ID #<?php echo $this->id?></h5>
            </div>
            <div class="card-body">
                <span class="h6">Pick up time: </span><span><?php echo date("H:i", strtotime($this->pickup_time)) ?></span><br>
                <span class="h6">Pick up address: </span><span><?php echo $restaurant->address ?>, <?php echo $restaurant->postcode ?></span><br>
                <span class="h6">Email: </span><span><a href="mailto:<?php print $restaurant->email ?>"><?php echo $restaurant->email ?></a></span><br>
                <span class="h6">Telephone: </span><span><?php echo $restaurant->phone ?></span><br>
                <?php if (strlen($this->comments)>0): ?>
                    <span class="h6">Comments: </span><span><?php echo $this->comments ?></span><br>
                <?php endif ?>
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
            <div class="row">
                <div class="col-md-5" style="margin: 15px auto">
                    <form action="cancel-order.php" onsubmit="return cancelconfirm()" method="post"><button class="btn btn-block btn-danger" value="<?php print($this->id) ?>"  type="submit" name="order">Cancel order</button></form>
                </div>
            </div>
        </div>
        <br>
        <?php
    }

    function displayCharityPast() {
        $restaurant = new Restaurant();
        $restaurant->setRestaurantFromId($this->restaurant_id);
        $listings = array();
        foreach ($this->listings as $value) {
            $listing = new Listing();
            $listing->setListingFromId($value);
            array_push($listings, $listing);
        }?>
        <div class="card">
            <div class="card-header" style="padding: 12px 20px 12px 20px">
            <h5 style="float: left; margin: 0px"><form action="restaurant-account.php" method="post"> From
                        <button type="submit" name="restaurant" value="<?php echo $restaurant->id ?>" class="btn btn-link"><?php echo $listing->restaurant_name ?></button>.</h5></form>
            <h5 style="float: right; margin: 0px" class="text-muted">ID #<?php echo $this->id?></h5>
            </div>
            <div class="card-body">
                <span class="h6">Pick up date: </span><span><?php echo $this->pickup_day. " at " . date("H:i", strtotime($this->pickup_time)) ?></span><br>
                <span class="h6">Pick up address: </span><span><?php echo $restaurant->address ?>, <?php echo $restaurant->postcode ?></span><br>
                <span class="h6">Email: </span><span><a href="mailto:<?php print $restaurant->email ?>"><?php echo $restaurant->email ?></a></span><br>
                <span class="h6">Telephone: </span><span><?php echo $restaurant->phone ?></span><br>
                <?php if (strlen($this->comments)>0): ?>
                    <span class="h6">Comments: </span><span><?php echo $this->comments ?></span><br>
                <?php endif ?>
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
            <div class="row">
                <div class="col-md-5" style="margin: 15px auto">
                    <form action="complaint-form.php" method="post">
                        <button class="btn btn-block btn-warning" value="<?php print($this->id) ?>"  name="order" type="submit">Report a problem</button>
                    </form>
                </div>
            </div>
        </div>
        <br>
        <?php
    }

    function displayRestaurantUpcoming() {
        $charity = new Charity();
        $charity->setCharityFromId($this->charity_id);
        ?>
        <script>
            function cancelconfirm() {
                var r = confirm("Are you sure you want to cancel this order?");
                return r;
            }
        </script>
        <div class="card">
            <div class="card-header" style="padding: 12px 20px 12px 20px">
                <h5 style="float: left; margin: 0px"><form action="charity-account.php" method="post"> From
                            <button type="submit" name="charity" value="<?php echo $charity->id ?>" class="btn btn-link"><?php echo  $charity->name ?></button>.</form>
                   </h5>
                <h5 style="float: right; margin: 0px" class="text-muted">ID #<?php echo $this->id?></h5>
            </div>
            <div class="card-body">
                <span class="h6">Pick up time: </span><span><?php echo date("H:i", strtotime($this->pickup_time)) ?></span><br>
                <span class="h6">Email: </span><span><a href="mailto:<?php print $charity->email ?>"><?php echo $charity->email ?></a></span><br>
                <span class="h6">Telephone: </span><span><?php echo $charity->phone ?></span><br>
                <?php if (strlen($this->comments)>0): ?>
                    <span class="h6">Comments: </span><span><?php echo $this->comments ?></span><br>
                <?php endif ?>
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
                    <?php $j = 1;
                    foreach ($this->listings as $listing_id) {
                        $listing = new Listing();
                        $listing->setListingFromId($listing_id);
                        ?>
                        <tr>
                            <th scope="row"><?php echo $j++ ?></th>
                            <td><?php echo $listing->title ?></td>
                            <td><?php echo $listing->portions ?></td>
                        </tr>
                    <?php } ?>
                    </tbody>
                </table>
                <div class="row">
                    <form class="col-md-5" style="margin: 15px auto" action="cancel-order.php" method="post" onsubmit="return cancelconfirm()">
                        <button type="submit" class="btn btn-block btn-danger" name="order" value="<?php print($this->id) ?>">Cancel order</button>
                    </form>
                    <form class="col-md-5" style="margin: 15px auto" action="complaint-form.php" method="post">
                        <button type="submit" class="btn btn-block btn-warning" name="order" value="<?php print($this->id) ?>">Report a problem</button>
                    </form>
                </div>
            </div>
        </div>
        <br>
        <?php
    }

    function displayRestaurantPast() {
        $charity = new Charity();
        $charity->setCharityFromId($this->charity_id);
        ?>
        <div class="card">
            <div class="card-header" style="padding: 12px 20px 12px 20px">
                <h5 style="float: left; margin: 0px"><form action="charity-account.php" method="post"> From
                        <button type="submit" name="charity" value="<?php echo $charity->id ?>" class="btn btn-link"><?php echo  $charity->name ?></button>.</form>
                </h5>
                <h5 style="float: right; margin: 0px" class="text-muted">ID #<?php echo $this->id?></h5>
            </div>
            <div class="card-body">
                <span class="h6">Pick up date: </span><span><?php echo $this->pickup_day . " at " . date("H:i", strtotime($this->pickup_time)) ?></span><br>
                <span class="h6">Email: </span><span><a href="mailto:<?php print $charity->email ?>"><?php echo $charity->email ?></a></span><br>
                <span class="h6">Telephone: </span><span><?php echo $charity->phone ?></span><br>
                <?php if (strlen($this->comments)>0): ?>
                    <span class="h6">Comments: </span><span><?php echo $this->comments ?></span><br>
                <?php endif ?>
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
                    <?php $j = 1;
                    foreach ($this->listings as $listing_id) {
                        $listing = new Listing();
                        $listing->setListingFromId($listing_id);
                        ?>
                        <tr>
                            <th scope="row"><?php echo $j++ ?></th>
                            <td><?php echo $listing->title ?></td>
                            <td><?php echo $listing->portions ?></td>
                        </tr>
                    <?php } ?>
                    </tbody>
                </table>
                <form class="col-md-8" style="margin: 15px auto" action="complaint-form.php" method="post">
                    <button type="submit" class="btn btn-block btn-warning" name="order" value="<?php print($this->id) ?>">Report a problem</button>
                </form>
            </div>
        </div>
        <br>
        <?php
    }
}
?>
