<?php

defined('DS') ? null : define('DS', DIRECTORY_SEPARATOR);
define('SITE_ROOT', 'd:' . DS . 'xampp' . DS . 'htdocs' . DS . 'phpoop');
define('INCLUDES_PATH', SITE_ROOT . DS . 'admin' . DS . 'includes');


// Database Connection
require_once ('functions.php');
require_once('new_config.php');
require_once('Database.php');
require_once('Db_object.php');
require_once('User.php');
require_once('Session.php');
require_once('Photo.php');
require_once('Comment.php');
