<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/css/bootstrap-select.css" />
    <link rel="stylesheet" href="styles.css">
    <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/js/bootstrap-select.min.js"></script>
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
                alert("Something went wrong");
                return false;
            }
            var until = document.getElementById("until").value;
            try {
                var tuntil = toDate(until, "h:m")}
            catch {
                alert("Something went wrong");
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
                if (confirm("Pickup time from " + fromtime + " time until " + until + ".")) {
                    return true;
                } else {
                    return false;
                }
            }
        }
    </script>
    <title>New listing</title>
</head>

<body>
<?php
 include"connection.php";
 include "navbar-restaurant.php";
 ?>
<div class="container">
<h1>New listing</h1>
    <form name="newlisting" enctype="multipart/form-data" autocomplete="off" action="createdlisting.php" onsubmit="return timecheck();" method="post">
        <label for="dishes">Select one of your saved dishes:</label>
        <select class="form-control" name="dishes" id="dishes">
            <option value="none">None</option>
            <option value="dish1">Dish 1</option>
            <option value="dish2">Dish 2</option>
            <option value="dish3">Dish 3</option>
        </select>
        <br>
        <label for="title">or fill in information for a new dish:</label>
        <input type="text" class="form-control" id="title" name="title" placeholder="Name of the dish">
        <br>
        <label for="description">Description</label>
        <textarea type="text" class="form-control" rows="5" id="description" name="description" placeholder="e.g. ingredients, flavour, etc."></textarea>
        <br>
        <label for="image">Choose an image</label>
        <input type="file" id="image" class="form-control-file" placeholder="image" name="image" accept="image/gif, image/jpeg, image/png">
        <br>
        <label for="portions">Quantity</label>
        <input type="number" name="portions" id="portions" class="form-control" min="1">
        <br>
        <label for="allergens">Allergens:</label>
        <select name="allergen[]" id="allergens" class="selectpicker" multiple data-live-search="true">
            <?php
            $stmt = $conn->prepare("SELECT * FROM allergens");
            $stmt->execute();
            $result = $stmt->get_result();
            if (mysqli_num_rows($result) > 0) {
                // output data of each row
                while($row = $result->fetch_assoc()) {
                    echo "<option value='".$row["id"]."'>".$row["allergen"]."</option>";
                }
            }
            ?>
        </select>
        <br>
        <br>
        <label for="diets">Suitable for:</label>
        <select name="diet[]" id="diets" class="selectpicker" multiple>
            <?php
            $diets = $conn->prepare("SELECT * FROM diets");
            $diets->execute();
            $dietresult = $diets->get_result();
            if (mysqli_num_rows($dietresult) > 0) {
                // output data of each row
                while($dietrow = $dietresult->fetch_assoc()) {
                    echo "<option value='".$dietrow["id"]."'>".$dietrow["diet"]."</option>";
                }
            }
            else {
                echo "There are no dietary requirements available at this time.";
            }
            ?>
        </select>
        <br>
        <br>
        <!--
            <br><br><div class="col-md-6 mx-auto">
                Pickup time <br>
                From:
                <input type="time"  class="form-control" name="from" id="from"><br>
                Until:
                <input type="time" class="form-control" name="until" id="until" data-custom-pattern="Invalid date">
                <br><br></div>
                -->
        <button type="submit" class="btn btn-primary col-md-12" id="submitlisting" value="Upload Image" >Submit</button>
        <br>
        <br>
    </form>
</div>
</body>
</html>
