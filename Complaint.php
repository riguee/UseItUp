<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Complaint Form</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
    <link rel="stylesheet" href="styles.css">
</head>
<body>
<?php include 'navbarcharity.php' ?>
<div class="container-fluid">
<form action="/action_page.php">
    <div class="container">
        <h1>Complaint Form</h1>
        <p>Please fill in this form to lodge a complain.</p>
        <hr>

        <div>
            <label for="Tac"><b>Type of Complaint</b></label>
            <select class="form-control">
                <option value="option1">Option1</option>
                <option value="option2">Option2</option>
            </select>
        </div>
        <br>
        <label for="subject"><b>Subject of Complaint</b></label>
        <input type="text" class="form-control" placeholder="Enter Subject" name="subject" required value="<?php if (isset($_POST['order-id'])) {print($_POST['order-id']);} ?>">
        <br>
        <label for="complaint"><b>Description of Complaint</b></label>
        <textarea class="form-control" rows="4" cols="50"></textarea>
        <br>
        <p>By submitting a complaint you agree to our <a href="#" style="color:dodgerblue">Terms & Privacy</a>.</p>
        <div class="clearfix">
            <button type="submit" class="btn btn-primary btn-block">Submit</button>
        </div>
    </div>
</form>


</div>
</body>
</html>