<?php
if(!defined('saul'))
	die('Nope.');
if(!Config::isLogged()) header('Location: ' . Config::$_PAGE_URL);
if(isset($_POST['submit'])) {
	if(!$_POST['email'] || !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
		echo '<b><font color="red">You need to enter a valid email.</font></b>';
	} else {
		$q = Config::$g_con->prepare('UPDATE users SET Email = ? WHERE id = ?');
		$q->execute(array($_POST['email'],$_SESSION['awm_user']));
		echo '<b><font color="green">You have successfully changed your email (<b><i>'.$_POST['email'].'</i></b>).</font></b>';
	}
}
?>
<form action="" method="post">
	<input type="text" class="form-control" placeholder="New email" name="email"/>
		<br>
	<input type="submit" name="submit" value="Change email"></input>
</form>