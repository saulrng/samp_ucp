<?php

$q = Config::$g_con->prepare('SELECT houseExteriorPosX, houseExteriorPosY FROM houses');
$q->execute();


$img = imagecreatefromjpeg("map.jpg");



while($row = $q->fetch(PDO::FETCH_OBJ)) {
  
  // 0.0 0.0 is at the center of the map, in PHP 0.0 0.0 is in the top left corner, so I added / substracted 400. the map is 800x800 px, 400x400 is at the center of the map.
  
  $x = $row['houseExteriorPosX'];
  $y = $row['houseExteriorPosY'];
  
  
  $red = imagecreatefrompng("http://theg.ro/rpg/assets/images/house.png");   	
  imagecopy($img, $red, $x, $y, 0, 0, 20, 20);
}

header ('Content-Type: image/png');
imagepng($img);
imagedestroy($img);