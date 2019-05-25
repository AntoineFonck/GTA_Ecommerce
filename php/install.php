<?php
$servername = "localhost";
$username = "root";
$password = "qwertyuiop";
$dbname = "gun_shop";

$link = mysqli_connect($servername, $username, $password);
if (!$link) {
	echo "Error: Unable to connect to MySQL." . PHP_EOL;
	echo "Debugging errno: " . mysqli_connect_errno() . PHP_EOL;
	echo "Debugging error: " . mysqli_connect_error() . PHP_EOL;
	exit;
}

echo "Success: A proper connection to MySQL was made! The $dbname is great." . PHP_EOL;
echo "Host information: " . mysqli_get_host_info($link) . PHP_EOL;
echo "<br>";
/*
if (mysqli_query($link, "DROP DATABASE IF EXISTS`gun_shop`"))
	echo "Deleted previous gun_shop db if it existed<br>";
else
	echo "Didn't delete $dbname<br>";
*/
$sql = "CREATE DATABASE gun_shop";
if (mysqli_query($link, $sql))
	echo "Database gun_shop created successfully";
else
{
	echo "Error creating database: " . mysqli_error($link);
	exit();
}
mysqli_free_result($sql);

mysqli_select_db($link, $dbname);

$sql = "CREATE TABLE `commands` (
	`id` int(11) NOT NULL,
	`login` int(11) NOT NULL,
	`products` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;";
if (mysqli_query($link, $sql))
	echo "Table commands successfully created<br>";
else
	echo "<br>Error creating commands table " . mysqli_error($link) . "<br>";
mysqli_free_result($sql);

$sql = "CREATE TABLE `products` (
	`id` int(11) NOT NULL,
	`name` char(255) NOT NULL,
	`price` int(11) NOT NULL,
	`description` varchar(1000) NOT NULL,
	`categorie` char(255) NOT NULL,
	`pictures` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;";
if (mysqli_query($link, $sql))
	echo "Table products successfully created";
else
	echo "Error creating products table" . mysqli_error($link);
mysqli_free_result($sql);

$sql = "INSERT INTO `products` (`id`, `name`, `price`, `description`, `categorie`, `pictures`) VALUES
	(1, 'Baseball Bat', 50, 'The Baseball Bat is one of the first melee weapons featured in the games. It is, by far, the easiest weapon to obtain, with one always at the safehouse in t
	he games taking place in Grand Theft Auto III and Grand Theft Auto: Liberty City Stories and a common sight throughout the other games. The baseball bat is also commonly seen in the
	hands of gangsters, mobsters, and sometimes civilians throughout the games.', 'Melee', ''),
	(2, 'Knuckle Dusters', 25, 'The Knuckle Dusters (formerly known as Brass Knuckles) is a type of melee weapon featured in every 3D Universe game since Grand Theft Auto: Vice City, and are featured in Grand Theft Auto V and Grand Theft Auto Online, as part of the Ill-Gotten Gains Part 2 Update.', 'Melee', ''),
	(3, 'Knife', 35, 'The Knife is a melee weapon featured in Grand Theft Auto: Vice City, Grand Theft Auto: San Andreas, Grand Theft Auto: Liberty City Stories, Grand Theft Auto: Vice City Stories, Grand Theft Auto IV, Grand Theft Auto V and Grand Theft Auto Online. It is manufactured by Hawk & Little in GTA V.', 'Melee', '');";
if (mysqli_query($link, $sql))
	echo "Data successfully inserted in products table";
else
	echo "Error inserting data in products". mysqli_error($link);
mysqli_free_result($sql);

$sql = "CREATE TABLE `users` (
	`id` int(11) NOT NULL,
	`login` char(255) NOT NULL,
	`password` varchar(1000) NOT NULL,
	`email` char(255) NOT NULL,
	`admin` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;";
if (mysqli_query($link, $sql))
	echo "Table users successfully created";
else
	echo "Error creating users table". mysqli_error($link);
mysqli_free_result($sql);

$passwd = hash("whirlpool", "admin");
$passwd2 = hash("whirlpool", "user");
$sql = "INSERT INTO `users` (`id`, `login`, `password`, `email`, `admin`) VALUES (1, \"admin\", \"$passwd\", \"qfadene@student.42.fr\", 1), (2, 'user', '$passwd2', 'user@email.com', 0);";
if (mysqli_query($link, $sql))
	echo "admin user successfully inserted";
else
	echo "Error inserting admin user". mysqli_error($link);
mysqli_free_result($sql);

$sql = "ALTER TABLE `commands`
	  ADD PRIMARY KEY (`id`);";
$sql .= "ALTER TABLE `products`
	  ADD PRIMARY KEY (`id`);";
$sql .= "ALTER TABLE `users`
	  ADD PRIMARY KEY (`id`);";
$sql .= "ALTER TABLE `commands`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;";
$sql .= "ALTER TABLE `products`
	  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;";
$sql .= "ALTER TABLE `users`
	  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;";
if (mysqli_multi_query($link, $sql)) {
	echo "request " . $sql . "= Alter Tables done successfully";
} else {
	echo "Error: " . $sql . "<br>" . mysqli_error($link);
}
mysqli_free_result($sql);

mysqli_close($link);
?>
