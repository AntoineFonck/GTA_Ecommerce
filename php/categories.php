<?php
session_start();
if(empty($_SESSION['basket']))
	$_SESSION['basket'] = array();
if($_POST['add'])
	$_SESSION['basket'][] = $_POST['add'];
print_r($_SESSION['basket']);
$servername = "localhost";
$username = "root";
$password = "qwertyuiop";
//$password = "Qfadene";
$dbname = "gun_shop";

$link = mysqli_connect($servername, $username, $password, $dbname);
if (!$link) {
	echo "Error: Unable to connect to MySQL." . PHP_EOL;
	echo "Debugging errno: " . mysqli_connect_errno() . PHP_EOL;
	echo "Debugging error: " . mysqli_connect_error() . PHP_EOL;
	exit;
}
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title>Gun Shop</title>
		<link rel="icon" href="https://www.favicon.cc/logo3d/350003.png">
		<link href="../css/index.css" rel="stylesheet">
		<link href='https://fonts.googleapis.com/css?family=Oswald:300' rel='stylesheet' type='text/css'>
	</head>
	<body>
		<h1>Categories</h1>
		<form id="catform" action="categories.php" method="POST"></form>
		<select name="carlist" form="carform">
			<option value="volvo">Volvo</option>
			<option value="saab">Saab</option>
			<option value="opel">Opel</option>
			<option value="audi">Audi</option>
		</select>
		<button class="catokbtn mr" type="submit" value="OK" name="submit" form="catform">OK</button>
		<button class="catbtn" type="submit" value="Pim" name="submit" form="catform">Pim</button>
		<button class="catbtn" type="submit" value="Bang" name="submit" form="catform">Bang</button>
		<button class="catbtn" type="submit" value="Bang-Bang" name="submit" form="catform">Bang-Bang</button>
		<button class="catbtn" type="submit" value="Boom" name="submit" form="catform">Boom</button>
		<div id="products">
		<form id="additem" action="categories.php" method="POST"></form>
	<?php
	$query = "SELECT * FROM products";
	if ($result = mysqli_query($link, $query))
	{
		$row = mysqli_fetch_all($result, MYSQLI_ASSOC);
		foreach ($row as $data)
		{
			echo "<div class='prod'>";
			echo "<div class='left'>";
			echo "<p class='prodtitle'>" . $data['name'] . "</p>";
			echo "<img src='" . $data['pictures'] . "' alt='" . $data['name'] . "'>";
			echo "</div>";
			echo "<div class='mid'>";
			echo "<p class='catetitle'>" . $data['categorie1'] . " / " . $data['categorie2'] . "</p>";
			echo "<p class='catedesc'>" . $data['description'] . "</p>";
			echo "</div>";
			echo "<div class='price'>";
			echo "<p class='pricetext'>" . $data['price'] . "$</p>";
			echo "</div>";
			echo "<div class='add'>";
			echo "<button class='catbtn' type='submit' value='" . $data['id'] . "' name='add' form='additem'>ADD</button>";
			echo "</div>";
			echo "</div>";
		}
	}
	?>
		</div>
		<a href="index.php" class="homecat">Home</a>
	</body>
</html>
