<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
    <link rel="stylesheet" href="styles.css">
    <title>Complaint Form</title>
</head>
<body>
<?php
session_start();
print_r($_SESSION);
if ($_SESSION['user_type'] == 'charity') {
    include 'navbar-charity.php';
}
if ($_SESSION['user_type'] == 'restaurant') {
    include 'navbar-restaurant.php';
}?>
<div class="container">
    <h1>Complaint Form</h1>
    <p>Please fill in this form to lodge a complain.</p>
    <hr>
    <form method="post" action="submit-complaint.php">
        <label for="subject">Subject of complaint</label>
        <input type="text" class="form-control" placeholder="Enter subject" name="subject" id="subject" required value="<?php if (isset($_POST['order'])) {print("Order #" . $_POST['order']);} ?>">
        <small class="form-text text-muted">If your complaint concerns a specific order, please write the order's ID as the subject of the complaint.</small>
        <br>
        <label for="complaint">Description</label>
        <textarea name="complaint" id="complaint" class="form-control" rows="4" cols="50" placeholder="<?php if ($session == 'restaurant') {print("e.g. The charity did not show up or showed up late");} ?> <?php if ($session == 'charity') {print("e.g. The restaurant had closed or there was a mistake in the order");} ?>"></textarea>
        <br>
        <p>By submitting a complaint you agree to our <a href="#" style="color:dodgerblue">Terms & Privacy</a>.</p>
        <button type="submit" class="btn btn-primary btn-block">Submit</button>
    </form>
</div>
</body>
</html>