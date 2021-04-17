<?php
define('DS', DIRECTORY_SEPARATOR);
require('config' . DS . 'developer.config.php');
session_name(SESSION_NAME);
session_start();
ob_start();

spl_autoload_register(function($class) {
    if(file_exists('app' . DS . 'models' . DS . $class . DS . $class . '.model.php')) {
        require_once('app' . DS . 'models' . DS . $class . DS . $class . '.model.php');
    } else if(file_exists('app' . DS . 'models' . DS . strtoupper($class) . DS . strtoupper($class) . '.model.php')) {
        require_once('app' . DS . 'models' . DS . strtoupper($class) . DS . strtoupper($class) . '.model.php');
    } else if(file_exists('app' . DS . 'models' . DS . strtolower($class) . DS . strtolower($class) . '.model.php')) {
        require_once('app' . DS . 'models' . DS . strtolower($class) . DS . strtolower($class) . '.model.php');
    } else if(file_exists('app' . DS . 'models' . DS . ucfirst($class) . DS . ucfirst($class) . '.model.php')) {
        require_once('app' . DS . 'models' . DS . ucfirst($class) . DS . ucfirst($class) . '.model.php');
    } else if(file_exists('app' . DS . 'controllers' . DS . $class . DS . $class . '.controllers.php')) {
        require_once('app' . DS . 'controllers' . DS . $class . DS . $class . '.controllers.php');
    } else if(file_exists('app' . DS . 'controllers' . DS . strtoupper($class) . DS . strtoupper($class) . '.controllers.php')) {
        require_once('app' . DS . 'controllers' . DS . strtoupper($class) . DS . strtoupper($class) . '.controllers.php');
    } else if(file_exists('app' . DS . 'controllers' . DS . strtolower($class) . DS . strtolower($class) . '.controllers.php')) {
        require_once('app' . DS . 'controllers' . DS . strtolower($class) . DS . strtolower($class) . '.controllers.php');
    } else if(file_exists('app' . DS . 'controllers' . DS . ucfirst($class) . DS . ucfirst($class) . '.controller.php')) {
        require_once('app' . DS . 'controllers' . DS . ucfirst($class) . DS . ucfirst($class) . '.controller.php');
    } else if(file_exists('core' . DS . $class . '.core.php')) {
        require_once('core' . DS . $class . '.core.php');
    } else if(file_exists('core' . DS . strtoupper($class) . '.core.php')) {
        require_once('core' . DS . strtoupper($class) . '.core.php');
    } else if(file_exists('core' . DS . strtolower($class) . '.core.php')) {
        require_once('core' . DS . strtolower($class) . '.core.php');
    } else if(file_exists('core' . DS . ucfirst($class) . '.core.php')) {
        require_once('core' . DS . ucfirst($class) . '.core.php');
    } else if(file_exists('components' . DS . $class . '.components.php')) {
        require_once('components' . DS . $class . '.components.php');
    }
});

if(!Session::exists('language')) {
    Session::set('language', DEFAULT_LANGUAGE);
}

$lg = new Language();
$lg->setLanguage(Session::get('language'));
$lg->getFiles();

Router::setRoute();


