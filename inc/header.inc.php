<?php
if(!defined('saul')) 
	die('Nope.');
ob_start();	
	$admin = Config::getPlayerData($_SESSION['awm_user'],'Admin');
	$helper = Config::getPlayerData($_SESSION['awm_user'],'Helper');
?>
<html>
<head>
	<title><?php echo Config::$SITE_NAME; ?> - Home </title>
	   <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="fa fa" 
      type="image/png" 
      href="<?php echo Config::$_PAGE_URL; ?>fav.png">
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
	<link rel="stylesheet" type="text/css" href="<?php echo Config::$_PAGE_URL; ?>/assets/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="<?php echo Config::$_PAGE_URL; ?>/assets/css/blog-post.css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css">
	 <script src="//ajax.googleapis.com/ajax/libs/jquery/1.6.1/jquery.min.js" type="text/javascript"></script>
	<script>
		var _PAGE_URL = '<?php echo Config::$_PAGE_URL; ?>';
	</script>

</head>
<body>
    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="#"><?php echo Config::$SITE_NAME; ?></a>
            </div>
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                    <li>
                        <a href="<?php echo Config::$_PAGE_URL; ?>">Index</a>
                    </li>
                    <li>
                        <a href="<?php echo Config::$_PAGE_URL; ?>banlist">Banlist</a>
                    </li>
                    <li>
                        <a href="<?php echo Config::$_PAGE_URL; ?>factions">Factions</a>
                    </li>
                    <li>
                        <a href="<?php echo Config::$_PAGE_URL; ?>search">Search</a>
                    </li>
                     <li>
                        <a href="<?php echo Config::$_PAGE_URL; ?>staff">Staff</a>
                    </li>
                    <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Stats <span class="caret"></span></a>
          <ul class="dropdown-menu">
          <li><a href="<?php echo Config::$_PAGE_URL; ?>top"><span>Top Players</span></a></li>
			<li><a href="<?php echo Config::$_PAGE_URL; ?>refe"><span>Top Factions</span></a></li>
				<?php if(Config::isLogged() && ($admin > 0)) { ?> 
					<li <?php echo Config::isActive(array('top')); ?>><a href="<?php echo Config::$_PAGE_URL; ?>htop"><span>Top Helpers</span></a></li> 
				<?php } ?>
            <li role="separator" class="divider"></li>
            <li><a href="#">Top Earnings</a></li>
          </ul>
        </li>
        </ul>
      <ul class="nav navbar-nav navbar-right">

      <form method="POST" action="<?php echo Config::$_PAGE_URL; ?>search" class="navbar-form navbar-left">
        <div class="form-group">
          <input type="text" name="sname" id="username" type="submit" class="form-control" placeholder="Search">
        </div>
        <button type="submit" class="btn btn-default">Submit</button>
      </form>

<?php 
	if(Config::isLogged()) {
		?>

<li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Utilites<span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="<?php echo Config::$_PAGE_URL; ?>changepass">Change password</a></li>
            <li><a href="<?php echo Config::$_PAGE_URL; ?>changeemail">Change email</a></li>
            <li role="separator" class="divider"></li>
            <li><a href="<?php echo Config::$_PAGE_URL; ?>logout">Logout</a></li>
          </ul>
        </li>
      </ul>
		<?php
	} else {
		?>
		 <li><a href="<?php echo Config::$_PAGE_URL; ?>login">Login</a></li>
		<?php
	}
?>
        
            </div>
        </div>
    </nav>

 <div class="container">