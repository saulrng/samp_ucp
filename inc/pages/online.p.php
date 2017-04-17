<?php
include_once 'inc/samp.inc.php';
$server = new Server(Config::$_IP,'7777');
if(!$server->isOnline()) { echo '<font color="#FF0000">The server is offline.</font>'; return; }
echo '<b>Total online players - <font color="green">' . $server->get('players') . '</font></b><BR><BR>';
echo '<table class="data">';
echo '<tr class="data">
		<th class="data">Name</th>
		<th class="data">Level</th>
		<th class="data">Ping</th>
	</tr>';
$players = $server->GetDetailedPlayers();
foreach($players as $player) {
	echo '<tr>
			<td><center>' . $player['nickname'] . '</center></td>
			<td><center>' . $player['score'] . '</center></td>
			<td><center>' . $player['ping'] . '</center></td>
		</tr>';
}
echo '</table>';
?>