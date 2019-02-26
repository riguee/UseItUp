<!DOCTYPE html>
<div lang="en">
<head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
    <link href="styles.css" rel="stylesheet" type="text/css">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta charset="UTF-8">
    <title>All listings</title>
</head>
    <body class="container-fluid">
        <h1>Welcome back, <span class="accent">charity_name</span>.</h1>
        <form class="form-inline d-flex justify-content-center">
            <input type="text" class="form-control col-4" placeholder="Search for food">
            <button type="submit" class="btn btn-primary search-btn"><i class="fa fa-search"></i></button>
        </form>
        <br>
        <div class="collapse" id="collapseExample">
            <div class="card card-body">
                Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident.
            </div>
        </div>

        <div class="d-flex justify-content-center">
            <div class="col-md-5">
                <div class="card">
                    <div class="card-header" id="heading">Advanced search</div>
                    <div class="card-body">
                        <span style="margin-right: 10px">Sort by:</span>
                        <div class="form-check form-check-inline" style="margin: 0 0 10px 0">
                            <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio1" value="option1">
                            <label style="margin-right: 5px" class="form-check-label" for="inlineRadio1">distance</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio2" value="option2">
                            <label class="form-check-label" for="inlineRadio2">pick-up time</label>
                        </div>
                        <div class="form-inline" style="margin: 20px 0 10px 0">
                            <span style="margin-right: 10px">Portions:</span>
                            <select class="form-control">
                                <option>Show all</option>
                                <option>0-10</option>
                                <option>10-30</option>
                                <option>30-50</option>
                                <option>50-100</option>
                                <option>100-300</option>
                                <option>300+</option>
                            </select>
                        </div>
                        <br>
                        <span>Refine your search by deselecting allergens:</span>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="allergen1" checked>
                            <label class="form-check-label" for="allergen1">
                                Allergen 1
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="allergen2" checked>
                            <label class="form-check-label" for="allergen2">
                                Allergen 2
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="allergen3" checked>
                            <label class="form-check-label" for="allergen3">
                                Allergen 3
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="allergen4" checked>
                            <label class="form-check-label" for="allergen4">
                                Allergen 4
                            </label>
                        </div>
                        <br>
                        <span>Only show specific diets:</span>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="diet1">
                            <label class="form-check-label" for="diet1">
                                Vegetarian
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="diet2">
                            <label class="form-check-label" for="diet2">
                                Halal
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="diet3">
                            <label class="form-check-label" for="diet3">
                                Kosher
                            </label>
                        </div>
                        <br>
                        <button type="submit" class="btn btn-primary btn-block">Apply</button>
                    </div>
                </div>
            </div>
        </div>
            <br>
            <div class="card container-fluid" style="margin:10px 0 10px 0">
                <div class="card-body row" style="height: 300px">
                    <img class="col-3" src="https://thumbs.dreamstime.com/z/chef-showing-pasta-11270828.jpg">
                    <div class="col-9">
                        <h4>Listing title 1</h4>
                        <h6>by <a href="#">restaurant</a>.</h6>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque sed rhoncus lacus, tristique maximus neque. Nunc at risus aliquam, lacinia mauris at, tempor ante.</p>
                        <h6>Portions: 40</h6>
                        <h6>Allergens: allergen 1, allergen 2, allergen 3</h6>
                        <h6>Available pickup times: between 00/00/00 00:00:00 and 00/00/00 00:00:00</h6>
                        <br>
                        <form class="form-inline">
                            <span style="margin-right: 10px">Select pickup time</span>
                            <select class="form-control col-4">
                                <option>00:00:00</option>
                                <option>00:00:00</option>
                                <option>00:00:00</option>
                                <option>00:00:00</option>
                                <option>00:00:00</option>
                            </select>
                            <span style="margin: 0 10px 0 10px"> and </span>
                            <button type="submit" class="btn btn-primary col-4">Order</button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="card container-fluid" style="margin:10px 0 10px 0">
                <div class="card-body row" style="height: 300px">
                    <img class="col-3" src="https://thumbs.dreamstime.com/z/spaghetti-chef-7961514.jpg">
                    <div class="col-9">
                        <h4>Listing title 2</h4>
                        <h6>by <a href="#">restaurant</a>.</h6>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque sed rhoncus lacus, tristique maximus neque. Nunc at risus aliquam, lacinia mauris at, tempor ante.</p>
                        <h6>Portions: 40.</h6>
                        <h6>Allergens: allergen 1, allergen 2, allergen 3.</h6>
                        <h6>Available pickup times: between 00/00/00 00:00:00 and 00/00/00 00:00:00.</h6>
                        <br>
                        <form class="form-inline">
                            <span style="margin-right: 10px">Select pickup time</span>
                            <select class="form-control col-4">
                                <option>00:00:00</option>
                                <option>00:00:00</option>
                                <option>00:00:00</option>
                                <option>00:00:00</option>
                                <option>00:00:00</option>
                            </select>
                            <span style="margin: 0 10px 0 10px"> and </span>
                            <button type="submit" class="btn btn-primary col-4">Order</button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="card container-fluid" style="margin:10px 0 10px 0">
                <div class="card-body row" style="height: 300px">
                    <img class="col-3" src="https://d2gg9evh47fn9z.cloudfront.net/800px_COLOURBOX2744003.jpg">
                    <div class="col-9">
                        <h4>Listing title 3</h4>
                        <h6>by <a href="#">restaurant</a>.</h6>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque sed rhoncus lacus, tristique maximus neque. Nunc at risus aliquam, lacinia mauris at, tempor ante.</p>
                        <h6>Portions: 40.</h6>
                        <h6>Allergens: allergen 1, allergen 2, allergen 3.</h6>
                        <h6>Available pickup times: between 00/00/00 00:00:00 and 00/00/00 00:00:00.</h6>
                        <br>
                        <form class="form-inline">
                            <span style="margin-right: 10px">Select pickup time</span>
                            <select class="form-control col-4">
                                <option>00:00:00</option>
                                <option>00:00:00</option>
                                <option>00:00:00</option>
                                <option>00:00:00</option>
                                <option>00:00:00</option>
                            </select>
                            <span style="margin: 0 10px 0 10px"> and </span>
                            <button type="submit" class="btn btn-primary col-4">Order</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>