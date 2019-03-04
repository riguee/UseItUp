<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>UseItUp SignUp page</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="styles.css">

</head>
<body bgcolor="#fcfff5">

<form action="/action_page.php" style="border:1px solid #ccc">
    <div class="container">
        <h1>Sign Up</h1>
        <p>Please fill in this form to create an account.</p>
        <hr>

        <div>
            <label for="Tac"><b>Type of Account</b></label>
            <select>
                <option value="restaurant">Restaurant</option>
                <option value="charity">Charity</option></select>
            </select>
        </div>
        <p>
        </p>
        <p>

        </p>

        <label for="name"><b>Name</b></label>
        <input type="text" placeholder="Enter Name" name="name" required>

        <label for="email"><b>Email</b></label>
        <input type="text" placeholder="Enter Email" name="email" required>

        <label for="address"><b>Address</b></label>
        <input type="text" placeholder="Enter address" name="address" required>

        <label for="postcode"><b>Postcode</b></label>
        <input type="text" placeholder="Enter Postcode" name="text" required>


        <label for="pwd"><b>Password</b></label>
        <input type="password" placeholder="Enter Password" name="pwd" maxlength="15" required>

        <label for="pwdrepeat"><b>Repeat Password</b></label>
        <input type="password" placeholder="Repeat Password" name="pwd-repeat" required>

        <label for="charityID"><b>Charity ID (if applicable)</b></label>
        <input type="text" placeholder="Enter charity ID" name="charity ID" required>

        <label for="logoID"><b>Insert Logo (optional)</b></label>
        <input type="file" placeholder="Logo" name="logo" optional>

        <p>

        </p>

        <p>By creating an account you agree to our <a href="#" style="color:dodgerblue">Terms & Privacy</a>.</p>

        <div class="clearfix">
            <button type="button" class="cancelbtn">Cancel</button>
            <button type="submit" class="signupbtn">Sign Up</button>
        </div>
    </div>
</form>



</body>
