<?php
session_start();
if ($_SESSION['rights'] !== 10)
            echo "<script>location.href='../index.php'; alert('Stay at your place');</script>";

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
if (isset($_POST['name']) && isset($_POST['pictures']) && isset($_POST['categorie1']) && isset($_POST['categorie2']) && isset($_POST['description']) && isset($_POST['price']) && isset($_POST['prod_change']))
{

    $where = $_POST['prod_change'];
	$name = mysqli_real_escape_string($link, $_POST['name']);
    $pictures = mysqli_real_escape_string($link, $_POST['pictures']);
    $categorie1 = mysqli_real_escape_string($link, $_POST['categorie1']);
    $categorie2 = mysqli_real_escape_string($link, $_POST['categorie2']);
    $description = mysqli_real_escape_string($link, $_POST['description']);
    $price = intval($_POST['price']);
    $insertquery = "INSERT INTO `products` (`name`, `price`, `description`, `categorie1`, `categorie2`, `pictures`) VALUES ('$name', $price, '$description', '$categorie1', '$categorie2', '$pictures')";
	$insertquery = "UPDATE `products` SET `name` = '$name', `price` = '$price', `description` = '$description', `categorie1` = '$categorie1' , `categorie2` = '$categorie2', `pictures` = '$pictures' WHERE id = '$where'";
    if (mysqli_query($link, $insertquery))
        echo "<script>location.href='./admin.php'; alert('Product updated');</script>";
    else
        echo "<script>location.href='./admin.php'; alert('Your product couldn\'t be update');</script>";
}
if (isset($_POST['prod_delete']))
{
    $where = $_POST['prod_delete'];

	$insertquery = "DELETE FROM `products` WHERE id = '$where'";
    if (mysqli_query($link, $insertquery))
        echo "<script>location.href='./admin.php'; alert('Product deleted');</script>";
    else
        echo "<script>location.href='./admin.php'; alert('Your product couldn\'t be deleted');</script>";
}
?>
