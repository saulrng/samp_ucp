<?php
if(!defined('saul'))
	die('Nope.');
if(!Config::isLogged()) header('Location: ' . Config::$_PAGE_URL);
if(isset($_POST['submit'])) {
	if(!$_POST['cpass'] || !$_POST['npass'] || !$_POST['nrpass']) {
		echo '<b><font color="red">Complete all fields.</b></font>';
	} else {
		if($_POST['npass'] !== $_POST['nrpass']) {
			echo '<b><font color="red">Passwords don\'t match.</b></font>';
		} else {
			$q = Config::$g_con->prepare('SELECT id FROM users WHERE id = ? AND Password = ?');
			$q->execute(array($_SESSION['awm_user'],$_POST['cpass']));
			if(!$q->rowCount()) {
				echo '<b><font color="red">Current password doesn\'t match.</b></font>';
			} else {
				$q = Config::$g_con->prepare('UPDATE users SET Password = ? WHERE id = ?');
				$q->execute(array($_POST['npass'],$_SESSION['awm_user']));
				echo '<b><font color="green">You have successfully changed your password.</b></font>';
			}
		}
	}
}
?>
<form action="" method="post">
	<input type="password" placeholder="Current password" name="cpass"/>
		<br><br>
	<input type="password" placeholder="New password" name="npass"/>
		<br>
	<input type="password" placeholder="Repeat password" name="nrpass"/>
		<br>
<input type="submit" name="submit" value="Change password"></input>
</form>
