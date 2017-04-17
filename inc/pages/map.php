<?php

$img = imagecreatefromjpeg("map.jpg");
$red = imagecolorallocate($img, 255, 0, 0);

if( isset($_GET["x"]) && isset($_GET["y"]) ) {
  // the map is GTA SAn andreas is 6000x6000
  // the image that i use is 800x800 6000/800 = 7.5
  
  $x = $_GET["x"]/7.5;
  $y = $_GET["y"]/7.5;
  
  // 0.0 0.0 is at the center of the map, in PHP 0.0 0.0 is in the top left corner, so I added / substracted 400. the map is 800x800 px, 400x400 is at the center of the map.
  
  $x = $x + 400;
  $y = -($y - 400);
  
  imagefilledrectangle($img, $x, $y, $x+10, $y + 10, $red);
}

header ('Content-Type: image/png');
imagepng($img);
imagedestroy($img);