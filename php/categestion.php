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

if ($_POST['add'] === "add-cate")
{
        $newname = $_POST['name'];
        $sql = "INSERT INTO `categories` (`name`) VALUES ('$newname')";
        if (mysqli_query($link, $sql))
                echo "<script>location.href='./admin.php'; alert('Category added');</script>";
        else
                echo "<script>location.href='./admin.php'; alert('Problem, category not added');</script>";
}
?>
