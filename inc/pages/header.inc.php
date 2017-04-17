<?php
if(!defined('saul')) 
	die('Nope.');
ob_start();	
?>
<html>
<head>
	<title>RPG.SKILLEDZ.RO - User Panel</title>
	<link rel="icon" 
      type="image/png" 
      href="<?php echo Config::$_PAGE_URL; ?>fav.png">
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
	<link rel="stylesheet" type="text/css" href="<?php echo Config::$_PAGE_URL; ?>assets/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="<?php echo Config::$_PAGE_URL; ?>assets/css/blog-post.css">
	<script>
		var _PAGE_URL = '<?php echo Config::$_PAGE_URL; ?>';
	</script>
</head>
<body>
<?php 
	if(Config::isLogged()) {
		?>
			<div class="loggedin">
				<a href="<?php echo Config::$_PAGE_URL; ?>changepass">Change password</a>
				<a href="<?php echo Config::$_PAGE_URL; ?>changeemail">Change email</a>
				<a href="<?php echo Config::$_PAGE_URL; ?>logout">Logout</a>
			</div>
		<?php
	} else {
		?>
			<div class="loggedin">
				<a href="<?php echo Config::$_PAGE_URL; ?>login">Login</a>
				<a href="<?php echo Config::$_PAGE_URL; ?>recover">Lost password</a>
			</div>
		<?php
	}
?>
<div id="header">
	<div class="header_content"><div class="clear"></div></div>
</div>
<div id="wrapper">
<div id="leftBar">
	<ul>
		<li<?php echo Config::isActive(''); ?>>
			<a href="<?php echo Config::$_PAGE_URL; ?>"><img src="http://skilledz.ro/header_forum2/hmenu.png">   Home</a>
		</li>
		<li<?php echo Config::isActive(array('profile','login','changeemail','changepass')); ?>>
			<a href="<?php echo Config::$_PAGE_URL; echo(Config::isLogged() ? 'profile' : 'login') ?>"><?php echo(Config::isLogged() ? '<img src="http://skilledz.ro/header_forum2/hu.png">   Profile' : '<img src="http://skilledz.ro/header_forum2/key.png">   Login') ?></a>
		</li>
		<?php if(Config::isLogged()) { ?>
			<li>
				<a href="<?php echo Config::$_PAGE_URL; ?>logout"><img src="http://skilledz.ro/header_forum2/hout.png">   Logout</a>
			</li>
		<?php } ?>
		<li<?php echo Config::isActive('search'); ?>>
			<a href="<?php echo Config::$_PAGE_URL; ?>search">  Search</a>
		</li>
		<li<?php echo Config::isActive('online'); ?>>
			<a href="<?php echo Config::$_PAGE_URL; ?>online"><img src="http://skilledz.ro/header_forum2/hon.png">   Online</a>
		</li>
		<li<?php echo Config::isActive('banlist'); ?>>
			<a href="<?php echo Config::$_PAGE_URL; ?>banlist"><img src="http://skilledz.ro/header_forum2/hban.png">   Banlist</a>
		</li>
		<li<?php echo Config::isActive('staff'); ?>>
			<a href="<?php echo Config::$_PAGE_URL; ?>staff"><img src="http://skilledz.ro/header_forum2/hstaff.png">   Staff</a>
		</li>
		<li<?php echo Config::isActive(array('factions','faction')); ?>>
			<a href="<?php echo Config::$_PAGE_URL; ?>factions"><img src="http://skilledz.ro/header_forum2/hfac.png">   Factions</a>
		</li>

		<br>
	</ul>
</div>
 <div class="container">