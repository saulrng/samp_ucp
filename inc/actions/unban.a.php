<?php
if(!defined('saul'))
	die('Nope.');
if(!Config::isAjax()) 
	die('Nope.');
if(!Config::isLogged())
	return print_r(json_encode(array('message' => 'An error occured.','color' => 'red')));
$q = Config::$g_con->prepare('SELECT * FROM bans WHERE ID = ?');
$q->execute(array($_POST['id']));
if(!$q->rowCount())
	return print_r(json_encode(array('message' => 'An error occured.','color' => 'red')));
$ban_data = $q->fetch(PDO::FETCH_OBJ);

$q = Config::$g_con->prepare('SELECT * FROM users WHERE name = ?');
$q->execute(array($ban_data->PlayerName));
if(!$q->rowCount())
	return print_r(json_encode(array('message' => 'An error occured.','color' => 'red')));


$q = Config::$g_con->prepare('DELETE FROM bans WHERE PlayerName = ?');
$q->execute(array($ban_data->PlayerName));

return print_r(json_encode(array('message' => 'You unbanned <b>' . $ban_data->PlayerName . '</b>','color' => 'green','success' => 1)));

?>