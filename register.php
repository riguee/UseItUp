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

<?php
session_start();
if (!empty($_SESSION['user_type'])) {
    if ($_SESSION['user_type'] == 'charity') {
        header("location: main-listing.php");
    } elseif ($_SESSION['user_type'] == 'restaurant') {
        header("location: new-listing.php");
    } elseif ($_SESSION['message'] != null) {
    } else {
        header("location: logout.php");
    }
}
?>
<div id="signup">
    <h1>Sign Up for Free</h1>

    <div>
        <center>
            <?php
            if (!empty($_SESSION['message'])) {
                echo $_SESSION['message'];

                $_SESSION['message'] = null;
            }
            ?>
        </center>
    </div>

    <form action="create-account.php" method="post" autocomplete="off" onsubmit="return checkPassword(this)">
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
                    document.getElementById('monday_from').required = false;
                    document.getElementById('monday_until').required = false;
                    document.getElementById('tuesday_from').required = false;
                    document.getElementById('tuesday_until').required = false;
                    document.getElementById('wednesday_from').required = false;
                    document.getElementById('wednesday_until').required = false;
                    document.getElementById('thursday_from').required = false;
                    document.getElementById('thursday_until').required = false;
                    document.getElementById('friday_from').required = false;
                    document.getElementById('friday_until').required = false;
                    document.getElementById('saturday_from').required = false;
                    document.getElementById('saturday_until').required = false;
                    document.getElementById('sunday_from').required = false;
                    document.getElementById('sunday_until').required = false;
                }
                else {
                    document.getElementById("char_div").style.display = "none";
                    document.getElementById("rest_div").style.display = "block";
                    document.getElementById('monday_from').required = true;
                    document.getElementById('monday_until').required = true;
                    document.getElementById('tuesday_from').required = true;
                    document.getElementById('tuesday_until').required = true;
                    document.getElementById('wednesday_from').required = true;
                    document.getElementById('wednesday_until').required = true;
                    document.getElementById('thursday_from').required = true;
                    document.getElementById('thursday_until').required = true;
                    document.getElementById('friday_from').required = true;
                    document.getElementById('friday_until').required = true;
                    document.getElementById('saturday_from').required = true;
                    document.getElementById('saturday_until').required = true;
                    document.getElementById('sunday_from').required = true;
                    document.getElementById('sunday_until').required = true;
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
                    document.getElementById(day).checked = true;
                }
                else {
                    document.getElementById($element_from).removeAttribute("disabled");
                    document.getElementById($element_until).removeAttribute("disabled");
                    document.getElementById($element_from).required = true;
                    document.getElementById($element_until).required = true;
                    document.getElementById($element_btn).value = "The restaurant is closed on " + day + "s.";
                    document.getElementById($element_btn).classList.remove("btn-primary");
                    document.getElementById($element_btn).classList.add("btn-secondary");
                    document.getElementById(day).checked = false;
                }

            }

            function checkPassword(form) {
                if (form.password.value != "") {
                    var re = /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,}$/;

                    if (!re.test(form.password.value)) {
                        alert("The password you have entered is not valid! It needs to have at least one uppercase, one lowercase, one number, and be of six characters.");
                        form.password.focus();
                        return false;
                    }
                }

                return true;
            }

            function checkForm(bool) {
                if (bool) {
                    return "create-account.php";
                }
                else {
                    return "register.php";
                }
            }
        </script>


        <label for="name">
            Name:*
        </label>
        <input type="text" class="form-control" name="name" id="name"  placeholder="The name of your company" autocomplete="off" maxlength="15" required/>
        <label>
            Email:*
        </label>
        <input type="email" class="form-control" name="email"  placeholder="The email of your company" autocomplete="off" maxlength="30" required/>
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
            <input type="text" class="form-control" id="charity_id" name="charityid" placeholder="Your charity ID" autocomplete="off"/>
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
                    <input type="button" class="btn btn-secondary btn-check" id="closed_monday" value="The restaurant is closed on mondays" onclick="disable('monday');">
                    <input type="checkbox" name="closed_monday" id="monday" value="1" style="display: none;">
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
                    <input type="button" class="btn btn-secondary btn-check" id="closed_tuesday" value="The restaurant is closed on tuesdays" onclick="disable('tuesday');">
                    <input type="checkbox" name="closed_tuesday" id="tuesday" value="1" style="display: none;">
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
                    <input type="button" class="btn btn-secondary btn-check" id="closed_wednesday" value="The restaurant is closed on wednesdays" onclick="disable('wednesday');">
                    <input type="checkbox" name="closed_wednesday" id="wednesday" value="1" style="display: none;">
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
                    <input type="button" class="btn btn-secondary btn-check" id="closed_thursday" value="The restaurant is closed on thursdays" name="closed_thursday" onclick="disable('thursday');">
                    <input type="checkbox" name="closed_thursday" id="thursday" value="1" style="display: none;">
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
                    <input type="button" class="btn btn-secondary btn-check" id="closed_friday" value="The restaurant is closed on fridays" name="closed_friday" onclick="disable('friday');">
                    <input type="checkbox" name="closed_friday" id="friday" value="1" style="display: none;">
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
                    <input type="button" class="btn btn-secondary btn-check" id="closed_saturday" value="The restaurant is closed on saturdays" name="closed_saturday" onclick="disable('saturday');">
                    <input type="checkbox" name="closed_saturday" id="saturday" value="1" style="display: none;">
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
                    <input type="button" class="btn btn-secondary btn-check" id="closed_sunday" value="The restaurant is closed on sundays" name="closed_sunday" onclick="disable('sunday');">
                    <input type="checkbox" name="closed_sunday" id="sunday" value="1" style="display: none;">
                </div>
            </div>
        </div>
        <br>
        <div>
            <button type="submit" class="btn btn-block btn-primary">Sign Up</button>
        </div>
    </form>
    <br>
    <form action="index.php" autocomplete="off">
        <div>
            <a href="index.php" class="btn btn-secondary btn-block" name="register">Already have an account? Log in</a>
        </div>
    </form>
</div>


</div>


</body>
</html>
