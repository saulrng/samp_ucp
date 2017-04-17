<?php

session_start();

define('saul',true);

include_once 'inc/Config.class.php';

Config::init()->getContent();

?>