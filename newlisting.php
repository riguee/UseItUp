<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
    <title>newlisting</title>
    <link rel="stylesheet" href="common.css">
    <script
            src="https://code.jquery.com/jquery-3.3.1.min.js"
            integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
            crossorigin="anonymous"></script>
    <style>
        .dropdown-content {
            display: none;
            position: absolute;
            background-color: #f6f6f6;
            min-width: 230px;
            border: 1px solid #ddd;
            z-index: 1;
        }
        .show {display:block;}

        .dropdown-content label {
            color: black;
            padding: 8px 8px;
            text-decoration: none;
            display: block;
        }

        .dropdown {
            position: relative;
            display: inline-block;
        }
        #myInput:focus {outline: 3px solid #ddd;}

        .topnav {
            background-color: #82924d;
            overflow: hidden;
        }

        /* Style the links inside the navigation bar */
        .topnav a {
            float: left;
            color: white;
            text-align: center;
            padding: 14px 16px;
            text-decoration: none;
            font-size: 17px;
        }

        /* Add a color to the active/current link */
        .topnav a.active {;
            color: #e7bb41;
            font-weight: bold;
        }


        .topnav .search-container button {
            float: right;
            padding: 6px 10px;
            margin-top: 8px;
            margin-right: 16px;
            background: #e7bb41;
            font-size: 17px;
            border: none;
            cursor: pointer;
        }

        .topnav input[type=text] {
            float: right;
            padding: 6px;
            border: none;
            margin-top: 8px;
            margin-right: 16px;
            font-size: 17px;
        }

        .topnav .search-container button {
            float: right;
            padding: 6px 10px;
            margin-top: 8px;
            margin-right: 16px;
            background: #ddd;
            font-size: 17px;
            border: none;
            cursor: pointer;
        }
    </style>
    <script src="nav.js"></script>
</head>
<body>
<?php
$servername = "localhost";
$username = "root";
$password = "";
$db = "test";
$conn = new mysqli($servername, $username, $password, $db);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

?>

<script>
    //turns the values inputted from the time fields into dates so that they can be compared
    function toDate(dStr,format) {
        var now = new Date();
        if (format == "h:m") {
            now.setHours(dStr.substr(0,dStr.indexOf(":")));
            now.setMinutes(dStr.substr(dStr.indexOf(":")+1));
            now.setSeconds(0);
            return now;
        }else
            return "Invalid Format";
    }


    //function called in timecheck() that verifies that there is an input in some selected fields
    function required(inputtx)
    {
        if (inputtx.value.length == 0)
        {
           // alert("please fill all fields marked *");
            return false;
        }
        return true;
    }

    //Checks the values are filled in and the time slot is correct
    function timecheck() {

        if (required(document.getElementById("title"))==false ||
        required(document.getElementById("description"))==false ||
        required(document.getElementById("from"))==false ||
        required(document.getElementById("until"))==false) {
            alert("please fill all fields marked *");
            return false;
        }

        var fromtime = document.getElementById("from").value;
        try {
            var tfrom = toDate(fromtime, "h:m")}
        catch {
            alert("something went wrong");
            return false;
        }
        var until = document.getElementById("until").value;
        try {
            var tuntil = toDate(until, "h:m")}
        catch {
            alert("something went wrong");
            return false;
        }
        if (tfrom>tuntil) {
            alert("The pickup time range is invalid.");
            return false;
        }
        else if( (Math.abs(tuntil - tfrom))/60000<15){
            alert("Please allow at least a 15 minute time window for the pickup.");
            return false;
        }
        else {
            alert("Pickup time from " + fromtime + " time until " + until + ".");
            return true;
        }
    }
</script>

<div id="topnav"></div>


<h1>NEW LISTING</h1><br><br><div class="col-md-4 mx-auto">
    <form name="newlisting" autocomplete="off" action="createdlisting.php" onsubmit="return timecheck();" method="post">
        <fieldset>
            Select one of your saved dishes:
            <select name="dishes">
                <option value="none">None</option>
                <option value="dish1">Dish 1</option>
                <option value="dish2">Dish 2</option>
                <option value="dish3">Dish 3</option>
            </select>
            <br><br>
            <div class="form-group">
                <input type="text" class="form-control" id="title" name="title" placeholder="Name of the dish">
            </div>
            <br><br>
            <textarea type="text" class="form-control" rows="5" id="description" name="description" placeholder="dish details: ingredients, cooking, flavour..."></textarea>
            <br><br><div  class="col-md-8 mx-auto">
                Image:
                <input type="file" class="form-control-file" placeholder="image" name="image" accept="image/gif, image/jpeg, image/png"></div>
            <br><br>
            Quantity:
            <input type="number" name="portions" class="form-control" min="1">
            <br><br>
            Allergens:<br>
            <div class="dropdown">
                    <input type="text" class="form-control" autocomplete="off" placeholder="Search.." id="myInput" onkeyup="filterFunction()">
                    <div id="myDropdown" class="dropdown-content">
                        <?php
                        $stmt = $conn->prepare("SELECT * FROM allergens");
                        $stmt->execute();
                        $result = $stmt->get_result();

                        if (mysqli_num_rows($result) > 0) {
                            // output data of each row
                            while($row = $result->fetch_assoc()) {
                                echo "<label><input type=\"checkbox\" value=\"".$row["allergenID"] ."\" name=\"".$row["allergenname"] ."\" >".$row["allergenname"]."</label>";
                            }
                        } else {
                            echo "0 results";
                        }

                        mysqli_close($conn);
                        ?>

                </div>
            </div>
            <script>
                function myFunction() {
                    document.getElementById("myDropdown").classList.toggle("show");
                }
                function filterFunction() {
                    myFunction();
                    var input, filter, ul, li, a, i;
                    input = document.getElementById("myInput");
                    filter = input.value.toUpperCase();
                    div = document.getElementById("myDropdown");
                    a = div.getElementsByTagName("label");
                    for (i = 0; i < a.length; i++) {
                        txtValue = a[i].textContent || a[i].innerText;
                        if (txtValue.toUpperCase().indexOf(filter) > -1) {
                            a[i].style.display = "";
                        } else {
                            a[i].style.display = "none";
                        }
                    }
                }</script>
                <br><br>
            Suitable for:<br><br>
            <div class="checkbox">
                <label><input type="checkbox" id="veg" value="">Vegetarian</label>
            </div>
            <div class="checkbox">
                <label><input type="checkbox" id="halal"  value="">Halal</label>
            </div>
            <div class="checkbox">
                <label><input type="checkbox" id="kosher" value="">Kosher</label>
            </div>
            <br><br><div class="col-md-6 mx-auto">
                Pickup time <br>
                From:
                <input type="time"  class="form-control" name="from" id="from"><br>
                Until:
                <input type="time" class="form-control" name="until" id="until" data-custom-pattern="Invalid date">
                <br><br></div>
            <button type="submit" class="btn btn-primary col-md-12" id="submitlisting" >Submit</button>

        </fieldset>
    </form></div>
</body>
</html>