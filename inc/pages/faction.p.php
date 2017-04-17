<?php
if(!defined('saul'))
	die('Nope.');
if(!isset(Config::$_url[1]) || !is_numeric(Config::$_url[1])) header('Location: ' . Config::$_PAGE_URL . 'factions');
$q = Config::$g_con->prepare('SELECT a.Rank,a.Leader,a.name,a.id, g.* FROM factions g LEFT JOIN users a ON ( a.Member = g.ID ) WHERE g.ID = ? ');
$q->execute(array((int)Config::$_url[1]));
if(!$q->rowCount()) header('Location: ' . Config::$_PAGE_URL . 'factions');

if(Config::isLogged()) {
	$pq = Config::$g_con->prepare('SELECT Rank,Leader FROM users WHERE Member = ?');
	$pq->execute(array((int)Config::$_url[1]));

	$data = $pq->fetch(PDO::FETCH_OBJ);
}
$i = 0;

while($row = $q->fetch(PDO::FETCH_OBJ)) {

	if(!$row->name) {
		echo '<h3>No members in <b>' . $row->Name . '</b></h3>';
		break;
	}

$anunt = $row->Anunt;
$mxm = $row->MaxMembers;
$mlv = $row->MinLevel;
$aplc = $row->Application;

	if($i == 0)

		echo '<h3>Members of '.$row->Name.'</h3><table class="table table-hover">
			<tr>
				<th>Player name</th>
				<th>Player rank</th>
				' . (Config::isLogged() && $data->Leader == (int)Config::$_url[1] && $data->Rank >= 7 ? '<th class="data">Actions</th>' : '') . '
			</tr>
		';

	$rank = ($row->Rank != 0 ? 'Rank' . $row->Rank : 'Rank2');
	echo 
	"<tr class='player_".$row->id."'>
		<td><a href='".Config::$_PAGE_URL."profile/{$row->id}'>{$row->name}</a></td>	
		<td class='rank_".$row->id."'>" . $row->$rank . "</td>
		" . (Config::isLogged() && $data->Leader == (int)Config::$_url[1] && $data->Rank >= 7 ? '
			<td>
				<img src="'.Config::$_PAGE_URL.'assets/images/up.png" id="'.$row->id.'" class="rank_up" style="cursor:pointer;"/>
				<img src="'.Config::$_PAGE_URL.'assets/images/down.png" id="'.$row->id.'" class="rank_down" style="cursor:pointer;"/>
				<img src="'.Config::$_PAGE_URL.'assets/images/remove.png" id="'.$row->id.'" class="remove" style="cursor:pointer;"/>
			</td>
		' : '') . "
	</tr>";
	$i = 1;
}
echo '</table>';

?>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
<?php if(Config::isLogged() && @$data->Leader == (int)Config::$_url[1] && $data->Rank >= 7  ) { ?>
	<script>
	$(".rank_up, .rank_down, .remove").click(function() {
		var action = $(this).attr('class');
		var id = ($(this).attr('id'));
		var faction = <?php echo Config::$_url[1]; ?>;
		$.ajax({
			url: _PAGE_URL + "action/" + action,
			type: "POST",
			data: { id : id , faction : faction},
			success: function(result) {
				result = JSON.parse(result);
				$('<div id="message"><b><font color="' + result.color + '">' + result.message + '</font></b></div>').hide().prependTo('#content').fadeIn('slow');
				$("#message").delay(5000).fadeOut(400);
				if(typeof(result.rank) != 'undefined')
					$('.rank_' + id).html(result.rank);
				if(typeof(result.remove) != 'undefined') {
					var tr = $('.player_' + id);
					tr.fadeOut(400, function(){
			            tr.remove();
			        });
				}
			},
		});
	});
	</script>

<div class='row'>
  <div class='col-md-4'>
  	
  	<div class='well well-lg'>
  		<p>Max Members : <?php echo $mxm;?> </p>
  		<p>Min Level for application : <?php echo $mlv;?> </p>

  	<p>Aplications is :  <?php if($aplc == 1){ echo "Opened"; }else{ echo "Closed";}; ?> </p>

  	</div>

  </div>
  <div class='col-md-4'>
  	
<div class='panel panel-default'>
  <div class='panel-heading'>MOTD</div>
  <div class='panel-body'>
   <p><?php echo $anunt ;?></p>
  </div>
</div


  </div>


</div></div>


  	
  	<img src="<?php echo Config::$_PAGE_URL; ?>assets/images/up.png"/> - rank up<br>
		<img src="<?php echo Config::$_PAGE_URL; ?>assets/images/down.png"/> - rank down<br>
		<img src="<?php echo Config::$_PAGE_URL; ?>assets/images/remove.png"/> - remove from faction<br>

 
  	

 


	
<?php } ?>