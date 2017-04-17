<?php
if(!defined('saul'))
	die('Nope.');
unset($_SESSION['awm_user']);
session_destroy();
header('Location: ' . Config::$_PAGE_URL);	