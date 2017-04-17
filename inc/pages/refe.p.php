<?php
if(!defined('saul'))
	die('Nope.');
$q = Config::$g_con->prepare('SELECT Name, ID, Win, Lost, Bank FROM factions WHERE Bank > 1000 ORDER BY Win DESC LIMIT 10');
$q->execute();
echo '<link href="http://redpanel.bugged.ro/css/font-awesome.min.css" media="all" type="text/css" rel="stylesheet">';
echo '<h1 style="text-align:left;"><i class="icon-group"> Top Factions By Win </i></h1><table class="table table-striped">
		<tr>
			<th>#</th>
			<th>Faction Name</th>
			<th>Win</th>
			<th>Lost</th>
			<th>Bank</th>
		</tr>';
	
while($row = $q->fetch(PDO::FETCH_OBJ)) {
	$rank ++;
	echo 
	"<tr>
		<td>$rank</td>
		<td><a href='".Config::$_PAGE_URL."faction/".$row->ID."'>$row->Name</a></td>
		<td>{$row->Win}</td>
		<td>{$row->Lost}</td>
		<td>{$row->Bank}</td>
	</tr>";
}
echo '</table>';

?>
