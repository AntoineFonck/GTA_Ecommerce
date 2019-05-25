<?php
session_start();
if (isset($_POST['login']) && isset($_POST['passwd']) && $_POST['submit'] === "OK")
{
	$servername = "localhost";
	$username = "root";
	$password = "qwertyuiop";
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
	$query = "SELECT password, admin FROM users WHERE login='$login'";
	if ($result = mysqli_query($link, $query))
	{
		$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
		$admin = $row['admin'];
		if ($hashpw === $row['password'])
		{
			if ($admin == 0)
			{
				$_SESSION['rights'] = 1;
				$_SESSION['username'] = $login;
				echo "<script>location.href='../index.php'; alert('Welcome, $login');</script>";
			}
			if ($admin == 1)
			{
				$_SESSION['rights'] = 10;
				$_SESSION['username'] = $login;
				echo "<script>location.href='admin.php'; alert('Welcome, $login, here is your admin page');</script>";
			}
		}
		else
			echo "<script>location.href='../views/sign.html'; alert('Wrong username or password');</script>";
	}
	else
		echo "<script>location.href='../views/sign.html'; alert('Wrong username or password');</script>";
}
?>
