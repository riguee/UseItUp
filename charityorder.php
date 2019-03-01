<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
    <link rel="stylesheet" href="common.css">
    <title>charity order</title>
    <script
            src="https://code.jquery.com/jquery-3.3.1.min.js"
            integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
            crossorigin="anonymous"></script>
    <script src="nav.js"></script>
</head>
<body>
<?php include 'navbarcharity.php'?>
<h1>Orders</h1><br><br>
<h2>Upcoming orders</h2><br>



<div class="card">
    <h5 class="card-header">Order #1234567890</h5>
    <div class="row">
        <div class="col-2">
            <div class="middle">
                <p>Pickup window:<br>19:34<br>19:35</p>
            </div>
        </div>
        <div class="col-10">
            <h6 style="margin-top: 15px; margin-bottom: 15px">From: <a href="#">Restaurant</a>.</h6>
            <div>
                <p>Pick up address: 1 Main Street, AB12C34</p>
            </div>
            <table class="table">
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Dish</th>
                    <th scope="col">Quantity</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <th scope="row">1</th>
                    <td>Banana</td>
                    <td>500</td>
                </tr>
                <tr>
                    <th scope="row">2</th>
                    <td>Pineapple</td>
                    <td>3</td>
                </tr>
                <tr>
                    <th scope="row">3</th>
                    <td>Strawberry</td>
                    <td>1</td>
                </tr>
                </tbody>
            </table><br>
            <div class="row">

                <div style="position: absolute; right: 5%; bottom: 5%">
                    <button class="btn btn-secondary">Edit order</button>
                </div>
            </div>
        </div>
    </div>
</div>

<br>
<hr>
<h2>Order history</h2>
<br>
<h3>Last week</h3>
<br><br>
<div class="card">
    <h5 class="card-header">Order #1234567890</h5>
    <div class="row">
        <div class="col-2">
            <div class="middle">
                <p>Pickup date:<br>Mon 01/01</p>
            </div>
        </div>
        <div class="col-10">
            <h6 style="margin-top: 15px; margin-bottom: 15px">From: <a href="#">Restaurant</a>.</h6>
            <table class="table">
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Dish</th>
                    <th scope="col">Quantity</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <th scope="row">1</th>
                    <td>Banana</td>
                    <td>500</td>
                </tr>
                <tr>
                    <th scope="row">2</th>
                    <td>Pineapple</td>
                    <td>3</td>
                </tr>
                <tr>
                    <th scope="row">3</th>
                    <td>Strawberry</td>
                    <td>1</td>
                </tr>
                </tbody>
            </table>
                </div>
            </div>
        </div>
    </div>
</div>
<br><br>
</body>
</html>