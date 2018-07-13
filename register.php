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
$loginpassword = $_POST['password'];
$firstname = $_POST['firstname'];
$lastname = $_POST['lastname'];
$email = $_POST['email'];
$city = $_POST['city'];
$phone = $_POST['Phonenumber'];

$query = "insert into user values ('" . $loginuser ."',concat('" . $firstname . "', ' ', '" . $lastname . "'),'" 
									. $email ."','" . $city ."','" . $loginpassword ."','" . $phone ."',sysdate())";
$result = $connection->query($query);
echo $result;
if ($result === TRUE) {
	echo '<script>';
	echo 'alert("Successfully Registered.");';
	echo 'window.location.href="logout.php"';
	echo '</script>';
} else {
	echo '<script>';
	echo 'alert("Failed to registered.");';
	echo 'window.location.href="signup.php"';
	echo '</script>';
}
$result->close();
$connection->close();
?>
