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
<title>Album</title>
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
$albumid = $_GET['albumid'];

$connection = new mysqli($server, $dbusername, $dbpassword);

if ($connection->connect_error) {
	die("Connection failed: " . $connection->connect_error);
}

if (!$connection->select_db($database)) {
	die ("Unable to select database");
}

// Retrieve user profile
$profile_query = " select * from user where uname = '" . $loginuser . "'";
$profile_result = $connection->query($profile_query) or die('Error! ' . $connection->error);

if (!$profile_result) {
	echo "Query not sucessful.";
} else {
	$row = $profile_result->fetch_assoc();
	//Top menu
	echo '<p align="right"><a href="logout.php">Logout</a></p>';
	echo '<h1 class="font-effect-brick-sign">How you doing today, ' . $loginuser . '?</h1>';
	
	echo '<div class="w3-bar w3-blue-gray w3-border w3-large">';
	echo '<button class="w3-bar-item w3-button w3-left" onclick="w3_open()">&#9776;</button>';
	echo '<a href="index.php" class="w3-bar-item w3-button w3-mobile w3-hover-teal"><i class="fa fa-home"></i></a>';
	echo '<a href="myartist.php" class="w3-bar-item w3-button w3-mobile w3-hover-teal w3-text-dark-grey w3-hover-text-white">Favourite Artist</a>';
	echo '<a href="myplaylist.php" class="w3-bar-item w3-button w3-mobile w3-hover-teal w3-text-dark-grey w3-hover-text-white">My Playlist</a>';
	echo '<a href="myfollow.php" class="w3-bar-item w3-button w3-mobile w3-hover-teal w3-text-dark-grey w3-hover-text-white">My Follows</a>';
	echo '<form name="search" method="POST" action="search.php" onSubmit="return validateSearch()">';
	echo '<button class="w3-bar-item w3-button w3-green w3-mobile w3-right">Go</button>';
	echo '<input name="content" type="text" class="w3-bar-item w3-input w3-white w3-mobile w3-right" placeholder="Search..">';
	echo '</form>';
	echo '</div>';
	
	echo '<div class="w3-sidebar w3-pale-yellow w3-bar-block w3-card w3-animate-left" style="height: 75%; width:25%; display:none; z-index:3" id="profile">';
	echo '<button class="w3-bar-item w3-button w3-large" onclick="w3_close()">Close Profile &times;</button>';
	echo '<table class="w3-table w3-bordered">';
	echo '<tr>';
	echo '<td>Username:</td>';
	echo '<td>' . $loginuser . '</td>';
	echo '</tr>';
	echo '<tr>';
	echo '<td>Full Name:</td>';
	echo '<td>' . $row['rname'] . '</td>';
	echo '</tr>';
	echo '<tr>';
	echo '<td>Email:</td>';
	echo '<td>' . $row['email'] . '</td>';
	echo '</tr>';
	echo '<tr>';
	echo '<td>City:</td>';
	echo '<td>' . $row['city'] . '</td>';
	echo '</tr>';
	echo '<tr>';
	echo '<td>Phone No.:</td>';
	echo '<td>' . $row['phone'] . '</td>';
	echo '</tr>';
	echo '<tr>';
	echo '<td>Registered Date:</td>';
	echo '<td>' . $row['signupdate'] . '</td>';
	echo '</tr>';
	echo '</table>';
	echo '</div>';
}
$profile_result->close();
$connection->next_result();

echo '<div class="w3-overlay w3-animate-opacity" onclick="w3_close()" style="cursor:pointer" id="mainpage"></div>';
echo '<div class="w3-container w3-right" style="width:90%">';

// Retrieve info. and artist of the album
$album_query = "select a.*, c.*
				from album a, perform b, artist c
				where a.albumid = b.albumid
				and b.aid = c.aid
				and a.albumid = '" . $albumid . "'";
$album_result = $connection->query($album_query) or die('Error! ' . $connection->error);

// Retrieve tracklist of the album
$tracklist_query = "select c.* from album a, tracklist b, track c 
						where a.albumid = b.albumid
						and b.tid = c.tid
						and a.albumid = '" . $albumid . "'";
$tracklist_result = $connection->query($tracklist_query) or die('Error! ' . $connection->error);

//Display all tracks and album info.
if (!$album_result || !$tracklist_result) {
	echo "Query not sucessful.";
} else {
	$row = $album_result->fetch_assoc();
	$artist = $row['aname'];
	$album = $row['albumtitle'];
	echo '<h3>' . $album . '</h3>';
	echo '<table style="color:white">';
	echo '<tr>';
	echo '<td>Artist:</td>';
	echo '<td><a href="artist.php?aid=' . $row['aid'] . '">' . $artist . '</td>';
	echo '</tr>';
	echo '<tr>';
	echo '<td>Issued date:</td>';
	echo '<td>' .$row['idate'] . '</td>';
	echo '</tr>';
	echo '</table>';
	
	echo '<table class="w3-table-all w3-hoverable w3-large">';
	echo '<tr class="w3-amber">';
	echo '<th class="w3-center">Track Name</th>';
	echo '<th class="w3-center">Duration</th>';
	echo '<th class="w3-center">Artist</th>';
	echo '<th class="w3-center">Album</th>';
	echo '</tr>';
	while ($row = $tracklist_result->fetch_assoc()) {
		echo '<tr>';
		echo '<td><a href="track.php?tid=' . $row['tid'] . '">' . $row['ttitle'] . '</a></td>';
		echo '<td>' . $row['duration'] . '</td>';
		echo '<td><a href="artist.php?aid=' . $row['aid'] . '">' . $artist . '</a></td>';
		echo '<td>' . $album . '</td>';
		echo '<tr>';
	}
	echo '</table>';
}
echo '</div>';
$album_result->close();
$tracklist_result->close();
$connection->next_result();
$connection->close();
?>
<script>
function w3_open() {
    document.getElementById("profile").style.display = "block";
    document.getElementById("mainpage").style.display = "block";
}
function w3_close() {
    document.getElementById("profile").style.display = "none";
    document.getElementById("mainpage").style.display = "none";
}
</script>
<div class="w3-container" style="width:90%">
	<p><a href="#top">Back to top</a></p>
</div>
</div>
</body>
</html>