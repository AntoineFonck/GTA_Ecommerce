<?php
session_start();
if ($_SESSION['rights'] !== 10)
    exit("<script>location.href='../index.php'; alert('You are not an admin ".$_SESSION['rights']."');</script>");
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
if ($_POST['submit'] === "products" || $_POST['submit'] === "categories" || $_POST['submit'] === "users" || $_POST['submit'] === "orders")
    $from = $_POST['submit'];
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
        <h1>Admin section</h1>
        
		<form id="adminform" action="admin.php" method="POST"></form>
		<button class="catbtn" type="submit" value="products" name="submit" form="adminform">Products</button>
		<button class="catbtn" type="submit" value="categories" name="submit" form="adminform">Categories</button>
		<button class="catbtn" type="submit" value="users" name="submit" form="adminform">Users</button>
		<button class="catbtn" type="submit" value="orders" name="submit" form="adminform">Orders</button>
		<div id="products">
		<form id="additem" action="categories.php" method="POST"></form>
	<?php
	$query = "SELECT * FROM $from";
	if ($result = mysqli_query($link, $query))
	{
        $row = mysqli_fetch_all($result, MYSQLI_ASSOC);
        if ($from === "products")
        {
            foreach ($row as $data)
            {
                echo "<div class='prod'>";
                echo "<div class='left'>";
                echo "<p class='prodtitle'>" . $data['name'] . "</p>";
                echo "<img src='" . $data['pictures'] . "' alt='" . $data['name'] . "'>";
                echo "</div>";
                echo "<div class='mid'>";
                echo "<p class='catetitle'> Price/U: ". $data['pictures'] ."</p>";
                echo "<p class='catedesc'> Quantity:" . $data['description'] . "</p>";
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
	}
	?>
		</div>
		<a href="index.php" class="homecat">Home</a>
	</body>
</html>
