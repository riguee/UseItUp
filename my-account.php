
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
    header( "location: my-account-restaurant.php" );
} else {
    header( "location: Logout.php" );
}
$id = $_SESSION['id'];

    $user = new Charity();
    $user->setCharityFromId($id);
?>
<script>
    function edit() {
        if (document.getElementById('email').hasAttribute('readonly')){
            document.getElementById('email').removeAttribute("readonly");
            document.getElementById('phone').removeAttribute("readonly");
            document.getElementById('address').removeAttribute("readonly");
            document.getElementById('postcode').removeAttribute("readonly");
            document.getElementById('charityid').removeAttribute("readonly");
            document.getElementById('confirm').hidden = false;
            document.getElementById('confirm').disabled = false;
            document.getElementById('edit').classList.remove("btn-primary");
            document.getElementById('edit').classList.add("btn-secondary");
            document.getElementById('edit').innerHTML = "Cancel changes";
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
            document.getElementById('charityid').readOnly = true;
            document.getElementById('charityid').value = "<?php echo $user->charity_number ?>";
            document.getElementById('confirm').hidden = true;
            document.getElementById('confirm').disabled = true;
            document.getElementById('edit').classList.remove("btn-secondary");
            document.getElementById('edit').classList.add("btn-primary");
            document.getElementById('edit').innerHTML = "Edit details";
        }
    }

</script>

<div class="container">
    <h1><?php echo $user->name ?></h1>
    <?php if ($_SESSION['user_type'] == 'charity') {
        echo '<button type=\'button\' class=\'btn btn-primary\' onclick=\'edit();\' id=\'edit\'>Edit details</button>';
    } else {
        echo "<button type='button' class='btn btn-primary' onclick='editrest();' id='editrest'>Edit details</button>";
} ?>

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

                echo "<div class=\"row\">
                <div class=\"col-4\">Charity ID </div>
                <div class=\"col-8\"><input class='form-control-plaintext' type='text' name='charityid' placeholder='charity id' id=\"charityid\" value=\"". $user->charity_number ."\" readonly>
                </div>";

            ?>
            <button type='submit' class='btn btn-primary' id='confirm' hidden disabled>Confirm changes</button>
        </form>
    </div>


</body>
</html>
