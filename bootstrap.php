<?php
/**
 * Developer: javascript Kadyan
 * Date: 12/05/13
 * Time: 4:04 PM
 */

$core = array('Auth', 'Cache', 'Cookie', 'Database', 'Extension', 'Logger', 'Mail', 'Modal', 'Pages', 'Router', 'Security', 'Session');
$namespace = '';

require_once(CORE.'Registry.class.php');
require_once(CORE.'Function.php');
require_once(CORE . 'Page.php');

define('BASE_URL', (is_ssl()?'https://':'http://').$_SERVER['HTTP_HOST']);
set('home_url', BASE_URL.DIR.'/');
error_reporting(E_ALL);
set_error_handler('error_handler', E_ALL);

foreach($core as $class){
    define(strtoupper($class),$class);
    require_once(CORE.$class.".class.php");
    $_class = $namespace.$class;
    set($class, new $_class());
}

get('Extension')->load();
