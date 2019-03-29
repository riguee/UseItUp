<nav class="navbar navbar-expand-lg navbar-dark" style="background-color: #82924d">
    <span class="navbar-brand mb-0 h1" style="color: #e7bb41">UseItUp</span>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <?php
    $name = $_SESSION['name'];
    ?>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item <?php if (basename($_SERVER['PHP_SELF']) == "main-listing.php") {print("active");} ?>">
                <a class="nav-link" href="main-listing.php">Search for food <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item <?php if (basename($_SERVER['PHP_SELF']) == "my-account-charity.php") {print("active");} ?>">
                <a class="nav-link" href="my-account-charity.php">My account <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item <?php if (basename($_SERVER['PHP_SELF']) == "charity-orders.php") {print("active");} ?>">
                <a class="nav-link" href="charity-orders.php">My orders <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item <?php if (basename($_SERVER['PHP_SELF']) == "complaint-form.php") {print("active");} ?>">
                <a class="nav-link" href="complaint-form.php">Report a problem <span class="sr-only">(current)</span></a>
            </li>
        </ul>
        <!--<?php /*if (basename($_SERVER['PHP_SELF']) != "main-listing.php") { ?>
        <form class="form-inline my-2 my-lg-0" method="post" action="main-listing.php">
            <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search" name="search">
            <button class="btn btn-outline-warning my-2 my-sm-0" type="submit"><i class="fa fa-search"></i></button>
        </form>
        <?php } */?>-->
        <span style="color:white">Welcome, <span class="accent"><?php echo $name ?></span>.</span>
        <a class="btn btn-light" style="margin-left: 10px" href="logout.php">Log out</a>
    </div>
</nav>