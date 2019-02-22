<!DOCTYPE html>
<html lang="en">
<head>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
    <link href="styles.css" rel="stylesheet" type="text/css">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta charset="UTF-8">
    <title>Confirm order</title>
</head>
<body class="container-fluid">
<h1>Your order</h1>
<div class="card">
    <h5 class="card-header">Order #1234567890</h5>
    <div class="row">
        <div class="col-2">
            <div class="middle">
                <p>Pickup window:<br>19:34<br>19:35</p>
            </div>
        </div>
        <div class="col-10">
            <h6 style="margin-top: 15px; margin-bottom: 15px">From: <a href="#">Restaurant</a></h6>
            <p>Pick up address: 1 Main Street, AB12C34</p>
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
    <button style="margin: 30px 30% 30px 30%" class="btn btn-secondary">Edit order</button>
</div>
<br>
<form class="form-inline" style="margin: 0 10% 0 10%">
    <span style="margin-right: 10px">Confirm pickup time</span>
    <select class="form-control col-4">
        <option>00:00:00</option>
        <option>00:00:00</option>
        <option>00:00:00</option>
        <option>00:00:00</option>
        <option>00:00:00</option>
    </select>
    <span style="margin: 0 10px 0 10px">and</span>
    <button type="submit" class="btn btn-primary col-4">Place order</button>
</form>
<br>
<br>
<h1>Other listings from the same restaurant</h1>
<div class="card">
    <div class="card-body row">
        <img class="col-3 listing-img" src="https://thumbs.dreamstime.com/z/spaghetti-chef-7961514.jpg">
        <div class="col-9">
            <h4>Listing title 2</h4>
            <h6>by <a href="#">restaurant</a>.</h6>
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque sed rhoncus lacus, tristique maximus neque. Nunc at risus aliquam, lacinia mauris at, tempor ante.</p>
            <h6>Portions: 40.</h6>
            <h6>Allergens: allergen 1, allergen 2, allergen 3.</h6>
            <h6>Available pickup times: between 00/00/00 00:00:00 and 00/00/00 00:00:00.</h6>
            <br>
            <button class="btn btn-primary">Add to order</button>
        </div>
    </div>
</div>
<br>
<div class="card">
    <div class="card-body row">
        <img class="col-3 listing-img" src="https://d2gg9evh47fn9z.cloudfront.net/800px_COLOURBOX2744003.jpg">
        <div class="col-9">
            <h4>Listing title 3</h4>
            <h6>by <a href="#">restaurant</a>.</h6>
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque sed rhoncus lacus, tristique maximus neque. Nunc at risus aliquam, lacinia mauris at, tempor ante.</p>
            <h6>Portions: 40.</h6>
            <h6>Allergens: allergen 1, allergen 2, allergen 3.</h6>
            <h6>Available pickup times: between 00/00/00 00:00:00 and 00/00/00 00:00:00.</h6>
            <br>
            <button class="btn btn-primary">Add to order</button>
        </div>
    </div>
</div>
<br>
</body>
</html>