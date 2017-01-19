<?php

// Autoload class files that were not included.
function classAutoLoader($class) {
    //Causes problems with case sensitivity of file name...
    //$class = strtolower($class);

    $the_path = INCLUDES_PATH . DS . "{$class}.php";

    if (is_file($the_path) && !class_exists($class)) {
        require_once($the_path);
    }
}

// Register the autoloader function
spl_autoload_register('classAutoLoader');

// Redirect to a different page
function redirect($location) {
    header("Location: $location");
}