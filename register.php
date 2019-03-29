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
    <h1>Create an account</h1>

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
                        alert("The password you have entered is not valid. Please use at least one uppercase character, one lowercase character, one number, and at least six characters in total.");
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
            Name:
        </label>
        <input type="text" class="form-control" name="name" id="name"  placeholder="The name of your company" autocomplete="off" minlength="3" maxlength="30" required/>
        <br>
        <label>
            Email:
        </label>
        <input type="email" class="form-control" name="email"  placeholder="The email of your company" autocomplete="off" minlength="3" maxlength="30" required/>
        <br>
        <label for="password">
            Password:
        </label>
        <input type="password" class="form-control" name="password" id="password" placeholder="Your password" autocomplete="off" required/>
        <br>
        <label for="address">
            Address:
        </label>
        <div class="row">
            <div class="col-9">
                <input type="text" class="form-control" id="address" name="address" placeholder="Your address" minlength="1" autocomplete="off" />
            </div>
            <div class="col-3">
                <input type="text" class="form-control" id="postcode" name="postcode" placeholder="Your postcode" minlength="1" autocomplete="off" />
            </div>
        </div>
        <br>
        <label for="phone">
            Phone:
        </label>
        <input type="text" class="form-control" name="phone" id="phone" placeholder="The phone number of your company" minlength="5">
        <div id = "char_div" style="display: none;">
            <br>
            <label for="charity_id">
                Charity ID:
            </label>
            <input type="text" class="form-control" id="charity_id" name="charityid" placeholder="Your charity ID" autocomplete="off"/>
        </div>
        <br>
        <div>
            <button type="submit" class="btn btn-block btn-primary">Sign up</button>
        </div>
    </form>
    <br>
    <form action="index.php" autocomplete="off">
        <div>
            <a href="index.php" class="btn btn-secondary btn-block" name="register">Already have an account? Log in</a>
        </div>
        <br>
    </form>
</div>


</div>


</body>
</html>
