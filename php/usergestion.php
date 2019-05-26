<?php
session_start();
if ($_SESSION['rights'] !== 10)
            echo "<script>location.href='../index.php'; alert('Stay at your place');</script>";

if (isset($_POST['login']) && isset($_POST['passwd']) && isset($_POST['email']) && isset($_POST['admin']) && isset($_POST['add']))
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

	$login = mysqli_real_escape_string($link, $_POST['login']);
	$hashpw = hash("whirlpool", mysqli_real_escape_string($link, $_POST['passwd']));
    $email = mysqli_real_escape_string($link, $_POST['email']);
    $admin = mysqli_real_escape_string($link, $_POST['admin']);
	$query = "SELECT login, email FROM users WHERE login='$login' or email='$email'";
	$result = mysqli_query($link, $query);
	if (mysqli_num_rows($result) > 0)
			echo "<script>location.href='./admin.php'; alert('Login or email already taken');</script>";
	else
		{
			$insertquery = "INSERT INTO `users` (`login`, `password`, `email`, `admin`) VALUES ('$login', '$hashpw', '$email', '$admin')";
			if (mysqli_query($link, $insertquery))
				echo "<script>location.href='../views/sign.html'; alert('Your account has been created, please log in');</script>";
			else
				echo "<script>location.href='../views/create.html'; alert('Your account couldn\'t be created');</script>";
		}
}
?>
