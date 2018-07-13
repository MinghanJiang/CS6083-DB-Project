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
<title>Play</title>
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
    width: 1000px;
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
</style>
</head>

<body>
<div class="backpage">
<?php
$server = $_SESSION["server"];
$dbusername = $_SESSION["dbusername"];
$dbpassword = $_SESSION["dbpassword"];
$database = $_SESSION["database"];

$loginuser = $_SESSION["loginuser"];
if (isset($_GET['uname'])) {
	$uservisited = $_GET['uname'];
} else {
	$uservisited = $_SESSION['uname'];
}

$connection = new mysqli($server, $dbusername, $dbpassword);

if ($connection->connect_error) {
	die("Connection failed: " . $connection->connect_error);
}

if (!$connection->select_db($database)) {
	die ("Unable to select database");
}
$trackid = $_GET['tid'];
$albumid = $_GET['albumid'];
$query = "insert into playhistory 
			select a.tid, b.albumid, c.uname, sysdate()
			from track a, album b, user c
			where a.tid = '" . $trackid . "'
			and b.albumid = '" . $albumid . "'
			and c.uname = '" . $loginuser . "'";
$_GET = array();
if ($connection->query($query) or die('Error! ' . $connection->error)) {
	echo '<script>';
	echo 'window.location.href="play.php?tid=' . $trackid .'"';
	echo '</script>';
}
?>
<script>
</script>
</div>
</body>
</html>