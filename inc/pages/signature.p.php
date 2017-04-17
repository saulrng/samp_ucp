<?php
if(!defined('saul'))
	die('Nope.');
error_reporting(0);
header('Content-Type: image/png');
$im = imagecreatefrompng('assets/images/signature.png');

$color = imagecolorallocate($im, 255, 255, 255);

$font = 'assets/css/signature_font.ttf';

$q = Config::$g_con->prepare('SELECT * FROM users WHERE id = ?');
$q->execute(array((int)Config::$_url[1]));

if(!isset(Config::$_url[1]) || !$q->rowCount()) {

	imagettftext($im, 15, 0, 20, 35, $color, $font, 'Acest utilizator nu exista.');

	imagettftext($im, 12, 0, 30, 36, $color, $font, '-');
	imagettftext($im, 12, 0, 20, 65, $color, $font, '-');
	imagettftext($im, 12, 0, 20, 85, $color, $font, '-');
	imagettftext($im, 12, 0, 20, 105, $color, $font, '-');
	imagettftext($im, 12, 0, 20, 125, $color, $font, '-');
	imagettftext($im, 12, 0, 178, 65, $color, $font, '-');
	imagettftext($im, 12, 0, 178, 85, $color, $font, '-');
	imagettftext($im, 12, 0, 178, 105, $color, $font, '-');
	imagettftext($im, 12, 0, 178, 125, $color, $font, '-');
		
	imagepng($im);
	imagedestroy($im);
	
	return;
}

$data = $q->fetch(PDO::FETCH_OBJ);

$status = imagecreatefrompng('assets/images/'.(!$data->playerStatus ? 'offline' : 'online').'.png');
$skin = imagecreatefrompng('assets/images/signature_skins/Skin_'.$data->playerSkin.'.png');

imagettftext($im, 12, 0, 30, 36, $color, $font, $data->name);
imagettftext($im, 12, 0, 20, 65, $color, $font, 'Level: ' . $data->Level);
imagettftext($im, 12, 0, 20, 85, $color, $font, 'Money: ' . number_format($data->Money,0,'.','.'));
imagettftext($im, 12, 0, 20, 105, $color, $font, 'Age: ' . $data->Age); 
imagettftext($im, 12, 0, 20, 125, $color, $font, 'Hours played: ' . $data->ConnectedTime); 
imagettftext($im, 12, 0, 178, 65, $color, $font, 'Phone: ' . $data->PhoneNr); 
imagettftext($im, 12, 0, 178, 85, $color, $font, 'Job: ' . Config::$jobs[$data->Job]);
imagettftext($im, 12, 0, 178, 105, $color, $font, 'Warn: ' . $data->Warnings . '/3');
imagettftext($im, 12, 0, 178, 125, $color, $font, 'Faction: ' . Config::$factions[$data->FactionJoin]['lname']);
imagecopy($im,$skin,365,12,0,0,55,100);
imagecopy($im,$status,12,21,0,0,16,16);
	
imagepng($im);
imagedestroy($im);