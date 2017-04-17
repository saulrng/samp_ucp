<?php
if(!defined('saul'))
	die('Nope.');
if(Config::isLogged()) header('Location: ' . Config::$_PAGE_URL . 'profile');
if(isset($_POST['login_submit'])) {
	if(!$_POST['login_username'] || !$_POST['login_password']) {
		echo '<font color="red"><b>Complete all fields.</b></font>';
	} else {
		$q = Config::$g_con->prepare('SELECT `id` FROM `users` WHERE `name` = ? AND `password` = ?');
		$q->execute(array($_POST['login_username'],$_POST['login_password']));
		if($q->rowCount()) {
			$row = $q->fetch(PDO::FETCH_OBJ);
			$_SESSION['awm_user'] = $row->id;
			echo '<center><font color="green"><b>You have successfully logged in. You will be redirected in <b>3</b> seconds.</b></font><br><br></center>';
			echo '<meta http-equiv="refresh" content="3;URL=\''.Config::$_PAGE_URL.'profile\'/>';
		}
		else echo '<font color="red"><b>Invalid username or password.</b></font>';
	}
}
?>
<link href="http://redpanel.bugged.ro/css/font-awesome.min.css" media="all" type="text/css" rel="stylesheet">
<br><br>

<div class="row">
  <div class="col-md-4"></div>
  <div class="col-md-4">
  	<form action="" method="post" >
  	 <div class="form-group">
    <label for="login_username">Username : </label>
    <input type="text" class="form-control" id="login_username" name="login_username" placeholder="Username">
  </div>
  <div class="form-group">
    <label for="exampleInputEmail1">Password : </label>
    <input type="password" class="form-control" id="login_password" name="login_password" placeholder="Password">
  </div>
   <button type="submit" class="btn btn-default" id="login_submit" name="login_submit">Login</button>
</form>
  </div>
  <div class="col-md-4">
  	
  </div>
</div>