<?php
////////////////////////////////////////////////////////////////
///
///    BASIC CONFIGURATION SETTINGS
///
////////////////////////////////////////////////////////////////


//LANGUAGE CONFIGURATION
define('USE_LANGUAGE_MODULE', true);
define('USE_MULTI_LANGUAGE_SUPPORT', true);
define('DEFAULT_LANGUAGE', 'en');

//APPLICATION MODE
//DEVELOPMENT OR PRODUCTION
//ALSO ACCEPTED DEV || PROD
define('APPLICATION_MODE', 'DEVELOPMENT');

//DEVELOPMENT DB CONNECTION
define('DB_HOST', '127.0.0.1');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', 'dagMVC');

//SESSION SETTINGS
define('SESSION_NAME', 'DAGMVC');

//DEFAULT CSS FRAMEWORK
define('STYLE_WORKS', 'bulma');

//URL
$url = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https://" : "http://") . $_SERVER['HTTP_HOST'];
define('SITE_URL', $url);

//MVC CONFIG
define('DEFAULT_CONTROLLER', 'login');