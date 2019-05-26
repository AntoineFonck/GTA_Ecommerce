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
		<form id="buy" action="categorie.php" method="POST"></form>
        <?php
        foreach($_SESSION['basket'] as $data)
        {
            $query = "SELECT * FROM products WHERE id = $data";
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
                echo "<p class='pricetext'>" . $row['price'] . "$</p>";
                echo "</div>";
                echo "</div>";
            }
        }
        echo "<p class='totalprice'>" . $tot . "$</p>";
        ?>
        <button class="catokbtn mr" type="submit" value="OK" name="submit" form="buy">Validate Basket</button>
		</div>
	</body>
</html>
