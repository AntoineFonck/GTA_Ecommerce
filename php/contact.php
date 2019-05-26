<?php
session_start();
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
        <h1>Contact</h1>
        <a href="../index.php" class="btn">Home</a>
        <a href="./categories.php" class="btn">Categories</a>
        <a href="./basket.php" class="btn">Basket <i class="fas fa-shopping-basket"></i></a>
		<?php
		if ($_SESSION['rights'] !== 1 && $_SESSION['rights'] !== 10)
        	echo "<a href='../views/sign.html' class='btn'>Sign in</a>";
		else
			echo "<a href='./logout.php' class='btn'>Log out</a>";
		?>
        <a href="./contact.php" class="btn">Contact</a>
        <div id="contact">
            <h3>Join us at those addresses</h3>
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2622.9832959896635!2d2.316167316315188!3d48.896655505964915!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x47e66fa9e5c88119%3A0x75e95ba431790f9b!2s96+Boulevard+Bessi%C3%A8res%2C+75017+Paris!5e0!3m2!1sfr!2sfr!4v1558856361234!5m2!1sfr!2sfr"  frameborder="0" style="border:0" allowfullscreen></iframe>
            <span class="legend"> 42 at 96 Boulevard Bessières, Paris</span>
            <div class="map">
                <img src="http://nl.wikigta.org/images/9/9d/VCS_map_final.gif" alt="Vice_city_map">
                <img src="http://haignet.co.uk/ViceCity/Images/Ammu-nation-3.gif" alt="North">
            </div>
            <span class="legend"> 24 North-Side Avenue, Vice City</span>
            <div class="map">
                <img src="http://nl.wikigta.org/images/9/9d/VCS_map_final.gif" alt="Vice_city_map">
                <img src="http://haignet.co.uk/ViceCity/Images/Ammu-nation-1.gif" alt="Downtown">
            </div>
            <span class="legend"> 42 Downtown Street, Vice City</span>
        </div>
    </body>
</html>
