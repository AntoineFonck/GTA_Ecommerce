<?php
session_start();
if ($_SESSION['rights'] !== 10)
	exit("<script>location.href='../index.php'; alert('You are not an admin ".$_SESSION['rights']."');</script>");
$servername = "localhost";
$password = "qwertyuiop";
$username = "root";
$dbname = "gun_shop";

$link = mysqli_connect($servername, $username, $password, $dbname);
if (!$link) {
	echo "Error: Unable to connect to MySQL." . PHP_EOL;
	echo "Debugging errno: " . mysqli_connect_errno() . PHP_EOL;
	echo "Debugging error: " . mysqli_connect_error() . PHP_EOL;
	exit;
}

$id = $_POST['idcommand'];
$sql = "DELETE * FROM `commands` WHERE id='$id'";
if (mysqli_query($link, $sql))
?>
