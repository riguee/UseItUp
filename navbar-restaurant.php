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
            <li class="nav-item <?php if (basename($_SERVER['PHP_SELF']) == "new-listing.php") {print("active");} ?>">
                <a class="nav-link" href="new-listing.php">Upload a listing <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item" <?php if (basename($_SERVER['PHP_SELF']) == "my-account.php") {print("active");} ?>>
                <a class="nav-link" href="my-account.php">My account <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item <?php if (basename($_SERVER['PHP_SELF']) == "restaurant-orders.php") {print("active");} ?>">
                <a class="nav-link" href="restaurant-orders.php">Orders <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item <?php if (basename($_SERVER['PHP_SELF']) == "complaint-form.php") {print("active");} ?>">
                <a class="nav-link" href="complaint-form.php">Report a problem <span class="sr-only">(current)</span></a>
            </li>
        </ul>
        Welcome <?php echo $name ?>
        <a style="margin-left: 10px" href="logout.php">Log out</a>
    </div>
</nav>