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
<title>Artist</title>
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
if (isset($_GET['aid'])) {
	$artist = $_GET['aid'];
} else {
	$artist = $_SESSION['aid'];
}

$connection = new mysqli($server, $dbusername, $dbpassword);

if ($connection->connect_error) {
	die("Connection failed: " . $connection->connect_error);
}

if (!$connection->select_db($database)) {
	die ("Unable to select database");
}

if (isset($_POST['like_button'])) {
	$sql = "insert into likeartist values ('" . $artist . "', '" . $loginuser . "', sysdate())";
	$connection->query($sql) or die('Error! ' . $connection->error);
	$_POST = array();
} else if (isset($_POST['unlike_button'])) {
	$sql = "delete from likeartist where aid ='" . $artist . "'and uname ='" . $loginuser . "'";
	$connection->query($sql) or die('Error! ' . $connection->error);
	$_POST = array();
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

// Retrieve info. of the artist
$artist_query = "select *
				from artist
				where aid = '" . $artist . "'";
$artist_result = $connection->query($artist_query) or die('Error! ' . $connection->error);

// Check likeartist table
$likeartist_query = "select * from likeartist where aid = '" . $artist . "'
						and uname = '" . $loginuser . "'";
$likeartist_result = $connection->query($likeartist_query) or die('Error! ' . $connection->error);

//Display all tracks and album info.
if (!$artist_result || !$likeartist_result) {
	echo "Query not sucessful.";
} else {
	$row = $artist_result->fetch_assoc();
	$aname = $row['aname'];
	echo '<h3>' .$aname. '</h3>';
	echo '<p>' . $row['description'] . '</p>';
	$_SESSION['aid'] = $artist;
	echo '<form name="likeartist" method="POST" action="artist.php" onSubmit="likeArtist()">';
	if ($likeartist_result->num_rows > 0) {
		echo '<input type = "submit" name="unlike_button" value = "UNLIKE">';
	} else {
		echo '<input type = "submit" name="like_button" value = "LIKE">';
	}
	echo '</form>';
	$likeartist_result->close();
	$artist_result->close();
	$connection->next_result();
}
	
echo '<h2>Top 10 Hottest Tracks</h2>';	
echo '<table class="w3-table-all w3-hoverable w3-large">';
echo '<tr class="w3-amber">';
echo '<th class="w3-center">Track Name</th>';
echo '<th class="w3-center">Duration</th>';
echo '<th class="w3-center">Artist</th>';
echo '<th class="w3-center">Album</th>';
echo '</tr>';
	
// Retrieve tracks from the artist in certain order
$tracklist_query = "call get_track_from_artist('" . $artist . "')";
$tracklist_result = $connection->query($tracklist_query) or die('Error! ' . $connection->error);
	
if (!tracklist_result) {
	echo "Query not sucessful.";
} else {
	$i = 0;
	while ($i < 10 && $row = $tracklist_result->fetch_assoc()) {
		echo '<tr>';
		echo '<td><a href="track.php?tid=' . $row['tid'] . '">' . $row['ttitle'] . '</a></td>';
		echo '<td>' . $row['duration'] . '</td>';
		echo '<td>' . $aname . '</td>';
		echo '<td><a href="album.php?albumid=' . $row['albumid'] . '">' . $row['albumtitle'] . '</td>';
		echo '<tr>';
		$i++;
	}
	echo '</table>';
	$tracklist_result->close();
	$connection->next_result();
	
	// Retrieve all the hottest albums of the artist
	$album_query = "select a.*
				from album a, perform b
				where a.albumid = b.albumid
				and b.aid = '" . $artist . "'";
	$album_result = $connection->query($album_query) or die('Error! ' . $connection->error);
	if (!$album_result) {
		echo "Query not sucessful.";
	} else {
		echo '<div class="border">';
		echo '<h2>Her/His Best Albums</h2>';
		echo '</div>';
		echo '<div class="w3-row-padding w3-margin-top">';
		while ($row = $album_result->fetch_assoc()) {
			echo '<div class="w3-quarter">';
			echo '<div class="w3-card">';
			echo '<a href="album.php?albumid=' . $row['albumid'] . '"><img src="img/img1.jpg" 
					alt="Person" class="w3-sepia-min" style="width:100%; height:80%"></a>';
			echo '<div class="w3-container" style="text-align:center">';
			echo '<a style="color:snow" href="album.php?albumid=' . $row['albumid'] . '">' . $row['albumtitle'] . '</a>';
			echo '</div>';
			echo '</div>';
			echo '</div>';
		}
		$album_result->close();
		$connection->next_result();
		echo '</div>';
	}
}
echo '</div>';
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
function likeArtist() {
	alert("DONE");
}
</script>
<div class="w3-container" style="width:90%">
	<p><a href="#top">Back to top</a></p>
</div>
</div>
</body>
</html>