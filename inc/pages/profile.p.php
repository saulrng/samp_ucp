<?php
if(!defined('saul'))
	die('Nope.');
if(!Config::isLogged() && !isset(Config::$_url[1])) header('Location: ' . $_PAGE_URL . 'login');
if(isset(Config::$_url[1])) $user = (int)Config::$_url[1];
else $user = $_SESSION['awm_user'];

$q = Config::$g_con->prepare('SELECT a.*,b.Message,h.ID,c.ID FROM users a LEFT JOIN bizz b ON (b.Owner = a.name) LEFT JOIN houses h ON (h.Owner = a.name) LEFT JOIN cars c ON (c.Owner = a.name) WHERE a.id = ?');
$q->execute(array($user));
if(!$q->rowCount()) {
	echo '<div class="alert alert-danger">This user does not exist.</div>';
	return;
}
$data = $q->fetch(PDO::FETCH_OBJ);
$data->name = $cezar;
$carown =  $cezar;
?>


<div class="row">
  <div class="col-xs-6 col-md-4">
  	<ul class="list-group">
  <li class="list-group-item">
  <span class="badge"><?php echo $data->id; ?></span>
    Player ID
  </li>

  <li class="list-group-item">
  <span class="badge"><?php echo $data->name; ?></span>
    Name
  </li>

    <li class="list-group-item">
  <span class="badge"><?php echo ($data->Status == 0 ? '<font color="red">Offline</font>' : '<font color="green">Online</font>'); ?></span>
    Status
  </li>

  </ul>

<li class="list-group-item">
  <span class="badge"><?php echo $data->lastOn; ?></span>
    Last Login  </li>

  <li class="list-group-item">
  <span class="badge"><?php echo $data->Level; ?></span>
    Level
  </li>

  <li class="list-group-item">
  <span class="badge"><?php echo $data->Respect . ' / ' . ($data->Level == 1 ? '6' : ($data->Level+1)*4); ?></span>
    Respect
  </li>

  <li class="list-group-item">
  <span class="badge"><?php echo $data->ConnectedTime; ?></span>
    Played Hours
  </li>

  <li class="list-group-item">
  <span class="badge"><?php echo number_format($data->Money,0,'.','.'); ?> $</span>
   Money
  </li>

  <li class="list-group-item">
  <span class="badge"><?php echo number_format($data->Bank,0,'.','.'); ?> $</span>
   Bank
  </li>
<br>
<li class="list-group-item">
  <span class="badge"> <?php echo Config::$factions[$data->Member]['name']; ?> </span>
   Faction
  </li>
<?php if($data->Member != 0) { ?>
  <li class="list-group-item">
  <span class="badge"><?php echo Config::$factions[$data->Member]['rank'][$data->Rank]; ?></span>
   Rank
  </li>
<?php } ?>
  <li class="list-group-item">
  <span class="badge"><font color="<?php echo($data->FaPunish != 0 ? 'red' : 'green'); ?>"><?php echo $data->FPunish; ?> / 30</font></span>
   Faction Punish

  </li>
  <br>

<li class="list-group-item">
  <span class="badge"><?php echo Config::$jobs[$data->Job]; ?></span>
    Job
  </li>

  <li class="list-group-item">
  <span class="badge"><?php echo (isset($data->house) ? '<font color="green">Yes</font> (ID:'.$data->house.')' : '<font color="red">No</font>'); ?></span>
    House
  </li>

  <li class="list-group-item">
  <span class="badge"><?php echo (isset($data->Bizz) ? $data->Bizz : '<font color="red">No</font>'); ?></span>
    Bussines
  </li>

<br>

  <li class="list-group-item">
  <span class="badge"><?php echo($data->Admin != 0 ? '<font color="green">Yes</font> ('.$data->Admin.')' : '<font color="red">No</font>'); ?></span>
    Admin
  </li>
  <li class="list-group-item">
  <span class="badge"><?php echo($data->Helper != 0 ? '<font color="green">Yes</font> ('.$data->Helper.')' : '<font color="red">No</font>'); ?></span>
    Helper
  </li>
  <li class="list-group-item">
  <span class="badge"><?php echo($data->Premium != 0 ? '<font color="green">Yes</font>' : '<font color="red">No</font>'); ?></span>
    Premium
  </li>

  </div>
  <div class="col-xs-6 col-md-4">
  	<div class="well well-lg">
    <h2>Licente</h2>
<?php echo($data->CarLic == 1 ? '<td><center><img src="'.Config::$_PAGE_URL.'assets/images/car.png"/><br><b>Driving</b><br>'.$data->CarLicT.' hours</center></td>' : ''); ?>
		<?php echo($data->FlyLic == 1 ? '<td><center><img src="'.Config::$_PAGE_URL.'assets/images/fly.png"/><br><b>Flying</b><br>'.$data->FlyLicT.' hours</center></td>' : ''); ?>
		<?php echo($data->BoatLic == 1 ? '<td><center><img src="'.Config::$_PAGE_URL.'assets/images/boat.png"/><br><b>Sailing</b><br>'.$data->BoatLicT.' hours</center></td>' : ''); ?>
		<?php echo($data->GunLic == 1 ? '<td><center><img src="'.Config::$_PAGE_URL.'assets/images/gun.png"/><br><b>Weapon</b><br>'.$data->GunLicT.' hours</center></td>' : ''); ?>
		<?php if(!$data->CarLic && !$data->FlyLic && !$data->BoatLic && !$data->GunLic) echo '<td style="padding:5px;">None.</td>'; ?>
  	</div>
  	<div class="well well-lg">

  	</div>


  </div>
  <div class="col-xs-6 col-md-2">
  	
<div class="well well-lg">
	
<img src="<?php echo Config::$_PAGE_URL; ?>assets/images/skins/<?php echo $data->Model; ?>.png" height="290px" style="padding:10px;"/>


</div>
  </div>




</div>

<div class="row">
  <div class="col-md-6">
    <div class="row">

  <div class="col-sm-6 col-md-4">
    <div class="thumbnail">
     <img src="<?php echo Config::$_PAGE_URL; ?>assets/images/vehicles/<?php echo $data->Model; ?>.png" alt="...">
      <div class="caption">
        <h3>Thumbnail label</h3>
      </div>
    </div>
  </div>


</div>




  </div>
  <div class="col-md-6">
    


  </div>
</div>

<!--

<div id="sign">
<img src="<?php echo Config::$_PAGE_URL; ?>signature/<?php echo $user; ?>"><br>
<input type="text" value="<?php echo Config::$_PAGE_URL; ?>signature/<?php echo $user; ?>" style="width:230px;"/></div>
-->
