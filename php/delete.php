<?php
session_start();
if ($_SESSION['rights'] === 10)
    echo "<script>location.href='../index.php'; alert('You can\'t delete an admin');</script>";
else
{
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
    $user = $_SESSION['username'];
    $query = "DELETE FROM users WHERE login='$user'";
    if (mysqli_query($link, $query))
    {
        $_SESSION['rights'] = 0;
        $_SESSION['username'] = "";
        echo "<script>location.href='../index.php'; alert('Your account as been deleted');</script>";
    }
    else
        echo "<script>location.href='../index.php'; alert('Your account could not be deleted');</script>";
}
?>
