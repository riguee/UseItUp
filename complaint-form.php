<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
    <link rel="stylesheet" href="styles.css">
    <title>Report a Problem</title>
</head>
<body>
<?php
session_start();
if (empty($_SESSION)) {
    header( "location: index.php" );
}
elseif ($_SESSION['user_type'] == 'charity') {
    include 'navbar-charity.php';
}
elseif ($_SESSION['user_type'] == 'restaurant') {
    include 'navbar-restaurant.php';
}
else {
    header( "location: logout.php" );
}?>



<div class="container">
    <h1>Report a Problem</h1>
    <div><p></p>
        <div>
            <?php
            if (!empty($_SESSION['problem'])) {
                $_SESSION['problem'] = false;
                echo "Complaint submitted!";
            }
            ?>
        </div>
    </div><p></p>
    <p>Please fill in this form to lodge a complaint or report a problem regarding your order.</p>

    <hr>
    <form method="post" action="submit-complaint.php">
        <label for="subject">Subject</label>
        <input type="text" class="form-control" placeholder="Enter subject" minlength="1" name="subject" id="subject" required value="<?php if (isset($_POST['order'])) {print("Order #" . $_POST['order']);} ?>">
        <small class="form-text text-muted">If your issue concerns a specific order, please write the order's ID as the subject.</small>
        <br>
        <label for="complaint">Description</label>
        <textarea name="complaint" id="complaint" class="form-control" rows="4" cols="50" minlength="10" placeholder="<?php if ($_SESSION['user_type'] == 'restaurant') {print("e.g. The charity did not show up or showed up late");} ?> <?php if ($_SESSION['user_type'] == 'charity') {print("e.g. The restaurant had closed or there was a mistake in the order");} ?>" required></textarea>
        <br>
        <button type="submit" class="btn btn-primary btn-block">Submit</button>
    </form>

</div>


</div>
</div>
</div>
</body>
</html>