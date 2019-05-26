<?php
session_start();
if ($_SESSION['rights'] !== 10)
            echo "<script>location.href='../index.php'; alert('Stay at your place');</script>";

if (isset($_POST['name']) && isset($_POST['pictures']) && isset($_POST['categorie1']) && isset($_POST['categorie2']) && isset($_POST['description']) && isset($_POST['price']) && isset($_POST['add']))
{
    if (!is_numeric ($_POST['price']))
        echo "<script>location.href='./admin.php'; alert('price need to be an INT');</script>";
    
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

    $name = mysqli_real_escape_string($link, $_POST['name']);
    $pictures = mysqli_real_escape_string($link, $_POST['pictures']);
    $categorie1 = mysqli_real_escape_string($link, $_POST['categorie1']);
    $categorie2 = mysqli_real_escape_string($link, $_POST['categorie2']);
    $description = mysqli_real_escape_string($link, $_POST['description']);
    $price = intval($_POST['price']);
	$query = "SELECT name FROM `products` WHERE name='$name'";
	$result = mysqli_query($link, $query);
	if (mysqli_num_rows($result) > 0)
			echo "<script>location.href='./admin.php'; alert('This product name is already taken');</script>";
	else
		{
			$insertquery = "INSERT INTO `products` (`name`, `price`, `description`, `categorie1`, `categorie2`, `pictures`) VALUES ('$name', $price, '$description', '$categorie1', '$categorie2', '$pictures')";
			if (mysqli_query($link, $insertquery))
				echo "<script>location.href='./admin.php'; alert('Product created');</script>";
            else
				echo "<script>location.href='./admin.php'; alert('Your product couldn\'t be created');</script>";
		}
}
?>