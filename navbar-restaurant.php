<nav class="navbar navbar-expand-lg navbar-dark" style="background-color: #82924d">
    <span class="navbar-brand mb-0 h1" style="color: #e7bb41">UseItUp</span>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item <?php if (basename($_SERVER['PHP_SELF']) == "newlisting.php") {print("active");} ?>">
                <a class="nav-link" href="newlisting.php">Upload a listing <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">My account <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item <?php if (basename($_SERVER['PHP_SELF']) == "restaurant-orders.php") {print("active");} ?>">
                <a class="nav-link" href="restaurant-orders.php">Orders <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item <?php if (basename($_SERVER['PHP_SELF']) == "Complaint.php") {print("active");} ?>">
                <a class="nav-link" href="Complaint.php">Report a problem <span class="sr-only">(current)</span></a>
            </li>
        </ul>
    </div>
</nav>