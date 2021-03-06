<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/css/bootstrap-select.css" />
    <link rel="stylesheet" href="styles.css">
    <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/js/bootstrap-select.min.js"></script>
    <title>New listing</title>
</head>

<body>
<?php
 include"connection.php";
    session_start();
    if (empty($_SESSION)) {
        header( "location: index.php" );
    }
    elseif ($_SESSION['user_type'] == 'charity') {
        header( "location: main-listing.php" );
    }
    elseif ($_SESSION['user_type'] == 'restaurant') {
        include 'navbar-restaurant.php';
    }
    else {
        header( "location: logout.php" );
    }

    ?>
<script>

</script>

<div class="container">
    <h1>New listing</h1>
    <?php
    $today = strtolower(date("l"));
    $query = "SELECT " . $today . "_from, " . $today . "_until FROM restaurants WHERE id = " . $_SESSION['id'];
    $check = $conn->query($query);
    $check_result = $check->fetch_assoc();
    if ($check_result[$today . '_from'] == NULL) {
        echo "You can only create listings on the day itself. You have not specified opening hours on " . ucfirst($today) . "s. <br> You can change your pickup hours on the 'My Account' tab. <br> Listings will automatically expire at the end of the pickup window.</br> ";
    } else {
    ?>

        <?php
        $stmt = $conn->prepare("SELECT * FROM listings WHERE saved = 1 AND restaurant_id = " . $_SESSION['id']);
        $stmt->execute();
        $result = $stmt->get_result();
        if (mysqli_num_rows($result) > 0) { ?>
            <form name="selectsaved" action="" method="post">
                <label for="dishes" onchange="">Select one of your saved dishes:</label>
                <div class="row">
                    <div class="col-11">
                        <select class="form-control" name="dishes" id="dishes">
                            <option selected value disabled> -- select an option -- </option>";
            <?php
            while($row = $result->fetch_assoc()) {
                echo "<option value='".$row["id"]."'>".$row["title"]."</option>";
            } ?>
                        </select>
                    </div>
                    <div class="col-1">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                    </div>
                </form>
            or <br>
        <?php }
        else {
            echo "<br><n/>Listings will expire if they are not ordered before the end of pickup time. <br>";
        }


        ?>

    <?php
    if (isset($_POST['dishes'])) {
        $query = "SELECT * FROM listings where id = ". $_POST['dishes'];
        $savedstmt = $conn->query($query);
        $savedstmt = $savedstmt->fetch_assoc();
        $allergens = $conn->query("SELECT allergen_id FROM allergen_listings WHERE listing_id =". $_POST['dishes']);
        $allergens_array = array();
        if (mysqli_num_rows($allergens) > 0) {
            while($row = $allergens->fetch_assoc()) {
                $tmp = $row['allergen_id'];
                array_push($allergens_array, $tmp);
            }
        }
        $diets = $conn->query("SELECT diet_id FROM diet_listings WHERE listing_id =". $_POST['dishes']);
        $diets_array = array();
        if (mysqli_num_rows($diets) > 0) {
            while($row = $diets->fetch_assoc()) {
                $tmp = $row['diet_id'];
                array_push($diets_array, $tmp);
            }
        }

    }
    ?>
    <form name="newlisting" enctype="multipart/form-data" autocomplete="off" action="created-listing.php" method="post">
        <br>
        <label for="title">Fill in information for a new dish:</label>
        <input type="text" class="form-control" id="title" name="title" placeholder="Name of the dish" value="<?php if (isset($_POST['dishes'])) { echo $savedstmt['title'];}?>" required>
        <br>
        <label for="description">Description</label>
        <textarea type="text" class="form-control" rows="5" id="description" name="description" placeholder="e.g. ingredients, flavour, etc." required><?php if (isset($_POST['dishes'])) { echo $savedstmt['description'];}?></textarea>
        <br>
        <?php if(isset($_POST['dishes'])){
            echo "<input type=\"hidden\" id=\"savedimg\" name=\"savedimg\" value=". $savedstmt['image'] .">";
        }
        else {
            echo "<label for=\"image\">Choose an image</label>
        <input type=\"file\" id=\"image\" class=\"form-control-file\" name=\"fileToUpload\"  >";
        }
        ?>
        <br>
        <label for="portions">Quantity</label>
        <input type="number" name="portions" id="portions" class="form-control" min="1" required>
        <br>
        <label for="allergens">Allergens:</label>
        <select name="allergen[]" id="allergens" class="selectpicker" multiple data-live-search="true">
            <?php
            $stmt = $conn->prepare("SELECT * FROM allergens");
            $stmt->execute();
            $result = $stmt->get_result();
            if (mysqli_num_rows($result) > 0) {
                // output data of each row
                while($row = $result->fetch_assoc()) {?>
                    <option value='<?php echo $row["id"]?>'<?php if (isset($_POST['dishes'])) {if(in_array($row["id"], $allergens_array)){echo "selected";}}?> > <?php echo $row["allergen"]?></option>
                    <?php
                }
            }
            ?>
        </select>
        <br>
        <br>
        <label for="diets">Suitable for:</label>
        <select name="diet[]" id="diets" class="selectpicker" multiple>
            <?php
            $diets = $conn->prepare("SELECT * FROM diets");
            $diets->execute();
            $dietresult = $diets->get_result();
            if (mysqli_num_rows($dietresult) > 0) {
                // output data of each row
                while($dietrow = $dietresult->fetch_assoc()) {?>
                    <option value='<?php echo $dietrow["id"]?>'<?php if (isset($_POST['dishes'])) {if(in_array($dietrow["id"], $diets_array)){echo "selected";}}?> > <?php echo $dietrow["diet"]?></option>
                    <?php
                }
            }
            else {
                echo "There are no dietary requirements available at this time.";
            }
            ?>
        </select>
        <br>
        <br>
        <input type="checkbox" name="remember" id="remmemberme" value="1" <?php if (isset($_POST['dishes'])) {echo "disabled";}?>>
        <label for="remmemberme" >Remember this dish.</label>
        <br><br>
        <!--
            <br><br><div class="col-md-6 mx-auto">
                Pickup time <br>
                From:
                <input type="time"  class="form-control" name="from" id="from"><br>
                Until:
                <input type="time" class="form-control" name="until" id="until" data-custom-pattern="Invalid date">
                <br><br></div>
                -->
        <button type="submit" class="btn btn-primary col-md-12" id="submitlisting" value="Upload Image" >Submit</button>
        <br>
        <br>
    </form> <?php } ?>
</div>
</body>
</html>
