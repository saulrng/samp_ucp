<?php
if(!defined('saul'))
	die('Nope.');
if(!Config::isAjax()) 
	die('Nope.');
if(!Config::isLogged())
	return print_r(json_encode(array('message' => 'An error occured.','color' => 'red')));
	
$q = Config::$g_con->prepare('SELECT name,Admin FROM users WHERE id = ?');
$q->execute(array($_SESSION['awm_user']));
if(!$q->rowCount())
	return print_r(json_encode(array('message' => 'An error occured.','color' => 'red')));
$data = $q->fetch(PDO::FETCH_OBJ);

if(!$data->Admin)
	return print_r(json_encode(array('message' => 'An error occured.','color' => 'red')));
	
$q = Config::$g_con->prepare('SELECT * FROM bans WHERE PlayerName = ?');
$q->execute(array($_POST['name']));
if($q->rowCount())
	return print_r(json_encode(array('message' => 'Player is already banned.','color' => 'red')));

$q = Config::$g_con->prepare('UPDATE users SET Admin = 0 WHERE name = ?');
$q->execute(array($_POST['name']));

$q = Config::$g_con->prepare('INSERT INTO bans (PlayerName,Reason,BanTimeDate,IPBan,AdminName) VALUES (?,?,?,?,?)');
$q->execute(array($_POST['name'],$_POST['reason'],date('Y-m-d H:i:s'),'0.0.0.0',$data->name));

return print_r(json_encode(array('message' => 'Player <i>'.$_POST['name'].'</i> is now banned.','color'=>'green')));

?>