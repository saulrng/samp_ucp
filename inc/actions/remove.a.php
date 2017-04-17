<?php
if(!defined('saul'))
	die('Nope.');
if(!Config::isAjax()) 
	die('Nope.');
if(!Config::isLogged())
	return print_r(json_encode(array('message' => 'An error occured.','color' => 'red')));
$faction = Config::getPlayerData($_SESSION['awm_user'],'Member');
if($faction != $_POST['faction'])
	return print_r(json_encode(array('message' => 'An error occured.','color' => 'red')));
if($_SESSION['awm_user'] == $_POST['id'])
	return print_r(json_encode(array('message' => 'You can\'t perform actions on yourself.','color' => 'red')));

$q = Config::$g_con->prepare('SELECT Rank,Member,name FROM users WHERE id = ?');
$q->execute(array((int)$_POST['id']));
if(!$q->rowCount())
	return print_r(json_encode(array('message' => 'An error occured.','color' => 'red')));
$data = $q->fetch(PDO::FETCH_OBJ);

if($faction != $data->Member)
	return print_r(json_encode(array('message' => 'Player <i>'.$data->name.'</i> is not in your faction.','color' => 'red')));

$qa = Config::$g_con->prepare('UPDATE users SET Rank = 0,Member = 0,FPunish = 20 WHERE id = ?');
$qa->execute(array((int)$_POST['id']));

if($qa)
	return print_r(json_encode(array('message' => 'Player <i>'.$data->name.'</i> is no longer in your faction.','color'=>'green','remove' => 1)));
else
	return print_r(json_encode(array('message' => 'An error occured.','color' => 'red')));

?>