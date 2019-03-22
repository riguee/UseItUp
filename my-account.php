<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/css/bootstrap-select.css" />
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="styles.css">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta charset="UTF-8">
    <title>My account</title>
</head>
<body>

    <?php
    include 'Restaurants.php';
    include 'Charities.php';
    include 'Listings.php';
    include 'connection.php';
    session_start();
    if (empty($_SESSION)) {
        header( "location: Login.php" );
    } elseif ($_SESSION['user_type'] == 'charity') {
        include 'navbar-charity.php';
    } elseif ($_SESSION['user_type'] == 'restaurant') {
        include 'navbar-restaurant.php';
    } else {
        header( "location: Logout.php" );
    }
    $id = $_SESSION['id'];
    $restaurant = new Restaurant();
    if ($_SESSION['user_type'] == 'restaurant'){
        $user = new Restaurant();
        $user->setRestaurantFromId($id);
    } else {
        $user = new Charity();
        $user->setCharityFromId($id);
    }
    ?>
    <script>
        function edit() {
            if (document.getElementById('email').hasAttribute('readonly')){
                document.getElementById('email').removeAttribute("readonly");
                document.getElementById('phone').removeAttribute("readonly");
                document.getElementById('address').removeAttribute("readonly");
                document.getElementById('postcode').removeAttribute("readonly");
                document.getElementById('confirm').hidden = false;
                document.getElementById('confirm').disabled = false;
                document.getElementById('edit').classList.remove("btn-primary");
                document.getElementById('edit').classList.add("btn-secondary");
                document.getElementById('edit').innerHTML = "Cancel changes";
                document.getElementById('hours').classList.add('hours');
                document.getElementById('edit_hours').classList.remove('hours');
                if (typeof(document.getElementById('charity_id'))!='undefined') {document.getElementById('charity_id').removeAttribute("readonly")}
            }
            else {
                document.getElementById('email').readOnly = true;
                document.getElementById('email').value = "<?php echo $user->email ?>";
                document.getElementById('phone').readOnly = true;
                document.getElementById('phone').value = "<?php echo $user->phone ?>";
                document.getElementById('address').readOnly = true;
                document.getElementById('address').value = "<?php echo $user->address ?>";
                document.getElementById('postcode').readOnly = true;
                document.getElementById('postcode').value = "<?php echo $user->postcode ?>";
                if (typeof(document.getElementById('charity_id'))!='undefined') {
                    document.getElementById('charity_id').readOnly = true;
                    document.getElementById('charity_id').value = "<?php /*echo $user->charity_number*/ ?>";
                }
                document.getElementById('confirm').hidden = true;
                document.getElementById('confirm').disabled = true;
                document.getElementById('edit').classList.remove("btn-secondary");
                document.getElementById('edit').classList.add("btn-primary");
                document.getElementById('edit').innerHTML = "Edit details";
                document.getElementById('hours').classList.remove('hours');
                document.getElementById('edit_hours').classList.add('hours');
            }
        }
        function disable(day) {
            $element_from = day + "_from";
            $element_until = day + "_until";
            $element_btn = "closed_" + day;
            $day = day;
            if (!document.getElementById($element_from).hasAttribute('disabled')){
                document.getElementById($element_from).value = "";
                document.getElementById($element_until).value = "";
                document.getElementById($element_from).disabled = true;
                document.getElementById($element_until).disabled = true;
                document.getElementById($element_btn).value = "The restaurant is open on " + day + "s.";
                document.getElementById($element_btn).classList.remove("btn-secondary");
                document.getElementById($element_btn).classList.add("btn-primary");
                document.getElementById($day).checked = true;
            }
            else {
                document.getElementById($element_from).removeAttribute("disabled");
                document.getElementById($element_until).removeAttribute("disabled");
                document.getElementById($element_from).value = document.getElementById($element_from + "_display").value;
                document.getElementById($element_until).value = document.getElementById($element_until + "_display").value;
                document.getElementById($element_btn).value = "The restaurant is closed on " + day + "s.";
                document.getElementById($element_btn).classList.remove("btn-primary");
                document.getElementById($element_btn).classList.add("btn-secondary");
                document.getElementById($day).checked = false;
            }

        }
    </script>

    <div class="container">
    <h1><?php echo $user->name ?></h1>
    <button type='button' class='btn btn-primary' onclick='edit();' id='edit'>Edit details</button>
    <div class="col-6 mx-auto">
        <form method="post" action="edit-account.php">
            <input type="hidden" name="user_type" value="<?php echo $_SESSION['user_type'] ?>">
            <div class="row">
                <div class="col-4">Email</div>
                <div class="col-8"><input class="form-control-plaintext" type="email" name="email" placeholder="email" id="email" value="<?php echo $user->email ?>" readonly></div>
            </div>
            <div class="row">
                <div class="col-4">Phone</div>
                <div class="col-8"><input class="form-control-plaintext" type="text" name="phone" placeholder="phone number" id="phone" value="<?php echo $user->phone ?>" readonly></div>
            </div>
            <div class="row">
                <div class="col-4">Address</div>
                <div class="col-8"><input class="form-control-plaintext" type="text" name="address" placeholder="address" id="address" value="<?php echo $user->address ?>" readonly>
                    <input class="form-control-plaintext" type="text" name="postcode" placeholder="postcode" id="postcode" value="<?php echo $user->postcode ?>" readonly></div>
            </div>
            <?php
            if ($_SESSION['user_type'] == 'charity') {
                echo "<div class=\"row\">
                <div class=\"col-4\">Charity ID </div>
                <div class=\"col-8\"><input class=\"form-control-plaintext\" type=\"text\" name=\"charity_id\" placeholder=\"charity id\" id=\"charity_id\" value=\"". $user->charity_number ."\" readonly>
                </div>";
            } elseif ($_SESSION['user_type'] == "restaurant") {
                echo "<div id='hours'>";
                $days = array('monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday', 'sunday');
                foreach ($days as $day) {
                    if ($user->{$day . "_from"} != NULL) {
                        ?>
                        <div class="row">
                            <div class="col-6">
                                <label for="<?php echo $day . "_from_display" ?>"><?php echo $day . " from:" ?></label>
                                <input type="time" class="form-control" id="<?php echo $day . "_from_display" ?>"
                                       value="<?php echo $user->{$day . "_from"} ?>" name="<?php echo $day . "_from_display" ?>"
                                       readonly>
                            </div>
                            <div class="col-6">
                                <label for="<?php echo $day . "_until_display" ?>">until:</label>
                                <input type="time" class="form-control" id="<?php echo $day . "_until_display" ?>"
                                       name="<?php echo $day . "_until_display" ?>" value="<?php echo $user->{$day . "_until"} ?>" readonly>
                            </div>
                        </div><br>
                        <?php
                    }  else {
                        ?><div class="row">
                        <div class="col-12"><br>
                            <input type="button" class="btn btn-secondary btn-check" id="<?php echo "display_closed_" . $day ?>"
                                   value="The restaurant is closed on <?php echo $day . "s" ?>" disabled>
                        </div>
                        </div><br>
                    <?php }
                }
                echo "</div>";
                echo "<div class='hours' id='edit_hours'>";
                foreach ($days as $day) {
                    if ($user->{$day . "_from"} != NULL) {?>
                        <div class="row">
                            <div class="col-4">
                                <label for="<?php echo $day . "_from" ?>"><?php echo $day . " from:" ?></label>
                                <input type="time" value="<?php echo $user->{$day . "_from"} ?>" class="form-control" id="<?php echo $day . "_from" ?>" name="<?php echo $day . "_from" ?>">
                            </div>
                            <div class="col-4">
                                <label for="<?php echo $day . "_until" ?>">until:</label>
                                <input type="time" value="<?php echo $user->{$day . "_until"} ?>" class="form-control" id="<?php echo $day . "_until" ?>" name="<?php echo $day . "_until" ?>">
                            </div>
                            <div class="col-4"><br>
                                <input type="button" class="btn btn-secondary btn-check" id="<?php echo "closed_" . $day ?>" value="The restaurant is closed on <?php echo $day . "s" ?>" onclick="disable('<?php echo $day ?>');">
                                <input type="checkbox" name="<?php echo "closed_" . $day ?>" id="<?php echo  $day ?>" value="1" style="display: none;">
                            </div>
                        </div><br>
                        <?php
                    } else { ?>
                        <div class="row">
                            <div class="col-4">
                                <label for="<?php echo $day . "_from" ?>"><?php echo $day . " from:" ?></label>
                                <input type="time" value="<?php echo $user->{$day . "_from"} ?>" class="form-control" id="<?php echo $day . "_from" ?>" name="<?php echo $day . "_from" ?>" disabled>
                            </div>
                            <div class="col-4">
                                <label for="<?php echo $day . "_until" ?>">until:</label>
                                <input type="time" value="<?php echo $user->{$day . "_until"} ?>" class="form-control" id="<?php echo $day . "_until" ?>" name="<?php echo $day . "_until" ?>" disabled>
                            </div>
                            <div class="col-4"><br>
                                <input type="button" class="btn btn-primary btn-check" id="<?php echo "closed_" . $day ?>" value="The restaurant is open on <?php echo $day . "s" ?>" onclick="disable('<?php echo $day ?>');">
                                <input type="checkbox" name="<?php echo "closed_" . $day ?>" id="<?php echo  $day ?>" value="1" style="display: none;">
                            </div>
                        </div><br>

                        <?php
                    }
                }
                echo "</div>";
            }
            ?>
            <button type='submit' class='btn btn-primary' id='confirm' hidden disabled>Confirm changes</button>
        </form>
    </div>
</body>