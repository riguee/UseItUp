<!DOCTYPE html>
<html lang="en">
<meta charset="UTF-8">

<head>
    <meta charset = "UTF-8">
    <title>Terry's DVD Rental</title>

    <style>
        body{
            font-family: "Arial";
        }

        img{
            display: block;
            margin-left: auto;
            margin-right: auto;
            width: 50%;
        }

        *{
            box-sizing: border-box;
        }

        #welcome{
            text-align: center;
        }

        #menu{
            list-style-type: none;
            padding: 0;
            margin: 0;
        }

        #menu li a:hover {
            background-color: lightyellow;
        }
    </style>
</head>

<body bgcolor="#ffffe0">
    <img src="https://upload.wikimedia.org/wikipedia/commons/9/9b/DVD_logo.svg" alt="DVD Icon" width="250" height="250">
    <p style="text-align: center">Terry's DVD rental, the best in London!</p>

    <div id="welcome">
        <h1>Welcome to Terry's DVD Rental</h1>
        <p>We offer an amazing web page for you to search the best DVDs!</p>
        <p>Start off by typing for specific category inside search bar to filter DVDs.</p>
    </div>

    <div id="home">
        <h1 style="text-align: center">Home Page</h1>

        <h2>Search DVD Menu</h2>
        <form name="search" method="post" action="index.php">
            <input name="bar" type="text" placeholder="Search...">
            <input type="submit" value="Send">
        </form>

        <p>
            <?php
            if(isset($_POST['bar'])) {
                $bar = $_POST['bar'];

                if($bar == "") {
                    print("No search given. Please try again.");
                }
                else{
                    $mysqli = new mysqli("localhost", "root", "root", "sakila");

                    $query = "SELECT title FROM film WHERE title LIKE '%" . $bar ."%'";
                    $results_film = $mysqli->query($query);

                    if($results_film->num_rows > 0) {
                        print("Film matches:");
                        echo "<br>";

                        while ($row = $results_film->fetch_assoc()) {
                            print($row["title"]);
                            echo "<br>";
                        }
                    }
                }
            }
            ?>
        </p>
        <ul id="menu">
            <li><a href="index.php">Home</a></li>
        </ul>

        <h2>Sign In</h2>

        <p>Login with your email address and password</p>

        <form name="user" method="post" action="index.php">
            Email:
            <input name="email" type="email">
            <p></p>
            First name:
            <input type="firstname" name="fname" maxlength="30">
            <p></p>
            Last name:
            <input type="lastname" name="lname" maxlength="30">
            <p></p>
            <input type="submit" value="Login">
        </form>

        <?php
        if(isset($_POST['email'])) {
            $email = $_POST['email'];
            $fname = $_POST['fname'];
            $lname = $_POST['lname'];

            echo "<br>";

            if($email == "" or $fname == "" or $lname == "") {
                print("* All fields are required.");
            }
            else {
                $mysqli = new mysqli("localhost","root","root","sakila");

                $results = $mysqli->query("SELECT email, first_name, last_name FROM customer WHERE email='" . $email . "'");

                if($results->num_rows > 0) {
                    $row = $results->fetch_assoc();

                    if (strtoupper($fname) != strtoupper($row['first_name']) or strtoupper($lname) != strtoupper($row['last_name'])) {
                        print("Your details are wrong. Please try again.");
                    } else {
                        print("You've successfully logged in.");
                    }
                }
                else {
                    print("Your details were not found. Creating an account...");
                    echo "<br>";

                    $email_array = explode("@", $email);

                    if(count($email_array) != 2) {
                        print("The format for your email is wrong.");
                    }
                    else {
                        $email = strtoupper($email_array[0]) . "@" . strtolower($email_array[1]);
                        $fname = strtoupper($fname);
                        $lname = strtoupper($lname);

                        $total = $mysqli->query("SELECT MAX(address_id) AS max_add FROM customer");

                        $row = $total->fetch_assoc();

                        $query = "INSERT INTO customer (customer_id, store_id, first_name, last_name, email, address_id, active, create_date, last_update) VALUES (NULL, 2, '" . $fname . "', '" . $lname . "', '" . $email . "', " . $row['max_add'] . ", 0, '" . date("Y-m-d h:m:s") . "', NULL)";

                        if ($mysqli->query($query) === true) {
                            print("Your account has been created.");
                        }
                        else {
                            print("Error: " . $query);
                            echo "<br>";
                            print($mysqli->error);
                        }
                    }
                }
            }
        }
        ?>
    </div>
</body>