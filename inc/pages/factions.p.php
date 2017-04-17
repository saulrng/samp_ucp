<?php
if(!defined('saul'))
	die('Nope.');
$q = Config::$g_con->prepare('SELECT a.name,g.Name,g.ID FROM factions g LEFT JOIN users a ON ( a.Member = g.ID AND a.Leader = g.ID ) GROUP BY g.ID');
$q->execute();
echo '<table class="table table-hover">
		<tr>
			<th>Faction name</th>
			<th>Leader</th>
			<th>Details</th>
		</tr>
	';
while($row = $q->fetch(PDO::FETCH_OBJ)) {
	echo 
	"<tr>
		<td>{$row->Name}</td>
		<td>" . (!$row->name ? 'No-one(Available)' : $row->name) . "</td>
		<td><a href='".Config::$_PAGE_URL."faction/".$row->ID."'><img src='".Config::$_PAGE_URL."assets/images/details.png'/></a></td>

     
	";
}
 
echo '</tr></table>';
?>
