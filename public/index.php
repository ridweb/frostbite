<?php
/**
 * This makes our life easier when dealing with paths. Everything is relative
 * to the application root now.
 */
chdir(dirname(__DIR__));

// Setup autoloading
require 'init_autoloader.php';

// Run the application!
$config = require './frostbite/config/frostbite_core.config.php';
//Zend\Debug\Debug::dump($config);
Zend\Mvc\Application::init($config)->run();
