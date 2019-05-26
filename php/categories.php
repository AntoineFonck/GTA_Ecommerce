<?php
session_start();
if(!empty($_POST['catlist']))
	$from = $_POST['catlist'];
if(empty($_SESSION['basket']))
	$_SESSION['basket'] = array();
if($_POST['add'])
	$_SESSION['basket'][] = $_POST['add'];

if($_POST['submit'] === "Pim" || $_POST['submit'] === "Bang" || $_POST['submit'] === "Bang_Bang" || $_POST['submit'] === "Boom")
	$from = $_POST['submit'];

$servername = "localhost";
$username = "root";
//$password = "qwertyuiop";
$password = "Qfadene";
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
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">
		<link href='https://fonts.googleapis.com/css?family=Oswald:300' rel='stylesheet' type='text/css'>
	</head>
	<body>
		<h1>Categories</h1>
		<a href="../index.php" class="btn">Home</a>
        <a href="./categories.php" class="btn">Categories</a>
        <a href="./basket.php" class="btn">Basket <i class="fas fa-shopping-basket"></i></a>
		<?php
		if ($_SESSION['rights'] !== 1 && $_SESSION['rights'] !== 10)
        	echo "<a href='../views/sign.html' class='btn'>Sign in</a>";
		else
			echo "<a href='../views/logout.html' class='btn'>Log out</a>";
		?>
		<a href="./contact.php" class="btn">Contact</a>
		<?php
		if ($_SESSION['rights'] === 10)
			echo "<a href='./admin.php' class='btn'>Admin</a>";
		?>
		<form id="catform" action="categories.php" method="POST"></form>
		<select name="catlist" form="catform">
		<?php
		$sql = "SELECT * FROM `categories`;";
		if ($result = mysqli_query($link, $sql))
		{
			$row = mysqli_fetch_all($result, MYSQLI_ASSOC);
			print_r($row);
			foreach ($row as $data)
			{
				if ($data['name'] !== "PIM" && $data['name'] !== "BANG" && $data['name'] !== "BANG_BANG" && $data['name'] !== "BOOM")
				{
					$category = $data['name'];
					echo "<option value='" . $category . "'>". $category ."</option>";
				}
			}
		}
		else
			echo "<p>ERROR RETRIEVING CATEGORIES</p>";
			echo mysqli_error($link);
		?>
		</select>
		<button class="catokbtn mr" type="submit" value="OK" name="submit" form="catform">OK</button>
		<button class="catbtn" type="submit" value="Pim" name="submit" form="catform">Pim</button>
		<button class="catbtn" type="submit" value="Bang" name="submit" form="catform">Bang</button>
		<button class="catbtn" type="submit" value="Bang_Bang" name="submit" form="catform">Bang-Bang</button>
		<button class="catbtn" type="submit" value="Boom" name="submit" form="catform">Boom</button>

		<?php
			echo "<h3>". $from ."</h3>"; 
		?>

		<div id="products">
<?php
			if (!empty($from))
				$query = "SELECT * FROM products WHERE categorie1='$from' or categorie2='$from'";
			else
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
			echo "<button class='catbtn' type='submit' value='" . $data['id'] . "' name='add' form='catform'>ADD</button>";
			echo "</div>";
			echo "</div>";
		}
	}
	?>
		</div>
	</body>
</html>
