<?php
$q = Config::$g_con->prepare('SELECT ID FROM cars WHERE Model != 0');
$q->execute();
$pvehs = $q->rowCount();
include_once 'inc/samp.inc.php';
$server = new Server(Config::$_IP);
if($server->isOnline()) $sData = $server->getInfo();
else $sData = array('players' => 0,'maxplayers' => 0);
?>

  <div class="row">
  <div class="col-lg-8">
					
<?php
							$q = Config::$g_con->prepare('SELECT * FROM `updates` WHERE `For` = 1 ORDER BY `id` DESC Limit 3');
							$q->execute();
							while($row = $q->fetch(PDO::FETCH_OBJ)) {
						?>
					
				<?php if(Config::isLogged() && ($admin == 222)) { ?>	
				<?php } else { ?>	
			    <h1>Despre Server</h1>
                <hr>
                <img class="img-responsive" src="<?php echo Config::$_PAGE_URL; ?>/assets/about.png" alt="">
                <hr>
               <p><?php echo $row->text ?></p>

                <hr>
				<?php } ?>	
		<?php } ?>

<?php
							$q = Config::$g_con->prepare('SELECT * FROM `updates` WHERE `For` = 0 ORDER BY `date` DESC Limit 3');
							$q->execute();
							while($row = $q->fetch(PDO::FETCH_OBJ)) {
						?>
					
				<?php if(Config::isLogged() && ($admin == 222)) { ?>	
				<?php } else { ?>	
			      <div class="media">
                    <a class="pull-left" href="#">
                        <img class="media-object" src="<?php echo Config::$_PAGE_URL; ?>/assets/an.png" alt="">
                    </a>
                    <div class="media-body">
                        <h4 class="media-heading">Update by <?php echo $row->byAdmin ?>
                            <small><?php echo $row->date ?></small>
                        </h4>
                        <?php echo $row->text ?>
                       
                        </div>
                    </div>
                
				<?php } ?>	
		<?php } ?> 
		</div>
            <div class="col-md-4">

                <div class="well">
                    <h4>Top 4 Players by Played Hourse</h4>
                    <div class="row">
                        <div class="col-lg-6"> <ul class="list">
                    <?php
$sql = Config::$g_con->prepare("SELECT * FROM users ORDER BY ConnectedTime DESC LIMIT 4");
$sql->execute();
while($row = $sql->fetch(PDO::FETCH_OBJ)) {
echo"
<li><a href='".Config::$_PAGE_URL."profile/{$row->id}'>{$row->name}</a>
";
} ?>
</ul>
</div>
</div>
                 
                </div>

                <!-- Blog Categories Well -->
                <div class="well">
                    <h4>Top 4 Players by Money</h4>
                    <div class="row">
                        <div class="col-lg-6"> <ul class="list">

<?php
$sql = Config::$g_con->prepare("SELECT * FROM users ORDER BY Money DESC LIMIT 4");
$sql->execute();
while($row = $sql->fetch(PDO::FETCH_OBJ)) {
echo"
<li><a href='".Config::$_PAGE_URL."profile/{$row->id}'>{$row->name}</a>
";
} ?>
                                </li>
                                
                            </ul>
                        </div>
                        
                    </div>
                    <!-- /.row -->
                </div>

                <!-- Side Widget Well -->
                <div class="well">
                    <h4>Factions Logs</h4>
                   <?php
$sql = Config::$g_con->prepare("SELECT * FROM faction_logs ORDER BY time DESC LIMIT 6");
$sql->execute();
while($row = $sql->fetch(PDO::FETCH_OBJ)) {
echo"
<p> {$row->Text} </p>
";
} ?>
                </div>

            </div>

        </div>
        <!--
<hr>
<table border='1' cellpadding = '10' width='60%' style='border-collapse: collapse; border-radius: 12px; border-color: #111; padding: 5px;'>
	<tr>
		<th><img src="<?php echo Config::$_PAGE_URL; ?>assets/images/account.png"><br><?php echo number_format(Config::rows('users','ID'),0,'.','.'); ?><br>players registered</th>
		<th><img src="<?php echo Config::$_PAGE_URL; ?>assets/images/bans.png"><br><?php echo number_format(Config::rows('bans','ID'),0,'.','.'); ?><br> players banned</th>
		<th><img src="<?php echo Config::$_PAGE_URL; ?>assets/images/online.png"><br><?php echo $sData['players'] . '/' . $sData['maxplayers']; ?> <br>players online</th>
	</tr>
	<tr>
		<th><img src="<?php echo Config::$_PAGE_URL; ?>assets/images/houses.png"><br><?php echo number_format(Config::rows('houses','ID'),0,'.','.'); ?><br> houses</th>
		<th><img src="<?php echo Config::$_PAGE_URL; ?>assets/images/businesses.png"><br><?php echo number_format(Config::rows('bizz','ID'),0,'.','.'); ?><br> business</th>
		<th><img src="<?php echo Config::$_PAGE_URL; ?>assets/images/car.png"><br><?php echo number_format($pvehs,0,'.','.'); ?><br> personal vehicles</th>
	</tr>
</table>
<br><br>
-->

<?php if(Config::isLogged() && ($admin >= 6)) { ?> 
				<div class="well">
                    <h4>Admin Panel</h4>
                    <div class="row">
 <div class="col-lg-6"> <ul class="list-unstyled">
<li><br><?php echo $sData['players'] . '/' . $sData['maxplayers']; ?> <br>players online</li>

 </ul></div>
                    </div></div>
				<?php } ?>

