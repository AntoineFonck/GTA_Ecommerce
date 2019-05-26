<?php
$servername = "localhost";
$password = "qwertyuiop";
//$password = "Qfadene";
$username = "root";
$dbname = "gun_shop";

$link = mysqli_connect($servername, $username, $password, $dbname);
if (!$link) {
	echo "Error: Unable to connect to MySQL." . PHP_EOL;
	echo "Debugging errno: " . mysqli_connect_errno() . PHP_EOL;
	echo "Debugging error: " . mysqli_connect_error() . PHP_EOL;
	exit;
}
$db_selected = mysqli_select_db($link, 'gun_shop');
if (!$db_selected)
	require ('php/_admin/install.php');
session_start();
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title>Gun Shop</title>
		<link rel="icon" href="https://www.favicon.cc/logo3d/350003.png">
		<link href="./css/index.css" rel="stylesheet">
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">
		<link href='https://fonts.googleapis.com/css?family=Oswald:300' rel='stylesheet' type='text/css'>
	</head>
	<body>
<?php
if (isset($_SESSION['username']))
	echo "<h1>Welcome to the Gun Shop " . $_SESSION['username'] . "</h1>";
else
	echo "<h1>Welcome to the Gun Shop</h1>"
?>
		<a href="index.php" class="btn">Home</a>
		<a href="./php/categories.php" class="btn">Categories</a>
		<a href="./php/basket.php" class="btn">Basket <i class="fas fa-shopping-basket"></i></a>
<?php
	if ($_SESSION['rights'] !== 1 && $_SESSION['rights'] !== 10)
		echo "<a href='./views/sign.html' class='btn'>Sign in</a>";
	else
		echo "<a href='./views/logout.html' class='btn'>Log out</a>";
?>
		<a href="./php/contact.php" class="btn">Contact</a>
<?php
if ($_SESSION['rights'] === 10)
	echo "<a href='./php/admin.php' class='btn'>Admin</a>";
?>
		<div id='homevideo'>
			<img src="http://www.searchmap.eu/blog/wp-content/uploads/2015/05/zyjWZWo.gif" alt="Cargun">
		</div>
		<a href="./php/categories.php" class="productsbtn">Let's see all products !!!</a>
	</body>
</html>
