<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>UseItUp SignUp page</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
    <style>
        .inv {
            display : none
        }

        .vis {
            display : block
        }
    </style>
</head>

<body bgcolor="#fcfff5">
<div id="signup">
    <h1>Sign Up for Free</h1>

<!--    <div>-->
<!--        -->
<!--    </div>-->
    <form action="Register.php" method="post" autocomplete="off">
        <label>Type of Account: </label>
        <select id="div_select" name="div_select" onchange="change(this.value)">
            <option value="restaurant">Restaurant</option>
            <option value="charity">Charity</option>
        </select>

        <br>
        <br>

        <script>
            function change(value) {
                if (value == "restaurant") {
                    document
                        .getElementById("char_div")
                        .className = 'inv';
                    document
                        .getElementsByName("charity_id")[0]
                        .required = false;
                }
                else if (value == "charity") {
                    document
                        .getElementById("char_div")
                        .className = 'vis';
                    document
                        .getElementsByName("charity_id")[0]
                        .required = true;
                }
            }
        </script>


        <label>
            Name: <span class="req">*</span>
        </label>
        <input type="text" name="name" autocomplete="off" required/>
        <br>

        <label>
            Email: <span class="req">*</span>
        </label>
        <input type="email" name="email" autocomplete="off" required/>
        <br>

        <label>
            Password: <span class="req">*</span>
        </label>
        <input type="password" name="password" autocomplete="off" required/>
        <br>

        <label>
            Address: <span class="req">*</span>
        </label>
        <input type="text" name="address" autocomplete="off"/>
        <br>

        <label>
            Phone:
        </label>
        <input type="number" name="phone" autocomplate="off"/>
        <br>

        <div id = "char_div" class = "inv">
            <label>
                id: <span class="req">*</span>
            </label>
            <input type="text" name="charity_id" autocomplete="off"/>
            <br>
        </div>

        <br>
        <div>
            <button type="submit" class="button button-block">Sign Up</button>
        </div>
    </form>

    <form action="Login.php" autocomplete="off">
        <div>
            <button type="submit" class="button button-block">Cancel</button>
        </div>
    </form>


</div>

</body>

<?php

if (isset($_POST["name"])) {
    $conn = include('connection.php');

    $type = $_POST["div_select"];
    $name = $_POST["name"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $address = $_POST["street_name"];
    $phone = $_POST["phone"];
    $hash = "hash";

    if ($type == "charity") {
        $charity_id = $_POST["charity_id"];
        $table = "charities";

        // Table headers
        $id_head = "id";
        $name_head = "name";
        $charity_number_head = "charity_number";
        $address_head = "address";
        $phone_head = "phone_number";
        $email_head = "email";
        $password_head = "password";
    } elseif ($type == "restaurant") {
        $table = "restaurants";

        // Table headers
        $id_head = "id";
        $name_head = "name";
        $address_head = "address";
        $phone_head = "phone_number";
        $email_head = "email";
        $password_head = "password";
    }

    $hash_head = 'hash';

    $sql = "SELECT *  FROM " . $table . " WHERE email='" . $email . "'";
    $results = $conn->query($sql);

    if ($results->num_rows == 0) {
        $sql = "SELECT " . $id_head . " FROM " . $table;
        $results = $conn->query($sql);
        $id = $results->num_rows + 1;

        $sql = "INSERT INTO " . $table . " (";
        $sql = $sql . $id_head . "," . $name_head;
        $sql_val = $id . ",'" . $name . "'";

        if ($type == "charity") {
            $sql = $sql . "," . $charity_number_head;
            $sql_val = $sql_val . "," . $charity_id;
        }

//        $sql = $sql . "," . $street_name_head . "," . $building_name_head . ",";
//        $sql_val = $sql_val . ",'" . $street_name . "','" . $building_name . "','";

        if ($type == "charity") {
            $sql = $sql . $city_head . "," . $postcode_head;
            $sql_val = $sql_val . $city . "','" . $postcode;
        } elseif ($type == "restaurant") {
            $sql = $sql . $postcode_head . "," . $city_head;
            $sql_val = $sql_val . $postcode . "','" . $city;
        }

        $sql = $sql . "," . $phone_head . "," . $email_head . "," . $password_head . "," . $hash_head;
        $sql_val = $sql_val . "'," . $phone . ",'" . $email . "','" . $password . "','" . $hash;

        $sql = $sql . ") VALUES (" . $sql_val . "')";

        echo $sql;

        if ($conn->query($sql) == true) {
            echo("Account created.");
        } else {
            echo $conn->error;
        }
    } else {
        print("This account already exists.");
    }
}
?>

</body>
</html>