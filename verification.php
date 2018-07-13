<!DOCTYPE html>
<?php
session_start();

$server = 'db-project.cltaymjackyq.us-east-2.rds.amazonaws.com';
$dbusername = 'jerryjiang';
$dbpassword = 'jerryjiang';
$database = 'db_project';
$connection = new mysqli($server, $dbusername, $dbpassword);

if ($connection->connect_error) {
	die("Connection failed: " . $connection->connect_error);
}

if (!$connection->select_db($database)) {
	die ("Unable to select database");
}


$loginuser = $_POST['loginuser'];
$loginpassword = $_POST['loginpassword'];

$_SESSION["server"] = $server;
$_SESSION["dbusername"] = $dbusername;
$_SESSION["dbpassword"] = $dbpassword;
$_SESSION["database"] = $database;

$_SESSION['loginuser'] = $loginuser;
$_SESSION['loginpassword'] = $loginpassword;

$query = "select * from user where uname = '" . $loginuser . "' and pwd = '" . $loginpassword . "'";
$result = $connection->query($query) or die('Error! ' . $connection->error);

if (!$result || $result->num_rows == 0) {
	echo '<script>';
	echo 'alert("Wrong username or password!");';
	echo 'window.location.href="login.php"';
	echo '</script>';

} else {
	$row = $result->fetch_assoc();
	$_SESSION['email'] = $row['email'];
	$_SESSION['phone'] = $row['phone'];
	$_SESSION['city'] = $row['city'];
	echo '<script>';
	echo 'window.location.href="index.php"';
	echo '</script>';
}
$result->close();
$connection->close();
?>
