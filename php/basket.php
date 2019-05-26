<?php
session_start();

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
if (!empty($_SESSION['basket']) && $_POST['submit'] === "OK" && !empty($_SESSION['username']))
{
	sort($_SESSION['basket']);
	$quantities = [];
	foreach($_SESSION['basket'] as $data)
		$quantities[$data] += 1;
	$strdata = implode(';', array_map(function ($v, $k) { return sprintf("%s='%s'", $k, $v); }, $quantities, array_keys($quantities)));
	$strdata = str_replace("'", "", $strdata);
	$current_user = $_SESSION['username'];
	$sql = "INSERT INTO `commands` (`login`, `products`) VALUES ('$current_user', '$strdata');";
	if (mysqli_query($link, $sql))
		echo "<script>location.href='../index.php'; alert('Your command was validated');</script>";
	else
		echo "<script>location.href='../index.php'; alert('There was an issue, your command was not validated');</script>";
}
else if (!empty($_SESSION['basket']) && $_POST['submit'] === "OK" && empty($_SESSION['username']))
	echo "<script>location.href='../views/sign.html'; alert('Please log in to validate your command');</script>";
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title>Gun Shop</title>
		<link rel="icon" href="https://www.favicon.cc/logo3d/350003.png">
        <link href="../css/index.css" rel="stylesheet">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">
		<link href='https://fonts.googleapis.com/css?family=Oswald:300' rel='stylesheet' type='text/css'>
	</head>
	<body>
		<h1>Basket <i class="fas fa-shopping-basket"></i></h1>
		<form id="validate" action="basket.php" method="POST"></form>
        <?php
		sort($_SESSION['basket']);
		$quantities = [];
		foreach($_SESSION['basket'] as $data)
			$quantities[$data] += 1;
        foreach($quantities as $key => $quant)
		{
            $query = "SELECT * FROM products WHERE id = $key";
            if ($result = mysqli_query($link, $query))
            {
                $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
                $tot += $row['price'];
                echo "<div class='prod'>";
                echo "<div class='left'>";
                echo "<p class='prodtitle'>" . $row['name'] . "</p>";
                echo "<img src='" . $row['pictures'] . "' alt='" . $row['name'] . "'>";
                echo "</div>";
                echo "<div class='price'>";
                echo "<p class='pricetext'>" . $row['price'] . "$. QUANT=x" . $quant ."</p>";
                echo "</div>";
                echo "</div>";
			}
		}
        echo "<p class='totalprice'>" . $tot . "$</p>";
        ?>
		<?php
		if (!empty($_SESSION['basket']))
        	echo "<button class='catokbtn mr' type='submit' onsubmit='return confirm("."'Do you want to make these changes ?'".");' value='OK' name='submit' form='validate'>Validate Basket</button>";
		?>
		</div>
	</body>
</html>
