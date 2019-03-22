<?php

class Restaurant
{
    public $id, $name, $phone, $email, $address, $postcode, $listings, $monday_from, $monday_until, $tuesday_from, $tuesday_until,
$wednesday_from, $wednesday_until, $thursday_from, $thursday_until, $friday_from, $friday_until, $saturday_from, $saturday_until,
$sunday_from, $sunday_until;
    function setRestaurantFromId($id) {
        include 'connection.php';
        $query = "SELECT * FROM restaurants WHERE id = ". $id;
        $result = mysqli_query($conn, $query);
        $result = $result->fetch_assoc();
        $this->id = $id;
        $this->name = $result['name'];
        $this->phone = $result['phone'];
        $this->email = $result['email'];
        $this->address = $result['address'];
        $this->postcode = $result['postcode'];
        $days = array('monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday', 'sunday');
        foreach ($days as $day){
            $this->{$day . "_from"} = $result[$day . "_from"];
            $this->{$day . "_until"} = $result[$day . "_until"];
        }
        $query = "SELECT listings.id FROM listings JOIN restaurants ON listings.restaurant_id = restaurants.id WHERE restaurants.id = ". $id;
        $result = mysqli_query($conn, $query);
        $array = array();
        while ($row = mysqli_fetch_assoc($result)) {
            array_push($array, $row['id']);
        }
        $this->listings = $array;
    }
}