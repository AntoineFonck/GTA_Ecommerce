<?php
session_start();
if ($_SESSION['rights'] !== 10)
	exit("<script>location.href='../index.php'; alert('You are not an admin ".$_SESSION['rights']."');</script>");
$servername = "localhost";
//$password = "qwertyuiop";
$password = "Qfadene";
$username = "root";
$dbname = "gun_shop";

$link = mysqli_connect($servername, $username, $password, $dbname);
if (!$link) {
	echo "Error: Unable to connect to MySQL." . PHP_EOL;
	echo "Debugging errno: " . mysqli_connect_errno() . PHP_EOL;
	echo "Debugging error: " . mysqli_connect_error() . PHP_EOL;
	exit;
}

if (!empty($_POST['cate_change']) && !empty($_POST['name']))
{
	$id = $_POST['cate_change'];
	$name = $_POST['name'];
	$sql = "UPDATE `categories` SET `name`='$name' WHERE id='$id'";
	if (mysqli_query($link, $sql))
		echo "<script>location.href='./admin.php'; alert('Category updated');</script>";
	else
		echo "<script>location.href='./admin.php'; alert('Problem, category not updated');</script>";
}

if (!empty($_POST['cate_delete']))
{
	$id = $_POST['cate_delete'];
	$sql = "DELETE FROM `categories` WHERE id='$id'";
	if (mysqli_query($link, $sql))
		echo "<script>location.href='./admin.php'; alert('Category deleted');</script>";
	else
		echo "<script>location.href='./admin.php'; alert('Problem, category not deleted');</script>";
}
?>
