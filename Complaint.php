<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>UseItUp Complaint Form</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">

    <style>
        body {font-family: Roboto;}
        * {box-sizing: border-box}

        /* Full-width input fields */
        input[type=text], input[type=password], input[type=number], input[textarea=text], textarea {
            width: 100%;
            padding: 15px;
            margin: 5px 0 22px 0;
            display: inline-block;
            border: none;
            background: #f1f1f1;
        }

        input[type=text]:focus, input[type=password]:focus, textarea {
            background-color: #dddddd;
            outline: none;
        }

        hr {
            border: 1px solid #f1f1f1;
            margin-bottom: 25px;
        }

        /* Set a style for all buttons */
        button {
            background-color: #4CAF50;
            color: white;
            padding: 14px 20px;
            margin: 8px 0;
            border: none;
            cursor: pointer;
            width: 100%;
            opacity: 0.9;
        }

        button:hover {
            opacity:1;
        }

        /* Extra styles for the cancel button */
        .cancelbtn {
            padding: 14px 20px;
            background-color: red;
        }

        /* Float cancel and signup buttons and add an equal width */
        .cancelbtn, .signupbtn {
            float: left;
            width: 10%;
        }

        /* Add padding to container elements */
        .container {
            padding: 16px;
        }

        /* Clear floats */
        .clearfix::after {
            content: "";
            clear: both;
            display: table;
        }

        /* Change styles for cancel button and signup button on extra small screens */
        @media screen and (max-width: 300px) {
            .cancelbtn, .signupbtn {
                width: 100%;
            }
        }
    </style>
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