<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>SignUp</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
    <link rel="stylesheet" href="styles.css">
</head>
<div class="container">
<body>
<div id="signup">
    <h1>Sign Up for Free</h1>
    <form action="" method="post" autocomplete="off">
        <label for="selecttype">Type of Account: </label>
        <select class="custom-select" name="selecttype" id="selecttype" onchange="change(this.value)">
            <option selected value disabled> -- select an option -- </option>
            <option value='restaurant'>Restaurant</option>
            <option value='charity'>Charity</option>
        </select>
        <br>
        <br>


        <script>
            function change(value) {
                if (value == "charity") {
                    document.getElementById("char_div").style.display = "block";
                    document.getElementById("rest_div").style.display = "none";
                }
                else {
                    document.getElementById("char_div").style.display = "none";
                    document.getElementById("rest_div").style.display = "block";

                }
            }

            function disable(day) {
                $element_from = day + "_from";
                $element_until = day + "_until";
                $element_btn = "closed_" + day;
                if (document.getElementById($element_from).hasAttribute("required")){
                    document.getElementById($element_from).removeAttribute("required");
                    document.getElementById($element_until).removeAttribute("required");
                    document.getElementById($element_from).disabled = true;
                    document.getElementById($element_until).disabled = true;
                    document.getElementById($element_btn).value = "The restaurant is open on " + day + "s.";
                    document.getElementById($element_btn).classList.remove("btn-secondary");
                    document.getElementById($element_btn).classList.add("btn-primary");
                }
                else {
                    document.getElementById($element_from).removeAttribute("disabled");
                    document.getElementById($element_until).removeAttribute("disabled");
                    document.getElementById($element_from).required = true;
                    document.getElementById($element_until).required = true;
                    document.getElementById($element_btn).value = "The restaurant is closed on " + day + "s.";
                    document.getElementById($element_btn).classList.remove("btn-primary");
                    document.getElementById($element_btn).classList.add("btn-secondary");
                }

            }
        </script>


        <label for="name">
            Name:*
        </label>
        <input type="text" class="form-control" name="name" id="name" placeholder="The name of your company" autocomplete="off" required/>
        <label>
            Email:*
        </label>
        <input type="email" class="form-control" name="email" placeholder="The email of your company" autocomplete="off" required/>
        <label for="password">
            Password:*
        </label>
        <input type="password" class="form-control" name="password" id="password" placeholder="Your password" autocomplete="off" required/>
        <label for="address">
            Address:*
        </label>
        <div class="row">
            <div class="col-9">
                <input type="text" class="form-control" id="address" name="address" placeholder="Your address" autocomplete="off"/>
            </div>
            <div class="col-3">
                <input type="text" class="form-control" id="postcode" name="postcode" placeholder="Your postcode" autocomplete="off"/>
            </div>
        </div>
        <label for="phone">
            Phone:
        </label>
        <input type="text" class="form-control" name="phone" id="phone" placeholder="The phone number of your company">
        <div id = "char_div" style="display: none;">
            <label for="charity_id">
                Charity ID:*
            </label>
            <input type="text" class="form-control" id="charity_id" name="charity_id" placeholder="Your charity ID" autocomplete="off"/>
            <br><br>
        </div>
        <div id = "rest_div" style="display: none;">
            <hr/>
            <h5>Please specify the available pickup times:</h5>
            <div class="row">
                <div class="col-4">
                    <label for="monday_from">Monday from</label>
                    <input type="time" class="form-control" id="monday_from" name="monday_from" required>
                </div>
                <div class="col-4">
                    <label for="monday_until">until:</label>
                    <input type="time" class="form-control" id="monday_until" name="monday_until" required>
                </div>
                <div class="col-4"><br>
                    <input type="button" class="btn btn-secondary btn-check" id="closed_monday" value="The restaurant is closed on mondays" name="closed_mondays" onclick="disable('monday');">
                </div>
            </div><br>
            <div class="row">
                <div class="col-4">
                    <label for="tuesday_from">Tuesday from:</label>
                    <input type="time" class="form-control" id="tuesday_from" name="tuesday_from" required>
                </div>
                <div class="col-4">
                    <label for="tuesday_until">until:</label>
                    <input type="time" class="form-control" id="tuesday_until" name="tuesday_until" required>
                </div>
                <div class="col-4"><br>
                    <input type="button" class="btn btn-secondary btn-check" id="closed_tuesday" value="The restaurant is closed on tuesdays" name="closed_tuesdays" onclick="disable('tuesday');">
                </div>
            </div><br>
            <div class="row">
                <div class="col-4">
                    <label for="wednesday_from">Wednesday from:</label>
                    <input type="time" class="form-control" id="wednesday_from" name="wednesday_from" required>
                </div>
                <div class="col-4">
                    <label for="wednesday_until">until:</label>
                    <input type="time" class="form-control" id="wednesday_until" name="wednesday_until" required>
                </div>
                <div class="col-4"><br>
                    <input type="button" class="btn btn-secondary btn-check" id="closed_wednesday" value="The restaurant is closed on wednesdays" name="closed_wednesdays" onclick="disable('wednesday');">
                </div>
            </div><br>
            <div class="row">
                <div class="col-4">
                    <label for="thursday_from">Thursday from:</label>
                    <input type="time" class="form-control" id="thursday_from" name="thursday_from" required>
                </div>
                <div class="col-4">
                    <label for="thursday_until">until:</label>
                    <input type="time" class="form-control" id="thursday_until" name="thursday_until" required>
                </div>
                <div class="col-4"><br>
                    <input type="button" class="btn btn-secondary btn-check" id="closed_thursday" value="The restaurant is closed on thursdays" name="closed_thursdays" onclick="disable('thursday');">
                </div>
            </div><br>
            <div class="row">
                <div class="col-4">
                    <label for="friday_from">Friday from:</label>
                    <input type="time" class="form-control" id="friday_from" name="friday_from" required>
                </div>
                <div class="col-4">
                    <label for="friday_until">until:</label>
                    <input type="time" class="form-control" id="friday_until" name="friday_until" required>
                </div>
                <div class="col-4"><br>
                    <input type="button" class="btn btn-secondary btn-check" id="closed_friday" value="The restaurant is closed on fridays" name="closed_fridays" onclick="disable('friday');">
                </div>
            </div><br>
            <div class="row">
                <div class="col-4">
                    <label for="saturday_from">Saturday from:</label>
                    <input type="time" class="form-control" id="saturday_from" name="saturday_from" required>
                </div>
                <div class="col-4">
                    <label for="saturday_until">until: </label>
                    <input type="time" class="form-control" id="saturday_until" name="saturday_until" required>
                </div>
                <div class="col-4"><br>
                    <input type="button" class="btn btn-secondary btn-check" id="closed_saturday" value="The restaurant is closed on saturdays" name="closed_saturdays" onclick="disable('saturday');">
                </div>
            </div><br>
            <div class="row">
                <div class="col-4">
                    <label for="sunday_from">Sunday from:</label>
                    <input type="time" class="form-control" id="sunday_from" name="sunday_from" required>
                </div>
                <div class="col-4">
                    <label for="sunday_until">until:</label>
                    <input type="time" class="form-control" id="sunday_until" name="sunday_until" required>
                </div>
                <div class="col-4"><br>
                    <input type="button" class="btn btn-secondary btn-check" id="closed_sunday" value="The restaurant is closed on sundays" name="closed_sundays" onclick="disable('sunday');">
                </div>
            </div>
        </div>
        <br>
        <div>
            <button type="submit" class="btn btn-block btn-primary">Sign Up</button>
        </div>
    </form>
    <br>
    <form action="Login.php" autocomplete="off">
        <div>
            <button type="submit" class="btn btn-block btn-secondary">Cancel</button>
        </div>
    </form>
</div>

<?php
include('connection.php');

if (isset($_POST["name"])) {

    //Setting POST variables
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = md5($_POST['password']);
    $address = $_POST['address'];
    $phone = $_POST['phone'];
    $div_select = $_POST['selecttype'];
    if ($div_select == "charity") {
        $charitynumber = $_POST['charity_id'];
    }

    echo $name . $email . $password . $address . $phone . $div_select;

    if ($div_select == "charity") {
        $stmt = $conn->query("SELECT * FROM charities WHERE email = '" . $email . "'");
        if (mysqli_num_rows($stmt)>0) {
            echo "<script>alert('Sorry that email address is already used')</script>";
            return false;
        }
    } elseif ($div_select == "restaurant") {
        $stmt = $conn->query("SELECT * FROM restaurants WHERE email = '" . $email . "'");
        if (mysqli_num_rows($stmt)>0) {
            echo "<script>alert('Sorry that email address is already used')</script>";
            return false;
        }
    }
}


    ?>
</div>
</body>
</html>