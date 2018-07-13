<!doctype html>
<html>
<head>
<meta http-equiv="Content-Type " content="width=device-width, initial-scale=1" charset="utf-8">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Tangerine">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lobster&effect=brick-sign">
<title>MUSIC</title>
<script>
	function validateSignup() {
		var loginuser = document.forms["signup"]["loginuser"].value;
		if (loginuser == "") {
			alert("Username must be filled out");
			return false;
		}
		var firstname = document.forms["signup"]["firstname"].value;
		if (firstname == "") {
			alert("Firstname must be filled out");
			return false;
		}
		var lastname = document.forms["signup"]["lastname"].value;
		if (lastname == "") {
			alert("Lastname must be filled out");
			return false;
		}
		var email = document.forms["signup"]["email"].value;
		if (email == "") {
			alert("Email must be filled out");
			return false;
		}
		var email2 = document.forms["signup"]["email2"].value;
		if (email2 == "") {
			alert("Email must be filled out again");
			return false;
		}
		if (email != email2) {
			alert("Both email entered not matched");
			return false;
		}
		var password = document.forms["signup"]["password"].value;
		if (password == "") {
			alert("Password must be filled out");
			return false;
		}
		var password2 = document.forms["signup"]["password2"].value;
		if (password2 == "") {
			alert("password time must be filled out again");
			return false;
		}
		if (password != password2) {
			alert("Both password entered not matched");
			return false;
		}
	}
</script>
<style>
/* Style the header */
.header {
    background-color: #f1f1f1;
    padding: 20px;
    text-align: left;
}

h1 {
	font-family: "Lobster", serifc;
}

h2 {
	font-family: "Tangerine", Sans-serif;
	color: white;
}

p, h3 {
	font-family: "Comic Sans MS", cursive, sans-serif;
	color: white;
}

table, input {
	font-family: "Comic Sans MS", cursive, sans-serif;
}

body {
    background-color: #f0f0f2;
	background-image: url("img/img7.jpg");
	background-size: cover;
    margin: 0;
    padding: 0;
}

.backpage {
    width: 600px;
    margin: 5em auto;
    padding: 20px;
    background-color: rgba(200,200,200,0.5);
    border-radius: 1em;
}

.container {
	display: flex;
	float: left;
}

.border {
	border-bottom-style: solid;
	border-color: red;
}

.floating-box {
    display: block;
	float: left;
	text-align: left;
	position: relative;
    width: 150px;
    height: 100px;
    margin: 10px;
	padding: 10px;
    border: 3px solid #73AD21;  
}
</style>
</head>

<body>
<div class="backpage">
<div>
    <h1>Quick Sign Up</h1>
    <form name="signup" method="POST" action="register.php" onSubmit="return validateSignup()">
	<table align="center">
	<tr>
	<td>
		<input type = "username" name = "loginuser" placeholder="Username" value="<?php 
            if(isset($_SESSION['reg_fname'])) {
                echo $_SESSION['reg_fname'];
            }
            ?>" required>
	</td>
	</tr>
	<tr>
	<td>
    	<input type = "username" name = "firstname" placeholder="First Name" value="<?php 
            if(isset($_SESSION['reg_fname'])) {
                echo $_SESSION['reg_fname'];
            }
            ?>" required>
	</td>
	</tr>
	<tr>
	<td>
        <input type = "username" name = "lastname" placeholder="Last Name" value="<?php 
            if(isset($_SESSION['reg_lname'])) {
                echo $_SESSION['reg_lname'];
            }
            ?>" required>
	</td>
	</tr>
	<tr>
	<td>
        <input type= "email" name = "email" placeholder="Email Address" value="<?php 
            if(isset($_SESSION['reg_email'])) {
                echo $_SESSION['reg_email'];
            }
            ?>" required>
	</td>
	</tr>
	<tr>
	<td>
        <input type= "email" name = "email2" placeholder="Email Address Again" value="<?php 
            if(isset($_SESSION['reg_email2'])) {
                echo $_SESSION['reg_email2'];
            }
            ?>" required>
	</td>
	</tr>
	<tr>
	<td>
        <input type = "password" name = "password" placeholder="Password" required>
	</td>
	</tr>
	<tr>
	<td>
        <input type = "password" name = "password2" placeholder="Password again" required>
	</td>
	</tr>
	<tr>
	<td>
        <input type= "ucity" name = "city" placeholder="Please input your city">
	</td>
	</tr>
	<tr>
	<td>
        <input type = "phone" name = "Phonenumber" placeholder="Phone Number">
	</td>
	</tr>
	<tr>
	<td>
		<input type = "submit" name = "register_button" value = "Sign Up">
	</td>
	</tr>
    </form>
	</table>
    	<p><a href = "login.php">Back to Login</a></p>
</div>
</div>
</body>
</html>
