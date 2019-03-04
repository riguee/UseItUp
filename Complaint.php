<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>UseItUp Complaint Form</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="styles.css">
</head>
<body bgcolor="#fcfff5">

<form action="/action_page.php" style="border:1px solid #ccc">
    <div class="container">
        <h1>Complaint Form</h1>
        <p>Please fill in this form to lodge a complain.</p>
        <hr>

        <div>
            <label for="Tac"><b>Type of Complaint</b></label>
            <select>
                <option value="option1">Option1</option>
                <option value="option2">Option2</option></select>
            </select>
        </div>
        <p>
        </p>
        <p>

        </P>

        <label for="name"><b>Name</b></label>
        <input type="text" placeholder="Enter Name" name="name" required>

        <label for="email"><b>Email</b></label>
        <input type="text" placeholder="Enter Email" name="email" required>


        <label for="subject"><b>Subject of Complaint</b></label>
        <input type="text" placeholder="Enter Subject" name="subject" required>

        <label for="complaint"><b>Description of Complaint</b></label>
        <p></p>
        <textarea rows="4" cols="50"></textarea>
        <p>

        </p>

        <p>By submitting a complaint you agree to our <a href="#" style="color:dodgerblue">Terms & Privacy</a>.</p>

        <div class="clearfix">
            <button type="button" class="btn btn-danger">Cancel</button>
            <button type="submit" class="btn btn-primary">Submit</button>
        </div>
    </div>
</form>



</body>
</html>