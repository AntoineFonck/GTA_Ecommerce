<?php
session_start();
if ($_SESSION['rights'] !== 10)
    exit("<script>location.href='../index.php'; alert('You are not an admin ".$_SESSION['rights']."');</script>");
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
if ($_POST['submit'] === "products" || $_POST['submit'] === "categories" || $_POST['submit'] === "users" || $_POST['submit'] === "commands")
    $from = $_POST['submit'];
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
        <h1>Admin section</h1>
        <a href="../index.php" class="btn">Home</a>
        <a href="./categories.php" class="btn">Categories</a>
        <a href="./basket.php" class="btn">Basket <i class="fas fa-shopping-basket"></i></a>
		<?php
		if ($_SESSION['rights'] !== 1 && $_SESSION['rights'] !== 10)
        	echo "<a href='../views/sign.html' class='btn'>Sign in</a>";
		else
			echo "<a href='../views/logout.html' class='btn'>Log out</a>";
		?>
		<a href="./contact.php" class="btn">Contact</a>
		<?php
		if ($_SESSION['rights'] === 10)
			echo "<a href='./admin.php' class='btn'>Admin</a>";
		?>
		<form id="adminform" action="admin.php" method="POST"></form>
		<button class="catbtn" type="submit" value="products" name="submit" form="adminform">Products</button>
		<button class="catbtn" type="submit" value="categories" name="submit" form="adminform">Categories</button>
		<button class="catbtn" type="submit" value="users" name="submit" form="adminform">Users</button>
		<button class="catbtn" type="submit" value="commands" name="submit" form="adminform">Commands</button>
		<div id="products">
		<form id="modif" action="categories.php" method="POST"></form>
	<?php
	$query = "SELECT * FROM $from";
	if ($result = mysqli_query($link, $query))
	{
        $row = mysqli_fetch_all($result, MYSQLI_ASSOC);
        if ($from === "products")
        {
			echo "<h3>New article</h3>";
			echo "<div class='prod'>";
			echo "<div class='left'>";
			echo "<p class='prodtitle'>Name</p>";
			echo "<input type='text' name='name' placeholder='Name'>";
			echo "<p class='prodtitle'>Image</p>";
			echo "<input type='text' name='pictures' placeholder='Image'>";
			echo "</div>";
			echo "<div class='mid'>";
			echo "<p class='catetitle'>Categorie 1 / Categorie 2</p>";
			echo "<input type='text' name='categorie1' placeholder='Categorie 1'>";
			echo "<input type='text' name='categorie2' placeholder='Categorie 2'>";
			echo "<p class='catedesc'>Description</p>";
			echo "<input type='text' name='description' placeholder='Description'>";
			echo "<p class='pricetext'>Price in $</p>";
			echo "<input type='text' name='price' placeholder='Price'>";
			echo "</div>";
			echo "<div class='add'>";
			echo "<button class='catbtn' type='submit' value='add-prod' name='add' form='modif'>Add Article</button>";
			echo "</div>";
			echo "</div>";

			echo "<h3>All articles</h3>";
            foreach ($row as $data)
            {
                echo "<div class='prod'>";
				echo "<div class='left'>";
				echo "<p class='prodtitle'>Name</p>";
				echo "<input type='text' name='name' placeholder='". $data['name'] ."'>";
				echo "<img src='". $data['pictures'] . "' alt='". $data['name'] . "'>";
				echo "<input type='text' name='pictures' placeholder='". $data['pictures'] ."'>";
				echo "</div>";
				echo "<div class='mid'>";
				echo "<p class='catetitle'>". $data['categorie1'] ." / ". $data['categorie2'] . "</p>";
				echo "<input type='text' name='categorie1' placeholder='". $data['categorie1'] ."'>";
				echo "<input type='text' name='categorie2' placeholder='". $data['categorie2'] ."'>";
				echo "<p class='catedesc'>". $data['description'] ."</p>";
				echo "<input type='text' name='description' placeholder='". $data['description'] ."'>";
				echo "<p class='pricetext'>". $data['price'] ."$</p>";
				echo "<input type='text' name='price' placeholder='". $data['price'] ."'>";
				echo "</div>";
				echo "<div class='add'>";
				echo "<button class='catbtn' type='submit' value='" . $data['id'] . "' name='prod_change' form='modif'>Change</button>";
				echo "<button class='catbtn' type='submit' value='" . $data['id'] . "' name='prod_delete' form='modif'>Delete</button>";
				echo "</div>";
				echo "</div>";
            }
		}
		if ($from === "categories")
        {
			echo "<div class='list'>";
				echo "<h3>New categorie</h3>";
				echo "<div class='prod'>";
				echo "<div class='left'>";
				echo "<p class='prodtitle'>Categorie Name</p>";
				echo "<input type='text' name='name' placeholder='Categorie Name'>";
				echo "</div>";
				echo "<div class='add'>";
				echo "<button class='catbtn' type='submit' value='add-cate' name='add' form='modif'>Add Categorie</button>";
				echo "</div>";
				echo "</div>";

				echo "<h3>All categories</h3>";
            foreach ($row as $data)
            {
                echo "<div class='prod'>";
				echo "<div class='left'>";
				echo "<p class='prodtitle'>Categorie Name</p>";
				echo "<input type='text' name='name' placeholder='". $data['name'] ."'>";
				echo "</div>";
				echo "<div class='add'>";
				echo "<button class='catbtn' type='submit' value='" . $data['id'] . "' name='cate_change' form='modif'>Change</button>";
				echo "<button class='catbtn' type='submit' value='" . $data['id'] . "' name='cate_delete' form='modif'>Delete</button>";
				echo "</div>";
				echo "</div>";
			}
			echo "</div>";
		}
		if ($from === "users")
        {
			echo "<div class='list'>";
				echo "<h3>New user</h3>";
				echo "<div class='prod'>";
				echo "<div class='left'>";
				echo "<p class='prodtitle'>Login</p>";
				echo "<input type='text' name='login' placeholder='Login'>";
				echo "<p class='prodtitle'>Password</p>";
				echo "<input type='text' name='passwd' placeholder='Password'>";
				echo "<p class='prodtitle'>Email</p>";
				echo "<input type='text' name='email' placeholder='Email'>";
				echo "<p class='prodtitle'>Admin</p>";
				echo "<input type='text' name='admin' placeholder='Admin'>";
				echo "</div>";
				echo "<div class='add'>";
				echo "<button class='catbtn' type='submit' value='add-user' name='add' form='modif'>Add User</button>";
				echo "</div>";
				echo "</div>";

			echo "<h3>All users</h3>";
            foreach ($row as $data)
            {
                echo "<div class='prod'>";
				echo "<div class='left'>";
				echo "<p class='prodtitle'>Login</p>";
				echo "<input type='text' name='login' placeholder='". $data['login'] ."'>";
				echo "<p class='prodtitle'>Password</p>";
				echo "<input type='text' name='passwd' placeholder='". $data['password'] ."'>";
				echo "<p class='prodtitle'>Email</p>";
				echo "<input type='text' name='email' placeholder='". $data['email'] ."'>";
				echo "<p class='prodtitle'>Admin</p>";
				echo "<input type='text' name='admin' placeholder='". $data['admin'] ."'>";
				echo "</div>";
				echo "<div class='add'>";
				echo "<button class='catbtn' type='submit' value='" . $data['id'] . "' name='user_change' form='modif'>Change</button>";
				echo "<button class='catbtn' type='submit' value='" . $data['id'] . "' name='user_delete' form='modif'>Delete</button>";
				echo "</div>";
				echo "</div>";
			}
			echo "</div>";
		}
		if ($from === "commands")
        {
			echo "<h3>All Commands</h3>";
			echo "<div class='commands'>";
            foreach ($row as $data)
            {
				$quantity = array();
				$id = array();

				$idquant = explode(";", $data['products']);
				foreach ($idquant as $str)
				{
					$i=1;
					$exp = explode("=", $str);
					foreach ($exp as $val)
					{
						if (!($i % 2))
							$quantity[] = $val;
						else
							$id[] = $val;
						$i++;
						
					}
				}
				echo "<div class='prod'>";
				echo "<div class='left'>";
				echo "<p class='prodtitle'>LOGIN: ". $data['login'] ."</p>";
				$j = 0;
				foreach($id as $elem)
				{
					echo "<p class='prodtitle'>ID Article: ". $elem ." Quantity: ". $quantity[$j] ."</p>";
					$j++;
				}
				echo "<button class='catbtn' type='submit' value='" . $data['id'] . "' name='user_delete' form='modif'>Delete</button>";
				echo "</div>";
				echo "</div>";
			}
			echo "</div>";
		}
	}
	?>
		</div>
	</body>
</html>
