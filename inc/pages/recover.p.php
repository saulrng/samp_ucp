<?php
function randomPassword($length = 10) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, strlen($characters) - 1)];
    }
    return $randomString;
}
if(isset(Config::$_url[1])) {
	$q = Config::$g_con->prepare("SELECT * FROM `recover` WHERE `time` = ?");
	$q->execute(array(Config::$_url[1]));
	if($q->rowCount()) {
		$row = $q->fetch();
		if($_SERVER['REMOTE_ADDR'] === $row['IP']) {
			if($row['Time'] < time()) {
				echo '<font color="red">Session expired.</font>';
			}
			$password = randomPassword();
			echo 'Noua ta parola: ' . $password;
			$q = Config::$g_con->prepare("UPDATE users SET Password = ? WHERE name = ?");
			$q->execute(array($password,$row['Name']));
			$q = Config::$g_con->prepare("DELETE FROM `recover` WHERE `name` = ?");
			$q->execute(array(Config::$_url[1]));
			return;
		} else {
			echo '<font color="red">Session expired.</font>';
			return;
		}		
	}
}
if(isset($_POST['lp_submit']) && $_POST['lp_name'] && $_POST['lp_email']) {
	$q = Config::$g_con->prepare("SELECT * FROM users WHERE name = ? AND Email = ? LIMIT 0,1");
	$q->execute(array($_POST['lp_name'],$_POST['lp_email']));
	if(!$q->rowCount()) echo '<font color="red">No account with this user and email combination.</font>';
	else {
		$q = Config::$g_con->prepare("SELECT * FROM `lostpw` WHERE `Name` = ? AND `Email` = ?");
		$q->execute(array($_POST['lp_name'],$_POST['lp_email']));
		if($q->rowCount()) {
			$row = $q->fetch();
			if($row['Time'] > time()) {
				echo '<font color="red">There\'s already a request in the past hour to this account. Check your email.</font>';
			}
		} else {
			$session = md5(uniqid($_POST['lp_name'], true)).md5(rand());
			$q = Config::$g_con->prepare("INSERT INTO `lostpw` (`Email`,`Name`,`Session`,`IP`,`Time`) VALUES (?,?,?,?,?)");
			$q->execute(array($_POST['lp_email'],$_POST['lp_name'],$session,$_SERVER['REMOTE_ADDR'],time()+3600));
			echo '<font color="green">A reset link was sent to your email.</font>';
			$to      = $_POST['lp_email'];
			$subject = 'Password reset';
			$message = "To reset your password click the link below.\n
If you didn't request this password reset email,then ignore it.\n
Link: " . Config::$_PAGE_URL . 'recover/' . $session;
			$headers = 'From:  awesome@skilledz.ro' . "\r\n" .
				'Reply-To:  awesome@skilledz.ro' . "\r\n" .

			mail($to, $subject, $message, $headers);
			$_SESSION['session'] = $session;
		}	
	}
}
?>

<form action="" method="post">
	<input style="margin:5px;" type="text" name="lp_name" placeholder="Name"/><BR>
	<input style="margin:5px;" type="text" name="lp_email" placeholder="Email"/><BR>
	<input type="submit" name="lp_submit"/>
</form>