<?php
session_start();
if ($_SESSION['rights'] === 10 || $_SESSION['rights'] === 1)
	        echo "<script>location.href='../index.php'; alert('You are already logged in');</script>";
if (isset($_POST['login']) && isset($_POST['passwd']) && isset($_POST['repasswd']) && isset($_POST['email']) && $_POST['submit'] === "OK")
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
	$hashrepw = hash("whirlpool", mysqli_real_escape_string($link, $_POST['repasswd']));
	$email = mysqli_real_escape_string($link, $_POST['email']);
	$query = "SELECT login, email FROM users WHERE login='$login' or email='$email'";
	if ($hashpw === $hashrepw)
	{
		$result = mysqli_query($link, $query);
		if (mysqli_num_rows($result) > 0)
			echo "<script>location.href='../views/create.html'; alert('Login or email already taken');</script>";
		else
		{
			$insertquery = "INSERT INTO `users` (`login`, `password`, `email`, `admin`) VALUES ('$login', '$hashpw', '$email', 0)";
			if (mysqli_query($link, $insertquery))
				echo "<script>location.href='../views/sign.html'; alert('Your account has been created, please log in');</script>";
			else
				echo "<script>location.href='../views/create.html'; alert('Your account couldn\'t be created');</script>";
		}
	}
	else
	{
		echo "<script>location.href='../views/create.html'; alert('Passwords entries don\'t match');</script>";
	}
}
?>
