<?php

class Order
{
    public $id, $charity_id, $restaurant_id, $pickup_time, $listings, $comments;
    function setOrderFromId($id)
    {
        include 'connection.php';
        $query = "SELECT id, restaurant_id, charity_id, pickup_time, comments FROM orders WHERE id = " . $id;
        if ($result = $conn->query($query)) {
            ($result = $result->fetch_assoc());
            $this->id = $id;
            $this->pickup_time = $result['pickup_time'];
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
    }

    function addToOrder($listing) {
        array_push($this->listings, $listing);
    }

}