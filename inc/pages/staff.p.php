<?php
if(!defined('saul'))
	die('Nope.');
$q = Config::$g_con->prepare('SELECT id,name,Admin,Status, lastOn FROM users WHERE Admin > 0 ORDER BY Admin DESC');
$q->execute();
echo '<h2>Admins</h2>';
echo '<div class="row">';
while($row = $q->fetch(PDO::FETCH_OBJ)) {
	echo 
	"
  <div class='col-sm-6 col-md-4'>
    <div class='thumbnail'>
        <a href = '".Config::$_PAGE_URL."profile/{$row->id}' ><h3>{$row->name}</h3></a>
        <p> Admin :{$row->Admin} </p>
        <p> Status : ".($row->Status ? '<font color="white">ONLINE</font>' : '<font color="white">OFFLINE</font>')." </p>
        <p> Last On : {$row->lastOn} </p>    
      </div>
    
  </div>";
}
echo '</div>';

$q = Config::$g_con->prepare('SELECT id,name,Helper,Status,lastOn FROM users WHERE Helper > 0 ORDER BY Helper DESC');
$q->execute();

echo '<h2>Admins</h2><div class="row">';
while($row = $q->fetch(PDO::FETCH_OBJ)) {
	echo 
	"<div class='col-sm-6 col-md-4'>
    <div class='thumbnail'>
        <a href = '".Config::$_PAGE_URL."profile/{$row->id}' ><h3>{$row->name}</h3></a>
        <p> Admin :{$row->Helper} </p>
        <p> Status : ".($row->Status ? '<font color="white">ONLINE</font>' : '<font color="white">OFFLINE</font>')." </p>
        <p> Last On : {$row->lastOn} </p>    
    </div>
  </div>";
}
echo '</div>';

?>