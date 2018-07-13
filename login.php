<!doctype html>
<?php 
session_start();
 ?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type " content="width=device-width, initial-scale=1" charset="utf-8">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Tangerine">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lobster&effect=brick-sign">
<title>MUSIC</title>
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
    <a name = "top"/>
    <h1 class="font-effect-brick-sign">Enjoy Your Music!</h1>
    <h2>Here, your fantanstic music journey starts.</h2>

    <form align="center" name="login" method = "POST" action="verification.php">
        <input type = "text" name = "loginuser" placeholder="Username" required><br>
        <input type ="password" name = "loginpassword" placeholder="Password"><br>
		<input type = "submit" name="login_button" value = "Login"><br>
		<p><a href="signup.php">Sign Up Now</a></p>
		<p><a href="#top">Back to top</a></p>
	</form>
</div>
<p class="w3-opacity">Designed by: Jerry Jiang, Keson Gao</p>	
</body>
</html>
