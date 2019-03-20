<?php

class Restaurant
{
    public $id, $name, $phone, $email, $address, $postcode, $license_number, $listings;
    function setRestaurantFromId($id) {
        include 'connection.php';
        $query = "SELECT address, email, name, phone, postcode FROM restaurants WHERE id = ". $id;
        $result = mysqli_query($conn, $query);
        $result = $result->fetch_assoc();
        $this->id = $id;
        $this->name = $result['name'];
        $this->phone = $result['phone'];
        $this->email = $result['email'];
        $this->address = $result['address'];
        $this->postcode = $result['postcode'];

        $query = "SELECT listings.id FROM listings JOIN restaurants ON listings.restaurant_id = restaurants.id WHERE restaurants.id = ". $id;
        $result = mysqli_query($conn, $query);
        $array = array();
        while ($row = mysqli_fetch_assoc($result)) {
            array_push($array, $row['id']);
        }
        $this->listings = $array;
    }
}