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
$trackid = $_GET['tid'];
echo '<div class="w3-container w3-right" style="width:90%">';
echo '<iframe id="playtrack" src="https://open.spotify.com/embed?uri=spotify:track:' . $trackid . '"
        frameborder="0" allowtransparency="true"></iframe>';
echo '</div>';	
echo '<div class="w3-container w3-right" style="width:90%">';
echo '<input type = "button" name="close" value = "CLOSE" onClick="self.close()">';
echo '</div>';
?>
<script>
</script>
</div>
</body>
</html>