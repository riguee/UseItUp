<?php

class Charity
{
    public $id, $name, $email, $phone, $address, $postcode, $charity_number;
    function setCharityFromId($id) {
        include 'connection.php';
        $query = "SELECT name, email, phone, address, postcode, charity_number FROM charities WHERE id = " . $id;
        $result = mysqli_query($conn, $query);
        $result = $result->fetch_assoc();
        $this->id = $id;
        $this->name = $result['name'];
        $this->email = $result['email'];
        $this->phone = $result['phone'];
        $this->address = $result['address'];
        $this->postcode = $result['postcode'];
        $this->charity_number = $result['charity_number'];
    }

}

