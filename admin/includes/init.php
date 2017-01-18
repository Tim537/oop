<?php

defined('DS') ? null : define('DS', DIRECTORY_SEPARATOR);
define('SITE_ROOT', 'd:' . DS . 'xampp' . DS . 'htdocs' . DS . 'phpoop');
define('INCLUDES_PATH', SITE_ROOT . DS . 'admin' . DS . 'includes');


// Database Connection
require_once(INCLUDES_PATH . DS . "functions.php");
require_once(INCLUDES_PATH . DS . 'new_config.php');
require_once(INCLUDES_PATH . DS . 'Database.php');
require_once(INCLUDES_PATH . DS . 'Db_object.php');
require_once(INCLUDES_PATH . DS . 'User.php');
require_once(INCLUDES_PATH . DS . 'Session.php');
require_once(INCLUDES_PATH . DS . 'Photo.php');
require_once(INCLUDES_PATH . DS . 'Comment.php');
require_once(INCLUDES_PATH . DS . 'Paginate.php');
