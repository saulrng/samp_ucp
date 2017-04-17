<?php
if(!defined('saul'))
	die('Nope.');
$q = Config::$g_con->prepare('SELECT * FROM `bans` ORDER BY `ID` DESC ' . Config::init()->_pagLimit());
$q->execute();
echo '<table class="table table-striped">
		<tr>
			<th>ID</th>
			<th>Banned player</th>
			<th>Banned by</th>
			<th>Reason</th>
			<th>Date</th>';
if(Config::isLogged()) {
	$admin = Config::getPlayerData($_SESSION['awm_user'],'Admin');
	if($admin != 0) echo '<th class="data">Unban</th>';	
}		
echo '</tr>';
while($row = $q->fetch(PDO::FETCH_OBJ)) {
	echo 
	"<tr class='ban_{$row->ID}'>
		<td>{$row->ID}</td>
		<td>{$row->PlayerName}</td>
		<td>{$row->AdminName}</td>
		<td>{$row->Reason}</td>
		<td>{$row->BanTimeDate}</td>";
		echo(Config::isLogged() && $admin != 0 ? 
			'<td align="center"><img src="'.Config::$_PAGE_URL.'assets/images/remove.png" class="unban" id="'.$row->ID.'" style="cursor:pointer;"></td>' : '');
	echo "</tr>";
}
echo '</table>';
echo Config::_pagLinks(Config::rows('bans'));
?>
<?php if(Config::isLogged() && $admin != 0) { ?>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
	<script>
	$(".unban").click(function() {
		var id = ($(this).attr('id'));
		$.ajax({
			url: _PAGE_URL + "action/unban",
			type: "POST",
			data: { id : id },
			success: function(result) {
				result = JSON.parse(result);
				$('<div id="message"><b><font color="' + result.color + '">' + result.message + '</font></b></div>').hide().prependTo('#content').fadeIn('slow');
				$("#message").delay(5000).fadeOut(400);
				if(typeof(result.success) != 'undefined') {
					var tr = $('.ban_' + id);
					tr.fadeOut(400, function(){
			            tr.remove();
			        });
				}
			},
		});
	});
	</script>
<?php } ?>