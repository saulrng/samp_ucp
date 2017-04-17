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
if($data->Rank == 1)
	return print_r(json_encode(array('message' => 'Player <i>'.$data->name.'</i> has minimum rank (1).','color' => 'red')));

$qa = Config::$g_con->prepare('UPDATE users SET Rank = Rank-1 WHERE id = ?');
$qa->execute(array((int)$_POST['id']));

$data->Rank = $data->Rank-1;
$rank = ($data->Rank != 0 ? 'Rank' . $data->Rank : 'Rank1');

$q = Config::$g_con->prepare('SELECT '.$rank.' FROM factions WHERE ID = ?');
$q->execute(array($_POST['faction']));
$ranks = $q->fetch(PDO::FETCH_OBJ);

if($qa)
	return print_r(json_encode(array('message' => 'Player <i>'.$data->name.'</i> is now '.$ranks->$rank.'.','color'=>'green','rank'=>$ranks->$rank)));
else
	return print_r(json_encode(array('message' => 'An error occured.','color' => 'red')));

?>