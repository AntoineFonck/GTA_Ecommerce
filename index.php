<?php
session_start();
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Gun Shop</title>
        <link rel="icon" href="https://www.favicon.cc/logo3d/350003.png">
        <link href="./css/index.css" rel="stylesheet">
        <link href='https://fonts.googleapis.com/css?family=Oswald:300' rel='stylesheet' type='text/css'>
    </head>
	<body>
<?php
if (isset($_SESSION['username']))
	echo "<h1>Welcome to the Gun Shop " . $_SESSION['username'] . "</h1>";
else
	echo "<h1>Welcome to the Gun Shop</h1>"
?>
        <a href="index.php" class="btn">Home</a>
		<a href="./php/categories.php" class="btn">Categories</a>
		<?php
		if ($_SESSION['rights'] !== 1 && $_SESSION['rights'] !== 10)
        	echo "<a href='./views/sign.html' class='btn'>Sign in</a>";
		else
			echo "<a href='./php/logout.php' class='btn'>Log out</a>";
		?>
        <a href="./views/contact.html" class="btn">Contact</a>
    </body>
</html>
