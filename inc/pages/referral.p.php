<?php
if(!defined('saul'))
	die('Nope.');
$q = Config::$g_con->prepare('SELECT * FROM `log_admin` ORDER BY `time` DESC ' . Config::init()->_pagLimit());
$q->execute();
echo '<table class="data">
		<tr class="data">
			<th class="data">Name</th>
			<th class="data">IP</th>
			';	
echo '</tr>';
while($row = $q->fetch(PDO::FETCH_OBJ)) {
	echo 
	"<tr class='ban_{$row->id}'>
		<td align='center'>{$row->log}</td>
		<td align='center'>{$row->time}</td>";
		
}
echo '</table>';
echo Config::_pagLinks(Config::rows('log_admin'));
?>
<?php if(Config::isLogged() && $admin != 0) { ?>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
	
<?php } ?>