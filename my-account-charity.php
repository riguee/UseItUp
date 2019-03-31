
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
    header( "location: index.php" );
} elseif ($_SESSION['user_type'] == 'charity') {
    include 'navbar-charity.php';
} elseif ($_SESSION['user_type'] == 'restaurant') {
    header( "location: my-account-restaurant.php" );
} else {
    header( "location: logout.php" );
}
$id = $_SESSION['id'];

    $user = new Charity();
    $user->setCharityFromId($id);
?>
<script>
    function edit() {
        if (document.getElementById('email').hasAttribute('readonly')){
            document.getElementById('name').removeAttribute("readonly");
            document.getElementById('email').removeAttribute("readonly");
            document.getElementById('phone').removeAttribute("readonly");
            document.getElementById('address').removeAttribute("readonly");
            document.getElementById('postcode').removeAttribute("readonly");
            document.getElementById('charityid').removeAttribute("readonly");
            document.getElementById('confirm').hidden = false;
            document.getElementById('confirm').disabled = false;
            document.getElementById('edit').classList.remove("btn-primary");
            document.getElementById('edit').classList.add("btn-danger");
            document.getElementById('edit').innerHTML = "Cancel changes";
        }
        else {
            document.getElementById('name').readOnly = true;
            document.getElementById('name').value = "<?php echo $user->name ?>";
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
    <h1>My account</h1>
    <button type='button' class='btn-edit btn btn-primary btn-block col-sm-10 col-md-6 mx-auto' onclick='edit();' id='edit'>Edit details</button>
    <form method="post" action="edit-account.php">
        <input type="hidden" name="user_type" value="<?php echo $_SESSION['user_type'] ?>">
        <div class="col-sm-10 col-md-6 my-1 mx-auto">
            <div class="input-group">
                <div class="input-group-prepend">
                    <div class="input-group-text">Name</div>
                </div>
                <input type="text" class="form-control" placeholder="Name" name="name" id="name" value="<?php echo $user->name ?>" readonly>
            </div>
        </div>
        <div class="col-sm-10 col-md-6 my-1 mx-auto">
            <div class="input-group">
                <div class="input-group-prepend">
                    <div class="input-group-text">Email</div>
                </div>
                <input type="email" class="form-control" placeholder="Email" name="email" id="email" value="<?php echo $user->email ?>" readonly>
            </div>
        </div>
        <div class="col-sm-10 col-md-6 my-1 mx-auto">
            <div class="input-group">
                <div class="input-group-prepend">
                    <div class="input-group-text">Phone</div>
                </div>
                <input type="text" class="form-control" placeholder="Phone Number" name="phone" id="phone" value="<?php echo $user->phone ?>" readonly>
            </div>
        </div>
        <div class="col-sm-10 col-md-6 my-1 mx-auto">
            <div class="input-group">
                <div class="input-group-prepend">
                    <div class="input-group-text">Address</div>
                </div>
                <input type="text" class="form-control" placeholder="Address" name="address" id="address" value="<?php echo $user->address ?>" readonly>
            </div>
        </div>
        <div class="col-sm-10 col-md-6 my-1 mx-auto">
            <div class="input-group">
                <div class="input-group-prepend">
                    <div class="input-group-text">Postcode</div>
                </div>
                <input type="text" class="form-control" placeholder="Postcode" name="postcode" id="postcode" value="<?php echo $user->postcode ?>" readonly>
            </div>
        </div>
        <div class="col-sm-10 col-md-6 my-1 mx-auto">
            <div class="input-group">
                <div class="input-group-prepend">
                    <div class="input-group-text">Charity number</div>
                </div>
                <input type="text" class="form-control" placeholder="Charity number" name="charityid" id="charityid" value="<?php echo $user->charity_number ?>" readonly>
            </div>
        </div>
        <button type='submit' class='btn btn-primary btn-block col-sm-10 col-md-6 my-1 mx-auto' id='confirm' hidden disabled>Confirm changes</button>
    </form>


</body>
</html>
