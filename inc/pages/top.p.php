<?php
if(!defined('saul'))
	die('Nope.');
$q = Config::$g_con->prepare('SELECT name, Level, ConnectedTime, Money, Bank FROM users WHERE Level > 1 ORDER BY Level+ConnectedTime+Money+Bank DESC LIMIT 20');
$q->execute();
echo '<link href="http://redpanel.bugged.ro/css/font-awesome.min.css" media="all" type="text/css" rel="stylesheet">';
echo '<h1 style="text-align:left;"><i class="icon-group"> Top Players</i></h1>
<table class="table">
		<tr class="">
			<th class="">#</th>
			<th class="">Name</th>
			<th class="">Level</th>
			<th class="">Played Hours</th>
			<th class="">Money</th>
			<th class="">Bank Money</th>
		</tr>';
	
while($row = $q->fetch(PDO::FETCH_OBJ)) {
	$rank ++;
	echo 
	"<tr>
		<td align=''>$rank</td>
		<td align=''><a href='".Config::$_PAGE_URL."profile/{$row->id}'>$row->name</a></td>
		<td align=''>{$row->Level}</td>
		<td align=''>{$row->ConnectedTime}</td>
		<td align=''>". number_format("$row->Money",0,'.','.')." $</td>
		<td align=''>". number_format("$row->Bank",0,'.','.')." $</td>
	</tr>";
}
echo '</table>';

?>