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
if (isset($_POST['login']) && isset($_POST['passwd']) && isset($_POST['email']) && isset($_POST['admin']) && isset($_POST['user_change']))
{

    $where = $_POST['user_change'];
	$login = mysqli_real_escape_string($link, $_POST['login']);
	$hashpw = hash("whirlpool", mysqli_real_escape_string($link, $_POST['passwd']));
    $email = mysqli_real_escape_string($link, $_POST['email']);
    $admin = mysqli_real_escape_string($link, $_POST['admin']);
	$insertquery = "UPDATE `users` SET `login` = '$login', `password` = '$hashpw', `email` = '$email', `admin` = '$admin' WHERE id = '$where'";
    if (mysqli_query($link, $insertquery))
        echo "<script>location.href='./admin.php'; alert('Account updated');</script>";
    else
        echo "<script>location.href='./admin.php'; alert('Your account couldn\'t be update');</script>";
}
if (isset($_POST['user_delete']))
{
    $where = $_POST['user_delete'];

	$insertquery = "DELETE FROM `users` WHERE id = '$where'";
    if (mysqli_query($link, $insertquery))
        echo "<script>location.href='./admin.php'; alert('Account deleted');</script>";
    else
        echo "<script>location.href='./admin.php'; alert('Your account couldn\'t be deleted');</script>";
}
?>
