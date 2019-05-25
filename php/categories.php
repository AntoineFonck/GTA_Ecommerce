<?php
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Gun Shop</title>
        <link rel="icon" href="https://www.favicon.cc/logo3d/350003.png">
        <link href="../css/index.css" rel="stylesheet">
        <link href='https://fonts.googleapis.com/css?family=Oswald:300' rel='stylesheet' type='text/css'>
    </head>
    <body>
        <h1>Categories</h1>
        <form id="catform" action="categorie.php" method="POST"></form>
        <select name="carlist" form="carform">
            <option value="volvo">Volvo</option>
            <option value="saab">Saab</option>
            <option value="opel">Opel</option>
            <option value="audi">Audi</option>
        </select>
        <button class="catokbtn mr" type="submit" value="OK" name="submit" form="catform">OK</button>
        <button class="catbtn" type="submit" value="Pim" name="submit" form="catform">Pim</button>
        <button class="catbtn" type="submit" value="Bang" name="submit" form="catform">Bang</button>
        <button class="catbtn" type="submit" value="Bang-Bang" name="submit" form="catform">Bang-Bang</button>
        <button class="catbtn" type="submit" value="Boum" name="submit" form="catform">Boum</button>
        <div id="products">
            <div class="prod">
                <div class="left">
                    <p class="prodtitle">Baseball Bat</p>
                    <img src="https://vignette.wikia.nocookie.net/gtawiki/images/5/59/BaseballBat-GTAV.png/revision/latest?cb=20160612221707" alt="">
                </div>
                <div class="mid">
                    <p class="catetitle">Melee / Cont</p>
                    <p class="catedesc">The Baseball Bat is one of the first melee weapons featured in the games. It is, by far, the easiest weapon to obtain, with one always at the safehouse in the games taking place in Grand Theft Auto III and Grand Theft Auto: Liberty City Stories and a common sight throughout the other games. The baseball bat is also commonly seen in the hands of gangsters, mobsters, and sometimes civilians throughout the games.</p>
                </div>
                <div class="price">
                    <p class="pricetext">50$</p>
                </div>
                <div class="add">
                    <button class="catbtn" type="submit" value="Boum" name="submit">ADD</button>
                </div>
            </div>
        </div>
    </body>
</html>