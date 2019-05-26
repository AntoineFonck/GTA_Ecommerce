<?php
$servername = "localhost";
$username = "root";
$password = "qwertyuiop";
//$password = "Qfadene";
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

$sql = "CREATE TABLE `categories` (
	`id` int(11) NOT NULL,
	`name` char(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;";
if (mysqli_query($link, $sql))
	echo "Table categories successfully created<br>";
else
	echo "<br>Error creating categories table " . mysqli_error($link) . "<br>";
mysqli_free_result($sql);

$sql = "INSERT INTO `categories` (`id`, `name`) VALUES
	(1, 'PIM'),
(2, 'BANG'),
(3, 'BANG_BANG'),
(4, 'BOOM'),
(5, 'Melee'),
(6, 'Handguns'),
(7, 'Shotguns'),
(8, 'Assault_Rifles'),
(9, 'Sniper_Rifles'),
(10, 'Heavy_Weapons'),
(11, 'Thrown_Weapons');";
if (mysqli_query($link, $sql))
	echo "<br>data in categories successfully inserted<br>";
else
	echo "<br>error while insertin in categories= " . mysqli_error($link) . "<br>";
mysqli_free_result($sql);

$sql = "CREATE TABLE `commands` (
	`id` int(11) NOT NULL,
	`login` char(255) NOT NULL,
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
	`categorie1` char(255) NOT NULL,
	`categorie2` char(255) NOT NULL,
	`pictures` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;";
if (mysqli_query($link, $sql))
	echo "Table products successfully created";
else
	echo "Error creating products table" . mysqli_error($link);
mysqli_free_result($sql);

$sql = "INSERT INTO `products` (`id`, `name`, `price`, `description`, `categorie1`, `categorie2`, `pictures`) VALUES
	(1, 'Baseball Bat', 50, 'Aluminum baseball bat with leather grip. Lightweight yet powerful for all you big hitters out there.', 'Melee', 'PIM', 'https://vignette.wikia.nocookie.net/gtawiki/images/5/59/BaseballBat-GTAV.png/revision/latest/scale-to-width-down/350?cb=20160612221707'),
(2, 'Knuckle Dusters', 25, 'Perfect for knocking out gold teeth, or as a gift to the trophy partner who has everything.', 'Melee', 'PIM', 'https://vignette.wikia.nocookie.net/gtawiki/images/b/b7/BrassKnuckles-GTAV.png/revision/latest/scale-to-width-down/350?cb=20150708153813'),
(3, 'Knife', 35, 'This carbon steel 7\" bladed knife is dual edged with a serrated spine to provide improved stabbing and thrusting capabilities.', 'Melee', 'PIM', 'https://vignette.wikia.nocookie.net/gtawiki/images/a/a7/Knife-GTAV.png/revision/latest/scale-to-width-down/350?cb=20130920185917'),
(4, 'Up-n-Atomizer', 399, 'The Up-n-Atomizer is an interesting weapon; it fires a yellow glowing coil beam that explodes after a short time, or upon impact with a surface or object. The weapon features no traditional ammunition, rather it recharges its shot after two seconds, similarly to the Stun Gun.', 'Handguns', 'BANG', 'https://www.gtabase.com/images/gta-5/weapons/handguns/up-n-atomizer.png'),
(5, 'Pistol', 100, 'Standard handgun. A .45 caliber combat pistol with a magazine capacity of 12 rounds that can be extended to 16.', 'Handguns', 'BANG', 'https://imgvol.cdn.lcpdfr.com/screenshots/monthly_2016_07/Pistol-GTAV.thumb.png.1bea55acf3b8f08cf5515939b60f1de7.png'),
(6, 'Heavy Revolver', 250, 'A handgun with enough stopping power to drop a crazed rhino, and heavy enough to beat it to death if you\'re out of ammo.', 'Handguns', 'BANG', 'https://www.gtabase.com/images/gta-5/weapons/handguns/heavy-revolver.png'),
(7, 'Pump Shotgun Mk II', 950, 'Only one thing pumps more than action than a pump action: watch out, the recoil is almost as deadly as the shot.', 'Shotguns', 'BANG', 'https://www.gtabase.com/images/gta-5/weapons/shotguns/pump-shotgun.png'),
(8, 'Compact Rifle', 1540, 'Half the size, all the power, double the recoil: there\'s no riskier way to say \"I\'m compensating for something\".', 'Assault_Rifles', 'BANG_BANG', 'https://www.gtabase.com/images/gta-5/weapons/assault-rifles/compact-rifle.png'),
(9, 'Assault Rifle', 2000, 'This standard assault rifle boasts a large capacity magazine and long distance accuracy.', 'Assault_Rifles', 'BANG_BANG', 'https://ui-ex.com/images/transparent-gun-gta-5-4.png'),
(10, 'Marksman Rifle', 3200, 'Whether you\'re up close or a disconcertingly long way away, this weapon will get the job done. A multi-range tool for tools.', 'Sniper_Rifles', 'BANG', 'https://www.gtabase.com/images/gta-5/weapons/sniper-rifles/marksman-rifle.png'),
(11, 'Heavy Sniper', 4000, 'Features armor-piercing rounds for heavy damage. Comes with laser scope as standard.', 'Sniper_Rifles', 'BANG', 'https://img.gta5-mods.com/q75/images/heavy-sniper-new-sound-barrett-50-caliber/003c43-GTAV-heavy-sniper.png'),
(12, 'Rocket Launcher', 9500, 'A portable, shoulder-launched, anti-tank weapon that fires explosive warheads. Very effective for taking down vehicles or large groups of assailants.', 'Heavy_Weapons', 'BOOM', 'https://www.gtabase.com/images/gta-5/weapons/heavy/rpg.png'),
(13, 'Grenade_Launcher', 7000, 'A compact, lightweight grenade launcher with semi-automatic functionality. Holds up to 10 rounds.', 'Heavy_Weapons', 'BOOM', 'https://www.gtabase.com/images/gta-5/weapons/heavy/grenade-launcher.png'),
(14, 'Grenade', 150, 'Standard fragmentation grenade. Pull pin, throw, then find cover. Ideal for eliminating clustered assailants.', 'Thrown_Weapons', 'BOOM', 'https://vignette.wikia.nocookie.net/gtawiki/images/5/52/Grenade-GTAV.png/revision/latest/scale-to-width-down/350?cb=20161222140933'),
(15, 'Molotov Cocktails', 50, 'Crude yet highly effective incendiary weapon. No happy hour with this cocktail.', 'Thrown_Weapons', 'BOOM', 'https://vignette.wikia.nocookie.net/gtawiki/images/6/6b/MolotovCocktail-GTAV.png/revision/latest/scale-to-width-down/350?cb=20140204073634');";
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

$sql = "ALTER TABLE `categories`
	ADD PRIMARY KEY (`id`);";
$sql .= "ALTER TABLE `commands`
	ADD PRIMARY KEY (`id`);";
$sql .= "ALTER TABLE `products`
	ADD PRIMARY KEY (`id`);";
$sql .= "ALTER TABLE `users`
	ADD PRIMARY KEY (`id`);";
$sql .= "ALTER TABLE `categories`
	MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;";
$sql .= "ALTER TABLE `commands`
	MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;";
$sql .= "ALTER TABLE `products`
	MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;";
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
