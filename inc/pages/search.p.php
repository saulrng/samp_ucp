<?php
if(!defined('saul'))
	die('Nope.');
if(isset($_POST['sname']) || isset(Config::$_url[2]) != 0) {
	if(isset($_POST['sname'])) $_SESSION['sname'] = $_POST['sname'];
	if(Config::isLogged()) $admin = Config::getPlayerData($_SESSION['awm_user'],'Admin');
	else $admin = 0;
	echo '
		<table class="data">
			<tbody>
				<tr class="data">
					<th class="data">Name</th>
					<th class="data">Level</th>
					' . ($admin != 0 ? '<th class="data"><center>Actions</center></th></tr>' : '') . '
			';
	$q = Config::$g_con->prepare("SELECT name,Level,id FROM users WHERE name LIKE ? ".Config::_pagLimit());
	$q->execute(array('%'.$_SESSION['sname'].'%'));
	echo '';
	while($row = $q->fetch(PDO::FETCH_OBJ)) {
		echo 
			"<tr>
				<td><center><a href='".Config::$_PAGE_URL."profile/{$row->id}'>{$row->name}</a></td>
				<td><center>{$row->Level}</center></td>
				".
					($admin != 0 ? '
						<td>
							<center>
								<img src="'.Config::$_PAGE_URL.'assets/images/remove.png" class="ban" name="'.$row->name.'" style="cursor:pointer;">
							</center>
						</td>' : ''
					)
				."
			</tr>";
	}
	echo '<tbody></table>';
	$q = Config::$g_con->prepare("SELECT id FROM users WHERE name LIKE ?");
	$q->execute(array('%'.$_SESSION['sname'].'%'));
	echo Config::_pagLinks($q->rowCount());
	if(Config::isLogged() && $admin != 0) { ?>
	<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
		<script>
		$(".ban").click(function() {
			reason = prompt("Ban reason.");
			if(reason != null) {
			
				var name = ($(this).attr('name'));
				$.ajax({
					url: _PAGE_URL + "action/ban",
					type: "POST",
					data: { name : name , reason : reason },
					success: function(result) {
						result = JSON.parse(result);
						$('<div id="message"><b><font color="' + result.color + '">' + result.message + '</font></b></div>').hide().prependTo('#content').fadeIn('slow');
						$("#message").delay(5000).fadeOut(400);
					},
				});
				
			}
			
		});
		</script>
	<?php }
	return;
}
?>



<center>
<form method="POST" action="">
	<input type="text" name="sname" placeholder="Name" style="margin-bottom:5px;"><br>
	<input class="btn btn-info" type="submit" name="submit" value="Search">
</form>
</center>