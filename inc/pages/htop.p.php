<?php
if(!defined('saul'))
	die('Nope.');
$q = Config::$g_con->prepare('SELECT name, HelpedPlayers FROM users WHERE Helper > 0 ORDER BY HelpedPlayers DESC LIMIT 20');
$q->execute();
echo '<link href="http://redpanel.bugged.ro/css/font-awesome.min.css" media="all" type="text/css" rel="stylesheet">';
echo '<h1 style="text-align:left;"><i class="icon-group"> Top Helpers</i></h1><table class="table">
		<tr>
			<th>#</th>
			<th>Name</th>
			<th>Help Points</th>
		</tr>';
	
while($row = $q->fetch(PDO::FETCH_OBJ)) {
	$rank ++;
	echo 
	"<tr>
		<td>$rank</td>
		<td>$row->name</td>
		<td>{$row->HelpedPlayers}</td>
		
	</tr>";
}
echo '</table>';

?>